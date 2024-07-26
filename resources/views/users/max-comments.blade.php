<!DOCTYPE html>
<html>
<head>
    <title>Max Comments per User</title>
</head>
<body>
    <h1>Max Comments per User</h1>

    <p>Max Comments by a User: {{ $maxComments }}</p>

    @foreach($users as $user)
        <h2>{{ $user->name }} ({{ $user->comments->count() }} comments)</h2>
        <ul>
            @foreach($user->comments as $comment)
                <li>{{ $comment->content }}</li>
            @endforeach
        </ul>
    @endforeach
</body>
</html>
