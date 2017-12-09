<?php

namespace App\Http\Controllers;

use App\Tournament;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {

    $this->middleware('admin');

    }


    public function tournaments(){

        $tournaments = Tournament::all();

        return view('admin.tournaments',compact('tournament'));


    }



}
