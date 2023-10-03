<?php
session_start();
require "connect.php";

if (isset($_SESSION['username'])) {
    header("location: members.php");
}

if (isset($_POST['submit'])) {
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
   
    if ($fullName == "" || $email == "" || $password == "" || $confirmpassword == "") {
        echo "Please fill all fields";
    } else {
        if ($password != $confirmpassword) {
            echo "Passwords do not match";
        } else {
            //This is where the errors are found
            $query = mysqli_query($test, "SELECT * FROM users WHERE username = '$user' ") or die("Cannot query table");

            $row = mysqli_num_rows($query);
            if ($row == 1) {
                echo "This username is already taken";
            } else {
                $add = mysqli_query($test, "INSERT INTO registration ( fullName, email, password, confirmpassword ) VALUES
    (null, '$fullName', '$email', '$password', '$confirmpassword') ") or die("Cant insert data");
                echo "Successfully added user!";
            }
        }
    }
}
?>