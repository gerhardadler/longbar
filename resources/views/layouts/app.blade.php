<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://use.typekit.net/vkg1ncc.css"> <!-- Museo Slab Serif -->
        
        @yield("style")
        
        <script defer type="text/javascript" src="/js/script.js"></script>
        <script defer src="https://kit.fontawesome.com/4891e5aca9.js" crossorigin="anonymous"></script> <!-- Makes it easy to use icons -->
        
        @isset($is_editor) <!-- Resources to use Quill.js -->
            <link rel="stylesheet" href="//cdn.quilljs.com/1.3.6/quill.snow.css"> <!-- Quill Theme included stylesheets -->
            <link rel="stylesheet" href="/css/snow-customisation.css">

            <script defer src="//cdn.quilljs.com/1.3.6/quill.js"></script>
            <script defer type="text/javascript" src="/js/editor.js"></script>
        @endisset

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>@yield("title")</title>
    </head>
    <body>
        @include("layouts.nav")
        @yield("content")
        @include("layouts.footer")
    </body>
</html>