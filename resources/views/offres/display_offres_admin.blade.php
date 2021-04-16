@extends('template')

@section('menu')
	@parent - Détails de l'offre
@stop
@section('titre')
    <main class="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5">Détails de l'<b>offre</b></h1>
        </div>
    </main>
@stop
@section('content')
	<div class="card text-center">
        <div class="card-header">
         	<b>{{$o->intitule}}</b>
        </div>
        <div class="card-body">
            <p class="card-text">{{$o->description}}</p>
            <p class="card-text"><b>Durée : </b>{{$o->duree}}</p>
            <p class="card-text"><b>Date de début : </b>{{\Carbon\Carbon::parse($o->date_debut)->translatedFormat('d/m/Y')}}</p>
            <p class="card-text"><b>Date de fin : </b>{{\Carbon\Carbon::parse($o->date_fin)->translatedFormat('d/m/Y')}}</p>
            <p class="card-text"><b>Entreprise : </b>{{$o->entreprise}}</p>
            <p class="card-text"><b>Ville : </b>{{$o->ville}}</p>
            <p class="card-text"><b>Contact 1 : </b>{{$o->email}}</p>
            <p class="card-text"><b>Contact 2 : </b>{{$o->tel}}</p>
            <p class="card-text"><b>PDF : </b>{{$o->PDF}}</p>

            @if($o->isValid == 0)

                <a href="{{route('offre.validate',['id'=>$o->id])}}" class="btn btn-primary btnValid">Valider</a>

            @else

                @if($o->isValid == 1 && $o->isArchived == 0)

                    <a href="{{route('offre.archive',['id'=>$o->id])}}" class="btn btn-danger btnArchiv">Archiver</a>

                @else

                    <!-- <a href="{{route('offre.index')}}" class="btn btn-primary">Retour</a> -->

                @endif

            @endif 
        </div>
	</div>
@stop
@section('script')
  $(document).ready(function() 
  {

    /* Au clic du bouton "Valider" */

    $(".btnValid").click(function(e)
    {
        $(this).hide();
    });

    /* Au clic du bouton "Archiver" */

    $(".btnArchiv").click(function(e)
    {
        $(this).hide();
    });

  });
@stop