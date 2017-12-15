<?php

namespace App\Http\Controllers;

use App\BracketController;
use App\EliminationBracket;
use App\Group;
use App\GroupBracket;
use App\LeagueBracket;
use App\Match;
use App\Message;
use App\Team;
use App\Tournament;
use App\User;
use Carbon\Carbon;
use Dompdf\Exception;
use Illuminate\Http\Request;
use App\Http\Requests\ContactUsRequest;
use App\Organize;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Intervention\Image\Facades\Image;

class OrganizeController extends Controller
{

    public function __construct()
    {
        $this->middleware('confirm');
    }

    public function organizeProfile($name)
    {


        $org = Organize::where('name', $name)->first();
        $matches = Tournament::all();
        if (Auth::check()) {
            $name = Auth::user();
            $auth = 1;
        } else {
            $auth = 0;
        }


//        dd($registereds);

        return view('organize.profile', compact('org', 'matches', 'auth', 'name'));

    }


    public function MakeOrganize()
    {

        $name = Auth::user();
        return view('organize.makeOrganize', compact('name'));


    }


    public function postMakeOrganize(Request $request)
    {

        $this->validate($request,['comment'=>'required']);


        if (Auth::user()->organize) {

            Organize::where('user_id', Auth::id())->first()->delete();

        }

        $time = time();
        $org = new Organize();
        $org->name = $request->name;
        session(['organizeName' => $request->name]);
        $org->comment = $request->comment;
        if ($request->file('logo_path')) {

            $org->logo_path = $time . $request->file('logo_path')->getClientOriginalName();

        } else {
            $org->logo_path = "Blank100_100.png";
        }

        if ($request->file('background_path')) {


            $org->background_path = $time . $request->file('background_path')->getClientOriginalName();

        } else {

            $org->background_path = "Blank1150_380.png";
        }


        $org->user_id = Auth::id();
        $org->save();


        if ($request->file('background_path')) {

//            $exploded = explode('.',$request->file('background_path')->getClientOriginalName());
//
            $request->file('background_path')->move('storage/images', $time . $request->file('background_path')->getClientOriginalName());
////
//            $imageTmp=imagecreatefromjpeg('storage/images/'.$time.$request->file('background_path')->getClientOriginalName());
//            $output = $time.$request->file('background_path')->getClientOriginalName();
//            imagejpeg($imageTmp,$output,100);
////
//            Image::make('storage/images/'.$output)->resize(1150,380)->save();
//
//            dd($output);

        }

        if ($request->file('logo_path')) {

            $request->file('logo_path')->move('storage/images', $time . $request->file('logo_path')->getClientOriginalName());
//
//            Image::make('storage/images/'.$time.'logo.jpg')->resize(100,100)->save();

        }


        return redirect()->route('OrganizeContact');


    }

    public function OrganizeContact()
    {

        $name = Auth::user();
        $org = Organize::where('user_id',Auth::id())->first();
        return view('organize.contactOrganize', compact('name','org'));


    }


    public function postOrganizeContact(Request $request)
    {

        $org = Organize::where([['user_id', Auth::id()], ['name', session('organizeName')]])->first();

        $org->email = $request->email;
        $org->telegram = $request->telegram;
        $org->save();

        return redirect()->route('orgMatches');

//

    }




    public function askOrganize()
    {

        $organize = Auth::user()->organize;

        return $organize;

    }

    public function GetMoney()
    {

        return Auth::user()->credit;

    }


    public function matches()
    {
        $name = Auth::user();
        $matches = Auth::user()->organize->tournaments;
        $totalTickets = Auth::user()->organize->totalTickets;

        return view('organize.matchControl', compact('name', 'matches', 'totalTickets'));

    }

    public function challengePanel($id, $url)
    {
        $name = Auth::user();
        $tournament = Tournament::where('id', $id)->first();
        $route = 'info';
        return view('organize.matchPanel', compact('name', 'tournament', 'route'));
    }

