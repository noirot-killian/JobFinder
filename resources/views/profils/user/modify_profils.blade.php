@extends('template')

@section('menu')
    @parent - Création d'un profil
@stop

@section('titre')
    <main class="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5">Modifier mon <b>profil</b></h1>
        </div>
    </main>
@stop
@section('content')
{!! NoCaptcha::renderJs() !!}
  <style>
    
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

{!! Form::open(['url' => route('profil.update',[$p->id]), 'method' => 'put', 'enctype' => 'multipart/form-data']) !!}
  @csrf
  <div id="formCateg">
        <label><b> Catégorie : </b></label>
        <div>
            {!!Form::select('newListCateg', $tabCateg, null, ['class'=>'form-control']) !!}
        </div>
        @error('newListCateg')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
  <div class="form-group" id="formNom">
        <label for="nom"><b> Nom : </b></label>
        <input name="newNom" value="{{$p->nom}}" type="text" class="form-control" id="nom" placeholder="Saisissez le nom du profil">
        @error('newNom')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <div class="form-group" id="formPrenom">
        <label for="prenom"><b> Prenom : </b></label>
        <input name="newPrenom" value="{{$p->prenom}}" type="text" class="form-control" id="prenom" placeholder="Saisissez le prenom du profil">
        @error('newPrenom')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <div class="form-group" id="formEmail">
        <label for="email"><b> Email : </b></label>
        <input name="newEmail" value="{{$email}}" type="text" class="form-control" id="email" placeholder="Saisissez l'adresse email du profil">
        @error('newEmail')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <div class="form-group" id="formPseudo">
        <label for="name"><b> Pseudo : </b></label>
        <input name="newName" value="{{$name}}" type="text" class="form-control" id="name" placeholder="Saisissez le pseudo du profil">
        @error('newName')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <div class="form-group" id="formMdp">
     <label for="password" class="col-md-4 col-form-label text-md-right"><b>{{ __('Mot de passe :') }}</b></label>
         <div class="col-md-6">
             <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="newPassword" required autocomplete="new-password" placeholder="Saisissez le mot de passe">
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
        <input name="newVille" type="text" value="{{$p->ville}}" class="form-control" id="commune" placeholder="Saisissez la ville">
        @error('newVille')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <div class="form-group" id="formCp">
        <label for="commune"><b> Code Postal : </b></label>
        <input name="newCP" type="text" value="{{$p->CP}}" class="form-control" id="commune" placeholder="Saisissez le Code postal">
        @error('newCP')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <div class="form-group" id="formAdresse">
        <label for="commune"><b> Adresse : </b></label>
        <input name="newAdresse" type="text" value="{{$p->adresse}}" class="form-control" id="commune" placeholder="Saisissez l'adresse">
        @error('newAdresse')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <div class="form-group" id="formTel">
        <label for="tel"><b> Téléphone : </b></label>
        <input name="newTel" type="tel" value="{{$p->tel}}" class="form-control" id="tel" placeholder="Saisissez un numéro de téléphone">
        @error('newTel')$p->tel
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
    </div>
    <br>
    <div class="form-group" id="formPDF">
        <label for="InputFile"><b> CV : </b></label>
        <input type="file" name="newCV" id="InputFile">
        @error('newCV')
            <div class="alert alert-danger"> {{ $message }} </div> 
        @enderror
        <br>
        <label id="SavedFile" name="cvSaved"><i>Fichier actuel :</i> {{$p->CV}}</label>
    </div>
    <br>
    <div id="booleen">
        <div id="isNotified">
            <p><b>Acceptez-vous de recevoir des notifications ?</b></p>
            <div>
                <input type="radio" id="isNotified" name="newNotif" value="1">
                <label for="isNotified">Oui</label>
            </div>
            <div>
                <input type="radio" id="isNotNotified" name="newNotif" value="0">
                <label for="isNotNotified">Non</label>
            </div>
            @error('notif')
                <div class="alert alert-danger"> {{ $message }} </div> 
            @enderror
        </div>
        <br>
        <div id="isContactable">
            <p><b>Acceptez-vous d'être joignable par d'autres membres du site ?</b></p>
            <div>
                <input type="radio" id="isContactable" name="newJoignable" value="1">
                <label for="isContactable">Oui</label>
            </div>
            <div>
                <input type="radio" id="isNotContactable" name="newJoignable" value="0">
                <label for="isNotContactable">Non</label>
            </div>
            @error('joignable')
                <div class="alert alert-danger"> {{ $message }} </div> 
            @enderror
        </div>
    </div>
    <br>
  <CENTER><button type="button" class="btn btn-primary btnModif" id="'+key+'">Modifier</button></CENTER>
  <!-- Modal de confirmation de modification -->
    <div class="modal" tabindex="-1" role="dialog" id="modalModification" style="display:none">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmation de modification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Êtes-vous sûr de vouloir modifier vos données personnelles ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btnAnnuler" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary btnConfModif">Modifier</button>
                </div>
            </div>
        </div>
    </div>
  {!! Form::close() !!}
  <br>
@stop
@section('script')
    $(document).ready(function() 
    {

        //Affichage de la modal au clic du bouton "Modifier"
        $(document).on('click',".btnModif",function(){
            $("#modalModification").show();
        });

        //Cachement des modal au clic de la croix
        $(document).on('click',".close",function(){
            $("#modalModification").hide();
        });

        //Cachement des modal au clic du bouton "Annuler"
        $(document).on('click',".btnAnnuler",function(){
            $("#modalModification").hide();
        });
    });
@stop