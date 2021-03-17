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
	      <th scope="col">Durée</th>
	      <th scope="col">Entreprise</th>
	      <th scope="col">Ville</th>
	      <th scope="col">Favoris</th>
	      <th scope="col">Détails</th>
	    </tr>
	</thead>
  	@foreach($tab as $ligne)
  	<tbody>
	    <tr>
	    	<td>{{$ligne->type->nom}}</td>
	      	<td>{{$ligne->intitule}}</td>
	      	<td>{{$ligne->durée}}</td>
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
	    </tr>
	</tbody>
  @endforeach
</table>
@stop

@section('script')
  $(document).ready(function() 
  {
  	
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