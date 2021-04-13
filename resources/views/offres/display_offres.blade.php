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

            @if($o->profil_postuler()->find(Auth::user()->profil_id))

                <a href="#" id="btnDelPostu" class="btn btn-danger">Annuler la postulation</a>

                <a href="#" id="btnAddPostu" style="display: none;" class="btn btn-primary">Postuler</a>

            @else

                <a href="#" id="btnAddPostu" class="btn btn-primary">Postuler</a>

                <a href="#" id="btnDelPostu" style="display: none;" class="btn btn-danger">Annuler la postulation</a>

            @endif

            @if($o->profil_favoriser()->find(Auth::user()->profil_id))

                <a href="#" id="btnDelFav" class="btn btn-danger">Retirer des favoris</a>

                <a href="#" id="btnAddFav" style="display: none;" class="btn btn-primary">Mettre en favoris</a>

            @else

                <a href="#" id="btnAddFav" class="btn btn-primary">Mettre en favoris</a>

                <a href="#" id="btnDelFav" style="display: none;" class="btn btn-danger">Retirer des favoris</a>

            @endif
            
            <!-- <a href="{{route('offre.index')}}" class="btn btn-primary">Retour</a> -->
        </div>
	</div>
@stop
@section('script')
  $(document).ready(function() 
  {
    /* Au clic du bouton "Postuler" */

    $("#btnAddPostu").click(function(e)
    {
        //appel de notre API
        $.ajax({

            type:"POST",
                     
            url:"http://localhost/JobFinder/public/offre/addPostulation/"+{{$o->id}}+"/"+{{Auth::user()->profil_id}},

            data:{ _token: '{{csrf_token()}}'},

            success:function(data)
            {
                $("#btnAddPostu").hide();
                $("#btnDelPostu").show();
            }
        });
    });

    /* Au clic du bouton "Annuler la postulation" */

    $("#btnDelPostu").click(function(e)
    {
        //appel de notre API
        $.ajax({

            type:"POST",
                     
            url:"http://localhost/JobFinder/public/offre/removePostulation/"+{{$o->id}}+"/"+{{Auth::user()->profil_id}},

            data:{ _token: '{{csrf_token()}}'},

            success:function(data)
            {
                $("#btnDelPostu").hide();
                $("#btnAddPostu").show();
            }
        });
    });

    /* Au clic du bouton "Mettre en favoris" */

    $("#btnAddFav").click(function(e)
    {
        //appel de notre API
        $.ajax({

            type:"POST",
                     
            url:"http://localhost/JobFinder/public/offre/addFavorite/"+{{$o->id}}+"/"+{{Auth::user()->profil_id}},

            data:{ _token: '{{csrf_token()}}'},

            success:function(data)
            {
                $("#btnAddFav").hide();
                $("#btnDelFav").show();
            }
        });
    });

    /* Au clic du bouton "Retirer des favoris" */

    $("#btnDelFav").click(function(e)
    {
        //appel de notre API
        $.ajax({

            type:"POST",
                     
            url:"http://localhost/JobFinder/public/offre/removeFavorite/"+{{$o->id}}+"/"+{{Auth::user()->profil_id}},

            data:{ _token: '{{csrf_token()}}'},

            success:function(data)
            {
                $("#btnDelFav").hide();
                $("#btnAddFav").show();
            }
        });
    });
  });
@stop