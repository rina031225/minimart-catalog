<?php
    session_start();
    require "connection.php";

    if(isset($_POST['btn_add'])){
        $section_name = $_POST['section_name'];

        createSection($section_name);
    }

    if(isset($_POST['btn_delete'])){
        $section_id = $_POST['btn_delete'];
        deleteSection($section_id);
    }

    function createSection($name){
        //establish the connection
        $conn = connection();

        //SQL query
        $sql = "INSERT INTO sections (`name`) VALUES ('$name')";

        //Executio of the SQL statement
        if($conn->query($sql)){
            //If the execution of the SQL statement is successful
            header("refresh: 0");
            //refresh the current page after 0 seconds
        } else {
            //If the connection fails
            die("Error adding a new section: ".$conn->error);
            //$conn->error is a generic error string holder
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

    function deleteSection($section_id){
        $conn = connection();

        $sql = "DELETE FROM sections WHERE id=$section_id";

        if($conn->query($sql)){
            header("refresh: 0");
        } else {
            die("Error deleting the section: ".$conn->error);
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
    <title>Sections</title>

</head>
<body>
    <?php
        include("main-nav.php");
    
    ?>
    <div class="cotainer mt-5 w-50 mx-auto">
        <h2 class="fw-light mb-3">Sections</h2>
        <form action="" method="POST">
            <div class="row">
                <div class="col-9">
                    <input type="text" name="section_name" id="section_name" class="form-control" placeholder="Add a new section here..." max="50" required/>
                </div>
                <div class="col-3 p-0">
                    <button type="submit" name="btn_add" class="btn btn-info fw-bold"><i class="fa-solid fa-plus"></i>Add</button>
                </div>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table  bordered mt-3 w-100 text-center">
                <thead class="table-info">
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $all_sections = getAllSections();
                        while($section = $all_sections->fetch_assoc()){
                            //fetch_assoc() transforms the result into an associative array
                            //$section is an associative array

                    ?>
                    <tr>
                        <td><?= $section['id']?></td>
                        <td><?= $section['name']?></td>
                        <td>
                            <form action="" method="POST">
                                <button type="submit" name="btn_delete" value="<?= $section['id'] ?>" class="btn btn-outline-danger border-0" title="Delete"><i class="fa-solid fa-trash-can"></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php

                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>


