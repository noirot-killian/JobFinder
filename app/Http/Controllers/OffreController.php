<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Offre;
use App\Categorie;
use App\Profil;

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
        return view('offres/create_offres',compact('tabCateg'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $o=new Offre;
        $o->intitule =  $request->input('intitule');
        $o->description =  $request->input('description');
        $o->duree =  $request->input('duree');
        $o->ville = $request->input('ville');
        $o->entreprise = $request->input('entreprise');
        $o->contact = $request->input('contact');

        $validatedData = $request->validate([
        'intitule' => 'required|min:3',
        'description' => 'required',
        'duree' => 'required',
        'ville' => 'required',
        'entreprise' => 'required',
        'contact' => 'required'

    ]);

        $o->save();
        return redirect()->route('');
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
