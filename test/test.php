<?php
    include 'connection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assessment Test</title>
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
                Assessment Test
                <span><span id="rem">Remaining time : </span><span id="timer">00:00:00</span></span>
            </div>
        </div>
        <!--content-->
        <div class="content no-gutters">
            <!--Login Credentials-->
            <form action="" method="post">
            <div class="candidate-credentials" id="candidate-credentials">
                <span style="color:red;font-size:x-large;">Candidate Credentials</span>
                <span style="font-size:small">Use full name and reputable email providers</span>
                <input type="text" id="name" name="candi-name" placeholder="Enter your Name" required>
                <input type="email" id="email" name="candi-email" placeholder="Enter valid E-Maild Id" required>
                <input type="submit" id="submit-cred" name="candi-cred-submit" value="Submit" disabled style="cursor: no-drop;">
            </div>
            </form>
        </div>
        <!--footer-->
        <div class="row footer no-gutters">
            <div class="col-md-6 col-sm-6 col-6 date"><span id="date"></span></div>
            <div class="col-md-6 col-sm-6 col-6 time"><span id="time"></span></div>
        </div>
    </div>
</body>
</html>
<?php
    if(isset($_REQUEST['candi-cred-submit'])){
        session_start();
        $_SESSION['candidate'] = $_REQUEST['candi-email'];
        header('Location: '.'questions.php?id='.$_GET['id']);
        exit();
    }
?>