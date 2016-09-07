<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Vino</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Weinregal</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Regale<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <?php
            $regal_query = "SELECT * FROM regales";
            $regal_result = mysql_query($regal_query, $db);
            while($regal = mysql_fetch_assoc($regal_result)) {
              echo "<li><a href=\"index.php?regal=" . $regal['id'] . "\">" . $regal['name'] . "</a></li>";
            }
            ?>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Verwalten<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="entries.php">Weinvorrat</a></li>
            <li><a href="wines.php">Weinsorten</a></li>
            <li><a href="regales.php">Regale</a></li>
            <li><a href="types.php">Typen</a></li>
          </ul>
        </li>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>
