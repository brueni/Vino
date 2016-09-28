<?php
include('include/simpleimage/simpleimage.php');

if ($handle = opendir('img/')) {
    while (false !== ($entry = readdir($handle))) {
      try {
          $img = new abeautifulsite\SimpleImage('img/' . $entry);
          $img->best_fit(300, 300)->thumbnail(200, 300)->save('img/thumb_' . $entry);
          $img2 = new abeautifulsite\SimpleImage('img/' . $entry);
          $img2->best_fit(100, 100)->thumbnail(50, 100)->save('img/crop_' . $entry);
        } catch(Exception $e) {
          echo 'Error: ' . $e->getMessage();
        }
    }
    closedir($handle);
}
  /*  */

?>
