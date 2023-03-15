<?php
function get_user($mysqli, $email, $password)
{
    // This is the functions to get the list of user from the database

    // STEP 2
    $email_escaped = mysqli_real_escape_string($mysqli, $email);
    $password_escaped = mysqli_real_escape_string($mysqli, $password);
    $sql =
        'SELECT `id`, `user_type_id`, `name`, `dob`, `email`, `password`, `is_suspended` FROM `users` ';
    $sql .= "WHERE `email` = '$email_escaped' LIMIT 1";
    // exit ($sql);
    $result = mysqli_query($mysqli, $sql);
    $output = "Error: Invalid email ($email) and/or password ($password).";
    while ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password'])) {
            $output = 'Welcome ' . $row['name'];
        }
    }
    echo $output;
}

// STEP 1
$mysqli = mysqli_connect('localhost', 'comp1640', 'comp1640', 'comp1640');
if ($mysqli === false) {
    echo 'Check database connection!';
}

echo '<h1><pre>';
get_user($mysqli, 'administrator@gmail.com', 'Abcd7890()');
echo PHP_EOL;
get_user($mysqli, 'john@outlook', 'secret');
echo PHP_EOL;

get_user($mysqli, 'administrator@gmail.com', 'my secret@!');
echo PHP_EOL;

exit();
exit();
exit();
exit();
// STEP 1
$mysqli = mysqli_connect('localhost', 'comp1640', 'comp1640', 'comp1640');
if ($mysqli === false) {
    echo 'Check database credentials!';
}
// STEP 2
$sql =
    'SELECT `id`, `user_type_id`, `name`, `dob`, `email`, `password`, `is_suspended` FROM `users`';
// STEP 3
$result = mysqli_query($mysqli, $sql);
// if ($result === FALSE) {
//   exit("SQL query error");
// }

echo '<h1><pre>';
echo 'ASSOC', PHP_EOL;
while ($row = mysqli_fetch_assoc($result)) {
    print_r($row);
}

// echo 'ARRAY', PHP_EOL;
// while($row = mysqli_fetch_array($result)) { print_r($row); }

// echo 'ALL', PHP_EOL;
// while($row = mysqli_fetch_all($result)) { print_r($row); }

exit();
$password = 'Abcd7890()'; // plain text

// function password_hash() takes a plain text
// and convert it into a cipher text using bcrypt algorithm
$hashed = password_hash($password, PASSWORD_BCRYPT); // cipher text
echo '<h1><pre>', "Password (plain): $password", PHP_EOL;
echo "Hashed (cipher): $hashed", PHP_EOL;

$fake_wrong_password = 'my secret@!';
if (password_verify($fake_wrong_password, $hashed)) {
    echo "$fake_wrong_password is the RIGHT password", PHP_EOL;
} else {
    echo "$fake_wrong_password is the WRONG password", PHP_EOL;
}
if (password_verify($password, $hashed)) {
    echo "$password is the RIGHT password", PHP_EOL;
} else {
    echo "$password is the WRONG password", PHP_EOL;
}

// Can a cipher text be converted back to plain text?
// YES if it is a symmetrical encryption (e.g. MS Word password, MS Excel password)
// NO if it is a asymmetrical encryption
// bcrypt algo is asymmetrical
