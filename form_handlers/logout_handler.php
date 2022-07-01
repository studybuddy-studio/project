<?php
if (isset ($_POST['logout']))
{
    session_destroy();
    header("Location:../login.php?success_message=You have successfully logged out.");
}