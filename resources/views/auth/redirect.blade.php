@extends('masterHeader.body')

@section('content')
    
    
    <div class="container" style="height:590px;width:100%;background:whitesmoke">

        <div style="position: absolute;top:200px;left:640px"> <h3 style="color: rgb(255,160,51)">  ... با تشکر</h3></div>

        <div style="position: absolute;top:256px;left:500px"> <h3 style="color: rgb(255,160,51)">.حساب شما با موفقیت ثبت شد</h3></div>

        <div style="position: absolute;top:300px;left:520px"><h5><a style="text-decoration: none" href="{{route('login')}}">! برای ورود به حساب خود کلیک کنید </a></h5></div>






    </div>

    
    @endsection