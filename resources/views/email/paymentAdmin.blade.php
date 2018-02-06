<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body style="font-family: Helvetica Neue, Helvetica, Arial, sans-serif">
<center>
    <h4>نام برگزار کننده</h4>
    <h6>{{$org->name}}</h6>
    <h4>نام صاحب حساب</h4>
    <h6>{{$owner}}</h6>
    <h4>شماره حساب</h4>
    <h6>{{$accountNumber}}</h6>
    <h4>نام بانک</h4>
    <h6>{{$bank}}</h6>
    <h4>ایمیل</h4>
    <h6>{{$email}}</h6>
    <h4>مبلغ درخواستی</h4>
    <h6 style="direction: rtl">تومان {{$org->credit*0.98}}</h6>
</center>
</body>
