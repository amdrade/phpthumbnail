<?php

class Thumbnail {

    private static $allowedTypes = [IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_BMP];
    private $JPEGQuality = 75;

    public function makeTumb($src, $dest, $desired_width) {
        $aImage = $this->imageCreateFromAny($src);

        if (!$aImage) {
            return false;
        }

        $source_image = $aImage['image'];
        $type = $aImage['type'];
        $width  = imagesx($source_image);
        $height = imagesy($source_image);

        $desired_height = floor($height * ($desired_width / $width));

        $virtual_image = imagecreatetruecolor($desired_width, $desired_height);

        if($type == IMAGETYPE_GIF || $type == IMAGETYPE_PNG){
            imagecolortransparent($virtual_image, imagecolorallocatealpha($virtual_image, 0, 0, 0, 127));
            imagealphablending($virtual_image, false);
            imagesavealpha($virtual_image, true);
        }

        imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);

        $img_saved = $this->imageSave($virtual_image, $dest, $type);

        imagedestroy($virtual_image);

        return $img_saved;
    }

    private function imageSave($virtual_image, $dest, $type) {
        switch ($type) {
            case IMAGETYPE_GIF :
                $img_saved = imagegif($virtual_image, $dest);
                break;
            case IMAGETYPE_JPEG :
                $img_saved = imagejpeg($virtual_image, $dest, $JPEGQuality);
            case IMAGETYPE_PNG :
                $img_saved = imagepng($virtual_image, $dest);
                break;
            case IMAGETYPE_BMP :
                $img_saved = imagewbmp($virtual_image, $dest);
                break;
        }

        return $img_saved;
    }

    private function imageCreateFromAny($src) {
        $type = exif_imagetype($src);

        if (!in_array($type, self::$allowedTypes)) {
            return false;
        }
        switch ($type) {
            case IMAGETYPE_GIF :
                $rImage = imageCreateFromGif($src);
                break;
            case IMAGETYPE_JPEG :
                $rImage = imageCreateFromJpeg($src);
                break;
            case IMAGETYPE_PNG :
                $rImage = imageCreateFromPng($src);
                break;
            case IMAGETYPE_BMP :
                $rImage = imageCreateFromBmp($src);
                break;
        }
        return ['image' => $rImage, 'type' => $type];
    }
}

