<?php
include 'Thumbnail.php';

$oThumb = new Thumbnail();

$src = __DIR__.'/image/nfsw_1.jpg';
$dest = __DIR__.'/thumb/thumb_nfsw_1.jpeg';
$desired_width = 256;
$img_saved = $oThumb->makeTumb($src, $dest, $desired_width);
if ($img_saved) {
	echo '<pre>'; print_r($src); echo '</pre>';
	echo '<pre>'; print_r($dest); echo '</pre>';
}

$src = __DIR__.'/image/nfsmw.png';
$dest = __DIR__.'/thumb/thumb_nfsmw.png';
$img_saved = $oThumb->makeTumb($src, $dest, $desired_width);
if ($img_saved) {
	echo '<pre>'; print_r($src); echo '</pre>';
	echo '<pre>'; print_r($dest); echo '</pre>';
}
