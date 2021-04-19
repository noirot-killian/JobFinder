@extends('template')

@section('menu')
	@parent - Importer fichier Excel
@stop

@section('titre')
    <main class="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5">Importer des <b>profils</b></h1>
        </div>
    </main>
@stop

@section('content')
<style>

	#content
	{
		margin-right: 200px;
		margin-left: 200px;
	}
	#consigne
	{
		font-size: 25px;
	}
	#prérequis
	{
		font-size: 20px;
	}
	form
	{
		font-size: 18px;
	}
	.btn-primary
	{
		font-size: 18px;
	}

</style>
<div id="content">

	<br><br><br>

	<p id="consigne"><strong>Sélectionner un fichier Excel (.xlsx) pour importer les données dans la table "profils".</strong></p>

	<div id="prérequis">
		<p><strong> Structure du document :</strong></p>
		<ul>
		<li>Les colonnes sont, dans l'ordre, "nom, prenom, adresse, ville, CP, tel, CV, isFirstCo, isAdmin, isNotified, isContactable, categorie_id".</li> 
		<li>La colonne "isFirstCo" doit obligatoirement avoir la valeur 0.</li>
		<li>Les colonnes "tel" et "CV" peuvent être nulles.</li>
		<li>Les colonnes "isAdmin", "isNotified" et "isContactable" sont de type booléen et doivent donc être remplies avec la valeur "0" ou "1".</li>
		<li>La colonne "categorie_id" doit être remplie avec soit la valeur "26" (Développement) soit la valeur "27" (Réseau).</li>
		</ul>
	</div>
	<br>
	<CENTER>
		<form method="POST" action="{{ route('profil.import') }}" enctype="multipart/form-data" >
			{{ csrf_field() }}
			<input type="file" name="fichier">
			<br><br>
			<button class="btn btn-primary" type="submit">Importer</button>
		</form>
	</CENTER>
</div>
@stop