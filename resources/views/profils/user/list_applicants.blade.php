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
	      <th scope="col">Profil</th>
	    </tr>
	</thead>
	<tbody>
  		@foreach($tabPostulants as $ligne)
		    <tr>
		      	<td>{{$ligne->nom}}</td>
		      	<td>{{$ligne->prenom}}</td>
            <td>{{$ligne->categorie->designation}}</td>
		        <td> 
		        	<a href="{{route('profil.show',['id'=>$ligne->id])}}" class="btn btn-primary">Voir</a> 
		        </td>
		    </tr>	
  		@endforeach
  	</tbody>
</table>

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
	 });
@stop