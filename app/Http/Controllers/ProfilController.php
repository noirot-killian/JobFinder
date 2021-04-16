<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categorie;
use App\Profil;
use App\User;
use Illuminate\Support\Facades\Hash;


class ProfilController extends Controller
{
    public function __construct() 
    { 
        $this->middleware('auth'); 
        $this->middleware('admin')->except(['index']);  
    } 
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $p = Profil::find(auth()->user()->profil_id);
        return view('profils\my_profile', compact('p'));
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
        $validatedData = $request->validate([
        'nom' => 'required|string|max:20',
        'prenom' => 'required|string|max:20',
        'ville' => 'required|string|max:25',
        'adresse' => 'required|string|', 
        'cp' => 'required|string|max:10',
        'tel' => 'required|string|regex:/(0)[0-9]{9}/|max:12',
        'listCateg' => 'required',
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
        $p->save();
        $u = new User();
        $u->name=$request->input('name');
        $u->email=$request->input('email');
        $u->password=Hash::make($request->input('password'));
        $u->profil()->associate($p);
        $u->save();
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
