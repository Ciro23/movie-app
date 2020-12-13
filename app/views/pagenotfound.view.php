<!DOCTYPE html>
<html lang="<?= $_COOKIE['language']?>" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- styles and other files -->
        <?php include __DIR__ . "/../included/common.included.php" ?>
        <link rel="stylesheet" href="/assets/styles/css/page-not-found.style.css">

        <title><?= $lang['page_not_found'] ?> - MVC</title>
    </head>
    <body>
        <?php include __DIR__ . "/../included/nav-bar.included.php" ?>
        <p><?= $lang['page_not_found'] ?></p>
    </body>
</html>