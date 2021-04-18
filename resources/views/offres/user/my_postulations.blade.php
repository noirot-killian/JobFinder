@extends('template')

@section('menu')
	@parent - Liste des offres favoris
@stop

@section('titre')
    <main class="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5">Mes <b>postulations</b> </h1>
        </div>
    </main>
@stop
@section('content')
<br>
<table id="tabOffresPostu" class="table table-dark">
	<thead>
	    <tr>
	      <th scope="col">Type</th>
	      <th scope="col">Intitulé</th>
	      <th scope="col">Durée</th>
	      <th scope="col">Date de début</th>
	      <th scope="col">Entreprise</th>
	      <th scope="col">Ville</th>
	      <th scope="col">Détails</th>
	      <th scope="col">Retirer</th>
	    </tr>
	</thead>
	<tbody>
  		@foreach($tabPostu as $ligne)
		    <tr class="tr">
		    	<td>{{$ligne->type->nom}}</td>
		      	<td>{{$ligne->intitule}}</td>
		      	<td>{{$ligne->duree}}</td>
		      	<td>{{\Carbon\Carbon::parse($ligne->date_debut)->translatedFormat('d/m/Y')}}</td>
		      	<td>{{$ligne->entreprise}}</td>
		        <td>{{$ligne->ville}}</td>
		        <td> <a href="{{route('offre.show',['id'=>$ligne->id])}}" class="btn btn-primary">Voir</a> </td>
		        <td class="td"> <i class="fas fa-times" id="{{$ligne->id}}"></i> </td>
		    </tr>	
  		@endforeach
  	</tbody>
</table>

<!-- Modal de confirmation d'annulation de postulation -->
<div class="modal" tabindex="-1" role="dialog" id="modalAnnulationPostulation" style="display:none">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation d'annulation de postulation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir annuler votre postulation à cette offre ? L'offreur ne pourra plus accéder à votre profil et vous contacter.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btnAnnuler" data-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-danger btnConfAnnulPostu">Annuler la postulation</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('script')
  $(document).ready(function() 
  {

  	var table = $('#tabOffresPostu').DataTable({
    	language: 
    	{
        	url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
    	}
	});

	//Affichage de la modal au clic de la croix
    $(document).on('click',".fa-times",function(){
        $("#modalAnnulationPostulation").show();
    });

    //Cachement des modal au clic de la croix
    $(document).on('click',".close",function(){
        $("#modalAnnulationPostulation").hide();
    });

    //Cachement des modal au clic du bouton "Annuler"
    $(document).on('click',".btnAnnuler",function(){
        $("#modalAnnulationPostulation").hide();
    });

    /* Au clic du bouton de confirmation "Annuler la postulation" */
    $(".btnConfAnnulPostu").click(function(e)
    {
    	var event = $(this);
    	
    	//appel de notre API

		$.ajax({

			type:"POST",
		             
			url:"http://localhost/JobFinder/public/offre/removePostulation/"+{{$ligne->id}}+"/"+{{Auth::user()->profil_id}},

			data:{ _token: '{{csrf_token()}}'},

			success:function(data)
			{
				$("#modalAnnulationPostulation").hide();
				$(".tr").addClass("ligne-rouge").delay("1").fadeOut(); //suppression de la ligne visuelle
			}
		});
    });
  });
@stop