<?php
require "C:xampp\htdocs\ChatApplication\db_connect.php";

$db_object=new database_connection;
$conn=$db_object->connect();

if($_SERVER['REQUEST_METHOD']=="POST"){
    $email=$_POST['email'];
    $name=$_POST['name'];
    $country=$_POST['country'];
    $city=$_POST['city'];
    $password=$_POST['password'];
    $query="SELECT * FROM chatlogin where `email`='$email'";
    $result=mysqli_query($conn,$query);
    $num=mysqli_num_rows($result);
    if($num>0){
        while($row=mysqli_fetch_assoc($result)){
            $pass=$row['password'];

        }
    }
  

    $password_given=$pass;
    $passverify=password_verify($password,$password_given);
    if ($passverify){
    $sql="UPDATE chatlogin SET `name`='$name',`country`='$country',`city`='$city' WHERE `email`='$email'";
    $result2=mysqli_query($conn,$sql);
   }

    $num1=mysqli_affected_rows($conn);

    if($result2){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> Your Data is edited successfully
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
          header("Location: /ChatApplication/themesbrand.com/index-dark.php");

    }
    else{
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Failed!</strong> Please check your given Credentials
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    }



}


echo '
<!doctype html>
<html lang="en">

<head>
    <title>Login 10</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script nonce="00dc3d1e-d25d-4970-b2c0-81ac4095aa7a">
        (function(w, d) {
            ! function(j, k, l, m) {
                j[l] = j[l] || {};
                j[l].executed = [];
                j.zaraz = {
                    deferred: [],
                    listeners: []
                };
                j.zaraz.q = [];
                j.zaraz._f = function(n) {
                    return async function() {
                        var o = Array.prototype.slice.call(arguments);
                        j.zaraz.q.push({
                            m: n,
                            a: o
                        })
                    }
                };
                for (const p of ["track", "set", "debug"]) j.zaraz[p] = j.zaraz._f(p);
                j.zaraz.init = () => {
                    var q = k.getElementsByTagName(m)[0],
                        r = k.createElement(m),
                        s = k.getElementsByTagName("title")[0];
                    s && (j[l].t = k.getElementsByTagName("title")[0].text);
                    j[l].x = Math.random();
                    j[l].w = j.screen.width;
                    j[l].h = j.screen.height;
                    j[l].j = j.innerHeight;
                    j[l].e = j.innerWidth;
                    j[l].l = j.location.href;
                    j[l].r = k.referrer;
                    j[l].k = j.screen.colorDepth;
                    j[l].n = k.characterSet;
                    j[l].o = (new Date).getTimezoneOffset();
                    if (j.dataLayer)
                        for (const w of Object.entries(Object.entries(dataLayer).reduce(((x, y) => ({ ...x[1],
                                ...y[1]
                            })), {}))) zaraz.set(w[0], w[1], {
                            scope: "page"
                        });
                    j[l].q = [];
                    for (; j.zaraz.q.length;) {
                        const z = j.zaraz.q.shift();
                        j[l].q.push(z)
                    }
                    r.defer = !0;
                    for (const A of [localStorage, sessionStorage]) Object.keys(A || {}).filter((C => C.startsWith("_zaraz_"))).forEach((B => {
                        try {
                            j[l]["z_" + B.slice(7)] = JSON.parse(A.getItem(B))
                        } catch {
                            j[l]["z_" + B.slice(7)] = A.getItem(B)
                        }
                    }));
                    r.referrerPolicy = "origin";
                    r.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(j[l])));
                    q.parentNode.insertBefore(r, q)
                };
                ["complete", "interactive"].includes(k.readyState) ? zaraz.init() : j.addEventListener("DOMContentLoaded", zaraz.init)
            }(w, d, "zarazData", "script");
        })(window, document);
    </script>
</head>

<body class="img js-fullheight" style="background-image: url(images/bg.jpg);">
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">Let Z Chat</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">
                        <h3 class="mb-4 text-center">Edit yOUR profilE</h3>
                        <form action="edit_profile.php" method="post" class="signin-form">
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Email:Enter Registerd email" name="email" required>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Your name" name="name" required>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Country" name="country" required>
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="city" name="city" required>
                            </div>

                            <div class="form-group">
                                <input id="password-field" type="password" class="form-control" placeholder="Password" name="password" required>
                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                            <div class="form-group">
                                <button type="submit" href="edit_profile.php" class="form-control btn btn-primary  px-3">eDIT</button>
                            </div>
                            <div class="form-group d-md-flex">
                                <div class="w-50">
                                    <label class="checkbox-wrap checkbox-primary">Remember Me
<input type="checkbox" checked>
<span class="checkmark"></span>
</label>
                                </div>
                                <div class="w-50 text-md-right">
                                    <a href="#" style="color: #fff">Forgot Password</a>
                                </div>
                            </div>
                        </form>
                        <p class="w-100 text-center">&mdash; Or Sign In With &mdash;</p>
                        <div class="social d-flex text-center">
                            <a href="#" class="px-2 py-2 mr-md-1 rounded"><span class="ion-logo-facebook mr-2"></span> Facebook</a>
                            <a href="#" class="px-2 py-2 ml-md-1 rounded"><span class="ion-logo-twitter mr-2"></span> Twitter</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>';

    


        

       
    ?>

<script  defer src="https://static.cloudflareinsights.com/beacon.min.js/v84a3a4012de94ce1a686ba8c167c359c1696973893317"  

integrity="sha512-euoFGowhlaLqXsPWQ48qSkBSCFs3DPRyiwVu3FjR96cMPx+Fr+gpWRhIafcHwqwCqWS42RZhIudOvEI+Ckf6MA==" data-cf-beacon='{"rayId":"81979baab91352d4","version":"2023.10.0","token":"cd0b4b3a733644fc843ef0b185f98241"}' crossorigin="anonymous"></script>
</body>

</html>

<!--integrity="sha512-euoFGowhlaLqXsPWQ48qSkBSCFs3DPRyiwVu3FjR96cMPx+Fr+gpWRhIafcHwqwCqWS42RZhIudOvEI+Ckf6MA==" data-cf-beacon="{"rayId":"81979baab91352d4","version":"2023.10.0","token":"cd0b4b3a733644fc843ef0b185f98241"}"
    crossorigin="anonymous"></script> -->