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
<div class="container">
	@include('messages/contacts',['contacts' => $contacts, 'nbUnread' => $nbUnread])
</div>
@stop