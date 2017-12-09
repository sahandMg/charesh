<!doctype html>
<script src="http://cdnjs.cloudflare.com/ajax/libs/vue/1.0.28/vue.js"></script>
<script src="https://cdn.jsdelivr.net/vue.resource/1.2.1/vue-resource.min.js"></script>
<script src="https://cdn.jsdelivr.net/lodash/4.17.4/lodash.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div style="position: absolute;right: 10px;top: 10px;">
    <h5 id="username" style="direction: ltr;text-align:right;">: کاربر گرامی </h5><h5 style="text-align: right">{{$name}}</h5>
    <h5 style="direction: ltr;text-align: right"> رمز عبور شما با موفقیت تغییر یافت. در اولین فرصت رمز عبور خود را تغییر دهید</h5>
    <h5 style="text-align: right">{{$password}} <span style="text-align: right">رمز عبور جدید</span></h5>
</div>
</body>
</html>

