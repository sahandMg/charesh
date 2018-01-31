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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Document</title>
    <style>
        td,th{
            text-align: center;
        }
    </style>
</head>
<body>

<div id="paymentCheck" class="container">
    <div class="row">
        <ul  class="nav nav-tabs">
            <li><a href="{{route('contents')}}">تصاویر کاربران</a></li>
            <li><a href="{{route('matchImg')}}">تصاویر مسابقات</a></li>
            <li><a href="{{route('text')}}">متن مسابقات</a></li>
            <li ><a href="{{route('orgImg')}}">تصاویر برگزار کنندگان</a></li>
            <li><a href="{{route('orgText')}}">متن های برگزار کننده</a></li>
            <li ><a href="{{route('canceled')}}">مسابقات کنسل شده</a></li>
            <li><a href="{{route('barGraph')}}">وضعیت اعضای سایت</a></li>
            <li   class="active"><a href="{{route('payment')}}">تسویه حساب  </a></li>
            <li><a href="{{route('home')}}">خانه</a></li>
        </ul>
    </div>

    <br>
    <table class="table table-bordered ">

        <thead>
            <tr>
                <th>نام برگزار کننده</th>
                <th> موجودی | تومان</th>
                <th>وضعیت</th>
            </tr>

        </thead>

        <tbody>

        <tr v-for="org in orgs">

            <td>@{{ org.name }}</td>
            <td>@{{ org.credit }}</td>
            <td> <button @click="pay(org.id)" class="btn btn-primary">تسویه</button> </td>

        </tr>


        </tbody>

    </table>

</div>



<script>

    new Vue({

        el:'#paymentCheck',
        data:{

            orgs:['']
        },
        methods:{

            pay:function (id) {
                vm = this;
                axios.get('pay-org/'+id).then(function (response) {

                    vm.orgs = response.data

                })

            },


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