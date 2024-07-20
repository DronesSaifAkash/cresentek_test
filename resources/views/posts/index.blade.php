@extends('layouts.app')

@section('content')
    <h1>Blog Posts</h1>
    <a href="{{ route('posts.create') }}">Create New Post</a>

    @if ($message = Session::get('success'))
        <p>{{ $message }}</p>
    @endif

    <ul>
        @foreach ($posts as $post)
            <li>
                <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a>
                <a href="{{ route('posts.edit', $post->id) }}">Edit</a>
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
