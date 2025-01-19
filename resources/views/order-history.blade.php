@extends('master')

@section('content')
<div class="container">
    <h1>Order History</h1>

    @if($orders->isEmpty())
        <p>You have no orders yet.</p>
    @else
        @foreach($orders as $order)
            <div class="order">
                <h2>Order #{{ $order->id }}</h2>
                <p>Total: {{ $order->total }}</p>
                <p>Status: {{ $order->status }}</p>
                <p>Placed on: {{ $order->created_at }}</p>

                <h3>Items:</h3>
                <ul>
                    @foreach($order->orderitem as $item)
                        <li>
                            <strong>{{ $item->product->name }}</strong>
                            <br>Quantity: {{ $item->quantity }}
                            <br>Price: {{ $item->price }}
                        </li>
                    @endforeach
                </ul>
            </div>
            <hr>
        @endforeach
    @endif
</div>
@endsection