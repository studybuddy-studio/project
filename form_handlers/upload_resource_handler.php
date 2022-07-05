<?php
require_once "../config.php";
require_once "utils.php";


function validateTitle($value)
{
    /* Checking if the title is not empty. */
    if (empty($value)) {
        return " Title is required.";
    }
    if (!preg_match("/^[a-zA-Z0-9 ']$/", $value)) {
        return "Title must contain only english letters, numbers, 's and spaces.";
    }
    if (strlen($value) > 100) {
        return "Title must be less than 100 characters long.";
    }
    return "";
}

function validateCategory($value)
{
    /* Checking if the category is not empty. */
    if (empty($value)) {
        return " Please select a category.";
    }
    return "";
}

function validateShortDescription($value)
{

    /* Checking if the short description is not empty. */
    if (empty($value)) {
        return " Short description is required.";
    }
    if (!preg_match("/^[a-zA-Z0-9-, '.]*$/", $value)) {
        return "Short description must contain only english letters, numbers, hyphen, commas, 's and spaces.";
    }
    //to check if the short description is less than or equal to 500 characters.
    if (strlen($value) > 500) {
        return "Short description must be less than or equal to 500 characters.";
    }
    return "";
}

function validateLongDescription($value)
{
    $longDescription = sanitizeInput($value);
//    if (!preg_match("/^[a-zA-Z0-9 ']*$/", $value))
//    {
//        return "Long description must contain only english letters, numbers, 's and spaces.";
//    }
    return "";
}


function validateFileOrLongDescription($longDescription, $file)
{
    /**
     * If the long description is empty and the file is empty, return an error message. If the file is not empty, check the
     * file extension. If the file extension is not allowed, return an error message.
     *
     * @param longDescription The long description of the book.
     * @param file The file to be uploaded.
     *
     * @return the error message.
     */
    if (empty($longDescription) && empty($file)) {
        return "Please enter either a long description or a file.";
    }
    // If file is not empty, check for the file extension.
    if (!empty($file)) {
        $ACCEPTABLE_FILE_EXTENSIONS = array("jpg", "jpeg", "png", "pdf", "epub");
        $file_extension = pathinfo($file, PATHINFO_EXTENSION);
//        Convert the file extension to lower case.
        $file_extension = strtolower($file_extension);
        if (!in_array($file_extension, $ACCEPTABLE_FILE_EXTENSIONS)) {
            return "File extension is not allowed.";
        }
    }
    return "";
}

function validateHeaderImage($file)
{
    /**
     * If the file is not empty, check for the file extension. If the file extension is not allowed, return an error
     * message.
     *
     * @param file The file to be uploaded.
     *
     * @return the error message.
     */
    if (!empty($file)) {
        $ACCEPTABLE_FILE_EXTENSIONS = array("jpg", "jpeg", "png");
        $file_extension = pathinfo($file, PATHINFO_EXTENSION);
//        Convert the file extension to lower case.
        $file_extension = strtolower($file_extension);
        if (!in_array($file_extension, $ACCEPTABLE_FILE_EXTENSIONS)) {
            return "File extension is not allowed.";
        }
    }
    return "";
}

function splitAuthors($value)
{
    /* Splitting the string into an array. */
    $authors = explode(",", $value);
    /* Creating an empty array. */
    $sanitized_authors = array();
    foreach ($authors as $author) {
        /* Sanitizing the author's name. */
        $_author = sanitizeInput($author);
        /* Checking if the author is not empty. */
        if ($_author != "") {
            /* Adding the sanitized author to the array. */
            $sanitized_authors[] = ucwords($_author);
        }
    }
    return $sanitized_authors;
}

function validateAuthors($value)
{
    /* Checking if the authors is not empty. */
    if (empty($value)) {
        return " Authors is required.";
    }
    if (!preg_match("/^[a-zA-Z0-9 ']*$/", $value)) {
        return "Authors must contain only english letters, numbers, 's and spaces.";
    }
    return "";
}

function createAuthors($connection, $list_of_authors)
{
    /* Creating a SQL statement that will insert a new author into the database. */
    $create_author_sql = "INSERT INTO authors (name) VALUES (?)";
    /* Preparing the SQL statement. */
    $create_author_statement = $connection->prepare($create_author_sql);
    /* Creating an empty array. */
    $inserted_authors = array();
    /* Looping through the array of authors. */
    foreach ($list_of_authors as $author) {
        /* Executing the SQL statement. */
        $create_author_statement->execute([$author]);
        /* Getting the last inserted id. */
        $inserted_authors[] = $connection->insert_id;
    }
    return $inserted_authors;
}

//to upload the values to sql.
function uploadResource($connection, $title, $category, $short_description, $long_description, $content, $content_extension, $uploaded_by)
{
    /* Creating a SQL statement that will insert a new resource into the database. */
    $create_resource_sql = "INSERT INTO Resource (title, category, short_description, long_description, content, content_extension, uploaded_by) VALUES (?, ?, ?, ?, ?, ?, ?)";
    /* Preparing the SQL statement. */
    $create_resource_statement = $connection->prepare($create_resource_sql);
    /* Executing the SQL statement. */
    $create_resource_statement->execute([$title, $category, $short_description, $long_description, $content, $content_extension, $uploaded_by]);
    /* Getting the last inserted id. */
    // $resource_id = $connection->insert_id;
    /* Creating a SQL statement that will insert a new author-resource relationship into the database. */
    $create_author_resource_sql = "INSERT INTO author_resource (author_id, resource_id) VALUES (?, ?)";
    /* Preparing the SQL statement. */
    $create_author_resource_statement = $connection->prepare($create_author_resource_sql);
    /* Looping through the array of authors. */
}


if (isset($_POST['upload'])) {

    //    Extract all the data from the form.
    $title = ucwords($_POST['title']);
    $category = $_POST['category'];
    /* Sanitizing the input from the form. */
    $short_description = sanitizeInput($_POST['short_description']);
    $long_description = $_POST['long_description'];
    $authors = $_POST['authors'];
    $resource_file = $_FILES['resource_file'];
    $header_image = $_FILES['header_image'];

    //    echo all the data to the console.
    echo $title . "<br>";
    echo $category . "<br>";
    echo $short_description . "<br>";
    echo $long_description . "<br>";
    echo $authors . "<br>";
    var_dump($resource_file, $header_image);
}
