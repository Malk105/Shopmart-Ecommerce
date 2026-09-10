<?php
session_start();

require "dbconnect.php";

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $rePassword = $_POST["rePassword"];
    $phone = trim($_POST["phone"]);


    // Name validation
    if (strlen($name) < 3 || strlen($name) > 15) {

        $error = "Name must be between 3 and 15 characters.";

    }

    // Email validation
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $error = "Please enter a valid email address.";

    }

    // Password validation
    elseif (
    strlen($password) < 8 ||
    !preg_match("/[A-Z]/", $password) ||
    !preg_match("/[a-z]/", $password) ||
    !preg_match("/[0-9]/", $password) ||
    !preg_match("/[\W_]/", $password)
) {
    $error = "Password must contain at least 8 characters, including uppercase, lowercase, number and special character.";
}

    // Confirm password
    elseif ($password !== $rePassword) {

        $error = "Password and confirm password do not match.";

    }

    // Phone validation
    elseif (!preg_match("/^01[0125][0-9]{8}$/", $phone)) {

        $error = "Please enter a valid Egyptian phone number.";

    }

    else {

    // Check if email already exists
    $checkSql = "SELECT user_id FROM users WHERE user_email = ?";
    $checkStmt = $con->prepare($checkSql);
    $checkStmt->execute([$email]);

    if ($checkStmt->fetch()) {

        $error = "This email is already registered.";

    } else {

        $sql = "INSERT INTO users (user_name, user_email, password, phone)
                VALUES (?, ?, ?, ?)";

        $stmt = $con->prepare($sql);

        $stmt->execute([
            $name,
            $email,
            password_hash($password, PASSWORD_DEFAULT),
            $phone
        ]);

        $_SESSION["user"] = [
            "id" => $con->lastInsertId(),
            "name" => $name,
            "email" => $email,
            "phone" => $phone
        ];

        header("location:index.php");
        exit();
    }
}
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Create Account — ShopMart</title>

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

        <h1>Create your account</h1>

        <p>Join ShopMart to start shopping.</p>


        <?php if ($error != ""): ?>

            <div class="field-error">
                <?php echo $error; ?>
            </div>

        <?php endif; ?>


        <?php if ($success != ""): ?>

            <div>
                <?php echo $success; ?>
            </div>

        <?php endif; ?>


        <form action="register.php" method="POST">


            <div class="field">

                <label for="name">Name</label>

                <input
                    type="text"
                    name="name"
                    id="name"
                    required
                >

            </div>


            <div class="field">

                <label for="email">Email</label>

                <input
                    type="email"
                    name="email"
                    id="email"
                    required
                >

            </div>


            <div class="field">

                <label for="password">Password</label>

                <input
                    type="password"
                    name="password"
                    id="password"
                    required
                >

            </div>


            <div class="field">

                <label for="rePassword">Confirm Password</label>

                <input
                    type="password"
                    name="rePassword"
                    id="rePassword"
                    required
                >

            </div>


            <div class="field">

                <label for="phone">Phone</label>

                <input
                    type="tel"
                    name="phone"
                    id="phone"
                    required
                >

            </div>


            <button
                type="submit"
                class="btn btn-primary btn-block">

                Create Account

            </button>


        </form>


        <div class="form-foot">

            Already have an account?

            <a href="login.php">
                Log in
            </a>

        </div>

    </div>

</main>

<?php
include "include/footer.php";
?>

</body>
</html>