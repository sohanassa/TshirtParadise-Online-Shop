<?php include('proccess.php') ?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Online Shop.">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <title>Checkout</title>
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
              <a class="nav-link" href="previous_orders.php">Previous Orders</a>
            </li>
              <li class="nav-item">
                  <a class="nav-link" href="shopping_cart.php"><i class="fa fa-shopping-cart">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                              <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                          </svg>
                          <?php
                          $db = mysqli_connect('localhost', 'root', '', 'webshopdatabase');
                          $id = $_SESSION['userID'];
                          $query = "SELECT COUNT(*) AS total FROM carts WHERE user_id= '$id'";
                          $results = mysqli_query($db, $query);
                          $user = $results->fetch_assoc();
                          echo $user["total"] ?></i></a>

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
                <option value="24">Deliver by DPD +€24</option>
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