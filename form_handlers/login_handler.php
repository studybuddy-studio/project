<?php
require_once "../config.php";
require_once "utils.php";


/* Setting the session variable to an empty string. */
if (isset ($_POST['submit'])) {
    /* Getting the email and password from the form. */
    $logEmail = sanitizeInput($_POST['email']);
    /* Sanitizing the email. */
    $userEmail = filter_var($logEmail, FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    /* Hashing the password. */
    $hashedPassword = md5($password);

    // Write a  SQL query to match the email and password.
    $loginCheckSQL = "SELECT * FROM `user` WHERE email=? AND password=?";
    /* Preparing the SQL statement. */
    $loginCheckStatement = $connection->prepare($loginCheckSQL);
    $loginCheckStatement->bind_param('ss', $userEmail, $hashedPassword);
    $loginCheckStatement->execute();

    /* Getting the result of the query. */
    $loginCheckExecution = $loginCheckStatement->get_result();

    /* Checking if the result has one row. */
    if ($loginCheckExecution->num_rows == 1) {
        $_SESSION['email'] = $userEmail;
        $_SESSION['logged_in'] = true;
        header("Location:../index.php");
    } else {
        /* Setting the session variable to an error message. */
        $error_message = "Invalid email or password.";
        header("Location:../login.php?error_message=" . $error_message);
    }
}
