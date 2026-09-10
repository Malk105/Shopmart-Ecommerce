<?php
session_start();
if(!isset($_SESSION["user"])){
    header("location:login.php");
    exit();
}
require "dbconnect.php";

$sql = "SELECT * FROM categories";
$stmt = $con->query($sql);

$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Categories — ShopMart</title>
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
    <h1>Shop by Category</h1>
    <p>Explore our collections.</p>
  </div>
  <div id="grid" class="grid">

    <?php foreach ($categories as $category): ?>

        <a href="products.php?category=<?php echo $category['category_id']; ?>" class="tile">

            <div class="tile-media">
                <img src="<?php echo $category['image']; ?>"
                     alt="<?php echo $category['category_name']; ?>"
                     loading="lazy">
            </div>

            <div class="tile-name">
                <?php echo $category['category_name']; ?>
            </div>

        </a>

    <?php endforeach; ?>

</div>
</main>

<?php
include "include/footer.php";
?>
</body>
</html>
