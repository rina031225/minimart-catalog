<?php
session_start();
require "connection.php";


if(isset($_POST['btn_sign_up'])){
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    //Check if the $password and the $confirm_password are the same
    if($password == $confirm_password){
        //Call the function to insert record to the database
        createUser($first_name, $last_name, $username, $password, $confirm_password);
    } else {
        echo "<div class='alert alert-danger'>Password and confirm password do not match</div>";
    }
}

function createUser($first_name, $last_name, $username, $password){
    $conn = connection();

    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (`first_name`, `last_name`, `username`, `password`)
    VALUES ('$first_name', '$last_name', '$username', '$password')";

    if($conn->query($sql)){
        header("location: login.php");
        exit;
    } else {
        die("Error in signing up: ".$conn->error);
    }


}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <title>Sign Up</title>

</head>
<body>
    <div class="container mt-5 w-25">
        <div class="card">
            <div class="card-header">
                <h2 class="text-success">Create your account</h2>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="mb-4">
                        <label for="first_name" class="form-label fw-bold">First Name</label>
                        <input type="text" name="first_name" id="first_name" class="form-control">
                    </div>
                    <div class="mb-4">
                        <label for="last_name" class="form-label fw-bold">Last Name</label>
                        <input type="text" name="last_name" id="last_name" class="form-control">
                    </div>
                    <div class="mb-4">
                        <label for="username" class="form-label fw-bold">Username</label>
                        <input type="text" name="username" id="username" class="form-control">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label fw-bold">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="mb-4">
                        <label for="confirm_password" class="form-label fw-bold">Confirm Password</label>
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control">
                    </div>

                    <button type="submit" name="btn_sign_up" class="btn btn-success text-center w-100 mt-4">Sign up</button>
                </form>
                <p class="text-center mt-3">Already have an account?<a href="login.php">Log in</a></p>
            </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>