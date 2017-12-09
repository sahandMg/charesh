<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use GuzzleHttp\Client;
//use Tymon\JWTAuth\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{


    public function getRegister(){

        return view('auth.register');
    }


    public function postRegister(RegisterRequest $request){

        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        if($request->email == 'sahand.mg.ne@gmail.com'){
            $user->role = 'admin';
        }
        $user->password = bcrypt($request->password);
        $user->reset_password = str_shuffle("ajleyqwncx3497");
        $user->path = 'Blank100_100.png';
        $user->save();

        $data=['username' => $request->username,
                'email'=>$request->email,
                'link' => str_random(30),
                'id'=>$user->id];

        Mail::send('email.registerMail',$data,function ($message) use($data){

            $message->from('s23.moghadam@gmail.com');
            $message->to($data['email']);
        });
        return redirect()->route('verify');
//->with(['message' => 'حساب کاربری شما ساخته شد. برای تایید حساب کاربری به ایمیل خود مراجعه فرمایید.'])


    }

    public function verify(){

        return view('auth.emailVerification');

    }

    public function post_verifyAgain(Request $request)
    {

        $this->validate($request, ['email' => 'required|email']);

        if (User::where('email', $request->email)->first()) {
            $user = User::where('email', $request->email)->first();

            $data = ['username' => $user->username,
                'email' => $user->email,
                'link' => str_random(30),
                'id' => $user->id];
            Mail::send('email.registerMail', $data, function ($message) use ($data) {

                $message->from('s23.moghadam@gmail.com');
                $message->to($data['email']);
            });

            return redirect()->back()->with(['message' => 'ایمیل تایید ارسال شد']);

        }else{

            return redirect()->back()->with(['message' => 'ایمیل وارد شده ثبت نشده است  ']);

        }
    }

// -------------------- API REQUESTS --------------------------
    public function ApiRegister(Request $request){

        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->reset_password = str_shuffle("ajleyqwncx3497");
        $user->path = 'Blank100*100.png';
        $user->save();
        $token = JWTAuth::fromUser($user);
        $data=['username' => $request->username,
            'email'=>$request->email,
            'link' => str_random(30),
            'id'=>$user->id];

        Mail::send('email.registerMail',$data,function ($message) use($data){

            $message->from('s23.moghadam@gmail.com');
            $message->to($data['email']);
        });
       return ['token' => $token];



    }

    public function ApiLogin(Request $request){

        try{

                $token = JWTAuth::attempt(['email'=> $request->email,'password'=>$request->password]);
                if(!$token){

                    return '401';
                }

            }
            catch(JWTException $ex){

                return '500';
            }

            return  ['token' => $token];
        }







// --------------------END--------------------------

    public function confirm($id){

        $user = User::find($id);

        $user->confirm = 1;

        $user->save();

        return redirect()->route('redirect');

    }

    public function getLogin(){

        return view('auth.login');
    }



    public function postLogin(LoginRequest $request){


//
        if(Auth::attempt(['email'=> $request->email,'password'=>$request->password])){

//
            if(session('lastPage')) {
                $url = session('lastPage');
                session()->forget('lastPage');
//                dd(session('lastPage'));
                return redirect()->intended($url);

            }else{

                return redirect()->route('home');

            }
        }
        else{

//            echo 'false';
            return redirect()->back()->with(['LoginError'=>'ایمیل یا رمز عبور را نادرست وارد کرده اید']);
        }


    }

    public function postReset(Request $request)
    {

        $this->validate($request,['email'=>'required|email']);

        if (count($user = User::where('email', $request->email)->first()) > 0) {
            $data = ['email' => $user->email,'password' => $user->reset_password,'name'=>$user->username];
            Mail::send('email.resetPassword', $data, function ($message) use ($data) {

                $message->to($data['email']);
                $message->from('s23.moghadam@gmail.com');
            });
            $user->password = bcrypt($user->reset_password);
            $user->reset_password =  str_shuffle("ajleodncx3497");
            $user->save();
            return redirect()->back()->with(['message' => 'پسورد جدید به ایمیل شما ارسال شد']);
        }else{
            return redirect()->back()->with(['resetError'=> 'آدرس ایمیل قبلا ثبت نشده است']);
        }
    }

    public function logout(){


        Auth::logout();

        return redirect()->route('home');

    }




    public function post_userSetting(Request $request){

        $user = User::where('id',Auth::id())->first();


        if($request->input('username')){

            $user->username = $request->username;
            $user->save();

        }
        if($request->input('email')){


            $user->update(['email'=>$request->email]);

        }

        if($request->password){


            $user->update(['password'=>bcrypt($request->password)]);

        }

        $data = ['username'=>$user->username,'email'=>$user->email,'password'=>$user->password];
        Mail::send('email.update',$data,function ($message) use($data){

            $message->from('s23.mogadam@gmail.com');
            $message->to($data['email']);

        });
        return redirect()->back()->with(['message'=>'مشخصات شما ویرایش شد']);



    }




}
