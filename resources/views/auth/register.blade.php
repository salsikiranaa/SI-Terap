<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('auth.register') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="name" required><br>
        <input type="email" name="email" placeholder="email" required><br>
        <input type="password" name="password" placeholder="password" required><br>
        <input type="password" name="password_confirmation" placeholder="confirm password" required><br>
        <button type="submit">Register</button>
    </form>
</body>
</html>