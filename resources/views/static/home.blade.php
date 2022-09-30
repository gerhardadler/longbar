@extends("layouts.app")

@section("title")
Longbar.org
@endsection

@section("style")
<link rel="stylesheet" href="/css/sitewide.css">
<link rel="stylesheet" href="/css/home.css">
@endsection

@section("content")


<div class="content">
    @if (session('status'))
        {{ session('status') }}
    @endif
    <div class="index-container">
        <div>
            <h1>
                Learn<br>
                The Best Tetris
            </h1>
            <p class="site-description">
                Tetris is a block stacking game for anyone. Easy to learn, hard to master.
                <span style="color: var(--accent-text-color-2)"> We have free guides from beginner to advanced.</span>
            </p>
        </div>
        
        <div>
            <h2 class="big-button-title">New to NES Tetris?</h2>
            <a class="big-button" href="/new-player">Go here</a>

            <h2 class="big-button-title">Browse our guides</h2>
            <a class="big-button" href="/guides">Go here</a>
        </div>
    </div>
</div>
@endsection