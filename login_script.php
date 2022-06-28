<?php
require_once "config.php";

// by default, error messages are empty
$loginErrorMessage = $emailErrorMessage = $passwordErrorMessage = '';

/* Checking if the submit button has been clicked. */
if (isset($_POST['submit'])) {

    //input fields are Validated with regular expression
    $nameRegex = "/^[a-zA-Z ]*$/";
    /* This is a regular expression that is used to validate the email address. */
    $emailRegex = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";


    //Email Address Validation
    if (empty($email)) {
        $emailErrorMessage = "Email is Required";
    } else if (!preg_match($emailRegex, $email)) {
        $emailErrorMessage = "Invalid Email Address";
    } else {
        $emailErrorMessage = true;
    }

    // password validation 
    if (empty($password)) {
        $passwordErrorMessage = "Password is Required";
    } else {
        $passwordErrorMessage = true;
    }

    // check all fields are valid or not
    if ($emailErrorMessage == 1 && $passwordErrorMessage == 1) {

        //legal input values
        $email = legal_input($email);
        $password = legal_input(md5($password));

        // call login function
        $loginErrorMessage = login($email, $password);
    }
}

// convert illegal input value to legal value format
function legal_input($value)
{
    return htmlspecialchars(stripslashes(trim($value)));
}

// function to insert user data into database table
function login($userInputEmail, $hashedPassword)
{



    global $db;

    // checking valid email

    /* This is a prepared statement. It is a way to prevent SQL injection. */
    $checkEmailSQL = "SELECT email FROM users WHERE email= ?";
    $checkEmailQuery = $db->prepare($checkEmailSQL);
    $checkEmailQuery->bind_param('s', $userInputEmail);
    $checkEmailQuery->execute();
    $checkEmailExecution = $checkEmailQuery->get_result();
    if ($checkEmailExecution) {
        if ($checkEmailExecution->num_rows > 0) {

            // checking email and password
            $checkEmailPasswordSQL = "SELECT email, password FROM users WHERE email=? AND password=?";
            $checkEmailPasswordQuery = $db->prepare($checkEmailPasswordSQL);
            $checkEmailPasswordQuery->bind_param('ss', $userInputEmail, $hashedPassword);
            $checkEmailPasswordQuery->execute();
            $checkEmailPasswordExecution = $checkEmailPasswordQuery->get_result();
            if ($checkEmailPasswordExecution) {
                if ($checkEmailPasswordExecution->num_rows > 0) {
                    session_start();
                    $_SESSION['email'] = $userInputEmail;
                    header("location:dashboard.php");
                } else {
                    return "Your Password is wrong";
                }
            } else {
                return $db->error;
            }
        } else {
            return $userInputEmail . " is not registered";
        }
    } else {
        return $db->error;
    }
}

?>



