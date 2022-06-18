<?php
session_start();

// initializing variables
$name = "";
$surname = "";
$email    = "";
$password = "";
$errors = array();

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'webshopdatabase');

// REGISTER USER
if (isset($_POST['reg_user'])) {

    $name = mysqli_real_escape_string($db, $_POST['name']);
    $surname = mysqli_real_escape_string($db, $_POST['surname']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $width = mysqli_real_escape_string($db, $_POST['width']);
    $height = mysqli_real_escape_string($db, $_POST['height']);
    $os = mysqli_real_escape_string($db, $_POST['OS']);
    $user_check_query = "SELECT * FROM users WHERE user_email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        if ($user['user_email'] === $email) {
            array_push($errors, "User already exists");
        }
    }

    if (count($errors) == 0) {
        $resolution = $width . 'X' . $height;
        $query = "INSERT INTO users (user_name, user_surname, user_email, user_password, screen_resolution, OS) 
  			  VALUES('$name', '$surname', '$email', 'Pass11111!', '$resolution', '$os')";
        mysqli_query($db, $query);
        $_SESSION['username'] = $username;
        $msg = "Your temporary password is: Pass1111!";

        $msg = wordwrap($msg, 70);

        mail("sohaebameen1@gmail.com", "Tshirt Paradice Temporary Password", $msg);
        header('location: login.php');
    }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $width = mysqli_real_escape_string($db, $_POST['width']);
    $height = mysqli_real_escape_string($db, $_POST['height']);
    $os = mysqli_real_escape_string($db, $_POST['OS']);

    if (count($errors) == 0) {
        $query = "SELECT * FROM users WHERE user_email='$email' AND user_password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
            $_SESSION['email'] = $email;
            $resolution = $width . 'X' . $height;
            $query = "UPDATE users SET screen_resolution = '$resolution' WHERE user_email='$email' ";
            mysqli_query($db, $query);
            $query = "UPDATE users SET logged_in = 1 WHERE user_email='$email' ";
            mysqli_query($db, $query);
            $query = "UPDATE users SET last_login_date = CURRENT_TIMESTAMP WHERE user_email='$email' ";
            mysqli_query($db, $query);
            $query = "UPDATE users SET OS = '$os' WHERE user_email='$email' ";
            mysqli_query($db, $query);
            $query = "SELECT first_login FROM users WHERE user_email='$email'";
            $login = mysqli_query($db, $query);
            $temp1  = $login->fetch_assoc();
            $temp2 = (int) $temp1['first_login'];
            if ($temp2 == 1) {
                header('location: setPassword.php');
            } else
                header('location: index.php');
        }
    }
}

if (isset($_POST['change_password'])) {
    $password = mysqli_real_escape_string($db, $_POST['pass2']);
    $email = $_SESSION['email'];
    $query = "UPDATE users SET first_login = 0 WHERE user_email='$email' ";
    mysqli_query($db, $query);
    $query = "UPDATE users SET user_password = '$password' WHERE user_email = '$email'";
    mysqli_query($db, $query);
    header('location: index.php');
}
