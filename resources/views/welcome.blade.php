<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{url('/')}}/assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="{{url('/')}}/assets/css/style.css" />

        <!-- Styles -->
        
    </head>
    <body class="antialiased">
        <div class="container" style="height: 100vh ; background-image: 
        url('{{url('/')}}/assets/img/wall-post-pana.svg') ;background-repeat: no-repeat;
        background-attachment: fixed; background-position: center;">
           
           <a href="/book" class="btn btn-info"> Book Now by mvc</a>
           <a href="/ajaxform" class="btn btn-success"> Book Now by ajax</a> 
        </div>
        
        

    </body>
</html>
