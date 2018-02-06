@extends($auth == 1 ? 'masterUserHeader.body' : 'masterHeader.body')

@section('title')
    چارش | ارتباط با ما
@endsection

@section('content')


    <div id="app" class="container" style="direction: rtl;margin-top: 100px;">
        <div class="card" style="box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);z-index: 0.5;">
     <h3 class="card-title" style="background-color: #42CBC8;padding: 20px;color: white;">ارتباط با ما</h3>
     <form style="padding: 20px;" method="POST" action="{{route('contact')}}">
         <input type="hidden" name="_token" value="{{csrf_token()}}">
         @if(count(session('message')) )
             <div class="alert alert-success ">
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
             <label for="exampleInputEmail1">نام و نام خانوادگی</label>
             <input name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{Request::old('name')}}"  placeholder="نام و نام خانوادگی">
         </div>
      <div class="form-group">
        <label for="exampleInputEmail1">ایمیل</label>
        <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{Request::old('email')}}"  placeholder="ایمیل خود را وارد کنید">
      </div>

      <div class="form-group">
        <label for="exampleInputPassword1">متن پیام</label>

          <textarea id="summernote" name="message" class="form-control"></textarea>
        {{--<textarea name="message" type="text" class="form-control" id="exampleInputPassword1" rows="5" style="resize: none"></textarea>--}}
      </div>


         <input v-show="!hide" @click="hidden" type="submit" class="btn btn-primary" value="ارسال پیام">
         <button v-show="hide" class="btn btn-primary " :disabled="true"><i class="fa fa-spinner fa-spin"></i> درحال ارسال</button>




      </form>
    </div>
  </div>









    <script type="text/javascript" src="{{URL::asset('js/bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/main.js')}}"></script>


    <script>
        new Vue({

            el:'#app',
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

    {{--<script type="text/javascript">--}}
        {{--$(document).ready(function(){--}}
            {{--$('#summernote').summernote({--}}
                {{--height : '150px',--}}
                {{--placeholder:'پیام',--}}
                {{--fontNames:['Arial','Arial Black','Khmer OS'],--}}

            {{--})--}}
        {{--})--}}

        {{--$('#clear').on('click',function(){--}}
            {{--$('#summernote').summernote('code',null);--}}
        {{--})--}}
    {{--</script>--}}
@endsection