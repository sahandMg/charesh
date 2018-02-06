<?php

namespace App\Http\Controllers;

use App\BracketController;
use App\Http\Requests\ContactUsRequest;
use App\Message;
use App\Transaction;
use App\EliminationBracket;
use App\Group;
use App\GroupBracket;
use App\Http\Requests\baseInfoRequest;
use App\Http\Requests\MatchImageRequest;
use App\Http\Requests\RulesRequest;
use App\LeagueBracket;
use App\Match;
use App\Player;
use App\Team;
use App\Tournament;
use App\Junk;
use App\Url;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Intervention\Image\Facades\Image;
use Hekmatinasser\Verta\Verta;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MatchController extends Controller
{

    public function __construct()
    {
        $this->middleware('confirm')->except(['getTournament','time','getMatches']);
    }

    public function create(){
        $name = Auth::user();
        if(Url::where('ip',request()->ip())->first() != null){

         Url::where('ip',request()->ip())->delete();


        }
        $record = new Url();
        $record->token = csrf_token();
        $record->pageUrl = $_SERVER['HTTP_REFERER'];
        $record->ip = request()->ip();
        $record->save();


        if(Junk::where('user_id',Auth::id())->first()){
            Junk::where('user_id',Auth::id())->truncate();

        }

        return view('matchCreate.baseInfo',compact('name'));

    }


    public function baseInfo(){

        $name = Auth::user();

        return view('matchCreate.baseInfo',compact('name'));


    }

    public function post_baseInfo(Request $request)
    {



        $this->validate($request,['matchName'=>'regex:/^[a-zA-Z-0-9-آ ا ب پ ت ث ج چ ح خ د ذ ر ز ژ س ش ص ض ط ظ ع غ ف ق ک گ ل م ن و ه ی]+$/','comment'=>'required|between:10,1500','path'=>'image|max:1000']);
//        dd($request->comment);
//        if( count(Tournament::where('organize_id',Auth::id())->orderBy('created_at','decs')->get())>0){
//
//            $tournament = Tournament::where('organize_id',Auth::id())->orderBy('created_at','acs')->get();
//            $tournament = $tournament[0];
//
//            $tournament->update([
//                'matchName'=> $request->matchName,
//                'url'=>$request->url,
//                'startTime'=>$request->startTime,
//                'endTime'=>$request->endTime,
//                'comment'=> $request->comment
//            ]);
//
//            $today = Carbon::now();
//            $endDate = $today->addDays($tournament->endTime);
//            $tournament->update(['endRemain' => $endDate]);
//
//        }


        $tournament = new Junk();
        $time = time();
        $rand = str_random('4');
        $tournament->matchName = $request->matchName;
//        $tournament->url = $time.$request->url;
        $tournament->startTime = serialize([$request->startDay,$request->startMonth,$request->startYear]);
        $tournament->endTime = $request->endTime;
        $tournament->comment = $request->comment;



        $today = Carbon::now();
        $endDate = $today->addDays($tournament->endTime);


        $tournament->endRemain = $endDate;


        if($request->file('path')){

            $tournament->path = $tournament->slug.'-'.$rand.'.'.$request->file('path')->getClientOriginalExtension();
//            Storage::disk('local')->put($time.$request->file('path')->getClientOriginalName(), 'images');
            $request->file('path')->move('storage/images',$tournament->slug.'-'.$rand.'.'.$request->file('path')->getClientOriginalExtension());

            $imgName = $tournament->slug.'-'.$rand.'.'.$request->file('path')->getClientOriginalExtension();
            $imgEx = $request->file('path')->getClientOriginalExtension();
            $imgNameNoEx = basename($tournament->slug.'-'.$rand,'.'.$request->file('path')->getClientOriginalExtension());
            exec("convert /var/www/html/charesh/public/storage/images/$imgName  /var/www/html/charesh/public/storage/images/$imgNameNoEx.jpg ");
            $tournament->path = $imgNameNoEx.'.jpg';

            if(public_path('storage/images/' . $imgName) != null &&  $imgEx != 'jpg'){

                unlink(public_path('storage/images/' . $imgName));

            }

            exec("mogrify  -resize '1290x600!' /var/www/html/charesh/public/storage/images/$imgNameNoEx.jpg");



        }else{

            $tournament->path  = "Blank.png";

        }



        $tournament->save();

        return redirect()-> route('matchInfo');

    }


    public function matchInfo(){

        $name = Auth::user();

        return view('matchCreate.matchInfo',compact('name'));

    }


    public function post_matchInfo(Request $request){


        $this->validate($request,['prize'=>'required|between:10,1500']);
        $tournament = Junk::where([['user_id',Auth::id()],['organize_id',Auth::user()->organize->id]])->orderBy('created_at','decs')->first();
//        $tournament = $tournament[0];

        $tournament->update([
            'mode'=> $request->mode,
            'matchType'=>$request->matchType,
            'maxAttenders'=>$request->maxAttenders,
            'attendType'=>$request->attendType,
            'prize'=> $request->prize,
            'maxTeam'=>$request->maxTeam,
            'subst'=>$request->subst,
            'maxMember'=>$request->maxMember,
            'lat'=> $request->lat,
            'lng' => $request->lng,
            'address' => $request->address,
            'city'=>$request->city
        ]);

//        $tournament->mode = $request->mode;
//        $tournament-> matchType = $request->matchType;
//        $tournament->maxAttenders = $request->maxAttenders;
//        $tournament->attendType = $request->attendType;
//        $tournament->prize = $request->prize;
//
//        $tournament->save();

        return redirect()-> route('rules');

    }



    public function rules(){

        $name = Auth::user();

        return view('matchCreate.rules',compact('name'));

    }


    public function post_rules(RulesRequest $request){

        $time = time();

        $tournament = Junk::where([['user_id',Auth::id()],['organize_id',Auth::user()->organize->id]])->orderBy('created_at','decs')->first();
//        dd($time.$request->file('rulesPath')->getClientOriginalName());
        $tournament->rules = $time.$request->file('rulesPath')->getClientOriginalName();

        $request->file('rulesPath')->move('storage/pdfs',$time.$request->file('rulesPath')->getClientOriginalName());

        $tournament->save();
        return redirect()-> route('cost');

    }


//    public function plan(){
//
//        $name = Auth::user();
//
//        return view('matchCreate.table',compact('name'));
//
//    }


//    public function post_plan(Request $request){
//        $this->validate($request,['plan'=>'required|between:10,1500']);
//        $tournament = Junk::where([['user_id',Auth::id()],['organize_id',Auth::user()->organize->id]])->orderBy('created_at','decs')->first();
//
//        $tournament->plan = $request->plan;
//
//        $tournament->save();
//        return redirect()-> route('cost');
//
//    }

    public function cost(){

        $name = Auth::user();

        return view('matchCreate.cost',compact('name'));

    }



    public function post_cost(Request $request){


        $tournament = Junk::where([['user_id',Auth::id()],['organize_id',Auth::user()->organize->id]])->orderBy('created_at','decs')->first();
        $tournament->free = $request->free;
        if($request->free == 'on'){
            $tournament->cost = 0;
        }else{
            $tournament->cost = $request->cost;
        }
        $tournament->moreInfo = serialize([$request->column,$request->column2,$request->column3,$request->column4,$request->column5]);
        $tournament->save();

        Junk::where('user_id',Auth::id())->delete();
//        $junks  = Junk::all();
//
//        for ($i=0 ; $i < count($junks); $i++) {
////
//            $current = Carbon::now();
//            $create = Carbon::parse($junks[$i]->created_at);
//
//            if ($current->diffInHours($create) > 1) {
//
//
//                Junk::where('created_at', '=', $junks[$i]->created_at)->first()->delete();
//
//            }
//        }
//



        $tournamentItems = new Tournament();


        $tournamentItems->matchName = $tournament->matchName;
        $tournamentItems->url = str_random(5);
        $tournamentItems->startTime = $tournament->startTime;
        $tournamentItems->endTime = $tournament->endTime;
        $tournamentItems->endRemain = $tournament->endRemain;
        $tournamentItems->endRemain = $tournament->endRemain;
        $tournamentItems->comment = $tournament->comment;
        $tournamentItems->address = $tournament->address;
        $tournamentItems->lat = $tournament->lat;
        $tournamentItems->lng = $tournament->lng;
        $tournamentItems->path = $tournament->path;
        $tournamentItems->mode = $tournament->mode;
        $tournamentItems->matchType = $tournament->matchType;
        $tournamentItems->maxAttenders = $tournament->maxAttenders;
        $tournamentItems->maxTeam = $tournament->maxTeam;
        $tournamentItems->maxMember = $tournament->maxMember;
        $tournamentItems->subst = $tournament->subst;
        $tournamentItems->attendType = $tournament->attendType;
        $tournamentItems->prize = $tournament->prize;
        $tournamentItems->rules = $tournament->rules;
        $tournamentItems->city = $tournament->city;
        $tournamentItems->cost = $tournament->cost;
        $tournamentItems->moreInfo = $tournament->moreInfo;
        $tournamentItems->user_id = Auth::id();
        $tournamentItems->organize_id = Auth::user()->organize->id;
        $tournamentItems->sold = 0;
        $tournamentItems->code = str_random(10);
        if($tournament->maxAttenders){
            $tournamentItems->tickets = $tournament->maxAttenders;
        }else{
            $tournamentItems->tickets = $tournament->maxTeam;
        }

        $tournamentItems -> save();
        Url::where('ip',request()->ip())->delete();
        $tournament = Junk::where([['user_id',Auth::id()],['organize_id',Auth::user()->organize->id]])->orderBy('created_at','decs')->first();
        $matchDays = Tournament::all()->pluck('endRemain');

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

        if(!$tournamentItems->path){

            $tournamentItems->path = "Blank.png";
        }

//        Junk::truncate();

        Junk::where('organize_id',Auth::user()->organize->id)->orderBy('created_at','decs')->delete();
        return redirect()->route('orgMatches',['orgName'=>Auth::user()->organize->slug]);

    }

    public function getMatches(){



        $tournaments = Tournament::all();
        return $tournaments;
    }

    public function time (){
//        $today = Carbon::now();
//        $junks  = Junk::all()->pluck('created_at');
//
//        for ($i=0 ; $i < count($junks); $i++) {
////
//            $current = Carbon::now();
//            $create = Carbon::parse($junks[$i]);
//
//            if ($current->diffInHours($create) > 1) {
//
//
//                Junk::where('created_at', '=', $junks[$i])->first()->delete();
//
//            }
//        }
//        $matchDays = Tournament::all()->pluck('endRemain');
//
//        $i = 0;
//            foreach ($matchDays as $matchDay) {
//                    $today = Carbon::now();
//                  if(Carbon::parse($matchDay) >= Carbon::now()) {
//                      $seconds[$i] = $today->diffInSeconds(Carbon::parse($matchDay));
//                      $today = Carbon::now();
//                      $days[$i] = $today->diffInDays(Carbon::parse($matchDay));
//                      Tournament::where('endRemain', '=', $matchDay)->update(['endTimeDays' => $days[$i]]);
//                      Tournament::where('endRemain', '=', $matchDay)->update(['endTime' => $seconds[$i]]);
//                      $i++;
//
//                  }
//                  else{
//
//                      $seconds[$i] =0;
//                      $days[$i] = 0;
//
//                      Tournament::where('endRemain', '=', $matchDay)->update(['endTimeDays' => $days[$i]]);
//                      Tournament::where('endRemain', '=', $matchDay)->update(['endTime' => $seconds[$i]]);
//
//                  }
//                }
        return 1;

    }



    public function GetMatch(Request $request){


        session(['tournamentId'=>$request->id]);

        return $request->input('id') ;

    }


    public function getTournament(Request $request){

        if(session('tournamentId')){
            $id = session('tournamentId');
        }else{
            $id = $request->id;

        }


        $tournament = Tournament::where('id',$id)->first();

        return $tournament;

    }

    public function returnBI(){

        $tournament = Junk::where('organize_id',Auth::user()->organize->id)->orderBy('created_at','decs')->get();

        $tournament = $tournament[0];
        $tournament->delete();




        return redirect()->route('baseInfo');

    }

    public function returnMI(){



        return redirect()->route('matchInfo');

    }


    public function returnRI(){


        return redirect()->route('rules');

    }


    public function returnPI(){



        return redirect()->route('rules');

    }

    public function returnCI(){


        return redirect()->route('cost');

    }

    public function MatchRegister(Request $request){
	$id = $request->id;
       $matchDays = Tournament::all()->pluck('endRemain');
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


            if($tournament = Tournament::where('id' , $id)->first() == null){

                abort('404');
            }
            $tournament = Tournament::where('id' , $id)->first();
        $users = Match::where([['tournament_id',$id],['user_id',Auth::id()]])->first();

        $route = 'register';

        $org = $tournament->organize;

        if(Auth::check()){
            $name = Auth::user();
            $auth = 1;
            return view('matchReg.matchReg',compact('name','tournament','route','users','auth','org'));

        }else{

            $auth = 0;
            return view('matchReg.matchReg',compact('tournament','route','users','auth','img','org'));
        }

        }


        $name = Auth::user();
        $users = Match::where([['tournament_id',$id],['user_id',Auth::id()]])->first();
        $tournament = Tournament::where('id' , $id)->first();
        $route = 'register';
        $org = $tournament->organize;
        if(Auth::check()){
            $name = Auth::user();
            $auth = 1;
  //          return view('matchReg.matchReg',compact('name','tournament','route','users','auth','org'));

        }else{

            $auth = 0;
 //           return view('matchReg.matchReg',compact('tournament','route','users','auth','img','org'));
        }

    }

    public function RegOverView(Request $request){

        $name = Auth::user();
        $tournament = Tournament::where('id',$request->id)->first();
        return view('matchReg.RegOverView',compact('name','tournament'));
    }


    public function MatchBracket(Request $request){
	$id = $request->id;
        $name = Auth::user();
        session(['routeName'=>'bracket']);
        $tournament = Tournament::where('id', $id)->first();
        $route = 'bracket';
        $bracketDetail =  Tournament::where('id',$id)->first()->groupBracket;
        $teamName = unserialize($bracketDetail->bracketTable);
        $tableData = unserialize($bracketDetail->GroupBracketTableEdit);
//        dd($teamName);
        if(Auth::check()){
            $name = Auth::user();
            $auth = 1;


//            dd($tableData);
            return view('matchReg.groupBracket',compact('teamName','name','tournament','route','users','auth','bracketDetail','tableData'));

        }else{

            $auth = 0;
            return view('matchReg.groupBracket',compact('teamName','tournament','route','users','auth','bracketDetail','tableData'));
        }
    }

    public function MatchGElBracket(Request $request){
	$id = $request->id;
        $name = Auth::user();
        session(['routeName'=>'bracket']);
        $tournament = Tournament::where('id', $id)->first();
        $route = 'bracket';
        $table = unserialize(GroupBracket::where('tournament_id',$id)->first()->ElBracketTableEdit);
        $teams = Tournament::where('id', $id)->first()->teams;
        if(Auth::check()){
            $name = Auth::user();
            $auth = 1;
//            dd(count($table['teams']));
// $route = 'bracket';

//            dd($table['teams']);
            return view('matchReg.mosabegheBrackets2H',compact('request','name','tournament','route','users','auth','table','teams'));

        }else{

            $auth = 0;
            return view('matchReg.mosabegheBrackets2H',compact('request','tournament','route','users','auth','table'));
        }
    }

    public function getGElBracket(Request $request){

	$id = $request->id;
        $table = [];
        if(isset(GroupBracket::where('tournament_id',$id)->first()->ElBracketTableEdit)){

            $table = unserialize(GroupBracket::where('tournament_id',$id)->first()->ElBracketTableEdit);

            return $table;

        }

        return $table;




    }

    public function getElBracket(Request $request){

	$id = $request->id;
        $table=[];
        if(isset(EliminationBracket::where('tournament_id',$id)->first()->ElBracketTableEdit)){

            $table = unserialize(EliminationBracket::where('tournament_id',$id)->first()->ElBracketTableEdit);

            return $table;
        }else{

            return $table;
        }





    }

    public function MatchElBracket(Request $request){

	 $id = $request->id;
        $name = Auth::user();
        session(['routeName'=>'bracket']);
        $tournament = Tournament::where('id', $id)->first();
        $route = 'bracket';
        if(Auth::check()){
            $name = Auth::user();
            $auth = 1;
            $table = unserialize(EliminationBracket::where('tournament_id',$id)->first()->ElBracketTableEdit);
//            dd(count($table['teams']));
// $route = 'bracket';

            $teams = Tournament::where('id', $id)->first()->teams;
//            dd($table['teams']);
            return view('matchReg.mosabegheBracketsH1',compact('request','name','tournament','route','users','auth','table','teams'));

        }else{

            $auth = 0;
            return view('matchReg.mosabegheBracketsH1',compact('request','tournament','route','users','auth','table'));
        }

    }


    public function MatchTimeline(Request $request){
	 $id = $request->id;
        $name = Auth::user();
        session(['routeName'=>'timeline']);
        $tournament = Tournament::where('id', $id)->first();
        $route = 'timeline';
        if(Auth::check()){
            $name = Auth::user();
            $auth = 1;
            return view('matchReg.matchTime',compact('name','tournament','route','users','auth'));

        }else{

            $auth = 0;
            return view('matchReg.matchTime',compact('tournament','route','users','auth'));
        }    }


    public function MatchAttenders(Request $request){
 	$id = $request->id;
        $name = Auth::user();
        session(['routeName'=>'attenders']);
        $tournament = Tournament::where('id', $id)->first();
        $route = 'attenders';
        $team = [];
        $player = [] ;
        if($tournament->matchType == 'انفرادی'){

            $usrIds = Match::where('tournament_id',$id)->pluck('user_id');

            $i=0;



            foreach ($usrIds as $usrId){

                $player[$i] = User::where('id',$usrId)->first();
                $i++;
            }

        }else{

            $teamIds = Player::where('tournament_id',$id)->get();
            $i=0;
            foreach ($teamIds as $teamId){

                $team[$i] = Team::where('id',$teamId->team_id)->first();
//                $userName[$i] = Match::where('team_id',$teamId->team_id)->get();
                $groupMem[$i] = Group::where('team_id',$teamId->team_id)->get();
                $i++;
            }
        }




        if(Auth::check()){
            $name = Auth::user();
            $auth = 1;

            return view('matchReg.matchUser',compact('name','tournament','route','users','auth','player','team','groupMem'));

        }else{

//            dd($teamIds);
            $auth = 0;
            return view('matchReg.matchUser',compact('tournament','route','users','auth','player','team','userName','groupMem'));
        }    }

