<?php
//Get the path of an uploaded image and store it into database and access it later for displaying the image.
function getImagePath($connection, $image_name, $image_type)
{
    $image_path = "";
    $image_path_sql = "SELECT image_path FROM images WHERE image_name = ? AND image_type = ?";
    $image_path_statement = $connection->prepare($image_path_sql);
    $image_path_statement->bind_param("ss", $image_name, $image_type);
    $image_path_statement->execute();
    $image_path_statement->bind_result($image_path);
    $image_path_statement->fetch();
    return $image_path;
}

//to store the path of an uploaded image in the database.
function storeImagePath($connection, $image_name, $image_type, $image_path)
{
    $image_path_sql = "INSERT INTO images (image_name, image_type, image_path) VALUES (?, ?, ?);";
    $image_path_statement = $connection->prepare($image_path_sql);
    $image_path_statement->bind_param("sss", $image_name, $image_type, $image_path);
    $image_path_statement->execute();
}


//Get the path of an uploaded image and store it into database and access it later for displaying the image?
//move_uploaded_file($tmp_name, "$uploads_dir/$name");
//Here the second argument is the destination. You can set it yourself.
//You just have to insert it into the database for retrieving the file later.

