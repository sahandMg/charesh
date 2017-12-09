<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Spatie\Browsershot\Browsershot;


// ------------- home ---------------

//Route::get('/home',['as'=>'userHome','uses'=>'PageController@userHome']);


Route::get('chlbz/home/token',function (){

    echo csrf_token();
});
//

// ---------------- Admin panel -----------------------

Route::group(['prefix'=>'admin'],function (){


    Route::get('bargraph','API\UserController@status')->name('barGraph')->middleware('admin');

    Route::get('more-info',['as'=>'moreInfo','uses'=>'API\UserController@moreInfo']);

    Route::get('tournaments',['as'=>'tournaments','uses'=>'AdminController@tournaments']);


});



// ------------- Errors ----------------
Route::group(['prefix'=>'errors'],function (){

    Route::get('404',['as'=>'notFound','uses'=>'ErrorController@notFound']);
    Route::get('500',['as'=>'internalError','uses'=>'ErrorController@internalError']);
    Route::get('403',['as'=>'unAuthorized','uses'=>'ErrorController@unAuthorized']);


});

// ------------- auth ----------------
Route::group(['prefix'=>'app'],function (){

    Route::post('login', 'AuthController@AppLogin')->middleware('throttle:10,10');
    Route::post('register', 'AuthController@AppRegister')->middleware('throttle:10,10');


});



//Route::group(['middleware' => 'auth:api'], function(){
//    Route::post('details', 'API\UserController@details');
//});
//Route::get('image','PageController@image');
//



//Route::post('user/settings',['as'=>'userSetting','uses'=>'AuthController@post_userSetting'])->middleware('throttle:10,1');

// ------------- contact ----------------
Route::group(['prefix'=>'chlbz'],function (){

    Route::get('contact',['as'=>'contact','uses'=>'PageController@contact']);
    Route::post('contact',['as'=>'contact','uses'=>'PageController@postContact'])->middleware('throttle:10,1');
    Route::get('about',['as'=>'about','uses'=>'PageController@about']);

    Route::get('register',['middleware'=> ['auth'],'as'=>'register','uses'=>'AuthController@getRegister']);
    Route::post('register',['as'=>'register','uses'=>'AuthController@postRegister'])->middleware('throttle:10,10');

    Route::get('login',['middleware'=> ['auth'],'as'=>'login','uses'=>'AuthController@getLogin']);
    Route::post('login',['as'=>'login','uses'=>'AuthController@postLogin'])->middleware('throttle:10,10');

    Route::get('redirect',function (){
        return view('auth.redirect');
    })->middleware('auth')->name('redirect');

    Route::get('confirm/{id}',['as'=>'confirm','uses'=>'AuthController@confirm']);

    Route::get('email-verification',['as' => 'verify','uses'=>'AuthController@verify']);

    Route::post('email-verification-resend',['as' => 'resendVerify','uses'=>'AuthController@post_verifyAgain']);


    Route::post('password-reset',['as'=>'reset','uses'=>'AuthController@postReset'])->middleware('throttle:10,1');

    Route::get('home',['as'=>'home','uses'=>'PageController@home']);
    Route::get('view-more-{num}',['as'=>'viewMore','uses'=>'PageController@viewMore']);

});

Route::get('/',function(){})->middleware('beforeHome');

// ---------------- Challenge group -----------------------

Route::group(['prefix'=>'challenge'],function () {



    Route::post('getTeamImage','MatchController@getTeamImage');

    Route::get('register-{id}-{url}',['as'=>'matchRegistered','uses'=>'MatchController@MatchRegister']);


    Route::get('rules-{id}-{uri}',['as'=>'matchRules','uses'=>'MatchController@MatchRules']);
// Brackets
    Route::get('group-bracket-{id}-{uri}',['as'=>'matchGroupBracket','uses'=>'MatchController@MatchBracket']);
    Route::get('match-bracket-{id}-{url}',['as'=>'matchBracket' , 'uses'=>'MatchController@selectMatchBracket']);
    Route::get('no-bracket-{id}-{url}',['as'=>'noBracket','uses'=>'MatchController@noBracket']);

    Route::get('El-bracket-{id}-{uri}',['as'=>'matchElBracket','uses'=>'MatchController@MatchElBracket']);

    Route::get('group-El-bracket-{id}-{url}',['as' => 'MatchGElBracket' , 'uses'=>'MatchController@MatchGElBracket']);

    Route::get('timeline-{id}-{uri}',['as'=>'matchTimeline','uses'=>'MatchController@MatchTimeline']);

    Route::get('attenders-{id}-{uri}',['as'=>'matchAttenders','uses'=>'MatchController@MatchAttenders']);

    Route::get('announcements-{id}-{uri}',['as'=>'matchAnnounce','uses'=>'MatchController@MatchAnnounce']);

    Route::get('ticket-{id}-{url}',['as'=>'generatePdf','uses'=>'UserController@generatePdf']);

    Route::get('ticket-team-{id}-{url}',['as'=>'getTeamPdf','uses'=>'UserController@getTeamPdf']);
// ------------- Brackets----------------

    Route::get('league-bracket-{id}-{url}',['as'=>'LeagueTable2','uses'=>'MatchController@LeagueTable']);

});

