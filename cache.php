<?php
class Cache {

  function store($key,$data,$ttl) {

    $h = fopen($this->getFileName($key),'w');
    if (!$h) throw new Exception('Could not write to cache'); 
    $data = serialize(array(time()+$ttl,$data));
    if (fwrite($h,$data)===false) {
      throw new Exception('Could not write to cache');
    }
    fclose($h);
  }

  private function getFileName($key) {
      return '/tmp/s_cache' . md5($key);
  }
  
  function delete( $key ) {
      $filename = $this->getFileName($key);
      if (file_exists($filename)) {
          return unlink($filename);
      } else {
          return false;
      }
   }

  function fetch($key) {
      $filename = $this->getFileName($key);
      if (!file_exists($filename) || !is_readable($filename)) return false;
    
      $data = file_get_contents($filename);
      $data = @unserialize($data);
      if (!$data) {
         unlink($filename);
         return false;
      }

      if (time() > $data[0]) {
         unlink($filename);
         return false;
      }
      return $data[1];
    }

}
