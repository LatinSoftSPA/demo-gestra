@extends('layouts.app')

@section('content')
<hr>
<div class="row justify-content-md-center">
    <div class="col-md-4">
        <div class="panel panel-success">
            <div class="panel-heading">{{ __('Control') }}</div>
            <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="docu_perso" class="col-md-3 control-label">{{ __('Codigo') }}</label>
                        <div class="col-md-9">
                            <input id="docu_perso" type="number" class="form-control {{ $errors->has('docu_perso') ? ' is-invalid' : '' }}" name="docu_perso" value="{{ old('docu_perso') }}" placeholder="Usuario" required autofocus>

                            @if ($errors->has('docu_perso'))
                            <div class="bg-danger">
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('docu_perso') }}</strong>
                                </span>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password" class="col-md-3 control-label">{{ __('Contraseña') }}</label>
                        <div class="col-md-9">
                            <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                            @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-9">
                            <button type="submit" class="btn btn-danger btn-block">
                                {{ __('Ingresar') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection