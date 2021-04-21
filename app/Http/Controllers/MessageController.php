<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Profil;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MessageController extends Controller
{
    public function __construct() 
    { 
         $this->middleware('auth'); 
         $this->middleware('is_admin')->only(['']);  
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Profil::with(['categorie'])
                    ->where(function($query){
                            $query->where('id', '!=', auth()->user()->profil_id)
                                  ->where('isContactable', 1);
                            })
                    ->get();
        $nbUnread = $this->countUnreadMessages(auth()->user()->profil_id);
        return view('messages/messagerie', compact('contacts', 'nbUnread'));
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
    public function store($idDesti, Request $request)
    {
        $validatedData = $request->validate([
        'content' => 'required|string|max:255',
        ]);

        $message = new Message;
        $message->contenu = $request->input('content');
        $message->emetteur_id = auth()->user()->profil_id;
        $message->destinataire_id = $idDesti;
        $message->save();
        return redirect()->route('message.show',['id'=>$idDesti]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contacts = Profil::with(['categorie'])
                    ->where(function($query){
                            $query->where('id', '!=', auth()->user()->profil_id)
                                  ->where('isContactable', 1);
                            })
                    ->get();

        $interlocuteur = Profil::find($id);

        $messages = Message::with(['profil_emetteur'])
                        ->where(function($query) use($id){
                                $query->where('emetteur_id', auth()->user()->profil_id)
                                      ->where('destinataire_id', $id);
                                })
                        ->orWhere(function($query) use($id){
                                $query->where('emetteur_id', $id)
                                      ->where('destinataire_id', auth()->user()->profil_id);
                                })
                        ->get()
                        ->paginate(50);

        $nbUnread = $this->countUnreadMessages(auth()->user()->profil_id);

        if(isset($nbUnread[$id]))
        {
            $this->readAllMessagesFrom($id, auth()->user()->profil_id);
            unset($nbUnread[$id]);
        }

        return view('messages/display_messages', compact('contacts','interlocuteur','messages','nbUnread'));
    }

    public function countUnreadMessages($id)
    {
        $nbMessages = Message::with(['profil_emetteur'])
                        ->where('destinataire_id', '=', $id)
                        ->groupBy('emetteur_id')
                        ->selectRaw('emetteur_id, COUNT(id) AS count')
                        ->whereRaw('read_at IS NULL')
                        ->get()
                        ->pluck('count', 'emetteur_id');
        return $nbMessages;
    }

    public function readAllMessagesFrom($idEmetteur, $idDesti)
    {
        $messages = Message::with(['profil_emetteur'])
                        ->where(function($query) use($idEmetteur, $idDesti){
                            $query->where('emetteur_id', $idEmetteur)
                                  ->where('destinataire_id', $idDesti);
                            })
                        ->whereNull('read_at')
                        ->get();

        foreach ($messages as $message) 
        {
            $message->read_at = Carbon::now();
            $message->save();
        }
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
