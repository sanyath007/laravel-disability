<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ระบบทะเบียนผู้พิการออนไลน์ · Disability MS</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- Compiled and minified CSS -->
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css"> -->

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
	<link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="{{ asset('/node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

	<!-- Scripts -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
	<!-- Compiled and minified JavaScript -->
	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/js/materialize.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.2/angular.min.js"></script> -->
	<script type="text/javascript" src="{{ asset('/node_modules/angular/angular.min.js') }}"></script>
	<script src="{{ asset('/node_modules/angular-animate/angular-animate.min.js') }}"></script>
	<script src="{{ asset('/node_modules/moment/moment.js') }}"></script>
	<script src="{{ asset('/node_modules/select2/dist/js/select2.full.min.js') }}"></script>
	<script src="{{ asset('/node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
	<script src="{{ asset('/js/bootstrap-datepicker-custom.js') }}"></script>
	<script src="{{ asset('/node_modules/bootstrap-datepicker/dist/locales/bootstrap-datepicker.th.min.js') }}"></script>

	<script type="text/javascript" src="{{ asset('/js/env.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/js/main.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/js/controllers/mainController.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/js/controllers/disabilityController.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/js/controllers/reportController.js') }}"></script>
</head>
<body ng-app="app" ng-controller="mainController">
	<div class="app">
		@extends('layouts.menu')

		<section class="content-wrapper">
			@yield('content')
		</section>

		@extends('layouts.footer')
	</div>
</body>
</html>
