<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> @yield('title') </title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/mystyles.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/bootstrap-social.css') }}" rel="stylesheet" >
    <link href="{{ asset('/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{ asset('/css/font-awesome.min.css')}}" rel="stylesheet">
    <style>
        .fieldSizeFont {
            font-size: 17px;
            font-family: Arial;
        }
    </style>
</head>


<body style="background-color: aliceblue">

    <div id="app">
        @include('inc.navbar')

        <main class="container">
            @yield('content')
        </main>
    </div>



    <!-- Footer with contact information -->
    <footer class="row-footer" >
        <div class="container">
            <div class="row">
                <div class="col-5 offset-1 col-md-2 offset-sm-1">
                    <h5>Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="{% url 'index' %}">Home</a></li>
                        <li><a href="{% url 'about' %}">About</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md-5">
                    <h5>Our Address</h5>
                    <address>
                        6369 SW 173rd Street<br>
                        33011<br>
                        Miami,Florida<br>
                        <i class="fa fa-phone"></i> : +305 1234 5678<br>
                        <i class="fa fa-envelope"></i> : <a href="#">BardsBigBadBS@gmail.com</a>
                    </address>
                </div>
                <div class="col-12 col-md-4">
                    <div class="nav navbar-nav" style="padding: 40px 10px;">
                        <a class="btn btn-social-icon btn-google-plus" href="http://google.com/+">
                            <i class="fa fa-google-plus"></i></a>
                        <a class="btn btn-social-icon btn-facebook" href="http://www.facebook.com/profile.php?id=">
                            <i class="fa fa-facebook"></i></a>
                        <a class="btn btn-social-icon btn-linkedin" href="http://www.linkedin.com/in/">
                            <i class="fa fa-linkedin"></i></a>
                        <a class="btn btn-social-icon btn-twitter" href="http://twitter.com/">
                            <i class="fa fa-twitter"></i></a>
                        <a class="btn btn-social-icon btn-youtube" href="http://youtube.com/">
                            <i class="fa fa-youtube"></i></a>
                        <a class="btn btn-social-icon" href="mailto:"><i class="fa fa-envelope"></i></a>
                    </div>
                </div>
                <div class="col-12">
                    <p style="padding:10px;"></p>
                    <p align=center>© Copyright 2017 Bard's Big Bad Bookstore</p>
                </div>
            </div>
        </div>
    </footer>


    <!-- jQuery(neccessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>
</html>
