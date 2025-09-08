<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

	

    public function __construct()
    {
        $this->middleware( 'guest' )->except( 'logout' );
    }


	public function userlogin(){
		
		return view("admin/auth/login");
	}


    public function login(Request $request){
      $message = "";
      $user_name = array("user_name" => $request->user_name, "password" => $request->password);
      if(Auth::attempt($user_name)) {
        Auth::loginUsingId(Auth::user()->id);
            $usertype_id = Auth::user()->usertype_id;
                return redirect('/admin/dashboard');
      }else{
        $message = 'Login Failed';
        return redirect('/userlogin')->with('message',$message);
      }

    }
}