
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ $article->title }}
                </div>

                <div class="panel-body">

                    <p>
                        {{-- <img src="{{ url('img/news/'.$article->photo) }}" alt=""> --}}
                        {{-- {{ HTML::image('img/news/'. $article->photo , $article->title . " Photo", ['class'=>'img-responsive']) }} --}}
                    </p>

                    <hr>

                    <p>
                        {{ $article->text }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>