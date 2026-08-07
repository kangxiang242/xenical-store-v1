@extends('mobile::layout')

@section('style')
    @parent
    <link rel="stylesheet" href="{{ asset('static/mobile/less/index.css') }}?ver={{ config('app.asset_version') }}">
    <link rel="stylesheet" href="{{ asset('static/swiper4/swiper.min.css') }}?ver={{ config('app.asset_version') }}">
    <style>

        .swiper-slide {
            overflow: hidden;
        }

        .slide-inner {
            position: absolute;
            width: 100%;
            height: 100%;
            left: 0;
            top: 0;
            background-size: cover;
            background-position: center;
        }

        .splitting.-aos-active .char {
            -webkit-animation: splitting 1.2s cubic-bezier(.245,.495,0,.99) forwards;
            animation: splitting 1.2s cubic-bezier(.245,.495,0,.99) forwards;
            -webkit-animation-delay: calc(30ms*var(--char-index));
            animation-delay: calc(30ms*var(--char-index))
        }

        .splitting .word {
            display: inline-block;
            overflow: hidden;
            width: 100%;

        }

        .splitting .char {
            display: inline-block;
            -webkit-transform: translate3d(0,100%,0);
            transform: translate3d(0,100%,0);
            opacity: 0
        }

        @-webkit-keyframes splitting {
            to {
                opacity: 1;
                -webkit-transform: translate3d(0,0,0);
                transform: translate3d(0,0,0)
            }
        }

        @keyframes splitting {
            to {
                opacity: 1;
                -webkit-transform: translate3d(0,0,0);
                transform: translate3d(0,0,0)
            }
        }

        @-webkit-keyframes splitting-in {
            0% {
                opacity: 1;
                -webkit-transform: translate3d(0,100%,0);
                transform: translate3d(0,100%,0)
            }

            to {
                opacity: 1;
                -webkit-transform: translate3d(0,0,0);
                transform: translate3d(0,0,0)
            }
        }

        @keyframes splitting-in {
            0% {
                opacity: 1;
                -webkit-transform: translate3d(0,100%,0);
                transform: translate3d(0,100%,0)
            }

            to {
                opacity: 1;
                -webkit-transform: translate3d(0,0,0);
                transform: translate3d(0,0,0)
            }
        }

        @-webkit-keyframes splitting-out {
            0% {
                opacity: 1;
                -webkit-transform: translate3d(0,0,0);
                transform: translate3d(0,0,0)
            }

            to {
                opacity: 0;
                -webkit-transform: translate3d(0,-100%,0);
                transform: translate3d(0,-100%,0)
            }
        }

        @keyframes splitting-out {
            0% {
                opacity: 1;
                -webkit-transform: translate3d(0,0,0);
                transform: translate3d(0,0,0)
            }

            to {
                opacity: 0;
                -webkit-transform: translate3d(0,-100%,0);
                transform: translate3d(0,-100%,0)
            }
        }



        .text-animation-main {
            width: 100%;
            height: 100%;

            top: 0;
            left: 0;
            display: block;
            opacity: 0;
            -webkit-transition: opacity 3s;
            transition: opacity 3s
        }

        .text-animation-main .splitting.-aos-active .char {
            -webkit-transform: translate(0) scaleY(1) rotateX(0) rotate(0);
            transform: translate(0) scaleY(1) rotateX(0) rotate(0);
            -webkit-animation: none;
            animation: none;
            -webkit-animation-delay: calc(30ms*var(--char-index));
            animation-delay: calc(30ms*var(--char-index))
        }

        .text-animation-main.-show {
            opacity: 1;
            z-index: 2;
            -webkit-transition: opacity 2s;
            transition: opacity 2s;
            pointer-events: all
        }

        .text-animation-main.-show .splitting.-aos-active .char {
            opacity: 0;
            -webkit-animation: splitting-in 1.2s cubic-bezier(.99,0,.755,.505) forwards;
            animation: splitting-in 1.2s cubic-bezier(.99,0,.755,.505) forwards;
            -webkit-animation-delay: calc(30ms*var(--char-index));
            animation-delay: calc(30ms*var(--char-index))
        }

        .text-animation-main:not(.-show) {
            pointer-events: none;
            z-index: 1
        }

        .text-animation-main:not(.-show) .splitting.-aos-active .char {
            opacity: 1;
            -webkit-animation: splitting-out .8s cubic-bezier(.99,0,.755,.505) forwards;
            animation: splitting-out .8s cubic-bezier(.99,0,.755,.505) forwards;
            -webkit-animation-delay: calc(30ms*var(--char-index));
            animation-delay: calc(30ms*var(--char-index))
        }
        .text-effect .p2{
            text-indent: -0.2rem;
        }

    </style>
