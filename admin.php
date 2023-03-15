<?php
  require_once('constants.php');
  if (!isset($_SESSION['user'])) {
    $_SESSION['error'] = 'Error: Unauthorised access.';
  }
  else if ($_SESSION['user']['user_type_id']!=1) {
    $_SESSION['error'] = 'Error: User is not authorised to access admin section.';
  }
  if (isset($_SESSION['error'])) {
    unset($_SESSION['user']);
    header(LOCATION_LOGIN);
  }
?>
Hello <?php echo $_SESSION['user']['name']; ?>
<br>
<a href="logout.php">Logout</a>