@extends('master')

@section('content')
<div class="container">
    <h1>Purchase Product</h1>
    <h2>{{ $product->name }}</h2>
    <p>Price: {{ $product->price }}</p>
    <p>Description: {{ $product->description }}</p>

    <form method="POST" action="{{ route('purchase', $product->id) }}">
        @csrf
        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" class="form-control" min="1" required>
        </div>
        <button type="submit" class="btn btn-primary">Buy Now</button>
    </form>
</div>
@endsection