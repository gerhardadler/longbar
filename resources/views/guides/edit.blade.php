@extends("layouts.editor", [
    "name" => $guide["name"],
    "description" => $guide["description"],
    "publish_time" => $guide["created_at"],
    "content" => $guide["content"],
    "is_new_guide" => FALSE
])