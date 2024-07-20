@extends('layouts.app')

@section('content')
    <h1>Edit Post</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="{{ $post->title }}">
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description">{{ $post->description }}</textarea>
        </div>
        <div>
            <label for="comments">Comments:</label>
            <textarea id="comments" name="comments">{{ $post->comments }}</textarea>
        </div>
        <button type="submit">Update</button>
    </form>
@endsection
