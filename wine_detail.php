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
                wine_def.grape AS wine_def_grape,
                wine_def.country AS wine_def_country,
                types.id AS types_id,
                types.name AS types_name,
                grapes.id AS grapes_id,
                grapes.name AS grapes_name,
                country.id AS country_id,
                country.name AS country_name,
                regales.id AS regales_id,
                regales.name AS regales_name,
                regales.rows AS regales_rows,
                regales.cols AS regales_cols
                FROM `wine_entry`
                INNER JOIN wine_def ON wine_entry.wine=wine_def.id
                INNER JOIN types ON wine_def.type=types.id
                INNER JOIN grapes ON wine_def.grape=grapes.id
                INNER JOIN country ON wine_def.country=country.id
                INNER JOIN regales ON wine_entry.regal=regales.id
                WHERE wine_entry.id = $_GET[id]
                LIMIT 1";
        $vine_result = mysql_query($vine_query, $db);
        $result = mysql_fetch_assoc($vine_result);
        $trinkjahr = $result['year'] + $result['wine_def_storetime'];
        echo "<div class=\"row\">";
        echo "<div class=\"col-sm-2 hidden-xs\">&nbsp;</div>";
        echo "<div class=\"col-sm-8\" style=\"background-color:rgba(204, 204, 204, 0.8); padding:20px\">";
        echo "<div class=\"row\">
                <div class=\"col-xs-12\"><a href=\"index.php\">Zur&uuml;ck</a></div>
              </div>
              <div class=\"row\">
                <div class=\"col-xs-12\"><h1>" . $result['wine_def_name'] . "</h1></div>
              </div>
              <div class=\"row\">
                <div class=\"col-sm-4 col-xs-12 text-center\" style=\"padding:5px\">
                  <img src=\"img/" . $result['wine_def_picture'] . "\" width=200px height=300px>
                </div>
                <div class=\"col-sm-4 col-xs-6\"><span class=\"glyphicon glyphicon-glass\"></span>&nbsp;" . $result['types_name'] . " | " . $result['grapes_name'] . "</div>
                <div class=\"col-sm-4 col-xs-6\"><span class=\"glyphicon glyphicon-calendar\"></span>&nbsp;Jahrgang: " . $result['year'] . "</div>
                <div class=\"col-sm-4 col-xs-6\"><span class=\"glyphicon glyphicon-globe\"></span>&nbsp;" . $result['country_name'] . "</div>
                <div class=\"col-sm-4 col-xs-6\"><span class=\"glyphicon glyphicon-calendar\"></span>&nbsp;Opt.&nbsp;Trinkjahr: " . $trinkjahr . "</div>
                <div class=\"col-sm-4 col-xs-6\"><span class=\"glyphicon glyphicon-gift\"></span>&nbsp;" . $result['gift'] . "</div>
                <div class=\"col-sm-4 col-xs-6\"><span class=\"glyphicon glyphicon-usd\"></span>&nbsp;" . $result['wine_def_price'] . ".-</div>
                <div class=\"col-sm-8 col-xs-12\"><blockquote><p>" . $result['wine_def_description'] . "</p></blockquote></div>
                <div class=\"col-sm-8 col-xs-12\"><a href=\"index.php?drink=" . $result['id'] . "\" type=\"button\" class=\"btn btn-primary btn-block\">Flasche trinken</a></div>
              </div>
            </div>";
        echo "<div class=\"col-sm-2 hidden-xs\">&nbsp</div></div>";
  ?>
  <?php include('include/nav.php'); ?>
  <?php include('include/footer.php'); ?>
