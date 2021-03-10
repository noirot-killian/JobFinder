@extends('template')

@section('menu')
	@parent - Liste de mes postulation
@stop

@section('content')
<br>
<table class="table table-dark">
	<thead>
	    <tr>
	      <th scope="col">Type</th>
	      <th scope="col">Intitulé</th>
	      <th scope="col">Durée</th>
	      <th scope="col">Entreprise</th>
	      <th scope="col">Ville</th>
	      <th scope="col">Détails</th>
	    </tr>
	</thead>
  	@foreach($tab as $ligne)
  	<tbody>
	    <tr>
	    	<td>{{$ligne->type->nom}}
	      	<td>{{$ligne->intitule}}</td>
	      	<td>{{$ligne->durée}}</td>
	      	<td>{{$ligne->entreprise}}</td>
	        <td>{{$ligne->ville}}</td>
	        <td> <a href="{{route('offre.show',['id'=>$ligne->id])}}" class="btn btn-primary">Voir</a> </td>
	    </tr>
	</tbody>
  @endforeach
</table>

@stop