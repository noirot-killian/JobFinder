@extends('template')

@section('menu')
	@parent - Liste des offres créées par l'utilisateur
@stop

@section('titre')
    <main class="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5">Mes <b>offres</b> </h1>
        </div>
    </main>
@stop
@section('content')
<br>
<table id="tabOffresCréées" class="table table-dark">
	<thead>
	    <tr>
	      <th scope="col">Type</th>
	      <th scope="col">Intitulé</th>
	      <th scope="col">Durée</th>
	      <th scope="col">Date de début</th>
	      <th scope="col">Entreprise</th>
	      <th scope="col">Ville</th>
	      <th scope="col">Détails</th>
	      <th scope="col">Postulants</th>
	    </tr>
	</thead>
	<tbody>
  		@foreach($tabOffers as $ligne)
		    <tr class="tr">
		    	<td>{{$ligne->type->nom}}</td>
		      	<td>{{$ligne->intitule}}</td>
		      	<td>{{$ligne->duree}}</td>
		      	<td>{{\Carbon\Carbon::parse($ligne->date_debut)->translatedFormat('d/m/Y')}}</td>
		      	<td>{{$ligne->entreprise}}</td>
		        <td>{{$ligne->ville}}</td>
		        <td> <a href="{{route('offre.show',['id'=>$ligne->id])}}" class="btn btn-secondary">Voir</a> </td>
		        <td> <a href="{{route('profil.applicants',['id'=>$ligne->id])}}" class="btn btn-primary">Voir</a> </td>
		    </tr>	
  		@endforeach
  	</tbody>
</table>
@stop
@section('script')
  $(document).ready(function() 
  {

  	var table = $('#tabOffresCréées').DataTable({
    	language: 
    	{
        	url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
    	}
	});

  });
@stop