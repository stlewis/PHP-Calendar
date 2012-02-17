<?php
  require "calendar.php";
  $calendar = new Calendar(2, 2012);
?>
<html>
  <head>
    <link rel='stylesheet' type='text/css' href='calendar.css' />
  </head>
  <body>
    <?= $calendar->render(); ?>
  </body>
</html>