// ------------- Match Register----------------




Route::post('/get-match','MatchController@GetMatch')->middleware('throttle:10,1');

Route::get('get-GElimination-bracket-{id}-{url}','MatchController@getGElBracket')->name('getGElBracket');

Route::get('get-elimination-bracket-{id}-{url}','MatchController@getElBracket')->name('getElBracket');


Route::get('/get-routeName','MatchController@GetRoute')->middleware('guest');


Route::get('return-base-info',['as'=>'returnBaseInfo','uses'=>'MatchController@returnBI']);

Route::get('return-match-info',['as'=>'returnMatchInfo','uses'=>'MatchController@returnMI']);

Route::get('return-rule-info',['as'=>'returnRuleInfo','uses'=>'MatchController@returnRI']);

Route::get('return-plan-info',['as'=>'returnPlanInfo','uses'=>'MatchController@returnPI']);

Route::get('return-cost-info',['as'=>'returnCostInfo','uses'=>'MatchController@returnCI']);


// ------------- Make Organize----------------

Route::group(['prefix'=>'organization'],function (){


    Route::get('make',['middleware'=>'guest','as' => 'MakeOrganize','uses' => 'OrganizeController@MakeOrganize']);
    Route::post('make',['as' => 'MakeOrganize','uses' => 'OrganizeController@postMakeOrganize'])->middleware('throttle:10,1');

    Route::get('edit',['middleware'=>['guest','organize'],'as'=>'orgEdit','uses'=>'OrganizeController@edit']);
    Route::post('edit',['middleware'=>['guest','organize','throttle:10,1'],'as'=>'orgEdit','uses'=>'OrganizeController@post_edit']);


    Route::get('contact',['middleware'=>'guest','as' => 'OrganizeContact','uses' => 'OrganizeController@OrganizeContact']);
    Route::post('contact',['as' => 'OrganizeContact','uses' => 'OrganizeController@postOrganizeContact'])->middleware('throttle:10,1');

    Route::get('{name}-profile',['as' => 'organizeProfile','uses'=>'OrganizeController@organizeProfile']);

    Route::get('ask','OrganizeController@askOrganize')->middleware('guest');

    Route::get('account',['middleware'=>'guest','as'=>'organizeAccount','uses'=>'OrganizeController@orgAccount']);
    Route::post('account',['as'=>'organizeAccount','uses'=>'OrganizeController@post_orgAccount'])->middleware('throttle:10,1');

    Route::get('created-matches',['middleware'=> ['guest','organize'],'as'=>'orgMatches','uses'=>'OrganizeController@matches']);

    Route::post('coordinate','OrganizeController@OrgCoordinate')->name('orgLocation');

    Route::get('get-money','OrganizeController@GetMoney')->middleware('guest');



// --------------- organization/challenge ---------------------


        Route::get('challenge-create', ['middleware' => ['guest', 'organize'], 'as' => 'matchCreate', 'uses' => 'MatchController@create']);

        Route::get('challenge-info', ['middleware' => 'guest', 'as' => 'matchInfo', 'uses' => 'MatchController@matchInfo']);

        Route::post('challenge-info', ['as' => 'matchInfo', 'uses' => 'MatchController@post_matchInfo'])->middleware('throttle:10,1');

        Route::get('base-info', ['middleware' => 'guest', 'as' => 'baseInfo', 'uses' => 'MatchController@baseInfo']);

        Route::post('base-info', ['as' => 'baseInfo', 'uses' => 'MatchController@post_baseInfo'])->middleware('throttle:10,1');


        Route::get('challenge-rules', ['middleware' => 'guest', 'as' => 'rules', 'uses' => 'MatchController@rules']);

        Route::post('challenge-rules', ['as' => 'rules', 'uses' => 'MatchController@post_rules'])->middleware('throttle:10,1');

        Route::get('challenge-plan', ['middleware' => 'guest', 'as' => 'plan', 'uses' => 'MatchController@plan']);

        Route::post('challenge-plan', ['as' => 'plan', 'uses' => 'MatchController@post_plan'])->middleware('throttle:10,1');

        Route::get('challenge-cost', ['middleware' => 'guest', 'as' => 'cost', 'uses' => 'MatchController@cost']);

        Route::post('challenge-cost', ['as' => 'cost', 'uses' => 'MatchController@post_cost'])->middleware('throttle:10,1');

        Route::get('challenge-contact', ['middleware' => 'guest', 'as' => 'contactInfo', 'uses' => 'MatchController@contactInfo']);

        Route::post('challenge-contact', ['as' => 'contactInfo', 'uses' => 'MatchController@post_contactInfo'])->middleware('throttle:10,1');

        Route::get('challenge-participants-{id}-{url}',['middleware'=> ['guest','organize'],'as'=>'participants','uses'=>'OrganizeController@participants']);




    Route::get('challenge-info-edit-{id}-{url}',['middleware'=> ['guest','organize'],'as' => 'challengePanel' ,'uses' => 'OrganizeController@challengePanel']);

    Route::post('challenge-info-edit-{id}-{url}',['middleware'=> ['guest','organize','throttle:10,1'],'as' => 'challengePanel' ,'uses' => 'OrganizeController@post_challengePanel']);

    Route::post('challenge-cancel-{id}',['middleware'=> 'throttle:10,1','as'=>'cancelChallenge','uses'=>'OrganizeController@cancel']);
//Route::get('challenge-info-edit-{id}-{url}',['middleware'=> ['guest','organize'],'as' => 'challengeInfo','uses'=>'OrganizeController@challengeInfo']);


    Route::get('challenge-timeline-edit-{id}-{url}',['middleware'=> ['guest','organize'],'as' => 'challengeTime','uses'=>'OrganizeController@challengeTimeline']);

    Route::post('challenge-timeline-edit-{id}-{url}',['middleware'=> ['guest','organize','throttle:10,1'],'as' => 'challengeTime','uses'=>'OrganizeController@post_challengeTimeline']);

    Route::get('challenge-message-{id}-{url}',['middleware'=> ['guest','organize'],'as' => 'challengeMessage','uses'=>'OrganizeController@challengeMessage']);

    Route::post('challenge-message-{id}-{url}',['as' => 'challengeInfo','uses'=>'OrganizeController@post_challengeMessage'])->middleware('throttle:5,1');


    Route::get('delete-bracket-{id}-{url}',['middleware'=> ['guest','organize'],'as'=>'bracketDelete','uses'=>'OrganizeController@bracketDelete']);
    Route::get('bracket-select-{id}-{url}',['middleware'=> ['guest','organize','bracket'],'as' => 'challengeBracket','uses'=>'OrganizeController@challengeBracket']);




    Route::get('edit-group-bracket-{id}-{url}',['middleware'=> ['guest','organize','bracket'],'as' => 'groupBracket','uses'=>'OrganizeController@groupBracket']);
    Route::post('edit-group-bracket-{id}-{url}',['middleware'=> ['guest','organize','throttle:10,1'],'as' => 'groupBracket','uses'=>'OrganizeController@post_groupBracket']);

    Route::get('edit-group-bracket2-{id}-{url}',['middleware'=> ['guest','organize','bracket'],'as' => 'makeGroupBracket','uses'=>'OrganizeController@makeGroupBracket2']);
    Route::post('edit-group-bracket2-{id}-{url}',['middleware'=> ['guest','organize','throttle:10,1'],'as' => 'makeGroupBracket','uses'=>'OrganizeController@post_makeGroupBracket2']);

    Route::get('edit-group-bracket3-{id}-{url}',['middleware'=> ['guest','organize','bracket'],'as' => 'makeGroupBracket3','uses'=>'OrganizeController@makeGroupBracket3']);
    Route::post('edit-group-bracket3-{id}-{url}',['middleware'=> ['guest','organize','throttle:10,1'],'as' => 'makeGroupBracket3','uses'=>'OrganizeController@post_makeGroupBracket3']);

// Group elimination
    Route::get('edit-elimination-bracket-{id}-{url}',['middleware'=> ['guest','organize','bracket'],'as' => 'ElBracket','uses'=>'OrganizeController@makeElBracket']);
    Route::post('edit-elimination-bracket-{id}-{url}',['middleware'=> ['guest','organize','throttle:10,1'],'as' => 'ElBracket','uses'=>'OrganizeController@post_makeElBracket']);


 // League eliminatin
    Route::get('edit-elimination-bracket2-{id}-{url}',['middleware'=> ['guest','organize','bracket'],'as' => 'ElBracket2','uses'=>'OrganizeController@makeElBracket2']);
    Route::post('edit-elimination-bracket2-{id}-{url}',['middleware'=> ['guest','organize','throttle:10,1'],'as' => 'ElBracket2','uses'=>'OrganizeController@post_makeElBracket2']);

    Route::get('edit-league-bracket-{id}-{url}',['middleware'=> ['guest','organize','bracket'],'as'=>'leagueBracket','uses'=>'OrganizeController@leagueBracket']);
    Route::post('edit-league-bracket-{id}-{url}',['middleware'=> ['guest','organize','throttle:10,1'],'as'=>'leagueBracket','uses'=>'OrganizeController@post_leagueBracket']);

    Route::get('edit-league-bracket2-{id}-{url}',['middleware'=> ['guest','organize','bracket'],'as'=>'leagueBracket2','uses'=>'OrganizeController@leagueBracket2']);
    Route::post('edit-league-bracket2-{id}-{url}',['middleware'=> ['guest','organize','throttle:10,1'],'as'=>'leagueBracket2','uses'=>'OrganizeController@post_leagueBracket2']);



});




