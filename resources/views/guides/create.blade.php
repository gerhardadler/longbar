@extends("layouts.editor")

@section("forms")
<form id="post-guide-form" action="/guides/create" method="post">
    @csrf
    <input type="hidden" name="name">
    <input type="hidden" name="description">
    <input type="hidden" name="content">
    <fieldset>
        <legend>Choose the categories the guide falls in to</legend>
        @php
            $category_names = ["Equipment", "History", "New player", "Software", "Strategy", "Streaming", "Tournaments"];
        @endphp
        @for($id = 1; $id <= 7; $id++)
            <input type="checkbox" name="category[]" id="check-box-{{ $id }}" value="{{ $id }}" {{ (is_array(old("category")) && in_array($id, old("category"))) ? "checked" : "" }}>
            <label for="check-box-{{ $id }}">{{ $category_names[$id-1] }}</label><br>
        @endfor
    </fieldset>
    <input type="submit" name="action" value="Save"><br>
    <input type="submit" name="action" value="Publish">
</form>
@endsection