@extends('template')

@section('menu')
    @parent - Création d'un profil
@stop

@section('titre')
    <main class="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5">Ajouter un <b>profil</b></h1>
        </div>
    </main>
@stop
@section('content')
{!! NoCaptcha::renderJs() !!}
<form action="{{route('profil.store')}}" method="post"> 
    @csrf
  <style>
    
    #formNom, #formPDF,#formPrenom,#formTel,#formVille,#formAdresse,#formMdp,#formConfirmMdp,#formPseudo,#formEmail,#formCp,#formCaptcha,#formCateg
    {
        margin-top: 20px;
        margin-left: 400px;
        margin-right: 400px;
    }

    #formCateg,
    {
        margin-left: 400px;
        margin-right: 900px;
    }
    #formCaptcha
    {
        margin: 0 auto;
        width: 100px;
    }

    textarea 
    {
        width: 30em;
        height: 20em;
    }

</style>

{!! Form::open(['url' => route('profil.store'), 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
  @csrf
  <div class="form-group" id="formNom">
        <label for="nom"><b> Nom : </b></label>
        <input name="nom" value="{{old('nom')}}" type="text" class="form-control" id="nom" placeholder="Saisissez le nom du profil">
        @error('nom')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <div class="form-group" id="formPrenom">
        <label for="prenom"><b> Prenom : </b></label>
        <input name="prenom" value="{{old('prenom')}}" type="text" class="form-control" id="prenom" placeholder="Saisissez le prenom du profil">
        @error('prenom')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <div class="form-group" id="formEmail">
        <label for="email"><b> Email : </b></label>
        <input name="email" value="{{old('email')}}" type="text" class="form-control" id="email" placeholder="Saisissez l'adresse email du profil">
        @error('email')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <div class="form-group" id="formPseudo">
        <label for="name"><b> Pseudo : </b></label>
        <input name="name" value="{{old('name')}}" type="text" class="form-control" id="name" placeholder="Saisissez le pseudo du profil">
        @error('name')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <div class="form-group" id="formMdp">
                            <label for="password" class="col-md-4 col-form-label text-md-right"><b>{{ __('Mot de passe :') }}</b></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Saisissez le mot de passe">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group" id="formConfirmMdp">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right"><b>{{ __('Confirmation mot de passe :') }}</b></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmer le mot de passe">
                            </div>
                        </div>
                        <div class="form-group" id="formVille">
        <label for="commune"><b> Ville : </b></label>
        <input name="ville" type="text" value="{{old('ville')}}" class="form-control" id="commune" placeholder="Saisissez la ville">
        @error('ville')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <div class="form-group" id="formCp">
        <label for="commune"><b> Code Postal : </b></label>
        <input name="cp" type="text" value="{{old('cp')}}" class="form-control" id="commune" placeholder="Saisissez le Code postal">
        @error('cp')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <div class="form-group" id="formAdresse">
        <label for="commune"><b> Adresse : </b></label>
        <input name="adresse" type="text" value="{{old('adresse')}}" class="form-control" id="commune" placeholder="Saisissez l'adresse">
        @error('adresse')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <div class="form-group" id="formTel">
        <label for="tel"><b> Téléphone : </b></label>
        <input name="tel" type="tel" value="{{old('tel')}}" class="form-control" id="tel" placeholder="Saisissez un numéro de téléphone">
        @error('tel')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <br>
    <div class="form-group" id="formPDF">
        <label for="InputFile"><b> PDF : </b></label>
        <input type="file" name="pdf" value="{{old('pdf')}}" id="InputFile">
        @error('pdf')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
     <div id="formCateg">
        <label><b> Catégorie : </b></label>
        <div>
            {!!Form::select('listCateg', $tabCateg, null, ['class'=>'form-control']) !!}
        </div>
        @error('listCateg')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <br>
       <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}" id="formCaptcha">
                <label class="col-md-4 control-label">Captcha</label>
                      <div class="col-md-6">
                            {!! app('captcha')->display() !!}
                              @if ($errors->has('g-recaptcha-response'))
                                <span class="help-block">
                                  <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                </span>
                              @endif
                        </div>
      </div>
<br>
  <CENTER><button type="submit" class="btn btn-primary">Créer</button></CENTER>
  {!! Form::close() !!}
</form>
@stop