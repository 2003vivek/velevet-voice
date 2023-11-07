<?php
require "db_connect.php";
include "signup_process.php";

$db_object=new database_connection;
$conn=$db_object->connect();
$singup_objecct=new UserDetail;
if($_SERVER['REQUEST_METHOD']=="POST"){
$singup_objecct->setusername($_POST['name']);
$singup_objecct->setpassword($_POST['password']);
$singup_objecct->setemail($_POST['email']);
$singup_objecct->setcountry($_POST['country']);

$singup_objecct->setcity($_POST['city']);


$username=$singup_objecct->getusername();
$password=$singup_objecct->getpassword();
$country=$singup_objecct->getcountry();
$city=$singup_objecct->getcity();

$pass_hash=password_hash($password,PASSWORD_DEFAULT);
$email=$singup_objecct->getemail();
    $query="INSERT INTO chatlogin (`name`,`password`,`email`,`country`,`city`) VALUES('$username','$pass_hash','$email','$country','$city')";
    $result=mysqli_query($conn,$query);

    if($result){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Please Login now
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    }
    else{
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Failed!</strong>  Unable to Signup
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
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
              <img src="https://www.chanty.com/blog/wp-content/uploads/2021/07/Team-Chat-Apps.png"
                alt="Sample photo" class="img-fluid"
                style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;" />
            </div>
            <div class="col-xl-6">
              <div class="card-body p-md-5 text-black">
                <h3 class="mb-5 text-uppercase">Sign uP</h3>
<form action="signup.php" method="post">

                <div class="row">
                  <div class="col-md-6 mb-4">
                    <div class="form-outline">
                      <input type="text" id="name" name="name" class="form-control form-control-lg" data-parsley-pattern="/^[a-zA-Z/s]+$/" required/>
                      <label class="form-label" for="name">Username</label>
                    </div>
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

                <div class="d-md-flex justify-content-start align-items-center mb-4 py-2">

                  <h6 class="mb-0 me-4">Gender: </h6>

                  <div class="form-check form-check-inline mb-0 me-4">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="femaleGender"
                      value="option1" />
                    <label class="form-check-label" for="femaleGender">Female</label>
                  </div>

                  <div class="form-check form-check-inline mb-0 me-4">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="maleGender"
                      value="option2" />
                    <label class="form-check-label" for="maleGender">Male</label>
                  </div>

                  <div class="form-check form-check-inline mb-0">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="otherGender"
                      value="option3" />
                    <label class="form-check-label" for="otherGender">Other</label>
                  </div>

                </div>

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
                  <input type="email" id="email" name="email" class="form-control form-control-lg" data-parsley-type="email" required/>
                  <label class="form-label" for="email">Email ID</label>
                </div>

                <div class="form-outline mb-4">
                  <input type="password" id="password" name="password" class="form-control form-control-lg" required />
                  <label class="form-label" for="password">Password</label>
                </div>
                <div class="form-outline mb-4">
                  <input type="text" id="country" name="country" class="form-control form-control-lg" required />
                  <label class="form-label" for="country">Country</label>
                </div>
                <div class="form-outline mb-4">
                  <input type="text" id="city" name="city" class="form-control form-control-lg" required />
                  <label class="form-label" for="city">City</label>
                </div>

                <div class="d-flex justify-content-end pt-3">
                  <!-- <button type="button" class="btn btn-light btn-lg">Reset all</button> -->
                  <button type="submit" href="signup.php" class="btn btn-warning btn-lg ms-2">SignUp</button>
                  <a href="login.php" class="btn btn-warning btn-lg ms-2">Login</a>
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