@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Set a new password for <b>{{ Crypt::decrypt($mail) }}</b> </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <p>
                            Hello <b>{{ Crypt::decrypt($name) }}</b>, you could now set a <b>new password to your login.</b>
                        </p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{ Form::open([
                            'action'     =>  ['ActivationController@update',$mail,$name],
                            'method'    =>  'PUT'

                        ]) 
                    }}

                        <div class="form-group">
                            {{ Form::label('password', 'Password:', ['class'=>"form-label "]) }}
                            {{ Form::password('password', ['class'=>'form-control','required','id'=>'password']) }}
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            {{ Form::label('password-confirm:', 'Confirm password', ['class'=>"form-label"]) }}
                            {{ Form::password('password-confirm', ['class'=>"form-control",'required']) }}
                        </div>

                        {{ Form::submit('Update my password', ['class'=>'btn btn-success']) }}

                    {{ Form::close() }}
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
