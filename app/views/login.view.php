<!DOCTYPE html>
<html lang="<?= $_COOKIE['language']?>" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login - Movie App</title>

        <!-- styles and other files -->
        <?php include __DIR__ . "/../included/common.included.php" ?>
        <link rel="stylesheet" href="/assets/styles/css/login-signup.style.css">
    </head>
    <body>
        <?php include __DIR__ . "/../included/nav-bar.included.php" ?>

        <div class="login-signup-container">
            <div class="form-container" id="login">
                <h1>Login</h1>
                <p class="error"><?= $data['error'] ?></p>
                <form action="/login/action" method="POST">
                    <input type="text" name="username" placeholder="Username" value="<?= $data['username'] ?>">
                    <input type="password" name="password" placeholder="Password">
                    <input type="submit" value="Login">
                </form>
            </div>
            <a href="/signup">Need to signup?</a>
        </div>
    </body>
</html>