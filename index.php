<?php

//content type
header('Content-Type: image/png');

//font
$font = 'arial.ttf';
//font size
$font_size = 16;
//image width
$width = 250;
//text margin
$margin = 5;

//text
$text = "That is why where when why and how, and now why where when why and how? That is why where when why and how, and now why where when why and how?";

//explode text by words
$text_a = explode(' ', $text);
$text_new = '';
foreach($text_a as $word){
    //Create a new text, add the word, and calculate the parameters of the text
    $box = imagettfbbox($font_size, 0, $font, $text_new.' '.$word);
    //if the line fits to the specified width, then add the word with a space, if not then add word with new line
    if($box[2] > $width - $margin*2){
        $text_new .= "\n".$word;
    } else {
        $text_new .= " ".$word;
    }
}
//trip spaces
$text_new = trim($text_new);
//new text box parameters
$box = imagettfbbox($font_size, 0, $font, $text_new);
//new text height
$height = $box[1] + $font_size + $margin * 2;

//create image
$image=$_SERVER['DOCUMENT_ROOT']."/imagePhp/";

$im = imagecreatetruecolor($width, $height);

//create colors
$white = imagecolorallocate($im, 255, 255, 255);
$black = imagecolorallocate($im, 0, 0, 0);
//color image
imagefilledrectangle($im, 0, 0, $width, $height, $white);

//add text to image
imagettftext($im, $font_size, 0, $margin, $font_size+$margin, $black, $font, $text_new);


$image_original = imagecreatefromjpeg($image.'capture.jpg');
imagecopymerge($image_original,$im , 700, 20, 0, 0, $width, $height, 75);

imagejpeg($image_original,$image.'capture_final.jpg',80);
//frees any memory associated with image
imagedestroy($image_original);
imagedestroy($im);
?>

