<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

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


    <a href="{{route('lang.switch', ['locale' => 'en'])}}">English</a>
    <a href="{{route('lang.switch', ['locale' => 'id'])}}">Id</a>


    <form action="{{route('logout')}}" method="POST">
        @csrf
        <button> Logout ini</button>
    </form>
    <h1>@lang('Whoops!')</h1>
    @if (Auth::user())
        <h1>{{Auth::user()->email}}</h1>
    @endif

    @foreach ($articles as $i)
        <h1>
            {{$i->title}}
        </h1>
        <a href="{{route('article.show', $i->id) }}">
            <img src="{{asset('images/' . $i->image)}}">
        </a>

    @endforeach
</body>

</html>