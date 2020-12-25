<?php
//include database file
require_once("db.php");

//if user not login then redirect to login page
session_start();
if ( !isset($_SESSION['email'])){

    header("location:login.php");
}

if (isset($_GET['id'])) {
    try {
        //fetch data 
        $sql="select * from product where product_id={$_GET["id"]}";
        $stmt=$con->prepare($sql);
        $stmt->execute();
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
// undefined $stmt and $ con
        unset($con);
        unset($stmt);
        
    } catch (\Throwable $th) {
            echo "the error is $th"; 
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit data</title>
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
                         <a href="index.php"><button class="btn btn-outline-success my-2 my-sm-0">Back To Product</button></a>
                    </ul>
        </nav>
    </div>
<!-- ---------------------navbar end-------------------------------- -->
   <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
            <h1 class="text-center"> Update Product</h1>
            <form method="post" action="update.php" enctype="multipart/form-data">
            
            <?php
            // get file error from update.php
                if ( isset($_SESSION['all'])){
                    $msg=$_SESSION['all'];
                    echo "<span class='text-danger'>$msg</span>";
                    unset($_SESSION['all']);// destroy session array
                }
            ?>
            <div class="form-group">
                <label for="exampleInputPassword1">Product</label>
                <input type="pname" class="form-control" id="pname" name="pname" value="<?php if (isset($row['pname'])) { echo $row['pname']; } ?>" require>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Price</label>
                <input type="text" class="form-control" id="price" name="price" value="<?php if (isset($row['price'])) { echo $row['price']; } ?>" require>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Available</label>
                <input type="text" class="form-control" id="is_available" name="is_available" require value="<?php if (isset($row['is_available'])) { echo $row['is_available']; } ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Date</label>
                <input type="text" class="form-control" id="created_date" name="created_date" require value="<?php if (isset($row['create_date'])) { echo $row['create_date']; } ?>">
            </div>
            <div class="form-group">
                 <label for="exampleFormControlFile1">Upload Image</label>
                 <p class="text-danger"></p>
                 <input type="file" class="form-control-file" name="product_image" id="product_image" require >
                 <input type="hidden" name="id" value="<?php echo $_GET['id'];?>">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
            </div>
        
        </div>    
   </div> 
</body>
</html>