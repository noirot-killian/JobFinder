@extends('template')

@section('menu')
	@parent - Liste des offres pour l'Admin
@stop

@section('titre')
    <main class="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5">Liste des <b>offres</b> </h1>
        </div>
    </main>
@stop
@section('content')
<br>
<table id="tabOffresAValider" class="table table-dark">
	<thead>
	    <tr>
	      <th scope="col">Type</th>
	      <th scope="col">Intitulé</th>
	      <th scope="col">Durée</th>
	      <th scope="col">Date de début</th>
	      <th scope="col">Entreprise</th>
	      <th scope="col">Ville</th>
	      <th scope="col">Détails</th>
	      <th scope="col">Valider</th>
	      <th scope="col">Supprimer</th>
	    </tr>
	</thead>
	<tbody>
  		@foreach($tab as $ligne)
		    <tr>
		    	<td>{{$ligne->type->nom}}</td>
		      	<td>{{$ligne->intitule}}</td>
		      	<td>{{$ligne->duree}}</td>
		      	<td>{{\Carbon\Carbon::parse($ligne->date_debut)->translatedFormat('d/m/Y')}}</td>
		      	<td>{{$ligne->entreprise}}</td>
		        <td>{{$ligne->ville}}</td>
		        <td> 
		        	<a href="{{route('offre.showAdmin',['id'=>$ligne->id])}}" class="btn btn-secondary">Détails</a> 
		        </td>
		        <td> 
		        	<button type="button" class="btn btn-primary btnValid" id="'+key+'">Valider</button> 
		        </td>
		        <td> 
          			<button type="button" class="btn btn-danger btnSupp" id="'+key+'">Supprimer</button>
      			</td>
		    </tr>	
  		@endforeach
  	</tbody>
</table>

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
        		<button type="button" class="btn btn-secondary btnAnnuler" data-dismiss="modal">Annuler</button>
        		<a href="{{route('offre.validate',['id'=>$ligne->id])}}" class="btn btn-primary">Valider</a>
      		</div>
    	</div>
  	</div>
</div>

<!-- Modal de confirmation de suppression -->
<div class="modal" tabindex="-1" role="dialog" id="modalSuppression" style="display:none">
	<div class="modal-dialog" role="document">
    	<div class="modal-content">
      		<div class="modal-header">
        		<h5 class="modal-title">Confirmation de suppression</h5>
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          			<span aria-hidden="true">&times;</span>
        		</button>
      		</div>
      		<div class="modal-body">
        		<p>Êtes-vous sûr de vouloir supprimer cette offre ?</p>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-primary btnAnnuler" data-dismiss="modal">Annuler</button>
        		{!! Form::open(['url'=> route('offre.destroy',['id'=>$ligne->id]), 'method' => 'delete']) !!}
          			<input class="btn btn-danger" type="submit" value="Supprimer" />
        		{!! Form::close() !!}
      		</div>
    	</div>
  	</div>
</div>
@stop

@section('script')
  	$(document).ready(function() 
  	{
	  	var table = $('#tabOffresAValider').DataTable({
	    	language: 
	    	{
	        	url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
	    	}
		});

		//Affichage de la modal au clic du bouton "Valider"
    	$(document).on('click',".btnValid",function(){
      		$("#modalValidation").show();
    	});

		//Affichage de la modal au clic du bouton "Supprimer"
    	$(document).on('click',".btnSupp",function(){
      		$("#modalSuppression").show();
    	});

    	//Cachement des modal au clic de la croix
    	$(document).on('click',".close",function(){
      		$("#modalSuppression").hide();
      		$("#modalValidation").hide();
    	});

    	//Cachement des modal au clic du bouton "Annuler"
    	$(document).on('click',".btnAnnuler",function(){
      		$("#modalSuppression").hide();
      		$("#modalValidation").hide();
    	});
	});
@stop