<!DOCTYPE html>
<html lang="<?= $_COOKIE['language']?>" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Signup - Movie App</title>

        <!-- styles and other files -->
        <?php include __DIR__ . "/../included/common.included.php" ?>
        <link rel="stylesheet" href="/assets/styles/css/login-signup.style.css">
    </head>
    <body>
        <?php include __DIR__ . "/../included/nav-bar.included.php" ?>

        <div class="login-signup-container">
            <div class="form-container" id="signup">
                <h1>Signup</h1>
                <p class="error"><?= $data['error'] ?></p>
                <form action="/signup/action" method="POST">
                    <input type="text" name="username" maxlength="20" placeholder="Username (2-20 characters, only letters and numbers)" value="<?= $data['username'] ?>">
                    <input type="password" name="password" maxlength="64" placeholder="Password (6-64 characters)">
                    <input type="password" name="repassword" maxlength="64" placeholder="Confirm password">
                    <input type="submit" value="Signup">
                </form>
            </div>
            <a href="/login">Already registered?</a>
        </div>
    </body>
</html>