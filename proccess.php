<?php
session_start();

// initializing variables
$name = "";
$surname = "";
$email    = "";
$password = "";
$errors = array();
$loggedin = 0;

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'webshopdatabase');

// REGISTER USER
if (isset($_POST['reg_user'])) {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $user_check_query = "SELECT * FROM users WHERE user_email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    if ($user) {
        if ($user['user_email'] === $email) {
            function_alert("User already exists!");
        }
    } else {
        if (count($errors) == 0) {
            $name = mysqli_real_escape_string($db, $_POST['name']);
            $surname = mysqli_real_escape_string($db, $_POST['surname']);
            $width = mysqli_real_escape_string($db, $_POST['width']);
            $height = mysqli_real_escape_string($db, $_POST['height']);
            $os = mysqli_real_escape_string($db, $_POST['OS']);
            $resolution = $width . 'X' . $height;
            $random_number = rand(10000, 99999);
            $passwordReal = 'Pass' . $random_number . '#';
            $password = hash("sha512", $passwordReal);
            $query = "INSERT INTO users (user_name, user_surname, user_email, user_password, screen_resolution, OS) 
                    VALUES('$name', '$surname', '$email', '$password', '$resolution', '$os')";
            mysqli_query($db, $query);
            $_SESSION['username'] = $username;
            $msg = "Your temporary password is: " . $passwordReal;
            mail($email, 'Tshirt Paradise Temporary Password', $msg, 'From: tshirtparadise999@gmail.com');
            $msg = wordwrap($msg, 70);
            header('location: login.php');
        }
    }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $passwordReal = mysqli_real_escape_string($db, $_POST['password']);
    $password = hash("sha512", $passwordReal);
    $width = mysqli_real_escape_string($db, $_POST['width']);
    $height = mysqli_real_escape_string($db, $_POST['height']);
    $os = mysqli_real_escape_string($db, $_POST['OS']);

    if (count($errors) == 0) {
        $query = "SELECT * FROM users WHERE user_email='$email' AND user_password='$password'";
        $results = mysqli_query($db, $query);
        $user = $results->fetch_assoc();
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
            $userID = (int) $user['user_id'];
            $_SESSION["userID"]=$userID;
            $temp2 = (int) $temp1['first_login'];
            $user_check_query = "SELECT * FROM users WHERE user_email='$email' LIMIT 1";
            $result = mysqli_query($db, $user_check_query);
            $user = $result->fetch_assoc();
            $_SESSION['id'] = (int) $user['user_id'];
            if ($temp2 == 1) {
                header('location: setPassword.php');
            } else {
                $loggedin = 1;
                header('location: index.php');
            }
        }
    }
}

if (isset($_POST['change_password'])) {
    $passwordReal = mysqli_real_escape_string($db, $_POST['pass2']);
    $password = hash("sha512", $passwordReal);
    $email = $_SESSION['email'];
    $query = "UPDATE users SET first_login = 0 WHERE user_email='$email' ";
    mysqli_query($db, $query);
    $query = "UPDATE users SET user_password = '$password' WHERE user_email = '$email'";
    mysqli_query($db, $query);
    $loggedin = 1;
    header('location: index.php');
}

function function_alert($msg)
{
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

if (isset($_POST['order'])) {

    //get user and shipping cost
    $email = $_SESSION['email'];
    $shipping_cost_temp = mysqli_real_escape_string($db, $_POST['pmode']);
    $shipping_cost = intval($shipping_cost_temp);

    $user_check_query = "SELECT * FROM users WHERE user_email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = $result->fetch_assoc();
    $id = (int) $user['user_id'];
    $total_price = 0;

    //calculate price from cart
    $query = "SELECT * FROM carts WHERE user_id = '$id'";
    $result = mysqli_query($db, $query);
    while ($row = mysqli_fetch_array($result)) {
        $total_price += $row['price'];
    }

    //create order
    $total_price += $shipping_cost;
    $create_order_query = "INSERT INTO orders (user_id, total_price, DATE) VALUES ('$id', '$total_price', CURRENT_TIMESTAMP)";
    $result = mysqli_query($db, $create_order_query);
    $order_id = mysqli_insert_id($db);

    //add order to users orders
    $query = "INSERT INTO users_orders (user_id, order_id) VALUES ('$id', '$order_id')";
    mysqli_query($db, $query);

    //move all products from carts to orders_products
    $query = "SELECT * FROM carts WHERE user_id = '$id'";
    $retval = mysqli_query($db, $query);

    while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
        $prodID = $row['product_id'];
        $quan = $row['quantity'];
        $query = "INSERT INTO orders_products (order_id, product_id, quantity) VALUES ('$order_id', '$prodID', '$quan')";
        mysqli_query($db, $query);
    }


    //delete products from cart and clear cart
    $query = "DELETE FROM carts WHERE user_id = '$id'";
    $result = mysqli_query($db, $query);
    $msg = "Thank you for buying from us. Your Order nuber is: 435" . $order_id;
    mail($email, 'Order Confirmation', $msg, 'From: tshirtparadise999@gmail.com');
    header('location: thankyou.php');
}

