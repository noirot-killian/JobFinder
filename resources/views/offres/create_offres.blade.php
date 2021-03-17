@extends('template')

@section('menu')
    @parent - Création d'une offre
@stop

@section('content')
{!! Form::open(['url' => route('offre.store'), 'method' => 'post']) !!}
	@csrf
	<div class="form-group">
        <label for="nom">Intitulé :</label>
        <input name="intitule" type="text" class="form-control" id="intitule" placeholder="Saisissez l'intitulé de l'offre">
    </div>
    <div class="form-group">
        <label for="desc">Description :</label>
        <input name="description" type="text" class="form-control" id="desc" placeholder="Saisissez une description">
    </div>
    <div>
        <label for="categorie"></label>
        <div>
            {!!Form::select('listCateg', $tabCateg, null, ['class'=>'form-control']) !!}
        </div>
    </div>
    <div class="form-group">
        <label for="dur">Durée :</label>
        <input name="duree" type="text" class="form-control" id="dur" placeholder="Saisissez la durée">
    </div>
    <div class="form-group">
        <label for="dateD">Date de début :</label>
        <input name="dateDeb" type="date" class="form-control" id="dateD">
    </div>
    <div class="form-group">
        <label for="dateF">Date de fin :</label>
        <input name="dateFin" type="date" class="form-control" id="dateF">
    </div>
    <div class="form-group">
        <label for="ville">Ville :</label>
        <input name="ville" type="text" class="form-control" id="ville" placeholder="Saisissez la ville">
    </div>
    <div class="form-group">
        <label for="entrep">Entreprise :</label>
        <input name="entreprise" type="text" class="form-control" id="entrep" placeholder="Saisissez le nom de l'entreprise">
    </div>
    <div class="form-group">
        <label for="mail">Mail :</label>
        <input name="contact1" type="email" class="form-control" id="mail" placeholder="Saisissez une adresse mail">
    </div>
    <div class="form-group">
        <label for="tel">Téléphone :</label>
        <input name="contact2" type="text" class="form-control" id="tel" placeholder="Saisissez un numéro de téléphone">
    </div>
    <div class="form-group">
        <label for="exampleInputFile">PDF :</label>
        <input type="file" name="pdf" id="exampleInputFile">
    </div>
    <button type="submit" class="btn btn-primary">Créer</button>
{!! Form::close() !!}
@stop