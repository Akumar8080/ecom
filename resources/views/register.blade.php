@extends('layouts.app')
@section('content')
<div class="container">
   <form method="POST" id="myform" action="{{route('api.sign-up')}}">
      <h2 class="sr-only">Login Form</h2>
      <div class="illustration"><i class="icon ion-ios-navigate"></i></div>
      <div class="form-group"><input class="form-control" type="text" name="name" placeholder="name"></div>
      <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email"></div>
      <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password"></div>
      <div class="form-group"><button class="btn btn-primary btn-block" type="submit">SignUp</button></div>
      <a href="{{route('/')}}" class="signup btn signup-btn">Login</a>
   </form>
</div>
@endsection
@section('script')
<script>
   $(document).ready(function(){ 
       $("#myform").validate({
           rules:{
               name:{required : true},
               email:{email: true,required: true},
               password:{required : true,minlength:6},},
               messages: {
                   name:"Please enter name.",
                   email:{email:"Enter Valid Email!",
                   required:"Enter Email!"},
                   password:"Please enter password.",
               },
           submitHandler: function(form,event){
               var button = event.target.querySelector('button');
               $.ajax({
                   url: form.action,
                   type: form.method,
                   data: $(form).serialize(),
                   success: function(response) {
                      toastr.success(response.message);
                      button.disable = true;
                      setTimeout(()=>{
                       window.location ="{{ route('/') }}"
                       },1000)
                   },
                   error: function(response,error='') {
                       console.log(error);
                       var message = response.responseJSON.message;
                       if(typeof message === undefined){
                           toastr.error(error);
                       } else {
                           toastr.error(message);
                       }
                       button.disable = false;
                   }            
               });		
           }
       });
   });
</script>
@endsection