if (isset($_POST['add_to_cart'])) {
    $email = $_SESSION['email'];
    $pid = mysqli_real_escape_string($db, $_POST['productId']);
    $price = mysqli_real_escape_string($db, $_POST['price']);
    $quantity = mysqli_real_escape_string($db, $_POST['quantity']);

    $user_check_query = "SELECT * FROM users WHERE user_email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = $result->fetch_assoc();
    $id = (int) $user['user_id'];

    //check if user has already added this product before
    $query = "SELECT * FROM carts WHERE user_id = '$id' AND product_id = '$pid' LIMIT 1";
    $result = mysqli_query($db, $query);
    $userproduct = mysqli_fetch_assoc($result);
    if (!$userproduct) {
        $finalPrice = (int) $price * $quantity;
        if ($quantity <= 50) {
            $floatPrice = (float) $price * $quantity;
            $discount = (float) $quantity / 100;
            $finalPrice = (int) ($floatPrice - ($discount * $floatPrice));
        }

        $query = "INSERT INTO carts (user_id, product_id, price, quantity) VALUES ('$id', '$pid', '$finalPrice', '$quantity')";
        mysqli_query($db, $query);

        $user_check_query = "SELECT * FROM users WHERE user_email='$email' LIMIT 1";
        $result = mysqli_query($db, $user_check_query);
        $user = $result->fetch_assoc();
        $id = (int) $user['user_id'];
        $total_price = 0.0;
        $total_item_count = 0.0;
        $total_discount = 0.0;
        $discountless_total_price = 0.0;
        //calculate price from cart
        $query = "SELECT * FROM carts c, products p WHERE user_id = '$id' and c.product_id = p.product_id";
        $result = mysqli_query($db, $query);

        while ($row = mysqli_fetch_array($result)) {
            $total_price += (float)$row['price'];
            $total_item_count += $row['quantity'];
            $discountless_total_price += (float)$row['product_price'] * $row['quantity'];
            $total_discount += (float)((float) $row['product_price'] * $row['quantity'] * ((float)$row['quantity'] / 100.0));
        }
        $_SESSION['cart_price'] = $total_price;
        $_SESSION['cart_items'] = $total_item_count;
        $_SESSION['total_discount'] =  $total_discount;
        $_SESSION['discountless_total_price'] =  $discountless_total_price;
    }
}

if (isset($_POST['shopping_order'])) {
    header('location: order_checkout.php');
}

if (isset($_POST['remove'])) {
    $pid = mysqli_real_escape_string($db, $_POST['prodID']);
    $id = $_SESSION["userID"];
    $query = "DELETE FROM carts WHERE user_id = '$id' AND product_id = '$pid'";
    $result = mysqli_query($db, $query);
    header('location: shopping_cart.php');
}

if (isset($_POST['BuyAgain'])) {

    //get user and shipping cost
    $email = $_SESSION['email'];

    
    $id = $_SESSION["userID"];
    $pid = mysqli_real_escape_string($db, $_POST['orderID']);
    $total_price = 0;

    //calculate price from cart
    $query = "SELECT * FROM orders WHERE order_id = '$pid'";
    $result = mysqli_query($db, $query);
    $temp = $result->fetch_assoc();
    $total_price = (int) $temp['total_price'];

    //create order
    $create_order_query = "INSERT INTO orders (user_id, total_price, DATE) VALUES ('$id', '$total_price', CURRENT_TIMESTAMP)";
    $result = mysqli_query($db, $create_order_query);
    $order_id = mysqli_insert_id($db);

    //add order to users orders
    $query = "INSERT INTO users_orders (user_id, order_id) VALUES ('$id', '$order_id')";
    mysqli_query($db, $query);

    //move all products from carts to orders_products
    $query = "SELECT * FROM orders_products WHERE order_id = '$pid'";
    $retval = mysqli_query($db, $query);

    while ($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)) {
        $prodID = $row['product_id'];
        $quan = $row['quantity'];
        $query = "INSERT INTO orders_products (order_id, product_id, quantity) VALUES ('$order_id', '$prodID', '$quan')";
        mysqli_query($db, $query);
    }

    //send mail to user
    $msg = "Thank you for buying from us. Your Order nuber is: 435" . $order_id;
    mail($email, 'Order Confirmation', $msg, 'From: tshirtparadise999@gmail.com');
    header('location: thankyou.php');
}

if (isset($_POST['logout'])) {
    session_destroy();
    header('location: index.php');
}