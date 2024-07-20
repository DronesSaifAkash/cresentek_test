@extends('layouts.app')

@section('content')
    <h1>Create New Post</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}">
        </div>
        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description">{{ old('description') }}"></textarea>
        </div>
        <div>
            <label for="comments">Comments:</label>
            <textarea id="comments" name="comments">{{ old('comments') }}"></textarea>
        </div>
        <button type="submit">Submit</button>
    </form>
@endsection
