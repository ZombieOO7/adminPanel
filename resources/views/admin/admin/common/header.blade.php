@php
	$setting = settings();
@endphp
<!DOCTYPE html>
<html lang="en">
	<head>
        <base href="{{URL::to('/')}}">
		<title>@yield('title') | {{@$setting->title ?? env('APP_NAME')}}</title>
		<meta charset="utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta property="og:locale" content="en_US" />
		<meta property="og:type" content="article" />
		<meta property="og:title" content="{{@$setting->title ?? env('APP_NAME')}}" />
		<meta property="og:url" content="{{env('APP_URL')}}" />
		<meta property="og:site_name" content="{{@$setting->title ?? env('APP_NAME')}}" />
		<link rel="canonical" href="" />
		<link rel="shortcut icon" href="{{asset('backend/media/logos/favicon.ico')}}" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<link href="{{asset('backend/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{asset('backend/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
	</head>
	<body id="kt_body" class="bg-body">
		<div class="d-flex flex-column flex-root">
			<div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed" style="background-image: url({{asset('backend/media/illustrations/sketchy-1/14.png')}}">
