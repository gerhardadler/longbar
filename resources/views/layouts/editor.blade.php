@extends("layouts.app", ["is_editor" => TRUE])

@section("title")
{{ $name }}
@endsection

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
        <h1 class="guide-page-title" @if($is_new_guide) contenteditable="true" @endif>{{ $name }}</h1>

        <p class="guide-page-description" contenteditable="true">{{ $description}}</p>

        <div class="guide-page-info">
            By: *Insert author here*<br>
            Published: <time datetime="{{ $publish_time }}">{{ $publish_time->format("j. M Y") }}</time><br>
            @if($edit_time != $publish_time)
            Edited: <time datetime="{{ $edit_time }}">{{ $edit_time->format("j. M Y") }}</time><br>
            @endif
            <a class="hover-link" href="#" onclick="alert('Youre working on the guide dumbass')" id="fb_share"><i class="fa-brands fa-facebook-square"></i> Share on Facebook</a>
        </div>

        <div class="guide-page-main-text">
            <div id="ql-editor">{!! $content !!}</div>
        </div>
    </div>
    @if($is_new_guide)
        <form id="post-guide-form" action="/guides/create" method="post">
            @csrf
            <input type="hidden" name="name">
            <input type="hidden" name="description">
            <input type="hidden" name="content">
            <fieldset>
                <legend>Choose the categories the guide falls in to</legend>
                <label for="equipment">Equipment</label>
                <input type="checkbox" value="checked" name="category_1"><br>
                <label for="history">History</label>
                <input type="checkbox" value="checked" name="category_2"><br>
                <label for="new_player">New Player</label>
                <input type="checkbox" value="checked" name="category_3"><br>
                <label for="software">Software</label>
                <input type="checkbox" value="checked" name="category_4"><br>
                <label for="strategy">Strategy</label>
                <input type="checkbox" value="checked" name="category_5"><br>
                <label for="streaming">Streaming</label>
                <input type="checkbox" value="checked" name="category_6"><br>
                <label for="tournaments">Tournaments</label>
                <input type="checkbox" value="checked" name="category_7"><br>
            </fieldset>
        </form>
    @else
        <form id='update-guide-form' action='/guides/{{ $guide["slug"] }}' method='post'>
            @csrf
            <input type='hidden' name='description'>
            <input type='hidden' name='content'>
            <input type='hidden' name='guide_id' value='$guide_id'>
        </form>
    @endif
</div>
@endsection