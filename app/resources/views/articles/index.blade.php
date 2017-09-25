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
                        Hello {{ Auth::user()->username }}, here is all the artciles you have been writen:
                    </p>

                    <p>
                        <a class="btn btn-success" href="{{ url('articles/create') }}">
                            Write a new!
                        </a>
                    </p>    

                    @if ($articles->count() > 0)
                        <table class="table">
                            <caption>Your artcile(s)</caption>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Creation date</th>
                                    <th>Action</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($articles->get() as $article)

                                    <tr>
                                        <td>{{ $article->id }}</td>
                                        <td>{{ $article->title }}</td>
                                        <td>{{ $article->created_at }}</td>
                                        <td>
                                            <a class="btn btn-info" href="{{ url('artciles/show/'.Crypt::encrypt($article->id)) }}">
                                                <span>SEE ARTICLE</span>
                                            </a>
                                        </td>
                                        <td>
                                            {{ Form::open([
                                                'route'     =>  ['delete.article',Crypt::encrypt($article->id)],
                                                'method'    =>  'DELETE'
                                            ]) }}
                                                {{ Form::submit('DELETE ARTICLE', ['class'=>'btn btn-danger']) }}
                                            {{ Form::close() }}
                                        </td>
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <center>
                            <h3>
                                You do not writed any article yet.
                            </h3>
                        </center>
                        <p>
                            <a class='btn btn-danger' href="{{ url('articles/create') }}">
                                SUBMIT A NEW ARTICLE
                            </a>
                        </p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection