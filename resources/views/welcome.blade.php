<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}" defer></script>
</head>
@extends('master')
@section('content')

<body>

    @if(session('success'))
        <div class="">
            {{session('success')}}
        </div>
    @elseif(session('error'))
        <div>
            {{session('error')}}
        </div>
    @endif

    <h1> Localization ini: @lang('Whoops!')</h1>

    <!-- tinggal pake Auth::user()->"data yang mo diambil"  -->
    <!-- @if (Auth::user())
        <h1>{{Auth::user()->email}}</h1>
        <h1>{{Auth::user()->password}}</h1>
        <h1>{{Auth::user()->role}}</h1>
    @endif -->

    @foreach ($articles as $i)
        <div>
            <h1>
                {{$i->title}}
            </h1>
            <a href="{{route('article.show', $i->id) }}">
                <img src="{{asset('images/' . $i->image)}}">
            </a>

            <form action="{{route('article.delete', $i->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">delete</button>

            </form>
        </div>

    @endforeach
</body>

@endsection

</html>