<nav class="nav">
    <div class="wrap nav-row">

        <a href="index.php" class="brand">
            <span class="brand-mark">S</span> ShopMart
        </a>
        <?php
        if(isset($_SESSION["user"])):
        ?>
        <div class="nav-links">
            <a href="products.php">Products</a>
            <a href="categories.php">Categories</a>
        </div>
        <?php endif; ?>
        <div class="nav-right">

            <?php if (isset($_SESSION["user"])): ?>

               <?php
$cartCount = 0;

if (isset($_SESSION["cart"])) {
    foreach ($_SESSION["cart"] as $quantity) {
        $cartCount += $quantity;
    }
}
?>

<a href="cart.php" class="btn-icon" style="position: relative;">
    🛒

    <?php if ($cartCount > 0): ?>
        <span style="
            position: absolute;
            top: -8px;
            right: -8px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            min-width: 20px;
            height: 20px;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        ">
            <?php echo $cartCount; ?>
        </span>
    <?php endif; ?>

</a>

                <span style="margin:0 10px;">
                    <?php echo $_SESSION["user"]["name"]; ?>
                </span>

                <a href="logout.php" class="btn btn-primary">
                    Logout
                </a>

            <?php else: ?>

                <a href="login.php" class="btn btn-primary">
                    Login
                </a>

            <?php endif; ?>

        </div>

    </div>
</nav>