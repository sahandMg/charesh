<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<center>
    <h1>لغو مسابقه</h1>
    <h3>نام مسابقه</h3>
    <h4>{{$name}}</h4>
<h3>نام برگزار کننده</h3>
<h4>{{$organize->name}}</h4>
<h3>شرکت کنندگان</h3>
<ul style="list-style: none">
    @foreach($participants as $participant)

        <li>{{$participant->user->username}}</li>

     @endforeach
</ul>
</center>
</body>
</html>