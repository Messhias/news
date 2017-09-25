@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>
                        {{ $article->title }}
                    </h1>
                    <h4>
                        Writed by: {{ $article->users()->get()[0]->username }}
                    </h4>
                    <h5>
                        Publish date: {{ $article->created_at }}
                    </h5>
                </div>

                <div class="panel-body">

                    <p>
                        {{ HTML::image('img/news/'. $article->photo , $article->title . " Photo", ['class'=>'img-responsive']) }}
                    </p>

                    <hr>

                    <p>
                        {{ $article->text }}
                    </p>


                    <p>
                        <a class="btn btn-info" href="{{ url('download/'.Crypt::encrypt($article->id)) }}">
                            DOWNLOAD
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection