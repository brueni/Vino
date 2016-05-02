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
      if ($_FILES["upload_picture"]["size"] > 500000) {
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
              $query = "INSERT INTO `wine_def` (`id`, `name`, `description`, `type`, `price`, `store_time`, `picture`) VALUES (NULL, '$_POST[name]', '$_POST[description]', '$_POST[type]', '$_POST[price]', '$_POST[store_time]', '$picturename')";
              mysql_query($query, $db);
          } else {
              echo "Sorry, there was an error uploading your file.";
          }
      }
  }
   ?>
<div class="container theme-showcase" role="main">
  <h1>Wein-Sorten</h1>
  <p>Erfassung der möglichen Sorten</p>
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Beschreibung</th>
        <th>Typ</th>
        <th>Preis</th>
        <th>Lagerdauer</th>
        <th>Bild</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $query = "SELECT wine_def.*, types.name AS types_name FROM wine_def INNER JOIN types ON wine_def.type=types.id";
        $result = mysql_query($query, $db);
        while($row = mysql_fetch_assoc($result)) {
          echo "<tr>
            <td>" . $row['id'] . "</td>
            <td>" . $row['name'] . "</td>
            <td>" . $row['description'] . "</td>
            <td>" . $row['types_name'] . "</td>
            <td>" . $row['price'] . "</td>
            <td>" . $row['store_time'] . "</td>
            <td><img src=\"img/" . $row['picture'] . "\" width=\"100px\" height=\"100px\"></td>
            <td>&nbsp;</td>
          </tr>";
        }
      ?>
      <tr>
        <td colspan="7"><b>Neuen Typ erfassen</b></td>
      </tr>
      <form action="?submit" method="post" enctype="multipart/form-data">
      <tr>
        <td>&nbsp;</td>
        <td><input type="text" name="name"></td>
        <td><textarea rows="4" cols="30" name="description"></textarea></td>
        <td><select name="type">
        <?php
        $type_query = "SELECT * FROM types";
        $type_result = mysql_query($type_query, $db);
        while($type = mysql_fetch_assoc($type_result)) {
          echo "<option value=\"" . $type['id'] . "\">" . $type['name'] . "</option>";
        }
         ?>
        </select></td>
        <td><input type="text" name="price"></td>
        <td><input type="text" name="store_time"></td>
        <td><input type="file" name="upload_picture" id="upload_picture"</td>
        <td><input type="submit" name="submit" value="new"></td>
      </tr>
      </form>
    </tbody>
  </table>
</div>
  <?php include('include/footer.php'); ?>
