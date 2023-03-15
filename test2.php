<?php
  date_default_timezone_set('Asia/Kuala_Lumpur');
  session_start();
  if (!isset($_SESSION['data'])) {
    $_SESSION['data'] = array();
  }
  if (isset($_POST['data'])) {
    $_SESSION['data'][] = $_POST['data'];
  }
?>
<form method="post">
  <input type="text" name="data" placeholder="Enter something here..." />
  <button type="submit">Store into $_SESSION</button>
</form>
<hr>
<h3>Contents of $_SESSION</h3>
<?php
  if (count($_SESSION['data']) > 0) {
    echo '<ol>', PHP_EOL;
    foreach($_SESSION['data'] as $datum) {
      echo "<li>$datum</l>";
    }
    echo '</ol>', PHP_EOL;
  }
  