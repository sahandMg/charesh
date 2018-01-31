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


</head>
<body>

<div id="textCheck" class="container">

    <div class="row">
        <ul  class="nav nav-tabs">
            <li><a href="{{route('contents')}}">تصاویر کاربران</a></li>
            <li><a href="{{route('matchImg')}}">تصاویر مسابقات</a></li>
            <li  class="active" ><a href="{{route('text')}}">متن مسابقات</a></li>
            <li ><a href="{{route('orgImg')}}">تصاویر برگزار کنندگان</a></li>
            <li><a href="{{route('orgText')}}">متن های برگزار کننده</a></li>
            <li ><a href="{{route('canceled')}}">مسابقات کنسل شده</a></li>
            <li><a href="{{route('barGraph')}}">وضعیت اعضای سایت</a></li>
            <li><a href="{{route('payment')}}">تسویه حساب  </a></li>
            <li><a href="{{route('home')}}">خانه</a></li>
        </ul>
    </div>
    <br>

    <div class="row">

        <div v-for="tournament in tournaments" class="col-md-12">

            <div style="border: 1px solid black">
                <h2 class="text-center">@{{ tournament.matchName }}</h2>
                <p>@{{{ tournament.prize }}}</p>
                <button @click="deletePrize(tournament.id)" class="btn btn-danger btn-block">حذف متن جایزه</button>
                <hr>
                <p>@{{{ tournament.moreInfo }}}</p>
                <button @click="deleteMoreInfo(tournament.id)" class="btn btn-danger btn-block"> حذف متن اطلاعات بیشتر</button>
                <hr>
                <a href="{{URL::asset('storage/pdfs/')}}/@{{ tournament.rules }}" style="padding: 15px;">@{{ tournament.rules }}<i class="fa fa-file-pdf-o fa-lg" aria-hidden="true"></i></a>
                <button @click="deletePdf(tournament.id)" class="btn btn-danger btn-block"> pdf حذف فایل</button>
                <hr>
            </div>
        </div>

    </div>

</div>


<script>

    new Vue({

        el:'#textCheck',
        data:{

            tournaments:['']
        },
        methods:{

            deletePrize:function (id) {
                vm = this;
                axios.get('delete-tournament-prize/'+id).then(function (response) {

                    vm.tournaments = response.data

                })

            },

            deleteMoreInfo:function (id) {

                vm = this;
                axios.get('delete-tournament-moreInfo/'+id).then(function (response) {

                    vm.tournaments = response.data

                })

            },

            deletePdf:function (id) {

                vm = this;
                axios.get('delete-tournament-pdf/'+id).then(function (response) {

                    vm.tournaments = response.data

                })

            }



        },

        created:function () {
            vm = this;
            axios.get('get-tournaments').then(function (response) {

                vm.tournaments = response.data


            })

        }

    })


</script>
</body>
</html>