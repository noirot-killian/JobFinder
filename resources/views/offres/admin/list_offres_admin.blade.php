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
<table id="tabOffresAdmin" class="table table-dark">
	<thead>
	    <tr>
	      <th scope="col">Type</th>
	      <th scope="col">Intitulé</th>
	      <th scope="col">Durée</th>
	      <th scope="col">Date de début</th>
	      <th scope="col">Entreprise</th>
	      <th scope="col">Ville</th>
	      <th scope="col">Détails</th>
	      <th scope="col">Modifier</th>
	      <th scope="col">Archiver</th>
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
		        	<a href="{{route('offre.edit',['id'=>$ligne->id])}}" class="btn btn-secondary">Modifier</a> 
		        </td>
		        <td> 
          			<button type="button" class="btn btn-danger btnArchiv" id="{{$ligne->id}}">Archiver</button>
      			</td>
		    </tr>	
		    <!-- Modal de confirmation -->
			<div class="modal" tabindex="-1" role="dialog" id="modalArchivage{{$ligne->id}}" style="display:none">
				<div class="modal-dialog" role="document">
			    	<div class="modal-content">
			      		<div class="modal-header">
			        		<h5 class="modal-title">Confirmation d'archivage</h5>
			        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          			<span aria-hidden="true">&times;</span>
			        		</button>
			      		</div>
			      		<div class="modal-body">
			        		<p>Êtes-vous sûr de vouloir archiver cette offre ?</p>
			      		</div>
			      		<div class="modal-footer">
			        		<button type="button" class="btn btn-primary btnAnnuler" data-dismiss="modal">Annuler</button>
			        		<a href="{{route('offre.archive',['id'=>$ligne->id])}}" class="btn btn-danger">Archiver</a>
			      		</div>
			    	</div>
			  	</div>
			</div>
  		@endforeach
  	</tbody>
</table>


@stop

@section('script')
  	$(document).ready(function() 
  	{
	  	var table = $('#tabOffresAdmin').DataTable({
	    	language: 
	    	{
	        	url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
	    	}
		});

		//Affichage de la modal au clic du bouton "Archiver"
    	$(document).on('click',".btnArchiv",function(){
      		var id = $(this).attr('id');
      		$("#modalArchivage"+id).show();
    	});

    	//Cachement de la modal au clic de la croix
    	$(document).on('click',".close",function(){
    		var id = $(".btnArchiv").attr('id');
      		$("#modalArchivage"+id).hide();
    	});

    	//Cachement de la modal au clic du bouton "Annuler"
    	$(document).on('click',".btnAnnuler",function(){
    		var id = $(".btnArchiv").attr('id');
      		$("#modalArchivage"+id).hide();
    	});
	});
@stop