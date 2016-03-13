  <?php include('include/head.php'); ?>
  <?php include('include/nav.php'); ?>
<div class="container theme-showcase" role="main">
  <h1>Wein-Typen</h1>
  <p>Erfassung der möglichen Typen-Eintr&auml;ge</p>
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
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
          </tr>";
        }
      ?>
    </tbody>
  </table>
</div>
  <?php include('include/footer.php'); ?>
