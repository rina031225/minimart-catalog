<?php
    session_start();
    require "connection.php";

    function getAllProducts(){
        $conn = connection();

        $sql = "
            SELECT
                products.id,
                products.name,
                products.description,
                products.price,
                sections.name AS section
            FROM
                products
            INNER JOIN sections ON products.section_id = sections.id
            ORDER BY products.id
        ";

        // var_dump($sql);
        if($result = $conn->query($sql)){
            return $result;
        } else {
            die("Error in retrieving all products".$conn->error);
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
    <title>Products</title>

</head>
<body>
    <?php
        include("main-nav.php");
    
    ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <h2 class="fw-light">Products</h2>
            </div>
            <div class="col text-end">
                <form action="" method="POST">
                    <a href="add-product.php" class="btn btn-success"><i class="fa-solid fa-circle-plus"></i> New Product</a>
                </form>
            </div>
        </div>
        <table class="table bordered mt-4">
            <thead class="table-success">
                <tr>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>DESCRIPTION</th>
                    <th>PRICE</th>
                    <th>SECTION</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $all_products = getAllProducts();
                    while($product = $all_products->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?= $product['id']?></td>
                        <td><?= $product['name']?></td>
                        <td><?= $product['description']?></td>
                        <td><?= $product['price']?></td>
                        <td><?= $product['section']?></td>
                        <td>
                            <a href="update-product.php?id=<?=$product['id']?>" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-pencil"></i></a>
                            <a href="delete-product.php?id=<?=$product['id']?>" class="btn btn-outline-danger btn-sm ms-2"><i class="fa-solid fa-trash-can"></i></a>
                        </td>
                    </tr>
                <?php

                    }
                ?>
            </tbody>
        </table>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>