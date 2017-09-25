<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Articles;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $news = new Articles();

        $usersArticles = $news->orderBy('created_at','desc')->where("user_id",Auth::user()->id)->take(10);

        return view('home',['articles'=>$usersArticles]);
    }
}
