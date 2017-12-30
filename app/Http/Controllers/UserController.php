<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\Group;
use App\Match;
use App\Message;
use App\Team;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use Illuminate\Support\Facades\App;
use PdfCrowd;
use Spatie\Browsershot\Browsershot;
use App\Tournament;
use App\Organize;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Defuse\Crypto\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function userChallenge()
    {

	  $name = Auth::user();

        $matchesId = Auth::user()->matches;
        $i = 0;
        $matches = [];

        foreach ($matchesId as $matchId) {

            $matches[$i] = Tournament::where('id', $matchId->tournament_id)->first();
            $i++;
        }


        return view('userProfile.UsersChalesh', compact('name', 'matches'));
    }

    public function setting()
    {

        $name = Auth::user();


        return view('userProfile.setting', compact('name'));
    }

    public function postSetting(Request $request)
    {
	
	$url = 'https://www.google.com/recaptcha/api/siteverify';
	$data = array('secret' => '6LfjSj4UAAAAANwdj6e_ee8arRU9QHLWDmfkmdL6', 'response' => $request->input('g-recaptcha-response'));
// use key 'http' even if you send the request to https://...
        $options = array(
        'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data),
          ),
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if(json_decode($result)->success === false){

        return redirect()->route('setting',['username'=>Auth::user()->slug])->with(['settingError'=>'reCAPTCHA را تایید کنید' ]);

        }


        $user = Auth::user();

        if ($request->input('email')) {
            $this->validate($request, ['email' => 'email|unique:users']);
            $user->update(['email' => $request->email]);


        }

        if ($request->input('password') || $request->input('repeat')) {
            $this->validate($request, ['repeat' => 'required|same:password', 'password' => 'min:8']);
            $user->update(['password' => bcrypt($request->password)]);

        }


        if (null !== ($request->file('imageFile'))) {

            $time = time();
            $this->validate($request, ['imageFile' => 'image']);

//            dd($user->path != 'Blank100_100.png');

            if($user->path != 'Blank100_100.png'){

                unlink(public_path('storage/images/' . $user->path));
            }



//            if (null != glob('storage/images/Blank100_100.png')) {

//            }

            $user->update(['path' => $time . $request->file('imageFile')->getClientOriginalName()]);
//
            $request->file('imageFile')->move('storage/images', $time . $request->file('imageFile')->getClientOriginalName());
	$imgName = Auth::user()->path;
	$imgEx = $request->file('imageFile')->getClientOriginalExtension();
	$imgNameNoEx = basename($time . $request->file('imageFile')->getClientOriginalName(),'.'.$request->file('imageFile')->getClientOriginalExtension());
        exec("convert /var/www/html/chaleshjoo/public/storage/images/$imgName  /var/www/html/chaleshjoo/public/storage/images/$imgNameNoEx.jpg ");
	Auth::user()->update(['path'=>$imgNameNoEx.'.jpg']);

	if(public_path('storage/images/' . $imgName) != null && $imgEx != 'jpg'){

	        unlink(public_path('storage/images/' . $imgName));

	}

            exec("mogrify  -resize '100x100!' /var/www/html/chaleshjoo/public/storage/images/$imgNameNoEx.jpg");
        }

        return redirect()->route('setting',['username'=>Auth::user()->slug])->with(['message' => 'مشخصات شما ویرایش شد']);

    }


    public function notification()
    {

        $name = Auth::user();
        $name->update(['unread'=>0]);
//        $teamIds = Match::where('user_id',Auth::id())->pluck('team_id');
//        $i=0;
//        $j=0;
//        foreach ($teamIds as $teamId){
//
//            $msg[$i] = Message::where('team_id',$teamId)->orderby('created_at','acs')->pluck('message');
//            echo $msg[$i].'<br>';
//            $day[$i] =  Message::where('team_id',$teamId)->orderby('created_at','acs')->pluck('created_at');
//            $orgIds[$i] = Message::where('team_id',$teamId)->orderby('created_at','acs')->pluck('organize_id');
//            $matchIds[$i] = Message::where('team_id',$teamId)->orderby('created_at','acs')->pluck('tournament_id');
//
//            foreach ($matchIds[$i] as $matchId) {
//
//
//
//                if ($matchId) {
//
//                    $matchName[$i] = Tournament::where('id', $matchId)->first()->matchName;
//
//                }
//
//            }
//
//
//
//            foreach ($orgIds[$i] as $orgId) {
//
//
//
//                if ($orgId) {
//
//                    $orgName[$i] = Organize::where('id', $orgId)->first()->name;
//
//                }
//
//            }
//
//
//
//
//            $i++;
//        }
//
//        $c1 = count($teamIds);
//        $c2 = count($msg);


        $userMessages = Message::where('user_id', Auth::id())->orderBy('created_at', 'decs')->get();

        $i = 0;
        foreach ($userMessages as $userMessage) {

            $today = Carbon::now();
            $messageDay = Carbon::parse($userMessage->created_at);
            $remain[$i] = ($today->diffInDays(Carbon::parse($messageDay)));
            $i++;
        }

//        dd($userMessages[0]);


        return view('userProfile.messages', compact('name', 'userMessages', 'remain'));
    }

    public function deleteNotification(){

        $messages = Message::where('user_id',Auth::id())->get();

        foreach ($messages as $message){


            $message->delete();


        }


        return redirect()->route('notification',['username'=>Auth::user()->slug]);

    }


    public function generatePdf(Request $request)
    {
	$url = $request->name;
	$id = $request->id;
	$user = User::where('slug',$url)->first();
        $teamId = Match::where([['user_id',$user->id],['tournament_id',$id]])->first()->team_id;

        $teammates =  Group::where([['tournament_id',$id],['team_id',$teamId]])->pluck('name');

        if(count($teammates) == 0){
            $names= [$user->username];

        }else {

            for ($i = 0; $i < count($teammates); $i++) {

                $names[$i] =$teammates[$i];

            }
        }
//
        $tournament = Tournament::where('id', $id)->first();
        $name = $tournament->matchName;
        $time = $tournament->startTime;
        $cost = $tournament->cost;
        $credit = $user->credit;
        $owner = $user->username;
	 $png = QrCode::size(400)->color(20,20,200)->backgroundColor(255,255,255)->generate("$tournament->code");
//	 $png = QrCode::size(100)->color(20,20,200)->backgroundColor(255,255,255)->generate(request()->url($_SERVER['REQUEST_URI']));

	$png = base64_encode($png);

        return view('ticket',compact('tournament','name','time','cost','credit','owner','names','png'));
    }
