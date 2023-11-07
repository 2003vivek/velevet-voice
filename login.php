<?php
require "db_connect.php";
include "signup_process.php";

$db_object=new database_connection;
$conn=$db_object->connect();
$_SESSION['loggedin']=FALSE;
if($_SERVER['REQUEST_METHOD']=="POST"){

$password=$_POST['password'];
$pass_hash=password_hash($password,PASSWORD_DEFAULT);
$email=$_POST['email'];
    $query="SELECT * FROM chatlogin WHERE `email`='$email'";
    $result=mysqli_query($conn,$query);
    $num=mysqli_num_rows($result);
    
    if($num>0){
        while($row=mysqli_fetch_assoc($result)){
        
            $tr=password_verify($password,$row['password']);
            if($tr){
                session_start();
                $_SESSION['loggedin']=TRUE;
                $_SESSION['email']=$email;
                $_SESSION['name']=$row['name'];
                $_SESSION['date_time']=$row['date_time'];
                $_SESSION['country']=$row['country'];
                $_SESSION['city']=$row['city'];
                // header('location: index.php');
                header('location: themesbrand.com/index-dark.php');
            }
            
        }
    }
    

}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Let'z Chat</title>
    <style>
        #bod{
          /* background-color: #fa060630; */
          background: linear-gradient(#481c67,#ff000000,#8a07f4);
        }
        .card-registration .select-input.form-control[readonly]:not([disabled]) {
        font-size: 1rem;
        line-height: 2.15;
        padding-left: .75em;
        padding-right: .75em;
        }
        .card-registration .select-arrow {
        top: 13px;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body id='bod'>
    <div class="container my-5">
    <section class="h-100 bg-dark">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col">
        <div class="card card-registration my-4">
          <div class="row g-0">
            <div class="col-xl-6 d-none d-xl-block">
              <img src="https://a.slack-edge.com/9c84081/marketing/img/solutions/tech/png/billboard.png"
                alt="Sample photo" class="img-fluid"
                style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;" />
            </div>
            <div class="col-xl-6">
              <div class="card-body p-md-5 text-black">
                <h3 class="mb-5 text-uppercase">LogiN</h3>
                <form action="login.php" method="post">
                  <?php
                  if($_SESSION['loggedin']!=TRUE){
                  
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Failed!</strong>  Unable to Login. Please check the Credentials
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
                  }
                  
                  ?>

                <div class="row">
                  
                  </div>
                  <!-- <div class="col-md-6 mb-4">
                    <div class="form-outline">
                      <input type="text" id="form3Example1n" class="form-control form-control-lg" />
                      <label class="form-label" for="form3Example1n">Last name</label>
                    </div> -->
                  <!-- </div>
                </div> -->

                <!-- <div class="row">
                  <div class="col-md-6 mb-4">
                    <div class="form-outline">
                      <input type="text" id="form3Example1m1" class="form-control form-control-lg" />
                      <label class="form-label" for="form3Example1m1">Mother's name</label>
                    </div>
                  </div>
                  <div class="col-md-6 mb-4">
                    <div class="form-outline">
                      <input type="text" id="form3Example1n1" class="form-control form-control-lg" />
                      <label class="form-label" for="form3Example1n1">Father's name</label>
                    </div>
                  </div>
                </div> -->

                <!-- <div class="form-outline mb-4">
                  <input type="text" id="form3Example8" class="form-control form-control-lg" />
                  <label class="form-label" for="form3Example8">Address</label>
                </div> -->

                

                <!-- <div class="row">
                  <div class="col-md-6 mb-4">

                    <select class="select">
                      <option value="1">State</option>
                      <option value="2">Option 1</option>
                      <option value="3">Option 2</option>
                      <option value="4">Option 3</option>
                    </select>

                  </div>
                  <div class="col-md-6 mb-4">

                    <select class="select">
                      <option value="1">City</option>
                      <option value="2">Option 1</option>
                      <option value="3">Option 2</option>
                      <option value="4">Option 3</option>
                    </select>

                  </div>
                </div> -->

                <!-- <div class="form-outline mb-4">
                  <input type="text" id="form3Example9" class="form-control form-control-lg" />
                  <label class="form-label" for="form3Example9">DOB</label>
                </div>

                <div class="form-outline mb-4">
                  <input type="text" id="form3Example90" class="form-control form-control-lg" />
                  <label class="form-label" for="form3Example90">Pincode</label>
                </div>

                <div class="form-outline mb-4">
                  <input type="text" id="form3Example99" class="form-control form-control-lg" />
                  <label class="form-label" for="form3Example99">Course</label>
                </div> -->

                <div class="form-outline mb-4">
                  <input type="text" id="email" name="email" class="form-control form-control-lg" data-parsley-type="email" required/>
                  <label class="form-label" for="email">Email ID</label>
                </div>

                <div class="form-outline mb-4">
                  <input type="password" id="password" name="password" class="form-control form-control-lg" required />
                  <label class="form-label" for="password">Password</label>
                </div>

                <div class="d-flex justify-content-end pt-3">
                  <!-- <button type="button" class="btn btn-light btn-lg">Reset all</button> -->
                  <!-- <button type="submit" href="signup.php" class="btn btn-warning btn-lg ms-2">Submit</button> -->
                  <button  type="submit" href="login.php" class="btn btn-warning btn-lg ms-2">Login</button>
                </div>
                

              </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
    
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>