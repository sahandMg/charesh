<?php

namespace App\Http\Controllers;

use App\GroupBracket;
use App\Http\Requests\baseInfoRequest;
use App\Http\Requests\MatchImageRequest;
use App\Http\Requests\RulesRequest;
use App\Match;
use App\Player;
use App\Team;
use App\Tournament;
use App\Junk;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
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

//        dd($request->comment);
        $this->validate($request,['comment'=>'required']);
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
            $tournament->url = $request->url;
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
        $tournament = Junk::where('organize_id',Auth::id())->orderBy('created_at','decs')->get();
        $tournament = $tournament[0];

        $tournament->update([
            'mode'=> $request->mode,
            'matchType'=>$request->matchType,
            'maxAttenders'=>$request->maxAttenders,
            'attendType'=>$request->attendType,
            'prize'=> $request->prize,
            'maxTeam'=>$request->maxTeam,
            'minMember'=>$request->minMember,
            'maxMember'=>$request->maxMember
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

        $tournament = Junk::where('organize_id',Auth::id())->first();

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
        $tournament = Junk::where('organize_id',Auth::id())->orderBy('created_at','decs')->get();
        $tournament = $tournament[0];
        $tournament->plan = $request->plan;

        $tournament->save();
        return redirect()-> route('cost');

    }

    public function cost(){

        $name = Auth::user();

        return view('matchCreate.cost',compact('name'));

    }


    public function post_cost(Request $request){



        $tournament = Junk::where('organize_id',Auth::id())->orderBy('created_at','decs')->get();
        $tournament = $tournament[0];
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


        $tournament = Junk::where('organize_id',Auth::id())->orderBy('created_at','decs')->get();
        $tournament = $tournament[0];
        $tournament->email = $request->email;
        $tournament->telegram = $request->telegram;
        $tournament->save();

        $junks  = Junk::all()->pluck('created_at');

        for ($i=0 ; $i < count($junks); $i++) {
//
            $current = Carbon::now();
            $create = Carbon::parse($junks[$i]);

            if ($current->diffInHours($create) > 1) {


                Junk::where('created_at', '=', $junks[$i])->first()->delete();

            }
        }


        for($i=0; $i<count($tournament) ; $i++){



        }


        $tournamentItems = new Tournament();


        $tournamentItems->matchName = $tournament->matchName;
        $tournamentItems->url = $tournament->url;
        $tournamentItems->startTime = $tournament->startTime;
        $tournamentItems->endTime = $tournament->endTime;
        $tournamentItems->endRemain = $tournament->endRemain;
        $tournamentItems->endRemain = $tournament->endRemain;
        $tournamentItems->comment = $tournament->comment;
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
        $tournamentItems->organize_id = Auth::id();
        $tournamentItems->sold = 0;
        if($tournament->maxAttenders){
            $tournamentItems->tickets = $tournament->maxAttenders;
        }else{
            $tournamentItems->tickets = $tournament->maxTeam;
        }

        $tournamentItems -> save();
        $tournament = Junk::where('organize_id',Auth::id())->orderBy('created_at','decs')->get();
        $tournament = $tournament[0];

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

        $tournament = Junk::where('organize_id',Auth::id())->orderBy('created_at','decs')->get();
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
        $img = $tournament->organize->logo_path;

        if(Auth::check()){
            $name = Auth::user();
            $auth = 1;
            return view('matchReg.matchReg',compact('name','tournament','route','users','auth','img'));

        }else{

            $auth = 0;
            return view('matchReg.matchReg',compact('tournament','route','users','auth','img'));
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

    public function MatchBracket($id,$url){

        $name = Auth::user();
        session(['routeName'=>'bracket']);
        $tournament = Tournament::where(['matchName' => $url ,'id' => $id])->first();
        $route = 'bracket';
        $bracketDetail =  Tournament::where('id',$id)->first()->groupBracket;
        if(Auth::check()){
            $name = Auth::user();
            $auth = 1;

            $teamName = unserialize($bracketDetail->bracketTable);
            $tableData = unserialize($bracketDetail->GroupBracketTableEdit);
//            dd($tableData);
            return view('matchReg.groupBracket',compact('teamName','name','tournament','route','users','auth','bracketDetail','tableData'));

        }else{

            $auth = 0;
            return view('matchReg.groupBracket',compact('teamName','tournament','route','users','auth','bracketDetail','tableData'));
        }
    }

    public function MatchElBracket($id,$url){

        $name = Auth::user();
        session(['routeName'=>'bracket']);
        $tournament = Tournament::where(['matchName' => $url ,'id' => $id])->first();
        $route = 'bracket';
        if(Auth::check()){
            $name = Auth::user();
            $auth = 1;
            $table = unserialize(GroupBracket::where('tournament_id',$id)->first()->ElBracketTableEdit);
//            dd(count($table['teams']));
//            dd($table['teams']);
            return view('matchReg.mosabegheBrackets2H',compact('name','tournament','route','users','auth','table'));

        }else{

            $auth = 0;
            return view('matchReg.mosabegheBrackets2H',compact('tournament','route','users','auth','table'));
        }
    }

    public function getElBracket($id,$url){



            $table = unserialize(GroupBracket::where('tournament_id',$id)->first()->ElBracketTableEdit);

            return $table;


    }


    public function MatchTimeline($id,$url){

        $name = Auth::user();
        session(['routeName'=>'timeline']);
        $tournament = Tournament::where(['matchName' => $url ,'id' => $id])->first();
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
        $tournament = Tournament::where(['matchName' => $url ,'id' => $id])->first();
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
                $userName[$i] = Match::where('team_id',$teamId->team_id)->get();

                $i++;
            }
        }







        if(Auth::check()){
            $name = Auth::user();
            $auth = 1;
            return view('matchReg.matchUser',compact('name','tournament','route','users','auth','player','team','userName'));

        }else{

            $auth = 0;
            return view('matchReg.matchUser',compact('tournament','route','users','auth','player','team','userName'));
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


//            Single register
        if ($request->input('single') == 'single') {

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

                $matchTable->save();






                $data = ['matchName' => $match->matchName, 'credit' => Auth::user()->credit, 'cost' => $match->cost, 'startTime' => $match->startTime, 'email' => Auth::user()->email];
                Mail::send('email.matchData', $data, function ($message) use ($data) {

                    $message->from('s23.moghadam@gmail.com');
                    $message->to($data['email']);

                });



                return redirect()->route('userChallenge');
            } else {

                return redirect()->back()->with(['message' => 'متاسفانه اعتبار شما برای خرید بلیط کافی نیست']);

            }
        }

//        Team register
        else{

            $match = Tournament::where('id', $request->matchId)->first();



            for($i = 0 ; $i < count($_POST)-4 ; $i++ ){


//                dd(User::where('username',$request["teammate0"])->first());
                $userId = User::where('username',$request["teammate1"])->first()->id;
                 if(User::where('username',$request["teammate$i"])->first()->credit < $match->cost){

                     return redirect()->back()->with(['message'=>' متاسفانه اعتبار هم تیمی ها برای خرید بلیط کافی نیست']);
                 }elseif(Match::where([['user_id',$userId],['tournament_id',$request->matchId]])->first()) {



                     return redirect()->back()->with(['message' => 'پیش از این نام یکی از هم تیمی ها در مسابقه ثبت شده است.']);
                 }else {

//

                 }


            }


            $number = $match->maxMember;

            $team = new Team();

            $team->teamName = $request->teamName;
            $team->tournament_id = $request->matchId;
            $team->save();


            for($i = 0 ; $i < count($_POST)-4 ; $i++ ){


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
                $match->organize->update(['credit' => $match->organize->credit + $match->cost]);
//                    dd($match->organize->totalTickets);
                $match->organize->update(['totalTickets' => $match->organize->totalTickets]);

                $match->sold = $match->sold + 1;

                $match->update(['sold' => $match->sold]);

                User::where('username', $request["teammate$i"])->first()->update(['credit' => User::where('username', $request["teammate$i"])->first()->credit - $match->cost]);


                $matchTable2 = new Match();


                $matchTable2->user_id = User::where('username',$request["teammate$i"])->first()->id;
                $matchTable2->tournament_id = $request->matchId;
                $matchTable2->team_id = Team::where('teamName',$request->teamName)->first()->id;
//
                $matchTable2->save();
            }



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
        }

        return redirect()->route('userChallenge');
    }


    public function challengeDetail($id,$url){


        $name = Auth::user();
        $users = Match::where([['tournament_id',$id],['user_id',Auth::id()]])->first();

        $tournament = Tournament::where(['matchName' => $url ,'id' => $id])->first();
        $route = 'register';
        $img = $tournament->organize->logo_path;
        $auth = 1;
        return view('matchReg.matchReg',compact('name','tournament','route','users','auth','img'));
    }

}
