<?php
require_once "config.php";
require_once "utils.php";

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


if (isset($_POST['upload'])) {

//    Extract all the data from the form.
    $title = $_POST['title'];
    $category = $_POST['category'];
    $short_description = $_POST['short_description'];
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
