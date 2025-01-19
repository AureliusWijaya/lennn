@extends('master') 

@section('content')
<div class="container mt-4">
    <h1>Search Results</h1>

    @if ($results->isEmpty())
        <p>No results found.</p>
    @else
        <ul>
            @foreach ($results as $result)
                <li>
                    <a href="{{ route('product.detail', $result->id) }}">
                        {{ $result->name ?? 'Untitled' }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection