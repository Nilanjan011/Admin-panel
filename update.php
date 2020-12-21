<?php
//include database file
require_once("db.php");

//if user not login then redirect to login page
session_start();
if ( !isset($_SESSION['email'])){
    header("location:login.php");
}

$id=$_POST['id'];// store id

if (isset($_POST['submit'])) {
    //check all input empty or not
    if(empty($_POST["pname"]) || empty($_POST["price"] || empty($_POST["is_available"]) || empty($_POST["created_date"]) ))  
    {   
        $_SESSION['all'] = '<label>All fields are required</label>';  //it show in edit.php   
        header("location:edit.php");
    }  

    $pname=$_POST['pname'];
    $price=$_POST['price'];
    $is_available=$_POST['is_available'];
    $created_date=$_POST['created_date'];
    $product_image=$_FILES['product_image'];
    $img=$product_image['name'];

    if (isset($img) && $img!="") {// new image update 
        $sql="update product set pname=?, price=?,is_available=?,product_image=?,create_date=? where product_id=?";
        $run=$con->prepare($sql)->execute([$pname,$price,$is_available,$img,$created_date,$id]);
        move_uploaded_file($product_image['tmp_name'],"images/".$product_image['name']);
        
    }else{
        // without image update 
        $sql="update product set pname=?, price=?,is_available=?,create_date=? where product_id=?";
        $run=$con->prepare($sql)->execute([$pname,$price,$is_available,$created_date,$id]);
      
    }
    // redirect to index.php
    if($run){
       header("location:index.php");
    }
}
