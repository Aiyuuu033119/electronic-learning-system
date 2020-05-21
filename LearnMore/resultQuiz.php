<?php
    session_start();
    require_once('process.php');
    include('connection.php');
    if(!isset($_SESSION['student'])){
        header('location:login.php');
    }
    if ($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['takeTFQuiz'])) {
        $myphp=new myphp();
        $myphp->takeTFQuiz();
        exit();
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
    <script src="jquery/jquery-3.4.1.min.js"></script>

    <!-- BODY -->
    <div class="section">
        <div class="row ">
            <div class="col l8 push-l2"><br>
                <div class="card grey darken-4 bgCard1">
                    <div class="content">
                        <div class="row">
                            <br>
                            <div class="col l12">
                                <p class="center white-text fontStyle"><b>Learn<span class=" amber darken-3 black-text">more</b></span>
                                </p>
                            </div>
                                <div class="col l10 push-l1">
                                    <div class="section">
                                        <div class="row"><br>
                                            <div class="col l12" id="topic">
                                                <div class="row panel" id="num1"><br>
                                                    <div class="col l12 ">
                                                        <div class="row">
                                                            <div class="col l10 push-l1 dpProfile ">
                                                                <div class="user-view"><br>
                                                                    <div class="col no-width blue no-padding">
                                                                        <img class="class left" src="icon/quiz.png" style="margin: 0px 6px" id="dp">
                                                                    </div>
                                                                    <div class="col l8 push-l2 left"><br><br>
                                                                        <h4 class="white-text center"><span class="back2"><?php echo 'Quiz '.$_GET['num'].'. '.$_GET['title'] ?></span></h4>
                                                                        <?php
                                                                            $user=$_SESSION['student'];

                                                                            $select=mysqli_query($conn,"SELECT * FROM tbl_account WHERE user='$user'");
                                                                            $row2=mysqli_num_rows($select);
                                                                            if($row2==1){
                                                                                $fetch3=mysqli_fetch_array($select);
                                                                                $id=$fetch3['accID'];

                                                                                $retrive4=mysqli_query($conn,"SELECT * FROM tbl_score WHERE studentID='$id' AND quizID='".$_GET['id']."'");
                                                                                $fetch4=mysqli_fetch_array($retrive4);
                                                                            }
                                                                        ?>
                                                                        <h1 class="white-text center" style="font-size:120px"><b><span class="back2" style="border:2px solid white;background:rgba(255,255,255,0.2)"><?php echo $fetch4['average']?></span></b></h1>
                                                                        <h4 class="white-text center"><b><span class="back2" ></span></b></h4>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                            <!--DISPLAY SUB-TOPIC -->
                                            <div class="col l12" id="topic">
                                                <div class="row panel" id="num1"><br>
                                                    <div class="col l12">
                                                        <div class="row">
                                                            <div class="col l10 push-l1" id="displayType1">
                                                                <h5 class="white-text center "><span class="back green">Answer Keys</span></h5><br>
                                                                <?php
                                                                $code=$_SESSION['code'];
                                                                $user=$_SESSION['student'];
                                                                $retrive=mysqli_query($conn,"SELECT * FROM tbl_class WHERE code='$code' ");
                                                                $row=mysqli_num_rows($retrive);
                                                                if($row==1){
                                                                    $fetch=mysqli_fetch_array($retrive);
                                                                    $classID=$fetch['classID'];
                                                                    $title=$_GET['title'];
                                                                    $quizID=$_GET['id'];

                                                                    $retrive2=mysqli_query($conn,"SELECT * FROM tbl_quiz WHERE tbl_quiz.classID='$classID' AND tbl_quiz.quizTitle='$title'");
                                                                    $fetch2=mysqli_fetch_array($retrive2);
                                                                    $type=$fetch2['typeQuiz'];
                                                                    if($type=="Multiple Choice"){
                                                                        $retrive1=mysqli_query($conn,"SELECT tbl_multiplechoice.ID,tbl_multiplechoice.question,tbl_multiplechoice.a,tbl_multiplechoice.b,tbl_multiplechoice.c,tbl_multiplechoice.d,tbl_multiplechoice.answer FROM tbl_quiz INNER JOIN tbl_multiplechoice ON tbl_multiplechoice.quizID=tbl_quiz.quizID WHERE tbl_quiz.classID='$classID' AND tbl_quiz.quizTitle='$title'");
                                                                        $x=0;
                                                                        while($fetch1=mysqli_fetch_array($retrive1)):
                                                                            $x++;
                                                                            
                                                                    ?>
                                                                    <p class="white-text " style="margin-top: 10px;margin-bottom: 10px;">
                                                                        <?php echo $x?>) <span><b><?php 
                                                                            if($fetch1['a']==$fetch1['answer']){
                                                                                echo ' A';
                                                                            }
                                                                            else if($fetch1['b']==$fetch1['answer']){
                                                                                echo ' B';
                                                                            }
                                                                            else if($fetch1['c']==$fetch1['answer']){
                                                                                echo ' C';
                                                                            }
                                                                            else if($fetch1['d']==$fetch1['answer']){
                                                                                echo ' D';
                                                                            }
                                                                            ?></b></span> 
                                                                        <?php 
                                                                                $select=mysqli_query($conn,"SELECT * FROM tbl_account WHERE user='$user'");
                                                                                $row2=mysqli_num_rows($select);
                                                                                
                                                                                if($row2==1){
                                                                                    $fetch3=mysqli_fetch_array($select);
                                                                                    $id=$fetch3['accID'];

                                                                                    $retrive4=mysqli_query($conn,"SELECT * FROM tbl_score WHERE studentID='$id' AND quizID='$quizID'");
                                                                                    $fetch4=mysqli_fetch_array($retrive4);
                                                                                    if($x==1){
                                                                                        if($fetch4['a']=="Correct"){
                                                                                        echo '<span class="right blue darken-2 back" style="font-size:10px"><b>'.$fetch4['a'].'</b></span>';
                                                                                        }
                                                                                        else if($fetch4['a']=="Wrong"){
                                                                                            echo '<span class="right red back" style="font-size:10px"><b>'.$fetch4['a'].'</b></span>';
                                                                                        }
                                                                                    }
                                                                                    else if($x==2){
                                                                                        if($fetch4['b']=="Correct"){
                                                                                            echo '<span class="right blue darken-2 back" style="font-size:10px"><b>'.$fetch4['b'].'</b></span>';
                                                                                        }
                                                                                        else if($fetch4['b']=="Wrong"){
                                                                                            echo '<span class="right red back" style="font-size:10px"><b>'.$fetch4['b'].'</b></span>';
                                                                                        }
                                                                                    }
                                                                                    else if($x==3){
                                                                                        if($fetch4['c']=="Correct"){
                                                                                            echo '<span class="right blue darken-2 back" style="font-size:10px"><b>'.$fetch4['c'].'</b></span>';
                                                                                        }
                                                                                        else if($fetch4['c']=="Wrong"){
                                                                                            echo '<span class="right red back" style="font-size:10px"><b>'.$fetch4['c'].'</b></span>';
                                                                                        }
                                                                                    }
                                                                                    else if($x==4){
                                                                                        if($fetch4['d']=="Correct"){
                                                                                            echo '<span class="right blue darken-2 back" style="font-size:10px"><b>'.$fetch4['d'].'</b></span>';
                                                                                            }
                                                                                            else if($fetch4['d']=="Wrong"){
                                                                                                echo '<span class="right red" style="font-size:10px"><b>'.$fetch4['d'].'</b></span>';
                                                                                            }
                                                                                    }
                                                                                    else if($x==5){
                                                                                        if($fetch4['e']=="Correct"){
                                                                                            echo '<span class="right blue darken-2 back" style="font-size:10px"><b>'.$fetch4['e'].'</b></span>';
                                                                                        }
                                                                                        else if($fetch4['e']=="Wrong"){
                                                                                            echo '<span class="right red back" style="font-size:10px"><b>'.$fetch4['e'].'</b></span>';
                                                                                        }
                                                                                    }
                                                                                    else if($x==6){
                                                                                        if($fetch4['f']=="Correct"){
                                                                                            echo '<span class="right blue darken-2 back" style="font-size:10px"><b>'.$fetch4['f'].'</b></span>';
                                                                                        }
                                                                                        else if($fetch4['f']=="Wrong"){
                                                                                            echo '<span class="right red back" style="font-size:10px"><b>'.$fetch4['f'].'</b></span>';
                                                                                        }
                                                                                    }
                                                                                    else if($x==7){
                                                                                        if($fetch4['g']=="Correct"){
                                                                                            echo '<span class="right blue darken-2 back" style="font-size:10px"><b>'.$fetch4['g'].'</b></span>';
                                                                                        }
                                                                                        else if($fetch4['g']=="Wrong"){
                                                                                            echo '<span class="right red back" style="font-size:10px"><b>'.$fetch4['g'].'</b></span>';
                                                                                        }
                                                                                    }
                                                                                    else if($x==8){
                                                                                        if($fetch4['h']=="Correct"){
                                                                                            echo '<span class="right blue darken-2 back" style="font-size:10px"><b>'.$fetch4['h'].'</b></span>';
                                                                                        }
                                                                                        else if($fetch4['h']=="Wrong"){
                                                                                            echo '<span class="right red back" style="font-size:10px"><b>'.$fetch4['h'].'</b></span>';
                                                                                        }
                                                                                    }
                                                                                    else if($x==9){
                                                                                        if($fetch4['i']=="Correct"){
                                                                                            echo '<span class="right blue darken-2 back" style="font-size:10px"><b>'.$fetch4['i'].'</b></span>';
                                                                                        }
                                                                                        else if($fetch4['i']=="Wrong"){
                                                                                            echo '<span class="right red back" style="font-size:10px"><b>'.$fetch4['i'].'</b></span>';
                                                                                        }
                                                                                    }
                                                                                    else if($x==10){
                                                                                        if($fetch4['j']=="Correct"){
                                                                                            echo '<span class="right blue darken-2 back" style="font-size:10px"><b>'.$fetch4['j'].'</b></span>';
                                                                                        }
                                                                                        else if($fetch4['j']=="Wrong"){
                                                                                            echo '<span class="right red back" style="font-size:10px"><b>'.$fetch4['j'].'</b></span>';
                                                                                        }
                                                                                    }
                                                                                }
                                                                            ?></p>
                                                                    <?php
                                                                        endwhile;
                                                                    }
                                                                    else if($type=="True/False"){
                                                                        $retrive1=mysqli_query($conn,"SELECT tbl_true_false.ID,tbl_true_false.question,tbl_true_false.answer FROM tbl_quiz INNER JOIN tbl_true_false ON tbl_true_false.quizID=tbl_quiz.quizID WHERE tbl_quiz.classID='$classID' AND tbl_quiz.quizTitle='$title'");
                                                                        $x=0;
                                                                        while($fetch1=mysqli_fetch_array($retrive1)):
                                                                            $x++;
                                                                            
                                                                    ?>
                                                                        <p class="white-text" style="margin-top: 10px;margin-bottom: 10px;">
                                                                            <?php echo $x?>) <span><b><?php echo $fetch1['answer']?></b></span> 
                                                                            <?php 
                                                                                $select=mysqli_query($conn,"SELECT * FROM tbl_account WHERE user='$user'");
                                                                                $row2=mysqli_num_rows($select);
                                                                                if($row2==1){
                                                                                    $fetch3=mysqli_fetch_array($select);
                                                                                    $id=$fetch3['accID'];

                                                                                    $retrive4=mysqli_query($conn,"SELECT * FROM tbl_score WHERE studentID='$id' AND quizID='$quizID'");
                                                                                    $fetch4=mysqli_fetch_array($retrive4);
                                                                                    
                                                                                    if($x==1){
                                                                                        if($fetch4['a']=="Correct"){
                                                                                        echo '<span class="right blue darken-2 back" style="font-size:10px"><b>'.$fetch4['a'].'</b></span>';
                                                                                        }
                                                                                        else if($fetch4['a']=="Wrong"){
                                                                                            echo '<span class="right red back" style="font-size:10px"><b>'.$fetch4['a'].'</b></span>';
                                                                                        }
                                                                                    }
                                                                                    else if($x==2){
                                                                                        if($fetch4['b']=="Correct"){
                                                                                            echo '<span class="right  blue darken-2 back" style="font-size:10px"><b>'.$fetch4['b'].'</b></span>';
                                                                                        }
                                                                                        else if($fetch4['b']=="Wrong"){
                                                                                            echo '<span class="right red back" style="font-size:10px"><b>'.$fetch4['b'].'</b></span>';
                                                                                        }
                                                                                    }
                                                                                    else if($x==3){
                                                                                        if($fetch4['c']=="Correct"){
                                                                                            echo '<span class="right blue darken-2 back" style="font-size:10px"><b>'.$fetch4['c'].'</b></span>';
                                                                                        }
                                                                                        else if($fetch4['c']=="Wrong"){
                                                                                            echo '<span class="right red back" style="font-size:10px"><b>'.$fetch4['c'].'</b></span>';
                                                                                        }
                                                                                    }
                                                                                    else if($x==4){
                                                                                        if($fetch4['d']=="Correct"){
                                                                                            echo '<span class="right blue darken-2 back" style="font-size:10px"><b>'.$fetch4['d'].'</b></span>';
                                                                                            }
                                                                                            else if($fetch4['d']=="Wrong"){
                                                                                                echo '<span class="right red back" style="font-size:10px"><b>'.$fetch4['d'].'</b></span>';
                                                                                            }
                                                                                    }
                                                                                    else if($x==5){
                                                                                        if($fetch4['e']=="Correct"){
                                                                                            echo '<span class="right blue back" style="font-size:10px"><b>'.$fetch4['e'].'</b></span>';
                                                                                        }
                                                                                        else if($fetch4['e']=="Wrong"){
                                                                                            echo '<span class="right red back" style="font-size:10px"><b>'.$fetch4['e'].'</b></span>';
                                                                                        }
                                                                                    }
                                                                                    else if($x==6){
                                                                                        if($fetch4['f']=="Correct"){
                                                                                            echo '<span class="right blue darken-2 back" style="font-size:10px"><b>'.$fetch4['f'].'</b></span>';
                                                                                        }
                                                                                        else if($fetch4['f']=="Wrong"){
                                                                                            echo '<span class="right red back" style="font-size:10px"><b>'.$fetch4['f'].'</b></span>';
                                                                                        }
                                                                                    }
                                                                                    else if($x==7){
                                                                                        if($fetch4['g']=="Correct"){
                                                                                            echo '<span class="right blue darken-2 back" style="font-size:10px"><b>'.$fetch4['g'].'</b></span>';
                                                                                        }
                                                                                        else if($fetch4['g']=="Wrong"){
                                                                                            echo '<span class="right red back" style="font-size:10px"><b>'.$fetch4['g'].'</b></span>';
                                                                                        }
                                                                                    }
                                                                                    else if($x==8){
                                                                                        if($fetch4['h']=="Correct"){
                                                                                            echo '<span class="right blue darken-2 back" style="font-size:10px"><b>'.$fetch4['h'].'</b></span>';
                                                                                        }
                                                                                        else if($fetch4['h']=="Wrong"){
                                                                                            echo '<span class="right red back" style="font-size:10px"><b>'.$fetch4['h'].'</b></span>';
                                                                                        }
                                                                                    }
                                                                                    else if($x==9){
                                                                                        if($fetch4['i']=="Correct"){
                                                                                            echo '<span class="right blue darken-2 back" style="font-size:10px"><b>'.$fetch4['i'].'</b></span>';
                                                                                        }
                                                                                        else if($fetch4['i']=="Wrong"){
                                                                                            echo '<span class="right red back" style="font-size:10px"><b>'.$fetch4['i'].'</b></span>';
                                                                                        }
                                                                                    }
                                                                                    else if($x==10){
                                                                                        if($fetch4['j']=="Correct"){
                                                                                            echo '<span class="right blue darken-2 back" style="font-size:10px"><b>'.$fetch4['j'].'</b></span>';
                                                                                        }
                                                                                        else if($fetch4['j']=="Wrong"){
                                                                                            echo '<span class="right red back" style="font-size:10px"><b>'.$fetch4['j'].'</b></span>';
                                                                                        }
                                                                                    }
                                                                                }
                                                                            ?></p>
                                                                        <?php
                                                                        endwhile;
                                                                    }
                                                                    ?>
                                                                        
                                                                            <?php
                                                                }
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
                                    <a href="quizStudent.php?code=<?php echo $_SESSION['code']?>" class=" modal-action waves-effect waves-blue btn-flat white-text red">Exit</a>
                                </div>
                            </form>
                            <div class="col l12"><br><br></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="materialize2.0/js/materialize.js"></script>
    <script src="main.js"></script>
    <script>
        $('.go').click(function() {
            x = 0;
            y = 0;
            z = 0;
            $('.getTotal').each(function() {
                var total = $(this).val();

                if (total == 'correct') {
                    x++;
                } else if (total == 'wrong') {
                    y++;
                } else if (total == '') {
                    z++;
                }
            });
            var getTotal = (x / (x + y)) * 100;
            if (getTotal < 50) {
                alert('failed');
                $('#average').val(getTotal);
            } else if (getTotal >= 50 && getTotal <= 90) {
                alert('passed');
                $('#average').val(getTotal);
            } else if (getTotal == 100) {
                alert('excellent');
                $('#average').val(getTotal);
            } else if (z >= 1) {
                alert("please fill all the question");
                $('#empty').val(z);
            }
        });

        $(document).on('click', '.x', function() {
            var id = $(this).attr('id');
            var ans = $('.selectT' + id).attr('id');
            $('#answerField' + id).val(ans);
            var correct = $('#correctAns' + id).text();
            if (ans == correct) {
                $('#correction' + id).val('correct');

            } else if (ans != correct) {
                $('#correction' + id).val('wrong');
            }

            $('.clickT' + id).css({
                'background': 'black',
                'color': 'white',
                'border': '2px solid white'
            });
            $('.selectT' + id).css({
                'background': 'black',
                'color': 'white',
                'border': '2px solid white'
            });
            $('.clickF' + id).css({
                'background': 'linear-gradient(to right, #ff3d00, #ffea00)',
                'border': '2px solid black',
                'color': 'black'
            });
            $('.selectF' + id).css({
                'background': 'white',
                'color': 'black',
                'border': '2px solid black'
            });

            //alert(value);
        });
        $(document).on('click', '.z', function() {
            var id = $(this).attr('id');
            var ans = $('.selectF' + id).attr('id');
            $('#answerField' + id).val(ans);
            var correct = $('#correctAns' + id).text();

            if (ans == correct) {
                $('#correction' + id).val('correct');

            } else if (ans != correct) {
                $('#correction' + id).val('wrong');
            }

            $('.clickF' + id).css({
                'background': 'black',
                'color': 'white',
                'border': '2px solid white'
            });
            $('.selectF' + id).css({
                'background': 'black',
                'color': 'white',
                'border': '2px solid white'
            });
            $('.clickT' + id).css({
                'background': 'linear-gradient(to right, #ff3d00, #ffea00)',
                'border': '2px solid black',
                'color': 'black'
            });
            $('.selectT' + id).css({
                'background': 'white',
                'color': 'black',
                'border': '2px solid black'
            });

            //alert(value);
        });
    </script>
</body>

</html>