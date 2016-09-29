<?php

include('config.php');

$dirlst = array();
$dirlst[] = array('dirID'=>'', 'dirname'=>'Select album');

if ($handle = opendir($config['imgdir'])) {
    while (false !== ($entry = readdir($handle))) {
        if (is_dir($config['imgdir'].'/'.$entry) && $entry != "." && $entry != "..") {
            $dirlst[] = array('dirID'=>$entry, 'dirname'=>$entry);
        }
    }
    closedir($handle);
}

header('Content-Type: application/json');
echo json_encode($dirlst);

?>
