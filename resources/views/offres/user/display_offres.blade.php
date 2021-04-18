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
            @if(empty($o->PDF))
                <p> Pas de PDF associé. </p>
            @else
                <a href="{{route('profil.getPDF',['filename'=>$o->PDF])}}" style="background-color: #333ab7; color: #fff; padding: 12px; display:block; text-decoration: none; margin-right: 700px; margin-left: 700px;"><b>Télécharger le PDF</b></a>
            @endif
            <br>
            @if($o->profil_id != Auth::user()->profil_id)

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

            @endif
            <!-- <a href="{{route('offre.index')}}" class="btn btn-primary">Retour</a> -->
        </div>
	</div>

    <!-- Modal de confirmation de postulation -->
    <div class="modal" tabindex="-1" role="dialog" id="modalPostulation" style="display:none">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation de postulation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir postuler à cette offre ? L'offreur pourra accéder à votre profil et vous contacter.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btnAnnuler" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary btnConfPostu">Postuler</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de confirmation d'annulation de postulation -->
    <div class="modal" tabindex="-1" role="dialog" id="modalAnnulationPostulation" style="display:none">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation d'annulation de postulation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir annuler votre postulation à cette offre ? L'offreur ne pourra plus accéder à votre profil et vous contacter.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btnAnnuler" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-danger btnConfAnnulPostu">Annuler la postulation</button>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
  $(document).ready(function() 
  {
    //Affichage de la modal au clic du bouton "Postuler"
    $(document).on('click',"#btnAddPostu",function(){
        $("#modalPostulation").show();
    });

    /* Au clic du bouton de confirmation "Postuler" */
    $(".btnConfPostu").click(function(e)
    {
        $("#modalPostulation").hide(); /* On cache la modal */

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

    //Affichage de la modal au clic du bouton "Annuler la postulation"
    $(document).on('click',"#btnDelPostu",function(){
        $("#modalAnnulationPostulation").show();
    });

    /* Au clic du bouton de confirmation "Annuler la postulation" */
    $(".btnConfAnnulPostu").click(function(e)
    {
        $("#modalAnnulationPostulation").hide(); /* On cache la modal */

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

    //Cachement des modal au clic de la croix
    $(document).on('click',".close",function(){
        $("#modalPostulation").hide();
        $("#modalAnnulationPostulation").hide();
    });

    //Cachement des modal au clic du bouton "Annuler"
    $(document).on('click',".btnAnnuler",function(){
        $("#modalPostulation").hide();
        $("#modalAnnulationPostulation").hide();
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