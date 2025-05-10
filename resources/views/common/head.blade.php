<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" xmlns:fb="http://ogp.me/ns/fb#">

<head>
  <title>{{ $title ?? Helpers::meta((!isset($exception)) ? Route::current()->uri() : '', 'title') }} {{ $additional_title ?? '' }}</title>

  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="{{ $favicon }}">

  <meta name="description" content="{{ Helpers::meta((!isset($exception)) ? Route::current()->uri() : '', 'description') }}">
  <meta name="keywords" content="{{ Helpers::meta((!isset($exception)) ? Route::current()->uri() : '', 'keywords') }}">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
    <!-- ** Plugins Needed for the Project ** -->    
  <link rel="stylesheet" href="{{ asset('theme/plugins/bootstrap/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('theme/plugins/themify-icons/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('theme/plugins/slick/slick.css') }}">
  <link rel="stylesheet" href="{{ asset('theme/plugins/slick/slick-theme.css') }}">
  <link rel="stylesheet" href="{{ asset('theme/plugins/aos/aos.css') }}">
  

    <!-- Main Stylesheet -->

  <link rel="stylesheet" href="{{ asset('theme/css/style.css') }}">

    <!--Favicon-->
    <link rel="shortcut icon" href="theme/images/favicon.png" type="image/x-icon">
    <link rel="icon" href="theme/images/favicon.png" type="image/x-icon">
    
    

</head>
<body id="top" data-spy="scroll" data-target="#navbar-spy" class="position-relative">