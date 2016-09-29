<?php

class JsonImgList {

  public $filename;
  protected $data = array();

  public function __construct() {
    $this->filename = __DIR__."/../php-img-mgr.json";
    $this->data = json_decode(file_get_contents($this->filename),true);
  }

  private function store($key, $dir, $img) {
    if ( !in_array($img, $this->data[$key][$dir]) ) {
      $this->data[$key][$dir][] = $img;
    }
  }

  public function printImg($dir, $img) {
    $this->store('print', $dir, $img);
  }

  public function deleteImg($dir, $img) {
    $this->store('delete', $dir, $img);
  }

  public function getJson() {
    header("Content-Type: application/json");
    echo json_encode($this->data);
  }

  public function __destruct() {
    if ( file_put_contents($this->filename, json_encode($this->data)) === FALSE ) {
      header('HTTP/1.0 403 Forbidden');
      echo "Save data : wrong file access conditions !";
    }
  }

}

