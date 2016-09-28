  <?php include('include/head.php'); ?>

  <?php

  if (isset($_GET['drink'])) {
    $drink_query="UPDATE wine_entry SET drunk = '1' WHERE wine_entry.id = $_GET[drink]";
    mysql_query($drink_query, $db);
    echo "<div class=\"row\">";
    echo "<div class=\"col-sm-2 hidden-xs\">&nbsp;</div><div class=\"col-sm-4\">";
    echo "<button type=\"button\" class=\"btn btn-info\">Flasche " . $_GET['drink'] . " wurde getrunken!</button>&nbsp";
    echo "</div><div class=\"col-sm-4\">";
    echo "<a href=\"?revert=" . $_GET['drink'] . "\" class=\"btn btn-warning\">R&uuml;ckg&auml;ngig machen!</a>";
    echo "</div></div>";
  }

  if (isset($_GET['revert'])) {
    $drink_query="UPDATE wine_entry SET drunk = NULL WHERE wine_entry.id = $_GET[revert]";
    mysql_query($drink_query, $db);
    echo "<button type=\"button\" class=\"btn btn-info\">Flasche " . $_GET['revert'] . " wurde wieder eingetragen!</button>&nbsp";
  }
  if (!isset($_GET['regal'])) {
    $regal = '1';
  } else {
    $regal = $_GET['regal'];
  }
  $regale_query="SELECT * FROM regales WHERE id = $regal";
  $regale_result = mysql_fetch_assoc(mysql_query($regale_query, $db));
  //echo $regale_result['rows'];
  $row_act = $regale_result['rows'];
  while ($row_act != '0') {
    $col_act = "1";
    echo "<div class=\"row\">";
    echo "<div class=\"col-sm-2 hidden-xs\">&nbsp;</div>";
    while ($col_act <= $regale_result['cols']) {
      echo "<div class=\"col-sm-1\" style=\"height:240px; background-image:url(include/img/plank1.jpg); background-color:rgba(204, 204, 204, 0.8); background-repeat: no-repeat; \">";
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
                WHERE regal = $regal AND shelf = $row_act AND position = $col_act AND drunk IS NULL
                ORDER BY shelf, position
                LIMIT 1";
      $vine_result = mysql_query($vine_query, $db);
      echo "<div class=\"row\"><div class=\"col-xs-12\" style=\"background-image:url(include/img/plank2.jpg)\">&nbsp;</div></div>";
      if (mysql_num_rows($vine_result)) {
        // Something's here
        $result = mysql_fetch_assoc($vine_result);
        echo "<div class=\"row\"><div class=\"col-xs-12\" style=\"text-align:center;height:75px\"><h4>" . $result['wine_def_name'] . "</h4></div></div>";
        echo "<div class=\"row\" style=\"margin-left:1  px\"><div class=\"col-xs-12\" style=\"text-align:center\" ><a href=\"wine_detail.php?id=" . $result['id'] . "\"><img src=\"img/crop_" . $result['wine_def_picture'] . "\" ></a></div></div>"; //Change Thumb-Size later
        echo "<div class=\"row\" style=\"margin-left:5px\"><div class=\"col-xs-12\"><span class=\"glyphicon glyphicon-glass\">" . $result['types_name'] . "</div><div class=\"col-xs-12\"><span class=\"glyphicon glyphicon-calendar\">" . $result['year'] . "</div></div>";
      } else {
        // Place is free
        echo "&nbsp;";
      }
      echo "</div>";
      $col_act++;
    }
    $row_act--;
    echo "<div class=\"col-sm-2 hidden-xs\" style=\"height:240px; background-image:url(include/img/plank1.jpg); background-repeat: no-repeat\">&nbsp</div>";
    echo "</div>";
  }
  echo "<div class=\"row\"><div class=\"col-sm-12\" style=\"height:18px; background-image:url(include/img/plank2.jpg)\">&nbsp;</div></div>";
  ?>
  <?php include('include/nav.php'); ?>
  <?php include('include/footer.php'); ?>
