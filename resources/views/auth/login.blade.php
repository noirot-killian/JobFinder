@extends('template')
@section('titre')
    <main class="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5"><b>Connexion</b></h1>
        </div>
    </main>
    <br>
@stop
<style>
body{
}
#formCard
{
    margin-right: : 500px;
    background-color: #4bbea9;

}
#formLogin3
{
 margin-left: 25px;
}
#formLogin2, #formMdp2
{
    margin-left: 175px;
}
#formLogin, #formMdp
{

width: 500px;
}
#formCaptcha 
    {
        margin: 0 auto;
        width: 300px;
    }
</style>
@section('content')
{!! NoCaptcha::renderJs() !!}
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row" id="formLogin2" >
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Adresse Email :') }}</label>

                            <div class="col-md-6 "id="formLogin">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br>

                        <div class="form-group row" id="formMdp2" >
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mot de passe :') }}</label>

                            <div class="col-md-6" id="formMdp">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <br>
<br>
                        <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}" id="formCaptcha">
                            <label class="col-md-4 control-label"></label>
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
                        <br>
                        <div class="form-group row mb-0" id="formLogin3">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Mot de passe oublié?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
@endsection
