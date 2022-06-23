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
              <a class="nav-link" href="previous_orders.php">Previous Orders</a>
            </li>
              <li class="nav-item">
                  <a class="nav-link" href="shopping_cart.php"><i class="fa fa-shopping-cart">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                              <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                          </svg>
                          <?php
                          $db = mysqli_connect('localhost', 'root', 'plsgetit', 'webshopdatabase');
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

  <div class="small-container cart-page">
  <table>
    <thead>
      <tr>
        <th class="cart-type">Order number</th>
        <th class="cart-type">Total quantity</th>
        <th class="cart-type">Product name</th>
        <th class="cart-type">product quantity</th>
        <th class="cart-type">Total value</th>
        <th class="cart-type">Order again</th>
      </tr>
    </thead>
    <?php
    $id = $_SESSION['id'];
    $stmt = $db->prepare("SELECT * FROM orders o, orders_products p WHERE user_id = '$id' AND o.order_id = p.order_id GROUP BY o.order_id");
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) :
    ?>
      <tr>
        <td>
          <p><?= $row['order_id'] ?></p>
        <td>
        <p><?= $row['quantity'] ?></p>
        </td>
        <?php
          $id = $_SESSION['id'];
          $stmt = $db->prepare("SELECT * FROM orders_products o, products p WHERE user_id = '$id' AND o.product_id = p.product_id GROUP BY o.product_id");
          $stmt->execute();
          $result = $stmt->get_result();
          while ($row = $result->fetch_assoc()) :
        ?>
          <td>
          <p><?= $row['name'] ?></p>
          </td>
          <td>
          <p><?= $row['quantity'] ?></p>
          </td>
        <?php endwhile; ?>
        <td>
          <small>€<?= $row['total_price'] ?></small>
        </td>
        <td>
          <form method="post" action="shopping_cart.php">
            <input type="hidden" name="orderID" value="<?= $row['order_id']?>">
            <button type="submit" class="btn btn-outline-success" name="BuyAgain">same order again</button>
          </form>
        </td>
      </tr>
      <br>
    <?php endwhile; ?>
  </table>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>