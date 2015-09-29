<?php
header('Content-Type: image/png');
$w = 400;
$h = 40;
$im = imagecreatetruecolor($w, $h);
$white = imagecolorallocate($im, 255, 255, 255);
$grey = imagecolorallocate($im, 128, 128, 128);
$black = imagecolorallocate($im, 0, 0, 0);
imagefilledrectangle($im, 0, 0, $w, $h, $white);
$num01 = rand(10,50);
$num02 = rand(10,50);
$num03 = $num01 + $num02;
$text = $num01 . ' + ' . $num02;
$font = 'fonts/arial.ttf';
imagettftext($im, 20, 0, 10, 20, $black, $font, $text);
imagettftext($im, 10, 0, 10, 40, $black, $font, 'escreve o resultado númerico em baixo (números não palavras)');
imagepng($im);
imagedestroy($im);
//----------------------------------------------------------------------------------------------------------------------
function imagefillroundedrect($im,$x,$y,$cx,$cy,$rad,$col) {
// Draw the middle cross shape of the rectangle
    imagefilledrectangle($im,$x,$y+$rad,$cx,$cy-$rad,$col);
    imagefilledrectangle($im,$x+$rad,$y,$cx-$rad,$cy,$col);
    $dia = $rad*2;
// Now fill in the rounded corners
    imagefilledellipse($im, $x+$rad, $y+$rad, $rad*2, $dia, $col);
    imagefilledellipse($im, $x+$rad, $cy-$rad, $rad*2, $dia, $col);
    imagefilledellipse($im, $cx-$rad, $cy-$rad, $rad*2, $dia, $col);
    imagefilledellipse($im, $cx-$rad, $y+$rad, $rad*2, $dia, $col);
}
//----------------------------------------------------------------------------------------------------------------------
/*
header("Content-Type: image/png");
$im = @imagecreate(200, 40)
    or die("Cannot Initialize new GD image stream");
$background_color = imagecolorallocate($im, 255, 255, 255);
$text_color = imagecolorallocate($im, 0, 0, 0);
imagestring($im, 3, 5, 5,  "50 + 34", $text_color);
imagestring($im, 1, 5, 20,  "escreve o resultado em baixo", $text_color);
imagepng($im);
imagedestroy($im);

*/
?>
