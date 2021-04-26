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
<br>
<p id="info">Les champs marqués d'un astérisque (*) sont obligatoires.</p>

{!! NoCaptcha::renderJs() !!}
  <style>
    
    #info
    {
        margin-left: 400px;
        font-weight: bold;
    }

    #formNom, #formPDF,#formPrenom,#formTel,#formVille,#formAdresse,#formMdp,#formConfirmMdp,#formPseudo,#formEmail,#formCp,#formCaptcha,#formCateg
    {
        margin-top: 20px;
        margin-left: 400px;
        margin-right: 400px;
    }

    #formCateg
    {
        margin-left: 400px;
        margin-right: 900px;
    }

    #booleen
    {
        margin-left: 400px;
        margin-right: 500px;
    }

    #formCaptcha
    {
        margin: 0 auto;
        width: 50px;
    }

    textarea 
    {
        width: 30em;
        height: 20em;
    }

</style>

{!! Form::open(['url' => route('profil.store'), 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
  @csrf
  <div id="formCateg">
        <label><b>* Catégorie : </b></label>
        <div>
            {!!Form::select('listCateg', $tabCateg, null, ['class'=>'form-control']) !!}
        </div>
        @error('listCateg')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
  <div class="form-group" id="formNom">
        <label for="nom"><b>* Nom : </b></label>
        <input name="nom" value="{{old('nom')}}" type="text" class="form-control" id="nom" placeholder="Saisissez le nom du profil">
        @error('nom')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <div class="form-group" id="formPrenom">
        <label for="prenom"><b>* Prenom : </b></label>
        <input name="prenom" value="{{old('prenom')}}" type="text" class="form-control" id="prenom" placeholder="Saisissez le prenom du profil">
        @error('prenom')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <div class="form-group" id="formEmail">
        <label for="email"><b>* Email : </b></label>
        <input name="email" value="{{old('email')}}" type="text" class="form-control" id="email" placeholder="Saisissez l'adresse email du profil">
        @error('email')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <div class="form-group" id="formPseudo">
        <label for="name"><b>* Pseudo : </b></label>
        <input name="name" value="{{old('name')}}" type="text" class="form-control" id="name" placeholder="Saisissez le pseudo du profil">
        @error('name')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <div class="form-group" id="formMdp">
     <label for="password" class="col-md-4 col-form-label text-md-right"><b>* {{ __('Mot de passe :') }}</b></label>
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
    <label for="password-confirm" class="col-md-4 col-form-label text-md-right"><b>* {{ __('Confirmation mot de passe :') }}</b></label>
         <div class="col-md-6">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmer le mot de passe">
        </div>
     </div>
     <div class="form-group" id="formAdresse">
        <label for="commune"><b>* Adresse : </b></label>
        <input name="adresse" type="text" value="{{old('adresse')}}" class="form-control" id="commune" placeholder="Saisissez l'adresse">
        @error('adresse')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <div class="form-group" id="formVille">
        <label for="commune"><b>* Ville : </b></label>
        <input name="ville" type="text" value="{{old('ville')}}" class="form-control" id="commune" placeholder="Saisissez la ville">
        @error('ville')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <div class="form-group" id="formCp">
        <label for="commune"><b>* Code Postal : </b></label>
        <input name="cp" type="text" value="{{old('cp')}}" class="form-control" id="commune" placeholder="Saisissez le Code postal">
        @error('cp')
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
        <label for="InputFile"><b> CV : </b></label>
        <input type="file" name="cv" id="InputFile">
        @error('cv')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <br>
    <div id="booleen">
        <div id="isAdmin">
            <p><b>* Cet utilisateur sera t-il administrateur du site ?</b></p>
            <div>
                <input type="radio" id="isAdmin" name="admin" value="1">
                <label for="isAdmin">Oui</label>
            </div>
            <div>
                <input type="radio" id="isNotAdmin" name="admin" value="0">
                <label for="isNotAdmin">Non</label>
            </div>
            @error('admin')
                <div class="alert alert-danger"> {{ $message }} </div> 
            @enderror
        </div>
        <br>
        <div id="isNotified">
            <p><b>* Cet utilisateur accepte t-il de recevoir des notifications ?</b></p>
            <div>
                <input type="radio" id="isNotified" name="notif" value="1">
                <label for="isNotified">Oui</label>
            </div>
            <div>
                <input type="radio" id="isNotNotified" name="notif" value="0">
                <label for="isNotNotified">Non</label>
            </div>
            @error('notif')
                <div class="alert alert-danger"> {{ $message }} </div> 
            @enderror
        </div>
        <br>
        <div id="isContactable">
            <p><b>* Cet utilisateur accepte t-il d'être joignable par d'autres membres du site ?</b></p>
            <div>
                <input type="radio" id="isContactable" name="joignable" value="1">
                <label for="isContactable">Oui</label>
            </div>
            <div>
                <input type="radio" id="isNotContactable" name="joignable" value="0">
                <label for="isNotContactable">Non</label>
            </div>
            @error('joignable')
                <div class="alert alert-danger"> {{ $message }} </div> 
            @enderror
        </div>
    </div>
    <br>
  <CENTER><button type="submit" class="btn btn-primary">Créer</button></CENTER>
  {!! Form::close() !!}
  <br>
@stop