<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;
use App\Mail\activation;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    public function register(Request $request){

        $user = new User();

        if ($user->where("username","=",$request->input('username'))->where("email","=",$request->input("email"))->count() > 0 ) {
            
            return response()->back()->with("error","User allready exists");
        }else{

            $user->username =   $request->input('username');
            $user->email    =   $request->input('email');
            $user->active   =   false;

            $data = ['username' => $request->input("username"),'email'=>$request->input("email")];

            if ($user->save()) {
                
                Mail::to($request->input("email"))->send(new activation($data));

                return redirect('login')->with('status', 'Look at your e-mail for activation!');
            }
        }

    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username'  => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            // 'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
       
        $user = new User();

        if ($user->where("username","=",$data['username'])->where("email","=",$data["email"])->count() > 0 ) {
            
            return response()->back()->with("error","User allready exists");
        }else{

            $user->username =   $data['username'];
            $user->email    =   $data['email'];
            $user->active   =   false;

            if ($user->save()) {
                
                Mail::to($data["email"])->send(new activation($data));

                return redirect()->route('login')->with("information","Activate your account by e-mail.");
            }


        }

    }
}
