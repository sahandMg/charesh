<?php

namespace App\Http\Controllers;

use App\Organize;
use App\Tournament;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {

        $this->middleware('admin');

    }

    public function contents(){

        return view('admin.usersImg');
    }

    public function getUserImg(){

        $users = User::orderBy('created_at','decs')->get();

        return $users;
    }

    public function deleteUserImg($path){

        $user = User::where('path',$path)->first();
        $user->update(['path'=>'Blank.png']);
        if($path != 'Blank100_100.png'){
            unlink( public_path('storage/images/' .$path));
        }
        $users = User::orderBy('created_at','decs')->get();
        return $users;

    }

    public function matchImg(){



        return view('admin.tournaments',compact('tournaments'));


    }

    public function deleteImg($path){

        $tournament = Tournament::where('path',$path)->first();
        $tournament->update(['path'=>'Blank.png']);
        if($path != 'Blank.png'){
            unlink( public_path('storage/images/' .$path));
        }

        $tournaments = Tournament::orderBy('created_at','decs')->get();
        return $tournaments;

    }

    public function matches()
    {

        $tournaments = Tournament::orderBy('created_at','decs')->get();

        return $tournaments;


    }


    public function text(){

        $tournaments = Tournament::all();

        return view('admin.text',compact('tournaments'));


    }

    public function deletePrize($id){

        $tournament = Tournament::where('id',$id)->first();
        $tournament->update(['prize'=>'متنی موجود نیست']);
        $tournaments = Tournament::orderBy('created_at','decs')->get();
        return $tournaments;

    }

    public function deleteMoreInfo($id){

        $tournament = Tournament::where('id',$id)->first();
        $tournament->update(['moreInfo'=>'متنی موجود نیست']);
        $tournaments = Tournament::orderBy('created_at','decs')->get();
        return $tournaments;

    }
    public function deletePdf($id){

        $tournament = Tournament::where('id',$id)->first();
        unlink(public_path("storage/pdfs/$tournament->rules"));
        $tournament->update(['rules'=>'قوانینی برای مسابقه آپلود نشده است']);
        $tournaments = Tournament::orderBy('created_at','decs')->get();
        return $tournaments;

    }

    public function orgImg(){

        $org = Organize::all();

        return view('admin.org',compact('org'));
    }


    public function orgs(){

        $org = Organize::orderBy('created_at','decs')->get();
        return $org;

    }


    public function delBackImg($path){

        $org = Organize::where('background_path',$path)->first();
        $org->update(['background_path'=>'Blank.png']);
        if($path != 'Blank.png'){
            unlink( public_path('storage/images/' .$path));
        }

        $org = Organize::orderBy('created_at','decs')->get();
        return $org;


    }


    public function delLogoImg($path){

        $org = Organize::where('logo_path',$path)->first();
        $org->update(['logo_path'=>'Blank100_100.png']);
        if($path != 'Blank100_100.png'){
            unlink( public_path('storage/images/' .$path));
        }

        $org = Organize::orderBy('created_at','decs')->get();
        return $org;


    }


    public function orgText(){

        $org = Organize::all();

        return view('admin.orgText',compact('org'));

    }


    public function delAddress($id){

        $org = Organize::where('id',$id)->first();
        $org->update(['address'=>'متنی موجود نیست']);
        $org = Organize::orderBy('created_at','decs')->get();
        return $org;


    }


    public function delComment($id){

        $org = Organize::where('id',$id)->first();
        $org->update(['comment'=>'متنی موجود نیست']);
        $org = Organize::orderBy('created_at','decs')->get();
        return $org;


    }

    public function payment(){

        $org = Organize::all();

        return view('admin.payment',compact('org'));

    }

    public function DoPay($id){

        $org = Organize::where('id',$id)->first();
        $org->update(['credit' => 0]);
        $org = Organize::orderBy('created_at','decs')->get();
        return $org;

    }

    public function canceled(){

        $tournaments = Tournament::where('canceled',1)->get();

        return view('admin.canceled');

    }

    public function GetCanceled(){

        return Tournament::where('canceled',1)->get();
    }

    public function removeTournament(Request $request){

        Tournament::where('id',$request->id)->delete();

        return Tournament::where('canceled',1)->get();

    }


}
