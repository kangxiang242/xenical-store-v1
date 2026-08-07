@extends('web::layout')

@section('style')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('static/less/index.css') }}?ver={{ config('app.asset_version') }}"/>

    <style>
        .swiper-container {
            height: 100vh;
        }

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
            padding-right: 10px;
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



    </style>
@stop

@section('script')
    @parent
    <script src="{{ asset('static/js/jquery.textAnimation.min.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/js/jquery.waypoints.min.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/js/countUp.min.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/a/js/jquery.parallax-scroll.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/js/jquery.parallax.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/js/jquery.marquee.min.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script>
        $(window).resize(function(){
            resizeVideo();
        });

        resizeVideo();
        function resizeVideo(){

            var video_width = 1000+parseInt($('.about.wrapper').css('marginLeft') || 0);
            $('.video-main').css('width',video_width);
            var left = $('.shop-btn').offset().left
            $('.shop-btn a').css('left',left+4);
        }
    </script>
    <script>
        var is_epilogue_waypoints = false;
        $('.epilogue').waypoint(function(direction) {
            if(is_epilogue_waypoints === false){
                is_epilogue_waypoints = true;
                $('.epilogue .text').textAnimation({
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

            $('.slogan').textAnimation({
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

        $('.how').waypoint(function(direction) {
            $('.appear-1').addClass('animate__animated animate__fadeInUp')
            setTimeout(function(){
                $('.appear-2').addClass('animate__animated animate__fadeInUp')
            },500)
            setTimeout(function(){
                $('.appear-3').addClass('animate__animated animate__fadeInUp')
            },1000)
            setTimeout(function(){
                $('.appear-4').addClass('animate__animated animate__fadeInUp')
            },1500)


        }, {
            offset: '50%'
        })

    </script>
    <script>
        textAnimation("#text-banner-0 .text-effect-p1");
        textAnimation("#text-banner-0 .text-effect-p2");
        textAnimation("#text-banner-0 .text-effect-p3");

        textAnimation("#text-banner-1 .text-effect-p1");
        textAnimation("#text-banner-1 .text-effect-p2");
        textAnimation("#text-banner-1 .text-effect-p3");

        textAnimation("#text-banner-2 .text-effect-p1");
        textAnimation("#text-banner-2 .text-effect-p2");
        textAnimation("#text-banner-2 .text-effect-p3");

    </script>
    <script>
        var state = 0; //0表示没有进行动画过渡，1表示在进行动画过渡
        function rotate(dir) {

            if (dir == 1 && state == 0) {
                state = 1;
                var origin_elem = $('.sef-activate');

                var last_elem = $('.sef-activate').prev();

                if(last_elem.length <= 0){
                    last_elem = $('.sef').last();
                }



                origin_elem.removeClass('sef-activate');


                last_elem.addClass('sef-activate');


                origin_elem.css({
                    'left':'0px',
                });


                var next1 = origin_elem.next()
                if(next1.length <= 0){
                    next1 = $('.sef').first();

                }
                next1.css({
                    'left': '300px',
                });


                var next2 = next1.next();
                if(next2.length <= 0){
                    next2 = $('.sef').first();
                }



                next2.css({
                    'left': '600px',
                });


                var next3 = next2.next();
                if(next3.length <= 0){
                    next3 = $('.sef').first();
                }
                next3.css({
                    'left': '900px',
                });

                state = 0;


            } else if (dir == 2 && state == 0) {
                state = 1;

                var origin_elem = $('.sef-activate');

                var next_elem = $('.sef-activate').next();

                if(next_elem.length <= 0){
                    next_elem = $('.sef').first();
                }



                origin_elem.removeClass('sef-activate');


                next_elem.addClass('sef-activate');


                origin_elem.css({
                    'left':'900px',
                });


                var prev1 = origin_elem.prev()
                if(prev1.length <= 0){
                    prev1 = $('.sef').last();

                }
                prev1.css({
                    'left': '600px',
                });


               var prev2 = prev1.prev();
                if(prev2.length <= 0){
                    prev2 = $('.sef').last();
                }

                prev2.css({
                    'left': '300px',
                });


                var prev3 = prev2.prev();
               if(prev3.length <= 0){
                   prev3 = $('.sef').last();
               }
               prev3.css({
                   'left': '0px',
               });

                state = 0;



            }
        }
    </script>

    <script>
        var interleaveOffset = 0.5;
        var bannerImageScale=1.1;
        var swiperOptions = {
            allowTouchMove: true,
            autoplay: {
                delay: 6000,
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
                init:function(){

                },
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

    </script>

    <script>
        /* $(document).scroll(function() {
            var scroH = $(document).scrollTop();
            var viewH = $(window).height();
            var contentH = $(document).height();

            if(scroH> 10){
                $('header').addClass('header-index')

            }

            if(scroH <10){
                $('header').removeClass('header-index')
            }

        }); */



        var is_marq = false;
        var animation_duration;
        $('#loopWrap').marquee({
            //duration in milliseconds of the marquee

            speed:60,
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


        $(".epilogue-img").parallax({
            speed:20,
            delay: 1000,
            deviation:300,
        });

    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function debounce(func, wait) {
                let timeout;
                return function() {
                    const context = this;
                    const args = arguments;
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(context, args), wait);
                };
            }

            const faqItems = document.querySelectorAll('.faq-item');

            function calculateHeights() {
                faqItems.forEach(item => {
                    const question = item.querySelector('.faq-question');
                    const answer = item.querySelector('.faq-answer');

                    const wasOpen = item.classList.contains('open');
                    if (!wasOpen) {
                        item.classList.add('open');
                        item.offsetHeight;
                    }

                    const questionHeight = question.offsetHeight;
                    const fullHeight = item.offsetHeight;

                    item.style.setProperty('--collapsed-height', `${questionHeight}px`);
                    item.style.setProperty('--expanded-height', `${fullHeight}px`);

                    if (!wasOpen) {
                        item.classList.remove('open');
                    }
                });
            }

            calculateHeights();

            if (faqItems.length > 0) {
                faqItems[0].classList.add('open');
            }

            faqItems.forEach(item => {
                const question = item.querySelector('.faq-question');
                question.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const isOpen = item.classList.contains('open');
                    
                    faqItems.forEach(otherItem => {
                        if (otherItem !== item && otherItem.classList.contains('open')) {
                            otherItem.classList.remove('open');
                        }
                    });

                    if (isOpen) {
                        item.classList.remove('open');
                    } else {
                        item.classList.add('open');
                    }
                });
            });

            window.addEventListener('resize', debounce(calculateHeights, 250));
        });
    </script>
@stop


@section('content')
    <div class="index-banner">
        <p class="slogan"> 妳值得擁有更好的身材</p>
        <div class="video-main">
            <div class="swiper-container" id="swiper-video3">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="slide-inner" data-bind-text="text-banner-0">
                            <video id="video1" loop style="object-fit:cover"  muted="" width="100%" height="100%" playsinline="">
                                <source src="{{ asset('static/video/1.mp4') }}" type="video/mp4">
                            </video>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="slide-inner" data-bind-text="text-banner-1">
                            <video style="object-fit:cover" loop muted="" width="100%" height="100%" playsinline="">
                                <source src="{{ asset('static/video/2.mp4') }}" type="video/mp4">
                            </video>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="slide-inner" data-bind-text="text-banner-2">
                            <video style="object-fit:cover" loop  muted="" width="100%" height="100%" playsinline="">
                                <source src="{{ asset('static/video/3.mp4') }}" type="video/mp4">
                            </video>
                        </div>
                    </div>
                </div>
            </div>
            <div class="progress"></div>
            <div class="text-effect" id="text-banner-0">
                <p class="text-effect-p1">Safety&nbsp;</p>
                <p class="text-effect-p2">安全減肥</p>
                <p class="text-effect-p3">歐盟EMA、美國FDA等多國權威認證對人體安全</p>
            </div>
            <div class="text-effect" id="text-banner-1" >
                <p class="text-effect-p1">Effective&nbsp;</p>
                <p class="text-effect-p2">有效减肥</p>
                <p class="text-effect-p3">台灣上市22年，醫師首選唯一合法減肥藥</p>
            </div>
            <div class="text-effect" id="text-banner-2" >
                <p class="text-effect-p1">Healthy&nbsp;</p>
                <p class="text-effect-p2">健康减肥</p>
                <p class="text-effect-p3">無須斷食動刀，健康排出油脂</p>
            </div>
        </div>
    </div>

    <div class="about wrapper column">
        <div class="about-main wow animate__animated animate__fadeInUp">
            <p class="en-title">About XENICAL</p>
            <h2 class="title">{!! app('cache.config')->get('home_about_title') !!}</h2>
            <div class="text">{!! app('cache.config')->get('home_about') !!}</div>
            <div class="xl-main">
                <p class="xl-title">上市至今銷量突破</p>
                <div class="text">
                    <span class="num" id="use-num">100,000</span><span class="em">萬億顆<br>以上</span>
                </div>
            </div>
            <a class="go-btn" href="/about">查看羅氏鮮詳細介紹<i class="iconfont">&#xe684;</i></a>
        </div>
        <p class="title wow animate__animated animate__fadeInUp">適用族群</p>
        <div class="suit-content wow animate__animated animate__fadeInUp">
            @php
                $people_key=0;
            @endphp
            @foreach($for_people as $key=>$item)
                <div class="item" data-parallax='{"y": {{ $people_key%2==0?'-':'' }}100}'>
                    <img src="{{ asset('uploads/'.$item->img) }}" alt="{{ $item->text }}">
                    <p class="text">{{ $item->text }}</p>
                </div>
                @php
                    $people_key++;
                @endphp
            @endforeach
        </div>
    </div>

    <div class="how wrapper column">
        <div class="modal wow animate__animated animate__fadeInUp">
            <p class="en-title">Mechanism of Action</p>
            <h2 class="title">羅氏鮮作用機轉</h2>
        </div>
        <div class="how-body">
            <div class="how-resolve">
                <div class="picker appear-1">
                    <span class="min-zf left-more" style="left: 182px;top: 122px;"></span>
                    <span class="min-zf left-more" style="left: 195px;top: 186px;"></span>
                    <span class="min-zf right-more" style="right: 166px;top: 93px;"></span>
                    <span class="min-zf right-more" style="right: 148px;top: 138px;"></span>
                    <img src="/static/img/how-1.jpg" alt="">
                </div>
                <p class="introduce appear-2">{!! app('cache.config')->get('how_to_work_1') !!}</p>
            </div>

            <div class="how-resolve restrain ">
                <div class="picker appear-3">
                    <span class="max-zf bottom-more" style="bottom: 108px;left: 236px"></span>
                    <img src="/static/img/how-2.jpg" alt="">
                </div>
                <p class="introduce appear-4">{!! app('cache.config')->get('how_to_work_2') !!}</p>
            </div>

        </div>
    </div>

    <div class="product wrapper column">
        <div class="modal wow animate__animated animate__fadeInUp">
            <p class="en-title">Buy Online</p>
            <h2 class="title">線上訂購羅氏鮮</h2>
            <p class="desc">羅氏鮮台灣官方線上訂購官網，無須醫師處方箋，歐洲原廠進口，購買組合裝可享受優惠折扣</p>
        </div>

        <div class="goods wow animate__animated animate__fadeInUp">
            @foreach($products as $key=>$item)
                <div class="item">
                    <img class="goods-img" src="{{ asset('uploads/'.$item->img) }}?ver={{ config('app.asset_version') }}" alt="羅氏鮮">
                    <div class="info">
                        <div>
                            <p class="label"><span style="letter-spacing: -1px;margin-right: 4px;">{{ $item->name_en }}</span>{{ $item->name }}</p>
                            <p class="goods-title">{{ $item->quantity }}{{ $item->id == 1 ? '盒標準裝' : '盒優惠裝' }}</p>
                        </div>
                        <div class="buy-sec">
                            <p class="price-sec">
                                @php
                                    $diff = $item->market_price - $item->price;
                                    $percent = $item->market_price > 0 ? round(($diff / $item->market_price) * 100) : 0;
                                @endphp

                                @if($diff > 0)
                                    <span class="market-price"><span class="twd">NT$</span>{{ number_format($item->market_price) }}</span>
                                @endif
                                <span class="price"><span class="twd">NT$</span>{{ number_format(round($item->price)) }}</span>
                                <span class="discount">
                                    @if($diff > 0)
                                        優惠{{ $percent }}%
                                    @else
                                        官方售價
                                    @endif
                                </span>
                            </p>
                            <a class="shop-btn go-btn" href="{{ url('checkout/'.$item->id) }}"  data-observer="立即訂購-{{ $item->name }}">立即訂購<i class="iconfont">&#xe684;</i></a>
                            <a class="go-info btn-ef2" href="{{ url('product/'.$item->id) }}" data-observer="詳情-{{ $item->name }}">詳情</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

    <div class="reviews wrapper column">
        <div class="modal wow animate__animated animate__fadeInUp">
            <p class="en-title">Buyer Reviews</p>
            <h2 class="title">健康減肥瘦身<br>看看他們怎麽說</h2>
        </div>
        @if($trade_show)
        <div class="reviews-body wow animate__animated animate__fadeInUp">
            <div class="evaluate">
                @foreach(array_values($trade_show) as $key=>$item)
                    @if($key>5)
                        @break
                    @endif

                    <div class="sef {{ $key==0?"sef-activate":"" }}">
                        <img src="{{ asset_upload($item['img']) }}" alt="{{ isset($item['text'])?$item['text']:'' }}">
                    </div>

                @endforeach
            </div>
            <div class="switch prev-btn"><a href="javascript:;" onclick="rotate(1)"><i class="iconfont">&#xe779;</i></a></div>
            <div class="switch next-btn"><a href="javascript:;" onclick="rotate(2)"><i class="iconfont">&#xe775;</i></a></div>
        </div>
        @endif
    </div>

    <div class="tdee wrapper column">
        <p class="en-title wow animate__animated animate__fadeInUp">BMI Calculation</p>
        <h2 class="title wow animate__animated animate__fadeInUp">BMI計算器</h2>
        <p class="tdee-about  wow animate__animated animate__fadeInUp">
            {!! str_replace(PHP_EOL,'<br>',app('cache.config')->get('slim_about')) !!}
        </p>
        <a class="go-btn" href="{{ url('compute') }}" data-observer="測試你的數據按鈕">測一測你的BMI<i class="iconfont">&#xe684;</i></a>

    </div>

    <div class="chooseline wrapper column">
        <div class="modal wow animate__animated animate__fadeInUp" id="ts-svg">
            <p class="en-title">Help You Lose Weight</p>
            <h2 class="title">羅氏鮮幫助妳解決減肥困擾</h2>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 170" preserveAspectRatio="none">
                <path d="M7.7,145.6C109,125,299.9,116.2,401,121.3c42.1,2.2,87.6,11.8,87.3,25.7">
                </path>
            </svg>
        </div>
        <div class="chooseline-body wow animate__animated animate__fadeInUp" id="loopWrap">
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

    <div class="fqa wrapper column">
        <div class="modal wow animate__animated animate__fadeInUp">
            <p class="en-title">Q&A</p>
            <h2 class="title">減肥常見疑問</h2>
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

    <div class="news">
        <div class="wow animate__animated animate__fadeInUp">
            <p class="en-title">Slimming Blog</p>
            <h2 class="title">減肥知識專欄</h2>
        </div>
        <div class="news-main">
            <div class="image-wrap wow animate__animated animate__fadeInUp">
                <div class="box epilogue-img" style="background-image: url({{ asset('uploads/'.app('cache.config')->get('promote_image')) }})"></div>
            </div>
            <div class="news-wrap">
                @foreach($news as $item)
                    <div class="item wow animate__animated animate__fadeInUp">
                        <a class="info" href="{{ url('news/'.$item->id) }}">
                            <div class="newsInfoIdxBox">
                                <p class="newsDateBox">
                                    <span class="day">{{ $item->release_at->format('d') }}</span>
                                    <span class="ym">{{ $item->release_at->format('M') }}</span>
                                </p>
                                <p style="font-weight: 500;">{{ $item->title }}</p>
                            </div>
                            <p class="sub">
                                {{ \Illuminate\Support\Str::limit($item->brief?$item->brief:strip_tags($item->content),120) }}
                            </p>
                            <span class="go">閱讀全文<i class="iconfont">&#xe684;</i></span>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
