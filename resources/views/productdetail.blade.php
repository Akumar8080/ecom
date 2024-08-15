@extends('layouts.app')
@section('content')
<div class="container">
    <div class="logout-btn mb-3">
        <button type="button" id="back" onClick="history.go(-1)" class="btn btn-info btn-sm right">
            <span class="glyphicon glyphicon-log-out"></span> Back
        </button>
    </div>
        <span class="counter pull-right"></span>
   <table class="table table-hover table-bordered results">
      <thead>
         <tr>
            <th>#</th>
            <th class="col-md-5 col-xs-5">Product Name</th>
            <th class="col-md-4 col-xs-4">Price</th>
            <th class="col-md-3 col-xs-3">Stock</th>
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
       var product_id = window.location.pathname.split("/")[2];
       $.ajax({
           url: "{{route('api.product-details')}}/"+product_id,
           type: 'get',
           "headers": {
               "Authorization": "Bearer "+token
           },
           success: function(response,status) {    
               var value = response.data;
               
               var res='';
                   res +=
                   '<tr>'+
                       '<th class="nr" scope="row">'+value.id+'</th>'+
                       '<td>'+value.name+'</td>'+
                       '<td>'+value.price+'</td>'+
                       '<td>'+value.stock+'</td>'+
                   '</tr>';
               $('tbody').html(res);
           },
           error: function (response, status, error) {
                   setTimeout(()=>{
                       toastr.error(error);
                   },1000)
           }            
       });
   });
</script>
@endsection