<?php
session_start();

// initializing variables
$name = "";
$surname = "";
$email    = "";
$errors = array();

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'webshopdatabase');

// REGISTER USER
if (isset($_POST['reg_user'])) {
    
    $name = mysqli_real_escape_string($db, $_POST['name']);
    $surname = mysqli_real_escape_string($db, $_POST['surname']);
    $email = mysqli_real_escape_string($db, $_POST['email']);

    $user_check_query = "SELECT * FROM users WHERE user_email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        if ($user['user_email'] === $email) {
            array_push($errors, "User already exists");
        }
    }

    if (count($errors) == 0) {

        $query = "INSERT INTO users (user_name, user_surname, user_email, user_password, screen_resolution) 
  			  VALUES('$name', '$surname', '$email', '12345678', '2345x3563')";
        mysqli_query($db, $query);
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('location: index.php');
    }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (count($errors) == 0) {
        $query = "SELECT * FROM users WHERE user_email='$email' AND user_password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
            $_SESSION['email'] = $email;
            $_SESSION['success'] = "You are now logged in";
            header('location: index.php');
        } else {
            array_push($errors, "Wrong username/password combination");
        }
    }
}
