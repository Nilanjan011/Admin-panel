<?php
//if user already login then redirect to index page
session_start();
if ( isset($_SESSION['email'])){

    header("location:index.php");
}

//include database file
require_once("db.php");


try {
if(isset($_POST["submit"]))  
{  
    // email and password eampty or not 
     if(empty($_POST["email"]) || empty($_POST["password"]))  
     {  
          $message = '<label>All fields are required</label>';  
     }  
     else  
     {  
          // check user email and password valid or not 
          $query = "SELECT * FROM user WHERE email = :email AND password = :password";  
          $statement = $con->prepare($query);  
          $statement->execute(  
               array(  
                    'email'     =>     $_POST["email"],  
                    'password'     =>     $_POST["password"]  
               )  
          );  
          // count number of row
          $count = $statement->rowCount();
          // undefined $statement and $ con
        //   unset($con);
        //   unset($statement);
          if($count > 0)  
          {  
              // if  user email and password is valid then create session and redirect to index.php page
               $_SESSION["email"] = $_POST["email"];  
               header("location:index.php");  
          }  
          else  
          {  // if user email and password is not valid then show error message
               $message = '<label> Email or Password does not match</label>';  // if  user email and password invalid 
          }  
     }  
}  
}  
catch(PDOException $error)  
{  
$message = $error->getMessage();  
}  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log In</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <style>
    
         .login{
            box-shadow: 0px 0px 15px 0px #000;
            margin-top: 60px;
            padding: 20px;
            background-color: #f8d7da;
            border-radius: 60px 0px 60px 0px;
            -moz-border-radius: 60px 0px 60px 0px;
            -webkit-border-radius: 60px 0px 60px 00px;
            
         }
         
    </style>
</head>
<body>
    <div class="container">
        <div class="login col-md-4 offset-md-4">
            <h1 class="text-center alert alert-danger " >LOG IN</h1>
            <?php  
                if(isset($message))  
                {  
                     echo '<label class="text-danger">'.$message.'</label>';  
                }  
                ?>  
            <form action="" onsubmit="return check()"  method="post">
            <div class="form-group">
                <label for="email">Email </label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter Email" require>    
             </div>
                <div class="form-group">
                    <label for="">password</label>
                    <input type="password" class="form-control"id="password" name="password"  placeholder="Enter password"><br>
                    <input class="btn btn-primary btn-block btm2" type="submit" name="submit" value="Sumbit">
                </div>
            </form>
             <p class="err" ></p> <!--error display using javascript -->
             <p>Not a member?<a href="registration.php">Register</a></p>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <script>
        
        function check(){
            // check email and password empty or not
            if((document.querySelector("#password").value=="") || (document.querySelector("#email").value=="")){
                document.querySelector(".err").innerHTML=`<p class="text-danger text-center">your email and password can't blank</p>`;
                return false;
            }

        }
    
    </script>

</body>
</html>