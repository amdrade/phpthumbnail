<?php
include 'Thumbnail.php';

$oThumb = new Thumbnail();

$src = __DIR__.'/image/nfsw_1.jpg';
$dest = __DIR__.'/thumb/thumb_nfsw_1.jpg';
$desired_width = 256;
$oThumb->makeTumb($src, $dest, $desired_width);
