@extends('template')

@section('menu')
	@parent - Détails de l'offre
@stop

@section('content')
	<div class="card text-center">
    <div class="card-header">
     	Détails de l'offre
    </div>
    <div class="card-body">
    <h5 class="card-title">{{$o->intitule}}</h5>
    <p class="card-text">{{$o->description}}</p>
    <p class="card-text">{{$o->durée}}</p>
    <p class="card-text">{{$o->entreprise}}</p>
    <p class="card-text">{{$o->ville}}</p>
    <p class="card-text">Contact : {{$o->contact}}</p>
    <p class="card-text">PDF : {{$o->PDF}}</p>
    <a href="{{route('offre.index')}}" class="btn btn-primary">Retour</a>
    </div>
	</div>
@stop