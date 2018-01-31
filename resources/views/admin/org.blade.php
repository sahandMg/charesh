<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/vue/1.0.28/vue.js"></script>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <title>Document</title>
</head>
<body>

<div id="org" class="container">

    <div class="row">
        <ul  class="nav nav-tabs">
            <li><a href="{{route('contents')}}">تصاویر کاربران</a></li>
            <li><a href="{{route('matchImg')}}">تصاویر مسابقات</a></li>
            <li><a href="{{route('text')}}">متن مسابقات</a></li>
            <li  class="active" ><a href="{{route('orgImg')}}">تصاویر برگزار کنندگان</a></li>
            <li><a href="{{route('orgText')}}">متن های برگزار کننده</a></li>
            <li ><a href="{{route('canceled')}}">مسابقات کنسل شده</a></li>
            <li><a href="{{route('barGraph')}}">وضعیت اعضای سایت</a></li>
            <li><a href="{{route('payment')}}">تسویه حساب  </a></li>
            <li><a href="{{route('home')}}">خانه</a></li>

        </ul>
    </div>

    <br>
    <div class="row">

        <div v-for="org in orgs"  class="col-md-4" style="border: 1px solid black">
            <h5 class="text-center">@{{ org.name }}</h5>
            <img class="img-responsive img-rounded" height="100" width="100" src="{{URL::asset('storage/images/')}}/@{{ org.background_path }}" alt="">
            <br>
            <br>
            <button @click='delBackImg(org.background_path)' style="cursor: pointer" class="btn btn-danger btn-block">حذف عکس پس زمینه</button>
            <br>
            <br>

            <hr>
            <img class="img-responsive img-rounded" height="200" width="200" src="{{URL::asset('storage/images/')}}/@{{ org.logo_path }}" alt="">
            <br>
            <br>
            <button @click='delLogoImg(org.logo_path)' style="cursor: pointer" class="btn btn-danger btn-block">حذف عکس لوگو </button>
            <br>
            <br>


        </div>


    </div>


</div>

<script>

    new Vue({

        el:'#org',
        data:{

            orgs:['']
        },
        methods:{

            delBackImg:function (path) {
                vm = this;
                axios.get('delete-org-backimg/'+path).then(function (response) {

                    vm.orgs = response.data

                })

            },
            delLogoImg:function (path) {
                vm = this;
                axios.get('delete-org-logoimg/'+path).then(function (response) {

                    vm.orgs = response.data

                })

            }

        },

        created:function () {
            vm = this;
            axios.get('get-org-img').then(function (response) {

                vm.orgs = response.data


            })

        }

    })


</script>
</body>
</html>