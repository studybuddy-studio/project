<?php
if (isset ($_POST['logout']))
{
    var_dump($_POST);
    $_SESSION['logged_in'] = false;
    $_SESSION['email'] = "";
    session_destroy();

    header("Location:../login.php?success_message=You have successfully logged out.");
}