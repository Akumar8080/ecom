<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Untitled</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    
</head>

<body>
<div class="login-clean">
    @yield('content')
    <input type="hidden" value="{{Route::current()->getName()}}" id="current_rout">
</div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery.session@1.0.0/jquery.session.min.js"></script>
@yield('script')
<script>
    $( document ).ready(function() {
        var token = $.session.get("token");
        var route = $('#current_rout').val()
        console.log(route);
        if(typeof token === 'undefined')
        {
            if(route != '/' && route != 'register'){
                window.location ="{{ route('/') }}"
            }
        }
        else{
           if(route != 'product-list' && route != 'product'){
               window.location ="{{ route('product-list') }}"
           }
        }  
    });
</script>
</html>