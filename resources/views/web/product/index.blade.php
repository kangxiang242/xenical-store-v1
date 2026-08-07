@extends('web::layout')

@section('style')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('static/less/product.css') }}?ver={{ config('app.asset_version') }}"/>
@stop

@section('script')
    @parent
    <script src="{{ asset('static/a/js/jquery.easing.1.3.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/a/js/jquery.parallax-scroll.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script>
        $(document).ready(function() {
            $('.goods').hover(function() {
                var $discount = $(this).find('.discount');
                if ($discount.length === 0) {
                    console.error('没有找到 .discount 元素');
                    return;
                }
                var discount = parseInt($discount.data('discount'));
                if (isNaN(discount) || discount <= 0) {
                    return;
                }
                $discount.data('orig-text', $discount.text());
                $discount.text('0%');
                $({ counter: 0 }).animate({ counter: discount }, {
                    duration: 3000,
                    easing: 'swing',
                    step: function(now) {
                        $discount.text('為妳優惠 ' + Math.ceil(now) + '%');
                    },
                    complete: function() {
                        $discount.text('為妳優惠 ' + discount + '%');
                    }
                });
            }, function() {
                var $discount = $(this).find('.discount');
                var discount = parseInt($discount.data('discount'));
                if ($discount.length > 0 && discount > 0) {
                    $discount.text($discount.data('orig-text'));
                }
            });
        });
    </script>
@stop

@section('content')

@section('embed-banner')
    <div class="embed-banner wrapper column">
        <p class="en-title">Buy Online</p>
        <h1 class="embed-title">{!! app('cache.config')->get('page_product_title') !!}</h1>
        <div class="embed-desc">{!! str_replace(PHP_EOL,'<br>',app('cache.config')->get('page_product_desc')) !!}</div>
    </div>
@stop

    <div class="product-container wrapper product-main">
        @foreach($products as $key=>$goods)
            <div class="goods wow animate__animated animate__fadeInUp {{ $key%2==0?"even":"odd" }}">
                <img class="img-wrap" data-parallax='{"y": {{ $key%2==0?"-":"" }}100,"duration": 100}' src="{{ asset('uploads/'.$goods->img) }}?ver={{ config('app.asset_version') }}" alt="{{ $goods->name }}">
                <div class="info" data-parallax='{"y": {{ $key%2==0?"":"-" }}100}'>

                    <p class="label"><span style="letter-spacing: -1px;margin-right: 6px;">{{ $goods->name_en }}</span>{{ $goods->name }}</p>
                    <p class="goods-title">{{ $goods->quantity }}{{ $goods->quantity == 1?"盒標準裝":"盒優惠裝" }}</p>


                    @if($goods->label)
                        <p class="tags">
                            @foreach(explode('|',$goods->label) as $label)
                                <span>{{ $label }}</span>
                            @endforeach
                        </p>
                    @endif

                    @if($goods->attr)
                        <div class="attr">
                            @foreach($goods->attr as $attr)
                                <span class="attr-name">{{ $attr->name }}：</span>
                                <span class="attr-value">{{ $attr->value }}</span>
                            @endforeach
                        </div>
                    @endif
                    <p class="price-sec">
                        <span class="price"><span class="twd">NT$</span>{{ number_format(round($goods->price)) }}</span>
                        @php
                            $diff = $goods->market_price - $goods->price;
                            $percent = $goods->market_price > 0 ? round(($diff / $goods->market_price) * 100) : 0;
                        @endphp

                        @if($diff > 0)
                            <span class="market-price"><span class="twd">NT$</span>{{ number_format($goods->market_price) }}</span>
                        @endif
                        <span class="discount" data-discount="{{ $percent }}">
                            @if($diff > 0)
                                為妳優惠 {{ $percent }}%
                            @else
                                官方售價
                            @endif
                        </span>
                    </p>

                    <div class="btn">
                        <a class="checkout go-btn" href="{{ url('checkout/'.$goods->id) }}" data-observer="立即購買-{{ $goods->name }}">立即訂購<i class="iconfont">&#xe684;</i></a>
                        <a class="goinfo" href="{{ url('product/'.$goods->id) }}" data-observer="詳情-{{ $goods->name }}">詳情</a>
                    </div>
                   
                </div>
            </div>
        @endforeach
    </div>

@endsection

@section('breadcrumb')
    <li class="active">羅氏鮮減肥藥線上訂購</li>
@stop