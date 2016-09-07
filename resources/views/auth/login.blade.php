@extends('layouts.app')
@section('title', 'Login')

@section('content')

<div class="container">
    <div class="row">
        <div class="offset-s3 col s6 offset-s3">
            <div class="card z-depth-2 {{ $errors->count() ? 'animated bounce' : '' }}" style="margin-top: 30%">
                <div class="card-title teal white-text center-align" style="padding: 10px">Login</div>
                <div style="padding: 10px">
                    {!! Form::open(['url' => '/login', 'class' => 'form-validate']) !!}
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">
                                    email
                                </i>
                                {!! Form::email('email', null, ['class' => $errors->has('email') ? 'invalid' : '', 'id' => 'email', 'autofocus', 'required']) !!}
                                <label for="email" data-error="{{ $errors->first('email') }}"> Email
                                    <span class="red-text">*</span>
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">
                                    lock
                                </i>
                                {!! Form::password('password', ['class' => $errors->has('password') ? 'invalid' : '', 'id' => 'password', 'required']) !!}
                                <label for="password" data-error="{{ $errors->first('password') }}"> Password
                                    <span class="red-text">*</span>
                                </label>
                            </div>
                        </div>
                        <div>
                            <a class="btn btn-flat" href="{{ url('/password/reset') }}">
                                Forgot Your Password?
                            </a>
                            <button class="btn waves-effect waves-light green right" type="submit" name="action">Login
                                <i class="material-icons right">send</i>
                              </button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
