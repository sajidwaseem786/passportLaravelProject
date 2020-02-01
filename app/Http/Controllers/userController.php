<?php

namespace App\Http\Controllers;//namespace same as path of file
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\User;
use auth;
class userController extends Controller{

    public function __construct(){

        // $this->middleware('auth',['only'=>['login']]);//middle apply on login only//chk token

        $this->middleware('auth',['except'=>['register']]);//register k alwa bki pr middleware apply ho ga
        

    }

public function register(Request $request){

    $this->validate($request,[
   "name"=>'required|min:3|max:12',
   "email"=>'required|email|unique:users'
   ]);

    return User::create([
        'username'=>$request->input('name'),
        'email'=>$request->input('email'),
        'role'=>$request->input('role'),
        'api_token'=>app('hash')->make('dfjsoidfjsl34r8924r9834985eiojdkl4'),
    ]);

}

public function login(){
   return response()->json(['status'=>'logged In','statusCode'=>200]);
}

public function edit($id){

    $user=User::find($id);
    $allowed=false;

    if($user){//first $user mean agr db sy user mil gia.bki gate parameters gate name and chkuser//Gate sy phly \ lgae ya illmnt facade add kro opar class
        //if(Gate::allows('update-user',$user))
        // $allowed=true;
        //agr user_api  ma ha tu gate allow kr dy ga or nechy flow jae ga ni tu ni
      
        if(Auth::user()->can('update',$user))
        $allowed=true;
        else{
            $user=[];
           
            
        }

        
    }
    else{

        return response()->json(['message'=>'Record not found']);
    }
  

    return response()->json(['message'=>$user,'status'=>200]);
}


}
?>