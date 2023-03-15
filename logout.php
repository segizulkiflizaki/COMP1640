<?php
  require_once('constants.php');
  unset($_SESSION['user']);
  unset($_SESSION['error']);
  header(LOCATION_LOGIN);