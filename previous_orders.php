<?php include('proccess.php') ?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Online Shop.">
  <link rel="stylesheet" href="style.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <title>Previous Orders</title>
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

  <div class="small-container cart-page">
    <table>
      <tr>
        <th class="cart-type">Product</th>
        <th class="cart-type">Quantity</th>
        <th class="cart-type">Subtotal</th>
      </tr>
      <tr>
        <td>
          <div class="cart-info">
            <img src="images/notRedTshirt.jpg" alt="">
            <div>
              <p>White Tshirt</p>
              <small>Price: $50.00</small>
              <br>
              <a href="" class="cart-remove">Remove</a>
            </div>
          </div>
        </td>
        <td><input type="number" value="1"></td>
        <td>$50.99</td>
      </tr>
      <tr>
        <td>
          <div class="cart-info">
            <img src="images/notRedTshirt.jpg" alt="">
            <div>
              <p>White Tshirt</p>
              <small>Price: $50.00</small>
              <br>
              <a href="" class="cart-remove">Remove</a>
            </div>
          </div>
        </td>
        <td><input type="number" value="1"></td>
        <td>$50.99</td>
      </tr>
      <tr>
        <td>
          <div class="cart-info">
            <img src="images/notRedTshirt.jpg" alt="">
            <div>
              <p>White Tshirt</p>
              <small>Price: $50.00</small>
              <br>
              <a href="" class="cart-remove">Remove</a>
            </div>
          </div>
        </td>
        <td><input type="number" value="1"></td>
        <td>$50.99</td>
      </tr>
    </table>

    <div class="total-price">
      <table>
        <tr>
          <td>Subtotal</td>
          <td>$150.00</td>
        </tr>
        <tr>
          <td>Tax</td>
          <td>$35.00</td>
        </tr>
        <tr>
          <td>Total</td>
          <td>$185.00</td>
        </tr>
        <tr>
          <td></td>
          <td> 
            <button type="button">Order</button> 
          </td>
        </tr>
      </table>
    </div>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>