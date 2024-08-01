<?php
    session_start();
    require "connection.php";

    $id = $_GET['id'];
    $product = getProduct($id);
    //$product is an associative arry

    function getProduct($id){
        $conn = connection();

        $sql = "SELECT * FROM products WHERE id=$id";

        if($result = $conn->query($sql)){
            return $result->fetch_assoc();
        } else {
            die("Error in retrieving the product: $conn->error");
        }

    }

    if(isset($_POST['btn_add'])){
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $section_id = $_POST['section_id'];

        createProduct($name, $description, $price, $section_id);
    }

    function getAllProducts(){
        $conn = connection();

        $sql = "SELECT * FROM products";

        if($result = $conn->query($sql)){
            return $result;
        } else { 
            die("Error in retrieving all products: ".$conn->error);
        }
    }

    function createProduct($name, $description, $price, $section_id){
        $conn = connection();

        $sql = "INSERT INTO products (`name`, `description`, `price`, `section_id`) VALUES ('$name', '$description', $price, $section_id)";

        if($conn->query($sql)){
            header("location: products.php");
            exit();
        } else {
            die("Error adding a new product: ".$conn->error);
        }
    }

    function getAllSections(){
        $conn = connection();

        $sql = "SELECT * FROM sections";

        if($result = $conn->query($sql)){
            return $result;
        } else { 
            die("Error in retrieving all sections: ".$conn->error);
        }
    }

    if(isset($_POST['btn_update'])){
        $name = $_POST['name'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $section_id = $_POST['section_id'];
        $id = $_GET['id'];

        updateProduct($name, $description, $price, $section_id, $id);
    }

    function updateProduct($name, $description, $price, $section_id, $id){
        $conn = connection();

        $sql = "UPDATE products SET `name` = '$name', `description` = '$description', `price` = $price, `section_id` = $section_id WHERE id = $id";
        var_dump($sql);

        if($conn->query($sql)){
            header("location: products.php");
            exit();
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
    <title>Update Product</title>

</head>
<body>
    <?php
        include("main-nav.php");
    ?>
    <div class="container w-25 mt-5 mx-auto">
        <h2 class="fw-light mb-3">Edit Product</h2>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label small fw-bold">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="<?= $product['name']?>" max=50 required/>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label small fw-bold">Description</label>
                <textarea name="description" id="description" rows="5" class="form-control" required><?= $product['description']?></textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label small fw-bold">Price</label>
                <div class="input-group">
                    <div class="input-group-text">$</div>
                    <input type="number" name="price" id="price" class="form-control" value="<?= $product['price']?>" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="section" class="form-label small fw-bold">Section</label>
                <select name="section_id" id="section-id" class="form-select" required>
                    <option value="" hidden>Select Section</option>
                    <?php
                        $all_sections = getAllSections();
                        while($section = $all_sections->fetch_assoc()){
                            if($section['id'] == $product['section_id']){
                                echo "<option value='".$section['id']."'selected>".$section['name']."</option>";
                            } else {
                                echo "<option value='".$section['id']."'>".$section['name']."</option>";
                            }
                        }

                    ?>
                </select>
            </div>
            <a href="products.php" class="btn btn-outline-secondary">Cancel</a>
            <button type="submit" name="btn_update" class="btn btn-secondary fw-bold px-5"><i class="fa-solid fa-check me-1"></i>Save changes</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>