<?php
    include 'connection.php';
?>
<?php
    $num = $_COOKIE['total'];
    session_start();
    if(isset($_SESSION['user'])){
        $user = $_SESSION['user'];
        $user_fname = explode('@',$user)[0];
        $que = $_REQUEST['show_question'];
        $time = $_REQUEST['total_time'];
        /* generating unicode */
        $uni_code = "";
        for($i=0 ; $i<strlen($user_fname) ; $i++)
            $uni_code = $uni_code.strval(ord($user_fname[$i]));
        
        $uni_code = $uni_code.strval(idate('U'));

        /* adding question and answer to database */
        for($i=1 ; $i<=$num ; $i++)
        {
            $question = $_REQUEST['question'.$i];
            $options = $_REQUEST['question'.$i.'-option1']."|".$_REQUEST['question'.$i.'-option2']."|".$_REQUEST['question'.$i.'-option3']."|".$_REQUEST['question'.$i.'-option4'];
            $answer = $_REQUEST['question'.$i.'-answer'];
            
            mysqli_query($conn,"insert into question_bank values('$uni_code','$question','$options','$answer')");
        }    
        mysqli_query($conn,"insert into tests values('$user','$uni_code',NOW(),'$que','$num','$time')");
        $curr_total_test = mysqli_fetch_row(mysqli_query($conn,"select totaltest from admin where email='$user'"))[0];
        $curr_total_test++;
        mysqli_query($conn,"update admin set totaltest='$curr_total_test' where email='$user'");
    }
    else{
        header("Location: admin.php");
        exit();
    }
    
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
                <span>
                    <?php
                        echo('Hello, '.$user);
                    ?>
                </span>
            </div>
        </div>
        <!--content-->
        <div class="content no-gutters">
            <div class="test-creation-success">
                Your test is successfully created.
                <br><br>
                <span>Test Link: <a href="../test/test.php?id=<?php echo($uni_code)?>" target="_blank">Click Here</a></span>
                <br><br>
                Please re-login to view/create tests.
                <?php
                    session_destroy();
                ?>
                <br><br>
                <button onclick="location.href='admin.php';">Login Here</button>
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