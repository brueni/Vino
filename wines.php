  <?php include('include/head.php'); ?>
  <?php include('include/nav.php'); ?>

<div class="container theme-showcase" role="main">
  <h1>Wein-Sorten</h1>
  <p>Auflistung der möglichen Sorten</p>
  <a href="wines-add.php">Neue Sorte hinzuf&uuml;gen</a>
  <table class="table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Beschreibung</th>
        <th>Typ</th>
        <th>Traubensorte</th>
        <th>Land</th>
        <th>Quelle</th>
        <th>Preis</th>
        <th>Lagerdauer</th>
        <th>Bild</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $query = "SELECT wine_def.*,
        types.name AS types_name ,
        grapes.name AS grapes_name,
        country.name AS country_name
        FROM wine_def
        INNER JOIN types ON wine_def.type=types.id
        INNER JOIN grapes ON wine_def.grape=grapes.id
        INNER JOIN country ON wine_def.country=country.id";
        $result = mysql_query($query, $db);
        while($row = mysql_fetch_assoc($result)) {
          echo "<tr>
            <td>" . $row['id'] . "</td>
            <td>" . $row['name'] . "</td>
            <td>" . $row['description'] . "</td>
            <td>" . $row['types_name'] . "</td>
            <td>" . $row['grapes_name'] . "</td>
            <td>" . $row['country_name'] . "</td>
            <td>" . $row['source'] . "</td>
            <td>" . $row['price'] . "</td>
            <td>" . $row['store_time'] . "</td>
            <td><img src=\"img/" . $row['picture'] . "\" width=\"100px\" height=\"100px\"></td>
            <td>&nbsp;</td>
          </tr>";
        }
      ?>
    </tbody>
  </table>
</div>
  <?php include('include/footer.php'); ?>
