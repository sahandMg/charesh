<?php

namespace App\Http\Controllers;

use App\BracketController;
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
use App\User;
use Carbon\Carbon;
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


        return view('matchCreate.baseInfo',compact('name'));

    }


    public function baseInfo(){

        $name = Auth::user();

        return view('matchCreate.baseInfo',compact('name'));


    }

    public function post_baseInfo(Request $request)
    {


        $this->validate($request,['comment'=>'required']);
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

        $tournament->matchName = $request->matchName;
        $tournament->url = $time.$request->url;
        $tournament->startTime = $request->startTime;
        $tournament->endTime = $request->endTime;
        $tournament->comment = $request->comment;



        $today = Carbon::now();
        $endDate = $today->addDays($tournament->endTime);


        $tournament->endRemain = $endDate;


        if($request->file('path')){

            $tournament->path = $time.$request->file('path')->getClientOriginalName();
//            Storage::disk('local')->put($time.$request->file('path')->getClientOriginalName(), 'images');
            $request->file('path')->move('storage/images',$time.$request->file('path')->getClientOriginalName());
            Image::make('storage/images/'.$time.$request->file('path')->getClientOriginalName())->resize(1290,600)->save();


        }else{

            $tournament->path  = "Blank.png";

        }



        $tournament->user_id = Auth::id();
        $tournament->organize_id = Auth::user()->organize->id;

        $tournament->save();

        return redirect()-> route('matchInfo');

    }


    public function matchInfo(){

        $name = Auth::user();

        return view('matchCreate.matchInfo',compact('name'));

    }


    public function post_matchInfo(Request $request){



        $this->validate($request,['prize'=>'required']);
        $tournament = Junk::where([['user_id',Auth::id()],['organize_id',Auth::user()->organize->id]])->orderBy('created_at','decs')->first();
//        $tournament = $tournament[0];

        $tournament->update([
            'mode'=> $request->mode,
            'matchType'=>$request->matchType,
            'maxAttenders'=>$request->maxAttenders,
            'attendType'=>$request->attendType,
            'prize'=> $request->prize,
            'maxTeam'=>$request->maxTeam,
            'minMember'=>$request->minMember,
            'maxMember'=>$request->maxMember,
            'lat'=> $request->lat,
            'lng' => $request->lng,
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
        return redirect()-> route('plan');

    }


    public function plan(){

        $name = Auth::user();

        return view('matchCreate.table',compact('name'));

    }


    public function post_plan(Request $request){
        $this->validate($request,['plan'=>'required']);
        $tournament = Junk::where([['user_id',Auth::id()],['organize_id',Auth::user()->organize->id]])->orderBy('created_at','decs')->first();

        $tournament->plan = $request->plan;

        $tournament->save();
        return redirect()-> route('cost');

    }

    public function cost(){

        $name = Auth::user();

        return view('matchCreate.cost',compact('name'));

    }


    public function post_cost(Request $request){



        $tournament = Junk::where([['user_id',Auth::id()],['organize_id',Auth::user()->organize->id]])->orderBy('created_at','decs')->first();
        $tournament->cost = $request->cost;
        $tournament->moreInfo = $request->moreInfo;
        $tournament->save();

        return redirect()-> route('contactInfo');

    }



    public function contactInfo(){


        $name = Auth::user();

        return view('matchCreate.contact',compact('name'));


    }

    public function post_contactInfo(Request $request){


        $tournament = Junk::where([['user_id',Auth::id()],['organize_id',Auth::user()->organize->id]])->orderBy('created_at','decs')->first();
        $tournament->email = $request->email;
        $tournament->telegram = $request->telegram;
        $tournament->save();

        $junks  = Junk::all();

        for ($i=0 ; $i < count($junks); $i++) {
//
            $current = Carbon::now();
            $create = Carbon::parse($junks[$i]->created_at);

            if ($current->diffInHours($create) > 1) {


                Junk::where('created_at', '=', $junks[$i]->created_at)->first()->delete();

            }
        }




        $tournamentItems = new Tournament();


        $tournamentItems->matchName = $tournament->matchName;
        $tournamentItems->url = $tournament->url;
        $tournamentItems->startTime = $tournament->startTime;
        $tournamentItems->endTime = $tournament->endTime;
        $tournamentItems->endRemain = $tournament->endRemain;
        $tournamentItems->endRemain = $tournament->endRemain;
        $tournamentItems->comment = $tournament->comment;
        $tournamentItems->lat = $tournament->lat;
        $tournamentItems->lng = $tournament->lng;
        $tournamentItems->path = $tournament->path;
        $tournamentItems->mode = $tournament->mode;
        $tournamentItems->matchType = $tournament->matchType;
        $tournamentItems->maxAttenders = $tournament->maxAttenders;
        $tournamentItems->maxTeam = $tournament->maxTeam;
        $tournamentItems->maxMember = $tournament->maxMember;
        $tournamentItems->minMember = $tournament->minMember;
        $tournamentItems->attendType = $tournament->attendType;
        $tournamentItems->prize = $tournament->prize;
        $tournamentItems->rules = $tournament->rules;
        $tournamentItems->plan = $tournament->plan;
        $tournamentItems->cost = $tournament->cost;
        $tournamentItems->moreInfo = $tournament->moreInfo;
        $tournamentItems->email = $tournament->email;
        $tournamentItems->telegram = $tournament->telegram;
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

        Junk::where('organize_id',Auth::id())->orderBy('created_at','decs')->delete();
        return redirect()->route('orgMatches');

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


    public function getTournament(){


        $id = session('tournamentId');

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



        return redirect()->route('plan');

    }

    public function returnCI(){


        return redirect()->route('cost');

    }

    public function MatchRegister($id,$url){

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


        $name = Auth::user();
        $users = Match::where([['tournament_id',$id],['user_id',Auth::id()]])->first();
        $tournament = Tournament::where('id' , $id)->first();
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

//    public function MatchRules($uri,$id){
//
//        $name = Auth::user()->username;
//        session(['routeName'=>'rules']);
//        $tournament = Tournament::where(['matchName' => $uri ,'id' => $id])->first();
//        $route = 'rules';
//        return view('matchReg.matchRule',compact('name','tournament','route'));
//    }

    public function MatchBracket(Request $request,$id,$url){

        $name = Auth::user();
        session(['routeName'=>'bracket']);
        $tournament = Tournament::where('id', $id)->first();
        $route = 'bracket';
        $bracketDetail =  Tournament::where('id',$id)->first()->groupBracket;
        $teamName = unserialize($bracketDetail->bracketTable);
        $tableData = unserialize($bracketDetail->GroupBracketTableEdit);
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

    public function MatchGElBracket(Request $request,$id,$url){

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

    public function getGElBracket($id,$url){



        $table = unserialize(GroupBracket::where('tournament_id',$id)->first()->ElBracketTableEdit);

        return $table;


    }

    public function getElBracket($id,$url){



        $table = unserialize(EliminationBracket::where('tournament_id',$id)->first()->ElBracketTableEdit);

        return $table;


    }

    public function MatchElBracket(Request $request,$id,$url){


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


    public function MatchTimeline($id,$url){

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


    public function MatchAttenders($id,$url){

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
//            Single register
        if ($request->input('single') == 'single') {

            if( null != Match::where([ ['tournament_id',$request->id],['user_id',Auth::id()]])->first()){

//                dd('dsa');
                return redirect()->back()->with(['message'=>'شما پیش از این در مسابقه ثبت نام کرده اید']);

            }


            if(isset($_POST['additionalData'])&& null == $request->input('additionalData')){

                $this->validate($request,['additionalData'=>'required']);

            }



            $match = Tournament::where('id', $request->id)->first();

            if (Auth::user()->credit >= $match->cost) {

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

                $matchTable->moreInfo = $request->additionalData;

                $matchTable->save();


                $data = ['match'=>$match ,'matchName' => $match->matchName, 'credit' => Auth::user()->credit, 'cost' => $match->cost, 'startTime' => $match->startTime, 'email' => Auth::user()->email, 'teammates'=>$teammates];
                Mail::send('email.matchData', $data, function ($message) use ($data) {

                    $message->from('s23.moghadam@gmail.com');
                    $message->to($data['email']);

                });



                return redirect()->route('userChallenge');
            } else {

                return redirect()->back()->with(['message' => 'متاسفانه اعتبار شما برای خرید بلیط کافی نیست. ']);

            }
        }

//        Team register
        else{

            if( isset($_POST['additionalData']) ){

                $sub = 4;
            }else{
                $sub = 3;
            }
//            dd($_POST);
//
            for($i = 0; $i < count($_POST) - $sub; $i++) {

                if(null == $request->input("teammate$i")){

                    $this->validate($request, ["teammate" => 'required']);

                }

            }

            $this->validate($request,['teamName'=>'required','TeamLogo'=>'image']);

            if($sub == 4 && null == $request->input('additionalData')){

                $this->validate($request,['additionalData'=>'required']);

            }

            $match = Tournament::where('id', $request->matchId)->first();

            if( null != Match::where([ ['tournament_id',$request->matchId],['user_id',Auth::id()]])->first()){

                return redirect()->back()->with(['message'=>'شما پیش از این در مسابقه ثبت نام کرده اید']);

            }

//                dd($_POST);
            if ($match->cost *  (count($_POST)- $sub) <= User::where('username', Auth::user()->username)->first()->credit ) {
                if ($match->tickets - $match->sold -  1 >= 0) {


                    $number = $match->maxMember;
                    $time = time();
                    $team = new Team();

                    $team->teamName = $request->teamName;
                    $team->tournament_id = $request->matchId;
                    if (null != $request->file('TeamLogo')) {

                        $team->path = $time . $request->file('TeamLogo')->getClientOriginalName();
                        $request->file('TeamLogo')->move('storage/images', $time . $request->file('TeamLogo')->getClientOriginalName());
                    }else{
                        $team->path = 'Blank100_100.png' ;
                    }
                    $team->save();


                    for ($i = 0; $i < count($_POST) - $sub; $i++) {


                        $group = new Group();

                        $group->name = $request["teammate$i"];
//                $group->user_id = Auth::id();
                        $group->team_id = Team::where('teamName', $request->teamName)->first()->id;
                        $group->tournament_id = $request->matchId;
                        $group->organize_id = $match->organize->id;
                        $group->save();

                    }


//                for ($i = 0; $i < count($_POST) - $sub; $i++) {

//                dd($match->cost * count($_POST) > User::where('username', Auth::user()->username)->first()->credit);


//                if(
//
//                count(Match::where([['user_id',User::where('username',$request["teammate$i"])->first()->id],['tournament_id',$request->id]]))>0
////
//                ){
////                    dd(Match::where([['user_id',User::where('username',$request["teammate$i"])->first()->id],['tournament_id',$request->id]])->first());
//                    return redirect()->back()->with(['message'=> 'پیش از این نام یکی از هم تیمی ها در مسابقه ثبت شده است.']);
//                }

//                dd(count($_POST)-4);
//                dd(Match::where([['user_id',$userId],['tournament_id',$request->matchId]])->first());
                    $match->organize->totalTickets = $match->organize->totalTickets + 1;
                    $match->organize->update(['credit' => $match->organize->credit + $match->cost * (count($_POST)-$sub)]);
//                    dd($match->organize->totalTickets);
                    $match->organize->update(['totalTickets' => $match->organize->totalTickets]);

                    $match->sold = $match->sold + 1;

                    $match->update(['sold' => $match->sold]);

                    User::where('username', Auth::user()->username)->first()->update(['credit' => User::where('username', Auth::user()->username)->first()->credit - $match->cost * (count($_POST)-$sub)]);


//                }
                }else{
                    return redirect()->back()->with(['message' => 'تعداد بلیط های درخواستی بیشتر از بلیط های مسابقه می باشد']);
                }
            }else{
//                dd($match->cost * count($_POST) > User::where('username', Auth::user()->username)->first()->credit);
                return redirect()->back()->with(['message' => 'متاسفانه اعتبار شما برای خرید بلیط کافی نیست']);
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

            $teammates=Group::where('team_id',Team::where('teamName',$request->teamName)->first()->id)->get();
            $data = ['match'=>$match,'matchName' => $match->matchName, 'credit' =>User::where('id',Auth::user()->id)->first()->credit, 'cost' => $match->cost, 'startTime' => $match->startTime, 'email' => Auth::user()->email,'teammates'=>$teammates];
            Mail::send('email.matchData', $data, function ($message) use ($data) {

                $message->from('s23.moghadam@gmail.com');
                $message->to($data['email']);

            });
        }

        return redirect()->route('userChallenge');
    }


    public function LeagueTable($id,$url){


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

    public function challengeDetail($id,$url){


        $name = Auth::user();
        $users = Match::where([['tournament_id',$id],['user_id',Auth::id()]])->first();

        $tournament = Tournament::where('id' , $id)->first();
        $route = 'register';
        $img = $tournament->organize->logo_path;
        $auth = 1;
        return view('matchReg.matchReg',compact('name','tournament','route','users','auth','img'));
    }

    public function getTeamImage(Request $request){
//

        $img = Team::where('teamName',$request->name)->first()->path;

        if($img == null){

            $img = User::where('username',$request->name)->first()->path;

        }

        return $img;


    }

    public function selectMatchBracket($id,$url){

        $bracket = BracketController::where('tournament_id',$id)->first();


//      dd($bracket);
        if($bracket != null ) {

            if ($bracket->group == 1) {


                return redirect()->route('matchGroupBracket', ['id' => $id, 'url' => $url]);


            } elseif ($bracket->elimination == 1) {

                return redirect()->route('matchElBracket', ['id' => $id, 'url' => $url]);

            } else {

                return redirect()->route('LeagueTable2', ['id' => $id, 'url' => $url]);

            }
        }else {

            return redirect()->route('noBracket', ['id' => $id, 'url' => $url]);
        }




    }

    public function noBracket($id,$url){

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
