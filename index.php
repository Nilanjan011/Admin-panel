<?php
//include database file
require_once("db.php");
//if user not login then redirect to login page
session_start();
if ( !isset($_SESSION['email'])){

    header("location:login.php");
}
// delete any row
if (isset($_POST["delete"])) {
    $sql="DELETE FROM product WHERE product_id={$_POST["id"]}";
    $con->prepare($sql)->execute();
    unlink("./images/".$_POST['img']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

<!-- -----------datatable plugin---------------- -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
   <script src=" https://code.jquery.com/jquery-3.5.1.js"></script> 
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<!-- -----------datatable plugin------------------- -->
</head>
<script>
// datatable zero confirgration js code
$(document).ready(function() {
    $('#example').DataTable();
});
</script>
<body>
<!-- ---------------------navbar start-------------------------------- -->
    <div class="container-fluid">
        <nav class="navbar sticky-top navbar-light" style="background-color:#e3f2fd;">
                <div class="navbar-brand">Products</div>
                    <ul class="form-inline">
                         <a href="add.php"><button class="btn btn-outline-success my-2 my-sm-0">Add</button></a>
                         <a href="logout.php?out=true"><button class=" btn btn-danger ml-2 ml-sm-3"">Logout</button></a>
                    </ul>
        </nav>
    </div>
<!-- ---------------------navbar end-------------------------------- -->
<!-- -------------------display record------------------------------------------------------ -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <h1 class="text-center">Products List</h1>
        <!-- --------------------------------table start------------------------------ -->
                <table class="table table-hover display"  id="example">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">price</th>
                        <th scope="col">Available</th>
                        <th scope="col">Image</th>
                        <th scope="col">Date</th>
                        <th scope="col" style="color:blue;">Update</th>
                        <th scope="col" style="color:red;">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php  
                    // fetch all data
                        $sql="select * from product";
                        $stmt=$con->prepare($sql);
                        $stmt->execute();
                        $i=1;
                        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                        {
                        // Display all data
                    ?>
                        <tr>
                            <th scope="row"><?php echo $i; ?></th>
                            <?php $i=$i+1; ?>
                            <td><?php echo $row['pname']; ?></td>
                            <td><?php echo $row['price']; ?></td>
                            <td><?php echo $row['is_available']; ?></td>
                            <td><?php echo "<img src='images/{$row['product_image']}' alt=prodect width='50' height='50'"; ?></td>
                            <td><?php echo $row['create_date']; ?></td>
                            <td> <a href="edit.php?id=<?php echo $row['product_id'];?>" name="edit" class="btn btn-outline-primary" >Update</a> </td>
                            <td><form action="" onclick="return confirm('Do you want to delete')" method="post">
                            <input type="hidden" name="id" value="<?php echo $row['product_id']; ?>">
                            <input type="hidden" name="img" value="<?php echo $row['product_image']; ?>">
                            <input type="submit" name="delete" class="btn btn-danger" value="Delete"> </form></td>
            
                        </tr>
                        <?php
                        }
                        // undefined $stmt and $ con
                        unset($con);
                        unset($stmt);
                        ?>
                    </tbody>
                </table>
            <!-- --------------------------------table end------------------------------ -->
            </div>
        </div>
    </div>

</body>
</html>