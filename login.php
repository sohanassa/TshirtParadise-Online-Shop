<?php include('proccess.php') ?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Online Shop.">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <title>Home Page</title>
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
  <!-- Completed -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

<script>
  function checkData() {
    var email = document.getElementById("emailadress").value;
    var password = document.getElementById("pass").value;
    if (email.length < 5) {
      alert("Email must be at least 5 characters long!");
      return false;
    }
    if (email.search(/@/) < 0) {
      alert("Email must have @ symbol!");
      return false;
    }
    if (password.length < 9) {
      alert("Password must be at least 9 characters long!");
      return false;
    }
    if (password.search(/[a-z]/) < 0) {
      alert("Password must must have at least 1 small character!");
      return false;
    }
    if (password.search(/[A-Z]/) < 0) {
      alert("Password must must have at least 1 capital character!");
      return false;
    }
    if (password.search(/[0-9]/) < 0) {
      alert("Password must must have at least 1 number!");
      return false;
    }
    return true;
  }
</script>

<div>
  <br>
  <h2>Login to Tshirt Paradise</h2>
  <br>
  <form method="post" action="login.php" onsubmit="return checkData()">
    <?php include('errors.php'); ?>
    <div style="text-align: center; " class="input-group">
      <input id="emailadress" style="text-align: center;" type="text" placeholder="Enter email address" name="email" required>
    </div>
    <div style="text-align: center; " class="input-group">
      <input id="pass" style="text-align: center;" type="password" name="password" placeholder="Enter password" required>
    </div>
    <button type="submit" class="btn btn-outline-success" name="login_user">Login</button>
  </form>
</div>
<br>
<h4>First time here?</h4> <a href="register.php">register<a>

</html>