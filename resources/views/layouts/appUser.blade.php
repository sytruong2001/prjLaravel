<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="{{ asset('') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="apple-touch-icon" sizes="76x76" href="asset/img/apple-icon.png">
    <link rel="icon" type="image/png" href="asset/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    <!-- CSS Files -->
    <link href="asset/css/bootstrap.min.css" rel="stylesheet" />
    <link href="asset/css/material-kit.css?v=1.2.1" rel="stylesheet" />
</head>

<body class="blog-posts">

    <nav class="navbar navbar-primary navbar-transparent navbar-absolute">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand">Blog ST</a>
            </div>

            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="/">
                            <i class="material-icons">apps</i> Home
                        </a>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="material-icons">people</i>
                            @if (Auth::user())
                                {{ Auth::user()->name }}
                            @endif
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu dropdown-with-icons">
                            <li>
                                @if (Auth::user())
                                    <a href="/logout">
                                        Sign Out
                                    </a>
                                @else
                                    <a href="/login">
                                        Sign In
                                    </a>
                                    <a href="/register">
                                        Register
                                    </a>
                                @endif

                            </li>

                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="page-header header-filter header-small" data-parallax="true"
        style="background-image: url('asset/img/bg10.jpg');">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <h2 class="title">A Place for Entrepreneurs to Share and Discover New Stories</h1>
                </div>
            </div>
        </div>
    </div>
    {{-- content space --}}
    @yield('content')
    {{-- end content space --}}

    <footer class="footer">
        <div class="container">
            <a class="footer-brand" href="#">Blog ST</a>


            <ul class="pull-center">
                <li>
                    <a href="#">
                        Blog
                    </a>
                </li>
                <li>
                    <a href="#">
                        Presentation
                    </a>
                </li>
                <li>
                    <a href="#">
                        Discover
                    </a>
                </li>
            </ul>

            <ul class="social-buttons pull-right">
                <li>
                    <a href="https://twitter.com/CreativeTim" target="_blank"
                        class="btn btn-just-icon btn-twitter btn-simple">
                        <i class="fa fa-twitter"></i>
                    </a>
                </li>
                <li>
                    <a href="https://www.facebook.com/CreativeTim" target="_blank"
                        class="btn btn-just-icon btn-facebook btn-simple">
                        <i class="fa fa-facebook-square"></i>
                    </a>
                </li>
                <li>
                    <a href="https://www.instagram.com/CreativeTimOfficial" target="_blank"
                        class="btn btn-just-icon btn-google btn-simple">
                        <i class="fa fa-google"></i>
                    </a>
                </li>
            </ul>

        </div>
    </footer>

</body>
<!--   Core JS Files   -->
<script src="https://apis.google.com/js/platform.js" async defer></script>
<script src="asset/js/jquery.min.js" type="text/javascript"></script>
<script src="asset/js/bootstrap.min.js" type="text/javascript"></script>
<script src="asset/js/material.min.js"></script>

<!--    Plugin for Date Time Picker and Full Calendar Plugin   -->
<script src="asset/js/moment.min.js"></script>

<!--	Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/   -->
<script src="asset/js/nouislider.min.js" type="text/javascript"></script>

<!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker   -->
<script src="asset/js/bootstrap-datetimepicker.js" type="text/javascript"></script>

<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select   -->
<script src="asset/js/bootstrap-selectpicker.js" type="text/javascript"></script>

<!--	Plugin for Tags, full documentation here: http://xoxco.com/projects/code/tagsinput/   -->
<script src="asset/js/bootstrap-tagsinput.js"></script>

<!--	Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput   -->
<script src="asset/js/jasny-bootstrap.min.js"></script>

<!--    Plugin For Google Maps   -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

<!--    Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc    -->
<script src="asset/js/material-kit.js?v=1.2.1" type="text/javascript"></script>

</html>
