@extends('template')

@section('menu')
	@parent - Liste des offres
@stop

@section('titre')
    <main class="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5">Liste des <b>offres</b> </h1>
        </div>
    </main>
@stop
@section('content')
<style>
	table
	{
		margin-left: 20px;
		margin-right: 20px;
	}
</style>
<br>
<table id="tabOffres" class="table table-dark">
	<thead>
	    <tr>
	      <th scope="col">Type</th>
	      <th scope="col">Intitulé</th>
	      <th scope="col">Durée</th>
	      <th scope="col">Date de début</th>
	      <th scope="col">Entreprise</th>
	      <th scope="col">Ville</th>
	      <th scope="col">Favoris</th>
	      <th scope="col">Détails</th>
	      <th scope="col">Modifier</th>
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
		        @if($ligne->profil_favoriser()->find(Auth::user()->profil_id))
		        	<i class="fas fa-star" id="{{$ligne->id}}"></i>
		        @else
		        	<i class="far fa-star" id="{{$ligne->id}}"></i>
		        @endif
		        </td>
		        <td> <a href="{{route('offre.show',['id'=>$ligne->id])}}" class="btn btn-primary">Voir</a> </td>
		        <td> <a href="{{route('offre.edit',['id'=>$ligne->id])}}" class="btn btn-secondary">Modifier</a> </td>
		    </tr>	
  		@endforeach
  	</tbody>
</table>
@stop

@section('script')
  $(document).ready(function() 
  {
  	
  	var table = $('#tabOffres').DataTable({
    	language: 
    	{
        	url: "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
    	}
	});

    /* Au clic d'une étoile, on affiche l'autre et inversement (pour ajouter/retirer une offre des favoris) */

    $(".fa-star").click(function(e){
      
      $(this).toggleClass('fas far'); //Adds 'fas', removes 'far' and vice-versa
      
      if($(this).hasClass('fas'))
      {
      	//appel de notre API
		$.ajax({

			type:"POST",
		             
			url:"http://localhost/JobFinder/public/offre/addFavorite/"+$(this).attr("id")+"/"+{{Auth::user()->profil_id}},

			data:{ _token: '{{csrf_token()}}'},

			success:function(data)
			{
				
			}
		});
      }
      else
      {
      	//appel de notre API
		$.ajax({

			type:"POST",
		             
			url:"http://localhost/JobFinder/public/offre/removeFavorite/"+$(this).attr("id")+"/"+{{Auth::user()->profil_id}},

			data:{ _token: '{{csrf_token()}}'},

			success:function(data)
			{
				
			}
		});
      }
    });
  });
@stop