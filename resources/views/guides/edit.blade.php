@extends("layouts.editor")

@section("forms")
<form id='update-guide-form' action='/guides/{{ $guide["slug"] }}' method='post'>
    @csrf
    <input type='hidden' name='description'>
    <input type='hidden' name='content'>
</form>
@endsection