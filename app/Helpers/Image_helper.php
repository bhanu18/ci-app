<?php 
function image_crop($image, $width, $height){

    imagepng(imagecreatefromstring($image), $png_image);

    $im = imagecreatefromjpeg($png_image);
          
        // find the size of image
        $size = min(imagesx($im), imagesy($im));
          
        // Set the crop image size 
        $im2 = imagecrop($im, ['x' => 0, 'y' => 0, 'width' => $width, 'height' => $height]);
        if ($im2 !== FALSE) {
            header("Content-type: image/png");
               imagepng($im2);
            imagedestroy($im2);
        }
        imagedestroy($im);

        return $im2;
}
?>