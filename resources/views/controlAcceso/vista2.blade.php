@extends('layouts.app')

@section('content')


<hr>
<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <form class="form-horizontal" method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
            @csrf
            <div class="form-group">
                <input id="docu_perso" type="number" class="form-control input-lg {{ $errors->has('docu_perso') ? ' is-invalid' : '' }}" name="docu_perso" value="{{ old('docu_perso') }}" placeholder="Codigo" required autofocus>

                @if ($errors->has('docu_perso'))
                    <span class="badge badge-danger">{{ $errors->first('docu_perso') }}</span>
                @endif
            </div>

            <div class="form-group">
                <input id="password" type="password" class="form-control input-lg {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Contraseña" required>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-block">
                    <i class="fa fa-sign-in"></i> <span>{{ __('Ingresar') }}</span>
                </button>
            </div>

        </form>
    </div>
</div>
<!--
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-primary">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6 text-center">
                        <img src="{{ asset('adminlte/img/lock.png') }}" class="img-rounded" alt="Logo Control Acceso"  width="200" height="200">
                    </div>

                    <div class="col-md-5">
                        <form class="form-horizontal" method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                            @csrf
                            <div class="form-group">
                                <input id="docu_perso" type="number" class="form-control input-lg {{ $errors->has('docu_perso') ? ' is-invalid' : '' }}" name="docu_perso" value="{{ old('docu_perso') }}" placeholder="Codigo" required autofocus>

                                @if ($errors->has('docu_perso'))
                                    <span class="badge badge-danger">{{ $errors->first('docu_perso') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <input id="password" type="password" class="form-control input-lg {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Contraseña" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <hr>

                            <div class="form-group">
                                <button type="submit" class="btn btn-success btn-block">
                                    <i class="fa fa-sign-in"></i> <span>{{ __('Ingresar') }}</span>
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <div class="panel-footer text-center">
                <strong>Copyright &copy; 2018 <a href="http://www.latinsoft.cl">LatinSoft CHL</a>.</strong> All rights reserved.
            </div>
        </div>
    </div>
</div>
-->
@endsection
