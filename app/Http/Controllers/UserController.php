<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\Group;
use App\Match;
use App\Message;
use App\Team;
use App\Url;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        $matches = array_reverse($matches);

        return view('userProfile.UsersChalesh', compact('name', 'matches'));
    }

    public function setting()
    {

        $name = Auth::user();


        return view('userProfile.setting', compact('name'));
    }

    public function postSetting(Request $request)
    {

//	$url = 'https://www.google.com/recaptcha/api/siteverify';
//	$data = array('secret' => '6LfjSj4UAAAAANwdj6e_ee8arRU9QHLWDmfkmdL6', 'response' => $request->input('g-recaptcha-response'));
//// use key 'http' even if you send the request to https://...
//       $options = array(
//       'http' => array(
//       'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
//       'method'  => 'POST',
//       'content' => http_build_query($data),
//         ),
//       );
//       $context  = stream_context_create($options);
//       $result = file_get_contents($url, false, $context);
//       if(json_decode($result)->success === false){
//
//       return redirect()->route('setting',['username'=>Auth::user()->slug])->with(['settingError'=>'reCAPTCHA را تایید کنید' ]);
//
//       }


        $user = Auth::user();

        if ($request->input('email')) {
            $this->validate($request, ['email' => 'email|unique:users']);
            $user->update(['email' => $request->email]);


        }

        $user->update(['role'=>$request->radio]);

        if($request->input('oldPass') && !$request->input('password') || !$request->input('repeat')){
            return redirect()->back()->with(['settingError'=>'قسمت های کلمه عبور و تکرار کلمه عبور را تکمیل کنید']);
        }

        if ($request->input('password') || $request->input('repeat')) {
            if(!$request->input('oldPass')){
                return redirect()->back()->with(['settingError'=>'کلمه عبور قبلی را وارد کنید']);
            }
           if(!Hash::check($request->oldPass,Auth::user()->password)){
               return redirect()->back()->with(['settingError'=>'کلمه عبور قبلی را اشتباه وارد کردید']);
           }
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

            $user->update(['path' => $user->slug.'.'.$request->file('imageFile')->getClientOriginalExtension()]);
//
            $request->file('imageFile')->move('storage/images', $user->slug.'.'.$request->file('imageFile')->getClientOriginalExtension());
	$imgName = Auth::user()->slug.'.'.$request->file('imageFile')->getClientOriginalExtension();
	$imgEx = $request->file('imageFile')->getClientOriginalExtension();
	$imgNameNoEx = basename($imgName,'.'.$request->file('imageFile')->getClientOriginalExtension());

        exec("convert /var/www/html/charesh/public/storage/images/$imgName  /var/www/html/charesh/public/storage/images/$imgNameNoEx.jpg ");
	Auth::user()->update(['path'=>$imgNameNoEx.'.jpg']);

	if(public_path('storage/images/' . $imgName) != null && $imgEx != 'jpg'){

	        unlink(public_path('storage/images/' . $imgName));

	}

            exec("mogrify  -resize '100x100!' /var/www/html/charesh/public/storage/images/$imgNameNoEx.jpg");
        }

//        dd(Auth::user()->role);

        if(Auth::user()->role == 'customer'){

            return redirect()->route('setting',['username'=>Auth::user()->slug])->with(['message'=>'تغییرات اعمال شد']);
        }else
            if(Auth::user()->role == 'supplier'){

                if(isset(Auth::user()->organize)){

                    return redirect()->route('orgEdit',['orgName'=>Auth::user()->organize->slug])->with(['message'=>'تغییرات اعمال شد']);
                }else{
                    return redirect()->route('home');
                }

        }



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


    public function generatePdf2(Request $request)
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
	 $png = QrCode::size(200)->color(20,20,200)->backgroundColor(255,255,255)->generate("$tournament->code");
//	 $png = QrCode::size(100)->color(20,20,200)->backgroundColor(255,255,255)->generate(request()->url($_SERVER['REQUEST_URI']));

	$png = base64_encode($png);

        return view('ticket',compact('tournament','name','time','cost','credit','owner','names','png'));
    }
