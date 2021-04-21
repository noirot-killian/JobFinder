
<div class="col-md-3">
	<div class="list-group">
		@foreach($contacts as $ligne)
			<a class="list-group-item" style="color: #0892A7; font-size: 18px;" href="{{route('message.show',['id'=>$ligne->id])}}">
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