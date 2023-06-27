<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link href="{{asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{asset('css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{asset('css/price-range.css') }}"rel="stylesheet">
    <link href="{{asset('css/animate.css') }}" rel="stylesheet">
	<link href="{{asset('css/main.css') }}" rel="stylesheet">
	<link href="{{asset('css/responsive.css') }}" rel="stylesheet">
</head>
<body>
	@include('master.header')

	@yield('content')

	@include('master.footer')
</body>
</html>