@stop

@section('script')
    @parent
    <script src="{{ asset('static/swiper4/swiper.min.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/js/jquery.textAnimation.min.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/js/jquery.waypoints.min.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/js/jquery.textAnimation.min.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/js/jquery.marquee.min.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/js/jquery.parallax.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/js/countUp.min.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script>
        textAnimation("#text-banner-0 #banner-p1");
        textAnimation("#text-banner-0 #banner-p2");
        textAnimation("#text-banner-0 #banner-p3");
        textAnimation("#text-banner-0 #banner-p4");

        textAnimation("#text-banner-1 #banner-p1");
        textAnimation("#text-banner-1 #banner-p2");
        textAnimation("#text-banner-1 #banner-p3");
        textAnimation("#text-banner-1 #banner-p4");

        textAnimation("#text-banner-2 #banner-p1");
        textAnimation("#text-banner-2 #banner-p2");
        textAnimation("#text-banner-2 #banner-p3");


        function textAnimation(elem){
            var text = $(elem).text();
            var textArr = text.split('');
            var html = '<span class="text-animation-main"><span class="splitting -aos-active"><span class="word">';
            for(j = 0; j < textArr.length; j++) {
                html += '<span class="char" style="--char-index:'+j+';">'+textArr[j]+'</span>';
            }
            html += '</span></span></span>';
            $(elem).html(html);
        }
    </script>
    <script>
        var interleaveOffset = 0.5;
        var bannerImageScale=1.1;
        var swiperOptions = {
            allowTouchMove: true,
            autoplay: {
                delay: 5500,
                disableOnInteraction: false
            },
            grabCursor: true,
            watchSlidesProgress: true,
            mousewheelControl: true,
            speed: 1000,
            loop: true,
            pagination: {
                el: '.progress',

                renderBullet: function (index, className) {
                    return '<div class="bar ' + className + '"></div>';
                },
            },
            on: {

                slideChange: function(){

                    var eq = this.activeIndex;

                    var elem = $(this.slides[eq]).find(".slide-inner").attr('data-bind-text');
                    $(this.slides[eq]).find(".slide-inner video")[0].play()
                    $('#'+elem).find('.text-animation-main').addClass('-show');
                    $('#'+elem).siblings().find('.text-animation-main').removeClass('-show');
                },
                progress: function() {
                    var swiper = this;
                    for (var i = 0; i < swiper.slides.length; i++) {
                        var slideProgress = swiper.slides[i].progress;
                        var innerOffset = swiper.width * interleaveOffset;
                        var innerTranslate = slideProgress * innerOffset;

                        var innerScaleOffset = Math.abs(1 - bannerImageScale);
                        var innerScale = Math.abs(slideProgress * innerScaleOffset) + 1;
                        //swiper.slides[i].querySelector(".slide-inner").style.transform = "translate3d(".concat(innerTranslate, "px, 0, 0) scale(").concat(innerScale, ")");
                        swiper.slides[i].querySelector(".slide-inner").style.transform =
                            "translate3d(" + innerTranslate + "px, 0, 0)";
                    }
                },
                touchStart: function() {
                    var swiper = this;
                    for (var i = 0; i < swiper.slides.length; i++) {
                        swiper.slides[i].style.transition = "";
                    }
                },
                setTransition: function(speed) {
                    var swiper = this;
                    for (var i = 0; i < swiper.slides.length; i++) {
                        swiper.slides[i].style.transition = speed + "ms";
                        swiper.slides[i].querySelector(".slide-inner").style.transition = speed + "ms";
                    }
                }
            }
        };

        var swiper = new Swiper("#swiper-video3", swiperOptions);



        var Swiper5 = new Swiper('#swiper5', {
            effect: 'coverflow',
            loop: true,
            slidesPerView: "auto",
            centeredSlides: true, //设置slide居中

            coverflow: {
                rotate: 50, //slide做3d旋转时Y轴的旋转角度。默认50。
                stretch: 0, //每个slide之间的拉伸值（距离），越大slide靠得越紧。 默认0。
                depth: 80, //slide的位置深度。值越大z轴距离越远，看起来越小。 默认100。
                modifier: 1, //depth和rotate和stretch的倍率，相当于            depth*modifier、rotate*modifier、stretch*modifier，值越大这三个参数的效果越明显。默认1。
                slideShadows: true //开启slide阴影。默认 true。
            },

        })
        window.addEventListener('load', function() {
            setTimeout(function () {
                $('#swiper5 .lazy').each(function () {
                    var src = $(this).attr('data-original');
                    if(src){
                        $(this).attr('src',src);
                        $(this).removeAttr('data-original');
                    }
                });
            },100)

        });
