@extends('mobile::layout')

@section('style')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('static/mobile/less/page.css') }}?ver={{ config('app.asset_version') }}"/>

@stop

@section('script')
    @parent

    <script>
        document.domain = "xenicalofficial.com";
        function setIframeHeight(iframe) {
            if (iframe) {
                var iframeWin = iframe.contentWindow || iframe.contentDocument.parentWindow;
                if (iframeWin.document.body) {
                    iframe.height = iframeWin.document.documentElement.scrollHeight || iframeWin.document.body.scrollHeight;
                }}
        };
        window.onload = function () {
            setIframeHeight(document.getElementById('external-frame'));
        };
    </script>

@stop
@section('breadcrumb')
    <li class="active">{{ $title }}</li>
@stop

@section('content')

    <p class="en-title" style="padding-top: 5rem;">{{ $title_en }}</p>
    <h1 class="title">{{ $title }}</h1>
    @if(isset($html_code) && $html_code)
        <iframe id="external-frame" width="100%" style="min-height: 100vh" src="{{ asset_upload('article_html/'.str_replace('.zip','',$html_code).'/index.html') }}"  frameborder="0" scrolling="no" onload="setIframeHeight(this)"></iframe>
    @else
        <div class="page-body">
            {!! $content !!}
        </div>
    @endif


@endsection
