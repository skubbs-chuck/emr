<?php

class Model_Image extends Base_Model {
    public $dir_img;

    public function __construct() {
        parent::__construct();
        $this->dir_img = PATH_ROOT . 'uploads' . DS . 'images' . DS;
    }

    public function merge($bg, $image) {
        $bg64 = explode(',', $bg);
        $img64 = explode(',', $image);
        ob_start();
        $bg = imagecreatefromstring(base64_decode($bg64[1]));
        $image = imagecreatefromstring(base64_decode($img64[1]));
        imagecopy($bg, $image, 0, 0, 0, 0, imagesx($bg), imagesy($bg));
        header('Content-type: image/png');
        imagepng($bg);
        $data = ob_get_contents();
        imagedestroy($bg);
        imagedestroy($image);
        ob_end_clean();
        return 'data:image/png;base64,' . base64_encode($data);
    }

    public function base64Resize($base64, $newWidth, $newHeight) {
        $base64 = explode(',', $base64);
        ob_start();
        $image = imagecreatefromstring(base64_decode($base64[1]));
        $thumb = imagecreatetruecolor($newWidth, $newHeight);
        header('Content-type: image/png');
        imagecopyresized($thumb, $image, 0, 0, 0, 0, $newWidth, $newHeight, imagesx($image), imagesy($image));
        imagepng($thumb);
        $data = ob_get_contents();
        imagedestroy($thumb);
        imagedestroy($image);
        ob_end_clean();
        return 'data:image/png;base64,' . base64_encode($data);
    }

    public function img2base64($file, $newWidth = 0, $newHeight = 0) {
        if (file_exists($this->dir_img . $file))
            $file =  $this->dir_img . $file;

        if (!file_exists($file)) 
            return false;

        $info = list($width, $height, $type, $attr, $bits, $mime) = getimagesize($file);

        if (!$info) 
            return false;

        $newWidth  = ((int) $newWidth > 0) ? (int) $newWidth : $width;
        $newHeight = ((int) $newHeight > 0) ? (int) $newHeight : $height;
        $image = imagecreatefromstring(file_get_contents($file));

        ob_start();
        header('Content-type: image/png');
        $thumb  = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresized($thumb, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        imagepng($thumb);
        $data = ob_get_contents();
        imagedestroy($thumb);
        imagedestroy($image);
        ob_end_clean();
        return 'data:image/png;base64,' . base64_encode($data);
    }

}