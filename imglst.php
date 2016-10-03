<?php

/**
 * Returns JSON image list of given directory
 * imgID => image name
 * filename => http image path
 */

include('config.php');

$dir = $_GET['dir'];
$imglst = array();

$imgdir = rtrim($config['imgdir'].'/'.$config['imgsubdir'],'/').'/'.$dir;
$imghttpdir = trim($config['imghttpdir'].'/'.$config['imgsubdir'],'/').'/'.$dir;

if ($handle = opendir($imgdir)) {
    while (false !== ($entry = readdir($handle))) {
        if (is_file($imgdir.'/'.$entry)) {
            $imglst[] = array('imgID'=>$entry, 'filename'=>$imghttpdir.'/'.$entry);
        }
    }
    closedir($handle);
}

header('Content-Type: application/json');
echo json_encode($imglst);

?>
