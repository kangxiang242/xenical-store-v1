@extends('web::layout')

@section('style')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('static/less/evaluate.css') }}?ver={{ config('app.asset_version') }}"/>
    <style>
        blockquote{
            border-left: 5px solid rgba(0,0,0,.05);
            padding: 20px;

            font-style: italic;

            position: relative;
            margin: 1.5em 1em 1.5em 3em;
            font-size: 1.2em;
            line-height: inherit;

        }
        .editor ul {
            list-style: disc;
            margin: 0 0 1.5em 3em;
        }
        .editor li{
            list-style: disc;
            margin-bottom: 20px;
        }
        .editor ul li::marker{

            unicode-bidi: isolate;
            font-variant-numeric: tabular-nums;
            text-transform: none;
            text-indent: 0px !important;
            text-align: start !important;
            text-align-last: start !important;
        }
        .editor p{
            margin-bottom: 1.8em;
            font-size: 18px;
        }

        .editor h2{
            margin-bottom: 20px;
            font-size: 2.4em;
        }
    </style>
@stop

@section('script')
    @parent
    <script src="{{ asset('static/js/jquery.leoTextAnimate.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script>
        let lastDigits = ['?', '?', '?'];
        function animateDigit(el, num, alwaysSpin = false) {
            const digitHeight = 44;
            const inner = el.querySelector('.digit-inner');
            let targetIndex = num === '?' ? 0 : (parseInt(num, 10) + 1);
            let currentTransform = inner.style.transform || 'translateY(0)';
            let currentIndex = 0;
            const match = currentTransform.match(/-([0-9]+)px/);
            if (match) currentIndex = Math.round(parseInt(match[1], 10) / digitHeight);

            if (!alwaysSpin && currentIndex === targetIndex) return;
            let rounds = alwaysSpin ? 1 : 0;
            let totalIndex = targetIndex + (rounds * 11);
            inner.style.transition = 'none';
            inner.style.transform = `translateY(0)`;
            void inner.offsetWidth;
            inner.style.transition = 'transform 1s ease-out';
            inner.style.transform = `translateY(-${totalIndex * digitHeight}px)`;
        }

        function animateBMIDisplay(bmi) {
            const fixedBMI = bmi.toFixed(1);
            const [intPartRaw, decPartRaw] = fixedBMI.split('.');
            const intPart = intPartRaw.padStart(2, '0');
            const decPart = decPartRaw ? decPartRaw[0] : '0';
            const digits = [intPart[0], intPart[1], '.', decPart];
            const int1 = document.getElementById('int1');
            const int2 = document.getElementById('int2');
            const dec1 = document.getElementById('dec1');
            animateDigit(int1, digits[0] || '0', false);
            animateDigit(int2, digits[1] || '0', false);
            animateDigit(dec1, digits[3] || '0', false);
            lastDigits = [digits[0] || '0', digits[1] || '0', digits[3] || '0'];
        }

        
        window.addEventListener('DOMContentLoaded', function() {
            animateDigit(document.getElementById('int1'), '?');
            animateDigit(document.getElementById('int2'), '?');
            animateDigit(document.getElementById('dec1'), '?');
            lastDigits = ['?', '?', '?'];
        });

        
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.count').addEventListener('click', function () {
                const height = parseFloat(document.getElementById('height').value);
                const weight = parseFloat(document.getElementById('weight').value);

                if (!height || !weight || height <= 0 || weight <= 0) {
                    alert("請正確輸入身高與體重");
                    return;
                }

                const bmi = weight / ((height / 100) ** 2);
                animateBMIDisplay(bmi);
            });

            document.querySelector('.reset').addEventListener('click', function () {
                document.getElementById('height').value = '';
                document.getElementById('weight').value = '';
                animateDigit(document.getElementById('int1'), '?');
                animateDigit(document.getElementById('int2'), '?');
                animateDigit(document.getElementById('dec1'), '?');
                lastDigits = ['?', '?', '?'];
            });
        });
    </script>
@stop



@section('embed-banner')
    <div class="embed-banner wrapper column">
        <p class="en-title">{!! app('cache.config')->get('page_evaluate_title_en') !!}</p>
        <h1 class="embed-title">{!! app('cache.config')->get('page_evaluate_title') !!}</h1>
        <div class="embed-desc">{!! str_replace(PHP_EOL,'<br>',app('cache.config')->get('page_evaluate_desc')) !!}</div>
    </div>
