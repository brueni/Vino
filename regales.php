  <?php include('include/head.php'); ?>
  <?php include('include/nav.php'); ?>

  <?php
  if (isset($_GET['submit'])) {
      $query = "INSERT INTO `regales` (`id`, `name`, `rows`, `cols`) VALUES (NULL, '$_GET[name]', '$_GET[rows]','$_GET[cols]')";
      mysql_query($query, $db);
  }
   ?>
<div class="container theme-showcase" role="main">
  <h1>Wein-Regale</h1>
  <p>Erfassung der vorhandenen Regale</p>
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Tablare</th>
        <th>Pl&auml;tze pro Tablar</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $query = "SELECT * FROM regales";
        $result = mysql_query($query, $db);
        while($row = mysql_fetch_assoc($result)) {
          echo "<tr>
            <td>" . $row['id'] . "</td>
            <td>" . $row['name'] . "</td>
            <td>" . $row['rows'] . "</td>
            <td>" . $row['cols'] . "</td>
            <td>&nbsp;</td>
          </tr>";
        }
      ?>
      <tr>
        <td colspan="5"><b>Neues Regals erfassen</b></td>
      </tr>
      <form action="?submit" method="get">
      <tr>
        <td>&nbsp;</td>
        <td><input type="text" name="name"></td>
        <td><input type="text" name="rows"></td>
        <td><input type="text" name="cols"></td>
        <td><input type="submit" name="submit" value="new"></td>
      </tr>
      </form>
    </tbody>
  </table>
</div>
  <?php include('include/footer.php'); ?>
