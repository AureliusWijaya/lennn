<h1>Edit Product</h1>



<form action="{{route('product.update', $product->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <input type="text" name="name" id="name" placeholder="name" value="{{old('name', $product->name)}}">
    <label for="name">Name</label>
    <br>
    <input type="text" name="price" id="price" placeholder="price" value="{{old('price', $product->price)}}">
    <label for="content">Price</label>
    <br>

    <input type="text" name="description" id="description" placeholder="description">
    <label for="content">Description</label>
    <br>

    <select name="category_id">
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>



    <input type="file" name="image" id="image">
    <label for="image">image</label>
    <button type="submit">submit</button>
</form>