@stop

@section('content')
    <div class="editor">
        {!! app('cache.config')->get('page_evaluate_article') !!}
    </div>
    <div class="evaluate-sec">
        <div class="calculate">
            <h2 class="sec-title">BMI計算器</h2>
            <form class="evaluate-form">
                <div class="form-group">
                    <label class="form-title" for="height">請輸入你的身高：</label>
                    <input class="form-control" type="number" id="height" name="height" placeholder="" inputmode="decimal">
                    <span class="form-title">公分</span>
                </div>
                <div class="form-group">
                    <label class="form-title" for="weight">請輸入你的體重：</label>
                    <input class="form-control" type="number" id="weight" name="weight" placeholder="" inputmode="decimal">
                    <span class="form-title">公斤</span>
                </div>
                <div class="btns">
                    <a class="reset" href="javascript:;">重設</a>
                    <a class="count btn-ef1" href="javascript:;">開始計算</a>
                </div>
                <p class="privacy-note">本工具僅於瀏覽器端運算，不會傳送或儲存任何輸入資料。如需更多資訊，請參閱<a href="/privacy">隱私權政策</a>。</p>
            </form>
        </div>
        <div class="result">
            <h2 class="sec-title">你的BMI結果</h2>
            <p class="result-num">
                <span class="digit" id="int1">
                    <span class="digit-inner">
                        <span>?</span><span>0</span><span>1</span><span>2</span><span>3</span><span>4</span><span>5</span><span>6</span><span>7</span><span>8</span><span>9</span>
                    </span>
                </span>
                <span class="digit" id="int2">
                    <span class="digit-inner">
                        <span>?</span><span>0</span><span>1</span><span>2</span><span>3</span><span>4</span><span>5</span><span>6</span><span>7</span><span>8</span><span>9</span>
                    </span>
                </span>
                <span class="dot">.</span>
                <span class="digit" id="dec1">
                    <span class="digit-inner">
                        <span>?</span><span>0</span><span>1</span><span>2</span><span>3</span><span>4</span><span>5</span><span>6</span><span>7</span><span>8</span><span>9</span>
                    </span>
                </span>
            </p>
        </div>
        <div class="comparison">
            <h2 class="sec-title">BMI標準參照表</h2>
            <table class="bmi-table">
                <thead>
                    <tr>
                    <th>類別</th>
                    <th>歐美BMI標準</th>
                    <th>亞太區BMI標準</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bmi-underweight">
                    <td>過輕</td>
                    <td>&lt;18.5</td>
                    <td>&lt;18.5</td>
                    </tr>
                    <tr class="bmi-normal">
                    <td>正常</td>
                    <td>18.5-24.9</td>
                    <td>18.5-22.9</td>
                    </tr>
                    <tr class="bmi-overweight">
                    <td>過重</td>
                    <td>25-29.9</td>
                    <td>23-24.9</td>
                    </tr>
                    <tr class="bmi-obese">
                    <td>肥胖</td>
                    <td>&ge;30</td>
                    <td>&ge;25</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="page-news">
        <h2 class="sec-title">BMI知識分享閱讀</h2>
        @foreach($news as $item)
            <div class="item">
                <a class="info" href="{{ url('news/'.$item->id) }}">
                    <div class="Img"><img src="{{ asset('uploads/'.$item->img) }}" alt="{{ $item->title }}"></div>
                    <div class="Txt">
                        <div class="newsInfoIdxBox">
                            <p class="newsDateBox">
                                <span class="day">{{ $item->release_at->format('d') }}</span>
                                <span class="ym">{{ $item->release_at->format('M') }}</span>
                            </p>
                            <h2 class="title">{{ $item->title }}</h2>
                        </div>
                        <p class="sub">
                            {{ \Illuminate\Support\Str::limit($item->brief?$item->brief:strip_tags($item->content),680) }}
                        </p>
                        <span class="go">閱讀全文<i class="iconfont">&#xe684;</i></span>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

@endsection
@section('breadcrumb')
    <li class="active">{!! app('cache.config')->get('page_evaluate_title') !!}</li>
@stop