<!DOCTYPE html>
<html lang="zh-TW" style="font-size: 62.5%">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="content-language" content="zh-tw">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, viewport-fit=cover">
    <meta name="format-detection" content="telephone=no">
    @if(app('cache.config')->get('google_verify_type') == 1)
        {!! app('cache.config')->get('google_verify_code') !!}
    @endif
    @if(isset($layout['seo']))
        <title>{{ isset($layout['seo'])?$layout['seo']->title:"" }}</title>
    @else
        @hasSection('title')
            <title>@yield('title')</title>
        @else
            <title>{{ isset($layout['seo'])?$layout['seo']->title:"" }}</title>
        @endif
    @endif

    @hasSection('keywords')
        <meta name="keywords" content="@yield('keywords')"/>
    @else
        <meta name="keywords" content="{{ isset($layout['seo'])?$layout['seo']->key_word:"" }}"/>
    @endif

    @hasSection('description')
        <meta name="description" content="@yield('description')"/>
    @else
        <meta name="description" content="{{ isset($layout['seo'])?$layout['seo']->description:"" }}"/>
    @endif


    <link rel="canonical" href="{{ config('app.url') }}/{{ trim(request()->path(),'/') }}">

    <link rel="shortcut icon" href="{{ asset_upload(app('cache.config')->get('favicon'),'/favicon.ico') }}">
    @section('style')
        <link rel="stylesheet" type="text/css" href="{{ asset('static/css/style.css') }}?ver={{ config('app.asset_version') }}"/>
        @if(!is_googlebot())
        <link rel="stylesheet" href="{{ asset('static/font/iconfont.css') }}?ver={{ config('app.asset_version') }}">
        @endif
        <link rel="stylesheet" href="{{ asset('static/mobile/less/global.css') }}?ver={{ config('app.asset_version') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('static/wow/animate.min.css') }}?ver={{ config('app.asset_version') }}"/>
    @show

    <script src="{{ asset('static/js/jquery.min.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/js/observer.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/wow/wow.min.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/jquery_lazyload/jquery.lazyload.min.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script>
        var clientWidth = document.documentElement.clientWidth;
        ;(function (doc, win, undefined) {
            var docEl = doc.documentElement,
                resizeEvt = 'orientationchange' in win? 'orientationchange' : 'resize',
                recalc = function () {
                    clientWidth = docEl.clientWidth;
                    if(docEl.clientWidth > 768){
                        clientWidth = 768

                    }
                    docEl.style.fontSize = clientWidth / 37.5 + 'px';
                };
            if (doc.addEventListener === undefined) return;
            win.addEventListener(resizeEvt, recalc, false);
            doc.addEventListener('DOMContentLoaded', recalc, false)
        })(document, window);
        if(clientWidth > 768){
            clientWidth = 768
        }
        document.documentElement.style.fontSize = clientWidth / 37.5 + 'px';
    </script>
    <script>
        new WOW({
            offset:50,
        }).init();
    </script>
    <script>
        var is_ajax_get_cart = 0;
        var flash_data = '{!! session()->get('flash') !!}';
        if(flash_data){
            flash_data = JSON.parse('{!! session()->get('flash') !!}');
        }else{
            flash_data = false;
        }

        var province = [];

        var free_shipping_where = parseInt("{{ \App\Services\ConfigService::get('freight_where',0) }}");
        var free_shipping_freight = parseInt("{{ \App\Services\ConfigService::get('freight',0) }}");

    </script>