    public function post_challengePanel(Request $request)
    {

//        dd($request->comment);

        if (null != $request->file('rulesPath')) {
            $this->validate($request, ["rulesPath" => "mimes:pdf"]);

            $time = time();
            $pdfPath = Tournament::where('id', $request->id)->first();
//        dd($request->file('rulesPath')->getClientOriginalName());
            unlink(public_path('storage/pdfs/' . $pdfPath->rules));

            $pdfPath->update(['rules' => $time . $request->file('rulesPath')->getClientOriginalName()]);
            $request->file('rulesPath')->move('storage/pdfs', $time . $request->file('rulesPath')->getClientOriginalName());


        }

        if($request->input('endTime')){

            $tournament = Tournament::where('id',$request->id)->first();
            $today = Carbon::now();

            $endDate = $today->addDay($request->endTime);

            $tournament->update(['endTimeDays' => $request->endTime]);
            $tournament->update(['endRemain' => $endDate]);
            $today = Carbon::now();
            $tournament->update(['endTime' => $today->diffInSeconds($endDate)]);

        }
        if($request->input('startTime')){

            $tournament = Tournament::where('id',$request->id)->first();
            $tournament->update(['startTime' => $request->startTime]);

        }
        if($request->input('comment')){

            $tournament = Tournament::where('id',$request->id)->first();
            $tournament->update(['comment' => $request->comment]);


        }

        if($request->input('maxAttenders')){

            $tournament = Tournament::where('id',$request->id)->first();
            if($tournament->matchType == 'تیمی'){

                $tournament->update(['maxTeam' =>  $tournament->maxTeam + $request->maxAttenders]);
                $tournament->update(['tickets' =>  $tournament->sold + $request->maxAttenders]);
            }else{

                $tournament->update(['maxAttenders' => $tournament->maxAttenders + $request->maxAttenders]);
                $tournament->update(['tickets' =>  $tournament->sold +  $request->maxAttenders]);
            }



        }
        if($request->input('email')){

            $tournament = Tournament::where('id',$request->id)->first();
            $tournament->update(['email' => $request->email]);

        }

        if($request->input('telegram')){

            $tournament = Tournament::where('id',$request->id)->first();
            $tournament->update(['telegram' => $request->telegram]);

        }

//        dd($tournament = Tournament::where('id',$request->id)->first());

        return redirect()->back()->with(['message' => 'اطلاعات ذخیره شد']);


//        return redirect()->back()->with(['message' => 'محل برگزاری مسابقه ذخیره شد']);

    }


//    public function challengeInfo($id, $url)
//    {
//        $name = Auth::user();
//        $tournament = Tournament::where('id', $id)->first();
//        $route = 'info';
//        return view('organize.matchPanel', compact('name', 'tournament', 'route'));
//    }

    public function bracketDelete($id, $url)
    {



        $bracket = BracketController::where('tournament_id',$id)->first();

        if($bracket != null) {

            if ($bracket->group == 1) {

                $data = GroupBracket::where('tournament_id',$id)->first();

                $data->delete();

            } elseif ($bracket->league == 1) {

                $datas = LeagueBracket::where('tournament_id',$id)->get();

                foreach ($datas as $data){

                    $data->delete();

                }


            } else {

                $data = EliminationBracket::where('tournament_id',$id)->first();

                $data->delete();

            }

            $bracket->delete();
        }


        return redirect()->route('challengeBracket', ['id' => $id, 'url' => $url]);

    }

