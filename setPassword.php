<?php include('proccess.php') ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Online Shop.">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Set Password</title>
</head>

<body style="background-color: #d4a5c1;">

    <!-- Completed -->
    <section id="Nav-Bar" style="background-color: #c980ac;">
        <nav class="navbar navbar-expand-lg navbar-light ">
            <div class="container-fluid">
                <nav class="navbar navbar-light ">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="index.php">
                            <img src="https://cdn-icons-png.flaticon.com/512/3210/3210104.png" alt="Diamond" width="30" height="30" class="d-inline-block align-text-top">
                            Tshirt Paradise
                        </a>
                    </div>
                </nav>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="products.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="shopping_cart.php">Shopping Cart</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="previous_orders.php">Previous Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php">Register</a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
    </section>

    <script>
        function checkData() {
            var password1 = document.getElementById("pass1").value;
            var password2 = document.getElementById("pass2").value;
            if (password1 != password2) {
                alert("Password must the same!");
                return false;
            }
            if (password1.length < 9) {
                alert("Password must be at least 9 characters long!");
                return false;
            }
            if (password1.search(/[a-z]/) < 0) {
                alert("Password must must have at least 1 small character!");
                return false;
            }
            if (password1.search(/[A-Z]/) < 0) {
                alert("Password must must have at least 1 capital character!");
                return false;
            }
            if (password1.search(/[0-9]/) < 0) {
                alert("Password must must have at least 1 number!");
                return false;
            }
            return true;
        }
    </script>
    <div>
        <h2>Looks like this is your first time loggin in! <br><br> Please set a new password</h2>
        <br>
        <form method="post" action="setPassword.php" onsubmit="return checkData()">
            <?php include('errors.php'); ?>
            <div class="input-group">
                <input type="password" id="pass1" name="pass1" placeholder="Enter new password" required>
            </div>
            <div class="input-group">
                <input type="password" id="pass2" placeholder="Enter password again" required name="pass2">
            </div>
            <button type="submit" class="btn btn-outline-success" name="change_password">Change</button>
        </form>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>