<div class="col-md-3">
	<div class="list-group">
		@foreach($contacts as $ligne)

			<a class="list-group-item" href="{{route('message.show',['id'=>$ligne->id])}}">
				@if(isset($nbUnread[$ligne->id]))
					<strong>
						{{$ligne->nom}} {{$ligne->prenom}}
						({{$nbUnread[$ligne->id]}})
					</strong>
				@else
					{{$ligne->nom}} {{$ligne->prenom}}
				@endif
			</a>
		@endforeach
	</div>
</div>