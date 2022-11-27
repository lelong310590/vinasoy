<!DOCTYPE html>
<!--[if IE 7]><html class="ie ie7" lang="{{ app()->getLocale() }}"><![endif]-->
<!--[if IE 8]><html class="ie ie8" lang="{{ app()->getLocale() }}"><![endif]-->
<!--[if IE 9]><html class="ie ie9" lang="{{ app()->getLocale() }}"><![endif]-->
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5, user-scalable=1" name="viewport"/>
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts-->
    <link href="https://fonts.googleapis.com/css?family={{ urlencode(theme_option('primary_font', 'Roboto')) }}" rel="stylesheet" type="text/css">
    <!-- CSS Library-->

    <style>
        :root {
            --color-1st: #6EB43F;
            --color-2nd: #FAA634;
            --primary-font: '{{ theme_option('primary_font', 'Roboto') }}', sans-serif;
        }
    </style>

{!! Theme::header() !!}

<!--HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!--WARNING: Respond.js doesn't work if you view the page via file://-->
    <!--[if lt IE 9]><script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]-->
</head>
<!--[if IE 7]><body class="ie7 lt-ie8 lt-ie9 lt-ie10"><![endif]-->
<!--[if IE 8]><body class="ie8 lt-ie9 lt-ie10"><![endif]-->
<!--[if IE 9]><body class="ie9 lt-ie10"><![endif]-->
<body @if (BaseHelper::siteLanguageDirection() == 'rtl') dir="rtl" @endif>
{!! apply_filters(THEME_FRONT_BODY, null) !!}

<div id="alert-container"></div>

<header class="header w-100" id="header">
    <div class="container">
        <div class="main-header w-100 d-flex justify-content-between align-items-center">
            <div class="logo-wrapper">
                <a href="{{route('public.index')}}">
                    <img src="{{Theme::asset()->url('images/logo.png')}}" alt="" class="img-responsive">
                </a>
            </div>
            <div class="right-navigation d-flex justify-content-end align-items-center">
                <div class="main-navigation">
                    {!!
                        Menu::renderMenuLocation('main-menu', [
                            'options' => ['class' => 'menu sub-menu--slideLeft'],
                            'view'    => 'main-menu',
                        ])
                    !!}

                    <div class="d-md-none d-block mobile-nav">
                        @if (auth('member')->check())
                            <div class="member-navigation">
                                <a href="javascript:;"><b>Xin chào,</b> {{auth('member')->user()->first_name}}</a>
                                <div class="member-navigation-dropdown">
                                    <ul>
                                        <li><a href="{{route('public.member.dashboard')}}">Thông tin tài khoản</a></li>
                                        <li><a href="">Chuyện bây giờ mới kể</a></li>
                                        <li><a href="">Tự hào 25 năm</a></li>
                                        <li><a href="javascript:;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng xuất</a></li>
                                    </ul>
                                    <form id="logout-form" action="{{ route('public.member.logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        @else
                            <a href="javascript:;" class="sign-in-button">Đăng nhập</a>
                        @endif
                    </div>
                    <a href="javascript:;" class="close-menu d-block d-md-none">Đóng</a>
                </div>

                <div class="action-navigation d-md-none d-block">
                    <a href="javascript:;" class="mobile-menu"><i class="fa-solid fa-bars"></i></a>
                </div>

                <div class="action-navigation d-none d-md-block {{auth('member')->check() ? 'logged-in' : ''}}">
                    @if (auth('member')->check())
                        <div class="member-navigation">
                            <a href="javascript:;"><b>Xin chào,</b> {{auth('member')->user()->first_name}}</a>
                            <div class="member-navigation-dropdown">
                                <ul>
                                    <li><a href="{{route('public.member.dashboard')}}">Thông tin tài khoản</a></li>
                                    <li><a href="">Chuyện bây giờ mới kể</a></li>
                                    <li><a href="">Tự hào 25 năm</a></li>
                                    <li><a href="javascript:;" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Đăng xuất</a></li>
                                </ul>
                                <form id="logout-form" action="{{ route('public.member.logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="javascript:;" class="sign-in-button">Đăng nhập</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>

