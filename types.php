  <?php include('include/head.php'); ?>
  <?php include('include/nav.php'); ?>

  <?php
  if (isset($_GET['submit'])) {
      $query = "INSERT INTO `types` (`id`, `name`) VALUES (NULL, '$_GET[type]')";
      mysql_query($query, $db);
  }
   ?>
<div class="container theme-showcase" role="main">
  <h1>Wein-Typen</h1>
  <p>Erfassung der möglichen Typen-Eintr&auml;ge</p>
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $query = "SELECT * FROM types";
        $result = mysql_query($query, $db);
        while($row = mysql_fetch_assoc($result)) {
          echo "<tr>
            <td>" . $row['id'] . "</td>
            <td>" . $row['name'] . "</td>
            <td>&nbsp;</td>
          </tr>";
        }
      ?>
      <tr>
        <td colspan="3"><b>Neuen Typ erfassen</b></td>
      </tr>
      <form action="?submit" method="get">
      <tr>
        <td>&nbsp;</td>
        <td><input type="text" name="type"></td>
        <td><input type="submit" name="submit" value="new"></td>
      </tr>
      </form>
    </tbody>
  </table>
</div>
  <?php include('include/footer.php'); ?>
