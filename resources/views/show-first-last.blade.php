<!DOCTYPE html>
<html>
<head>
    <title>Show First and Last Item</title>
</head>
<body>
    <h1>Items List</h1>
    <ul>
        @foreach ($items as $item)
            @if ($loop->first)
                <li>First item: {{ $item }}</li>
            @elseif ($loop->last)
                <li>Last item: {{ $item }}</li>
            @endif
        @endforeach
    </ul>
</body>
</html>
