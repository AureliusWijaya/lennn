<form action="{{route('article.update', $article->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input type="text" id="title" name="title" placeholder="title" value="{{old('title', $article->title)}}">
    <label for="title">Title</label>
    <br>
    <input type="text" id="content" name="content" placeholder="content" value="{{old('content', $article->content)}}">
    <label for="content">Content</label>
    <br>

    <input type="file" name="image" id="image">
    <label for="image">image</label>
    <br>
    <img src="{{asset('images/' . $article->image)}}">
    <button type="submit">submit</button>
</form>