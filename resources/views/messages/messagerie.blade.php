@extends('template')

@section('menu')
    @parent - Messagerie
@stop

@section('titre')
    <main class="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5"><b>Messagerie</b></h1>
        </div>
    </main>
@stop
@section('content')
<br>

<div class="container contacts">
	<CENTER>
		<p style="color: black; font-family: system-ui; font-size: 20px;"><strong>Sélectionner un utilisateur à qui envoyer un message :</strong></p>
		<br>
		@include('messages/contacts',['contacts' => $contacts, 'nbUnread' => $nbUnread])
	</CENTER>
</div>
@stop