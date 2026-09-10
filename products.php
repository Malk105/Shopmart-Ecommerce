<?php
session_start();
if(!isset($_SESSION["user"])){
    header("location:login.php");
    exit();
}
require "dbconnect.php";

$category = isset($_GET["category"])?(int)$_GET["category"]:0;

if ($category > 0) {
    $sql = "select * from products where category_id = ?";
    $stmt = $con->prepare($sql);
    $stmt -> execute([$category]);
}else{
    $sql = "SELECT * FROM products";
    $stmt = $con->query($sql);      
}
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Products — ShopMart</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@600;700;900&family=Archivo:wght@400;500;600;700&family=IBM+Plex+Mono:wght@500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<!-- <div id="app-navbar"></div> -->
<?php
include "include/navbar.php";
?>


<main class="wrap">
  <div class="page-head">
    <h1>All Products</h1>
    <p>Browse everything we've got in stock.</p>
  </div>
  <div id="productGrid" class="grid">

    <?php foreach ($products as $product): ?>

        <div class="card">

            <a href="product.php?id=<?php echo $product['product_id']; ?>">
                <div class="card-media">
                    <img src="<?php echo $product['image']; ?>"
                         alt="<?php echo $product['product_name']; ?>">
                </div>
            </a>

            <div class="card-body">

                <a href="product.php?id=<?php echo $product['product_id']; ?>">

                    <div class="card-title" style="font-weight:bold;">
                        <?php echo $product['product_name'];?>
                        <!-- <br>
                         -->
                    </div>
                    <div class="card-decription">
                        <?php echo $product['description']; ?>
                    </div>
                    <div class="card-perf">
                        <span class="price-tag">
                            <?php echo $product['price']; ?> EGP
                        </span>
                    </div>

                </a>

            </div>

            <div class="card-actions">
                <form method="POST" action="cart.php">
                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                    <button type="submit" name="add_to_cart" class="btn btn-primary">
                        Add to Cart
                    </button>
                </form>
            </div>

        </div>

    <?php endforeach; ?>
</main>

<?php
include "include/footer.php";
?>
</body>
</html>
