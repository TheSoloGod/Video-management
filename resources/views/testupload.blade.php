<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Google Drive Demo</title>
</head>
<body>
<form action="{{ route('post.file') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file">
    <br><br>
    <button type="submit">Upload</button>
</form>
</body>
</html>
