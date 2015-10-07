<?php
function placeholderize($width, $height){
	$text_size = ($width>$height)? ($height / 10) : ($width / 10) ;
	$my_img = imagecreate( $width, $height );
	$background = imagecolorallocate( $my_img, 0, 0, 255 );
	$text_color = imagecolorallocate( $my_img, 255, 255, 255 );
	imagestring( $my_img, $text_size, ($width/2)-($text_size * 2.75), ($height/2) - ($text_size * 0.2), "$width x $height", $text_color );

	header( "Content-type: image/png" );
	imagepng( $my_img );
	imagecolordeallocate( $text_color );
	imagecolordeallocate( $background );
	imagedestroy( $my_img );
}

if(isset($_GET)){
	$thewidth = $_GET["width"];
	$theheight = $_GET["height"];
	placeholderize($thewidth, $theheight);
	exit;
}
?>
