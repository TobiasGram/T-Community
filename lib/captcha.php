<?php
  session_start();
  header('Content-type: image/jpeg');
  $jpg_image = imagecreatefromjpeg('graphic/captcha.jpg');
  $grey = imagecolorallocate($jpg_image, 135, 135, 135);
  $white = imagecolorallocate($jpg_image, 255, 255, 255);
  $font_path = 'fonts/Vera.ttf';
  $text =   $_SESSION["Captcha"];
  // Print Text On Image

  $x = 0;
  $y = 3;
  $w = imagesx($jpg_image) - 1;
  $z = imagesy($jpg_image) - 1;
  for ($x = 0; $x <= 34; $x++) {
  imageline($jpg_image, rand(0,200),rand(0,200),rand(0,200),rand(0,200), imagecolorallocate($jpg_image, rand(0,255), rand(0,255),rand(0,255)));
  }
  imagettftext($jpg_image, 25, 0, 54, 54, $grey, $font_path, $text);
  imagettftext($jpg_image, 25, 0, 55, 55, $grey, $font_path, $text);
  imagettftext($jpg_image, 25, 0, 56, 56, $grey, $font_path, $text);
  imagettftext($jpg_image, 25, 0, 57, 57, $grey, $font_path, $text);
  imagettftext($jpg_image, 25, 0, 56, 56, $white, $font_path, $text);

  // Send Image to Browser
  imagejpeg($jpg_image);

  // Clear Memory
    imagedestroy($jpg_image);
?> 