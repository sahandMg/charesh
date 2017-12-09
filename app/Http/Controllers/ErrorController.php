<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function notFound(){


        return view('error.404');

    }


    public function unAuthorized(){


        return view('error.403');

    }

    public function internalError(){


        return view('error.500');

    }

}
