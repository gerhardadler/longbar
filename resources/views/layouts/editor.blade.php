@extends("layouts.app", ["is_editor" => TRUE])

@section("title")
{{ $guide["name"] }}
@endsection

@section("style")
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
        <h1 class="guide-page-title" @if($guide["is_new_guide"]) contenteditable="true" @endif>{{ old("name", $guide["name"]) }}</h1>

        <p class="guide-page-description" contenteditable="true">{{ old("description", $guide["description"]) }}</p>

        <div class="guide-page-info">
            Author: {{ $guide["author"] }}<br>
            @isset($guide["editors"])
            Editors: {{ $guide["editors"] }}<br>
            @endisset
            @isset($guide["created_at"])
                Published: <time datetime="{{ $guide["created_at"] }}">{{ $guide["created_at"]->format("j. M Y") }}</time><br>
                @if($guide["updated_at"] != $guide["created_at"])
                Edited: <time datetime="{{ $guide["updated_at"] }}">{{ $guide["updated_at"]->format("j. M Y") }}</time><br>
                @endif
            @else
                Published: Not yet published<br>
            @endisset
            <a class="hover-link" href="#" onclick="alert('You\'re working on the guide dumbass')" id="fb_share"><i class="fa-brands fa-facebook-square"></i> Share on Facebook</a>
        </div>

        <div class="guide-page-main-text">
            <div id="ql-editor">{!! old("content", $guide["content"]) !!}</div>
        </div>
    </div>
    @yield("forms")
    @if($errors->count() > 0)
        <p>These errors occured:</p>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
</div>
@endsection