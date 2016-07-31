  <?php include('include/head.php'); ?>
  <?php include('include/nav.php'); ?>

<div class="container theme-showcase" role="main">
  <h1>Wein-Inventar</h1>
  <p>Erfassung der vorhandenen Weine</p>
  <a href="entries-add.php">Neue Flasche hinzuf&uuml;gen</a>
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Wein</th>
        <th>Regal</th>
        <th>Tablar</th>
        <th>Position</th>
        <th>Jahrgang</th>
        <th>Geschenk</th>
        <th>Getrunken</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $query = "SELECT wine_entry.*,
                wine_def.id AS wine_def_id,
                wine_def.name AS wine_def_name,
                wine_def.description AS wine_def_description,
                wine_def.type AS wine_def_type,
                wine_def.price AS wine_def_price,
                wine_def.store_time AS wine_def_storetime,
                wine_def.picture AS wine_def_picture,
                types.id AS types_id,
                types.name AS types_name,
                regales.id AS regales_id,
                regales.name AS regales_name,
                regales.rows AS regales_rows,
                regales.cols AS regales_cols
                FROM `wine_entry`
                INNER JOIN wine_def ON wine_entry.wine=wine_def.id
                INNER JOIN types ON wine_def.type=types.id
                INNER JOIN regales ON wine_entry.regal=regales.id
                WHERE wine_entry.drunk IS NULL";
      $result = mysql_query($query, $db);
      while($row = mysql_fetch_assoc($result)) {
        echo "<tr>
          <td>" . $row['id'] . "</td>
          <td><img src=\"img/" . $row['wine_def_picture'] . "\" height=50px width=50px>&nbsp;" . $row['wine_def_name'] . "</td>
          <td>" . $row['regales_name'] . "</td>
          <td>" . $row['shelf'] . "</td>
          <td>" . $row['position'] . "</td>
          <td>" . $row['year'] . "</td>
          <td>" . $row['gift'] . "</td>
          <td>" . $row['drunk'] . "</td>
          <td>&nbsp;</td>
        </tr>";
      }
    ?>

    </tbody>
  </table>
</div>
  <?php include('include/footer.php'); ?>