/*        var mySwiper = new Swiper('#swiper5',{
            effect : 'coverflow',
            loop : true,
            slidesPerView: 3,
            centeredSlides: true,
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 80,
                modifier: 1,
                slideShadows : true
            },
        })*/

    </script>
    <script>
        var is_epilogue_waypoints = false;
        $('.epilogue-section').waypoint(function(direction) {

            if(is_epilogue_waypoints === false){
                is_epilogue_waypoints = true;
                $('.epilogue-section .p1').textAnimation({
                    speed: 600,
                    delay: 100,
                    left: 50,
                    top: 50,
                    scale: 1,
                    rotateY: 0,
                    rotateX: 0,
                    translateZ: 1000,
                    letterSpacing: '10px',
                    easing: "cubic-bezier(0.290, 0.350, 0.460, 1.200)",
                    backgroundColor: "transparent",
                    isRandomScale: false,
                    isRandomPosition: false,
                    isRandomRotateY: false,
                    isRandomRotateX: false,
                    isRandomTranslateZ: false,
                    isRandomSpeed: false,
                    isRandomDelay: false});
                $('.epilogue-section .p2').textAnimation({
                    speed: 600,
                    delay: 100,
                    left: 50,
                    top: 50,
                    scale: 1,
                    rotateY: 0,
                    rotateX: 0,
                    translateZ: 1000,
                    letterSpacing: '10px',
                    easing: "cubic-bezier(0.290, 0.350, 0.460, 1.200)",
                    backgroundColor: "transparent",
                    isRandomScale: false,
                    isRandomPosition: false,
                    isRandomRotateY: false,
                    isRandomRotateX: false,
                    isRandomTranslateZ: false,
                    isRandomSpeed: false,
                    isRandomDelay: false});

            }


        }, {
            offset: '70%'
        })

        setTimeout(function(){

            $('#slogan-text').textAnimation({
                speed: 600,
                delay: 100,
                left: 50,
                top: 50,
                scale: 1,
                rotateY: 0,
                rotateX: 0,
                translateZ: 1000,
                letterSpacing: '10px',
                easing: "cubic-bezier(0.290, 0.350, 0.460, 1.200)",
                backgroundColor: "transparent",
                isRandomScale: false,
                isRandomPosition: false,
                isRandomRotateY: false,
                isRandomRotateX: false,
                isRandomTranslateZ: false,
                isRandomSpeed: false,
                isRandomDelay: false});
        },1000)
    </script>

    <script>
        $('.question .q-desc').each(function(){
            var height = $(this).outerHeight();
            $(this).css({
                'height':0,
                '--height':height+"px",
            });
        });
        $('.question .q-title').click(function(){
            if($(this).next('.q-desc').hasClass('-show')){
                $(this).next('.q-desc').removeClass('-show');
                $(this).find('.shrink i').html('&#xe775;');

            }else{
                $(this).next('.q-desc').addClass('-show');
                $(this).find('.shrink i').html('&#xeca2;');
            }
        });
    </script>

    <script>
        $('#use-num').waypoint(function(direction) {
            let demo = new CountUp('use-num',0, 100000,0,2,{
                useEasing: true,
                useGrouping: true,
            });
            demo.start();

        }, {
            offset: '100%'
        })
        $('.chooseline').waypoint(function(direction) {

            $('#ts-svg').addClass('ts-svg')

        }, {
            offset: '50%'
        })
    </script>
    <script>
        $('#loopWrap').marquee({
            //duration in milliseconds of the marquee

            speed:30,
            //gap in pixels between the tickers
            gap: 0,
            //time in milliseconds before the marquee will start animating
            delayBeforeStart: 0,
            //'left' or 'right'
            direction: 'left',
            //true or false - should the marquee be duplicated to show an effect of continues flow
            duplicated: true,
            pauseOnHover:true,
            startVisible:true,

        });
    </script>
    <script>
        $(".epilogue-img").parallax({
            speed:20,
            delay: 1000,
            deviation:200,
        });
    </script>

