<?php
$image = imagecreatetruecolor(200, 200);

// Transparent Background
imagealphablending($image, false);
$transparency = imagecolorallocatealpha($image, 0, 0, 0, 127);
imagefill($image, 0, 0, $transparency);
imagesavealpha($image, true);
$black = imagecolorallocatealpha($image, 0, 0, 0,1);
$grey = imagecolorallocatealpha($image, 220, 220, 220,1);
$random = imagecolorallocatealpha($image, rand(0,255),  rand(0,255),  rand(0,255),1);
$red = imagecolorallocatealpha($image, 255, 0, 0,1);
$white = imagecolorallocatealpha($image, 255, 255, 255,1);
ImageFilledEllipse($image, 100, 100, 140, 80, $white); 
ImageEllipse($image, 100, 100, 140, 80, $grey);
// draw a filled ellipse
ImageFilledEllipse($image, 100, 100, 50, 50, $random);
ImageFilledEllipse($image, 100, 100, 10, 10, $black);

imageline($image, 35,115, 70, 98, $red);
imageline($image, 55, 106,46,115, $red);
imageline($image, 49,93, 75, 98, $red);
imageline($image, 59,96, 65, 89, $red);
imageline($image, 126,98, 134,90, $red);
imageline($image, 127,98, 144,110, $red);
imageline($image, 145,111, 154,106, $red);
imageline($image, 145,111, 150,119, $red);

imagestring($image, 5, 10, 0, 'Look me ind the eye!', $black);
imagestring($image, 5, 10, 180, 'and say i am not high!', $black);
header('Content-Type: image/png');
imagepng($image);
// send the new PNG image to the browser
ImagePNG($im); 
 
// destroy the reference pointer to the image in memory to free up resources
ImageDestroy($im);
?>