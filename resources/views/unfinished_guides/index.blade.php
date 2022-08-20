@extends("layouts.app")

@section("title")
Unfinished Guides
@endsection

@section("style")
<link rel="stylesheet" href="/css/guides-and-category.css">
@endsection

@section("content")
<div class="content-darker">
    
    <h1>Your Guides</h1>
    
    <div class="guides-container">
    @foreach($guides as $guide)
        <div class="guide">
            <img class="guide-img" src="/img/laptop-with-tetris.jpg">
            <div class="guide-main">
                <h2>{{ $guide["name"] }}</h2>
                <p>{{ $guide["description"] }}</p>
                <a href="/unfinished-guides/{{ $guide["slug"] }}/edit" class="guide-button">Edit</a>
            </div>
        </div>
    @endforeach
    </div>
</div>
@endsection