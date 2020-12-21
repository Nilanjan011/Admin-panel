<?php
//include database file
    require_once("db.php");

    session_start();

    //if user already login then redirect to index page
    if ( isset($_SESSION['email'])){
        header("location:index.php");
    }

    if (isset($_POST["submit"])) {
        // check first name empty or not
        if (isset($_POST["fname"]) && !empty($_POST["fname"])) {
            $fname=$_POST["fname"];
         
        } else {
            $fname_err="please enter your first name";
            
        }
        // check last name empty or not
        if (isset($_POST["lname"]) && !empty($_POST["lname"])) {
            $lname=$_POST["lname"];
         
        } else {
            $lname_err="please enter your last name";
            
        }
        // check email empty or not
        if (isset($_POST["email"]) && !empty($_POST["email"])) {
            $mail=$_POST["email"];
            // email already exist or not
            $sql="select email from user where email=?";
            $email_check=$con->prepare($sql);
            $email_check->bindValue(1,$mail);
            $email_check->execute();
            if ($email_check->rowCount() > 0) {
                $email_err= "Email is already exist";
            }else {
               $email=$_POST["email"];
            }
         
        } else {
            $email_err="Email must be valid";
            
        }
        //check password empty or not 
        if (isset($_POST["password"])  && !empty($_POST["password"])) {
            $pass_len=strlen($_POST["password"]);
            if ($pass_len > 5) {
                $pass=$_POST["password"];
            }else {
                $pass_err="Password must be minimum 6 charecter";
            }
        } else {
            $pass_err="please enter your password";
        }
        // echo "<pre>";
        // echo $pass;
        // die();
        // insert data  
        if (!empty($fname) && !empty($pass) && !empty($email) && !empty($lname) && !empty($pass)) {
            $insert= "INSERT INTO user (Fname,Lname,email, password) VALUES(?,?,?,?)";
            $run=$con->prepare($insert)->execute([$fname,$lname,$email,$pass]);
        }
        //after registration redirect to index.php page
        if (isset($run)) {
            $_SESSION["email"] = $_POST["email"];  
            header("location:index.php");  
        }

    }

 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registation Form </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
         .login{
            border:0 2px 0 2px;
            box-shadow: 0px 0px 15px 0px #000;
            background-color:rgb(180, 130, 130);
            margin-top: 60px;
            padding: 20px;
            border-radius:  0px 50px 0px 50px;
            -moz-border-radius:  0px 50px 0px 50px;
            -webkit-border-radius: 0px 50px 0px 50px;
         }     

    </style>

</head>
<body>
    <div class="container">
            <div class="login col-md-4 offset-md-4">
                <h1 class="text-center text-warning " >REGISTRATION</h1>

                <form action="" method="post" onsubmit="return check()">
                    <div class="form-group">
                        <label for="">First Name</label>
                        <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter first name" required>
                        <span id="fname_err"></span>
                        <?php 
                        // if first name has any error
                             if (isset($fname_err)) {
                                echo "<span class='text-danger'>$fname_err</span>";
                            }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="">Last Name</label>
                        <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter last name" required>
                        <span id="lname_err"></span>
                        <?php 
                            // if last name has any error
                             if (isset($lname_err)) {
                                echo "<span class='text-danger'>$lname_err</span>";
                            }
                        ?>
                    </div>
                    <div class="form-group">
                      <label for="email">Email </label>
                      <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter Email">
                      <span id="email_err"></span>
                      <?php 
                        // if email has any error
                             if (isset($email_err)) {
                                echo "<span class='text-danger'>$email_err</span>";
                            }
                        ?>
                    
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" class="form-control"id="password" name="password"  placeholder="Enter password" required>
                        <span id="password_err"></span>
                        <?php
                            // if password has any error 
                             if (isset($pass_err)) {
                                echo "<p class='text-danger'>$pass_err</p>";
                            }
                        ?>
                        <br>
                        <input class="btn btn-primary btn-block btm2" type="submit" name="submit" value="sumbit">
                        <div id="err"></div>
                    </div>
                </form>
            </div>
        </div>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
         function check(){
             // check password empty or not
            if(document.querySelector("#password").value=="" || document.querySelector("#password").length > 5){
                document.querySelector("#password_err").innerHTML=`<p class="text-danger text-center">Password is require and minimum 6 charecter</p>`;
                return false;
            }
            // check email empty or not
            if(document.querySelector("#email").value==""){
                document.querySelector("#email_err").innerHTML=`<p class="text-danger text-center">Email is requirer</p>`;
                return false;
            }
            // check first name empty or not
            if(document.querySelector("#fname").value==""){
                document.querySelector("#fname_err").innerHTML=`<p class="text-danger text-center">First Name is requirer</p>`;
                return false;
            }
            // check last name empty or not
            if(document.querySelector("#lname").value==""){
                document.querySelector("#lname_err").innerHTML=`<p class="text-danger text-center">Last ame is require and minimum 6 charecter</p>`;
                return false;
            }

         }

         
    </script>
</body>
</html>