@extends('template')

@section('menu')
    @parent - Création d'une offre pour Admin
@stop

@section('titre')
    <main class="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5">Ajouter une <b>offre</b></h1>
        </div>
    </main>
@stop
@section('content')
<br>
<p id="info">Les champs marqués d'un astérisque (*) sont obligatoires.</p>

<style>
    
    #info
    {
        margin-left: 400px;
        font-weight: bold;
    }

    #infoDateDeb
    {
        margin-left: 400px;
        font-style: italic;
    }

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

    #btnCréer
    {
        width: 200px;
    }

    textarea 
    {
        width: 30em;
        height: 20em;
    }

</style>

{!! Form::open(['url' => route('offre.storeAdmin'), 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
	@csrf
	<div class="form-group" id="formIntitule">
        <label for="titre"><b>* Intitulé : </b></label>
        <input name="intitule" value="{{old('intitule')}}" type="text" class="form-control" id="titre" placeholder="Saisissez l'intitulé de l'offre">
        @error('intitule')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <div class="form-group" id="formDescription">
        <label for="desc"><b>* Description : </b></label>
        <textarea name="description" id="desc" class="form-control"placeholder="Saisissez une description">{{old('description')}}</textarea>
        @error('description')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <br>
    <div id="formCateg">
        <label><b>* Catégorie : </b></label>
        <div>
            {!!Form::select('listCateg', $tabCateg, null, ['class'=>'form-control']) !!}
        </div>
        @error('listCateg')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <br>
    <div id="formType">
        <label><b>* Type : </b></label>
        <div>
            {!!Form::select('listType', $tabType, null, ['class'=>'form-control']) !!}
        </div>
        @error('listType')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <br>
    <div class="form-group" id="formDurée">
        <label for="dur"><b> Durée : </b></label>
        <input name="duree" type="text" value="{{old('duree')}}" class="form-control" id="dur" placeholder="Saisissez la durée">
        @error('duree')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <br>
    <div class="form-group" id="formDateDeb">
        <label for="dateD"><b>* Date de début : </b></label>
        <input name="dateDebut" type="date" value="{{old('dateDebut')}}" class="form-control" id="dateD">
        @error('dateDebut')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <p id="infoDateDeb">La date de début doit être supérieure à la date du jour.</p>
    <div class="form-group" id="formDateFin">
        <label for="dateF"><b> Date de fin : </b></label>
        <input name="dateFin" type="date" value="{{old('dateFin')}}" class="form-control" id="dateF">
        @error('dateFin')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <br>
    <div class="form-group" id="formVille">
        <label for="commune"><b>* Ville : </b></label>
        <input name="ville" type="text" value="{{old('ville')}}" class="form-control" id="commune" placeholder="Saisissez la ville">
        @error('ville')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <br>
    <div class="form-group" id="formEntreprise">
        <label for="entrep"><b>* Entreprise : </b></label>
        <input name="entreprise" type="text" class="form-control" value="{{old('entreprise')}}" id="entrep" placeholder="Saisissez le nom de l'entreprise">
        @error('entreprise')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <br>
    <div class="form-group" id="formMail">
        <label for="mail"><b> Mail : </b></label>
        <input name="contact1" type="email" value="{{old('contact1')}}" class="form-control" id="mail" placeholder="Saisissez une adresse mail">
        @error('contact1')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <br>
    <div class="form-group" id="formTel">
        <label for="tel"><b> Téléphone : </b></label>
        <input name="contact2" type="tel" value="{{old('contact2')}}" class="form-control" id="tel" placeholder="Saisissez un numéro de téléphone">
        @error('contact2')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <br>
    <div class="form-group" id="formPDF">
        <label for="InputFile"><b> PDF : </b></label>
        <input type="file" name="pdf" id="InputFile">
        @error('pdf')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <br>
    <CENTER><button type="submit" class="btn btn-primary" id="btnCréer">Créer</button></CENTER>
    <br><br>
{!! Form::close() !!}

@stop