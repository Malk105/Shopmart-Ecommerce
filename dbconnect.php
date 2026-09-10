<?php
try {
    $con = new PDO( "mysql:host=localhost;dbname=e_commerce;charset=utf8","root","");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "connect success";

} catch (PDOException $e) {
    die("Connection failed: ".$e->getMessage());
}

?>