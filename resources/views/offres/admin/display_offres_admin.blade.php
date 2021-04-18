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

            @if($o->isValid == 0)

                <button type="button" class="btn btn-primary btnValid" id="'+key+'">Valider</button>

            @else

                @if($o->isValid == 1 && $o->isArchived == 0)

                    <button type="button" class="btn btn-danger btnArchiv" id="'+key+'">Archiver</button>

                @else

                    <!-- <a href="{{route('offre.index')}}" class="btn btn-primary">Retour</a> -->

                @endif

            @endif 
        </div>
	</div>
    <!-- Modal de confirmation de validation -->
    <div class="modal" tabindex="-1" role="dialog" id="modalValidation" style="display:none">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation de validation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir valider cette offre ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btnAnnuler" data-dismiss="modal">Annuler</button>
                    <a href="{{route('offre.validate',['id'=>$o->id])}}" class="btn btn-primary btnConfValid">Valider</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal de confirmation d'archivage -->
    <div class="modal" tabindex="-1" role="dialog" id="modalArchivage" style="display:none">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation d'archivage</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir archiver cette offre ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btnAnnuler" data-dismiss="modal">Annuler</button>
                    <a href="{{route('offre.archive',['id'=>$o->id])}}" class="btn btn-danger btnConfArchiv">Archiver</a>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script')
  $(document).ready(function() 
  {

    //Affichage de la modal au clic du bouton "Valider"
    $(document).on('click',".btnValid",function(){
        $("#modalValidation").show();
    });

    //Affichage de la modal au clic du bouton "Archiver"
    $(document).on('click',".btnArchiv",function(){
        $("#modalArchivage").show();
    });

    //Cachement de la modal au clic de la croix
    $(document).on('click',".close",function(){
        $("#modalValidation").hide();
        $("#modalArchivage").hide();
    });

    //Cachement de la modal au clic du bouton "Annuler"
    $(document).on('click',".btnAnnuler",function(){
        $("#modalValidation").hide();
        $("#modalArchivage").hide();
    });

    /* Au clic du bouton de confirmation "Valider" */
    $(".btnConfValid").click(function(e)
    {
        $(".btnValid").hide();
    });

    /* Au clic du bouton de confirmation "Archiver" */
    $(".btnConfArchiv").click(function(e)
    {
        $(".btnArchiv").hide();
    });

  });
@stop