<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $targetWidth = 113;
    $targetHeight = 113;

    $uploadedFile = $_FILES["photo"]["tmp_name"];

    list($width, $height) = getimagesize($uploadedFile);

    $aspectRatio = $width / $height;

    if ($width > $height) {
        $newWidth = $targetWidth;
        $newHeight = $targetWidth / $aspectRatio;
    } else {
        $newHeight = $targetHeight;
        $newWidth = $targetHeight * $aspectRatio;
    }

    $resizedImage = imagecreatetruecolor($targetWidth, $targetHeight);

    $sourceImage = imagecreatefromstring(file_get_contents($uploadedFile));

    imagecopyresampled(
        $resizedImage,
        $sourceImage,
        0,
        0,
        0,
        0,
        $targetWidth,
        $targetHeight,
        $width,
        $height
    );

    header("Content-Type: image/png");
    header("Content-Disposition: attachment; filename=resized_photo.png");

    imagepng($resizedImage);
    
    imagedestroy($sourceImage);
    imagedestroy($resizedImage);
}
?>
