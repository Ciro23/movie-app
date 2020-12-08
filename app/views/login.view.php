<!DOCTYPE html>
<html lang="<?= $_COOKIE['language']?>">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - Movie App</title>
    </head>
    <body>
        <form action="/login/action" method="POST">
            <input type="text" name="username" placeholder="username">
            <input type="password" name="password" placeholder="password">
            <input type="submit" value="login">
        </form>
    </body>
</html>