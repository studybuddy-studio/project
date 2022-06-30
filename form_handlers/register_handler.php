<?php
require_once "../config.php";
require_once "utils.php";

function validateName($value, $type)
{
//    Empty check
    if (empty($value)) {
        return $type . " name is required.";
    }
//    Length check
    if (strlen($value) < 2) {
        return $type . " name must be at least 2 characters long.";
    }
//    Special characters check
    if (!preg_match("/^[a-zA-Z ]*$/", $value)) {
        return $type . " name must contain only english letters and spaces.";
    }
    return "";
}

function validateEmail($connection, $value)
{
//    Empty check
    if (empty($value)) {
        return "Email is required.";
    }
//    Regex check
    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
        return "Invalid email format.";
    }
//    Check if email already exist.
    $email_check_SQL = "SELECT * FROM user WHERE email=?;";
    $email_check_query = $connection->prepare($email_check_SQL);
    $email_check_query->bind_param('s', $value);
    $email_check_query->execute();
    $email_check_execution = $email_check_query->get_result();
    if ($email_check_execution->num_rows == 1) {
        return "Email already registered";
    }
    return "";
}

function validatePassword($value_one, $value_two)
{
//    Empty check
    if (empty($value_one)) {
        return "Password is required.";
    }
//    Length check
    if (strlen($value_one) < 6) {
        return "Password must be at least 6 characters long.";
    }
//    Match check
    if ($value_one != $value_two) {
        return "Passwords do not match.";
    }
    return "";
}

function validateDateOfBirth($value)
{
//    Empty check
    if (empty($value)) {
        return "Date of birth is required.";
    }
    $dob = date_create($value);
    $dob_year = date_format($dob, "Y");
    $current_year = date("Y");
    var_dump(intval($dob_year));
    var_dump(intval($current_year) - 3);
    //  Check if the year is greater than or equal to the current year minus 3.
    if (intval($dob_year) >= intval($current_year) - 3) {
        return "You must be at least 3 years old to register.";
    }
    return "";
}

function validateTNC($value)
{
//    Empty check
    if (empty($value)) {
        return "No data sent";
    } elseif ($value == "off") {
        return "You must accept the terms and conditions.";
    }
    return "";
}

function register($connection, $first_name, $last_name, $email, $password, $date_of_birth)
{
    $hashedPassword = md5($password);
    $registerSQL = "INSERT INTO `user` (`first_name`, `last_name`, `email`, `password`, `date_of_birth`) VALUES (?, ?, ?, ?, ?)";
    $registerStatement = $connection->prepare($registerSQL);
    $registerStatement->bind_param('sssss', $first_name, $last_name, $email, $hashedPassword, $date_of_birth);
    $registerStatement->execute();
    return $registerStatement;
}


function redirectToIndexPage($email, $first_name, $last_name)
{
    session_start();
    $_SESSION['email'] = $email;
    $_SESSION['first_name'] = $first_name;
    $_SESSION['last_name'] = $last_name;
    header("Location:../index.php");
}

if (isset ($_POST['register'])) {
    $first_name = sanitizeInput($_POST['first_name']);
    // Convert into title case.
    $first_name = ucwords($first_name);
    $last_name = sanitizeInput($_POST['last_name']);
    $last_name = ucwords($last_name);
    /* Sanitizing the input from the form. */
    $email = sanitizeInput($_POST['email']);
    $date_of_birth = ($_POST['date_of_birth']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $tnc = $_POST['tnc'];

    $error_array = array(
        "first_name_error" => validateName($first_name, "First"),
        "last_name_error" => validateName($last_name, "Last"),
        "email_error" => validateEmail($connection, $email),
        "password_error" => validatePassword($password, $confirm_password),
        "date_of_birth_error" => validateDateOfBirth($date_of_birth),
        "tnc_error" => validateTNC($tnc)
    );

    /* Checking if any of the keys in the array contains a non-empty string. */
    $error_flag = false;
    foreach ($error_array as $key => $value) {
        if (!empty($value)) {
            $error_flag = true;
            break;
        }
    }

    if (!$error_flag) {
        $register_success = register($connection, $first_name, $last_name, $email, $password, $date_of_birth);
        if ($register_success) {
            redirectToIndexPage($email, $first_name, $last_name);
        }
    } else {
        $query_string = http_build_query($error_array);
        header("Location:../register.php?$query_string");
    }

}