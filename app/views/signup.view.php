<!DOCTYPE html>
<html lang="<?= $_COOKIE['language']?>">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Signup - Movie App</title>
    </head>
    <body>
        <form action="/signup/action" method="POST">
            <input type="text" name="username" placeholder="username">
            <input type="password" name="password" placeholder="password">
            <input type="password" name="repassword" placeholder="confirm password">
            <input type="submit" value="signup">
        </form>
    </body>
</html>