@extends('template')

@section('menu')
    @parent - Messagerie
@stop

@section('titre')
    <main class="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5"><b>Messagerie</b></h1>
        </div>
    </main>
@stop
@section('content')

<div class="container">
	<div class="row">
		@include('messages/contacts',['contacts' => $contacts, 'nbUnread' => $nbUnread])
		<div class="col-md-7">
			<div class="card">
				<div class="card-header">
					<strong>{{$interlocuteur->nom}} {{$interlocuteur->prenom}}</strong>
				</div>
				<div class="card-body">
					@foreach($messages as $message)
						<div class="row">
							<div class="col-md-10 {{$message->profil_emetteur->id !== $interlocuteur->id ? 'offset-md-10 text-right' : ''}}">
								<p>
									<strong>
										{{$message->profil_emetteur->id !== $interlocuteur->id ? 'Moi' : $message->profil_emetteur->nom.' '.$message->profil_emetteur->prenom}}
									</strong>
									<br>
									{!! nl2br(e($message->contenu)) !!}
								</p>
							</div>
						</div>
					@endforeach
					<form action="" method="post">
						{{csrf_field()}}
						<div class="form-group">
							<textarea name="content" value="{{old('content')}}" class="form-control" placeholder="Écrivez votre message..."></textarea>
							@error('content')
            					<div class="alert alert-danger"> {{ $message }} </div> 
       	 					@enderror
						</div>
						<br>
						<button class="btn btn-primary" type="submit">Envoyer</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@stop