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
        <div class="content no-gutters">
            <div class="questions">
                <form action="submit.php" method="post">
                <div id="question-set">
                    <div class='question-grid' style="text-align:left">
                        <div class='question-grid-1'>1</div>
                        <div class='question-grid-2 w-100'>
                            <input class="w-100" type='text' placeholder='Enter question here' name="question1" required><br>
                            <br><input type='text' placeholder='Enter option here' name="question1-option1">
                            <br><input type='text' placeholder='Enter option here' name="question1-option2">
                            <br><input type='text' placeholder='Enter option here' name="question1-option3">
                            <br><input type='text' placeholder='Enter option here' name="question1-option4">
                            <br><br><input type='text' placeholder='Enter correct answer' name="question1-answer">
                        </div>
                    </div>
                </div>
                <div style="display: flex; justify-content:space-between; margin-top:10px; margin-bottom: 10px; font-weight: bold">
                    <span>Questions to Show: <input type="text" name="show_question" required></span>
                    <span>Total Question: <span id="total_que">1</span></span>
                    <span>Total Time(in minutes): <input type="text" name="total_time" required></span>
                </div>
                <input type="button" onclick="add_question()" id="add-question" value="Add Question"></button>
                <input type="button" onclick="remove_question()" id="remove-question" value="Remove Question"></button>
                <br>
                <button type="submit" onclick="make_assessment()" id="make-assessment">Make Assessment</button>
                </form>
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