@stop

@section('content')
    <div class="index-banner">
        <p class="slogan" id="slogan-text"> 妳值得擁有更好的身材</p>  
        <div class="video-wrap">
            <div class="swiper-container" id="swiper-video3">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="slide-inner" data-bind-text="text-banner-0">
                            <video style="object-fit:cover" loop="" muted="" width="100%" height="100%" playsinline="">
                                <source src="{{ asset('static/video/m1.mp4') }}" type="video/mp4">
                            </video>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="slide-inner" data-bind-text="text-banner-1">
                            <video style="object-fit:cover" loop="" muted="" width="100%" height="100%" playsinline="" >
                                <source src="{{ asset('static/video/m2.mp4') }}" type="video/mp4">
                            </video>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="slide-inner" data-bind-text="text-banner-2">
                            <video style="object-fit:cover"  loop="" muted="" width="100%" height="100%" playsinline="">
                                <source src="{{ asset('static/video/m3.mp4') }}" type="video/mp4">
                            </video>
                        </div>
                    </div>
                </div>
            </div>
            <div class="video-slogan">
                <div class="text-effect" id="text-banner-0">
                    <p class="p1" id="banner-p1">Safety&nbsp;</p>
                    <p class="p2" id="banner-p2">安全減肥</p>
                    <p class="p3" id="banner-p3">歐盟EMA、美國FDA等</p>
                    <p class="p3" id="banner-p4">多國權威認證對人體安全</p>
                </div>

                <div class="text-effect" id="text-banner-1" >
                    <p class="p1" id="banner-p1">Effective&nbsp;</p>
                    <p class="p2" id="banner-p2">有效减肥</p>
                    <p class="p3" id="banner-p3">台灣上市22年</p>
                    <p class="p3" id="banner-p4">醫師首選唯一合法減肥藥</p>
                </div>

                <div class="text-effect" id="text-banner-2" >
                    <p class="p1" id="banner-p1">Healthy&nbsp;</p>
                    <p class="p2" id="banner-p2">健康减肥</p>
                    <p class="p3" id="banner-p3">無須斷食動刀，健康排出油脂</p>
                </div>
            </div>

            <div class="progress"></div>
        </div>
             
    </div>

    <div class="wrapper about">
        <div class="about-main">
            <p class="en-title">About XENICAL</p>
            <p class="title">{!! app('cache.config')->get('home_about_title') !!}</p>
            <div class="text wow animate__animated animate__fadeInUp">{!! app('cache.config')->get('home_about') !!}</div>
            <div class="cumulative wow animate__animated animate__fadeInUp">
                <p class="p1">上市至今銷量突破</p>
                <p class="p2"><span class="num" id="use-num">100,000</span><span class="em">萬億顆<br>以上</span></p>
            </div>
            <a class="go-btn" href="/about">查看羅氏鮮詳細介紹<i class="iconfont">&#xe684;</i></a>
        </div>

        <p class="suit-title wow animate__animated animate__fadeInUp">適用族群</p>
        <div class="suit-content wow animate__animated animate__fadeInUp">
            @foreach($for_people as $item)
                <div class="item">
                    <img src="{{ asset('uploads/'.$item->img) }}" alt="{{ $item->text }}">
                    <p class="text">{{ $item->text }}</p>
                </div>
            @endforeach
        </div>
    </div>


    <div class="wrapper how white-bg">
        <div class="head wow animate__animated animate__fadeInUp">
            <p class="en-title">Mechanism of Action</p>
            <p class="title">羅氏鮮作用機轉</p>
        </div>

        <div class="row">
            <div class="picker wow animate__animated animate__fadeInUp key-1">
                <span class="min-fat left-more" style="left: 14.3rem;top: 7.7rem;"></span>
                <span class="min-fat left-more" style="left: 13.2rem;top: 11.6rem;"></span>
                <span class="min-fat right-more" style="right: 11.1rem;top: 8.6rem;"></span>
                <span class="min-fat right-more" style="right: 11.3rem;top: 6.2rem;"></span>
                <img src="/static/img/how-1.jpg" alt="">
            </div>
            <p class="introduce wow animate__animated animate__fadeInUp">
                {!! app('cache.config')->get('how_to_work_1') !!}
            </p>
        </div>
        <div class="row">
            <div class="picker wow animate__animated animate__fadeInUp key-2">
                <span class="max-fat bottom-more" style="bottom: 9.5rem;left: 16rem"></span>
                <img src="/static/img/how-2.jpg" alt="">
            </div>
            <p class="introduce int-2 wow animate__animated animate__fadeInUp">
                {!! app('cache.config')->get('how_to_work_2') !!}
            </p>
        </div>
    </div>

    <div class="wrapper buy-online">
        <div class="head wow animate__animated animate__fadeInUp">
            <p class="en-title">Buy Online</p>
            <p class="title">線上訂購羅氏鮮</p>
            <p class="desc">羅氏鮮台灣官方線上訂購官網，無須醫師處方箋，歐洲原廠進口，購買組合裝可享受優惠折扣</p>
        </div>

        <div class="goods wow animate__animated animate__fadeInUp">
            @foreach($products as $item)
            <div class="item">
                <img class="goods-img" src="{{ asset('uploads/'.$item->img) }}?ver={{ config('app.asset_version') }}" alt="羅氏鮮">
                <div class="goods-title">
                    <p class="label"><span style="letter-spacing: -1px;margin-right: 4px;">{{ $item->name_en }}</span>{{ $item->name }}</p>
                    <p >{{ $item->quantity }}{{ $item->id == 1 ? '盒標準裝' : '盒優惠裝' }}</span></p>
                </div>
                <p class="price-sec">
                    @php
                        $diff = $item->market_price - $item->price;
                        $percent = $item->market_price > 0 ? round(($diff / $item->market_price) * 100) : 0;
                    @endphp
                    <span class="price"><span class="twd">NT$</span>{{ number_format(round($item->price)) }}</span>
                    @if($diff > 0)
                        <span class="market-price"><span class="twd">NT$</span>{{ number_format($item->market_price) }}</span>
                    @endif
                    <span class="discount">
                        @if($diff > 0)
                            優惠{{ $percent }}%
                        @else
                            官方售價
                        @endif
                    </span>
                </p>
                <div class="btns">
                    <a class="shop-btn go-btn" href="{{ url('checkout/'.$item->id) }}"  data-observer="立即訂購-{{ $item->name }}">立即訂購<i class="iconfont">&#xe684;</i></a>
                    <a class="go-info btn-ef2" href="{{ url('product/'.$item->id) }}" data-observer="詳情-{{ $item->name }}">詳情</a>
                </div>
            </div>
            @endforeach
        </div>

    </div>

    <div class="wrapper reviews white-bg">
        <div class="wow animate__animated animate__fadeInUp">
            <p class="en-title">Buyer Reviews</p>
            <p class="title">健康減肥瘦身<br>看看他們怎麽說</p>
        </div>

        @if($trade_show)
            <div class="swiper-container animate__animated animate__fadeInUp" id="swiper5">
                <div class="swiper-wrapper">
                    @foreach(array_values($trade_show) as $key=>$item)
                        @if($key>5)
                            @break
                        @endif
                            <div class="swiper-slide word-item">
                                <img class="lazy" data-original="{{ asset_upload($item['img']) }}" alt="{{ $item['text'] }}">
                            </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>

    <div class="wrapper tdee">
        <p class="en-title wow animate__animated animate__fadeInUp">BMI Calculation</p>
        <p class="title wow animate__animated animate__fadeInUp">BMI計算器</p>
        <p class="desc wow animate__animated animate__fadeInUp">
            {!! str_replace(PHP_EOL,'<br>',app('cache.config')->get('slim_about')) !!}
        </p>
        <a class="go-btn wow animate__animated animate__fadeInUp" href="{{ url('compute') }}">測一測你的BMI<i class="iconfont">&#xe684;</i></a>
    </div>

    <div class="wrapper chooseline white-bg">
        <div class="wow animate__animated animate__fadeInUp" id="ts-svg">
            <p class="en-title">Help You Lose Weight</p>
            <p class="title">我們致力於解決你的困擾</p>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 170" preserveAspectRatio="none">
                <path d="M7.7,145.6C109,125,299.9,116.2,401,121.3c42.1,2.2,87.6,11.8,87.3,25.7">
                </path>
            </svg>
        </div>
        <div class="main wow animate__animated animate__fadeInUp" id="loopWrap">
            <div class="group">
                @foreach($trouble as $item)
                    <div class="item">
                        <p class="p1">{{ $item->text }}</p>
                        <p class="p2"><span class="num">{{ $item->number }}</span><span class="unit">{{ $item->unit }}</span></p>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    <div class="wrapper faq">
        <div class="wow animate__animated animate__fadeInUp">
            <p class="en-title">Q&A</p>
            <p class="title">減肥常見疑問</p>
        </div>

        @foreach($faqs as $key=>$faq)
            @if($key>5)
                @break
            @endif
            <div class="faq-item wow animate__animated animate__fadeInUp">
                <div class="faq-question">
                    <span class="question-text">Q：{{ $faq->questions }}</span>
                    <i class="iconfont faq-icon">&#xeca2;</i>
                </div>
                <p class="faq-answer">A：{{ $faq->answers }}</p>
            </div>
        @endforeach


    </div>

    <div class="wrapper news white-bg" style="background-image: url({{ asset('uploads/'.app('cache.config')->get('promote_image')) }})">
        <div class="wow animate__animated animate__fadeInUp">
            <p class="en-title">Slimming Blog</p>
            <p class="title">BMI減肥知識專欄</p>
        </div>
        @foreach($news as $item)
            <div class="item wow animate__animated animate__fadeInUp">
                <a class="info" href="{{ url('news/'.$item->id) }}">
                    <div class="newsInfoIdxBox">
                        <p class="newsDateBox">
                            <span class="day">{{ $item->release_at->format('d') }}</span>
                            <span class="ym">{{ $item->release_at->format('M') }}</span>
                        </p>
                        <p class="news-title">{{ $item->title }}</p>
                    </div>
                    <p class="sub">
                        {{ \Illuminate\Support\Str::limit($item->brief?$item->brief:strip_tags($item->content),120) }}
                    </p>
                    <span class="go">閱讀全文<i class="iconfont">&#xe684;</i></span>
                </a>
            </div>
        @endforeach
    </div>

@endsection
