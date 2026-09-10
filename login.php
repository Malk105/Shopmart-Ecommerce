<?php
session_start();
require "dbconnect.php";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    if ($email == "") {

        $error = "Please enter your email.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $error = "Please enter a valid email.";

    } elseif ($password == "") {

        $error = "Please enter your password.";

    } elseif (strlen($password) < 8) {

        $error = "Password must be at least 8 characters.";

    } else {

        $sql = "SELECT * FROM users WHERE user_email = ?";

        $stmt = $con->prepare($sql);
        $stmt->execute([$email]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user["password"])) {

            $_SESSION["user"] = [
                "id" => $user["user_id"],
                "name" => $user["user_name"],
                "email" => $user["user_email"],
                "phone" => $user["phone"]
            ];

            header("Location: index.php");
            exit();

        } else {

            $error = "Invalid email or password.";

        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Log In — ShopMart</title>

<link rel="preconnect" href="https://fonts.googleapis.com">

<link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@600;700;900&family=Archivo:wght@400;500;600;700&family=IBM+Plex+Mono:wght@500;600&display=swap" rel="stylesheet">

<link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

<?php
include "include/navbar.php"; 
?>


<main class="wrap">

    <div class="form-card">

        <h1>Welcome back</h1>

        <p>
            Please enter your details to sign in to your account.
        </p>


        <?php if ($error != ""): ?>

            <div class="field-error">
                <?php echo $error; ?>
            </div>

        <?php endif; ?>


        <form action="login.php" method="POST">

            <div class="field">

                <label for="email">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    id="email"
                    placeholder="Enter your email"
                    required
                >

            </div>


            <div class="field">

                <label for="password">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    id="password"
                    placeholder="Enter your password"
                    required
                >

            </div>


            <div class="field-row">

                <button
                    type="reset"
                    class="btn btn-outline">
                    Reset
                </button>

                <button
                    type="submit"
                    class="btn btn-primary">
                    Login
                </button>

            </div>

        </form>


        <div class="form-foot">

            Don't have an account?
            <a href="register.php">
                Create an account
            </a>

        </div>

    </div>

</main>


<?php
include "include/footer.php"; 
?>

</body>
</html>