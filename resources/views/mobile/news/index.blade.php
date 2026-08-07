@extends('mobile::layout')

@section('style')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('static/mobile/less/news.css') }}?ver={{ config('app.asset_version') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('static/mobile/less/pagination.css') }}?ver={{ config('app.asset_version') }}"/>
@stop

@section('script')
    @parent
    <script src="{{ asset('static/js/jquery.waypoints.min.js') }}"></script>
    <script>
        $(function(){
            $('.item').waypoint(function(){
                this.element.classList.add('show');
            },{
                offset: '90%'
            });
            $('.item:first').waypoint(function(){
                this.element.classList.add('show');
            },{
                offset: '100%'
            });
        });
    </script>
    <script>
        $(window).scroll(function() {
            bgEffect()

        });

        function bgEffect(){
            let top = document.scrollingElement.scrollTop; //触发滚动条，记录数值
            let banner_height = $('.fixed-bg').height()-130;
            let opacity = 1-top/banner_height;
            $('.fixed-bg').css('opacity',opacity);

            if(($(window).scrollTop() + $(window).height()).toFixed(0) == $(document).height()){
                $('.fixed-bg').css('opacity',0);
            }

        }
    </script>
@stop


@section('content')
    <div class="fixed-bg" style="background-image: url('{{ asset_upload(app('cache.config')->get('page_news_back_img')) }}')">
    </div>

    <p class="en-title" style="padding-top: 5rem;">{!! app('cache.config')->get('page_news_title_en') !!}</p>
    <h1 class="page-title">{!! app('cache.config')->get('page_news_title') !!}</h1>
    
    <div class="news-wrap">
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
                            <p class="news-title">{{ $item->title }}</p>
                        </div>
                        <p class="sub">
                            {{ \Illuminate\Support\Str::limit($item->brief?$item->brief:strip_tags($item->content),680) }}
                        </p>
                        <span class="go">閱讀全文<i class="iconfont">&#xe684;</i></span>
                    </div>
                </a>
            </div>
        @endforeach
        {{ $news->links() }}
    </div>

@endsection
@section('breadcrumb')
    <li class="active">減肥知識分享</li>
@endsection