<?php
function placeholderize2($width, $height){
  $dog_file = "http://cv1.culturedvultures.netdna-cdn.com/wp-content/uploads/2015/05/hollywire.jpeg";
  // Get $dog_file dimensions
  list($dog_width, $dog_height) = getimagesize($dog_file);

  // Aspect Ratio Calculators
  $hwaspect = $width/$height;
  $whaspect = $height/$width;

  if($whaspect > $hwaspect){
    $new_height = $height;
    $new_width = $width * $hwaspect;
  } else {
    $new_width = $width;
    $new_height = $height * $whaspect;
  }

  // Create blank canvas image
	$img_01 = imagecreate( $width, $height );
  $img_02 = imagecreate( $width, $height );
  // Create image from $dog_file
  $img_03 = imagecreatefromjpeg($dog_file);

  // Resize Dog Image
  imagecopyresized($img_02, $img_03, 0, 0, 0, $new_height/2, $width, $height, $new_width, $new_height);

  // Set text size and color
  $text_size = ($width>$height)? ($height / 10) : ($width / 10) ;
  $text_color = imagecolorallocate( $my_img, 255, 255, 255 );

  // Overlay text on image
  imagestring( $img_01, $text_size, ($width/2)-($text_size * 2.75), ($height/2) - ($text_size * 0.2), "$width x $height", $text_color );

  header( "Content-type: image/jpeg" );
  imagejpeg($img_02);
  imagecolordeallocate( $text_color );
  imagedestroy( $my_img );

}

function placeholderize($width, $height){
	$text_size = ($width>$height)? ($height / 10) : ($width / 10) ;
	$my_img = imagecreate( $width, $height );
	$background = imagecolorallocate( $my_img, 190, 190, 190 );
	$text_color = imagecolorallocate( $my_img, 150, 150, 150 );
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
