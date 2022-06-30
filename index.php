<?php require_once "config.php";
include_once "header.php";
include_once "navbar.php"; ?>

<?php
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php?error_message=You must be logged in to continue.");
}

?>

    </p class="display-4 text-center">
           Welcome to study buddy
    <p>

<?php include_once "footer.php" ?>