@extends('masterUserHeader.body')
@section('title')
    چارش | اعتبار  {{$org->name}}
@endsection
@section('content')

    <div class="formDiv" id="account">
        <h3>حساب من</h3>
        <h5>   {{$org->credit * 0.95}} تومان</h5>
        <form method="POST" action="{{route('organizeAccount',['id'=>$org->id,'orgName'=>$name->organize->slug])}}">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <!-- ٍٍError message -->
            @if((session('message')) && session('code') == 0)
                <div class="alert alert-success ">
                    {{session('message')}}
                </div>
            @elseif(count(session('message')) && session('code') == 1)

                <div class="alert alert-danger ">
                    {{session('message')}}
                </div>

            @endif
            @if(count($errors->all()))
                <div class="alert alert-danger" role="alert">

                    @foreach($errors->all() as $error)

                        <li>{{$error}}</li>

                    @endforeach

                </div>
            @endif
            <div class="form-group">
                <label for="Name-input">شماره حساب  </label>
                <input class="form-control" name="accountNumber" type="text" value="" id="example-text-input">
            </div>

            <div class="form-group">
                <label for="Name-input">بانک  </label>
                <input class="form-control" name="bank" type="text" value="">
            </div>
            <br>
            <button @click="hidden" v-show="!hide" type="submit" class="btn btn-primary" >درخواست واریز</button>
            <button v-show="hide" class="btn btn-warning " :disabled="true"><i class="fa fa-spinner fa-spin" ></i> در حال ارسال درخواست </button>
        </form>
    </div>


    <script>
        new Vue({

            el:'#account',
            data:{
                hide:false
            },
            methods:{

                hidden:function () {
                    this.hide = true
                }
            }

        })
    </script>


    <style>
      .formDiv {
          width: 80%;
          margin: 0 auto;
          box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
          z-index: 1;
          direction: rtl;
          background-color: white;
      }

      .formDiv h3 {
          background-color: #42CBC8;
          padding: 20px;
          color: white;
      }

      .formDiv form {
          padding: 20px;
      }
      h5 {
          font-weight: 400;
          font-size: 150%;
          text-align: center;
      }

  </style>





 {{--<script type="text/javascript" src="js/jquery-3.2.1.js"></script>--}}
  <script type="text/javascript" src="{{URL::asset('js/main.js')}}"></script>
  <script type="text/javascript" src="{{URL::asset('js/bootstrap.js')}}"></script>

@endsection
