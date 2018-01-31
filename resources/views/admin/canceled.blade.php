<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/vue/1.0.28/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/vue.resource/1.2.1/vue-resource.min.js"></script>
    <script src="https://cdn.jsdelivr.net/lodash/4.17.4/lodash.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>


    <title>Document</title>
</head>
<body>
<div class="container" id="textCheck">
    <div class="row">
        <ul  class="nav nav-tabs">
            <li ><a href="{{route('contents')}}">تصاویر کاربران</a></li>
            <li><a href="{{route('matchImg')}}">تصاویر مسابقات</a></li>
            <li><a href="{{route('text')}}">متن مسابقات</a></li>
            <li ><a href="{{route('orgImg')}}">تصاویر برگزار کنندگان</a></li>
            <li><a href="{{route('orgText')}}">متن های برگزار کننده</a></li>
            <li  class="active" ><a href="{{route('canceled')}}">مسابقات کنسل شده</a></li>
            <li><a href="{{route('barGraph')}}">وضعیت اعضای سایت</a></li>
            <li><a href="{{route('payment')}}">تسویه حساب  </a></li>
            <li><a href="{{route('home')}}">خانه</a></li>
        </ul>
    </div>
    <div  v-for="tournament in tournaments"  class="container">
        <br>
        <hr>
            <div class="col-md-6">
                @{{tournament.matchName}}
                <button @click="remove(tournament.id)" class="btn btn-danger">حذف</button>
            </div>

    </div>
</div>


<script>

    new Vue({

        el:'#textCheck',
        data:{

            tournaments:['']
        },
        methods: {

            remove:function (id) {
                vm = this
                axios.get({!! json_encode(route('removeTournament')) !!}+'?id='+id).then(function (response) {

                    vm.tournaments = response.data
                })

            }

        },
        created:function () {
            vm = this
            axios.get({!! json_encode(route('getCanceled'))!!}).then(function (response) {

                vm.tournaments = response.data
            })



        }

    })

</script>
</body>
</html>