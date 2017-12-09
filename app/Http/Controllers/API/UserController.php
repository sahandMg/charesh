<?php

namespace App\Http\Controllers\API;

use App\Client;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Kim\Activity\Activity;
use Validator;


class UserController extends Controller
{


    public function status(){
        $onlineUsers =  Activity::users()->get();
        $Guests = Activity::guests()->count();

            $allUsers = count(User::all());


                return view('admin.status',compact('onlineUsers','Guests','allUsers'));


    }

    public function moreInfo (){

        $onlineUsers =  Activity::users()->get();
        $Guests = Activity::guests()->count();

        $allUsers = count(User::all());


        return view('admin.moreInfo',compact('onlineUsers','Guests','allUsers'));



    }
    public function all(){

       $onlineUsers =  Activity::users()->get();

//        $Guests = Activity::guests()->count();
        $allUsers = User::all();
        return $allUsers;
    }

    public function online(){

        $onlineUsers =  Activity::users()->get();

        return $onlineUsers;
    }

    public function guests(){

        $Guests = Activity::guests()->count();

        return $Guests;
    }

    public $successStatus = 200;

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request){
        dd('HI');
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }
    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required|email',

            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->username;

        return response()->json(['success'=>$success], $this->successStatus);
    }

    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }
}