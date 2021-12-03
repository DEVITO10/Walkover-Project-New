<?php
    include 'connection.php';
?>
<?php
    session_start();
    if(!isset($_SESSION['candidate'])){
        header('Location: '.'test.php?id='.$_GET['id']);
        exit();
    }
    $score = 0;
    $test_id = $_GET['id'];
    $candi = $_SESSION['candidate'];
    $curr_que_set = explode('|',$_COOKIE['curr_question_set']);
    $questions = mysqli_query($conn,"select question,options,answer from question_bank where uni_id='$test_id'");
    $question_set = mysqli_fetch_all($questions);
    for($i=0 ; $i<count($curr_que_set)-1 ; $i++){
        if(isset($_REQUEST['option'.$i])){
            if($_REQUEST['option'.$i] == $question_set[(int)$curr_que_set[$i]][2]){
                $score++;
            }
        }
    }
    mysqli_query($conn,"insert into results values('$test_id','$candi',NOW(),'$score')");
    session_destroy();
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
            <div class="final-result">
                Test has been successfully submitted.<br><br>
                Your score is <b><?php echo($score); ?> out of <?php echo(count($curr_que_set)-1); ?>.</b><br><br>
                You can safely close this window.
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
