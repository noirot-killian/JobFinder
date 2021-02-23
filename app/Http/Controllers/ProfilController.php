<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $p->pseudo =  $request->input('psuedo');
        $p->mdp = $request->input('mdp');
        $p->ville = $request->input('ville');
        $p->cp = $request->input('cp');
        $p->mail = $request->input('mail');
        $p->tel = $request->input('tel');

        $validatedData = $request->validate([
        'nom' => 'required|min:3',
        'prenom' => 'required',
        'pseudo' => 'required',
        'mdp' => 'required|min:5',
        'ville' => 'required',
        'cp' => 'required|max:5',
        'mail' => 'required',
        'tel' => 'required|max:10'

    ]);

        $p->save();
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