</head>
<body>
    @section('header')
        <header class="main-head">
            <a class="logo-wrap" href="{{ url('/') }}">
                <img src="{{ asset('static/img/m.logo2.png') }}?ver={{ config('app.asset_version') }}" alt="logo">
            </a>
            <a class="online-buy" href="{{ url('product') }}"><i class="iconfont">&#xe811;</i>線上訂購</a>
            <div class="menu show-menu"><i class="iconfont">&#xe62c;</i></div>
        </header>
    @show

    @section('menu')
        <div class="menu-section main-menu">
            <div class="close-menu"><i class="iconfont">&#xeca0;</i></div>
            <div class="menu">
                <p class="en-title">Home</p>
                <p class="nav-title nav-home"><a href="{{ url('/') }}">首頁<i class="iconfont">&#xe775;</i></a></p>
            </div>
            <div class="menu">
                <p class="en-title">Product</p>
                <p class="nav-title visually-hidden">減肥產品</p>
                <div class="nav">
                    <a href="{{ url('about') }}">羅氏鮮介紹<i class="iconfont">&#xe775;</i></a>
                    <a href="{{ url('product') }}">羅氏鮮線上訂購<i class="iconfont">&#xe775;</i></a>
                </div>
            </div>
            <div class="menu">
                <p class="en-title">Slimming</p>
                <p class="nav-title visually-hidden">減肥專欄</p>
                <div class="nav">
                    <a href="{{ url('bmi') }}">BMI計算機<i class="iconfont">&#xe775;</i></a>
                    <a href="{{ url('faq') }}">減肥疑問解答<i class="iconfont">&#xe775;</i></a>
                    <a href="{{ url('news') }}">減肥知識分享<i class="iconfont">&#xe775;</i></a>
                </div>
            </div>
            <div class="menu">
                <p class="en-title">Service</p>
                <p class="nav-title visually-hidden">購物服務</p>
                <div class="nav">
                    <a href="{{ url('guide') }}">購前須知<i class="iconfont">&#xe775;</i></a>
                    <a href="{{ url('payment-delivery') }}">付款與配送<i class="iconfont">&#xe775;</i></a>
                    <a href="{{ url('after-sales') }}">售後服務<i class="iconfont">&#xe775;</i></a>
                    <a href="{{ url('check') }}">訂單追蹤<i class="iconfont">&#xe775;</i></a>
                    <a href="{{ url('message') }}">取得協助<i class="iconfont">&#xe775;</i></a>
                    <a href="{{ url('privacy') }}">隱私權政策<i class="iconfont">&#xe775;</i></a>
                </div>
            </div>
        </div>
    @show

    <div class="main-wrapper">
    @section('banner')
        @if(isset($layout['banners']) && $layout['banners'] && !$layout['banners']->isEmpty())
            <div class="banner-section">
                <div class="banner-main">
                    @foreach($layout['banners'] as $key=>$item)
                        @if($item->m_img)
                            <a href="{{ $item->href?url($item->href):"javascript:;" }}"><img src="{{ asset_upload($item->m_img) }}" alt="{{ $item->alt }}"></a>
                        @endif
                    @endforeach
                </div>
                @yield('embed-banner')
            </div>
        @endif
    @show
    @hasSection('breadcrumb')
        @if(!request()->is('/'))
            <nav>
                <ol class="breadcrumb">
                    <li ><a href="{{ url('/') }}">首頁</a></li>
                    @yield('breadcrumb')
                </ol>
            </nav>
        @endif
    @endif
    @yield('content')
    </div>

    @section('footer')
        <footer>
            <nav class="menu-section">
                <div class="menu">
                    <p class="en-title">Home</p>
                    <h2 class="nav-title nav-home"><a href="{{ url('/') }}">首頁<i class="iconfont">&#xe775;</i></a></h2>
                </div>
                <section class="menu">
                    <p class="en-title">Product</p>
                    <h2 class="nav-title visually-hidden">減肥產品</h2>
                    <ul class="nav">
                        <li><a href="{{ url('about') }}">羅氏鮮減肥藥介紹<i class="iconfont">&#xe775;</i></a></li>
                        <li><a href="{{ url('product') }}">羅氏鮮線上訂購<i class="iconfont">&#xe775;</i></a></li>
                    </ul>
                </section>
                <section class="menu">
                    <p class="en-title">Slimming</p>
                    <h2 class="nav-title visually-hidden">BMI減肥</h2>
                    <ul class="nav">
                        <li><a href="{{ url('bmi') }}">BMI計算機<i class="iconfont">&#xe775;</i></a></li>
                        <li><a href="{{ url('faq') }}">減肥疑問解答<i class="iconfont">&#xe775;</i></a></li>
                        <li><a href="{{ url('news') }}">BMI減肥知識專欄<i class="iconfont">&#xe775;</i></a></li>
                    </ul>
                </section>
                <section class="menu">
                    <p class="en-title">Service</p>
                    <h2 class="nav-title visually-hidden">購物服務</h2>
                    <ul class="nav">
                        <li><a href="{{ url('guide') }}">購前須知<i class="iconfont">&#xe775;</i></a></li>
                        <li><a href="{{ url('payment-delivery') }}">付款與配送<i class="iconfont">&#xe775;</i></a></li>
                        <li><a href="{{ url('after-sales') }}">售後服務<i class="iconfont">&#xe775;</i></a></li>
                        <li><a href="{{ url('check') }}">訂單追蹤<i class="iconfont">&#xe775;</i></a></li>
                        <li><a href="{{ url('message') }}">取得協助<i class="iconfont">&#xe775;</i></a></li>
                        <li><a href="{{ url('privacy') }}">隱私權政策<i class="iconfont">&#xe775;</i></a></li>
                    </ul>
                </section>
            </nav>
            <div class="description">
                <div class="partner">
                    <div class="icon"><img  style="width: 12.6rem" src="{{ asset('static/img/fdausa.png') }}" alt="fda-usa"></div>
                    <div class="icon"><img style="width: 15.2rem" src="{{ asset('static/img/ema.png') }}" alt="ema"></div>
                    <!-- <div class="icon"><img  style="width: 14.5rem" src="{{ asset('static/img/fdataiwan.png') }}" alt="台湾fda"></div> -->
                    <div class="icon"><img  style="width: 5rem" src="{{ asset('static/img/ROCHE.png') }}" alt="ROCHE"></div>
                    <div class="icon"><img  style="width: 12rem" src="{{ asset('static/img/CHEPLA.png') }}" alt="CHEPLA"></div>
                    <!-- <div class="icon"><img  style="width: 12.2rem" src="{{ asset('static/img/heimao.png') }}" alt="黑猫宅急便"></div>
                    <div class="icon"><img  style="width: 2.6rem" src="{{ asset('static/img/7-11.png') }}" alt="7-11"></div> -->
                    <div class="icon"><img style="width: 5.2rem" src="{{ asset('static/img/ssl.png') }}" alt="ssl"></div>
                </div>
                <p class="copyright">{!! app('cache.config')->get('copyright') !!}</p>
            </div>
        </footer>
    @show
</body>


@section('script')
    @if(!is_googlebot())
    <script src="{{ asset('static/js/sweetalert2.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/js/jquery.form.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/js/api.js') }}?ver={{ config('app.asset_version') }}"></script>
    @endif
    {!! app('cache.config')->get('google_ga') !!}
    <script>
        $('.show-menu').click(function () {
            $('.main-menu').addClass('-show');
            $('body').append('<div class="shade"></div>');
            $('body').addClass('overflow-hidden')
        });
        $('.close-menu').click(function(){
            $('.main-menu').removeClass('-show');
            $('.shade').remove();
            $('body').removeClass('overflow-hidden')
        });

        $('body').on('click','.shade',function(){
            $('.main-menu').removeClass('-show');
            $('.shade').remove();
            $('body').removeClass('overflow-hidden')
        });
    </script>

@show
<script type="text/javascript" charset="utf-8">
    $(function() {
        $("img.lazy").lazyload({effect: "fadeIn"});
    });
</script>
</html>
