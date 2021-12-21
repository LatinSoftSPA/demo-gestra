@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="docu_empre" class="col-md-4 col-form-label text-md-right">Documento Empresa</label>

                            <div class="col-md-8">
                                <input id="docu_empre" type="number" class="form-control{{ $errors->has('docu_empre') ? ' is-invalid' : '' }}" name="docu_empre" value="{{ old('docu_empre') }}" required autofocus>

                                @if ($errors->has('docu_empre'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('docu_empre') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="docu_perso" class="col-md-4 col-form-label text-md-right">Codigo Documento</label>

                            <div class="col-md-8">
                                <input id="docu_perso" type="number" class="form-control{{ $errors->has('docu_perso') ? ' is-invalid' : '' }}" name="docu_perso" value="{{ old('docu_perso') }}" required autofocus>

                                @if ($errors->has('docu_perso'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('docu_perso') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="prim_nombr" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-4">
                                <input id="prim_nombr" type="text" class="form-control{{ $errors->has('prim_nombr') ? ' is-invalid' : '' }}" name="prim_nombr" value="{{ old('prim_nombr') }}" required autofocus>

                                @if ($errors->has('prim_nombr'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('prim_nombr') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <input id="segu_nombr" type="text" class="form-control{{ $errors->has('segu_nombr') ? ' is-invalid' : '' }}" name="segu_nombr" value="{{ old('segu_nombr') }}" required autofocus>

                                @if ($errors->has('segu_nombr'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('segu_nombr') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="apel_pater" class="col-md-4 col-form-label text-md-right">{{ __('Apellido') }}</label>

                            <div class="col-md-4">
                                <input id="apel_pater" type="text" class="form-control{{ $errors->has('apel_pater') ? ' is-invalid' : '' }}" name="apel_pater" value="{{ old('apel_pater') }}" required autofocus>

                                @if ($errors->has('apel_pater'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('apel_pater') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <input id="apel_mater" type="text" class="form-control{{ $errors->has('apel_mater') ? ' is-invalid' : '' }}" name="apel_mater" value="{{ old('apel_mater') }}" required autofocus>

                                @if ($errors->has('apel_mater'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('apel_mater') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="rol" class="col-md-4 col-form-label text-md-right">Rol</label>

                            <div class="col-md-6">
                                <input id="rol" type="text" class="form-control{{ $errors->has('rol') ? ' is-invalid' : '' }}" name="rol" value="{{ old('rol') }}" required autofocus>

                                @if ($errors->has('rol'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('rol') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection