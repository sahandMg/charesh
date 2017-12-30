<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script src="http://cdnjs.cloudflare.com/ajax/libs/vue/1.0.28/vue.js"></script>
                <script src="https://cdn.jsdelivr.net/vue.resource/1.2.1/vue-resource.min.js"></script>
               <script src="https://cdn.jsdelivr.net/lodash/4.17.4/lodash.js"></script>
                <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

    <title>اطلاعات مسابقه</title>
</head>
<body>

<center>
    <h4>نام مسابقه</h4>
    <h6>{{$matchName}}</h6>
<h4>زمان برگزاری</h4>
<h6>{{$startTime}}</h6>
<h4>هزینه بلیط برای هر نفر</h4>
<h6>تومان{{$cost}}</h6>
<h4>اعتبار باقی مانده شما</h4>
<h6>تومان{{$credit}}</h6>
    @if(null !=($teammates))
    <h4>شرکت کنندگان</h4>
    <ul style="list-style: none">
        @foreach($teammates as $teammate)

            <li>{{$teammate->name}}</li>
            @endforeach
    </ul>
        @endif
    <a href="{{route('generatePdf',['id'=>$match->id,'matchName'=>$match->matchName])}}"><h4>لینک دانلود بلیط</h4></a>

</center>
</body>
</html>
