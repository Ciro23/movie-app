<?php
if (isset($_POST['includeCheck'])) {
    include __DIR__ . "/../../../app/included/cast.included.php";
} else {
    header("Location: /page-not-found");
}

?>