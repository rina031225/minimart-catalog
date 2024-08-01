<?php
    session_start();

    require "connection.php";

    $id = $_GET['id'];
    $product = getProduct($id);
    //$product is an associative arry

    function getProduct($id){
        $conn = connection();

        $sql = "SELECT * FROM `products` WHERE `id` = '$id'";

        if($result = $conn->query($sql)){
            return $result->fetch_assoc();
        } else {
            die("Error in retrieving the product: ".$conn->error);
        }

    }


    if(isset($_POST['btn_delete'])){
        $id = $_GET['product_id'];
        
        deleteProduct($id);
    }

    function deleteProduct($id){
        $conn = connection();

        $sql = "DELETE FROM `products` WHERE `id` = '$id'";

        if($conn->query($sql)){
            header("location: products.php");
        } else {
            die("Error adding a new product: ".$conn->error);
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
    <title>Delete Product</title>

</head>
<body>
    <?php
        include("main-nav.php");
    ?>

    <div class="container mt-5 w-50 text-center">
        <div class="mx-auto w-50 text-center">
            <h1 class="display-3 mb-1"><i class="fa-solid fa-triangle-exclamation text-warning"></i></h1>
            <h2 class="text-danger fw-light mb-3">Delete Product</h2>
            <p class="fw-bold mb-0">Are you sure you wante to delete "<?= $product['name'] ?>"?</p>
        </div>
        <div class="mx-auto mt-3 text-center">
            <div class="row">
                <div class="col">
                    <a href="products.php" class="btn btn-secondary w-100">Cancel</a>
                </div>
                <div class="col">
                    <form action="" method="POST">
                        <button type="submit" name="btn_delete" class="btn btn-outline-secondary w-100"></i>Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>