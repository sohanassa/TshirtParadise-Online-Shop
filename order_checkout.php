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

  <body>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 px-4 pb-4" id="order">
          <h4 class="text-center">Complete your order!</h4>
          <div class="jumbotron p-3 mb-2 text-center">
            <h6 class="lead"><b><?php
                                echo $_SESSION['cart_items'];
                                ?> products included in your order! </b></h6>
            <h6 class="lead"><b>Total price for the products is €<?php
                                                                  echo $_SESSION['cart_price'];
                                                                  ?>
              </b></h6>
          </div>
          <form action="order_checkout.php" method="post" id="placeOrder">
            <?php include('errors.php'); ?>
            <h6 class="text-center lead">Select Delivery Method</h6>
            <div class="form-group">
              <select name="pmode" class="form-control">
                <option value="" selected disabled></option>
                <option value="22">Deliver by DPD +€22</option>
                <option value="0">Deliver by DHL (Free)</option>
                <option value="33">Deliver by DHL Express +€33</option>
              </select>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-outline-success" name="order">Order</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script type="text/javascript">
      $(document).ready(function() {

        // Sending Form data to the server
        $("#placeOrder").submit(function(e) {
          e.preventDefault();
          $.ajax({
            url: 'action.php',
            method: 'post',
            data: $('form').serialize() + "&action=order",
            success: function(response) {
              $("#order").html(response);
            }
          });
        });

        // Load total no.of items added in the cart and display in the navbar
        load_cart_item_number();

        function load_cart_item_number() {
          $.ajax({
            url: 'action.php',
            method: 'get',
            data: {
              cartItem: "cart_item"
            },
            success: function(response) {
              $("#cart-item").html(response);
            }
          });
        }
      });
    </script>
  </body>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>