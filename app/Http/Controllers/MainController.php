<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Articles;
use Crypt;
use PDF;

class MainController extends Controller
{
    //

    public function index(){
    	return view("welcome",['articles'=>Articles::orderBy("created_at","desc")->take(10)]);
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

    public function getPDF($id){

        $article 	= \App\Articles::find(Crypt::decrypt($id));

        $pdf 		= PDF::loadView('articles.pdfview',compact('article'));
		return $pdf->download($article->title." ".$article->created_at.'.pdf');
    }
}
