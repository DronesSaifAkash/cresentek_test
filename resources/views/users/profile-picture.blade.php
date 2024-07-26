<!DOCTYPE html>
<html>
<head>
    <title>Upload Profile Picture</title>
</head>
<body>
    <h1>Upload Profile Picture</h1>

    @if(session('message'))
        <p>{{ session('message') }}</p>
    @endif

    <form action="{{ url('/user/' . $user->id . '/profile-picture') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="profile_picture">Choose a profile picture:</label>
        <input type="file" name="profile_picture" id="profile_picture" required>
        <button type="submit">Upload</button>
    </form>

    @if($user->profile_picture)
        <h2>Current Profile Picture:</h2>
        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile Picture" style="width: 150px; height: 150px;">
    @endif
</body>
</html>
