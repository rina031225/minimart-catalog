<?php
    session_start();
    require "connection.php";

    if(isset($_POST['btn_log_in'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        login($username, $password);
    }

    function login($username, $password){
        $conn = connection();

        $sql = "SELECT * FROM users WHERE username = '$username'";

        if($result = $conn->query($sql)){

            // Check if the username exists in table
            if($result->num_rows == 1){
                $user = $result->fetch_assoc();

                //Check if the password entered by the user if equal to the password saved in the database
                if(password_verify($password, $user['password'])){
                    //SESSION
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['first_name'] = $user['first_name'];
                    $_SESSION['last_name'] = $user['last_name'];

                    header("location: products.php");
                    exit;
                } else {
                    echo "<div class='alert alert-danger'>Password is incorrect.</div>";
                }
            } else {
                echo "<div class='alert alert-danger'>Username not found.</div>";    
            }  
        } else {
            die("Error is retrieving the user:".$conn->error);
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
    <title>Log in</title>

</head>
<body>
    <div class="container mt-5 w-25">
        <div class="card">
            <div class="card-header">
                <h2 class="text-primary text-center">Minimart Catalog</h2>
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="mb-4">
                        <label for="username" class="form-label fw-bold">Username</label>
                        <input type="text" name="username" id="username" class="form-control">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="form-label fw-bold">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>

                    <button type="submit" name="btn_log_in" class="btn btn-primary text-center w-100 mt-4">Log in</button>
                </form>
                <div class="text-center mt-3">
                    <a href="sign-up.php">Create Account</a>
                </div>
            </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>