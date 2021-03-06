<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Offre;
use App\Categorie;
use App\Profil;
use App\Type;
use Response;

class OffreController extends Controller
{
    public function __construct() 
    { 
        $this->middleware('auth'); 
        $this->middleware('admin')->only(['listAdmin','listValidationAdmin','validation','archiving','edit','update','destroy']);  
    } 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // eager loading
        $tab = Offre::with(['type','categorie','profil_favoriser'])->where('isValid', '=', 1)->where('isArchived', '=', 0)->get(); 
        // $tab = Offre::all(); -> lazy loading

        if($tab->isEmpty())
        {
            $request->session()->flash('success', "Il n'y a aucune offre sur le site.");
            return redirect()->route('offre.create');
        }
        else
        {
            return view('offres/user/list_offres', compact('tab'));
        }
    }

    public function listAdmin(Request $request)
    {
        $tab = Offre::with(['type','categorie','profil_favoriser'])->where('isValid', '=', 1)->where('isArchived', '=', 0)->get();
        
        if($tab->isEmpty())
        {
            $request->session()->flash('success', "Il n'y a aucune offre sur le site.");
            return redirect()->route('offre.createAdmin');
        }
        else
        {
            return view('offres/admin/list_offres_admin', compact('tab'));
        }
    }

    public function listValidationAdmin(Request $request)
    {
        $tab = Offre::with(['type','categorie'])->where('isValid', '=', 0)->get();

        if($tab->isEmpty())
        {
            $request->session()->flash('errors', "Il n'y a aucune offre à valider.");
            return redirect()->route('offre.listAdmin');
        }
        else
        {
            return view('offres/admin/list_offres_validate', compact('tab'));
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
        $tabType = Type::pluck('nom', 'id');
        return view('offres/user/create_offres',compact('tabCateg'),compact('tabType'));
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
        'intitule' => 'required|string|max:50',
        'description' => 'required|string|max:255',
        'duree' => 'nullable|string|max:25',
        'dateDebut' => 'after:today', /*la date doit être future à la date du jour*/
        'dateFin' => 'nullable|after:today',
        'ville' => 'required|string|regex:/^[a-zA-Z ]+$/', /*chaîne sans chiffres*/
        'entreprise' => 'required|string',
        'contact2' => 'nullable|regex:/(0)[0-9]{9}/|max:12', /*numéro de téléphone correct*/
        'pdf' => 'mimes:pdf', // le doc doit être un PDF
        'listCateg' => 'required',
        'listType' => 'required',
        ]);

        $o=new Offre;
        $o->intitule =  $request->input('intitule');
        $o->description =  $request->input('description');
        $o->duree =  $request->input('duree');
        $o->date_debut = $request->input('dateDebut');
        $o->date_fin = $request->input('dateFin');
        $o->entreprise = $request->input('entreprise');
        $o->ville = $request->input('ville');
        $o->email = $request->input('contact1');
        $o->tel = $request->input('contact2');
        if($request->hasFile('pdf')) {
            //get filename with extension
            $filenamewithextension = $request->file('pdf')->getClientOriginalName();
      
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
      
            //get file extension
            $extension = $request->file('pdf')->getClientOriginalExtension();
      
            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;
     
            //Upload File
            $request->file('pdf')->storeAs('public/pdf_files', $filenametostore);

            $o->PDF = $filenametostore;
        }
        $o->isValid = 0;
        $o->isArchived = 0;
        $o->categorie_id = $request->input('listCateg');
        $o->type_id = $request->input('listType');
        $o->profil_id = auth()->user()->profil_id ;
        $o->save();
        $request->session()->flash('success', "L'offre a bien été ajoutée. Elle doit maintenant être validée par l'admin avant d'être partagée.");
        return redirect()->route('offre.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $o = Offre::find($id);
        return view('offres/user/display_offres', compact('o'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $uneOffre = Offre::find($id);
        $lesCategories = Categorie::pluck('designation', 'id');
        $lesTypes = Type::pluck('nom', 'id');
        return view('offres/admin/modify_offres',compact('uneOffre','lesCategories','lesTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        $validatedData = $request->validate([
        'newIntitule' => 'required|string|max:50',
        'newDescription' => 'required|string|max:255',
        'newDuree' => 'nullable|string|max:25',
        'newDateDebut' => 'after:today', /*la date doit être future à la date du jour*/
        'newDateFin' => 'nullable|after:today',
        'newVille' => 'required|string|regex:/^[a-zA-Z ]+$/', /*chaîne sans chiffres*/
        'newEntreprise' => 'required|string',
        'newContact2' => 'nullable|regex:/(0)[0-9]{9}/|max:12', /*numéro de téléphone correct*/
        'newPdf' => 'mimes:pdf', // le doc doit être un PDF
        'newListC' => 'required',
        'newListT' => 'required',
        ]);

        $o = Offre::find($id);
        $o->intitule =  $request->input('newIntitule');
        $o->description =  $request->input('newDescription');
        $o->duree =  $request->input('newDuree');
        $o->date_debut = $request->input('newDateDebut');
        $o->date_fin = $request->input('newDateFin');
        $o->entreprise = $request->input('newEntreprise');
        $o->ville = $request->input('newVille');
        $o->email = $request->input('newContact1');
        $o->tel = $request->input('newContact2');
        if($request->hasFile('newPdf')) {
            //get filename with extension
            $filenamewithextension = $request->file('newPdf')->getClientOriginalName();
      
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
      
            //get file extension
            $extension = $request->file('newPdf')->getClientOriginalExtension();
      
            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;
     
            //Upload File
            $request->file('newPdf')->storeAs('public/pdf_files', $filenametostore);

            $o->PDF = $filenametostore;
        }
        $o->isValid = 1;
        $o->isArchived = 0;
        $o->categorie_id = $request->input('newListC');
        $o->type_id = $request->input('newListT');
        $o->save();
        $request->session()->flash('success', "L'offre a bien été modifiée.");
        return redirect()->route('offre.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function destroy($id, Request $request)
    {
        $o = Offre::find($id);
        $o->delete();
        $request->session()->flash('success', "L'offre a été supprimée.");
        return redirect()->route('offre.listValidation');
    }

    public function addFavorite($idOffre, $idProfil)
    {
        $o1 = Offre::find($idOffre);
        $p1 = Profil::find($idProfil);
        $o1->profil_favoriser()->attach($p1);
    }
    
    public function removeFavorite($idOffre, $idProfil)
    {
        $o2 = Offre::find($idOffre);
        $p2 = Profil::find($idProfil);
        $o2->profil_favoriser()->detach($p2);
    }

    public function myFavorites(Request $request)
    {
        $tab = Offre::with(['type','categorie','profil_favoriser'])->get();

        foreach ($tab as $ligne) 
        {
            if ($ligne->profil_favoriser->isEmpty()==false)
            {
                $tabFav[]=$ligne;
            }
        }

        if(empty($tabFav))
        {
            $request->session()->flash('errors', "Vous n'avez pas d'offres mises en favoris.");
            return redirect()->route('offre.index');
        }
        else
        {
            return view('offres/user/my_favorites', compact('tabFav'));
        }
    }

    public function addPostulation($idOffre, $idProfil)
    {
        $o3 = Offre::find($idOffre);
        $p3 = Profil::find($idProfil);
        $o3->profil_postuler()->attach($p3);
    }

    public function removePostulation($idOffre, $idProfil)
    {
        $o4 = Offre::find($idOffre);
        $p4 = Profil::find($idProfil);
        $o4->profil_postuler()->detach($p4);
    }

    public function myPostulations(Request $request)
    {
        $tab = Offre::with(['type','categorie','profil_postuler'])->get();

        foreach ($tab as $ligne) 
        {
            if ($ligne->profil_postuler->isEmpty()==false)
            {
                $tabPostu[]=$ligne;
            }
        }

        if(empty($tabPostu))
        {
            $request->session()->flash('errors', "Vous n'avez postuler à aucune offre.");
            return redirect()->route('offre.index');
        }
        else
        {
            return view('offres/user/my_postulations', compact('tabPostu'));
        }
    }

    public function myOffers(Request $request)
    {
        $tab = Offre::with(['type','categorie','profil_postuler'])->get();

        foreach ($tab as $ligne) 
        {
            if ($ligne->profil_id == auth()->user()->profil_id)
            {
                $tabOffers[]=$ligne;
            }
        }

        if(empty($tabOffers))
        {
            $request->session()->flash('success', "Vous n'avez proposé aucune offre.");
            return redirect()->route('offre.create');
        }
        else
        {
            return view('offres/user/my_offers', compact('tabOffers'));
        }
    }

    public function validation($id, Request $request)
    {
        $o = Offre::find($id);
        $o->isValid = 1;
        $o->save();
        $request->session()->flash('success', "L'offre a été validée.");
        return redirect()->route('offre.listValidation');
    }

    public function archiving($id, Request $request)
    {
        $o = Offre::find($id);
        $o->isArchived = 1;
        $o->save();
        $request->session()->flash('success', "L'offre a été archivée.");
        return redirect()->route('offre.listAdmin');
    }

    public function createAdmin()
    {
        $tabCateg = Categorie::pluck('designation', 'id');
        $tabType = Type::pluck('nom', 'id');
        return view('offres/admin/create_offres_admin',compact('tabCateg'),compact('tabType'));
    }

    public function storeAdmin(Request $request)
    {
        $validatedData = $request->validate([
        'intitule' => 'required|string|max:50',
        'description' => 'required|string|max:255',
        'duree' => 'nullable|string|max:25',
        'dateDebut' => 'after:today', /*la date doit être future à la date du jour*/
        'dateFin' => 'nullable|after:today',
        'ville' => 'required|string|regex:/^[a-zA-Z ]+$/', /*chaîne sans chiffres*/
        'entreprise' => 'required|string',
        'contact2' => 'nullable|regex:/(0)[0-9]{9}/|max:12', /*numéro de téléphone correct*/
        'pdf' => 'mimes:pdf', // le doc doit être un PDF
        'listCateg' => 'required',
        'listType' => 'required',
        ]);

        $o=new Offre;
        $o->intitule =  $request->input('intitule');
        $o->description =  $request->input('description');
        $o->duree =  $request->input('duree');
        $o->date_debut = $request->input('dateDebut');
        $o->date_fin = $request->input('dateFin');
        $o->entreprise = $request->input('entreprise');
        $o->ville = $request->input('ville');
        $o->email = $request->input('contact1');
        $o->tel = $request->input('contact2');
        if($request->hasFile('pdf')) {
            //get filename with extension
            $filenamewithextension = $request->file('pdf')->getClientOriginalName();
      
            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
      
            //get file extension
            $extension = $request->file('pdf')->getClientOriginalExtension();
      
            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;
     
            //Upload File
            $request->file('pdf')->storeAs('public/pdf_files', $filenametostore);

            $o->PDF = $filenametostore;
        }
        $o->isValid = 1;
        $o->isArchived = 0;
        $o->categorie_id = $request->input('listCateg');
        $o->type_id = $request->input('listType');
        $o->profil_id = auth()->user()->profil_id ;
        $o->save();
        $request->session()->flash('success', "L'offre a bien été ajoutée.");
        return redirect()->route('offre.createAdmin');
    }

    public function showAdmin($id)
    {
        $o = Offre::find($id);
        return view('offres/admin/display_offres_admin', compact('o'));
    }
}