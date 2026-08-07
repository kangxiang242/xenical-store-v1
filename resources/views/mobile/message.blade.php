@extends('mobile::layout')

@section('style')
    @parent
    <link rel="stylesheet" href="{{ asset('static/mobile/less/message.css') }}?ver={{ config('app.asset_version') }}">
@stop

@section('script')
    @parent
    <script>

        setInterval(function(){
            if(messageVerify() == true){
                $('.form-btn').addClass('activate-btn');
            }else{
                $('.form-btn').removeClass('activate-btn');
            }

        },1000);
        function messageVerify(){
            var name = $("input[name='name").val();
            var phone = $("input[name='phone']").val();
            var email = $("input[name='email']").val();
            var content = $("textarea[name='content']").val();
            if(!name){
                return false;
            }
            if(!phone){
                return false;
            }
            if(!(/^09\d{8}$/.test(phone))){
                return false;
            }
            if(!email){
                return false;
            }
            if(email.search(/^([a-zA-Z0-9]+[_|_|.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|_|.]?)*[a-zA-Z0-9]+\.(?:com|cn|tw|info|net)$/) == -1){
                return false;
            }
            if(!content){
                return false;
            }
            return true;
        }
    </script>
    <script>
        $(window).scroll(function() {
            bgEffect()

        });

        function bgEffect(){
            let top = document.scrollingElement.scrollTop; //触发滚动条，记录数值
            let banner_height = $('.fixed-bg').height()-40;
            let opacity = 1-top/banner_height;
            $('.fixed-bg').css('opacity',opacity);
            if(($(window).scrollTop() + $(window).height()).toFixed(0) == $(document).height()){
                $('.fixed-bg').css('opacity',0);
            }

        }
    </script>

    <script>
        submit('#message-form');
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
    <div class="fixed-bg" style="background-image: url('{{ asset_upload(app('cache.config')->get('page_message_back_img')) }}')">
    </div>
    <p class="en-title" style="padding-top: 5rem;">{!! app('cache.config')->get('page_message_title_en') !!}</p>
    <h1 class="page-title">{!! app('cache.config')->get('page_message_title') !!}</h1>

    <div class="quick">
        <p class="title">快速協助</p>
        <p class="desc">{!! app('cache.config')->get('page_message_desc') !!}</p>
        @foreach($faqs as $item)
            <div class="faq-item">
                <div class="faq-question">
                    <span class="question-text">Q：{{ $item->questions }}</span>
                    <i class="iconfont faq-icon">&#xeca2;</i>
                </div>
                <p class="faq-answer">A：{{ $item->answers }}</p>
            </div>
        @endforeach
    </div>
    <div class="contact">
        <p class="title">聯絡我們</p>
        <p class="desc">{!! app('cache.config')->get('page_lianluo_desc') !!}</p>
        <form action="{{ url('message') }}" method="post" id="message-form">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">你的稱呼：</label>
                <input class="form-control" data-validate="required:請輸入你的稱呼" type="text" id="name" name="name" autocomplete="name" placeholder="請輸入你的稱呼" required>
            </div>
            <div class="form-group">
                <label for="phone">聯絡電話：</label>
                <input class="form-control" data-validate="required:請輸入你的聯絡電話|mobile:聯絡電話格式錯誤" type="text" id="phone" name="phone" autocomplete="tel" placeholder="請輸入聯絡你的電話號碼" required>
            </div>
            <div class="form-group">
                <label for="email">電子郵箱：</label>
                <input class="form-control" data-validate="required:請輸入你的電子郵箱|email:電子郵箱格式錯誤" type="text" id="email" name="email" autocomplete="email" placeholder="請輸入聯絡你的電子郵箱" required>
            </div>
            <div class="form-group">
                <label for="type">協助類型：</label>
                <select class="form-control" id="type" name="type">
                    <option value="1">療程咨詢</option>
                    <option value="2">退換貨</option>
                    <option value="3">修改訂單信息</option>
                    <option value="4">修改/新增訂單備注</option>
                    <option value="5">意見或建議</option>
                    <option value="0" selected>其它</option>
                </select>
            </div>
            <div class="form-group">
                <label for="content">問題詳述：</label>
                <textarea class="form-control form-textarea" data-validate="required:請詳述你的問題或建議" name="content" id="content" placeholder="請詳述你的問題或建議&#10;並提供您的訂單編號(如您已取得)"></textarea>
            </div>

            <button class="form-btn" >確認送出</button>
        </form>
    </div>

@endsection
@section('breadcrumb')
    <li class="active">取得協助</li>
@endsection
