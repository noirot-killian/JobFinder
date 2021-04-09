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
         	Détails de l'offre
        </div>
        <div class="card-body">
            <h5 class="card-title">{{$o->intitule}}</h5>
            <p class="card-text">{{$o->description}}</p>
            <p class="card-text"><b>Durée : </b>{{$o->duree}}</p>
            <p class="card-text"><b>Date de début : </b>{{\Carbon\Carbon::parse($o->date_debut)->translatedFormat('d/m/Y')}}</p>
            <p class="card-text"><b>Date de fin : </b>{{\Carbon\Carbon::parse($o->date_fin)->translatedFormat('d/m/Y')}}</p>
            <p class="card-text"><b>Entreprise : </b>{{$o->entreprise}}</p>
            <p class="card-text"><b>Ville : </b>{{$o->ville}}</p>
            <p class="card-text"><b>Contact 1 : </b>{{$o->email}}</p>
            <p class="card-text"><b>Contact 2 : </b>{{$o->tel}}</p>
            <p class="card-text"><b>PDF : </b>{{$o->PDF}}</p>
            <a href="#" class="btn btn-primary">Postuler</a>
            @if($o->profil_favoriser()->find(Auth::user()->profil_id))
                    <a href="#" id="btnDel" class="btn btn-danger">Retirer des favoris</a>
                @else
                    <a href="#" id="btnAdd" class="btn btn-primary">Mettre en favoris</a>
                @endif
            
            <!-- <a href="{{route('offre.index')}}" class="btn btn-primary">Retour</a> -->
        </div>
	</div>
@stop
@section('script')
  $(document).ready(function() 
  {

    /* Au clic du bouton "Retirer des favoris" */

    $("#btnDel").click(function(e)
    {
        //appel de notre API
        $.ajax({

            type:"POST",
                     
            url:"http://localhost/JobFinder/public/offre/removeFavorite/"+$(this).attr("id")+"/"+{{Auth::user()->profil_id}},

            data:{ _token: '{{csrf_token()}}'},

            success:function(data)
            {
                alert($this);
               $(this).replaceWith($("#btnAdd")); 
            }
        });
    });
  });
@stop