//
    public function generatePdf2(Request $request){
	$time = time();		
	$id = $request->id;
	$url = $request->name;
        require 'pdfcrowd.php';


//        dd(request());
        //try
        //{
            // create an API client instance
           // $client = new Pdfcrowd("sahand_MG", "26d9b83a0b3872dcd154cf8c2979a48a");

            // convert a web page and store the generated PDF into a $pdf variable
      //      $pdf = $client->convertURI("http://165.227.170.114/challenge/$request->matchName/$request->name/ticket2?id=$id");
//		 exec("xvfb-run wkhtmltopdf  http://google.com  /var/www/html/ticket2.pdf");
		 exec("xvfb-run wkhtmltopdf http://gameinja.com/challenge/$request->matchName/$request->name/ticket2?id=$id  /var/www/html/$time.ticket.pdf");
            // set HTTP response headers
            header("Content-Type: application/pdf");
            header("Cache-Control: max-age=0");
            header("Accept-Ranges: none");
            header("Content-Disposition: attachment; filename=\"Ticket.pdf\"");
		readfile("/var/www/html/$time.ticket.pdf");
	//	var_dump($o);
            // send the generated PDF
//            echo $pdf;
        //}
       // catch(PdfcrowdException $why)
       // {
         //   echo "Pdfcrowd Error: " . $why;
       // }

	 unlink("/var/www/html/$time.ticket.pdf");
    }


    public function getTeamPdf($id,$url){


        $teamId = Match::where([['user_id',Auth::id()],['tournament_id',$id]])->first()->team_id;
        $teammates =  Group::where([['tournament_id',$id],['team_id',$teamId]])->pluck('name');

        if($teammates == null){
            $teammates=[];
        }
//

        $tournament = Tournament::where('id', $id)->first();
        $name = $tournament->matchName;
        $time = $tournament->startTime;
        $cost = $tournament->cost;
        $credit = Auth::user()->credit;
        $owner = Auth::user()->username;
//        $data=['name'=>$name,'time'=>$time,'cost'=>$cost,'credit'=>$credit,'teammates'=>$teammates,'owner'=>$owner,'tournament'=>$tournament];

//        $pdf = PDF::loadView('pdf', $data);

        return 'done';


    }



    public function credit()
    {

        $name = Auth::user();

        if(pathinfo($_SERVER['HTTP_REFERER']) != route('credit',['username'=>Auth::user()->username])) {

            session(['lastPage' => $_SERVER['HTTP_REFERER']]);

        }
        $lastPage = session('lastPage');
	 $transactions = Transaction::where('user_id',Auth::id())->orderBy('created_at','dcs')->get();
        return view('userProfile.credit', compact('name','lastPage','transactions'));


    }

    public function postCredit(Request $request)
    {
  	$transaction = new Transaction();
        $transaction->user_id = Auth::id();
        $transaction->money = $request->credit;
        $transaction->type = "افزایش اعتبار";
        $transaction->save();

        $credit = Auth::user()->credit;
        Auth::user()->credit = $request->credit + $credit;
        Auth::user()->save();
        $lastPage = session('lastPage');
        return redirect()->route('credit',['username'=>Auth::user()->slug])->with(['message'=>'اعتبار شما با موفقیت افزایش یافت. ']);

    }



}

