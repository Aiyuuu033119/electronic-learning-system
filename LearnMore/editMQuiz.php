<?php
    session_start();
    require_once('process.php');
    include('connection.php');
    if(!isset($_SESSION['teacher'])){
        header('location:login.php');
        
    }
    
    if ($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['editChoice'])) {
        $myphp=new myphp();
        $myphp->editChoice();
        exit();
    }
    if ($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['deleteQuiz'])) {
        $myphp=new myphp();
        $myphp->deleteQuiz();
        exit();
    }
    if ($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['updateTitle'])) {
        $myphp=new myphp();
        $myphp->editQuizTitle();
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

    <!-- EDIT TITLE TOPIC -->
    <div id="editLesson" class="modal popup grey darken-4"><br>
        <p class="center white-text fontStyle"><b>Learn<span class="black-text">more</b></span></p><br>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" id="form">
            <div class="modal-content noPadding">
                <div class="row">
                    <div class="col l12" id="displayType1">
                        <div class="input-field border-radius">
                            <input placeholder="Quiz Title" type="text" class="center inputAdjust border-radius border-color white-text" name="quizTitles" id="quizTitles">
                        </div>
                        <div class="input-field white hide ">
                            <input placeholder="Topic" type="text" class="center inputAdjust " name="quizIDS" id="quizIDS">
                        </div>
                        <div class="input-field white hide">
                            <input placeholder="Topic" type="text" class="center inputAdjust" name="quizNums" id="quizNums">
                        </div>
                        <div class="input-field white hide">
                            <input placeholder="Quiz Title" type="text" class="center inputAdjust" name="quizTitles1" id="quizTitles1">
                        </div>
                    </div>
                
                </div>
            </div>
            <div class="modal-footer transparent">
                <input id="submit" type="submit" class="white-text btn-flat " value="UPDATE" name="updateTitle">
                <a href="editMQuiz.php?title=<?php echo $_GET['title'].'&num='.$_GET['num'].'&id='.$_GET['id']?>" class="modal-action waves-effect waves-red btn-flat white-text red">Cancel</a>
            </div>
        </form>
    </div>

    <!-- EDIT SUB-TOPIC -->
    <div id="multiple" class="modal popup grey darken-4">
        <div class="section">
            <p class="center white-text fontStyle"><b>Learn<span class=" black-text">more</b></span></p>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
            <div class="modal-content">
                <div class="section">
                    <div class="row">
                        
                        <!--Add Quiz Question -->
                        <div class="col l12 " id="question">
                            <div class="row panel" id="num1"><br>
                                <div class="col l12">
                                    <div class="section row">
                                        <div class="col l12" id="displayType1">
                                            <div class="col l12">
                                                <p class="white-text center back2">Question <span id="numQuest"></span></p>
                                            </div>
                                            <div class="input-field border-radius">
                                                <input placeholder="Question" id="editQuestion" type="text" class="center inputAdjust white-text border-radius border-color" name="editQuestion">
                                            </div>
                                            <div class="input-field white hide">
                                                <input placeholder="Question" id="editQuestion1" type="text" class="center inputAdjust" name="editQuestion1">
                                            </div><br>
                                            <div class="input-field row ">
                                                <div class="col l1 lettera pickA" id="1">
                                                    <p class="center letter" >A</p>
                                                </div>
                                                <input style="position:absolute" placeholder="Choice 1" id="choiceA" type="text" class="center border-radius2 border-color white-text col l11 inputAdjust " name="choiceA">
                                            </div>
                                            <div class="input-field row ">
                                                <div class="col l1 letterb pickB" id="1">
                                                    <p class="center letter" >B</p>
                                                </div>
                                                <input style="position:absolute" placeholder="Choice 2" id="choiceB" type="text" class="center border-radius2 border-color white-text col l11 inputAdjust" name="choiceB">
                                            </div>
                                            <div class="input-field row ">
                                                <div class="col l1 letterc pickC" id="1">
                                                    <p class="center letter" >C</p>
                                                </div>
                                                <input style="position:absolute" placeholder="Choice 3" id="choiceC" type="text" class="center border-radius2 border-color white-text col l11 inputAdjust" name="choiceC">
                                            </div>
                                            <div class="input-field row ">
                                                <div class="col l1 letterd pickD" id="1">
                                                    <p class="center letter" >D</p>
                                                </div>
                                                <input style="position:absolute" placeholder="Choice 4" id="choiceD" type="text" class="center border-radius2 border-color white-text col l11 inputAdjust" name="choiceD">
                                            </div>
                                            <div class="divider"></div>
                                            <div class="input-field white hide">
                                                <input id="answer" type="text" class="col l11 inputAdjust" name="answer">
                                            </div>
                                            <div class="input-field white hide">
                                                <input id="quizID" type="text" class="col l11 inputAdjust" name="quizID">
                                            </div>
                                            <div class="input-field white hide">
                                                <input id="quizChoiceID" type="text" class="col l11 inputAdjust" name="quizChoiceID">
                                            </div>
                                            <div class="input-field white hide">
                                                <input id="number" type="text" class="col l11 inputAdjust" name="number">
                                            </div> 
                                            <div class="input-field white hide">
                                                <input id="numberTitle" type="text" class="col l11 inputAdjust" name="numberTitle">
                                            </div> 
                                            <div class="col l12">
                                                <h6 class="white-text" >Take Note: Make sure that you select the right answer, Before you select for the right answer please filled all the boxes</h6>
                                                <h6 class="white-text" >Answer: <span id="showAnswer"> Please select the letter for the answer</span></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer transparent">
                <input type="submit" class="white-text btn-flat " value="UPDATE" name="editChoice">
                <a href="editMQuiz.php?title=<?php echo $_GET['title'].'&num='.$_GET['num'].'&id='.$_GET['id']?>" class="modal-action waves-effect waves-red btn-flat white-text red">Cancel</a>
            </div>
        </form>
    </div>

    <!-- DELETE TITLE TOPIC -->
    <div id="delete" class="modal popup grey darken-4">
        <div class="section">
            <p class="center white-text fontStyle"><b>Learn<span class=" black-text">more</b></span></p>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
            <div class="modal-content" id="displayTextDelete">
                <p class="center"><i class="fas fa-trash iconType"></i></p>
                <h5 class="white-text center">Are you sure? You want to delete this Question?</h5>
                <div class="input-field white hide">
                    <input placeholder="Sub-Topic " type="text" class="center inputAdjust" name="deleteID" id="deleteID">
                </div>
                <div class="input-field white hide">
                    <input placeholder="Sub-Topic " type="text" class="center inputAdjust" name="deleteTitle" id="deleteTitle">
                </div>
                <div class="input-field white hide">
                    <input placeholder="Sub-Topic " type="text" class="center inputAdjust" name="deleteNum" id="deleteNum">
                </div>
                <div class="input-field white hide">
                    <input placeholder="Sub-Topic " type="text" class="center inputAdjust" name="deleteQuizID" id="deleteQuizID">
                </div>
            </div>
            <div class="modal-footer transparent">
                <input type="submit" class="white-text btn-flat lineBlue" value="DELETE" name="deleteQuiz">
                <a href="editMQuiz.php?title=<?php echo $_GET['title'].'&num='.$_GET['num'].'&id='.$_GET['id']?>" class=" modal-action modal-close waves-effect waves-red btn-flat white-text red">Cancel</a>
            </div>
        </form>
    </div>

    <!-- SAVE EDITED QUESTION -->
    <div id="save" class="modal popup grey darken-4">
        <div class="section">
            <p class="center white-text fontStyle"><b>Learn<span class=" black-text">more</b></span></p>
        </div>
        <div class="modal-content no-padding-bot-top" id="displayTextDelete">
            <div class="row">
                <p class="center"><i class="fas fa-check iconType"></i></p>
                <h5 class="center white-text fontStyle ">Successfully saved!</h5>
                <div class="col l12 center"><br>
                    <a href="quizTeacher.php?code=<?php echo $_SESSION['code']?>" class="modal-trigger modal-close waves-effect waves-light btn-large blue darken-3 btnModifySizeAdd">Okay</a>
                </div>
            </div>   
        </div>
    </div>

    <!-- BODY -->
    <div class="section">
        <div class="row ">
            <div class="col l8 push-l2"><br>
                <div class="card grey darken-4 bgCard1">
                    <div class="content">
                        <div class="row">
                            <br>
                            <div class="col l12">
                                <p class="center white-text fontStyle"><b>Learn<span class=" amber darken-3 black-text">more</b></span></p><br>
                            </div>
                            <div class="col l12">
                                <span class="right"><a href="#editLesson" class="modal-trigger editTopic back light blue white-text"><i class="fas fa-edit iconStyle"></i></a></span>

                                <div class="col l12 ">
                                    <h3 class="white-text zeroMargin center" id="title"><span class="back2 blue">Quiz <span id="num"><?php echo $_GET['num']?></span></span> <span id="titleNum"><?php echo $_GET['title']?></span></h3><br>
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
                                        <div class="col l10 push-l1" id="topic">
                                            <div class="row panel" id="num1"><br>
                                                <div class="col l12">
                                                    <span class="right callModal "><a href="#delete" class="modal-trigger delete back red white-text" id="<?php echo $fetch1['ID']?>"><i class="fas fa-trash"></i></a></span>
                                                    <span class="right callModal "><a href="#multiple" class="modal-trigger edit back light blue white-text" id="<?php echo $fetch1['ID']?>"><i class="fas fa-edit"></i></a></span>
                                                </div>
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
                                <a href="#save" class="modal-trigger modal-action waves-effect waves-red btn light blue white-text"><i class="fas fa-check iconStyle"></i> Finish</a>
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
    <script>
        $(document).ready(function() {
            




            //EDIT MODAL
            $(document).on('click','.edit',function(){
                var num=$('#num').text();
                var numTitle=$('#titleNum').text();
                var id=$(this).attr('id');
                var title=$('#title').text()
                var numberQuestion=$('#numQuestion'+id).text()
                var question=$('#quiz'+id).text()
                var a=$('#a'+id).text()
                var b=$('#b'+id).text()
                var c=$('#c'+id).text()
                var d=$('#d'+id).text()
                var ansLetter=$('#answer'+id).text()
                var answer=$('#answer'+id).attr('class');

                $('#numQuest').text(numberQuestion);
                $('#editQuestion').val(question);
                $('#editQuestion1').val(question);
                $('#choiceA').val(a);
                $('#choiceB').val(b);
                $('#choiceC').val(c);
                $('#choiceD').val(d);
                $('#answer').val(answer);
                $('#quizID').val(id);
                $('#number').val(num);
                $('#numberTitle').val(numTitle);
                $('#showAnswer').text(ansLetter);
                $('#quizChoiceID').val('<?php echo $_GET['id']?>');

                if(ansLetter=='A'){
                    $('.pickA').css({
                        'background':'black',
                        'color':'white',
                        'border':'2px solid white'
                    });
                    $('#choiceA').css({
                        'background':'black',
                        'color':'white',
                        'border':'2px solid white'
                    });
                    $('.pickB').css({
                        'background':'linear-gradient(to right, #ff3d00, #ffea00)',
                        'color':'black',
                        'border':'2px solid black'
                    });
                    $('.pickC').css({
                        'background':'linear-gradient(to right, #ff3d00, #ffea00)',
                        'color':'black',
                        'border':'2px solid black'
                    });
                    $('.pickD').css({
                        'background':'linear-gradient(to right, #ff3d00, #ffea00)',
                        'color':'black',
                        'border':'2px solid black'
                    });
                }
                else if(ansLetter=='B'){
                    $('.pickB').css({
                        'background':'black',
                        'color':'white',
                        'border':'2px solid white'
                    });
                    $('#choiceB').css({
                        'background':'black',
                        'color':'white',
                        'border':'2px solid #424242'
                    });
                    $('.pickA').css({
                        'background':'linear-gradient(to right, #ff3d00, #ffea00)',
                        'color':'black',
                        'border':'2px solid black'
                    });
                    $('.pickC').css({
                        'background':'linear-gradient(to right, #ff3d00, #ffea00)',
                        'color':'black',
                        'border':'2px solid black'
                    });
                    $('.pickD').css({
                        'background':'linear-gradient(to right, #ff3d00, #ffea00)',
                        'color':'black',
                        'border':'2px solid black'
                    });
                }
                else if(ansLetter=='C'){
                    $('.pickC').css({
                        'background':'black',
                        'color':'white',
                        'border':'2px solid white'
                    });
                    $('#choiceC').css({
                        'background':'black',
                        'color':'white',
                        'border':'2px solid white'
                    });
                    $('.pickB').css({
                        'background':'linear-gradient(to right, #ff3d00, #ffea00)',
                        'color':'black',
                        'border':'2px solid black'
                    });
                    $('.pickA').css({
                        'background':'linear-gradient(to right, #ff3d00, #ffea00)',
                        'color':'black',
                        'border':'2px solid black'
                    });
                    $('.pickD').css({
                        'background':'linear-gradient(to right, #ff3d00, #ffea00)',
                        'color':'black',
                        'border':'2px solid black'
                    });
                }
                else if(ansLetter=='D'){
                    $('.pickD').css({
                        'background':'black',
                        'color':'white',
                        'border':'2px solid white'
                    });
                    $('#choiceD').css({
                        'background':'black',
                        'color':'white',
                        'border':'2px solid white'
                    });
                    $('.pickB').css({
                        'background':'linear-gradient(to right, #ff3d00, #ffea00)',
                        'color':'black',
                        'border':'2px solid black'
                    });
                    $('.pickC').css({
                        'background':'linear-gradient(to right, #ff3d00, #ffea00)',
                        'color':'black',
                        'border':'2px solid black'
                    });
                    $('.pickA').css({
                        'background':'linear-gradient(to right, #ff3d00, #ffea00)',
                        'color':'black',
                        'border':'2px solid black'
                    });
                }
            });

            //DELETE MODAL 
            $(document).on('click','.delete',function(){
                var id=$(this).attr('id');
                
                $('#deleteID').val(id);
                $('#deleteTitle').val('<?php echo $_GET['title']?>');
                $('#deleteNum').val('<?php echo $_GET['num']?>');
                $('#deleteQuizID').val('<?php echo $_GET['id']?>');

            });

            //EDIT TOPIC TITLE
            $(document).on('click','.editTopic',function(){
                var title=$('#titleNum').text()

                $('#quizTitles1').val('<?php echo $_GET['title']?>');
                $('#quizTitles').val('<?php echo $_GET['title']?>');
                $('#quizIDS').val('<?php echo $_GET['id']?>');
                $('#quizNums').val('<?php echo $_GET['num']?>');
            });


            $(document).on('click','.lettera',function(){
                var id=$(this).attr('id');
                var value=$('#choiceA').val();
                
                if(value==''){
                    alert('You must fill the input box');
                }
                else{
                    $('.pickA').css({
                        'background':'black',
                        'color':'white',
                        'border':'2px solid white'
                    });
                    $('#choiceA').css({
                        'background':'black',
                        'color':'white',
                        'border':'2px solid white'
                    });
                    $('.pickB').css({
                        'background':'linear-gradient(to right, #ff3d00, #ffea00)',
                        'color':'black',
                        'border':'2px solid black'
                    });
                    $('#choiceB').css({
                        'background':'transparent',
                        'color':'white',
                        'border':'2px solid #424242'
                    });
                    $('.pickC').css({
                        'background':'linear-gradient(to right, #ff3d00, #ffea00)',
                        'color':'black',
                        'border':'2px solid black'
                    });
                    $('#choiceC').css({
                        'background':'transparent',
                        'color':'white',
                        'border':'2px solid #424242'
                    });
                    $('.pickD').css({
                        'background':'linear-gradient(to right, #ff3d00, #ffea00)',
                        'color':'black',
                        'border':'2px solid black'
                    });
                    $('#choiceD').css({
                        'background':'transparent',
                        'color':'white',
                        'border':'2px solid #424242'
                    });
                    $('#answer').val(value);
                    $('#showAnswer').text('A');
                    //alert(value);
                }
            });
            $(document).on('click','.letterb',function(){
                var id=$(this).attr('id');
                var value=$('#choiceB').val();
                if(value==''){
                    alert('You must fill the input box');
                }
                else{
                    $('.pickB').css({
                        'background':'black',
                        'color':'white',
                        'border':'2px solid white'
                    });
                    $('#choiceB').css({
                        'background':'black',
                        'color':'white',
                        'border':'2px solid white'
                    });
                    $('.pickA').css({
                        'background':'linear-gradient(to right, #ff3d00, #ffea00)',
                        'color':'black',
                        'border':'2px solid black'
                    });
                    $('#choiceA').css({
                        'background':'transparent',
                        'color':'white',
                        'border':'2px solid #424242'
                    });
                    $('.pickC').css({
                        'background':'linear-gradient(to right, #ff3d00, #ffea00)',
                        'color':'black',
                        'border':'2px solid black'
                    });
                    $('#choiceC').css({
                        'background':'transparent',
                        'color':'white',
                        'border':'2px solid #424242'
                    });
                    $('.pickD').css({
                        'background':'linear-gradient(to right, #ff3d00, #ffea00)',
                        'color':'black',
                        'border':'2px solid black'
                    });
                    $('#choiceD').css({
                        'background':'transparent',
                        'color':'white',
                        'border':'2px solid #424242'
                    });
                    $('#answer').val(value);
                    $('#showAnswer').text('B');
                    //alert(value);
                }
            });
            $(document).on('click','.letterc',function(){
                var id=$(this).attr('id');
                var value=$('#choiceC').val();
                if(value==''){
                    alert('You must fill the input box');
                }
                else{
                    $('.pickC').css({
                        'background':'black',
                        'color':'white',
                        'border':'2px solid white'
                    });
                    $('#choiceC').css({
                        'background':'black',
                        'color':'white',
                        'border':'2px solid white'
                    });
                    $('.pickB').css({
                        'background':'linear-gradient(to right, #ff3d00, #ffea00)',
                        'color':'black',
                        'border':'2px solid black'
                    });
                    $('#choiceB').css({
                        'background':'transparent',
                        'color':'white',
                        'border':'2px solid #424242'
                    });
                    $('.pickA').css({
                        'background':'linear-gradient(to right, #ff3d00, #ffea00)',
                        'color':'black',
                        'border':'2px solid black'
                    });
                    $('#choiceA').css({
                        'background':'transparent',
                        'color':'white',
                        'border':'2px solid #424242'
                    });
                    $('.pickD').css({
                        'background':'linear-gradient(to right, #ff3d00, #ffea00)',
                        'color':'black',
                        'border':'2px solid black'
                    });
                    $('#choiceD').css({
                        'background':'transparent',
                        'color':'white',
                        'border':'2px solid #424242'
                    });
                    $('#answer').val(value);
                    $('#showAnswer').text('C');        
                    //alert(value);
                }
            });
            $(document).on('click','.letterd',function(){
                var id=$(this).attr('id');
                var value=$('#choiceD').val();
                if(value==''){
                    alert('You must fill the input box');
                }
                else{
                    $('.pickD').css({
                        'background':'black',
                        'color':'white',
                        'border':'2px solid white'
                    });
                    $('#choiceD').css({
                        'background':'black',
                        'color':'white',
                        'border':'2px solid white'
                    });
                    $('.pickB').css({
                        'background':'linear-gradient(to right, #ff3d00, #ffea00)',
                        'color':'black',
                        'border':'2px solid black'
                    });
                    $('#choiceB').css({
                        'background':'transparent',
                        'color':'white',
                        'border':'2px solid #424242'
                    });
                    $('.pickC').css({
                        'background':'linear-gradient(to right, #ff3d00, #ffea00)',
                        'color':'black',
                        'border':'2px solid black'
                    });
                    $('#choiceC').css({
                        'background':'transparent',
                        'color':'white',
                        'border':'2px solid #424242'
                    });
                    $('.pickA').css({
                        'background':'linear-gradient(to right, #ff3d00, #ffea00)',
                        'color':'black',
                        'border':'2px solid black'
                    });
                    $('#choiceA').css({
                        'background':'transparent',
                        'color':'white',
                        'border':'2px solid #424242'
                    });
                    $('#answer').val(value);
                    $('#showAnswer').text('D');
                    //alert(value);
                }
            });


            $(document).on('keyup','#choiceA',function(){
                var ans=$('#showAnswer').text();
                if(ans=='A'){
                    var a=$(this).val();
                    $('#answer').val(a);
                }
            });
            $(document).on('keyup','#choiceB',function(){
                var ans=$('#showAnswer').text();

                if(ans=='B'){
                    var b=$(this).val();
                    $('#answer').val(b);
                }
            });
            $(document).on('keyup','#choiceC',function(){
                var ans=$('#showAnswer').text();

                if(ans=='C'){
                    var c=$(this).val();
                    $('#answer').val(c);
                }
            });
            $(document).on('keyup','#choiceD',function(){
                var ans=$('#showAnswer').text();

                if(ans=='D'){
                    var d=$(this).val();
                    $('#answer').val(d);
                }
            });
        });
    </script>
</body>
</html>