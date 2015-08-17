<?php

class Model_Image extends Base_Model {
    public $dir_img;

    
    public function __construct() {
        parent::__construct();
        $this->dir_img = PATH_ROOT . 'uploads' . DS . 'images' . DS;
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