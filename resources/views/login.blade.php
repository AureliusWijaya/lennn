<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="{{route('login.store')}}" method="POST">
        @csrf

        <input type="email" id="email" name="email" placeholder="email">
        <label for="username">email</label>

        <input type="password" id="password" name="password" placeholder="password">
        <label for="username">password</label>

        <button type="submit">submit</button>
    </form>
</body>

</html>