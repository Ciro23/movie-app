<?php

function imageExists($image, $width, $replace = "none") {
    if ($replace == "none") {
        $replace = $_ENV['defaultImgPath'];
    }

    if ($image == null) {
        return $replace;
    } else {
        return $_ENV['imageBaseUrl'] . $width . $image;
    }
}