    public function challengeBracket($id, $url)
    {
        $name = Auth::user();
        $tournament = Tournament::where('id', $id)->first();
        $route = 'bracket';



        $bracket = BracketController::where('tournament_id',$id)->first();

        if(count($bracket) > 0) {

            if ($bracket->group == 1) {

                if(GroupBracket::where('tournament_id',$id)->first()->bracketTable != null){

                    return redirect()->route('makeGroupBracket3',['id'=>$id,'url'=>$url]);
                }else{

                    return redirect()->route('makeGroupBracket',['id'=>$id,'url'=>$url]);
                }



            } elseif ($bracket->elimination == 1) {

                return redirect()->route('ElBracket2',['id'=>$id,'url'=>$url]);

            } else {

                return redirect()->route('leagueBracket2',['id'=>$id,'url'=>$url]);

            }
        }else {

            return view('organize.bracketSelect', compact('name', 'tournament', 'route'));

        }
    }

//mosabegheBracketsGHInitial1
    public function groupBracket($id, $url)
    {

        $name = Auth::user();
        $tournament = Tournament::where('id', $id)->first();
        $route = 'bracket';
//        $bracket = GroupBracket::where([['organize_id', Auth::user()->organize->id],['tournament_id',$id]])->first();
        $message = '';
//        if (!$bracket) {
//
        return view('organize.GroupElimination.mosabegheBracketsGHInitial1', compact('name', 'tournament', 'route', 'message'));
//        } elseif (!$bracket->bracketTable && !$bracket->GroupBracketTableEdit) {
//
//            $bracket->delete();
//            $message = 'متاسفانه به دلیل انصراف از ساخت ادامه براکت، اطلاعات قبلی شما پاک شده است.';
//            $message = 'متاسفانه به دلیل انصراف از ساخت ادامه براکتde، اطلاعات قبلی شما پاک شده است.';
//            return view('organize.GroupElimination.bracketSelect', compact('name', 'tournament', 'route', 'message'));

//        }
//
//        else {

//

//        }

    }

    public function post_groupBracket(Request $request)
    {

//        dd(count($_POST)-5);
        $gBracket = new GroupBracket();
        $gBracket->groupNumber = $request->groupNumber;
        $gBracket->groupTeam = $request->groupTeam;
        $gBracket->winnerTeams = $request->winnerTeams;
        $gBracket->row = $request->row;
        $gBracket->teamName = $request->teamName;
        $gBracket->point = $request->point;
        if ($request->input('column4')) {
            $gBracket->column4 = $request->column4;
        }
        if ($request->input('column5')) {
            $gBracket->column5 = $request->column5;
        }
        if ($request->input('column6')) {
            $gBracket->column6 = $request->column6;
        }
        if ($request->input('column7')) {
            $gBracket->column7 = $request->column7;
        }
        if ($request->input('column8')) {
            $gBracket->column8 = $request->column8;
        }
        if ($request->input('column9')) {
            $gBracket->column9 = $request->column9;
        }
        if ($request->input('column10')) {
            $gBracket->column10 = $request->column10;
        }
        if ($request->input('column11')) {
            $gBracket->column11 = $request->column11;
        }
        if ($request->input('column12')) {
            $gBracket->column12 = $request->column12;
        }
        $gBracket->tournament_id = $request->id;
        $gBracket->columnNumber = count($_POST)-5;
        $gBracket->organize_id = Auth::user()->organize->id;
        $gBracket->save();

        if(null == BracketController::where('tournament_id',$request->id)->first()){

            $bracket = new BracketController();
            $bracket->group = 1;
            $bracket->tournament_id = $request->id;
            $bracket->save();

        }


        return redirect()->route('makeGroupBracket', ['id' => $request->id, 'url' => $request->url]);

    }

//mosabegheBracketsGHInitial2
    public function makeGroupBracket2($id, $url)
    {

        $name = Auth::user();
        $tournament = Tournament::where('id', $id)->first();
        $route = 'bracket';
        $bracketDetail = Tournament::where('id', $id)->first()->groupBracket;
//        dd(unserialize($bracketDetail->bracketTable ));
        if($tournament->matchType == 'انفرادی'){


            $matches = Tournament::where('id',$id)->first()->matches;

            for ($i=0 ; $i<count($matches) ; $i++){

                $teams[$i] = $matches[$i]->user;
            }

        }else{

            $teams = Tournament::where('id',$id)->first()->teams;

        }

//        dd(unserialize($bracketDetail->bracketTable));
        return view('organize.GroupElimination.mosabegheBracketsGHInitial2', compact('name', 'tournament', 'route', 'teams', 'bracketDetail'));


    }

    public function post_makeGroupBracket2(Request $request)
    {


        $table = GroupBracket::where('tournament_id', $request->id)->first();
        if($table->bracketTable == null){
            $table->bracketTable = serialize($request->GTable);
            $table->save();
        }

        return 1;
    }

