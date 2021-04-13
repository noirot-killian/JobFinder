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

    /* Au clic de la croix, on retire la postulation à l'offre */

    $(".fa-times").click(function(e)
    {
    	var event = $(this);
    	
    	//appel de notre API

		$.ajax({

			type:"POST",
		             
			url:"http://localhost/JobFinder/public/offre/removePostulation/"+$(this).attr("id")+"/"+{{Auth::user()->profil_id}},

			data:{ _token: '{{csrf_token()}}'},

			success:function(data)
			{
				event.parent().parent().addClass("ligne-rouge").delay("1").fadeOut(); //suppression de la ligne visuelle
			}
		});
    });
  });
@stop