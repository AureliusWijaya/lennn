<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="{{route('register.store')}}" method="POST">
        @csrf
        <input type="text" id="username" name="username" placeholder="username">
        <label for="username">Username</label>

        <input type="password" id="password" name="password" placeholder="password">
        <label for="username">password</label>

        <input type="email" id="email" name="email" placeholder="email">
        <label for="username">email</label>

        <button type="submit">submit</button>
    </form>
</body>

</html>