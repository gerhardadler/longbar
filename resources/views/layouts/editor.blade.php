@extends("layouts.app", ["is_editor" => TRUE])

@section("style")
<link rel="stylesheet" href="/css/sitewide.css">
<link rel="stylesheet" href="/css/guide.css">
<link rel="stylesheet" href="/css/editor.css">
@endsection

@section("content")
<div id="toolbar-main">
    <span class="ql-formats">
        <button class="ql-bold"></button>
        <button class="ql-italic"></button>
        <button class="ql-underline"></button>
        <button class="ql-strike"></button>
    </span>
    <span class="ql-formats">
        <button class="ql-blockquote"></button>
    </span>
    <span class="ql-formats">
        <select class="ql-header">
            <option value="2"></option>
            <option value="3"></option>
            <option value=""></option>
        </select>
    </span>
    <span class="ql-formats">
        <button class="ql-list" value="ordered"></button>
        <button class="ql-list" value="bullet"></button>
    </span>
    <span class="ql-formats">
        <button class="ql-script" value="sub"></button>
        <button class="ql-script" value="super"></button>
    </span>
    <span class="ql-formats">
        <button class="ql-link"></button>
        <button class="ql-image"></button>
        <button class="ql-video"></button>
    </span>
    <span class="ql-formats">
        <select class="ql-color">
            <option value="#1c212d"></option>
            <option value="#dd6f10"></option>
            <option value="#1974c0"></option>
        </select>
    </span>
</div>
<div class="content">
    <div class="guide-page-content">
        <h1 class="guide-page-title" contenteditable="true">{{ $title }}</h1>

        <p class="guide-page-description" contenteditable="true">{{ $description}}</p>

        <div class="guide-page-info">
            By: *Insert author here*<br>
            Published: <time datetime="{{ $publish_time }}">{{ $publish_time }}</time><br>
            <a class="hover-link" href="#" onclick="alert('Youre working on the guide dumbass')" id="fb_share"><i class="fa-brands fa-facebook-square"></i> Share on Facebook</a>
        </div>

        <div class="guide-page-main-text">
            <div id="ql-editor">{!! $content !!}</div>
        </div>
    </div>
    @isset($is_new_guide)
        <form id="post-guide-form" action="/editor/post-guide.php" method="post">
            @csrf
            <input type="hidden" name="title">
            <input type="hidden" name="description">
            <input type="hidden" name="content">
            <fieldset>
                <legend>Choose the categories the guide falls in to</legend>
                <label for="equipment">Equipment</label>
                <input type="checkbox" value="checked" name="equipment"><br>
                <label for="history">History</label>
                <input type="checkbox" value="checked" name="history"><br>
                <label for="new_player">New Player</label>
                <input type="checkbox" value="checked" name="new_player"><br>
                <label for="software">Software</label>
                <input type="checkbox" value="checked" name="software"><br>
                <label for="strategy">Strategy</label>
                <input type="checkbox" value="checked" name="strategy"><br>
                <label for="streaming">Streaming</label>
                <input type="checkbox" value="checked" name="streaming"><br>
                <label for="tournaments">Tournaments</label>
                <input type="checkbox" value="checked" name="tournaments"><br>
            </fieldset>
        </form>
    @else
        <form id='update-guide-form' action='/editor/update-guide.php' method='post'>
            @csrf
            <input type='hidden' name='description'>
            <input type='hidden' name='content'>
            <input type='hidden' name='guide_id' value='$guide_id'>
        </form>
    @endif
</div>
@endsection