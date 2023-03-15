<?php
  date_default_timezone_set('Asia/Kuala_Lumpur');
  session_start();
  
  if (isset($_SESSION['data'])) {
    unset($_SESSION['data']);
  }
  session_destroy();