@extends('template')

@section('menu')
	@parent - Liste des users pour l'Admin
@stop

@section('titre')
    <main class="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5">Liste des <b>utilisateurs</b> </h1>
        </div>
    </main>
@stop
@section('content')
<br>
<table id="tabUsers" class="table table-dark">
	<thead>
	    <tr>
	      <th scope="col">Nom</th>
	      <th scope="col">Prénom</th>
	      <th scope="col">Catégorie</th>
        <th scope="col">S'est déjà connecté O/N</th>
	      <th scope="col">Admin O/N</th>
	      <th scope="col">Notifié O/N</th>
	      <th scope="col">Joignable O/N</th>
	      <th scope="col">Profil</th>
	      <th scope="col">Admin</th>
	      <th scope="col">Supprimer</th>
	    </tr>
	</thead>
	<tbody>
  		@foreach($tab as $ligne)
		    <tr>
		      	<td>{{$ligne->nom}}</td>
		      	<td>{{$ligne->prenom}}</td>
            <td>{{$ligne->categorie->designation}}</td>
            <td>
              @if($ligne->isFirstCo == 0)
                Oui
              @else
                Non
              @endif
            </td>
		      	<td>
              @if($ligne->isAdmin == 0)
                Non
              @else
                Oui
              @endif
            </td>
            <td>
              @if($ligne->isNotified == 0)
                Non
              @else
                Oui
              @endif
            </td>
		      	<td>
              @if($ligne->isContactable == 0)
                Non
              @else
                Oui
              @endif
            </td>
		        <td> 
		        	<a href="{{route('profil.show',['id'=>$ligne->id])}}" class="btn btn-primary">Voir</a> 
		        </td>
		        <td>
              @if($ligne->isAdmin == 0)
                <button type="button" class="btn btn-secondary btnNomi" id="'+key+'">Nommer admin</button>
              @else
                <button type="button" class="btn btn-danger btnRemove" id="'+key+'">Retirer admin</button>
              @endif
		        </td>
		        <td> 
          			<button type="button" class="btn btn-danger btnSupp" id="'+key+'">Supprimer</button>
      			</td>
		    </tr>	
  		@endforeach
  	</tbody>
</table>

<!-- Modal de confirmation de nomination -->
<div class="modal" tabindex="-1" role="dialog" id="modalNomination" style="display:none">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Confirmation de nomination au poste d'administrateur</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Êtes-vous sûr de vouloir nommer cet utilisateur administrateur du site ?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btnAnnuler" data-dismiss="modal">Annuler</button>
            <a href="{{route('profil.nominate',['id'=>$ligne->id])}}" class="btn btn-primary">Confirmer</a>
          </div>
      </div>
    </div>
</div>

<!-- Modal de confirmation de dénomination -->
<div class="modal" tabindex="-1" role="dialog" id="modalDénomination" style="display:none">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Confirmation de retrait au poste d'administrateur</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Êtes-vous sûr de vouloir retirer à cet utilisateur ces droits d'accès administrateur ?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btnAnnuler" data-dismiss="modal">Annuler</button>
            <a href="{{route('profil.remove',['id'=>$ligne->id])}}" class="btn btn-danger">Confirmer</a>
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
        		<p>Êtes-vous sûr de vouloir supprimer cet utilisateur ainsi que toutes les offres qu'il a proposé ?</p>
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-primary btnAnnuler" data-dismiss="modal">Annuler</button>
        		{!! Form::open(['url'=> route('profil.destroy',['id'=>$ligne->id]), 'method' => 'delete']) !!}
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
	  	var table = $('#tabUsers').DataTable({
	    	language: 
	    	{
	        	url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
	    	}
		});

		//Affichage de la modal au clic du bouton "Supprimer"
    	$(document).on('click',".btnSupp",function(){
      		$("#modalSuppression").show();
    	});

      //Affichage de la modal au clic du bouton "Supprimer"
      $(document).on('click',".btnNomi",function(){
          $("#modalNomination").show();
      });

      //Affichage de la modal au clic du bouton "Supprimer"
      $(document).on('click',".btnRemove",function(){
          $("#modalDénomination").show();
      });

    	//Cachement des modal au clic de la croix
    	$(document).on('click',".close",function(){
      		$("#modalSuppression").hide();
          $("#modalNomination").hide();
          $("#modalDénomination").hide();
    	});

    	//Cachement des modal au clic du bouton "Annuler"
    	$(document).on('click',".btnAnnuler",function(){
      		$("#modalSuppression").hide();
          $("#modalNomination").hide();
          $("#modalDénomination").hide();
    	});
	});
@stop