    public function makeGroupBracket3($id, $url)
    {

        $name = Auth::user();
        $tournament = Tournament::where('id', $id)->first();
        $route = 'bracket';
        $bracketDetail = Tournament::where('id', $id)->first()->groupBracket;
        if($tournament->matchType == 'انفرادی'){

            $matches = Tournament::where('id',$id)->first()->matches;

            for ($i=0 ; $i<count($matches) ; $i++){

                $teams[$i] = $matches[$i]->user;
            }

        }else{

            $teams = Tournament::where('id',$id)->first()->teams;

        }
        $teamName = (unserialize($bracketDetail->bracketTable));

//        dd(unserialize($bracketDetail->GroupBracketTableEdit));

        return view('organize.GroupElimination.mosabegheBrackets2GEdit', compact('name', 'tournament', 'route', 'teams', 'bracketDetail', 'teamName'));

    }

    public function post_makeGroupBracket3(Request $request)
    {

        $table = GroupBracket::where('tournament_id', $request->id)->first();

        $table->GroupBracketTableEdit = serialize($request->GTable);
        $table->save();

//        if(null == BracketController::where('tournament_id',$request->id)->first()){
//
//            $bracket = new BracketController();
//            $bracket->group = 1;
//            $bracket->tournament_id = $request->id;
//            $bracket->save();
//
//        }


        return 1;
    }

    public function makeElBracket(Request $request,$id, $url)
    {

        $name = Auth::user();
        $tournament = Tournament::where('id', $id)->first();
        $route = 'bracket';
        if($tournament->matchType == 'انفرادی'){

            $matches = Tournament::where('id',$request->id)->first()->matches;

            for ($i=0 ; $i<count($matches) ; $i++){

                $teams[$i] = $matches[$i]->user;
            }

        }else{

            $teams = Tournament::where('id',$request->id)->first()->teams;

        }
//        $bracketDetail =  Tournament::where('id',$id)->first()->groupBracket;
//        $teams = Tournament::where('id',$id)->first()->teams;
//        $teamName = (unserialize($bracketDetail->bracketTable));

        return view('organize.GroupElimination.mosabegheBrackets2HEdit', compact('request','name', 'tournament', 'route','teams'));
    }


    public function post_makeElBracket(Request $request)
    {

        $table = GroupBracket::where('tournament_id', $request->id)->first();
        $table->ElBracketTableEdit = serialize($request->data);
        $table->save();

        return 1;


    }


    public function makeElBracket2(Request $request,$id, $url)
    {

        $name = Auth::user();
        $tournament = Tournament::where('id', $id)->first();
        $route = 'bracket';
        if($tournament->matchType == 'انفرادی'){

            $matches = Tournament::where('id',$request->id)->first()->matches;

            for ($i=0 ; $i<count($matches) ; $i++){

                $teams[$i] = $matches[$i]->user;
            }

        }else{

            $teams = Tournament::where('id',$request->id)->first()->teams;

        }
//        $bracketDetail =  Tournament::where('id',$id)->first()->groupBracket;
//        $teams = Tournament::where('id',$id)->first()->teams;
//        $teamName = (unserialize($bracketDetail->bracketTable));




        return view('organize.Elimination.mosabegheBracketsH1Edit', compact('name', 'tournament', 'route','teams','request'));
    }


    public function post_makeElBracket2(Request $request)
    {


        if(null == EliminationBracket::where('tournament_id',$request->id)->first()){


            $table = new EliminationBracket();

            $table->ElBracketTableEdit = serialize($request->data);
            $table->organize_id = Auth::user()->organize->id;
            $table->tournament_id = $request->id;
            $table->save();

        }else{


            $table = EliminationBracket::where('tournament_id',$request->id)->first();

            $table->update(['ElBracketTableEdit'=>serialize($request->data)]);

        }




        if(null == BracketController::where('tournament_id',$request->id)->first()){

            $bracket = new BracketController();
            $bracket->elimination = 1;
            $bracket->tournament_id = $request->id;
            $bracket->save();

        }



        return 1;

    }

    public function leagueBracket($id,$url){


        $name = Auth::user();
        $tournament = Tournament::where('id', $id)->first();
        $route = 'bracket';
        return view('organize.League.mosabegheBracketsLInitial',compact('name','tournament','route'));

    }

