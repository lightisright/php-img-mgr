<?php

include("config.php");

/**
 * Tells photoframe slideshow to change directory
 */

if ( strlen($_GET['dir']) ) {
  $res = shell_exec($config['slideshowbin'].' '.$_GET['dir']);
}

if ( $res !== NULL ) {
    header('HTTP/1.0 200 OK');
    echo "New photoframe slideshow directory set !";
}
else {
    header('HTTP/1.0 403 Forbidden');
    echo "Save data : wrong file access conditions !";
}


