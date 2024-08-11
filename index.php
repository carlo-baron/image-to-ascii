<?php
    $image = imagecreatefromjpeg("path/to/image");
    
    $max_width = imagesx($image);
    $max_height = imagesy($image);

    $new_width = 200;

    $new_height = $new_width / ($max_width / $max_height);

    $image = imagescale($image, $new_width, $new_height);

    $scaled_width = imagesx($image);
    $scaled_height = imagesy($image);
    echo "<pre>";

    for ($j = 0; $j < $scaled_height; $j++) {
        for ($i = 0; $i < $scaled_width; $i++) {
            $color_index = imagecolorat($image, $i, $j);

            // Convert to RGB
            $r = ($color_index >> 16) & 0xFF;
            $g = ($color_index >> 8) & 0xFF;
            $b = $color_index & 0xFF;

            // Convert to grayscale
            $gray = 0.299 * $r + 0.587 * $g + 0.114 * $b;

            if ($gray <= 51) {
                echo "#";
            } elseif ($gray >= 52 && $gray <= 102) {
                echo "%";
            } else if ($gray >= 103 && $gray <= 153) {
                echo "@";
            } elseif ($gray >= 154 && $gray <= 204) {
                echo "/";
            } else {
                echo ".";
            }
        }
        echo "\n";
    }

    echo "</pre>";

    imagedestroy($image);
?>
