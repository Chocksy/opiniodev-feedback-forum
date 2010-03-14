<?php
/**
 * Created and developed by José P. Airosa
 *
 * This file will enable you to automaticaly resize images without loosing quality.
 * It uses a simple math formulas to calculate the desired final size and then rerenders the image.
 *
 * The usage is very simples. On you HTML code just create an image and replace the src with cropimage.php?src=img/myimage.jpg&size=320x240
 *
 * src - the source of the image itself
 * size - the size that the image should have. If the size is not directly compatible with the original size it will display a simple background and the image with
 * the correct size on top.
 *
 * Example: <img src="cropimage.php?src=img/myimage.jpg&size=320x240" alt="" />
 *
 * If it's a square image you can just use myimage.jpg&size=320 and it will make a 320x320 image.
 *
 */
ini_set ( "memory_limit", "64M" );
class cropImage {
	// Initialize variables;
	var $imgSrc, $myImage, $cropHeight, $cropWidth, $x, $y, $thumb, $dif;
	/**
	 * Stage 2: Read the image and check if it is present on our cache folder. If so we'll just use the cached version. Take in account that even if you supply
	 * an image on an external source it will not check the image itself but rather the link, thus, no external connection is made.
	 *
	 * Also check what type of file we're working with. Different files, different methods.
	 *
	 * @param $image The image that it's to crop&scale
	 * @return nothing
	 */
	function setImage($image) {
		// Your Image
		$this->imgSrc = $image;
		// Getting the image dimensions
		list ( $width, $height ) = getimagesize ( $this->imgSrc );
		// Check what file we're working with
		if ($this->getExtension ( $this->imgSrc ) == 'png') {
			//create image png
			$this->myImage = imagecreatefrompng ( $this->imgSrc ) or die ( "Error: Cannot find image!" );
			imagealphablending ( $this->myImage, true ); // setting alpha blending on
			imagesavealpha ( $this->myImage, true ); // save alphablending setting (important)
		} elseif ($this->getExtension ( $this->imgSrc ) == 'jpg' || $this->getExtension ( $this->imgSrc ) == 'jpeg' || $this->getExtension ( $this->imgSrc ) == 'jpe') {
			//create image jpeg
			$this->myImage = imagecreatefromjpeg ( $this->imgSrc ) or die ( "Error: Cannot find image!" );
		}
		// Find biggest length
		if ($width > $height)
			$biggestSide = $width;
		else
			$biggestSide = $height;
		// This will zoom in to 50% zoom (crop!)
                $cropPercent = (empty($_GET['zoom'])) ? '.5' : $_GET['zoom'];
		// Get the size that you submitted for resize on the URL
		$both_sizes = explode ( "x", $_GET ['size'] );
		// Check if it was submited something like 50x50 and not only 50 (wich is also supported)
		if (count ( $both_sizes ) == 2) {
			if ($width > $height) {
				// Apply the cropping formula
				$this->cropHeight = $biggestSide * round ( ($both_sizes [1] * $cropPercent) / $both_sizes [0], 2 );
				$this->cropWidth = $biggestSide * $cropPercent;
			} else {
				// Apply the cropping formula
				$this->cropHeight = $biggestSide * $cropPercent;
				$this->cropWidth = $biggestSide * round ( ($both_sizes [0] * $cropPercent) / $both_sizes [1], 2 );
			}
		} else {
			$this->cropHeight = $biggestSide * $cropPercent;
			$this->cropWidth = $biggestSide * $cropPercent;
		}
		// Getting the top left coordinate
		$this->x = ($width - $this->cropWidth) / 2;
		$this->y = ($height - $this->cropHeight) / 2;
	}
	/**
	 * From a file get the extension
	 *
	 * @param $filename The filename
	 * @return string file extension
	 */
	function getExtension($filename) {
		return $ext = strtolower ( array_pop ( explode ( '.', $filename ) ) );
	}
	/**
	 * For PNG files (and possibly GIF) add transparency filter
	 *
	 * @param $new_image
	 * @param $image_source
	 * @return nothing
	 */
	function setTransparency($new_image, $image_source) {
		$transparencyIndex = imagecolortransparent ( $image_source );
		$transparencyColor = array ('red' => 255, 'green' => 255, 'blue' => 255 );
		if ($transparencyIndex >= 0) {
			$transparencyColor = imagecolorsforindex ( $image_source, $transparencyIndex );
		}
		$transparencyIndex = imagecolorallocate ( $new_image, $transparencyColor ['red'], $transparencyColor ['green'], $transparencyColor ['blue'] );
		imagefill ( $new_image, 0, 0, $transparencyIndex );
		imagecolortransparent ( $new_image, $transparencyIndex );
	}
	/**
	 * Stage 3: Apply the changes and create image resource (new one).
	 *
	 * @return nothing
	 */
	function createThumb() {
		$thumbSizex = $thumbSizey = $_GET ['size'];
		$both_sizes = explode ( "x", $_GET ['size'] );
		if (count ( $both_sizes ) == 2) {
			$thumbSizex = $both_sizes [0];
			$thumbSizey = $both_sizes [1];
		}
		$this->thumb = imagecreatetruecolor ( $thumbSizex, $thumbSizey );
		$bg = imagecolorallocate ( $this->thumb, 255, 255, 255 );
		imagefill ( $this->thumb, 0, 0, $bg );
		imagecopyresampled ( $this->thumb, $this->myImage, 0, 0, $this->x, $this->y, $thumbSizex, $thumbSizey, $this->cropWidth, $this->cropHeight );
		if ($this->getExtension ( $this->imgSrc ) == 'png' && isset ( $_GET ['transparent'] ) && $_GET ['transparent'] == 1) {
			$this->setTransparency ( $this->thumb, $this->myImage );
		}
	}
	/**
	 * Stage 4: Save image in cache and return the new image.
	 *
	 * @return nothing
	 */
	function renderImage() {
		$image_created = "";
		global $size_string;
		if ($this->getExtension ( $this->imgSrc ) == 'png') {
			header ( 'Content-type: image/png' );
			imagepng ( $this->thumb );
			/**
			 * Save image to the cache folder
			 */
			imagepng($this->thumb, 'img_cache/'.$size_string.end(explode("/",$this->imgSrc)));
		} elseif ($this->getExtension ( $this->imgSrc ) == 'jpg' || $this->getExtension ( $this->imgSrc ) == 'jpeg' || $this->getExtension ( $this->imgSrc ) == 'jpe') {
			header ( 'Content-type: image/jpeg' );
			imagejpeg ( $this->thumb );
			/**
			 * Save image to the cache folder
			 */
			imagejpeg($this->thumb,'img_cache/'.$size_string.end(explode("/",$this->imgSrc)));
		}
		imagedestroy ( $this->thumb );
	}
}
// Some variables needed for this to work. We set $size_string as global in order to access it on renderImage()
global $size_string;
// Initialize our Crop Image class
$image = new cropImage ( );
$size_string = "";
$both_sizes = explode ( "x", $_GET ['size'] );
if (count ( $both_sizes ) == 2) {
	$size_string = $both_sizes [0]."x".$both_sizes [1];
} else {
	$size_string = $_GET ['size']."x".$_GET ['size'];
}
/**
 * Atempt to load our cached image. If we can't that means there is no cache for that image. If we find
 * we'll just load that one adn won't even think about cropping and scaling.
 *
 * Stage 1: Read the image and check if it is present on our cache folder. If so we’ll just use the cached version.
 * Take in account that even if you supply an image on an external source it will not check the image itself but rather the link, thus, no external connection is made.
 */
$img_cached = 'img_cache/'.$size_string.end(explode("/",$_GET ['src']));
if(file_exists($img_cached)) {
	if ($image->getExtension ( $img_cached ) == 'png') {
		$myImage = imagecreatefrompng ( $img_cached ) or die ( "Error: Cannot find image!" );
		header ( 'Content-type: image/png' );
		imagepng ( $myImage );
	} elseif ($image->getExtension ( $img_cached ) == 'jpg' || $image->getExtension ( $img_cached ) == 'jpeg' || $image->getExtension ( $img_cached ) == 'jpe') {
		$myImage = imagecreatefromjpeg ( $img_cached ) or die ( "Error: Cannot find image!" );
		header ( 'Content-type: image/jpeg' );
		imagejpeg ( $myImage );
	}
	imagedestroy ( $myImage );
} else {
	$image->setImage ( $_GET ['src'] );
	$image->createThumb ();
	$image->renderImage ();
}
?>


