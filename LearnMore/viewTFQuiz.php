<?php
    session_start();
    require_once('process.php');
    include('connection.php');
    if(!isset($_SESSION['teacher'])){
        header('location:login.php');
        
    }
    
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="materialize2.0/css/materialize.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
</head>

<body>
<script src="jquery/jquery-3.4.1.min.js"></script>

    <!-- BODY -->
    <div class="section">
        <div class="row ">
            <div class="col l6 push-l3"><br>
                <div class="card grey darken-4 bgCard1">
                    <div class="content">
                        <div class="row">
                            <br>
                            <div class="col l12">
                                <p class="center white-text fontStyle"><b>Update<span class=" amber darken-3 black-text">quiz</b></span></p>
                            </div>
                            <div class="col l12">
                                <div class="col l12 ">
                                    <h3 class="white-text zeroMargin" id="title">Quiz <span id="num"><?php echo $_GET['num']?></span>: <span id="titleNum"><?php echo $_GET['title']?></span></h3>
                                </div>
                                <div class="section">
                                    <div class="row"><br>
                                        

                                        <!--DISPLAY SUB-TOPIC -->
                                        <div class="col l12" id="topic">
                                            <div class="row panel" id="num1"><br>
                                                <div class="col l12">
                                                    <div class="row">
                                                        <div class="col l12" id="displayType1">
                                                            <?php
                                                                $code=$_SESSION['code'];
                                                                $retrive=mysqli_query($conn,"SELECT * FROM tbl_class WHERE code='$code' ");
                                                                $row=mysqli_num_rows($retrive);
                                                                if($row==1){
                                                                    $fetch=mysqli_fetch_array($retrive);
                                                                    $classID=$fetch['classID'];
                                                                    $title=$_GET['title'];
                                                                    $retrive1=mysqli_query($conn,"SELECT tbl_true_false.ID,tbl_true_false.question,tbl_true_false.answer FROM tbl_quiz INNER JOIN tbl_true_false ON tbl_true_false.quizID=tbl_quiz.quizID WHERE tbl_quiz.classID='$classID' AND tbl_quiz.quizTitle='$title'");
                                                                    $x=0;
                                                                    while($fetch1=mysqli_fetch_array($retrive1)):
                                                                        $x++;
                                                                
                                                            ?>
                                                            <br>
                                                            <h5 class="white-text zeroMargin" ><span id="numQuestion<?php echo $fetch1['ID']?>"><?php echo $x?></span>. <span id="quiz<?php echo $fetch1['ID']?>"><?php echo $fetch1['question']?></span> </h5>
                                                            <p class="white-text " >Answer: <span id="answer<?php echo $fetch1['ID']?>"><?php echo $fetch1['answer']?></span></p><br>
                                                            <div class="divider"></div>
                                                            <?php
                                                                endwhile;}
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col l12 center">
                            <a href="quizTeacher.php?code=<?php echo $_SESSION['code']?>" class=" waves-effect waves-red btn-flat white-text blue"><i class="fas fa-book iconStyle"></i> Done</a>
                            </div>
                            <div class="col l12"><br><br></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="materialize2.0/js/materialize.js"></script>
    <script src="main.js"></script>
    
</body>
</html>