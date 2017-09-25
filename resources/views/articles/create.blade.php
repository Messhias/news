@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif


                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <p>
                        Hello {{ Auth::user()->username }}, let's create new article:
                    </p>

                    {{ Form::open([
                        'route'     =>  ['articles.create'],
                        'enctype'   =>  'multipart/form-data'
                    ]) }}

                        <div class="form-group">
                            
                            {{ Form::label('title', 'Title:', ['class'=>'form-label']) }}
                            {{ Form::text('title', '', ['class'=>'form-control','placeholder'=>'GIVE ME A NICE TITLE','required']) }}

                        </div>

                        <div class="form-group">
                            
                            {{ Form::label('text', 'Text:', ['class'=>'form-label']) }}
                            {{ Form::textarea('text', '', ['class'=>'form-control','rows'=>'5','placeholder'=>'WRITE YOUR NICE ARTICLE HERE','required']) }}

                        </div>

                        <div class="form-group">
                            {{ Form::label('photo', 'Include a nice photo:', ['class'=>'form-label']) }}
                            {{ Form::file('photo', ['required']) }}
                        </div>

                        <div class="form-group">
                            {{ Form::submit('Submit my new article', ['class'=>'btn btn-success']) }}
                        </div>

                    {{ Form::close() }}

                </div>

            </div>
        </div>
    </div>
</div>
@endsection