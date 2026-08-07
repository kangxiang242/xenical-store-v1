@extends('mobile::layout')

@section('style')
    @parent
    <link rel="stylesheet" href="{{ asset('static/mobile/less/product.css') }}?ver={{ config('app.asset_version') }}">
@stop

@section('script')
    @parent
    <script src="{{ asset('static/a/js/jquery.easing.1.3.js') }}?ver={{ config('app.asset_version') }}"></script>

@stop
@section('breadcrumb')
    <li class="active">羅氏鮮線上訂購</li>
@endsection

@section('embed-banner')
    <div class="embed-banner">
        <p class="en-title">Buy Online</p>
        <h1 class="embed-title">{!! app('cache.config')->get('page_product_title') !!}</h1>
        <div class="embed-desc">{!! str_replace(PHP_EOL,'<br>',app('cache.config')->get('page_product_desc')) !!}</div>
    </div>
@stop

@section('content')
    <div class="product-container">
        @foreach($products as $key=>$goods)
            <div class="goods wow animate__animated animate__fadeInUp">
                <div class="img-wrap"><img src="{{ asset('uploads/'.$goods->img) }}?ver={{ config('app.asset_version') }}" alt="{{ $goods->name }}"></div>
                <div class="info">
                    <div class="title">
                        <p><span style="letter-spacing: -1px;margin-right: 4px;">{{ $goods->name_en }}</span>{{ $goods->name }}</p>
                        <p>{{ $goods->quantity }}{{ $goods->quantity == 1?"盒標準裝":"盒優惠裝" }}</p>
                    </div>
                    @if($goods->label)
                        <p class="tags">
                            @foreach(explode('|',$goods->label) as $label)
                                <span>{{ $label }}</span>
                            @endforeach
                        </p>
                    @endif
                    <!-- @if($goods->attr)
                        <div class="attr">
                            @foreach($goods->attr as $attr)
                                <p class="list">
                                    <span class="attr-name">{{ $attr->name }}：</span>
                                    <span class="attr-value">{{ $attr->value }}</span>
                                </p>
                            @endforeach
                        </div>
                    @endif -->
                    <p class="price-sec">
                        @php
                            $diff = $goods->market_price - $goods->price;
                            $percent = $goods->market_price > 0 ? round(($diff / $goods->market_price) * 100) : 0;
                        @endphp

                        @if($diff > 0)
                            <span class="market-price"><span class="twd">NT$</span>{{ number_format($goods->market_price) }}</span>
                        @endif
                        <span class="price"><span class="twd">NT$</span>{{ number_format(round($goods->price)) }}</span>
                        <span class="discount">
                            @if($diff > 0)
                                優惠{{ $percent }}%
                            @else
                                官方售價
                            @endif
                        </span>
                    </p>

                    <div class="btns">
                        <a class="shop-btn go-btn" href="{{ url('checkout/'.$goods->id) }}"  data-observer="立即訂購-{{ $goods->name }}">立即訂購<i class="iconfont">&#xe684;</i></a>
                        <a class="go-info btn-ef2" href="{{ url('product/'.$goods->id) }}" data-observer="詳情-{{ $goods->name }}">詳情</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
