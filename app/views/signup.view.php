<!DOCTYPE html>
<html lang="<?= $_COOKIE['language'] ?>" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Signup - Movie App</title>

        <!-- styles and other files -->
        <?php include_once __DIR__ . "/../included/common.included.php" ?>
        <link rel="stylesheet" href="/assets/styles/css/login-signup.style.css">
    </head>

    <body>
        <?php include_once __DIR__ . "/../included/nav-bar.included.php" ?>

        <div class="login-signup-container">
            <div class="form-container" id="signup">
                <h1><?= $lang['signup_form']['signup'] ?></h1>
                <p class="error"><?= $data['error'] ?></p>
                <form action="/signup/action" method="POST">
                    <input type="text" name="username" maxlength="20" placeholder="Username (2-20 <?= $lang['signup_form']['username'] ?>)" value="<?= $data['username'] ?>">
                    <input type="password" name="password" maxlength="64" placeholder="Password (6-64 <?= $lang['signup_form']['password'] ?>)">
                    <input type="password" name="repassword" maxlength="64" placeholder="<?= $lang['signup_form']['confirm_password'] ?> password">
                    <input type="submit" value="<?= $lang['signup_form']['signup'] ?>">
                </form>
            </div>
            <a href="/login"><?= $lang['signup_form']['already_registered'] ?></a>
        </div>
        <?php include_once __DIR__ . "/../included/footer.included.php" ?>
    </body>
</html>