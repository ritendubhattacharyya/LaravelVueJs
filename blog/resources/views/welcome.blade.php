<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Blog</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            * {
                padding: 0px;
                margin: 0px;
                box-sizing: border-box;
                font-family: Arial;
            }
        </style>

    </head>
    <body>
        <div id="app">
            <header-component></header-component>
            <router-view></router-view>
        </div>
    </body>
    <script src="{{ asset('js/app.js') }}"></script>
</html>
