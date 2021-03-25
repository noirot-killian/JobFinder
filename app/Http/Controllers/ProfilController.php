<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categorie;
use App\Profil;
use App\User;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function __construct() 
    { 
         $this->middleware('auth'); 
         $this->middleware('is_admin')->only(['']);  
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tabCateg = Categorie::pluck('designation', 'id');
        return view('profils/create_profils',compact('tabCateg'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $p=new Profil;
        $p->nom =  $request->input('nom');
        $p->prenom =  $request->input('prenom');
        $p->ville =  $request->input('ville');
        $p->adresse =  $request->input('adresse');
        $p->cp =  $request->input('cp');
        $p->tel =  $request->input('tel');
        $p->CV = $request->input('cv');
        $p->categorie_id = $request->input('listCateg');
        $p->save();
        $u = new User();
        $u->name=$request->input('name');
        $u->email=$request->input('email');
        $u->password=Hash::make($request->input('password'));
        $u->profil()->associate($p);
        $u->save();

        $validatedData = $request->validate([
        'g-recaptcha-response' => 'required|captcha',]);
        $request->session()->flash('success', 'Profil bien créer.');

        return redirect()->route('profil.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
