<?php
//if user already login then redirect to index page
session_start();
if ( !isset($_SESSION['email'])){
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
<!-- ---------------------navbar start-------------------------------- -->
    <div class="container-fluid">
        <nav class="navbar sticky-top navbar-light" style="background-color:#e3f2fd;">
                <div class="navbar-brand">Products</div>
                    <ul class="form-inline">
                         <a href="index.php"><button class="btn btn-outline-success my-2 my-sm-0">Back To Products List</button></a>
                    </ul>
        </nav>
    </div>
<!-- ---------------------navbar end-------------------------------- -->
   <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
            <h1 class="text-center">Add Product</h1>

            <form method="post" action="insert.php" onsubmit="return check()" enctype="multipart/form-data">
            
            <?php
            // get error from insert.php
                if ( isset($_SESSION['all'])){
                    $msg=$_SESSION['all'];
                    echo "<span class=text-danger>$msg</span>";
                    unset($_SESSION['all']);
                } 
                ?>
            <div class="form-group">
                <label for="exampleInputPassword1">Product</label>
                <input type="pname" class="form-control" id="pname" name="pname" placeholder="Product Name" require>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Price</label>
                <input type="text" class="form-control" id="price" name="price" placeholder="Price" require>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Available</label>
                <input type="text" class="form-control" id="is_available" name="is_available" require placeholder="Available">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Date</label>
                <input type="date" class="form-control" id="created_date" name="created_date" require placeholder="Price">
            </div>
            <div class="form-group">
                 <label for="exampleFormControlFile1">Upload Image</label>
                 <input type="file" class="form-control-file" name="product_image" id="product_image">
                <?php

                    // get file error from insert.php
                    if ( isset($_SESSION['msg'])){
                        $msg=$_SESSION['msg'];
                        echo "<span class=text-danger>$msg</span>";
                        unset($_SESSION['msg']);// destroy session array
                    } 
                ?>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
            </div>
        
        </div>    
   </div> 
</body>
</html>