    public function post_leagueBracket(Request $request){

        if(null == LeagueBracket::where('tournament_id',$request->id)->first()) {


            $gBracket = new LeagueBracket();

            $gBracket->row = $request->row;
            $gBracket->teamName = $request->teamName;
            $gBracket->point = $request->point;
            if ($request->input('TYPE')) {
                $gBracket->type = $request->TYPE;
            }
//            if ($request->input('dg')) {
//                $gBracket->type = $request->dg;
//            }

            if ($request->input('column4')) {
                $gBracket->column4 = $request->column4;
            }
            if ($request->input('column5')) {
                $gBracket->column5 = $request->column5;
            }
            if ($request->input('column6')) {
                $gBracket->column6 = $request->column6;
            }
            if ($request->input('column7')) {
                $gBracket->column7 = $request->column7;
            }
            if ($request->input('column8')) {
                $gBracket->column8 = $request->column8;
            }
            if ($request->input('column9')) {
                $gBracket->column9 = $request->column9;
            }
            if ($request->input('column10')) {
                $gBracket->column10 = $request->column10;
            }
            if ($request->input('column11')) {
                $gBracket->column11 = $request->column11;
            }
            if ($request->input('column12')) {
                $gBracket->column12 = $request->column12;
            }

            $gBracket->tournament_id = $request->id;
            $gBracket->columnNumber = count($_POST) - 6;
            $gBracket->organize_id = Auth::user()->organize->id;
            $gBracket->save();

        }else{

            $gBracket = LeagueBracket::where('tournament_id',$request->id)->first();

            $gBracket->update(['row'=> $request->row]);
            $gBracket->update(['teamName'=>$request->teamName]);
            $gBracket->point = $request->point;
            if ($request->input('TYPE')) {
                $gBracket->update(['type'=>$request->TYPE]);
            }
//            if ($request->input('dg')) {
//                $gBracket->update(['type'=>$request->dg]);
//            }
            if ($request->input('column4')) {
                $gBracket->update(['column4'=>$request->column4]);
            }
            if ($request->input('column5')) {
                $gBracket->update(['column5'=>$request->column5]);
            }
            if ($request->input('column6')) {
                $gBracket->update(['column6'=>$request->column6]);
            }
            if ($request->input('column7')) {
                $gBracket->update(['column7'=>$request->column7]);
            }
            if ($request->input('column8')) {
                $gBracket->update(['column8'=>$request->column8]);
            }
            if ($request->input('column9')) {
                $gBracket->update(['column9'=>$request->column9]);
            }
            if ($request->input('column10')) {
                $gBracket->update(['column10'=>$request->column10]);
            }
            if ($request->input('column11')) {
                $gBracket->update(['column11'=>$request->column11]);
            }
            if ($request->input('column12')) {
                $gBracket->cupdate(['column12'=>$request->column12]);
            }

            $gBracket->update(['columnNumber'=> count($_POST) - 6]);

//            dd($_POST);
        }
        if(null == BracketController::where('tournament_id',$request->id)->first()){

            $bracket = new BracketController();
            $bracket->league = 1;
            $bracket->tournament_id = $request->id;
            $bracket->save();

        }



        return redirect()->route('leagueBracket2', ['id' => $request->id, 'url' => $request->url]);



    }


