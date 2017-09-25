<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Articles;
use Auth;
use Crypt;

class ArticlesController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $news = new Articles();

        $usersArticles = $news->where("user_id",Auth::user()->id)->orderBy('created_at','desc');

        return view("articles.index",['articles'=>$usersArticles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view("articles.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' =>  'required|min:3',
            'photo' =>  'required|mimes:jpeg,jpg,png,gif|max:100000',
            'text'  =>  'required|min:3'
        ]);


        $news = new Articles;

        $news->user_id      =       Auth::user()->id;
        $news->title        =       $request->input("title");
        $news->text         =       $request->input('text');
        if ($request->hasFile('photo')) {
            $img            =       $request->file('photo');
            $file           =       md5(Auth::user()->id) . '.' . $img->getClientOriginalExtension();
            $request->file("photo")->move(public_path('./img/news/'),$file);
        }
        $news->photo        =       $file;

        if ($news->save()) {
            return redirect()->back()->with('status','The new article has been added');
        }else{
            return redirect()->back()->withErrors($validator);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $article = \App\Articles::find(Crypt::decrypt($id));

        return view("articles.show",['article'=>$article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Articles::find(Crypt::decrypt($id));

        if ($article->delete()) {
            return redirect()->back()->with("status","Deleted");
        }else{
            return redirect()->back()->with('status','Occour a error');
        }
    }
}
