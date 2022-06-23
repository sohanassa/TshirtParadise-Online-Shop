<?php include('proccess.php') ?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Online Shop.">
  <link rel="stylesheet" href="CartTheme.css">

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

  <div class="small-container cart-page">
    <table>
    <thead>
        <tr>
          <th class="cart-type">Product</th>
          <th class="cart-type">Quantity</th>
          <th class="cart-type">Subtotal</th>
        </tr>
      </thead>
      <?php
          $stmt = $db->prepare('SELECT * FROM carts');
          $stmt->execute();
          $result = $stmt->get_result();
          while ($row = $result->fetch_assoc()) :
          ?>
        <tr>
        <td>
            <div class="cart-info">
            <img src="<?= $row['image_link'] ?>" class="card-img-top">
              <div>
                <?= $row['NAME'] ?>
                <small> €<?= number_format($row['price'], 2) ?></small>
                <br>
                <a href="" class="cart-remove">Remove</a>
              </div>
            </div>
          </td>
        </tr>
    </table>
    <?php endwhile; ?>
    <div class="total-price">
      <table>
      <script>
        let preDiscountPrice = 0;
        let Discount = 0;
        let totalPrice = 0;
        <?php
            $stmt = $db->prepare('SELECT * FROM carts');
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) :
            ?>
            preDiscountPrice += number_format($row['price'], 2)
            Discount += number_format($row['price'], 2)*(number_format($_row['quantity'], 2)/100)
            totalPrice += preDiscountPrice - Discount
        <?php endwhile; ?>
        document.getElementById("preDiscountPrice").innerHTML = preDiscountPrice;
        document.getElementById("Discount").innerHTML = Discount;
        document.getElementById("totalPrice").innerHTML = totalPrice;
      </script>  
      
        <tr>
          <td>Subtotal</td>
          <td><p id="preDiscountPrice"></p></td>
        </tr>
        <tr>
          <td>Discount</td>
          <td></td>
        </tr>
        <tr>
          <td>Total</td>
          <td><p id="totalPrice"></p></td>
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