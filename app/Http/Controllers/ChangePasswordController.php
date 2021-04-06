<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Profil;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('auth\changePassword');
    } 

    public function store(Request $request)
    {
        $request->validate([

            'current_password' => ['required', new MatchOldPassword],

            'new_password' => ['required'],

            'new_confirm_password' => ['same:new_password'],

        ]);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

        $p = Profil::find(auth()->user()->profil_id);
        $p->isFirstCo = 0;
        $p->save();

        $request->session()->flash('success', 'Le mot de passe a bien été modifié.');
        return redirect()->route('offre.index');
    }
}