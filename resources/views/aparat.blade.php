<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://unpkg.com/vue"></script>

     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>

    <meta charset="UTF-8">
    <title>Vue14</title>

</head>
<body>
<!--<div style="height: 100px;width:300px;" id="15138742737341213"><script type="text/JavaScript" src="https://www.aparat.com/embed/qrNcR?data[rnddiv]=15138742737341213&data[responsive]=yes"></script></div>-->
<div>

    <!--<script type="text/javascript" src="https://www.aparat.com//etc/api/uploadpost/video/frm-id//data[title]//"></script>-->
</div>

<div id="app">
    <input @keyup.enter.lazy="result" type="search" placeholder="name..." v-model="search">
    <span >Result : @{{message}}</span>


    <button class="btn btn-primary" @click="sendVideo">Send Video</button>

</div>

<script>
Vue.filter('uppercase',function (value) {

    return value.toString().toUpperCase()
})
    new Vue({
        el:'#app',
        data:{
            message:'',
            names:['sahand','mamad','ali'],
            search:'',
        },
        methods:{
        sendVideo:function () {
//             axios.get('https://www.aparat.com/etc/api/login/luser/sahandmg/lpass/44644831',).then(function (response) {
//                  console.log(response.data)
//              })
$.ajax({

    url:'https://www.aparat.com/etc/api/login/luser/sahandmg/lpass/44644831', 
    type: 'POST',
    crossDomain: true,
    dataType: 'jsonp',
    success: function() { alert("Success"); },
    error: function() { alert('Failed!'); },
});

            },
            result:function () {

                ans = this.names.indexOf(this.search)
//                this.search = ''
                console.log(ans)
                if(ans == -1){
                    this.message = 'Not found'
                }else{
                    this.message =  'success!'
                }

            }
        }

    })


</script>
</body>
</html>


