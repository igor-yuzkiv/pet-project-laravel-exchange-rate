<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    {{-- Base Meta Tags --}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Title --}}
    <title>
        @yield('title_prefix', config('frontend.title_prefix', ''))
        @if(isset($title))
            {!! $title !!}
        @else
            {!! config("frontend.title") !!}
        @endif
        @yield('title_postfix', config('frontend.title_postfix', ''))
    </title>

    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    {{-- Custom stylesheets (pre) --}}
    @yield('css_pre')
    @stack('css_pre')

<!-- site icons -->
    <link rel="icon" href="{{asset("frontend/images/fevicon/fevicon.png")}}" type="image/gif"/>
    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{asset("frontend/css/bootstrap.min.css")}}"/>
    <!-- Site css -->
    <link rel="stylesheet" href="{{asset("frontend/css/style.css")}}"/>
    <!-- responsive css -->
    <link rel="stylesheet" href="{{asset("frontend/css/responsive.css")}}"/>
    <!-- colors css -->
    <link rel="stylesheet" href="{{asset("frontend/css/colors2.css")}}"/>
    <!-- custom css -->
    <link rel="stylesheet" href="{{asset("frontend/css/custom.css")}}"/>
    <!-- wow Animation css -->
    <link rel="stylesheet" href="{{asset("frontend/css/animate.css")}}"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    {{-- Configured Stylesheets --}}
    @include('Frontend.template.partials.plugins', ['type' => 'css'])

    {{-- Custom stylesheets (post) --}}
    @yield('css_post')
    @stack('css_post')

    @yield("css")

</head>


<body id="default_theme" class="">


@if (config("frontend.bg_load", true))
    <div class="bg_load"><img class="loader_animation" src="{{asset("frontend/images/loaders/loader_2.png")}}" alt="#"/>
    </div>
@endif

@yield("pre_header")
<header id="default_header" class="header_style_1">

    <div class="header_top">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="full">
                        <div class="topbar-left">
                            <ul class="list-inline">
                                {{--<li> <span class="topbar-label"><i class="fa  fa-home"></i></span> <span class="topbar-hightlight">540 Lorem Ipsum New York, AB 90218</span> </li>--}}
                                <li><span class="topbar-label"><i class="fa fa-envelope-o"></i></span> <span
                                        class="topbar-hightlight"><a
                                            href="mailto:{{config("frontend.email", "webmaster@email.com")}}">{{config("frontend.email", "webmaster@email.com")}}</a></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>


                @if(config("frontend.social_links") !== null and !empty(config("frontend.social_links")))
                    <div class="col-md-4 right_section_header_top">
                        <div class="float-left">
                            <div class="social_icon">
                                <ul class="list-inline">
                                    @foreach(config("frontend.social_links") as $def_social_item)
                                        <li><a class="{{$def_social_item["icon"]}}" href="{{$def_social_item["url"]}}"
                                               title="{{$def_social_item["title"] ?? ""}}" target="_blank"></a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="float-right">
                            @yield("right_section_header_top")
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>

    <div class="header_bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                    <!-- logo start -->
                    <div class="logo"><a href="{{route( config("frontend.home_route", "home") )}}"><img
                                src="{{asset("frontend/images/logos/logo.png")}}" alt="logo"/></a></div>
                    <!-- logo end -->
                </div>
                <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                    <!-- menu start -->
                    <div class="menu_side">
                        <div id="navbar_menu">
                            @include("Frontend.template.partials.navbar.menu")
                        </div>
                        {{--<div class="search_icon">
                            <ul>
                                <li><a href="#" data-toggle="modal" data-target="#search_bar"><i class="fa fa-search" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>--}}
                    </div>
                    <!-- menu end -->
                </div>
            </div>
        </div>
    </div>

</header>

<?php
    $inner_banner = (isset($inner_banner)) ? $inner_banner : true;
?>
@if(config("frontend.inner_banner") AND $inner_banner)
        <div id="inner_banner" class="section inner_banner_section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="full">
                            <div class="title-holder">
                                <div class="title-holder-cell text-left">
                                    <h1 class="page-title">
                                        @if(isset($title))
                                            {!! $title !!}
                                        @else
                                            {!! config("frontend.title") !!}
                                        @endif
                                    </h1>
                                    @if(config("frontend.inner_banner.breadcrumb"))
                                        <ol class="breadcrumb">
                                            <li><a href="index.html">Home</a></li>
                                            <li class="active">Services</li>
                                        </ol>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endif



@stack("sections")



@yield("post_header")


<!-- footer -->
{{--<footer class="footer_style_2">
</footer>--}}
<!-- end footer -->

@yield("js_pre")

<!-- js section -->
<script src="{{asset("frontend/js/jquery.min.js")}}"></script>
<script src="{{asset("frontend/js/bootstrap.min.js")}}"></script>

<!-- menu js -->
<script src="{{asset("frontend/js/menumaker.js")}}"></script>

<!-- wow animation -->
<script src="{{asset("frontend/js/wow.js")}}"></script>

<!-- custom js -->
<script src="{{asset("frontend/js/custom.js")}}"></script>

{{-- Configured Stylesheets --}}
@include('Frontend.template.partials.plugins', ['type' => 'js'])

@yield("js_post")
@stack("js_post")

@yield("js")


</body>
