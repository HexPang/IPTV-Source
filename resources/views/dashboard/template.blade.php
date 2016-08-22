<html lang="en" ng-app="App">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    <title>IPTV源平台</title>

    {{--<link href="https://fonts.useso.com/css?family=Roboto:300,400,500,700,400italic" rel="stylesheet">--}}

    <link href="/css/toolkit-inverse.css" rel="stylesheet">

    <link href="/css/application.css" rel="stylesheet">

    <style>
        /* note: this is a hack for ios iframe for bootstrap themes shopify page */
        /* this chunk of css is not part of the toolkit :) */
        body {
            width: 1px;
            min-width: 100%;
            *width: 100%;
        }
        .center{
            margin:0 auto 0 auto;
        }
        .w-300{
            width:300px;
        }
        .fr{
            float:right;
        }
        .f14{
            font-size:14px;
        }
        .alert-info {
            font-size: 13px;
            color: rgb(190, 58, 49);
        }
    </style>
    @yield('header')
</head>


<body>
<div class="bw">
    <div class="fu">
        @yield('content')
    </div>
</div>


<script src="/js/jquery.min.js"></script>
<script src="https://code.angularjs.org/1.5.8/angular.min.js"></script>
<script src="/js/angular-file-upload.min.js"></script>
<script src="/js/ACommon.js"></script>
<script src="/js/App.js"></script>
</body></html>