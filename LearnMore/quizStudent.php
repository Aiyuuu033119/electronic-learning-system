<?php
    session_start();
    $page='quiz';
    if(!isset($_SESSION['student'])){
        header('location:login.php');
        
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learnmore</title>
    <link rel="icon" href="icon/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="materialize2.0/css/materialize.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
</head>

<body class="bgbody">

    <?php include('navigation.php'); ?>

    <div class="section">
        <div class="row ">
            <?php include('sidenav.php'); ?>

            <div class="col l7 push-l1 "><br>
                <div class="card grey darken-4 bgCard1">
                    <div class="content">
                        <div class="row">
                            <div class="col l12">
                                <div class="col l12">
                                    <h3 class="white-text">My Quiz</h3>
                                    <?php
                                        $select=mysqli_query($conn,"SELECT tbl_quiz.quizID,tbl_quiz.quizTitle,tbl_quiz.typeQuiz FROM tbl_quiz INNER JOIN tbl_class ON tbl_quiz.classID=tbl_class.classID WHERE tbl_class.code='$code'");
                                        $count=mysqli_num_rows($select);
                                    ?>
                                    <p class="white-text">Number of quiz: <?php echo $count?></p>
                                </div>
                            </div>
                            <div class="col l12"><br><br>
                                <div class="collection noBorder">
                                <?php
                                    $x=0;
                                    $code=$_SESSION['code'];
                                    $student=$_SESSION['student'];
                                    $retrive=mysqli_query($conn,"SELECT tbl_quiz.quizID,tbl_quiz.quizTitle,tbl_quiz.typeQuiz FROM tbl_quiz INNER JOIN tbl_class ON tbl_quiz.classID=tbl_class.classID WHERE tbl_class.code='$code'");
                                    while($fetch=mysqli_fetch_array($retrive)):
                                    $x++;
                                ?>
                                    <a class="collection-item colHover clickQuiz" id="<?php echo $x?>"><span class="back red"><span> Quiz</span> <span class="num<?php echo $x?>" id="<?php echo $fetch['quizID']?>"><?php echo $x?></span></span><span id="<?php echo $fetch['typeQuiz']?>" class="title<?php echo $x?>"><?php echo $fetch['quizTitle']?></span><span class="right "><?php 
                                            if($fetch['typeQuiz']=="Multiple Choice"){
                                                $retrive2=mysqli_query($conn,"SELECT tbl_score.average FROM tbl_account INNER JOIN tbl_score ON tbl_account.accID=tbl_score.studentID INNER JOIN tbl_quiz ON tbl_quiz.quizID=tbl_score.quizID INNER JOIN tbl_class ON tbl_class.classID=tbl_quiz.classID WHERE tbl_account.user='$student' AND tbl_score.quizID='".$fetch['quizID']."'");
                                                $row=mysqli_num_rows($retrive2);
                                                if($row==1){
                                                    $fetch2=mysqli_fetch_array($retrive2);
                                                    echo '<span class="backBorder start'.$x.'" style="font-size:12px">view</span>';
                                                }
                                                else{
                                                    echo '<span class=" backBorder start'.$x.'" style="font-size:12px">start</span>';
                                                }
                                                
                                            }
                                            if($fetch['typeQuiz']=="True/False"){
                                                $retrive3=mysqli_query($conn,"SELECT tbl_score.average FROM tbl_account INNER JOIN tbl_score ON tbl_account.accID=tbl_score.studentID INNER JOIN tbl_quiz ON tbl_quiz.quizID=tbl_score.quizID INNER JOIN tbl_class ON tbl_class.classID=tbl_quiz.classID WHERE tbl_account.user='$student' AND tbl_score.quizID='".$fetch['quizID']."'");
                                                $row3=mysqli_num_rows($retrive3);
                                                if($row3==1){
                                                    $fetch3=mysqli_fetch_array($retrive3);
                                                    echo '<span class="backBorder start'.$x.'" style="font-size:12px">view</span>';
                                                }
                                                else{
                                                    echo '<span class="accent-4 backBorder start'.$x.'" style="font-size:12px">start</span>';
                                                }
                                            }

                                        ?></span></a>
                                <?php
                                    endwhile;
                                ?>
                                </div><br><br>
                            </div>
                            <div class="col l12">
                                <br><br><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="jquery/jquery-3.4.1.min.js"></script>
    <script src="materialize2.0/js/materialize.js"></script>
    <script src="main.js"></script>
    <script>
        $(document).ready(function(){
            $(document).on('click','.clickQuiz',function(){
                var num=$(this).attr('id');
                var id=$('.num'+num).attr('id');
                var title=$('.title'+num).text();
                var type=$('.title'+num).attr('id');
                var start=$('.start'+num).text();

                if(start=="start"){
                    if(type=="Multiple Choice"){
                    window.top.location='viewMQuizStudent.php?title='+title+'&num='+num+'&id='+id;
                    }
                    else if(type=="True/False"){
                        window.top.location='viewTFQuizStudent.php?title='+title+'&num='+num+'&id='+id;
                    }
                }
                else if(start=="view"){
                    window.top.location='resultQuiz.php?title='+title+'&num='+num+'&id='+id;
                }
            });
        });
    </script>
</body>
</html>