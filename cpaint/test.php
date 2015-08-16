<?php

$path = 'uploads/chuck.jpg';
$type = pathinfo($path, PATHINFO_EXTENSION);
// $data = file_get_contents($path);
// $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
// echo $base64;

// header('Content-Type: image/' . $type);

// Get new sizes
list($width, $height) = getimagesize($path);
$newwidth  = 570;
$newheight = 370;

// // Load
// $thumb = imagecreatetruecolor($newwidth, $newheight);
// $source = imagecreatefromjpeg($filename);

// // Resize
// imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
// 'jpeg'    =>    array('image/jpeg', 'image/pjpeg'),
//     'jpg'    =>    array('image/jpeg', 'image/pjpeg'),
//     'jpe'    =>    array('image/jpeg', 'image/pjpeg'),
//     'png'    =>    array('image/png',  'image/x-png'),
switch ($type) {
    case 'jpeg':
    case 'jpg':
    case 'jpe':
        // header('Content-Type: image/jpeg');
        $thumb  = imagecreatetruecolor($newwidth, $newheight);
        $source = imagecreatefromjpeg($path);
        imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        ob_start(); 
        imagejpeg($thumb);
        imagedestroy($thumb); 
        $data = ob_get_clean();
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        echo $base64;
    break;
    case 'png':
        // header('Content-Type: image/png');
        $thumb  = imagecreatetruecolor($newwidth, $newheight);
        $source = imagecreatefrompng($path);
        imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        ob_start(); 
        imagepng($thumb);
        imagedestroy($thumb); 
        $data = ob_get_clean();
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        echo $base64;
    break;
    case 'gif':
        // header('Content-Type: image/gif');
        $thumb  = imagecreatetruecolor($newwidth, $newheight);
        $source = imagecreatefromgif($path);
        imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        ob_start(); 
        imagegif($thumb);
        imagedestroy($thumb); 
        $data = ob_get_clean();
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        echo $base64;
    break;
}

