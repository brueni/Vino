  <?php include('include/head.php'); ?>

  <?php
  $regale_query="SELECT * FROM regales WHERE id = '1'";
  $regale_result = mysql_fetch_assoc(mysql_query($regale_query, $db));
  //echo $regale_result['rows'];
  $row_act = $regale_result['rows'];
  while ($row_act != '0') {
    $col_act = "1";
    echo "<div class=\"row\">";
    echo "<div class=\"col-sm-2 hidden-xs\">a</div>";
    while ($col_act <= $regale_result['cols']) {

      echo "<div class=\"col-sm-1\" style=\"border: #00ffff medium solid\">";

    //  $vine_query="SELECT * FROM wine_entry WHERE regal = '1' AND shelf = $row_act AND position = $col_act AND drunk IS NULL ORDER BY shelf, position LIMIT 1"; //change to dynamic regale selection later
      $vine_query="SELECT wine_entry.*,
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
                WHERE regal = '1' AND shelf = $row_act AND position = $col_act AND drunk IS NULL
                ORDER BY shelf, position
                LIMIT 1";
      $vine_result = mysql_query($vine_query, $db);
      if (mysql_num_rows($vine_result)) {
        // Something's here
        $result = mysql_fetch_assoc($vine_result);
        echo "<div class=\"row\"><div class=\"col-xs-12\">" . $result['wine_def_name'] . "</div></div>";
        echo "<div class=\"row\"><div class=\"col-xs-12\"><img src=\"img/" . $result['wine_def_picture'] . "\" width=50px height=50px></div></div>"; //Change Thumb-Size later
        echo "<div class=\"row\"><div class=\"col-xs-6\">" . $result['types_name'] . "</div><div class=\"col-xs-6\">" . $result['year'] . "</div></div>";
      } else {
        // Place is free
        echo "frei<br>";
      }
      echo $row_act . " / " . $col_act . "<br>"; //Hier Regalbild
      echo "</div>";
      $col_act++;
    }
    $row_act--;
    echo "<div class=\"col-sm-2 hidden-xs\">a</div>";
    echo "</div>";
  }
  ?>
  <?php include('include/nav.php'); ?>
  <?php include('include/footer.php'); ?>
