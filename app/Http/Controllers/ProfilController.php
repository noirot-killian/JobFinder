<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categorie;
use App\Profil;
use App\User;
use App\Offre;
use Illuminate\Support\Facades\Hash;
use Response;
use Illuminate\Support\Facades\DB;
use Spatie\SimpleExcel\SimpleExcelReader;

class ProfilController extends Controller
{
    public function __construct() 
    { 
        $this->middleware('auth'); 
        $this->middleware('admin')->except(['edit','update','show','getCV','myProfile','listApplicants']);  
    } 
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tab = Profil::with(['categorie'])->where('id', '!=', auth()->user()->profil_id)->get();

        if($tab->isEmpty())
        {
            $request->session()->flash('errors', "Il n'y a aucun utilisateur sur le site.");
            $tabCateg = Categorie::pluck('designation', 'id');
            return view('profils/admin/create_profils',compact('tabCateg'));
        }
        else
        {
            return view('profils/admin/list_profils', compact('tab'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tabCateg = Categorie::pluck('designation', 'id');
        return view('profils/admin/create_profils',compact('tabCateg'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
        'nom' => 'required|string|max:20',
        'prenom' => 'required|string|max:20',
        'ville' => 'required|string|max:25',
        'adresse' => 'required|string|', 
        'cp' => 'required|string|max:10',
        'tel' => 'required|string|regex:/(0)[0-9]{9}/|max:12',
        'listCateg' => 'required',
        'admin' => 'required',
        'notif' => 'required',
        'joignable' => 'required',
        'cv' => 'mimes:pdf',
        'name' => 'required', 'string', 'max:255',
        'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
        'password' => 'required', 'string', 'min:8', 'confirmed',]);
        
        $p=new Profil;
        $p->nom =  $request->input('nom');
        $p->prenom =  $request->input('prenom');
        $p->ville =  $request->input('ville');
        $p->adresse =  $request->input('adresse');
        $p->cp =  $request->input('cp');
        $p->tel =  $request->input('tel');

      
        if($request->hasFile('cv')) {
            //get filename with extension
            $filenamewithextension = $request->file('cv')->getClientOriginalName();
      
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
      
            //get file extension
            $extension = $request->file('cv')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;
     
            //Upload File
            $request->file('cv')->storeAs('public/cv_files', $filenametostore);

            $p->CV = $filenametostore;
        }

        $p->categorie_id = $request->input('listCateg');
        $p->isFirstCo = 1;
        $p->isAdmin = $request->input('admin');
        $p->isNotified = $request->input('notif');
        $p->isContactable = $request->input('joignable');
        $p->save();

        $u = new User();
        $u->name=$request->input('name');
        $u->email=$request->input('email');
        $u->password=Hash::make($request->input('password'));
        $u->profil()->associate($p);
        $u->save();

        $request->session()->flash('success', 'Profil bien créé.');
        return redirect()->route('profil.create');
    }

    public function getCV($filename)
    {
        $file = storage_path()."\app\public\cv_files\/".$filename;

        $headers = array(
        'Content-Type: application/pdf',
        );
    
        return Response::download($file, "CV_postulant", $headers);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $p = Profil::find($id);
        $email = DB::table('users')->where('profil_id', $id)->value('email');
        return view('profils/display_profils', compact('p'), compact('email'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $p = Profil::find($id);
        $tabCateg = Categorie::pluck('designation', 'id');
        $name = DB::table('users')->where('profil_id', $id)->value('name');
        $email = DB::table('users')->where('profil_id', $id)->value('email');
        return view('profils/user/modify_profils', compact('p','tabCateg','name','email'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
        'newNom' => 'required|string|max:20',
        'newPrenom' => 'required|string|max:20',
        'newVille' => 'required|string|max:25',
        'newAdresse' => 'required|string|', 
        'newCP' => 'required|string|max:10',
        'newTel' => 'required|string|regex:/(0)[0-9]{9}/|max:12',
        'newListCateg' => 'required',
        'newNotif' => 'required',
        'newJoignable' => 'required',
        'newCV' => 'mimes:pdf',
        'newName' => 'required', 'string', 'max:255',
        'newEmail' => 'required', 'string', 'email', 'max:255', 'unique:users',
        'newPassword' => 'required', 'string', 'min:8', 'confirmed',]);
        
        $p = Profil::find($id);
        $p->nom =  $request->input('newNom');
        $p->prenom =  $request->input('newPrenom');
        $p->ville =  $request->input('newVille');
        $p->adresse =  $request->input('newAdresse');
        $p->cp =  $request->input('newCP');
        $p->tel =  $request->input('newTel');

      
        if($request->hasFile('newCV')) {
            //get filename with extension
            $filenamewithextension = $request->file('newCV')->getClientOriginalName();
      
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
      
            //get file extension
            $extension = $request->file('newCV')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;
     
            //Upload File
            $request->file('newCV')->storeAs('public/cv_files', $filenametostore);

            $p->CV = $filenametostore;
        }

        $p->categorie_id = $request->input('newListCateg');
        $p->isFirstCo = 1;
        $p->isNotified = $request->input('newNotif');
        $p->isContactable = $request->input('newJoignable');
        $p->save();

        $u = User::find(DB::table('users')->where('profil_id', $id)->value('id'));
        $u->name = $request->input('newName');
        $u->email = $request->input('newEmail');
        $u->password = Hash::make($request->input('newPassword'));
        $u->save();

        $request->session()->flash('success', 'Le profil a bien été modifié.');
        return redirect()->route('profil.myProfile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $p = Profil::find($id);

        $offres = Offre::all()->where('profil_id', '=', $id);

        $idUser = DB::table('users')->where('profil_id', $id)->value('id');

        if($offres->isNotEmpty())
        {
            foreach ($offres as $ligne) 
            {
                Offre::destroy($ligne->id);
            }

            User::destroy($idUser);

            $p->delete();

            $request->session()->flash('success', "L'utilisateur et ses offres ont été supprimés.");
            return redirect()->route('profil.index');
        }

        else
        {
            User::destroy($idUser);

            $p->delete();

            $request->session()->flash('success', "L'utilisateur et ses offres ont été supprimés.");
            return redirect()->route('profil.index');
        }  
    }

    public function myProfile()
    {
        $p = Profil::find(auth()->user()->profil_id);
        return view('profils/user/my_profile', compact('p'));
    }

    public function nominateAdmin($id, Request $request)
    {
        $p = Profil::find($id);
        $p->isAdmin = 1;
        $p->save();
        $request->session()->flash('success', "L'utilisateur a été nommé administrateur.");
        return redirect()->route('profil.index');
    }

    public function removeAdmin($id, Request $request)
    {
        $p = Profil::find($id);
        $p->isAdmin = 0;
        $p->save();
        $request->session()->flash('success', "L'utilisateur a perdu son accès administrateur.");
        return redirect()->route('profil.index');
    }

    public function listApplicants($id, Request $request) //applicant = postulant en anglais
    {
        $tab = Profil::with(['categorie','profil_postuler'])->get();

        foreach ($tab as $ligne) 
        {
            if ($ligne->profil_postuler->isEmpty()==false)
            {
                $tabPostulants[]=$ligne;
            }
        }

        if(empty($tabPostulants))
        {
            $tab = Offre::with(['type','categorie','profil_postuler'])->get();

            foreach ($tab as $ligne) 
            {
                if ($ligne->profil_id == auth()->user()->profil_id)
                {
                    $tabOffers[]=$ligne;
                }
            }

            $request->session()->flash('errors', "Personne n'a postulé à cette offre.");
            return view('offres/user/my_offers', compact('tabOffers'));
        }

        else
        {
            return view('profils/user/list_applicants', compact('tabPostulants'));
        }
    }

    public function viewImportProfiles(Request $request)
    {
        return view('profils/admin/import_profils');
    }   

    // Importer les données
    public function importProfiles(Request $request) 
    {
        // 1. Validation du fichier uploadé. Extension ".xlsx" autorisée
        $this->validate($request, [
            'fichier' => 'bail|required|file|mimes:xlsx'
        ]);

        // 2. On déplace le fichier uploadé vers le dossier "public" pour le lire
        $fichier = $request->fichier->move(public_path(), $request->fichier->hashName());

        // 3. $reader : L'instance Spatie\SimpleExcel\SimpleExcelReader
        $reader = SimpleExcelReader::create($fichier);

        // On récupère le contenu (les lignes) du fichier
        $rows = $reader->getRows();

        // $rows est une Illuminate\Support\LazyCollection

        // 4. On insère toutes les lignes dans la base de données
        $status = Profil::insert($rows->toArray());

        // Si toutes les lignes sont insérées
        if ($status) {

            // 5. On supprimer le fichier uploadé
            $reader->close(); // On ferme le $reader
            unlink($fichier);

            // 6. Retour vers le formulaire avec un message $msg
            return back()->withMsg("Importation réussie !");

        } else { abort(500); }
    }
}
