<?php
    include 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assessment Maker</title>
    <link rel="icon" href="exam.png" type="image/png">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <script src="myjs.js"></script>
</head>
<body>
    <div class="main-container">
        <!--top header-->
        <div class="row header no-gutters">
            <div class="col-md-12 heading">
                <img src="exam.png" alt="Logo">
                <label id="page-heading">Assessment Maker</label>
            </div>
        </div>
        <!--content/questions-->
        <div class="content no-gutters">
            <!--Login Credentials-->
            <div class="row admin-credentials" id="admin-credentials">
                <div class="col-sm-8 admin-credentials-text" style="font-size:x-large">
                    <label>Build your own Assessment.</label><br>
                    <label>Test other's Knowledge.</label>
                </div>
                <div class="col-sm-4 admin-login" id="admin-login-div">
                    <span style="color:red;font-size:x-large;">Admin Login</span>
                    <form action="admin.php" method="post">
                        <input type="email" id="login-email" name="login-email" placeholder="Enter Email Id" required>
                        <input type="password" id="login-password" name="login-password" placeholder="Enter Password" required>
                        <input type="submit" id="login-cred" value="Submit" name="admin-login" style="cursor: pointer;">
                    </form>
                    <label id="forgot-password">Forgot Password?</label>
                    <label id="register" onclick="toggleLoginRegister()">Not an Admin? Click to Register</label>
                    <div id="admin-login-invalid" style="border:1px solid red; color:red; text-align:center; background-color: rgba(255,0,0,0.2); display: none">
                        Incorrect Email or Password.
                    </div>
                </div>
                <div class="col-sm-4 admin-register" id="admin-register-div">
                    <span style="color:red;font-size:x-large;">Admin Register</span>
                    <form action="admin.php" method="post">
                        <input type="text" id="name" name="register-name" placeholder="Enter your Name" required>
                        <input type="email" id="email" name="register-email"placeholder="Enter Email Id" required>
                        <input type="password" name="register-password" id="password" placeholder="Enter your Password" required>
                        <input type="password" name="re-password" id="re-password" placeholder="Enter your Password again" required>
                        <input type="submit" id="register-cred" value="Submit" name="admin-register" style="cursor: pointer;">
                    </form>
                    <label id="login" onclick="toggleLoginRegister()">Already an Admin? Click to Login</label>
                </div>
            </div>
        </div>
        <!--footer-->
        <div class="row footer no-gutters">
            <div class="col-md-6 col-sm-6 col-6 date"><span id="date"></span></div>
            <div class="col-md-6 col-sm-6 col-6 time"><span id="time"></span></div>
        </div>
    </div>
</body>
<?php
    if(isset($_REQUEST["admin-login"])){
        $email = $_REQUEST["login-email"];
        $password = $_REQUEST["login-password"];
        $valid_user = mysqli_query($conn,"select * from admin where email='$email' and password='$password'");
        if(mysqli_num_rows($valid_user)>0){
            session_start();
            $_SESSION['user'] = $email;
            header('Location: myaccount.php');
            exit();
        }
        else{
            ?><script>document.getElementById("admin-login-invalid").style.display="block";</script><?php
        }
    }
    if(isset($_REQUEST["admin-register"])){
        session_start();
        $_SESSION['user'] = $_REQUEST['register-email'];
        $name = $_REQUEST['register-name'];
        $email = $_REQUEST['register-email'];
        $password = $_REQUEST['register-password'];
        mysqli_query($conn,"insert into admin values('$name','$email','$password','0')");
        header('Location: myaccount.php');
        exit();
    }
?>
</html>