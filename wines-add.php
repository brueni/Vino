  <?php include('include/head.php'); ?>
  <?php include('include/nav.php'); ?>

  <?php
  if (isset($_POST['submit'])) {
      $target_dir = "img/";
      $target_file = $target_dir . basename($_FILES["upload_picture"]["name"]);
      $uploadOk = 1;
      $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
      $check = getimagesize($_FILES["upload_picture"]["tmp_name"]);
      if($check !== false) {
          $uploadOk = 1;
      } else {
          echo "File is not an image.";
          $uploadOk = 0;
      }
      // Check if file already exists
      if (file_exists($target_file)) {
          echo "Sorry, file already exists.";
          $uploadOk = 0;
      }
      // Check file size
      if ($_FILES["upload_picture"]["size"] > 10000000) {
          echo "Sorry, your file is too large.";
          $uploadOk = 0;
      }
      // Allow certain file formats
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif" ) {
          echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOk = 0;
      }
      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
      // if everything is ok, try to upload file
      } else {
          if (move_uploaded_file($_FILES["upload_picture"]["tmp_name"], $target_file)) {
              $picturename = basename($_FILES["upload_picture"]["name"]);
              /*$thumb = PhpThumbFactory::create('../../img/' . $picturename);
              $thumb->resize(100, 100);
              $thumb->save('tmb_$picturename');*/
              //Add PHPThumb later
              $query = "INSERT INTO `wine_def` (`id`, `name`, `description`, `type`, `source`, `price`, `store_time`, `picture`, `grape`, `country`) VALUES (NULL, '$_POST[name]', '$_POST[description]', '$_POST[type]',  '$_POST[source]', '$_POST[price]', '$_POST[store_time]', '$picturename', '$_POST[grape]', '$_POST[country]')";
              //echo $query;
              mysql_query($query, $db);
              echo "Weinsorte wurde erfasst";
          } else {
              echo "Sorry, there was an error uploading your file.";
          }
      }
  }
   ?>
<div class="container theme-showcase" role="main">
      <div class="row">
        <div class="col-sm-12"><h1>Neue Weinflasche erfassen</h1></div>
        <div class="col-sm-12"><a href="wines.php">Zur&uuml;ck</a></div>
      </div>
      <form action="?submit" method="post" enctype="multipart/form-data">


        <div class="row">
          <div class="col-sm-6">Name</div>
          <div class="col-sm-6"><input type="text" name="name"></div>
        </div>
        <div class="row">
          <div class="col-sm-6">Beschreibung</div>
          <div class="col-sm-6"><textarea rows="4" cols="30" name="description"></textarea></div>
        </div>
        <div class="row">
          <div class="col-sm-6">Typ</div>
          <div class="col-sm-6"><select name="type">
            <?php
            $type_query = "SELECT * FROM types";
            $type_result = mysql_query($type_query, $db);
            while($type = mysql_fetch_assoc($type_result)) {
              echo "<option value=\"" . $type['id'] . "\">" . $type['name'] . "</option>";
            }
             ?>
          </select></div>
        </div>
        <div class="row">
          <div class="col-sm-6">Quelle</div>
          <div class="col-sm-6"><input type="text" name="source"></div>
        </div>
        <div class="row">
          <div class="col-sm-6">Preis</div>
          <div class="col-sm-6"><input type="text" name="price"></div>
        </div>
        <div class="row">
          <div class="col-sm-6">Lagerdauer</div>
          <div class="col-sm-6"><input type="text" name="store_time"></div>
        </div>
        <div class="row">
          <div class="col-sm-6">Traubensorte</div>
          <div class="col-sm-6"><select name="grape">
            <?php
            $grape_query = "SELECT * FROM grapes";
            $grape_result = mysql_query($grape_query, $db);
            while($grape = mysql_fetch_assoc($grape_result)) {
              echo "<option value=\"" . $grape['id'] . "\">" . $grape['name'] . "</option>";
            }
             ?>
          </select></div>
        </div>
        <div class="row">
          <div class="col-sm-6">Land</div>
          <div class="col-sm-6"><select name="country">
            <?php
            $country_query = "SELECT * FROM country";
            $country_result = mysql_query($country_query, $db);
            while($country = mysql_fetch_assoc($country_result)) {
              echo "<option value=\"" . $country['id'] . "\">" . $country['name'] . "</option>";
            }
             ?>
          </select></div>
        </div>
        <div class="row">
          <div class="col-sm-6">Bild</div>
          <div class="col-sm-6"><input type="file" accept="image/*" name="upload_picture" id="upload_picture"></div>
        </div>
        <div class="row">
          <div class="col-sm-6">Eintragen</div>
          <div class="col-sm-6"><input type="submit" name="submit" value="new"></div>
        </div>

      </form>
</div>
  <?php include('include/footer.php'); ?>
