<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem Pabrik</title>
</head>
<body style="font-family: sans-serif; text-align: center; margin-top: 10px;">

    <h2>Login Sistem Manajemen Pabrik</h2>

    @if(session('error'))
        <p style="color: red;">{{session('error') }}</p>
    @endif

    <form action="/login" method="post" style="display: inline-block; text-align: left; border: 1px solid black; padding: 20px;">
        @csrf
        <label>Email</label>
        <input type="email" name="email" required> <br><br>

        <label for="password">Password</label>
        <input type="password" name="password" required> <br><br>

        <button type="submit">Login</button>

    </form>


    
</body>
</html>
