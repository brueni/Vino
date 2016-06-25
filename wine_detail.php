  <?php include('include/head.php'); ?>

  <?php
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
                WHERE wine_def.id = $_GET[id]
                LIMIT 1";
        $vine_result = mysql_query($vine_query, $db);
        $result = mysql_fetch_assoc($vine_result);
        echo "<div class=\"row\">";
        echo "<div class=\"col-sm-3 hidden-xs\">a</div>";
        echo "<div class=\"col-sm-6\" style=\"border: #00ffff medium solid\">";
          echo "<div class=\"row\">
                  <div class=\"col-xs-12\"><h1>" . $result['wine_def_name'] . "</h1></div>
                </div>
                <div class=\"row\">
                  <div class=\"col-xs-4\">
                    <img src=\"img/" . $result['wine_def_picture'] . "\" width=200px height=300px>
                  </div>
                  <div class=\"col-xs-4\">
                    <div><span class=\"glyphicon glyphicon-glass\">" . $result['types_name'] . "</div>
                    <div><span class=\"glyphicon glyphicon-gift\">" . $result['gift'] . "</div>

                  </div>
                  <div class=\"col-xs-4\">
                    <div><span class=\"glyphicon glyphicon-calendar\">" . $result['year'] . "</div>
                    <div><span class=\"glyphicon glyphicon-usd\">" . $result['wine_def_price'] . "</div>
                  </div>
                  <div class=\"col-xs-8\"></div>
             </div>
            </div>";
        echo "<div class=\"col-sm-3 hidden-xs\">a</div></div>";
  ?>
  <?php include('include/nav.php'); ?>
  <?php include('include/footer.php'); ?>