//
    public function generatePdf(Request $request){
	$time = time();
	$id = $request->id;
	$url = $request->name;



//        dd(request());
        //try
        //{
            // create an API client instance
           // $client = new Pdfcrowd("sahand_MG", "26d9b83a0b3872dcd154cf8c2979a48a");

            // convert a web page and store the generated PDF into a $pdf variable
      //      $pdf = $client->convertURI("http://165.227.170.114/challenge/$request->matchName/$request->name/ticket2?id=$id");
//		 exec("xvfb-run wkhtmltopdf  http://google.com  /var/www/html/ticket2.pdf");
		 exec("xvfb-run wkhtmltopdf http://charesh.ir/challenge/$request->matchName/$request->name/ticket2?id=$id  /var/www/html/$time.ticket.pdf");
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

        if(count(Url::where('ip',request()->ip())->get())) {

            Url::where('ip', request()->ip())->delete();

        }
//        $url = new Url();
//        $url->token = csrf_token();
//        $url->ip = request()->ip();
//        $url->pageUrl = $_SERVER['HTTP_REFERER'];
//        $url->save();

        $transactions = Transaction::where('user_id',Auth::id())->orderBy('created_at','dcs')->get();
        return view('userProfile.credit', compact('name','lastPage','transactions'));


    }


    public function postCredit(Request $request){


        $MerchantID = 'c06c8e74-0e3c-11e8-a51b-000c295eb8fc'; //Required
        $data = array('MerchantID' => 'c06c8e74-0e3c-11e8-a51b-000c295eb8fc',
            'Amount' => $request->credit,
            'Email' => Auth::user()->email,
            'CallbackURL' => "http://charesh.ir/$request->username/credit/verify",
            'Description' => 'افزایش اعتبار');
        $jsonData = json_encode($data);
        $ch = curl_init('https://www.zarinpal.com/pg/rest/WebGate/PaymentRequest.json');
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));
        $result = curl_exec($ch);
        $err = curl_error($ch);
        $result = json_decode($result, true);
        curl_close($ch);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            if ($result["Status"] == 100) {
                $transaction = new Transaction();
                $transaction->user_id = Auth::id();
                $transaction->money = $request->credit;
                $transaction->type = "افزایش اعتبار";
                $transaction->authority = $result['Authority'];
                $transaction->save();
                header('Location: https://www.zarinpal.com/pg/StartPay/' . $result["Authority"]);
            } else {
                echo'ERR: ' . $result["Status"];
            }
        }


    }
// تراکنش رو اول توو جانک ذخیره کن بعدش توو متد verify ببرش تووو transaction


    public function verify(Request $request){
        $Authority = $_GET['Authority'];
//        if($request->Status == 'NOK') {
//            Transaction::where('user_id', Auth::id())->orderBy('created_at', 'decs')->first()->delete();
//
//            if (isset(Url::where('ip', request()->ip())->first()->pageUrl)) {
//                $page = Url::where('ip', request()->ip())->first()->pageUrl;
//                Url::where('ip', request()->ip())->first()->delete();
//                return redirect($page)->with(['message' => 'عملیات لغو شد']);
//
//            }
//        }
        $transaction = Transaction::where('user_id',Auth::id())->orderBy('created_at','decs')->first();
        $data = array('MerchantID' => 'c06c8e74-0e3c-11e8-a51b-000c295eb8fc', 'Authority' => $Authority, 'Amount'=>$transaction->money);

        $jsonData = json_encode($data);
        $ch = curl_init('https://www.zarinpal.com/pg/rest/WebGate/PaymentVerification.json');
        curl_setopt($ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonData)
        ));
        $result = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        $result = json_decode($result, true);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            if ($result['Status'] == 100) {
                //echo 'Transation success. RefID:' . $result['RefID'];

                $transaction->completed = 1;
                $transaction->refId = $result['RefID'];
                $transaction->save();
                $credit = Auth::user()->credit;
                Auth::user()->update(['credit' => $transaction->money + $credit]);

                if(isset(Url::where('ip',request()->ip())->first()->pageUrl)){
                    $page = Url::where('ip',request()->ip())->first()->pageUrl;
                    Url::where('ip',request()->ip())->first()->delete();
                    return redirect($page)->with(['message'=>'اعتبار شما با موفقیت افزایش یافت']);
                }else{
                    return redirect()->route('home');
                }





            } else {
// echo 'Transation failed. Status:' . $result['Status'];
//	return redirect()->route('credit',['username'=>$request->username])->with(['Error'=>'تراکنش موفقیت آمیز نبود']);
                switch($result['Status']){

                    case 'NOK':
                        return redirect()->route('credit',['username'=>Auth::user()->slug])->with(['Error'=>'هيچ نوع عمليات مالي براي اين تراكنش يافت نشد￼']);
                        break;

                    case '-33':

                        $transaction->delete();
                        return redirect()->route('credit',['username'=>Auth::user()->slug])->with(['Error'=>'رقم تراكنش با رقم پرداخت شده مطابقت ندارد￼￼￼']);
                        break;

                    case '-22':
                        $transaction->delete();
                        return redirect()->route('credit',['username'=>Auth::user()->slug])->with(['Error'=>'تراكنش نا موفق مي باشد']);
                        break;

                    case '-21':
                        $transaction->delete();
                        return redirect()->route('credit',['username'=>Auth::user()->slug])->with(['Error'=>'هيچ نوع عمليات مالي براي اين تراكنش يافت نشد￼']);
                        break;

                    case '-12':
                        $transaction->delete();
                        return redirect()->route('credit',['username'=>Auth::user()->slug])->with(['Error'=>'امكان ويرايش درخواست ميسر نمي باشد']);
                        break;

                    case '-3':
                        $transaction->delete();
                        return redirect()->route('credit',['username'=>Auth::user()->slug])->with(['Error'=>'با توجه به محدوديت هاي شاپرك امكان پرداخت با رقم درخواست شده ميسر نمي باشد']);
                        break;

                    case '-54':
                        $transaction->delete();
                        return redirect()->route('credit',['username'=>Auth::user()->slug])->with(['Error'=>'درخواست مورد نظر آرشيو شده است']);
                        break;


                }
                $transaction->delete();
                return redirect()->route('credit',['username'=>Auth::user()->slug])->with(['Error'=>'ﺕﺭﺎﻜﻨﺷ ﻥﺍ ﻡﻮﻔﻗ ﻢﻴﺑﺎﺷﺩ']);

            }
        }



    }




}

