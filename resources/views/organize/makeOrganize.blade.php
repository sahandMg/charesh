@extends('masterUserHeader.body')
@section('content')


 <div class="container" style="direction: rtl;" id="app">

  <nav class="nav nav-pills nav-fill" style="padding-top: 50px;">
    <a class="nav-item nav-link active" href="#">اطلاعات پایه</a>
    <a class="nav-item nav-link disabled" href="#">راه های ارتباطی</a>
  </nav>

     <form style="padding-top: 20px;" method="POST" action="{{route('MakeOrganize')}}" enctype="multipart/form-data">
         <input type="hidden" name="_token" value="{{csrf_token()}}">
         <!-- ٍٍError message -->
         @if(count($errors->all()))
             <div class="alert alert-danger" role="alert">
                 @foreach($errors->all() as $error)

                     <li>{{$error}}</li>

                 @endforeach
             </div>
         @endif
         {{--<div class="alert alert-danger" role="alert">--}}
             {{--<strong>ایمیل</strong> خود را اشتباه وارد کرده اید .--}}
         {{--</div>--}}
         <div class="form-group row">
             <label for="Name-input" class="col-2 col-form-label">نام سازمان : </label>
             <div class="col-5">
                 <input  class="form-control" @input="check" name="name" v-model="name" type="text" value="" id="example-text-input">
             </div>
         </div>

         <div class="form-group row">
             <label for="InputFile" class="col-2 col-form-label">لوگو (100px * 100px) : </label>
             <div class="col-5">
                 <input type="file" name="logo_path" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
             </div>
         </div>

         <div class="form-group row">
             <label for="InputFile" class="col-2 col-form-label">توضیحات : </label>
             <div class="col-5">
                 <textarea  class="form-control" name="comment" id="summernote" rows="3"></textarea>
             </div>
         </div>

         <div class="form-group row">
             <label for="InputFile" class="col-2 col-form-label">عکس پشت زمینه (1150px * 380px) : </label>

             <div class="col-5">
                 <input type="file" class="form-control-file" name="background_path" id="exampleInputFile" aria-describedby="fileHelp">
             </div>
         </div>

         <a  href="{{route('OrganizeContact')}}"><button :disabled="next"  type="submit" class="btn btn-primary">ادامه</button></a>

     </form>

</div>

 <script>


     vm = new Vue({

         el:'#app',
         data:{

             name:'',
             url:'',
             startTime:'',
             endTime:'',
             comment:'',
             next:true,


         },
         methods:{

             check:function () {


//               document.getElementsByClassName('nicEdit-main')[0].addEventListener('input',this.check)
//                 this.comment = document.getElementsByClassName('nicEdit-main')[0].innerHTML
//                 console.log(this.comment.length)
                 if(this.name.length > 0 ){

                     this.next = false
                 }else{

                     this.next = true

                 }


             },

         }

     })


 </script>


</div>   

 <script type="text/javascript" src="{{URL::asset('js/bootstrap.js'}}"></script>



@endsection