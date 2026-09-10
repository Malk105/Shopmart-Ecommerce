<?php
session_start();
if(!isset($_SESSION["user"])){
    header("location:login.php");
    exit();
}

require "dbconnect.php";


if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = [];
}
if (isset($_POST["increase"])) {

    $id = (int) $_POST["product_id"];

    if (isset($_SESSION["cart"][$id])) {
        $_SESSION["cart"][$id]++;
    }

    header("Location: cart.php");
    exit();
}
if (isset($_POST["decrease"])) {

    $id = (int) $_POST["product_id"];

    if (isset($_SESSION["cart"][$id])) {

        $_SESSION["cart"][$id]--;

        if ($_SESSION["cart"][$id] <= 0) {
            unset($_SESSION["cart"][$id]);
        }
    }

    header("Location: cart.php");
    exit();
}
if (isset($_POST["remove"])) {

    $id = (int) $_POST["product_id"];

    unset($_SESSION["cart"][$id]);

    header("Location: cart.php");
    exit();
}
if (isset($_POST["add_to_cart"])) {

    $id = (int) $_POST["product_id"];

    if (isset($_SESSION["cart"][$id])) {
        $_SESSION["cart"][$id]++;
    } else {
        $_SESSION["cart"][$id] = 1;
    }

    header("Location: cart.php");
    exit();
}
$total = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cart — ShopMart</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@600;700;900&family=Archivo:wght@400;500;600;700&family=IBM+Plex+Mono:wght@500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<?php
include "include/navbar.php";
?>


<main class="wrap" id="content" style="padding-bottom:60px;">

    <?php if (empty($_SESSION["cart"])): ?>

    <div class="empty-state">
        <h3>Your cart is empty</h3>
        <p>Add some products to get started.</p>

        <a href="products.php" class="btn btn-primary" style="margin-top:16px;">
            Start Shopping
        </a>
    </div>

<?php else: ?>

    <h2>Your Cart</h2>

    <?php foreach ($_SESSION["cart"] as $id => $quantity): ?>

    <?php
        $sql = "SELECT * FROM products WHERE product_id = ?";
        $stmt = $con->prepare($sql);
        $stmt->execute([$id]);

        $currentProduct = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$currentProduct) {
            continue;
        }

        $subtotal = $currentProduct["price"] * $quantity;
        $total += $subtotal;
    ?>

    <div class="card" style="margin-bottom:20px; padding:20px;">

        <h3>
            <?php echo $currentProduct["product_name"]; ?>
        </h3>

        <p>
            Price: <?php echo $currentProduct["price"]; ?> EGP
        </p>

        <div style="display:flex; align-items:center; gap:10px; margin-top:10px;">

            <span>Quantity:</span>

            <form method="POST">
                <input type="hidden"
                       name="product_id"
                       value="<?php echo $currentProduct["product_id"]; ?>">

                <button type="submit"
                        name="decrease"
                        style="background-color:var(--primary); color:white;">
                    −
                </button>
            </form>

            <span>
                <?php echo $quantity; ?>
            </span>

            <form method="POST">
                <input type="hidden"
                       name="product_id"
                       value="<?php echo $currentProduct["product_id"]; ?>">

                <button type="submit"
                        name="increase"
                        style="background-color:var(--primary); color:white;">
                    +
                </button>
            </form>

        </div>

        <p>
            Subtotal: <?php echo $subtotal; ?> EGP
        </p>

        <form method="POST" style="margin-top:10px;">
            <input type="hidden"
                   name="product_id"
                   value="<?php echo $currentProduct["product_id"]; ?>">

            <button type="submit"
                    name="remove"
                    class="btn"
                    style="background-color:var(--primary);">
                Remove
            </button>
        </form>

    </div>

<?php endforeach; ?>
    <h3>Total: <?php echo $total; ?> EGP</h3>

<?php endif; ?>

</main>

<?php
include "include/footer.php";
?>

</body>
</html>
