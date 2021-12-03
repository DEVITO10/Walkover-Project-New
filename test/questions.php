<?php
    include 'connection.php';
    session_start();
    if(!isset($_SESSION['candidate'])){
        header('Location: '.'test.php?id='.$_GET['id']);
        exit();
    }
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
        <!--content/questions-->
        <div class="content no-gutters">
            <?php
                $test_id = $_GET['id'];
                $test_details = mysqli_fetch_row(mysqli_query($conn,"select show_question,total_question,total_time from tests where uni_code='$test_id'"));
                $test_cookie = $test_details[0].'|'.$test_details[1].'|'.$test_details[2];
                setcookie('testdetails',$test_cookie);
            ?>
            <form action="result.php?id=<?php echo($_GET['id']);?>" method="post" id="testform" name="testform">
            <!--Instructions-->
            <div class="instruction no-gutters" id="instruction">
                <!--Rules-->
                <div>
                    <b><u>Instructions :</u></b>
                    <ol>
                        <li>The Assessment is of <b><?php echo($test_details[2]); ?> minutes</b> in total, and consist of <b><?php echo($test_details[0]); ?> questions</b>.</li>
                        <li>All questions are compulsory.</li>
                        <li>If you fail to Submit your test within <?php echo($test_details[2]); ?> minutes, it will get auto submitted.</li>
                        <li>Remaining time is shown at the top right corner.</li>
                    </ol>
                </div>
                <!--Accept Butoon-->
                <input type="button" value="Accept & Continue" onclick="acceptInstruction()">
            </div>

            <!--Questions-->
            <div class="question no-gutters" id="question" style="display: none;">
                <div id="question-set">
                <?php
                    $questions = mysqli_query($conn,"select question,options,answer from question_bank where uni_id='$test_id'");
                    $question_set = mysqli_fetch_all($questions);
                    $curr_question_set = array();
                    $x=0;
                    while($x<(int)$test_details[0]){
                        $random = rand(0,(int)$test_details[1]-1);
                        if(!in_array($random,$curr_question_set)){
                            $curr_question_set[$x] = $random;
                            $x++;
                        }
                    }
                    
                    $curr_question_set_cookie = "";
                    for($i=0 ; $i<count($curr_question_set) ; $i++){
                        $curr_question_set_cookie = $curr_question_set_cookie.strval($curr_question_set[$i].'|');
                    }
                    setcookie('curr_question_set',$curr_question_set_cookie);

                    $i = 0;
                    foreach($curr_question_set as $curr_que){
                    ?>
                        <div class='question-grid'>
                            <div class='question-grid-1'><?php echo($i+1); ?></div>
                            <div class='question-grid-2'>
                                <?php
                                    echo($question_set[$curr_que][0]);
                                ?>
                                <br><br>
                                <?php
                                    $options = explode("|",$question_set[$curr_que][1]);
                                    for($j=0 ; $j<4 ; $j++)
                                        if($options[$j]!=''){
                                            ?><input type="radio" name="<?php echo('option'.$i) ?>" value="<?php echo($options[$j]);?>">&ensp;<?php echo($options[$j]);?><br><?php
                                        }
                                ?>
                            </div>
                        </div>
                    <?php
                        $i++;
                    }
                ?>
                <div style="width:100%; text-align:center;">
                    <input type="submit" value="Final Submit" name="finalsubmit" style="margin-top:10px; margin-bottom:10px; border-radius: 5px; background-color:rgba(0,255,0,0.5)">
                </div>
                </div>
                <br>
                
                
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
