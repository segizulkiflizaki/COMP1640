<?php
  // $_POST is a super global array
  // $_GET
  // $_REQUEST
  // $_SERVER 
  // $_COOKIE
  // $_SESSION
  require_once('constants.php');
  if (isset($_SESSION['user'])) {
    redirect_user();
  }

  if (isset($_POST['username'], $_POST['password'])) {
    // TODO: Check if... username and password are not empty
    // TODO: Check if... username has at least ??? characters
    // If above validations fail... display error to user!
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    if ($username=='' || $password=='' || strlen($username) < MIN_USERNAME_LENGTH) {
      $_SESSION['error'] = ERROR_INVALID_USER_PASS_001;
    }
    else {
      $user = get_user($username, $password);
      if (empty($user)) {
        $_SESSION['error'] = ERROR_INVALID_USER_PASS_002;
      }
      else {
        $_SESSION['user'] = $user;
        redirect_user();
      }
    }
  }

  function redirect_user() {
    if ($_SESSION['user']['user_type_id']==USER_TYPE_ADMIN) { // admin group
      header(LOCATION_ADMIN);
    }
    else if ($_SESSION['user']['user_type_id']==USER_TYPE_USER) { // regular user group
      header(LOCATION_USER);
    }
  }

  function get_user($email, $password) {
    $mysqli = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $email_escaped = mysqli_real_escape_string($mysqli, $email);
    $password_escaped = mysqli_real_escape_string($mysqli, $password);
    $sql  = "SELECT `id`, `user_type_id`, `name`, `dob`, `email`, `password`, `is_suspended` FROM `users` ";
    $sql .= "WHERE `email` = '$email_escaped' LIMIT 1";
    $result = mysqli_query($mysqli, $sql);

    while($row = mysqli_fetch_assoc($result)) { 
      if (password_verify($password, $row['password'])) {
        return $row;
      }
    }
    return array();
  }
?>
<html>
  <head>
    <title>Login</title>
    <style>
      body { font-family: sans-serif; }
      .caption { text-align: right; text-size: 1.2em; }
      .text-field { padding: 8px; }
      button { 
        color: white; background-color: red; border-radius: 4px; 
        border-style: solid; padding: 10px; font-size: 12pt; 
      }
      .error {
        border-style: solid;
        border-width: 1px;
        border-color: #2596be;
        background-color: #071e26;
        border-radius: 8px;
        padding: 16px;
        color: white;
      }
    </style>
  </head>
  <body>
    <form method="post">
      <div>
        <label class="caption">Username</label>
        <input type="text" name="username" placeholder="Your username" class="text-field">
      </div>
      <div>
        <label class="caption">Password</label>
        <input type="password" name="password" placeholder="Your secret" class="text-field">
      </div>
<?php if (isset($_SESSION['error'])) { ?>
      <span class="error"><?php echo $_SESSION['error']; ?></span>
<?php 
    unset($_SESSION['error']);
  } 
?>
      <button type="submit">Login</button>
    </form>
  </body>
</html>