<?php
    session_start();
    require_once('process.php');
    include('connection.php');
    if(!isset($_SESSION['student'])){
        header('location:login.php');
        
    }
    if ($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['takeMQuiz'])) {
        $myphp=new myphp();
        $myphp->takeMQuiz();
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
                                <p class="center white-text fontStyle"><b>Learn<span class=" amber darken-3 black-text">more</b></span></p><br><br>
                            </div>
                            <form action="<?php echo $_SERVER['PHP_SELF']?>"  method="POST">
                                <div class="col l10 push-l1">
                                    <div class="col l12 ">
                                        <h4 class="white-text zeroMargin center" id="title"> <span class="back2 orange darken-4">Quiz <span id="num"><?php echo $_GET['num']?></span></span> <span id="titleNum"><?php echo $_GET['title']?></span></h4><br><br>
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
                                                                <h5 class="white-text zeroMargin" ><span id="numQuestion<?php echo $fetch1['ID']?>"><?php echo $x?></span>. <span id="quiz<?php echo $fetch1['ID']?>"><?php echo $fetch1['question']?></span> </h5>
                                                                <p class="white-text col l12 e" id="<?php echo $x?>"><span class="col l1 center clickA<?php echo $x?> choosePad">A. </span><span class="col l11 center selectA<?php echo $x?> selection" id="<?php echo $fetch1['ID']?>"><?php echo $fetch1['a']?></span></p><br>
                                                                <p class="white-text col l12 f" id="<?php echo $x?>"><span class="col l1 center clickB<?php echo $x?> choosePad">B. </span><span class="col l11 center selectB<?php echo $x?> selection" id="<?php echo $fetch1['ID']?>"><?php echo $fetch1['b']?></span></p><br>
                                                                <p class="white-text col l12 g" id="<?php echo $x?>"><span class="col l1 center clickC<?php echo $x?> choosePad">C. </span><span class="col l11 center selectC<?php echo $x?> selection" id="<?php echo $fetch1['ID']?>"><?php echo $fetch1['c']?></span></p><br>
                                                                <p class="white-text col l12 h" id="<?php echo $x?>"><span class="col l1 center clickD<?php echo $x?> choosePad">D. </span><span class="col l11 center selectD<?php echo $x?> selection" id="<?php echo $fetch1['ID']?>"><?php echo $fetch1['d']?></span></p><br>
                                                                <p class="white-text center hide"  >Answer: <span class="<?php echo $fetch1['answer']?>" id="answer<?php echo $fetch1['ID']?>"><?php 
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
                                                                //echo $fetch1['answer']?></span> - <span id="correctAns<?php echo $x ?>"><?php echo $fetch1['answer']?></span></p><br>
                                                                <div class="input-field hide">
                                                                    <input id="answerField<?php echo $x ?>" type="text" class="center inputAdjust" name="answer<?php echo $x ?>">
                                                                </div>
                                                                <div class="input-field hide">
                                                                    <input id="correction<?php echo $x ?>" type="text" class="center inputAdjust getTotal" name="correction<?php echo $x ?>">
                                                                </div>
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
                                    <div class="input-field hide">
                                        <input id="" type="text" class="center inputAdjust getTotal" name="id" value="<?php echo $_GET['id']?>">
                                    </div>
                                    <div class="input-field hide">
                                        <input id="" type="text" class="center inputAdjust " name="title" value="<?php echo $_GET['title']?>">
                                    </div>
                                    <div class="input-field hide">
                                        <input id="" type="text" class="center inputAdjust " name="num" value="<?php echo $_GET['num']?>">
                                    </div>
                                    <div class="input-field hide">
                                        <input id="empty" type="text" class="center inputAdjust " name="empty" >
                                    </div>
                                    <div class="input-field hide">
                                        <input id="average" type="text" class="center inputAdjust" name="average">
                                    </div>
                                </div>
                                <div class="col l12 center">
                                    <button id="submit" name="takeMQuiz" class="go waves-effect waves-light btn light-blue darken-3 btnModifySizeAdd"><i class="fas fa-check iconStyle"></i> Finish</button>
                                    <a href="quizStudent.php?code=<?php echo $_SESSION['code']?>" class="modal-trigger modal-action waves-effect waves-blue btn-flat white-text red">Exit</a>
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

        $('.go').click(function(){
            x=0;
            y=0;
            z=0;
            $('.getTotal').each(function(){
                var total=$(this).val();
                
                if(total=='Correct'){
                    x++;
                }
                else if(total=='Wrong'){
                    y++;
                }
                else if(total==''){
                    z++;
                }
            });
            var getTotal=(x/(x+y))*100;
            if(getTotal<50){
                alert('failed');
                $('#average').val(getTotal);
            }
            else if(getTotal>=50&&getTotal<=90){
                alert('passed');
                $('#average').val(getTotal);
            }
            else if(getTotal==100){
                alert('excellent');
                $('#average').val(getTotal);
            }
            else if(z>=1){
                alert("please fill all the question");
                $('#empty').val(z);
            }
        });
        
        $(document).on('click','.e',function(){
            var id=$(this).attr('id');
            var ans=$('.selectA'+id).text();
            $('#answerField'+id).val(ans);
            var correct=$('#correctAns'+id).text();
            if(ans==correct){
                $('#correction'+id).val('Correct');
                
            }
            else if(ans!=correct){
                $('#correction'+id).val('Wrong');
            }
            $('.clickA'+id).css({
            'background':'black',
            'color':'white',
            'border':'2px solid white'
            });
            $('.selectA'+id).css({
            'background':'black',
            'color':'white',
            'border':'2px solid white'
            });
            $('.clickB'+id).css({
                'background': 'linear-gradient(to right, #ff3d00, #ffea00)',
                'border': '2px solid black',
                'color': 'black'
            });
            $('.selectB'+id).css({
            'background':'white',
            'color':'black',
            'border':'2px solid black'
            });
            $('.clickC'+id).css({
                'background': 'linear-gradient(to right, #ff3d00, #ffea00)',
                'border': '2px solid black',
                'color': 'black'
            });
            $('.selectC'+id).css({
            'background':'white',
            'color':'black',
            'border':'2px solid black'
            });
            $('.clickD'+id).css({
                'background': 'linear-gradient(to right, #ff3d00, #ffea00)',
                'border': '2px solid black',
                'color': 'black'
            });
            $('.selectD'+id).css({
            'background':'white',
            'color':'black',
            'border':'2px solid black'
            });
            
            //alert(value);
        });

        $(document).on('click','.f',function(){
            var id=$(this).attr('id');
            var ans=$('.selectB'+id).text();
            $('#answerField'+id).val(ans);
            var correct=$('#correctAns'+id).text();
            if(ans==correct){
                $('#correction'+id).val('Correct');
                
            }
            else if(ans!=correct){
                $('#correction'+id).val('Wrong');
            }

            $('.clickB'+id).css({
                'background':'black',
                'color':'white',
                'border':'2px solid white'
            });
            $('.selectB'+id).css({
            'background':'black',
            'color':'white',
            'border':'2px solid white'
            });
            $('.clickA'+id).css({
                'background': 'linear-gradient(to right, #ff3d00, #ffea00)',
                'border': '2px solid black',
                'color': 'black'
            });
            $('.selectA'+id).css({
            'background':'white',
            'color':'black',
            'border':'2px solid black'
            });
            $('.clickC'+id).css({
                'background': 'linear-gradient(to right, #ff3d00, #ffea00)',
                'border': '2px solid black',
                'color': 'black'
            });
            $('.selectC'+id).css({
            'background':'white',
            'color':'black',
            'border':'2px solid black'
            });
            $('.clickD'+id).css({
                'background': 'linear-gradient(to right, #ff3d00, #ffea00)',
                'border': '2px solid black',
                'color': 'black'
            });
            $('.selectD'+id).css({
            'background':'white',
            'color':'black',
            'border':'2px solid black'
            });
            $('#answer'+id).val(value);
            $('#showAnswer'+id).text('B');
            //alert(value);
        });
        $(document).on('click','.g',function(){
            var id=$(this).attr('id');
            var ans=$('.selectC'+id).text();
            $('#answerField'+id).val(ans);
            var correct=$('#correctAns'+id).text();
            if(ans==correct){
                $('#correction'+id).val('Correct');
            }
            else if(ans!=correct){
                $('#correction'+id).val('Wrong');
            }

            $('.clickC'+id).css({
                'background':'black',
                'color':'white',
                'border':'2px solid white'
            });
            $('.selectC'+id).css({
            'background':'black',
            'color':'white',
            'border':'2px solid white'
            });
            $('.clickB'+id).css({
                'background': 'linear-gradient(to right, #ff3d00, #ffea00)',
                'border': '2px solid black',
                'color': 'black'
            });
            $('.selectB'+id).css({
            'background':'white',
            'color':'black',
            'border':'2px solid black'
            });
            $('.clickA'+id).css({
                'background': 'linear-gradient(to right, #ff3d00, #ffea00)',
                'border': '2px solid black',
                'color': 'black'
            });
            $('.selectA'+id).css({
            'background':'white',
            'color':'black',
            'border':'2px solid black'
            });
            $('.clickD'+id).css({
                'background': 'linear-gradient(to right, #ff3d00, #ffea00)',
                'border': '2px solid black',
                'color': 'black'
            });
            $('.selectD'+id).css({
            'background':'white',
            'color':'black',
            'border':'2px solid black'
            });
            $('#answer'+id).val(value);
            $('#showAnswer'+id).text('C');        
            //alert(value);
        });
        $(document).on('click','.h',function(){
            var id=$(this).attr('id');
            var ans=$('.selectD'+id).text();
            $('#answerField'+id).val(ans);
            var correct=$('#correctAns'+id).text();
            if(ans==correct){
                $('#correction'+id).val('Correct');
            }
            else if(ans!=correct){
                $('#correction'+id).val('Wrong');
            }
            
            $('.clickD'+id).css({
                'background':'black',
                'color':'white',
                'border':'2px solid white'
            });
            $('.selectD'+id).css({
            'background':'black',
            'color':'white',
            'border':'2px solid white'
            });
            $('.clickB'+id).css({
                'background': 'linear-gradient(to right, #ff3d00, #ffea00)',
                'border': '2px solid black',
                'color': 'black'
            });
            $('.selectB'+id).css({
            'background':'white',
            'color':'black',
            'border':'2px solid black'
            });
            $('.clickC'+id).css({
                'background': 'linear-gradient(to right, #ff3d00, #ffea00)',
                'border': '2px solid black',
                'color': 'black'
            });
            $('.selectC'+id).css({
            'background':'white',
            'color':'black',
            'border':'2px solid black'
            });
            $('.clickA'+id).css({
                'background': 'linear-gradient(to right, #ff3d00, #ffea00)',
                'border': '2px solid black',
                'color': 'black'
            });
            $('.selectA'+id).css({
            'background':'white',
            'color':'black',
            'border':'2px solid black'
            });
            $('#answer'+id).val(value);
            $('#showAnswer'+id).text('D');
            //alert(value);
        });

            
    </script>
</body>
</html>