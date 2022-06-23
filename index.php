<?php
session_start();
?>
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
              <?php if (isset($_SESSION["userID"])):?>
            <li class="nav-item">
              <a class="nav-link" href="shopping_cart.php">Shopping Cart</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="previous_orders.php">Previous Orders</a>
            </li>
              <?php endif; ?>
          </ul>
        </div>
      </div>
    </nav>
  </section>


  <script>
    var loggedin = "<?php echo "$loggedin" ?>";
    var ref = document.getElementById('log');
    var htmlCode = '<li class="nav-item">';
    htmlCode += '<a class="nav-link" href="shopping_cart.php">Shopping Cart</a>';
    htmlCode += '</li>';
    htmlCode += '<li class="nav-item">';
    htmlCode += '<a class="nav-link" href="previous_orders.php">Previous Orders</a>';
    htmlCode += '</li>';
    htmlCode += '';
    ref.insertAdjacentHTML('afterend', htmlCode);
  </script>


  <br>
  <h3>Our Best selling products:</h3>
  <br>
  <section id="carousel">
    <div class="carousel slide" data-bs-ride="carousel" data-bs-pause="false" style="width: 15%; height: 150px; float: left;">
      <div class="carousel-inner">
        <div class="carousel-item active" data-bs-interval="1500">
          <img src="https://www.campdavid-soccx.de/out/pictures/generated/product/1/273_408_75/t-shirt-inside-oil-dyed-mit-used-optik-641419-6008ec90717c6.jpg" class="d-block w-100" alt="image">
        </div>
        <div class="carousel-item" data-bs-interval="1500">
          <img src="https://www.campdavid-soccx.de/out/pictures/generated/product/1/273_408_75/t-shirt-mit-v-neck-im-vintage-style-794705-6272488e6aee5.jpg" class="d-block w-100" alt="image">
        </div>
        <div class="carousel-item" data-bs-interval="1500">
          <img src="https://www.campdavid-soccx.de/out/pictures/generated/product/1/273_408_75/t-shirt-aus-flammgarn-mit-used-print-574651-6008db7e10482.jpg" class="d-block w-100" alt="image">
        </div>
      </div>
    </div>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>