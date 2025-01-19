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

<h2>Comments:</h2>
@foreach($product->comments as $comment)
    <div class="comment">
        <strong>{{ $comment->user->username }}:</strong>
        <p>{{ $comment->content }}</p>
    </div>
@endforeach


<h2>Votes:</h2>
@foreach($product->votes as $comment)
    <div class="comment">
        <strong>{{ $comment->vote}}</strong>
    </div>
@endforeach

<form method="POST" action="{{ route('comment.add', $product->id) }}">
    @csrf
    <div class="form-group">
        <label for="content">Add a Comment:</label>
        <textarea id="content" name="content" class="form-control" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<h2>Rate this Product:</h2>
<form method="POST" action="{{ route('vote.add', $product->id) }}">
    @csrf
    <div class="form-group">
        <label for="vote">Your Rating (1-5):</label>
        <input type="number" id="vote" name="vote" class="form-control" min="1" max="5" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection