@extends('layouts.app')

@section('content')
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->description }}</p>
    <p>{{ $post->comments }}</p>
    <a href="{{ route('posts.index') }}">Back to Posts</a>
@endsection
