@extends("layouts.app")

@section("title")

@endsection

@section("style")
<link rel="stylesheet" href="/css/sitewide.css">
<link rel="stylesheet" href="/css/guide.css">
@endsection

@section("content")
<div class="content">
    <div class="guide-page-content">
        <h1 class="guide-page-title">{{ $guide["name"] }}</h1>

        <p class="guide-page-description">
            {{ $guide["description"] }}
        </p>

        <div class="guide-page-info">
            By: Clint Eastwood<br>
            Published: <time datetime="Insert time here">Insert time here</time><br>
            <a class="hover-link" href="" id="fb_share" target="_blank"><i class="fa-brands fa-facebook-square"></i> Share on Facebook</a>

            <script>
                window.onload = function() {
                    fb_share.href ='https://www.facebook.com/share.php?u=' + encodeURIComponent(location.href); 
                }  
            </script>
        </div>

        <div class="guide-page-main-text">
            {{ $guide["content"] }}
        </div>
    </div>
</div>
@endsection