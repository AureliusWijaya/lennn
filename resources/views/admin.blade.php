@extends('master')
@section('content')

@foreach ($products as $i)
    <div>
        <div class="container">
            <h1>{{$i->name}}</h1>
            <h1>{{$i->price}}</h1>
            <h1>{{$i->description}}</h1>
            <h1>{{$i->category->name}}</h1>
            <a href="{{route('product.show', $i->id) }}">
                <img src="{{asset('images/' . $i->image)}}">
            </a>
            <form action="{{route('product.delete', $i->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">delete</button>
            </form>
        </div>
    </div>

@endforeach

<br>

<div class="container">
    <h1>Create Product</h1>
    <form action="{{route('article.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="name" id="name" placeholder="name">
        <label for="name">Name</label>
        <br>
        <input type="text" name="price" id="price" placeholder="price">
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
</div>
@endsection