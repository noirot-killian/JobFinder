@extends('template')

@section('menu')
    @parent - Création d'une offre
@stop

@section('titre')
    <main class="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5">Modifier une <b>offre</b></h1>
        </div>
    </main>
@stop
@section('content')
<style>
    
    #formIntitule, #formDescription, #formPDF
    {
        margin-top: 20px;
        margin-left: 400px;
        margin-right: 400px;
    }

    #formCateg, #formType, #formVille, #formEntreprise, #formMail,  #formTel
    {
        margin-left: 400px;
        margin-right: 900px;
    }

    #formDurée, #formDateDeb, #formDateFin
    {
        margin-left: 400px;
        margin-right: 1040px;
    }

    .btnModif, #btnAnnuler
    {
        width: 200px;
    }

    textarea 
    {
        width: 30em;
        height: 20em;
    }

</style>

{!! Form::open(['url' => route('offre.update',[$uneOffre->id]), 'method' => 'put', 'enctype' => 'multipart/form-data']) !!}
	@csrf
	<div class="form-group" id="formIntitule">
        <label for="titre"><b> Intitulé : </b></label>
        <input name="newIntitule" value="{{$uneOffre->intitule}}" type="text" class="form-control" id="titre" placeholder="Saisissez l'intitulé de l'offre">
        @error('newIntitule')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <div class="form-group" id="formDescription">
        <label for="desc"><b> Description : </b></label>
        <textarea name="newDescription" id="desc" class="form-control"placeholder="Saisissez une description">{{$uneOffre->description}}</textarea>
        @error('newDescription')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <br>
    <div id="formCateg">
        <label><b> Catégorie : </b></label>
        <div>
            {!!Form::select('newListC', $lesCategories, $uneOffre->categorie_id, ['class'=>'form-control']) !!}
        </div>
        @error('newListC')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <br>
    <div id="formType">
        <label><b> Type : </b></label>
        <div>
            {!!Form::select('newListT', $lesTypes, $uneOffre->type_id, ['class'=>'form-control']) !!}
        </div>
        @error('newListT')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <br>
    <div class="form-group" id="formDurée">
        <label for="dur"><b> Durée : </b></label>
        <input name="newDuree" type="text" value="{{$uneOffre->duree}}" class="form-control" id="dur" placeholder="Saisissez la durée">
        @error('newDuree')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <br>
    <div class="form-group" id="formDateDeb">
        <label for="dateD"><b> Date de début : </b></label>
        <input name="newDateDebut" type="date" value="{{$uneOffre->date_debut}}" class="form-control" id="dateD">
        @error('newDateDebut')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <br>
    <div class="form-group" id="formDateFin">
        <label for="dateF"><b> Date de fin : </b></label>
        <input name="newDateFin" type="date" value="{{$uneOffre->date_fin}}" class="form-control" id="dateF">
        @error('newDateFin')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <br>
    <div class="form-group" id="formVille">
        <label for="commune"><b> Ville : </b></label>
        <input name="newVille" type="text" value="{{$uneOffre->ville}}" class="form-control" id="commune" placeholder="Saisissez la ville">
        @error('newVille')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <br>
    <div class="form-group" id="formEntreprise">
        <label for="entrep"><b> Entreprise : </b></label>
        <input name="newEntreprise" type="text" class="form-control" value="{{$uneOffre->entreprise}}" id="entrep" placeholder="Saisissez le nom de l'entreprise">
        @error('newEntreprise')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <br>
    <div class="form-group" id="formMail">
        <label for="mail"><b> Mail : </b></label>
        <input name="newContact1" type="email" value="{{$uneOffre->email}}" class="form-control" id="mail" placeholder="Saisissez une adresse mail">
        @error('newContact1')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <br>
    <div class="form-group" id="formTel">
        <label for="tel"><b> Téléphone : </b></label>
        <input name="newContact2" type="tel" value="{{$uneOffre->tel}}" class="form-control" id="tel" placeholder="Saisissez un numéro de téléphone">
        @error('newContact2')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <br>
    <div class="form-group" id="formPDF">
        <label for="InputFile"><b> PDF : </b></label>
        <input type="file" name="newPdf" id="InputFile">
        @error('newPdf')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
        <br>
        <label id="SavedFile" name="pdfSaved"><i>Fichier actuel :</i> {{$uneOffre->PDF}}</label>
    </div>
    <br>
    <CENTER><button type="button" class="btn btn-primary btnModif" id="'+key+'">Modifier</button></CENTER>

    <!-- Modal de confirmation de modification -->
    <div class="modal" tabindex="-1" role="dialog" id="modalModification" style="display:none">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation de modification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir modifier cette offre ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btnAnnuler" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary btnConfModif">Modifier</button>
                </div>
            </div>
        </div>
    </div>      
{!! Form::close() !!}
<br>
<CENTER><a href="{{url()->previous()}}" class="btn btn-secondary" id="btnAnnuler">Annuler</a></CENTER>
<br><br>
@stop
@section('script')
    $(document).ready(function() 
    {

        //Affichage de la modal au clic du bouton "Modifier"
        $(document).on('click',".btnModif",function(){
            $("#modalModification").show();
        });

        //Cachement des modal au clic de la croix
        $(document).on('click',".close",function(){
            $("#modalModification").hide();
        });

        //Cachement des modal au clic du bouton "Annuler"
        $(document).on('click',".btnAnnuler",function(){
            $("#modalModification").hide();
        });
    });
@stop