// ------------- Credit----------------




// ------------- Match Register----------------

//Route::get('challenge-detail-{id}-{url}',['middleware'=>'guest','as' => 'challengeDetail' , 'uses'=> 'MatchController@challengeDetail']);

// ------------- User Profile ----------------

Route::group(['prefix'=>'user'],function(){



    Route::get('challenges',['middleware'=> 'guest','as' => 'userChallenge','uses' => 'UserController@userChallenge']);
    Route::post('match-register',['middleware'=> ['guest','throttle:10,1'] ,'as'=>'matchRegister','uses'=>'MatchController@singleRegister']);


    Route::get('credit',['middleware'=> 'guest','as' => 'credit','uses' => 'UserController@credit']);
    Route::post('credit',['as' => 'credit','uses' => 'UserController@postCredit'])->middleware('throttle:10,1');



    Route::get('setting',['middleware'=>'guest','as' => 'setting','uses' => 'UserController@setting']);
    Route::post('setting',['as' => 'setting','uses' => 'UserController@postSetting'])->middleware('throttle:10,1');

    Route::get('notifications',['middleware'=> ['guest'],'as'=>'notification','uses'=>'UserController@notification']);

    Route::post('delete-notifications',['middleware'=> ['guest'],'as'=>'deleteNotification','uses'=>'UserController@deleteNotification']);


    Route::get('logout',['as'=>'logout','uses'=>'AuthController@logout']);

});






// ---------------- ajax requests -----------------------

Route::get('round-{id}-{round?}',['as'=>'round','uses'=>'MatchController@GetRound' ]);
Route::post('league-table-{id}',['as'=>'LeagueTable','uses'=>'OrganizeController@LeagueTable']);
Route::get('/all','API\UserController@all');
Route::get('/online','API\UserController@online');
Route::get('/guests','API\UserController@guests');
Route::get('check-round-{id}-{round?}',['as'=>'checkRound','uses'=>'OrganizeController@checkRound']);

Route::get('/get-matches','MatchController@getMatches');
Route::get('/get-time','MatchController@time');
Route::get('/get-tournament','MatchController@getTournament');

Route::post('coordinate','OrganizeController@coordinate')->name('matchLocation');
