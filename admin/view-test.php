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
            Your created tests are:
            <table border="all border" cellspacing="5">
                <tr>
                    <th>Unique Code</th>
                    <th>Date / Time Created</th>
                    <th>Total Question</th>
                    <th>Pool Question</th>
                    <th>Duration(in minutes)</th>
                    <th>View Result</th>
                </tr>
                <?php
                    $curr_user = $_SESSION['user'];
                    $all_tests = mysqli_query($conn,"select * from tests where email='$curr_user'");
                    $all_test_array = mysqli_fetch_all($all_tests);
                    for($i=0 ; $i<count($all_test_array) ; $i++){
                        ?>
                            <tr>
                                <td><?php echo($all_test_array[$i][1]); ?></td>
                                <td><?php echo($all_test_array[$i][2]); ?></td>
                                <td><?php echo($all_test_array[$i][3]); ?></td>
                                <td><?php echo($all_test_array[$i][4]); ?></td>
                                <td><?php echo($all_test_array[$i][5]); ?></td>
                                <td><a href="test-results.php?id=<?php echo($all_test_array[$i][1]); ?>" target="_blank"><i class="fa fa-eye"></i></a></td>
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