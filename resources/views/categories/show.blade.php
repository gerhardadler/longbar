@extends("layouts.app")

@section("title")
{{ $category["name"] }}
@endsection

@section("style")
<link rel="stylesheet" href="/css/guides-and-category.css">
@endsection

@section("content")
<div class="content-darker">
    
    <h1 class="blue">{{ $category["name"] }}</h1>
    
    <p class="category-description">
        {{ $category["description"] }}
    </p>

    <h2 class="opposite-sub-title">Related guides</h2>

    <div class="guides-container">        
    @foreach($category->guides as $guide)
        <div class="guide">
            <img class="guide-img" src="/img/laptop-with-tetris.jpg">
            <div class="guide-main">
                <h2>{{ $guide["name"] }}</h2>
                <p>{{ $guide["description"] }}</p>
                <a href="/guides/{{ $guide["slug"] }}" class="guide-button">Read more</a>
            </div>
        </div>
    @endforeach
    </div>
</div>
@endsection