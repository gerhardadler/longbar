@extends("layouts.app")

@section("title")
Guides
@endsection

@section("style")
<link rel="stylesheet" href="/css/guides-and-category.css">
@endsection

@section("content")
<div class="content-darker">
    
    <h1>Our Guides</h1>
    <h2>Categories</h2>
    <div class="categories">
            <a href="/equipment" class="category">Equipment</a>
            <a href="/history" class="category">History</a>
            <a href="/new-player" class="category">New player</a>
            <a href="/software" class="category">Software</a>
            <a href="/strategy" class="category">Strategy</a>
            <a href="/streaming" class="category">Streaming</a>
            <a href="/tournaments" class="category">Tournaments</a>
    </div>
    <h2 class="opposite-sub-title">Recommended guides</h2>
    
    <div class="guides-container">
    @foreach($guides as $guide)
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