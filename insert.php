<?php
//include database file
require_once("db.php");

//if user already login then redirect to index page
session_start();
if ( !isset($_SESSION['email'])){

    header("location:login.php");
}

if (isset($_POST['submit'])) 
{
    // check all  input are empty or not 
    if(empty($_POST["pname"]) || empty($_POST["price"] || empty($_POST["is_available"]) || empty($_POST["created_date"]) ))  
     {  
        $_SESSION['all'] = '<label>All fields are required</label>'; // it show in add.php file  
        header("location:add.php");
    }  

    
    $pname=$_POST['pname'];
    $price=$_POST['price'];
    $is_available=$_POST['is_available'];
    $created_date=$_POST['created_date'];
    $product_image=$_FILES['product_image'];
    
    $img=$product_image['name'];
  
    //check image select or not
    if ($img==="") {
        $_SESSION['msg']="image is require";
        header("location:add.php");
        return;
    }

    // check image is exist or not
    if ( file_exists("images/".$product_image['name']) ) {
        $_SESSION['msg']="image already exits";
        header("location:add.php");
        return;
    }
//move to server file
    move_uploaded_file($product_image['tmp_name'],"images/".$product_image['name']);
// insert all data in database
    $insert= "INSERT INTO product (pname,price,is_available,product_image,create_date) VALUES(?,?,?,?,?)";
    $run=$con->prepare($insert)->execute([$pname,$price,$is_available,$img,$created_date]);
  // undefined $stmt and $ con  
    unset($con);
    unset($run);
    // after insert redirect to index.php file
    header("location:index.php");
    
}
?>