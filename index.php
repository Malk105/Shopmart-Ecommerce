<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ShopMart — Discover Amazing Deals</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@600;700;900&family=Archivo:wght@400;500;600;700&family=IBM+Plex+Mono:wght@500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php
include "include/navbar.php";
?>

<section class="hero">
  <div class="hero-inner">
    <span class="badge-pill" id="welcomeBadge">
    <?php if(isset($_SESSION['user'])){
      echo"Welcome ". $_SESSION['user']['name']." to ShopMart";
    }else{
      echo "Welcome to ShopMart";
    }
    ?>
    </span>
    <h1>Discover Amazing <em>Deals</em></h1>
    <p>Shop the latest trends with premium quality and unbeatable prices. Everything you need in one place.</p>
    <div class="hero-ctas">
      <a href="products.php" class="btn btn-primary">Shop Now</a>
      <a href="categories.php" class="btn btn-outline">Explore Categories</a>
    </div>
  </div>
</section>


<?php
include "include/footer.php";
?>
</body>
</html>
