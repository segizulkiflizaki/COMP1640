<?php
  date_default_timezone_set('Asia/Kuala_Lumpur');
  session_start();

  define('DB_HOST',         'localhost');
  define('DB_USER',         'comp1640');
  define('DB_PASS',         'comp1640');
  define('DB_NAME',         'comp1640');

  define('MIN_USERNAME_LENGTH', 6);

  define('USER_TYPE_ADMIN', 1);
  define('USER_TYPE_USER',  2);

  define('LOCATION_LOGIN',  'Location: index.php');
  define('LOCATION_ADMIN',  'Location: admin.php');
  define('LOCATION_USER',   'Location: user.php');
  define('LOCATION_LOGOUT', 'Location: logout.php');

  define('ERROR_INVALID_USER_PASS_001', 'Error: Invalid username and/or password. (Code #:10001)');
  define('ERROR_INVALID_USER_PASS_002', 'Error: Invalid username and/or password. (Code #:10002)');
