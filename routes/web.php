<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',"MainController@index")->name("/");

// Activate the new user
Route::get('activate/{mail}/{name}',"ActivationController@index");
Route::put('activate/{mail}/{name}', 'ActivationController@update');
Route::get('artciles/show/{id}', 'MainController@show')->name('artciles.show');
Route::get('download/{id}',"MainController@getPDF")->name('download.pdf');


Route::get('feed', function(){

    // create new feed
    $feed = App::make("feed");

    // multiple feeds are supported
    // if you are using caching you should set different cache keys for your feeds

    // cache the feed for 60 minutes (second parameter is optional)
    $feed->setCache(60, 'laravelFeedKey');

    // check if there is cached feed and build new only if is not
    if (!$feed->isCached())
    {
       // creating rss feed with our most recent 10 news
       $news = \DB::table('news')->join('users','user_id','=','users.id')->orderBy('news.created_at', 'desc')->take(10)->get();

       // set your feed's title, description, link, pubdate and language
       $feed->title = 'Last news';
       $feed->description = 'This is the news feed';
       // $feed->logo = 'http://yoursite.tld/logo.jpg';
       $feed->link = url('feed');
       $feed->setDateFormat('datetime'); // 'datetime', 'timestamp' or 'carbon'
       $feed->pubdate = $news[0]->created_at;
       $feed->lang = 'en';
       $feed->setShortening(true); // true or false
       $feed->setTextLimit(100); // maximum length of description text

       foreach ($news as $feedNews)
       {
           // set item's title, author, url, pubdate, description, content, enclosure (optional)*
           $feed->add($feedNews->title, $feedNews->username, URL::to('articles/show'.Crypt::encrypt($feedNews->id)), $feedNews->created_at, $feedNews->text, $feedNews->text);
       }

    }

    // first param is the feed format
    // optional: second param is cache duration (value of 0 turns off caching)
    // optional: you can set custom cache key with 3rd param as string
    return $feed->render('atom');

    // to return your feed as a string set second param to -1
    // $xml = $feed->render('atom', -1);

});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('articles',"ArticlesController@index")->name("articles");
Route::get('articles/create', 'ArticlesController@create')->name('articles.new');
Route::post('articles.create', 'ArticlesController@store')->name('articles.create');
Route::delete('delete/{id}', 'ArticlesController@destroy')->name('delete.article');