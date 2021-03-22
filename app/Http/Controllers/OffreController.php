<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Offre;
use App\Categorie;
use App\Profil;
use App\Type;

class OffreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tab = Offre::all();
        return view('offres/list_offres', compact('tab'));
    }

    public function __construct() 
    { 
       //  $this->middleware('auth'); 
        // $this->middleware('is_admin')->only(['']);  
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
        return view('offres/create_offres',compact('tabCateg'),compact('tabType'));
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
        'dateFin' => 'after:today',
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
        $o->PDF = $request->input('pdf');
        $o->isValid = 0;
        $o->isArchived = 0;
        $o->categorie_id = $request->input('listCateg');
        $o->type_id = $request->input('listType');
        $o->save();
        $request->session()->flash('success', 'L offre a bien été ajoutée. Elle doit maintenant être validée par l admin avant d être partagée.');
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
        return view('offres/display_offres', compact('o'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
}
