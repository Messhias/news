<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Crypt;
use Illuminate\Support\Facades\Validator;

class ActivationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($mail = null, $name = null)
    {
        $user = new User();

        if ($user->where("email","=",Crypt::decrypt($mail))->where("username","=",Crypt::decrypt($name))->count() > 0) {

            return view("activation.active",['mail'=>$mail,'name'=>$name])->with("status","Set a new password to continue to login");
            
        }else{
            return redirect('login')->with('error', 'An error occours, contact the system adminstrator');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, $mail = null, $name = null)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:3|confirmed',
            // 'passowrd-confirm' => 'required',
        ]);

        if ($request->input("password") == $request->input("password-confirm")) {
            if (\App\User::where("email",Crypt::decrypt($mail))
                ->where("username",Crypt::decrypt($name))
                    ->update(["active"=>true,'password'=>bcrypt($request->input("password"))])) {
                return redirect('login')->with('status','Your account has been activated, you can login now.');
            
            }else{
                return redirect('login')->withErrors($validator);
            }
        }else{
            return redirect()->back()->withErrors($validator);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