//    public function MatchAnnounce($id,$url){
//
//        $name = Auth::user()->username;
//        session(['routeName'=>'announce']);
//        $tournament = Tournament::where(['matchName' => $url ,'id' => $id])->first();
//        $route = 'announce';
//
//        return view('matchReg.matchAnnouncement',compact('name','tournament','route'));
//    }




    public function GetRoute(){

        return session('routeName');

    }

    public function singleRegister(Request $request)
    {


        $teammates=[];
        $match = Tournament::where('id', $request->id)->first();
        $sub = 0;
        for($s=0;$s<count(unserialize($match->moreInfo));$s++){

            if(unserialize($match->moreInfo)[$s]==null){
                $sub ++;
            }
        }

//            Single register
        if ($request->input('single') == 'single') {

            if( null != Match::where([ ['tournament_id',$request->id],['user_id',Auth::id()]])->first()){

//                dd('dsa');
                return redirect()->back()->with(['message'=>'شما پیش از این در مسابقه ثبت نام کرده اید']);

            }



            if($match->moreInfo){

                for($p=1 ; $p<=count(unserialize($match->moreInfo))-$sub;$p++){

                    if($request->info[$p] == null){

                       return redirect()->back()->with(['RegError'=>'بخش اطلاعات اضافه را تکمیل کنید'])->withInput();

                    }

                }

            }





            if (Auth::user()->credit >= $match->cost ) {
                $info =[];
                Auth::user()->update(['credit' => Auth::user()->credit - $match->cost]);
                $match->organize->totalTickets =  $match->organize->totalTickets + 1;
                $match->organize->update(['credit'=>$match->organize->credit + $match->cost]) ;
//                dd($match->organize->credit + $match->sold * $match->cost);
                $match->organize->update(['totalTickets'=> $match->organize->totalTickets ]);

                $match->sold =   $match->sold+1;
                $match->update(['sold'=>$match->sold]);

                $matchTable = new Match();

                $matchTable->user_id = Auth::id();

                $matchTable->tournament_id = $request->id;

                $matchTable->image = Auth::user()->path;

                for ($p = 1; $p <= count(unserialize($match->moreInfo)) - $sub; $p++) {

                    array_push($info, $request->info[$p]);
                }
                $matchTable->moreInfo = serialize($info);

                $matchTable->save();

                    $transaction = new Transaction();
                    $transaction->type = "شرکت در مسابقه " . $match->matchName;
                    $transaction->money = $match->cost;
                    $transaction->user_id = Auth::id();
                    $transaction->tournament_id = $match->id;
                    $transaction->save();

                $data = ['match'=>$match ,'matchName' => $match->matchName, 'credit' => Auth::user()->credit, 'cost' => $match->cost, 'startTime' => $match->startTime, 'email' => Auth::user()->email, 'teammates'=>$teammates];
                Mail::send('email.matchData', $data, function ($message) use ($data) {

                    $message->from('admin@charesh.ir');
                    $message->to($data['email']);
                    $message->subject('ثبت نام مسابقه');

                });



                return redirect()->route('userChallenge',['username'=>Auth::user()->slug]);
            } else {

                return redirect()->back()->with(['creditError' => 'متاسفانه اعتبار شما برای خرید بلیط کافی نیست.'])->withInput();

            }
        }

//        Team register
        else{

//

//        dd($match->subst + $match->maxMember);
            $sub = 0;
            $subst = 0;
            for($s=1;$s<= $match->subst;$s++){

                if($request->subst.$s != null){

                    $subst++;
                }
            }
            for($s=0;$s<count(unserialize($match->moreInfo));$s++){

                if(unserialize($match->moreInfo)[$s]==null){
                    $sub ++;
                }
            }


            for($i = 1; $i <= ($match->maxMember); $i++) {

                if(null == $request->input("teammate$i")){

                    $this->validate($request, ["teammate" => 'required']);

                }

                if($match->moreInfo){

                    for($p=1 ; $p<=count(unserialize($match->moreInfo))-$sub;$p++){

                        if($request->info[$i][$p] == null){

                            return redirect()->back()->with(['RegError'=>'بخش اطلاعات اضافه را تکمیل کنید'])->withInput();
                        }

                    }

                }
                }


            $this->validate($request,['teamName'=>'required|unique:teams|regex:/^[a-zA-Z-0-9-آ ا ب پ ت ث ج چ ح خ د ذ ر ز ژ س ش ص ض ط ظ ع غ ف ق ک گ ل م ن و ه ی]+$/','logo'=>'image']);

//            if($sub == 4 && null == $request->input('additionalData')){
//
//                $this->validate($request,['additionalData'=>'required']);
//
//            }

            $match = Tournament::where('id', $request->matchId)->first();

            if( null != Match::where([ ['tournament_id',$request->matchId],['user_id',Auth::id()]])->first()){

                return redirect()->back()->with(['message'=>'شما پیش از این در مسابقه ثبت نام کرده اید']);

            }

//                dd($_POST);




            if ($match->cost * ($subst +$match->maxMember) <= User::where('username', Auth::user()->username)->first()->credit) {

                    if ($match->tickets - $match->sold - 1 >= 0) {


                        $number = $match->maxMember;
                        $time = time();
                        $team = new Team();

                        $team->teamName = $request->teamName;
                        $team->tournament_id = $request->matchId;
                        if (null != $request->file('logo')) {

                            $team->path = $team->teamName;
//            Storage::disk('local')->put($time.$request->file('path')->getClientOriginalName(), 'images');
                            $request->file('logo')->move('storage/images',$team->teamName.'.'. $request->file('logo')->getClientOriginalExtension());
                            $imgName = $team->teamName.'.'.$request->file('logo')->getClientOriginalExtension();;
                            $imgEx = $request->file('logo')->getClientOriginalExtension();
                            $imgNameNoEx = basename($team->teamName,'.'.$request->file('logo')->getClientOriginalExtension());
                            exec("convert /var/www/html/charesh/public/storage/images/$imgName  /var/www/html/charesh/public/storage/images/$imgNameNoEx.jpg ");
                            $team->path = $imgNameNoEx.'.jpg';

                            if(public_path('storage/images/' . $imgName) != null &&  $imgEx != 'jpg'){

                                unlink(public_path('storage/images/' . $imgName));

                            }

                            exec("mogrify  -resize '100x100!' /var/www/html/charesh/public/storage/images/$imgNameNoEx.jpg");





                        } else {
                            $team->path = 'Blank100_100.png';
                        }
                        $team->save();




                        for ($i = 1; $i <= ($match->maxMember + $subst); $i++) {

                            $info = [];
                            $group = new Group();

                            $group->name = $request["teammate$i"];

                            $group->team_id = Team::where('teamName', $request->teamName)->first()->id;
                            $group->tournament_id = $request->matchId;
                            $group->organize_id = $match->organize->id;

                            for ($p = 1; $p <= count(unserialize($match->moreInfo)) - $sub; $p++) {

                                array_push($info, $request->info[$i][$p]);
                            }
                            $group->moreInfo = serialize($info);

                            $group->save();

                        }

//                dd(count($_POST)-4);
//                dd(Match::where([['user_id',$userId],['tournament_id',$request->matchId]])->first());
                        $match->organize->totalTickets = $match->organize->totalTickets + 1;
                        $match->organize->update(['credit' => $match->organize->credit + $match->cost * ($match->maxMember + $subst)]);
//                    dd($match->organize->totalTickets);
                        $match->organize->update(['totalTickets' => $match->organize->totalTickets]);

                        $match->sold = $match->sold + 1;

                        $match->update(['sold' => $match->sold]);

                        User::where('username', Auth::user()->username)->first()->update(['credit' => User::where('username', Auth::user()->username)->first()->credit - $match->cost * ($match->maxMember + $subst)]);


//                }
                    } else {
                        return redirect()->back()->with(['RegError' => 'تعداد بلیط های درخواستی بیشتر از بلیط های مسابقه می باشد'])->withInput();
                    }
                } else {
//                dd($match->cost * count($_POST) > User::where('username', Auth::user()->username)->first()->credit);
                    return redirect()->back()->with(['RegError' => 'متاسفانه اعتبار شما برای خرید بلیط کافی نیست'])->withInput();
                }


            $matchTable2 = new Match();


            $matchTable2->user_id = Auth::id();
            $matchTable2->tournament_id = $request->matchId;
            $matchTable2->team_id = Team::where('teamName',$request->teamName)->first()->id;
            $matchTable2->moreInfo = $request->additionalData;
            $matchTable2->image = Team::where('tournament_id',$request->matchId)->first()->path;
            $matchTable2->save();

            $player = new Player();

            $player->team_id = Team::where('teamName',$request->teamName)->first()->id;

            $player->tournament_id = $request->matchId;

            $player->save();

//            $player = new Match();
//
//            $player->user_id = User::where('username',$request->leader)->first()->id;
//            $player->tournament_id = $request->matchId;
//            $player->team_id = Team::where('teamName',$request->teamName)->first()->id;
//            $player->save();

                $transaction = new Transaction();
                $transaction->type = "شرکت در مسابقه " . $match->matchName;
                $transaction->money = $match->cost * ($subst + $match->maxMember);
                $transaction->user_id = Auth::id();
                $transaction->tournament_id = $match->id;
                $transaction->save();

            $teammates=Group::where('team_id',Team::where('teamName',$request->teamName)->first()->id)->get();
            $data = ['match'=>$match,'matchName' => $match->matchName, 'credit' =>User::where('id',Auth::user()->id)->first()->credit, 'cost' => $match->cost, 'startTime' => $match->startTime, 'email' => Auth::user()->email,'teammates'=>$teammates];
            Mail::send('email.matchData', $data, function ($message) use ($data) {

                $message->from('admin@charesh.ir');
                $message->to($data['email']);
                $message->subject('ثبت نام مسابقه');

            });
        }

        return redirect()->route('userChallenge',['username'=>Auth::user()->slug]);
    }


    public function LeagueTable(Request $request){

	 $id = $request->id;
        $name = Auth::user();
        session(['routeName'=>'bracket']);
        $tournament = Tournament::where('id' , $id)->first();
        $route = 'bracket';
        $bracketDetail =  Tournament::where('id',$id)->first()->leagueBracket;
        if($tournament->matchType == 'انفرادی'){

            $matches = Tournament::where('id',$id)->first()->matches;

            for ($i=0 ; $i<count($matches) ; $i++){

                $teams[$i] = $matches[$i]->user;
            }

        }else{

            $teams = Tournament::where('id',$id)->first()->teams;

        }
//        dd($teams);
        $table = unserialize(LeagueBracket::where('tournament_id',$id)->first()->LTable);

        if(unserialize($bracketDetail->LTable)[0][1] == null){

            $roundSign = 0;
        }else {
            $roundSign = 1;
        }



        if(Auth::check()){
            $name = Auth::user();
            $auth = 1;
//
//            dd($table[0][1]);
//            dd(unserialize($bracketDetail->LTable)[0][0][0][0]);
//            dd(User::where('username',unserialize($bracketDetail->LTable)[0][0][0][0])->first());
            return view('matchReg.mosabegheBracketsL',compact('name','tournament','route','users','auth','table','teams','bracketDetail','roundSign'));

        }else{

            $auth = 0;
            return view('matchReg.mosabegheBracketsL',compact('tournament','route','users','auth','table','bracketDetail','teams','roundSign'));
        }




    }


    public function GetRound(Request $request){


//        $brackets = LeagueBracket::where('tournament_id',$request->id)->get();
//
//        foreach ($brackets as $bracket){
//
//           $round = unserialize($bracket->LTable)[0][2];
//
//            if($round == $request->round){
//
//                return  unserialize($bracket->LTable)[0][1];
//
//            }
//
//        }
//
//        return '1';


        $brackets = LeagueBracket::where('tournament_id',$request->id)->get();

        $sign = 0;
        $teamArr=[];
        $name = Auth::user();
        $tournament = Tournament::where('id', $request->id)->first();
        $route = 'bracket';
        $table = unserialize(LeagueBracket::where('tournament_id',$request->id)->first()->LTable);
//        session(['bracketDetail'=> Tournament::where('id',$id)->first()->leagueBracket]);
        if($tournament->matchType == 'انفرادی'){

            $matches = Tournament::where('id',$request->id)->first()->matches;

            for ($i=0 ; $i<count($matches) ; $i++){

                $teams[$i] = $matches[$i]->user;
            }

        }else{

            $teams = Tournament::where('id',$request->id)->first()->teams;

        }
//        dd((unserialize($bracketDetail->LTable)));
        if($brackets != null) {

            if(Auth::check()) {
                $name = Auth::user();
                $auth = 1;
            }else{

                $auth = 0;
            }

            foreach ($brackets as $bracket) {

                $s=0;



                if (unserialize($bracket->LTable) != null) {

                    if (unserialize($bracket->LTable)[0][2] == $request->round) {

//                    session(['bracketDetail'=> $bracket]);


                        $bracketDetail = $bracket;
                        $roundSign = 1;

                        for ($p = 0; $p < floor(count($teams) / 2); $p++) {


                            if (unserialize($bracket->LTable)[0][1][$p][0] != null && unserialize($bracket->LTable)[0][1][$p][4] != null) {

                                $teamArr[$s] = unserialize($bracket->LTable)[0][1][$p][0] ;
                                $teamArr[$s+1] =  unserialize($bracket->LTable)[0][1][$p][4];

                                $s+=2;
                            }
                        }


                        $sign++;
                        return View::make('matchReg.mosabegheBracketsL',compact('name', 'tournament', 'route','teams','bracketDetail','roundSign','teamArr','table','auth'))->renderSections()['round'];
                    }

                }

            }

            $bracket = LeagueBracket::where('tournament_id',$request->id)->first();

//            foreach ($brackets as $bracket){
//
//                if(unserialize($bracket->LTable)[0][2] != $request->round){
//
//                    $NewBracket = $bracket->replicate();
//                    $NewBracket->save();
//
//                    $bracketDetail = $NewBracket;
//
//                }
//
//            }

//            if(unserialize($bracket->LTable)[0][2] != null) {
//                $arr = array_pop(unserialize($bracket->LTable)[0][2]);
//                $bracket->LTable = array_push($arr[0], $request->round);
//                $bracket->save();
//            }
//            $NewBracket = $bracket->replicate();
//                    $NewBracket->save();

            $bracketDetail = $bracket;

            $roundSign = 0;

//            return $bracket;
            return View::make('matchReg.mosabegheBracketsL',compact('name', 'tournament', 'route','teams','bracketDetail','roundSign','teamArr','table','auth'))->renderSections()['round'];
        }else{


            return 0;
        }



    }
    public function userMessage(ContactUsRequest $request){

        $msg = new Message();
        if($request->input('name')){
            $msg->name = $request->name;
        }else{
            $msg->name = Auth::user()->username;
        }
        if($request->input('email')){
            $msg->email = $request->email;
        }else{
            $msg->email = Auth::user()->email;
        }
        $msg->message = $request->message;
        $msg->sender = 'user';
        if(Auth::check()){
            $msg->user_id = Auth::id();
        }
        $org = Tournament::where('id',$request->id)->first()->organize;
        $msg->organize_id = $org->id;
        $msg->tournament_id = Tournament::where('id',$request->id)->first()->id;
        $msg->save();
        $org->update(['unread'=>$org->unread+1]);
        $data = ['name'=>$request->name,'email'=>$request->email,'comment'=>$request->message,'org'=>$org];

        Mail::send('email.matchRegisterMail',$data,function ($message) use($data){

            $message->from('admin@charesh.ir');
            $message->to($data['org']->user->email);
            $message->subject('تماس با برگزار کننده');

        });

        return redirect()->back()->with(['message'=>'پیام شما ارسال شد']);
//
    }

    public function challengeDetail(Request $request){
	 $id = $request->id;

        $name = Auth::user();
        $users = Match::where([['tournament_id',$id],['user_id',Auth::id()]])->first();

        $tournament = Tournament::where('id' , $id)->first();
        $route = 'register';
        $img = $tournament->organize->logo_path;
        $auth = 1;
	$org = $tournament->organize;
        return view('matchReg.matchReg',compact('name','tournament','route','users','auth','img','org'));
    }

    public function getTeamImage(Request $request){
//

        $img = Team::where('teamName',$request->name)->first()->path;

        if($img == null){

            $img = User::where('username',$request->name)->first()->path;

        }

        return $img;


    }

    public function selectMatchBracket(Request $request){
	 $id = $request->id;
        $bracket = BracketController::where('tournament_id',$id)->first();


//      dd($bracket);
        if($bracket != null ) {

            if ($bracket->group == 1) {


                return redirect()->route('matchGroupBracket', ['id' => $id,'matchName'=>$request->matchName ]);


            } elseif ($bracket->elimination == 1) {

                return redirect()->route('matchElBracket', ['id' => $id,'matchName'=>$request->matchName]);

            } else {

                return redirect()->route('LeagueTable2', ['id' => $id,'matchName'=>$request->matchName]);

            }
        }else {

            return redirect()->route('noBracket', ['id' => $id,'matchName'=>$request->matchName]);
        }




    }

    public function noBracket(Request $request){
 $id = $request->id;
        $name = Auth::user();
        $tournament = Tournament::where('id',$id)->first();
        $route = 'bracket';
        if(Auth::check()){

            $auth = 1;
        }else{
            $auth = 0 ;
        }
        return view('matchReg.noBracket',compact('name','tournament','auth','route'));

    }




}