    public function leagueBracket2(Request $request,$id , $url){

        $name = Auth::user();
        $tournament = Tournament::where('id', $id)->first();
        $route = 'bracket';
        $bracketDetail = LeagueBracket::where('tournament_id',$request->id)->first();
        $teamArr=[];
//        session(['bracketDetail'=> Tournament::where('id',$id)->first()->leagueBracket]);
        if($tournament->matchType == 'انفرادی'){

            $matches = Tournament::where('id',$id)->first()->matches;

            for ($i=0 ; $i<count($matches) ; $i++){

                $teams[$i] = $matches[$i]->user;
            }

        }else{

            $teams = Tournament::where('id',$id)->first()->teams;

        }

//        dd($teams);
//        $teams = Match::where('tournament_id',$request->id)->get();

//        dd((unserialize($bracketDetail->LTable)));

        if(unserialize($bracketDetail->LTable)[0][1] == null){

            $roundSign = 0;
        }else{
            $brackets = LeagueBracket::where('tournament_id',$request->id)->get();

//            dd(unserialize($brackets[0]->LTable));
            $s=0;
//            foreach ($brackets as $bracket) {

            for ($p = 0; $p < floor(count($teams) / 2); $p++) {


                if (unserialize($brackets[0]->LTable)[0][1][$p][0] != null && unserialize($brackets[0]->LTable)[0][1][$p][4] != null) {

                    $teamArr[$s] = unserialize($brackets[0]->LTable)[0][1][$p][0] ;
                    $teamArr[$s+1] =  unserialize($brackets[0]->LTable)[0][1][$p][4];

                    $s+=2;
                }
            }

//            }

//                 array_pop($teamArr);
//                array_push($teamArr,'ewa');
//                dd($teamArr);



            $roundSign = 1;
        }

        return view('organize.League.mosabegheBracketsLEdit', compact('name', 'tournament', 'route','teams','bracketDetail','roundSign','teamArr'));

    }


