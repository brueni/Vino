  <?php include('include/head.php'); ?>

  <?php
  $regale_query="SELECT * FROM regales WHERE id = '1'";
  $regale_result = mysql_fetch_assoc(mysql_query($regale_query, $db));
  //echo $regale_result['rows'];
  $row_act = "1";
  while ($row_act <= $regale_result['rows']) {
    $col_act = "1";
    echo "<div class=\"row\">";
    echo "<div class=\"col-sm-2 hidden-xs\">a</div>";
    while ($col_act <= $regale_result['cols']) {

      echo "<div class=\"col-sm-1\">";
      echo $row_act . " / " . $col_act . "<br>";
      $vine_query="SELECT * FROM wine_entry WHERE regal = '1' AND shelf = $row_act AND position = $col_act AND drunk IS NULL ORDER BY shelf, position LIMIT 1"; //change to dynamic regale selection later
      $vine_result = mysql_query($vine_query, $db);
      if (mysql_num_rows($vine_result)) {
        // Something's here
        echo "besetzt<br>";
      } else {
        // Place is free
        echo "frei<br>";
      }
      $col_act++;
      echo "</div>";
    }
    $row_act++;
    echo "<div class=\"col-sm-2 hidden-xs\">a</div>";
    echo "</div>";
  }
  ?>
  <?php include('include/nav.php'); ?>
  <?php include('include/footer.php'); ?>
