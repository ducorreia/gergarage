<?php
//Trim the signUp input !
include "config.php";
$fname = trim($_POST["fname"]);
$surname=trim( $_POST['sName']);
$email= trim($_POST['email']);
$mNumber= trim($_POST['mNumber']);
$address=trim( $_POST['address']);
$address2=trim( $_POST['address2']);
$eircode= trim($_POST['eircode']);
$password=trim( $_POST['password']);



// Query to insert new user on the database

$sql = "INSERT INTO user (fname, sName, email, mNumber, address, address2, eircode, password) values 
('$fname','$surname',' $email','$mNumber','$address','$address2','$eircode','$password')";

if ($link->query($sql) === TRUE) {
    echo "New record created successfully";

    session_start();
    $_SESSION['id_user'] = mysqli_insert_id($link);
    $_SESSION['user_name'] = $fname;
    $_SESSION['user_email'] = $email;
    $_SESSION['user_surname'] = $surname;
    $_SESSION['user_type'] = 'g';
}

$link->close();
header("Location: loggedInIndex.php");


?>