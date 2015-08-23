<?php

class Model_Image extends Base_Model {
    public $dir_img;

    
    public function __construct() {
        parent::__construct();
        $this->dir_img = PATH_ROOT . 'uploads' . DS . 'images' . DS;
    }

    public function merge($bg, $image) {
        $result = '';
        $bg64 = explode(',', $bg);
        $img64 = explode(',', $image);

        ob_start();
        $bg = imagecreatefromstring(base64_decode($bg64[1]));
        $image = imagecreatefromstring(base64_decode($img64[1]));

        imagecopy($bg, $image, 0, 0, 0, 0, imagesx($bg), imagesy($bg));

        
        
        header('Content-type: image/png');
        imagepng($bg);
        $result = ob_get_contents();
        imagedestroy($bg);
        // exit;
        ob_end_clean();
        $result = 'data:image/png;base64,' . base64_encode($result);
        return $result;
    }

    // public function base64ById($id)
    

    public function base64($path, $newWidth = 0, $newHeight = 0) {
        $path = $this->dir_img . $path;
        $type = pathinfo($path, PATHINFO_EXTENSION);
        list($width, $height) = getimagesize($path);
        $newWidth  = ((int) $newWidth > 0) ? (int) $newWidth : $width;
        $newHeight = ((int) $newHeight > 0) ? (int) $newHeight : $height;
        $base64 = '';

        switch ($type) {
            case 'jpeg':
            case 'jpg':
            case 'jpe':
                // header('Content-Type: image/jpeg');
                $thumb  = imagecreatetruecolor($newWidth, $newHeight);
                $source = imagecreatefromjpeg($path);
                imagecopyresized($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                ob_start(); 
                imagejpeg($thumb);
                imagedestroy($thumb); 
                $data = ob_get_clean();
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            break;
            case 'png':
                // header('Content-Type: image/png');
                $thumb  = imagecreatetruecolor($newWidth, $newHeight);
                $source = imagecreatefrompng($path);
                imagecopyresized($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                ob_start(); 
                imagepng($thumb);
                imagedestroy($thumb); 
                $data = ob_get_clean();
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            break;
            case 'gif':
                // header('Content-Type: image/gif');
                $thumb  = imagecreatetruecolor($newWidth, $newHeight);
                $source = imagecreatefromgif($path);
                imagecopyresized($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                ob_start(); 
                imagegif($thumb);
                imagedestroy($thumb); 
                $data = ob_get_clean();
                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            break;
        }

        return $base64;
    }

}