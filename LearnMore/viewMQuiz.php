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
                                <p class="center white-text fontStyle"><b>Learn<span class="black-text">more</b></span></p><br>
                            </div>
                            <div class="col l12">

                                <div class="col l12 "><br>
                                    <h3 class="white-text zeroMargin center" id="title"><span class="back2 orange darken-4">Quiz <span id="num"><?php echo $_GET['num']?></span></span> <span id="titleNum"><?php echo $_GET['title']?></span></h3>
                                <br>
                                </div>
                                <div class="section">
                                    <div class="row"><br>
                                        
                                        <?php
                                            $code=$_SESSION['code'];
                                            $retrive=mysqli_query($conn,"SELECT * FROM tbl_class WHERE code='$code' ");
                                            $row=mysqli_num_rows($retrive);
                                            if($row==1){
                                                $fetch=mysqli_fetch_array($retrive);
                                                $classID=$fetch['classID'];
                                                $title=$_GET['title'];
                                                $retrive1=mysqli_query($conn,"SELECT tbl_multiplechoice.ID,tbl_multiplechoice.question,tbl_multiplechoice.a,tbl_multiplechoice.b,tbl_multiplechoice.c,tbl_multiplechoice.d,tbl_multiplechoice.answer FROM tbl_quiz INNER JOIN tbl_multiplechoice ON tbl_multiplechoice.quizID=tbl_quiz.quizID WHERE tbl_quiz.classID='$classID' AND tbl_quiz.quizTitle='$title'");
                                                $x=0;
                                                while($fetch1=mysqli_fetch_array($retrive1)):
                                                    $x++;
                                            
                                        ?>
                                        <!--DISPLAY SUB-TOPIC -->
                                        <div class="col l12" id="topic">
                                            <div class="row panel" id="num1"><br>
                                                
                                                <div class="col l12">
                                                    <div class="row">
                                                        <div class="col l12" id="displayType1">
                                                            <h5 class="white-text zeroMargin" ><span id="numQuestion<?php echo $fetch1['ID']?>"><?php echo $x?></span>. <span id="quiz<?php echo $fetch1['ID']?>"><?php echo $fetch1['question']?></span> </h4>
                                                            
                                                            <p class="white-text col l12 e" ><span class="col l1 center clickA<?php echo $x?> choosePad2">A. </span> <span class="col l11 center selectA<?php echo $x?> selection2" id="a<?php echo $fetch1['ID']?>"><?php echo $fetch1['a']?></span></p><br>
                                                            <p class="white-text col l12 f" ><span class="col l1 center clickB<?php echo $x?> choosePad2">B. </span> <span class="col l11 center selectB<?php echo $x?> selection2" id="b<?php echo $fetch1['ID']?>"><?php echo $fetch1['b']?></span></p><br>
                                                            <p class="white-text col l12 f" ><span class="col l1 center clickC<?php echo $x?> choosePad2">C. </span> <span class="col l11 center selectC<?php echo $x?> selection2" id="c<?php echo $fetch1['ID']?>"><?php echo $fetch1['c']?></span></p><br>
                                                            <p class="white-text col l12 h" ><span class="col l1 center clickD<?php echo $x?> choosePad2">D. </span> <span class="col l11 center selectD<?php echo $x?> selection2" id="d<?php echo $fetch1['ID']?>"><?php echo $fetch1['d']?></span></p><br>
                                                            <div class="col l12"><br></div>
                                                            <p class="white-text center" ><span class="back green">Answer:</span> <span class="<?php echo $fetch1['answer']?>" id="answer<?php echo $fetch1['ID']?>"><?php 
                                                                if($fetch1['a']==$fetch1['answer']){
                                                                    echo 'A';
                                                                }
                                                                else if($fetch1['b']==$fetch1['answer']){
                                                                    echo 'B';
                                                                }
                                                                if($fetch1['c']==$fetch1['answer']){
                                                                    echo 'C';
                                                                }
                                                                if($fetch1['d']==$fetch1['answer']){
                                                                    echo 'D';
                                                                }
                                                            //echo $fetch1['answer']?></span> - <span><?php echo $fetch1['answer']?></span></p><br>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                            endwhile;}
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col l12 center">
                                <a href="quizTeacher.php?code=<?php echo $_SESSION['code']?>" class=" modal-action waves-effect waves-red btn-flat white-text blue"><i class="fas fa-eye iconStyle"></i> Done</a>
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