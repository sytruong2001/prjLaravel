<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <base href="{{ asset('') }}">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script language="javascript" src="http://code.jquery.com/jquery-2.0.0.min.js"></script>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>


    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    {{-- <style>
        #chatbox {
            position: relative;
            width: 100%;
        }

        .message-1 {
            text-align: right;
            font-size: 20px;
            width: 40%;
            background: rgb(44, 57, 238);
            color: white;
            border-radius: 30px 30px 30px 30px;
            padding-right: 70px;
            margin-bottom: 10px;
            margin-top: 10px;
            margin-left: 58%;
        }

        .message-1 .ct-msg-1 {
            width: 100%;
            height: 100%;
        }

        .message-2 {
            text-align: left;
            font-size: 20px;
            width: 40%;
            background: gray;
            color: white;
            border-radius: 30px 30px 30px 30px;
            padding-left: 70px;
            margin-bottom: 10px;
            margin-top: 10px;

        }

        .message-2 .ct-msg-2 {
            width: 100%;
            height: 100%;
        }

        .message-content {
            margin: 4px;
            border-radius: 15px 15px 15px 15px;
        }

        .load {
            width: 50px;
            height: 50px;
            border: 3px solid #bc0b0b;
            border-top: 3px solid #f25a4100;
            border-radius: 100%;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            margin: auto;

            animation: spin 2s infinite linear;
            display: none;

        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
                opacity: 0;
            }
        }

    </style> --}}
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}

                <form action="{{ url()->current() }}">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search..........." name="search"
                            @if (isset($search)) {{ $search }} @endif>
                        <span class="input-group-text">Search</span>

                    </div>
                </form>
            </div>
        </header>

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>

</html>
