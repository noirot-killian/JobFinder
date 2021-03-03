@extends('template')

@section('menu')
	@parent - Liste des offres
@stop

@section('content')

<br>
<table class="table table-dark">
	<thead>
	    <tr>
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
	      	<td>{{$ligne->titre}}</td>
	      	<td>{{$ligne->description}}</td>
	      	<td>{{$ligne->durée}}</td>
	        <td>{{$ligne->ville}}</td>
	        <td>{{$ligne->entreprise}}</td>
	      	<!-- <td> <a href="{{route('stages-display',['id'=>$ligne])}}" class="btn btn-primary">Voir</a> </td>
	      	<td> <a href="{{route('stages-edit',['id'=>$ligne])}}" class="btn btn-secondary">Edit</a> </td>
	      	<td> 
	          <button type="button" class="btn btn-danger" data-id="{{$ligne->id}}" data-toggle="modal" data-target="#del{{$ligne->id}}">
	  				  Delete
	          </button>
	      	</td> -->	   	
	    </tr>
  	</tbody>
	  <!-- Modal -->
	<div class="modal fade" id="del{{$ligne->id}}" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="ModalLabel">Confirmation de suppression</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        Êtes-vous sûr(e) de vouloir supprimer ce stage ?
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>

	        {!! Form::open(['url'=> route('stages-delete',['id'=>$ligne->id]), 'method' => 'delete']) !!}
	          <input class="btn btn-danger" type="submit" value="Delete" />
	        {!! Form::close() !!}

	      </div>
	    </div>
	  </div>
	</div>
  @endforeach
</table>

@stop