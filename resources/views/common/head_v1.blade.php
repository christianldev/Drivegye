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
  

  <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700" rel="stylesheet">  -->
 
  <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/main.css')}}">
  <link rel="stylesheet" href="{{ asset('css/common.css')}}">
  <link rel="stylesheet" href="{{ asset('css/common1.css')}}">
  <link rel="stylesheet" href="{{ asset('css/styles.css')}}">
  <link rel="stylesheet" href="{{ asset('css/home.css')}}">
  
  <link rel="stylesheet" href="{{ asset('css/popup.css')}}">

  <link rel="stylesheet" href="{{ asset('css/jquery.bxslider.css') }}">
  <link rel="stylesheet" href="{{ asset('css/jquery.sliderTabs.min.css') }}">
  @if (Route::current()->uri() != 'driver_payment')
  <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}"> 
  @endif

  <link rel="stylesheet" type="text/css" href=" https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body ng-app="App" class="{{ (!isset($exception)) ? (Route::current()->uri() == '/' ? 'homepage' : '') : '' }} commonpage">