@extends('template')

@section('menu')
    @parent - Création d'une offre
@stop

@section('content')
{!! Form::open(['url' => route('offre.store'), 'method' => 'post']) !!}
	@csrf
	<div class="form-group">
        <label for="nom">Intitulé</label>
            <input name="intitule" type="text" class="form-control" id="intitule" placeholder="Saisissez l'intitulé de l'offre">
    </div>
    <div class="form-group">
        <label for="nom">Description</label>
            <input name="description" type="text" class="form-control" id="description" placeholder="Saisissez une description">
    </div>
    <div class="form-group">
        <label for="nom">Durée</label>
            <input name="duree" type="text" class="form-control" id="duree" placeholder="Saisissez la durée de l'offre">
    </div>
    <div class="form-group">
        <label for="nom">Ville</label>
            <input name="ville" type="text" class="form-control" id="ville" placeholder="Saisissez la ville où se trouve l'entreprise">
    </div>
    <div class="form-group">
        <label for="nom">Entreprise</label>
            <input name="entreprise" type="text" class="form-control" id="entreprise" placeholder="Saisissez le nom de l'entreprise">
    </div>
    <div class="form-group">
        <label for="nom">Contact</label>
            <input name="contact" type="text" class="form-control" id="contact" placeholder="Saisissez une adresse mail">
    </div>
    <div class="form-group">
        <label for="exampleInputFile">PDF</label>
        <input type="file" name="pdf" id="exampleInputFile">
    </div>
    {{ csrf_field() }}
    <button type="submit" class="btn btn-primary">Créer</button>
{!! Form::close() !!}
@stop