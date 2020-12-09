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
$languages = ["En" => "us",
              "It" => "it",
              "Fr" => "fr",
              "Es" => "es",
              "De" => "de"];
include_once __DIR__ . "/../views/languages/" . $_COOKIE['language'] . ".lang.php";
?>
