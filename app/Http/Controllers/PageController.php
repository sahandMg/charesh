<?php

namespace App\Http\Controllers;

use App\Url;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Requests\ContactUsRequest;
use App\Match;
use App\Organize;
use App\Tournament;
use Carbon\Carbon;
//use Faker\Provider\Image;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\User;
use Illuminate\Support\Facades\Storage;
use SoapClient;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('confirm')->only('home');
    }




    public function faq(){

        if(Auth::check()){
            $name = Auth::user();
            $auth = 1;
            return view('faq',compact('name','auth'));

        }else{
            $auth = 0;
            return view('faq',compact('auth'));
        }
    }


    public function home($num=null){

//        $matches = Tournament::paginate(18);
        if(isset(Url::where('ip',request()->ip())->first()->pageUrl)){
            $page = Url::where('ip',request()->ip())->first()->pageUrl;
            Url::where('ip',request()->ip())->first()->delete();

        }
        $matches = Tournament::orderBy('endRemain','decs')->get();

        $matchDays = Tournament::paginate(18)->pluck('endRemain');

        $i = 0;
        foreach ($matchDays as $matchDay) {
            $today = Carbon::now();
            if(Carbon::parse($matchDay) >= Carbon::now()) {
                $seconds[$i] = $today->diffInSeconds(Carbon::parse($matchDay));
                $today = Carbon::now();
                $days[$i] = $today->diffInDays(Carbon::parse($matchDay));
                Tournament::where('endRemain', '=', $matchDay)->update(['endTimeDays' => $days[$i]]);
                Tournament::where('endRemain', '=', $matchDay)->update(['endTime' => $seconds[$i]]);
                $i++;

            }
            else{

                $seconds[$i] =0;
                $days[$i] = 0;

                Tournament::where('endRemain', '=', $matchDay)->update(['endTimeDays' => $days[$i]]);
                Tournament::where('endRemain', '=', $matchDay)->update(['endTime' => $seconds[$i]]);

            }
        }


        if(Auth::check()){

            $name = Auth::user();

            $matchesId = Auth::user()->matches;
            $i=0;

            if(count($matchesId)>0) {

                foreach ($matchesId as $matchId) {

                    $registereds[$i] = Tournament::where('id', $matchId->tournament_id)->first();
                    $i++;


                }

            }else{

                $registereds=[];

            }



            return view('main.userHome',compact('name','matches','registereds'));




        }else {

            return view('main.home',compact('matches'));
        }

    }

    public function viewMore($num ){



        $matches = Tournament::all()->take(9+$num);
//
        $matchDays = Tournament::all()->take(9+$num)->pluck('endRemain');

        $i = 0;
        foreach ($matchDays as $matchDay) {

            $today = Carbon::now();
            if(Carbon::parse($matchDay) >= Carbon::now()) {
                $seconds[$i] = $today->diffInSeconds(Carbon::parse($matchDay));
                $today = Carbon::now();
                $days[$i] = $today->diffInDays(Carbon::parse($matchDay));
                Tournament::where('endRemain', '=', $matchDay)->update(['endTimeDays' => $days[$i]]);
                Tournament::where('endRemain', '=', $matchDay)->update(['endTime' => $seconds[$i]]);
                $i++;

            }
            else{

                $seconds[$i] =0;
                $days[$i] = 0;

                Tournament::where('endRemain', '=', $matchDay)->update(['endTimeDays' => $days[$i]]);
                Tournament::where('endRemain', '=', $matchDay)->update(['endTime' => $seconds[$i]]);

            }
        }

        return $matches;


    }



    public function contact(){

        if(Auth::check()){
            $name = Auth::user();
            $auth = 1;
            return view('email.contact',compact('auth','name'));
        }else{

            $auth = 0;
            return view('email.contact',compact('auth'));
        }
    }

    public function postContact(ContactUsRequest $request){

        if(Auth::check()){

            $name = Auth::user();

        }else{
            $name = 'Guest';

        }
        $data = ['email' => $request->email,
                'text' => $request->message,
                'username' => $name];


        Mail::send('email.contactMail',$data,function ($message) use($data){

            $message->to('sahand.mg.ne@gmail.com');
            $message->from('admin@charesh.ir');
            $message->subject('تماس کاربر');

        });

        return redirect()->back()->with(['message'=>'پیام شما ارسال شد و به زودی پاسخ داده می شود']);


    }


    public function about(){

  //      $png = QrCode::format('png')->size(100)->generate(request()->url($_SERVER['REQUEST_URI']));
//        $png = base64_encode($png);

        if(Auth::check()){
            $name = Auth::user();
            $auth = 1;
            return view('about',compact('auth','name'));
        }else{

            $auth = 0;
            return view('about',compact('auth'));
        }


    }

    public function rules(){

        if(Auth::check()){
            $name = Auth::user();
            $auth = 1;
            return view('rules',compact('auth','name'));
        }else{

            $auth = 0;
            return view('rules',compact('auth'));
        }


    }



}

