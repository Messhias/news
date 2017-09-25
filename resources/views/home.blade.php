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

                    Hello {{ Auth::user()->username }}, look at your(s) article(s):
                </div>
            </div>
        </div>
        <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
            
            @if ($articles->count() > 0)

                @foreach ($articles->get() as $article)

                    <div class="col-sm-12 col-xs-12 col-md-4 col-lg-4">
                        
                        <div class="panel panel-default">
                            <div class="panel-heading"><h4>{{ $article->title }}</h4></div>

                            <div class="panel-body">
                                <p>
                                    
                                    {{ HTML::image('img/news/'. $article->photo , 'alt', ['class'=>'img-responsive']) }}
                                </p>
                                
                                <br>

                                <p>
                                    <a class='btn btn-info' href="{{ url('artciles/show/'.Crypt::encrypt($article->id)) }}">
                                        
                                        <b>
                                            SEE THE FULL ARTCILE
                                        </b>

                                    </a>
                                </p>

                            </div>

                        </div>

                    </div>

                @endforeach

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
@endsection