<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="{{route('article.store')}}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="text" id="title" name="title" placeholder="title">
        <label for="title">Title</label>
        <br>
        <input type="text" id="content" name="content" placeholder="content">
        <label for="content">Content</label>
        <br>

        <input type="file" name="image" id="image">
        <label for="image">image</label>
        <button type="submit">submit</button>
    </form>
</body>

</html>