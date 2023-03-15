<?php
  require_once('constants.php');

  if (isset($_POST['dob'])) {
    $user_type  = $_POST['user_type'];
    $dob        = $_POST['dob'];
    $name       = $_POST['name'];
    $email      = $_POST['username'];
    $password   = $_POST['password'];
  
    $mysqli = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $dob_escaped = mysqli_real_escape_string($mysqli, $dob);
    $name_escaped = mysqli_real_escape_string($mysqli, $name);
    $email_escaped = mysqli_real_escape_string($mysqli, $email);
    $password = password_hash($password, PASSWORD_BCRYPT);
    $password_escaped = mysqli_real_escape_string($mysqli, $password);
    $sql  = "INSERT INTO `users`(`user_type_id`, `name`, `dob`, `email`, `password`) ";
    $sql .= "VALUES ($user_type, '$name_escaped', '$dob_escaped', '$email_escaped', '$password_escaped')";
    mysqli_query($mysqli, $sql);
  
    if (mysqli_affected_rows($mysqli) == 1) {
      header(LOCATION_LOGIN);
    }
  
    exit('Failed to create user');
  }
?>
<html>
  <head>
    <title>Create User</title>
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
        <label class="caption">User Type</label>
        <select name="user_type">
          <option value="2">User</option>
          <option value="1">Admin</option>
        </select>
      </div>
      <div>
        <label class="caption">DOB</label>
        <input type="date" name="dob">
      </div>
      <div>
        <label class="caption">Name</label>
        <input type="text" name="name" placeholder="Your name" class="text-field">
      </div>
      <div>
        <label class="caption">Username</label>
        <input type="text" name="username" placeholder="Your username" class="text-field">
      </div>
      <div>
        <label class="caption">Password</label>
        <input type="password" name="password" placeholder="Your secret" class="text-field">
      </div>
      <button type="submit">Create User</button>
    </form>
  </body>
</html>