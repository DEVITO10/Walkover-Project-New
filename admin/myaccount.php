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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="myjs.js"></script>
</head>
<body>
    <div class="main-container">
        <!--top header-->
        <div class="row header no-gutters">
            <div class="col-md-12 heading">
                <img src="exam.png" alt="Logo">
                <label id="page-heading">Assessment Maker</label>
                <span>
                    <?php
                        session_start();
                        if(isset($_SESSION['user'])){
                            echo('Hello, '.$_SESSION['user']);
                        }
                        else{
                            header("Location: admin.php");
                            exit();
                        }
                    ?>
                </span>
            </div>
        </div>
        <!--content-->
        <div class="content no-gutters">
            <div class="row all-details no-gutters">
                <div class="col-sm-6">
                        <div class="personal-details">
                            <table style="width:90%; text-align:center;">
                                <?php
                                    $curr_user = $_SESSION['user'];
                                    $curr_user_details = mysqli_fetch_row(mysqli_query($conn,"select name,email,totaltest from admin where email='$curr_user'"));
                                ?>
                                <tr>
                                    <th>Name: </th>
                                    <th><?php  echo($curr_user_details[0]); ?></th>
                                </tr>
                                <tr>
                                    <th>Email Adress: </th>
                                    <th><?php  echo($curr_user_details[1]); ?></th>
                                </tr>
                                <tr>
                                    <th>Total Test: </th>
                                    <th><?php  echo($curr_user_details[2]); ?></th>
                                </tr>
                            </table>
                        </div>
                </div>
                <div class="col-sm-6 test no-gutters">
                    <div class="row no-gutters">
                        <div class="col-12">
                            <div class="view-test" onclick="location.href='view-test.php'">
                            <i class="fa fa-eye"></i>View Created Tests
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="create-test" onclick="location.href='create-test.php'">
                            <i class="fa fa-plus"></i>Create New Test
                            </div>
                        </div>
                    </div>
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
</html>