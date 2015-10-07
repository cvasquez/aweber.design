<?php
/*
    How to use
    /940x278
    /940x278/000000
    /940x278&text=Texto
    /940x278/000000&text=Texto
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ index.php?params=$1 [L]
 */
if( empty($_GET) ) {
    $_GET['params'] ='100x100/CCCCCC';
}
$fontSize = 5;
$params = array_filter( explode( '/', $_GET['params'] ) );
$dimensions = explode( 'x', $params[0] );
$w      = isset($dimensions[0]) ? $dimensions[0] : 100;
$h      = isset($dimensions[1]) ? $dimensions[1] : 100;
$bg     = isset($params[1]) ? $params[1] : 'CCCCCC';
$text   = isset($_GET['text']) ? $_GET['text'] : $w.'x'.$h;
if( $w < 50 ) {
    $fontSize = 1;
}
$im = imagecreatetruecolor($w, $h);
imagefilledrectangle($im, 0, 0, $w, $h, '0x'.$bg);
$fontWidth  = imagefontwidth($fontSize);
$textWidth  = $fontWidth * strlen($text);
$textLeft   = ceil( ($w-$textWidth)/2 );
$fontHeight = imagefontheight($fontSize);
$textHeight = $fontHeight;
$textTop    = ceil( ($h-$textHeight)/2 );
imagestring($im, $fontSize, $textLeft, $textTop, $text, 0x969696);
header('Content-Type: image/gif');
imagegif($im);
imagedestroy($im);
?>

<img src="index2.php?width=200&height=500" />
