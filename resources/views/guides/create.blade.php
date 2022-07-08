@extends("layouts.editor", [
    "title" => "Write your title here",
    "description" => "Write your description here",
    "publish_time" => "Not published yet",
    "content" => "<p>Write your content here</p>",
    "is_new_guide" => TRUE
])

@section("title")
Create a Guide
@endsection