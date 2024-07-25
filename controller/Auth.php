<?php
include "../index.php";

// Logout Controller 
if (isset($_POST["logout"])) {
    $loginobj->logout();
}


// Login Controller 
if (isset($_POST["login"])) {
    $token = bin2hex(random_bytes(16));
    $data = [
        "username" => $_POST["username"],
        "password" => $_POST["password"],
        "token" => $token,
        "remember" => $_POST["remember"] ?? null
    ];
    $loginobj->userLogin($data);
}

// Register Controller 
if (isset($_POST["register"])) {


    // Upload File 
    $filename = $_FILES["profilephoto"]["name"];
    $tempname = $_FILES["profilephoto"]["tmp_name"];
    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
    $unique_filename = uniqid() . '_' . time() . '.' . $file_extension;
    $folder = "../public/uploads/" . $unique_filename;
    if (move_uploaded_file($tempname, $folder)) {
        echo "file uploaded successfully!!";
    } else {
        echo "something went wrong";
    }

    $data = [

        "username" => $_POST["username"],
        "password" => $_POST["password"],
        "first_name" => $_POST["firstname"],
        "last_name" => $_POST["lastname"],
        "email" => $_POST["email"],
        "profile_photo" => $unique_filename,
    ];
    $registerobj->addUser($data);
}