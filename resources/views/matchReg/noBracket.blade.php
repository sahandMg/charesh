@extends($auth == 1 ? 'masterUserHeader.body' : 'masterHeader.body')
@section('matchName')
     {{$tournament->matchName}}
@endsection

@section('title')
    چارش |   {{$tournament->matchName}}
@endsection


@section('content')



    <div class="container" style="direction: rtl;padding-top: 30px;">


        @include('masterMatch.body',['tournament'=> $tournament,'route'=>$route])

        <h1 style="color: darkred;text-align: center" >براکتی برای این مسابقه ساخته نشده است </h1>



    </div>


    @endsection