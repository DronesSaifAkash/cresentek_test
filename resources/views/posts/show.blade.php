@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-3">{{ $post->title }}</h1>
        <p class="lead">{{ $post->description }}</p>
        
        <a class="btn btn-secondary" href="{{ route('posts.index') }}">Back to Posts</a>
    </div>
@endsection
