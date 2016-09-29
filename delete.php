<?php

include("inc/JsonImgList.php");

$o = new JsonImgList();

// Print request : register image into JSON
if ( strlen($_GET['dir']) && strlen($_GET['id']) ) {
  $o->deleteImg($_GET['dir'],$_GET['id']);
}


$o->getJson();


