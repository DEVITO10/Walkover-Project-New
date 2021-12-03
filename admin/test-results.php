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
                        if(isset($_SESSION['user']))
                            echo('Hello, '.$_SESSION['user']);
                        else{
                            header("Location: admin.php");
                            exit();
                        }
                    ?>
                </span>
            </div>
        </div>
        <!--content-->
        <div class="content no-gutters" style="flex-direction:column">
            Test results for code <b><?php echo($_GET['id'])?></b> are:
            <table border="all border" cellspacing="5">
                <tr>
                    <th>EMail Address</th>
                    <th>Date / Time Created</th>
                    <th>Score</th>
                </tr>
                <?php
                    $curr_test = $_GET['id'];
                    $all_results = mysqli_query($conn,"select * from results where uni_code='$curr_test'");
                    $all_results_array = mysqli_fetch_all($all_results);
                    for($i=0 ; $i<count($all_results_array) ; $i++){
                        ?>
                            <tr>
                                <td><?php echo($all_results_array[$i][1]); ?></td>
                                <td><?php echo($all_results_array[$i][2]); ?></td>
                                <td><?php echo($all_results_array[$i][3]); ?></td>
                            </tr>
                        <?php
                    }
                ?>
            </table>            
        </div>
        <!--footer-->
        <div class="row footer no-gutters">
            <div class="col-md-6 col-sm-6 col-6 date"><span id="date"></span></div>
            <div class="col-md-6 col-sm-6 col-6 time"><span id="time"></span></div>
        </div>
    </div>
</body>
</html>