    public function checkRound(Request $request){

        $brackets = LeagueBracket::where('tournament_id',$request->id)->get();

        $sign = 0;
        $teamArr=[];
        $name = Auth::user();
        $tournament = Tournament::where('id', $request->id)->first();
        $route = 'bracket';

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
                        return View::make('organize.League.mosabegheBracketsLEdit',compact('name', 'tournament', 'route','teams','bracketDetail','roundSign','teamArr'))->renderSections()['round'];
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
            return View::make('organize.League.mosabegheBracketsLEdit',compact('name', 'tournament', 'route','teams','bracketDetail','roundSign','teamArr'))->renderSections()['round'];
        }else{


            return 0;
        }






    }


    public function LeagueTable(Request $request){


        $brackets = LeagueBracket::where('tournament_id',$request->id)->get();


//        if(null == BracketController::where('tournament_id',$request->id)->first()){
//
//            $bracket = new BracketController();
//            $bracket->league = 1;
//            $bracket->tournament_id = $request->id;
//            $bracket->save();
//
//        }


//            dd($request->arr);
        foreach ($brackets as $bracket) {

            if(null == unserialize($bracket->LTable) ){

                $bracket->update(['LTable' => serialize([$request->ltable])]);

                return 1;
            }

            if ($request->ltable[2] == unserialize($bracket->LTable)[0][2]) {

                $bracket->update(['LTable' => serialize([$request->ltable])]);


                for($g=0;$g<count($brackets);$g++){

                    $table = unserialize($brackets[$g]->LTable);


                    array_shift($table[0]);
                    array_unshift($table[0],$request->ltable[0]);

                    $brackets[$g]->update(['LTable'=> serialize($table)]);
                }



                return '1';
            }





        }


        $bracket = LeagueBracket::where('tournament_id',$request->id)->first();
        $NewBracket = $bracket->replicate();
        $NewBracket->save();
        $NewBracket->update(['LTable' => serialize([$request->ltable])]);

        $brackets = LeagueBracket::where('tournament_id',$request->id)->get();

        for($g=0;$g<count($brackets);$g++){

            $table = unserialize($brackets[$g]->LTable);


            array_shift($table[0]);
            array_unshift($table[0],$request->ltable[0]);

            $brackets[$g]->update(['LTable'=> serialize($table)]);
        }

        return '1';

    }

    public function challengeTimeline($id, $url)
    {
        $name = Auth::user();
        $tournament = Tournament::where('id', $id)->first();
        $route = 'timeline';
        return view('organize.matchPanelTime', compact('name', 'tournament', 'route'));
    }

    public function post_challengeTimeline(Request $request)
    {

        $this->validate($request, ['timeline' => 'required']);

        $match = Tournament::where('id', $request->id)->first();
        $match->update(['plan' => $request->timeline]);

        return redirect()->back()->with(['message' => 'برنامه زمان بندی مسابقات ویرایش شد']);

    }

    public function challengeMessage($id, $url)
    {
        $name = Auth::user();

        $tournament = Tournament::where('id', $id)->first();
        $route = 'message';
        $username = [];
        if ($tournament->matchType == 'انفرادی') {

            $usr = Match::where('tournament_id', $id)->pluck('user_id');

            for ($i = 0; $i < count($usr); $i++) {

                $username[$i] = User::where('id', $usr[$i])->first()->username;

            }


        } else {

            $teams = Team::where('tournament_id', $id)->get();
        }


        return view('organize.messagePanel', compact('name', 'tournament', 'route', 'teams', 'username'));
    }


    public function post_challengeMessage(Request $request)
    {

        $this->validate($request, ['message' => 'required', 'team' => 'filled']);


        if ($request->team == 'all') {

            $teams = Team::where('tournament_id', $request->id)->get();

            foreach ($teams as $team) {
//

                $leader = Match::where([['team_id', $team->id], ['tournament_id', $request->id]])->first()->user;
//
                $msg = new Message();

//                $msg->team_id = $team->id;
                $msg->message = $request->message;
                $msg->organize_id = Tournament::where('id', $request->id)->first()->organize_id;
                $msg->tournament_id = $request->id;
                $msg->user_id = $leader->id;
                $msg->save();

                $user =  User::where('id',$leader->id)->first();

                $user->update(['unread'=> $user->unread + 1]);
//
            }


        } else {

            if (Team::where('teamName', $request->team)->first()) {

                $team = Team::where('teamName', $request->team)->first();
                $leader = Match::where([['team_id', $team->id], ['tournament_id', $request->id]])->first()->user;
                $msg = new Message();

                $msg->message = $request->message;
                $msg->organize_id = Tournament::where('id', $request->id)->first()->organize_id;
                $msg->tournament_id = $request->id;
                $msg->user_id = $leader->id;
                $msg->save();


            } elseif ($request->user == 'all') {

                $users = Match::where('tournament_id', $request->id)->get();


                foreach ($users as $user) {
//


//
                    $msg = new Message();

//                $msg->team_id = $team->id;
                    $msg->message = $request->message;
                    $msg->organize_id = Tournament::where('id', $request->id)->first()->organize_id;
                    $msg->tournament_id = $request->id;
                    $msg->user_id = $user->user_id;
                    $msg->save();

                    $userInfo = User::where('id', $user->user_id)->first();

                    $userInfo->update(['unread' => $user->unread + 1]);
//
                }
//
            }
            else{
//
                $msg = new Message();
                $msg->user_id = User::where('username', $request->user)->first()->id;
                $msg->message = $request->message;
                $msg->organize_id = Tournament::where('id', $request->id)->first()->organize_id;
                $msg->tournament_id = $request->id;
                $msg->save();

            }

        }
        return redirect()->back()->with(['message' => 'پیام شما ارسال شد']);

    }

    public function participants($id, $url)
    {

        $name = Auth::user();


        $tournament = Tournament::where('id', $id)->first();
        $teams=[];

        if (count(Tournament::where('id', $id)->first()->teams)) {

            $teams = Tournament::where('id', $id)->first()->teams;
//        dd($teams[0]->groups);
            $route = 'participants';
//        Group::where('tournament_id',$id);

            return view('organize.participants', compact('route', 'name', 'tournament', 'teams'));
        }else{

            $matches = Match::where('tournament_id', $id)->get();


            $route = 'participants';
            return view('organize.participants', compact('route', 'name', 'tournament', 'matches','teams'));

        }
    }



    public function orgAccount()
    {

        $name = Auth::user();
        $org = Auth::user()->organize;

        return view('organize.orgAccount', compact('name', 'org'));

    }


    public function post_orgAccount(Request $request)
    {

        $this->validate($request, ['owner' => 'required', 'accountNumber' => 'required|min:16', 'bank' => 'required']);

//        send email to admin

        $org = Organize::where('id',$request->id)->first();
        if($org->credit >= 50000 ) {


            $bank = $request->bank;
            $accountNumber = $request->accountNumber;
            $owner = $request->owner;
            $email = Organize::where('id', $request->id)->first()->email;
            $data = ['bank' => $bank, 'accountNumber' => $accountNumber, 'owner' => $owner, 'email' => $email,'org'=>$org];

            Mail::send('email.paymentReq', $data, function ($message) use ($data) {

                $message->from('s23.moghadam@gmail.com');
                $message->to($data['email']);


            });


            return redirect()->back()->with(['message' => 'درخواست واریز شما ارسال شد و در کمتر از ۲۴ ساعت پیگیری می شود','code'=>0]);

        }else{

            return redirect()->back()->with(['message' => 'حداقل موجودی برای ارسال درخواست واریز ۵۰،۰۰۰ تومان می باشد','code'=>1]);

        }


    }


    public function coordinate(Request $request)
    {


        $tournament = Tournament::where('id', $request->id)->first();

        $tournament->lat = $request->lat;
        $tournament->lng = $request->lng;

        $tournament->save();
        return 'done';
    }

    public function OrgCoordinate(Request $request){

        $org = Organize::where('id',$request->id)->first();

        $org->lat = $request->lat;
        $org->lng = $request->lng;

        $org->save();

        return 'done';
    }


    public function cancel(Request $request){

        $tournament = Tournament::where('id',$request->id)->first();

        if($tournament->canceled == 0) {


//    dd($tournament->canceled);
            $tournament->update(['canceled' => 1]);

            $participants = $tournament->matches;

            $data = ['name' => $tournament->matchName, 'organize' => Auth::user()->organize, 'participants' => $participants];

            foreach ($participants as $participant) {


                $msg = new Message();
                $msg->user_id = $participant->user_id;
                $msg->message = "متاسفانه مسابقه لغو  شده و مبلغ پرداخت شده در کمتر از ۲۴ ساعت بازگردانده می شود ";
                $msg->organize_id = Auth::user()->organize->id;
                $msg->tournament_id = $request->id;
                $msg->save();

                $user = User::where('id', $participant->user_id)->first();

                $user->update(['unread' => $user->unread + 1]);

                Mail::send('email.cancelEmail', $data, function ($message) use ($data,$participant) {

                    $message->to(User::where('id', $participant->user_id)->first()->email);
                    $message->from(Auth::user()->organize->email);
                    $message->subject('لغو مسابقه');


                });

            }

            Mail::send('email.cancelEmail', $data, function ($message) use ($data) {

                $message->to('s23.moghadam@gmail.com');
                $message->from(Auth::user()->organize->email);
                $message->subject('لغو مسابقه');


            });


            return 'مسابقه لغو شد';

        }else{

            return 'پیش از این، مسابقه لغو شده است';
        }

    }

    public function edit(){

        $name = Auth::user();
        $org = Auth::user()->organize;

        return view('organize.orgEdit',compact('name','org'));

    }

    public function post_edit(Request $request){

        $time = time();
        $org = Organize::where('id',$request->id)->first();
        if( null != $request->file('logo_path')){

            $this->validate($request,['logo_path'=>'image']);


            unlink(public_path('storage/images/'.$org->logo_path));
            $org->update(['logo_path'=> $time.$request->file('logo_path')->getClientOriginalName()]);
            $request->file('logo_path')->move('storage/images/', $time . $request->file('logo_path')->getClientOriginalName());

        }

        if($request->comment){

            $org->update(['comment'=>$request->comment]);

        }

        if( null != $request->file('background_path')){

            $this->validate($request,['background_path'=>'image']);

            unlink(public_path('storage/images/'.$org->background_path));
            $org->update(['background_path'=> $time.$request->file('background_path')->getClientOriginalName()]);
            $request->file('background_path')->move('storage/images', $time . $request->file('background_path')->getClientOriginalName());

        }

        if($request->email){

            $this->validate($request,['background_path'=>'email']);


            $org->update(['email'=>$request->email]);

        }

        if($request->telegram){

            $org->update(['telegram'=>$request->telegram]);

        }

        if($request->address){

            $org->update(['telegram'=>$request->address]);

        }


        return redirect()->back()->with(['message'=>'تغییرات اعمال شد']);

    }



}