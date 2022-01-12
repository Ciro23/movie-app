<!DOCTYPE html>
<html lang="us" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Movie App</title>

    <!-- styles and other files -->
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Paaji+2:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,531;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,531;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Arimo:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

    <!-- common style files -->
    <link rel="stylesheet" href="/public/assets/styles/css/common.style.css">
    <link rel="stylesheet" href="/public/assets/styles/css/nav-bar.style.css">
    <link rel="stylesheet" href="/public/assets/styles/css/footer.style.css">

    <?php
    $_COOKIE['language'] = "us";

    $languages = [
        "En" => "us",
        "It" => "it",
        "Fr" => "fr",
        "Es" => "es",
        "De" => "de"
    ];
    include_once __DIR__ . "/../views/languages/" . $_COOKIE['language'] . ".lang.php";
    ?>
    <link rel="stylesheet" href="/assets/styles/css/home.style.css">

    <!-- movie grid animation script -->
    <script src="/assets/js-scripts/movie-grid.script.js"></script>
</head>

<body>
    <div class="nav-bar">
        <div>
            <a href="/">
                <img src="/assets/icons/logo.icon.png">
            </a>
            <input class="search-bar" type="text" placeholder="<?= $lang['search_bar'] ?>">
            <span>
                <?php
                if (isset($_SESSION['username'])) {
                    echo "<a href='/user/" . $_SESSION['username'] . "'>" . $_SESSION['username'] . "</a>";
                } else {
                    echo "<a href='/login'>Login</a>";
                }
                ?>
                <select class="languages">
                    <?php
                    foreach ($languages as $key => $value) {
                        if ($value == $_COOKIE['language']) {
                            $selected = "selected";
                        } else {
                            $selected = "";
                        }

                        echo "<option value='$value' $selected>" . $key . "</option>";
                    }
                    ?>
                </select>
            </span>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $(".search-bar").bind("keypress", function(e) {
                if (e.keyCode == 13) {
                    var query = $(this).val();
                    window.location.href = "/search/" + query;
                }
            });

            // saves the current language in the cookies and update the page
            $(".languages").on("change", function() {
                var language = $(this).val();
                document.cookie = "language = " + language + "; expires=Thu, 18 Dec 2023 12:00:00 UTC; path=/";
                location.reload();
            });
        });
    </script>