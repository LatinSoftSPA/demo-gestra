@extends('layouts.app')

@section('content')

<hr>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-info">
            <div class="panel-heading">{{ __('Crear Usuario') }}</div>
            <form class="form-horizontal" method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                @csrf
                <div class="panel-body">
                        <div class="form-group">
                            <label for="prim_nombr" class="col-md-3 control-label">{{ __('Nombres') }}</label>

                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input id="prim_nombr" type="text" class="form-control{{ $errors->has('prim_nombr') ? ' is-invalid' : '' }}" name="prim_nombr" value="{{ old('prim_nombr') }}" placeholder="P.Nombre" required autofocus>

                                        @if ($errors->has('prim_nombr'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('prim_nombr') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        <input id="segu_nombr" type="text" class="form-control{{ $errors->has('segu_nombr') ? ' is-invalid' : '' }}" name="segu_nombr" value="{{ old('segu_nombr') }}" placeholder="S.Nombre" required autofocus>

                                        @if ($errors->has('segu_nombr'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('segu_nombr') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="apel_pater" class="col-md-3 control-label">{{ __('Apellidos') }}</label>

                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input id="apel_pater" type="text" class="form-control{{ $errors->has('apel_pater') ? ' is-invalid' : '' }}" name="apel_pater" value="{{ old('apel_pater') }}" placeholder="A.Paterno" required autofocus>

                                        @if ($errors->has('apel_pater'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('apel_pater') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        <input id="apel_mater" type="text" class="form-control{{ $errors->has('apel_mater') ? ' is-invalid' : '' }}" name="apel_mater" value="{{ old('apel_mater') }}" placeholder="A.Materno" required autofocus>

                                        @if ($errors->has('apel_mater'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('apel_mater') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <hr>

                        <div class="form-group">
                            <label for="email" class="col-md-3 control-label">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-9">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="ejemplo@latinsoft.cl" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <hr>

                        <div class="form-group">
                            <label for="docu_perso" class="col-md-3 control-label">Codigo</label>

                            <div class="col-md-9">
                                <input id="docu_perso" type="number" class="form-control{{ $errors->has('docu_perso') ? ' is-invalid' : '' }}" name="docu_perso" value="{{ old('docu_perso') }}" placeholder="Codigo" required>

                                @if ($errors->has('docu_perso'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('docu_perso') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-3 control-label">{{ __('Password') }}</label>

                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Password" required>

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmacion" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group">
                            <label for="rol" class="col-md-3 control-label">{{ __('Rol') }}</label>

                            <div class="col-md-9">
                                <input id="rol" type="text" class="form-control{{ $errors->has('rol') ? ' is-invalid' : '' }}" name="rol" value="{{ old('rol') }}" required autofocus>

                                @if ($errors->has('rol'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('rol') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                </div>
                <div class="panel-footer">
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-9">
                            <button type="submit" class="btn btn-success btn-block">
                                {{ __('Add') }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection