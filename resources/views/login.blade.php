@extends('layouts.app')
@section('content')
<div class="container">
   <form method="POST" id="myform" action="{{route('api.login')}}">
      <h2 class="sr-only">Login Form</h2>
      <div class="illustration"><i class="icon ion-ios-navigate"></i></div>
      <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email"></div>
      <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password"></div>
      <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Log In</button></div>
      <a href="{{route('register')}}" class="signup">SignUp</a>
   </form>
</div>
@endsection
@section('script')
<script>
   $(document).ready(function(){ 
       $("#myform").validate({
           rules:{
               email:{email: true,required: true},
               password:{required : true,minlength:6},},
               messages: {
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
                      sessionStorage.setItem('token',response.data.token);
                      toastr.success(response.message);
                      button.disable = true;
                      setTimeout(()=>{
                       window.location ="{{ route('product-list') }}"
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