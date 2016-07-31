  <?php include('include/head.php'); ?>
  <?php include('include/nav.php'); ?>

  <?php
  if (isset($_GET['submit'])) {
      $position = explode('_', $_GET['position']);
      $query = "INSERT INTO `wine_entry` (`id`, `wine`, `regal`, `shelf`, `position`, `year`, `gift`, `drunk`) VALUES (NULL, '$_GET[wine]', '$position[0]', '$position[1]', '$position[2]', '$_GET[year]', '$_GET[gift]', NULL)";
      mysql_query($query, $db);
      echo "Flasche wurde erfasst"
  }
   ?>
<div class="container theme-showcase" role="main">
  <div class="row">
    <div class="col-sm-12"><h1>Neuen Eintrag erfassen</h1></div>
    <div class="col-sm-12"><a href="entries.php">Zur&uuml;ck</a></div>
  </div>
  <div class="row">
      <form action="?submit" method="get">
      <div class="row">
        <div class="col-sm-6">Wein</div>
        <div class="col-sm-6">
          <select name="wine">
          <?php
          $wine_query = "SELECT * FROM wine_def";
          $result = mysql_query($wine_query, $db);
          while($row = mysql_fetch_assoc($result)) {
            echo "<option value=\"" . $row['id'] . "\">" . $row['name'] . "</option>";
          }
           ?>
         </select></div>
        </div>
        <div class="row">
          <div class="col-sm-6">Position</div>
          <div class="col-sm-6"><select name="position">
          <?php
          $regale_query = "SELECT * FROM regales";
          $result = mysql_query($regale_query, $db);
          while($row = mysql_fetch_assoc($result)) {
            $r = 1;
            $rows = $row['rows'];
            $cols = $row['cols'];
            while($r <= $rows) {
              $c = 1;
              while($c <= $cols){
                $position_val = $row['id'] . "_" . $r . "_" . $c;
                $check_query = "SELECT count(id) as count FROM wine_entry
                WHERE regal = $row[id]
                AND shelf = $r
                AND position = $c
                AND drunk IS NULL";
                $count = mysql_fetch_assoc(mysql_query($check_query));
                if ($count['count'] == 0) {
                  echo "<option value=\"" . $position_val . "\">" . $row['name'] . " / Reihe ". $r . " / Position" . $c . "</option>";
                }
                $c++;
              }
              $r++;
            }
          }
           ?>
          </select></div>
        </div>
        <div class="row">
          <div class="col-sm-6">Jahrgang</div>
          <div class="col-sm-6"><input type="text" name="year"></div>
        </div>
        <div class="row">
          <div class="col-sm-6">Geschenk</div>
          <div class="col-sm-6"><input type="text" name="gift"></div>
        </div>
        <div class="row">
          <div class="col-sm-6">Eintragen</div>
          <div class="col-sm-6"><input type="submit" name="submit" value="new"></div>
        </div>
      </tr>
      </form>
    </tbody>
  </table>
</div>
  <?php include('include/footer.php'); ?>
