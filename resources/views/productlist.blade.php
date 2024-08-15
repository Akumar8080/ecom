@extends('layouts.app')
@section('content')
<div class="container">
   <button type="button" id="logout" class="btn btn-info btn-sm right">
   <span class="glyphicon glyphicon-log-out"></span> Log out
   </button>
   <div class="form-group pull-right">
      <input type="text" id="product_search" class="search form-control" placeholder="What you looking for?">
   </div>
   <span class="counter pull-right"></span>
   <table class="table table-hover table-bordered results">
      <thead>
         <tr>
            <th>#</th>
            <th class="col-md-5 col-xs-5">Product Name</th>
            <th class="col-md-4 col-xs-4">Price</th>
            <th class="col-md-3 col-xs-3">Stock</th>
            <th class="col-md-3 col-xs-3">Action</th>
         </tr>
         <tr class="warning no-result">
            <td colspan="4"><i class="fa fa-warning"></i> No result</td>
         </tr>
      </thead>
      <tbody>
      </tbody>
   </table>
   <div class="d-flex justify-content-center" id="pagination"></div>
</div>
@endsection
@section('script')
<script>
   $(document).ready(function() {
       var token = $.session.get("token");
       $.ajax({
           url: "{{route('api.products')}}",
           type: 'get',
           "headers": {
               "Authorization": "Bearer "+token
           },
           success: function(response,status) {    
               var data = response.data.data;
               console.log(response.data);
               var res='';
               $.each (data, function (key, value) {
                   res +=
                   '<tr>'+
                       
                       '<th class="nr" scope="row">'+value.id+'</th>'+
                       '<td>'+value.name+'</td>'+
                       '<td>'+value.price+'</td>'+
                       '<td>'+value.stock+'</td>'+
                       '<td><button type="button" data-id="'+value.id+'" class="btn btn-primary viewbtn">View</button></td>'+
                   '</tr>';
   
               });
               $('tbody').html(res);
           },
           error: function (response, status, error) {
                   setTimeout(()=>{
                       toastr.error(error);
                   },1000)
           }            
       });
       $("#logout").click(function(){
           
           $.ajax({
                   url: "{{route('api.logout')}}",
                   type: 'get',
                   "headers": {
                       "Authorization": "Bearer "+token
                   },
                   success: function(response,status) {
   
                       sessionStorage.removeItem("token");
                       toastr.success(response.message);
                       setTimeout(()=>{
                           window.location ="{{ route('/') }}"
                       },1000)
                       
                   },
                   error: function (response, status, error) {
                           setTimeout(()=>{
                               toastr.error(error);
                           },1000)
                   }            
               });
       });
       var searchRequest = null;
       $(function () {
           var minlength = 3;
           $("#product_search").keyup(function () {
               var that = this,
               value = $(this).val();
               if (value.length >= minlength ) {
   
                   if (searchRequest != null) 
                       searchRequest.abort();
                   searchRequest = $.ajax({
                       url: "{{route('api.product-search')}}/"+value,
                       type: 'get',
                       "headers": {
                           "Authorization": "Bearer "+token
                       },
                       success: function(response,status) {    
                           var data = response.data.data;
                           console.log(response.data);
                           var res='';
                           $.each (data, function (key, value) {
                               res +=
                               '<tr>'+
                                   
                                   '<th class="nr" scope="row">'+value.id+'</th>'+
                                   '<td>'+value.name+'</td>'+
                                   '<td>'+value.price+'</td>'+
                                   '<td>'+value.stock+'</td>'+
                                   '<td><button type="button" data-id="'+value.id+'" class="btn btn-primary viewbtn">View</button></td>'+
                               '</tr>';
                           });
                           $('tbody').html(res);
                       },
                       error: function (response, status, error) {
                           setTimeout(()=>{
                               toastr.error(error);
                           },1000)
                       }
                   });
               }
           });
       });
   });
   $("body").on("click",".viewbtn",function(){
       var id = $(this).attr("data-id");
       window.location ="{{ route('product') }}/"+id;
   });
</script>
@endsection