@extends('template')
@section('titre')
    <main class="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5">Connexion <b>réussie</b></h1>
        </div>
    </main>
@stop
@section('content')
<style>
    
    #formConection
    {
        margin-top: 50px;
        margin-left: 500px;
        font-size: 40px;
        font-family: serif;
    }
    #formConection
    {
         font-weight:20px;
    }
  

</style>
<div class="container" id="formConection">
    <div class="row justify-content-center">
        <div class="col-md-8"id="formConection2">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                         Bonjour {{auth::user()->profil->prenom}} {{ __('vous êtes connecté !') }}
        </div>
    </div>
</div>
@endsection
