@extends('template')

@section('menu')
	@parent - Liste des offres
@stop

@section('content')

<br>
<table class="table table-dark">
	<thead>
	    <tr>
	      <th scope="col">Type</th>
	      <th scope="col">Intitulé</th>
	      <th scope="col">Description</th>
	      <th scope="col">Durée</th>
	      <th scope="col">Ville</th>
	      <th scope="col">Entreprise</th>
	      <th scope="col">Voir</th>
	      <th scope="col">Modifier</th>
	      <th scope="col">Supprimer</th> 
	    </tr>
	</thead>
  	@foreach($tab as $ligne)
  	<tbody>
	    <tr>
	    	<td>{{$ligne->type->nom}}
	      	<td>{{$ligne->intitule}}</td>
	      	<td>{{$ligne->description}}</td>
	      	<td>{{$ligne->durée}}</td>
	        <td>{{$ligne->ville}}</td>
	        <td>{{$ligne->entreprise}}</td>
	    <tr>
	</tbody>
  @endforeach
</table>

@stop