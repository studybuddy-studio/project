<?php
include_once "../config.php";

function sanitizeInput($value)
{
    /* Sanitizing the input. */
    return htmlspecialchars(stripslashes(trim($value)));
}

/* Setting the session variable to an empty string. */
if (isset ($_POST['submit'])) {
    /* Getting the email and password from the form. */
    $userEmail = $_POST['email'];
    $password = $_POST['password'];

    /* Hashing the password. */
    $hashedPassword = md5($password);

    // Write a  SQL query to match the email and password.
    $loginCheckSQL = "SELECT * FROM `user` WHERE email=? AND password=?;";
    $loginCheckStatement = $connection->prepare($loginCheckSQL);
    $loginCheckStatement->bind_param('ss', $userEmail, $hashedPassword);
    $loginCheckStatement->execute();

    /* Getting the result of the query. */
    $loginCheckExecution = $loginCheckStatement->get_result();

    /* Checking if the result has one row. */
    if ($loginCheckExecution->num_rows==1) {
        header("Location:../index.php");
    } else {
        /* Setting the session variable to an error message. */
        $_SESSION['login_error_message'] = "Invalid email or password.";
    }
}
