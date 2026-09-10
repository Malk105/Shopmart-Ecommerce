<?php
session_start();
if(!isset($_SESSION["user"])){
    header("location:login.php");
    exit();
}
if(!isset($_SESSION["cart"])){
    $_SESSION["cart"]=[];
}

require "dbconnect.php";

$id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;

$sql = "SELECT * FROM products WHERE product_id = ?";
$stmt = $con->prepare($sql);
$stmt->execute([$id]);

$product = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Product — ShopMart</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@600;700;900&family=Archivo:wght@400;500;600;700&family=IBM+Plex+Mono:wght@500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<!-- <div id="app-navbar"></div> -->
<?php
include "include/navbar.php";
?>
<main class="wrap" id="content">

<?php if ($product == null): ?>

    <div class="empty-state">
        <h3>Product not found</h3>
    </div>

<?php else: ?>

    <div class="pd-layout">

        <div>
            <div class="pd-main-img">
                <img src="<?php echo $product['image']; ?>"
                     alt="<?php echo $product['product_name']; ?>">
            </div>
        </div>

        <div class="pd-info">

            <h2><?php echo $product['product_name']; ?></h2>

            <div class="pd-price">
                <?php echo $product['price']; ?> EGP
            </div>

            <p class="pd-desc">
                <?php echo $product['description']; ?>
            </p>

            <div class="pd-facts">
                <div class="pd-fact">
                    In Stock
                </div>

                <div class="pd-fact">
                    Calculated at checkout
                </div>
            </div>

            <form method="POST" action="cart.php">
                <input type="hidden" name="product_id" value="<?php echo $product["product_id"]; ?>">

                <button type="submit" name="add_to_cart" class="btn btn-primary">
                    Add to Cart
                 </button>
            </form>

        </div>

    </div>

<?php endif; ?>

</main>

<?php
include "include/footer.php";
?>

</body>
</html>
