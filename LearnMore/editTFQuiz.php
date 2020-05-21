<?php
    session_start();
    require_once('process.php');
    include('connection.php');
    if(!isset($_SESSION['teacher'])){
        header('location:login.php');
        
    }
    
    if ($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['edittf'])) {
        $myphp=new myphp();
        $myphp->editTFQuiz();
        exit();
    }
    if ($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['deleteQuiz'])) {
        $myphp=new myphp();
        $myphp->deleteTFQuiz();
        exit();
    }
    if ($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['updateTitle'])) {
        $myphp=new myphp();
        $myphp->editTitleTFQuiz();
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
        <p class="center white-text fontStyle"><b>Learn<span class=" black-text">more</b></span></p><br>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" id="form">
            <div class="modal-content noPadding">
                <div class="row">
                    <div class="col l12" id="displayType1">
                        <div class="input-field white hide">
                            <input placeholder="Topic" type="text" class="center inputAdjust" name="quizIDS" id="quizIDS">
                        </div>
                        <div class="input-field white hide">
                            <input placeholder="Topic" type="text" class="center inputAdjust" name="quizNums" id="quizNums">
                        </div>
                        <div class="input-field border-radius">
                            <input placeholder="Quiz Title" type="text" class=" center inputAdjust border-radius border-color white-text" name="quizTitles" id="quizTitles">
                        </div>
                        <div class="input-field white hide">
                            <input placeholder="Quiz Title" type="text" class="center inputAdjust" name="quizTitles1" id="quizTitles1">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer transparent">
                <input id="submit" type="submit" class="white-text btn-flat " value="UPDATE" name="updateTitle">
                <a href="editTFQuiz.php?title=<?php echo $_GET['title'].'&num='.$_GET['num'].'&id='.$_GET['id']?>" class="modal-action waves-effect waves-red btn-flat white-text red">Cancel</a>
            </div>
        </form>
    </div>

    <!-- EDIT SUB-TOPIC -->
    <div id="tf" class="modal popup grey darken-4">
        <div class="section">
            <p class="center white-text fontStyle"><b>Learn<span class=" black-text">more</b></span></p>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
            <div class="modal-content no-padding-bot-top">
                <div class="section no-padding-bot-top">
                    <div class="row">
                        
                        <!--Add Quiz Question -->
                        <div class="col l12 " id="question2">
                            <div class="row panel" id="num1" style="margin-bottom: 0px;">
                                
                                <div class="col l12">
                                    <div class="section row">
                                        <div class="col l12" id="displayType1">
                                            <div class="col l12">
                                                <p class="white-text back center">Question <span id="number"></span></p>
                                            </div>
                                            <div class="input-field border-radius">
                                                <input id="1" type="text" class="center inputAdjust tfQuestion  border-radius border-color white-text" name="tfQuestion">
                                            </div>
                                            <div class="input-field white hide">
                                                <input placeholder="Question" id="1" type="text" class="center inputAdjust tfQuestion1" name="tfQuestion1">
                                            </div>
                                            <br>
                                            <div class="col l12">
                                                <h6 class="white-text" >Take Note: <span id="showAnswer1"> Please select the for the right answer</span></h5><br>
                                            </div>
                                            <div class="col l12">
                                                <div class="col l2 push-l4 true pickTrue" id="1">
                                                    <p class="center letter" >True</p>
                                                </div>
                                                <div class="col l2 push-l4 false pickFalse" id="1">
                                                    <p class="center letter" >False</p>
                                                </div>
                                            </div>
                                            <div class="input-field white hide">
                                                <input id="tfAnswer" type="text" class="col l11 inputAdjust" name="tfAnswer">
                                            </div>
                                            <div class="input-field white hide">
                                                <input id="tfid" type="text" class="col l11 inputAdjust" name="tfid">
                                            </div>
                                            <div class="input-field white hide">
                                                <input id="tftitle" type="text" class="col l11 inputAdjust" name="tftitle">
                                            </div>
                                            <div class="input-field white hide">
                                                <input id="tfnum" type="text" class="col l11 inputAdjust" name="tfnum">
                                            </div>
                                            <div class="input-field white hide">
                                                <input id="tfquizID" type="text" class="col l11 inputAdjust" name="tfquizID">
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
                <input type="submit" class="white-text btn-flat " value="Update" name="edittf">
                <a href="editTFQuiz.php?title=<?php echo $_GET['title'].'&num='.$_GET['num'].'&id='.$_GET['id']?>" class="modal-action waves-effect waves-red btn-flat white-text red">Cancel</a>
            </div>
        </form>
    </div>

    <!-- DELETE TITLE TOPIC -->
    <div id="delete" class="modal popup grey darken-4">
        <div class="section">
            <p class="center white-text fontStyle"><b>Learn<span class="black-text">more</b></span></p>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
            <div class="modal-content" id="displayTextDelete">
                <p class="center"><i class="fas fa-trash iconType"></i></p>
                <h5 class="white-text center">Are you sure? You want to delete this Q   uestion?</h5>
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
                <a class="modal-close modal-action modal-close waves-effect waves-red btn-flat white-text red">Cancel</a>
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
                                        

                                        <!--DISPLAY SUB-TOPIC -->
                                        <div class="col l10 push-l1" id="topic">
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
                                                            <span class="right callModal"><a href="#delete" class="modal-trigger delete back red white-text" id="<?php echo $fetch1['ID']?>"><i class="fas fa-trash iconStyle"></i></a></span>
                                                            <span class="right callModal"><a href="#tf" class="modal-trigger edit back light blue white-text" id="<?php echo $fetch1['ID']?>"><i class="fas fa-edit iconStyle"></i></a></span>
                                                            
                                                            <h5 class="white-text zeroMargin" ><span id="numQuestion<?php echo $fetch1['ID']?>"><?php echo $x?></span>. <span id="quiz<?php echo $fetch1['ID']?>"><?php echo $fetch1['question']?></span> </h5>
                                                            <br><p class="white-text center " ><span class="back green">Answer:</span> <span id="answer<?php echo $fetch1['ID']?>"><?php echo $fetch1['answer']?></span></p><br>
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
                var id=$(this).attr('id');
                var question=$('#quiz'+id).text();
                var answer=$('#answer'+id).text();
                var num=$('#numQuestion'+id).text();

                $('#number').text(num);
                $('.tfQuestion').val(question);
                $('.tfQuestion1').val(question);
                $('#tfid').val(id);
                $('#tftitle').val('<?php echo $_GET['title']?>');
                $('#tfnum').val('<?php echo $_GET['num']?>');
                $('#tfquizID').val('<?php echo $_GET['id']?>');
                if(answer=='True'){
                    $('.pickTrue').css({
                        'background':'black',
                        'color':'white',
                        'border':'3px solid white',
                        'border-radius':'30px'
                    });
                    $('.pickFalse').css({
                        'background': 'linear-gradient(to right, #ff3d00, #ffea00)',
                        'border': '3px solid black',
                        'color': 'black',
                        'border-radius':'30px'

                    });
                    
                    $('#tfAnswer').val(answer);
                }
                else if(answer=='False'){
                    $('.pickFalse').css({
                        'background':'black',
                        'color':'white',
                        'border':'3px solid white',
                        'border-radius':'30px'

                    });
                    $('.pickTrue').css({
                        'background': 'linear-gradient(to right, #ff3d00, #ffea00)',
                        'border': '3px solid black',
                        'color': 'black',
                        'border-radius':'30px'

                    });
                    
                    $('#tfAnswer').val(answer);
                }
            });

            $(document).on('click','.true',function(){
                var value=$('.tfQuestion').val();
                
                if(value==''){
                    alert('You must fill the input box');
                }
                else{
                    $('.pickTrue').css({
                        'background':'black',
                        'color':'white',
                        'border':'3px solid white',
                        'border-radius':'30px'

                    });
                    $('.pickFalse').css({
                        'background': 'linear-gradient(to right, #ff3d00, #ffea00)',
                        'border': '3px solid black',
                        'color': 'black',
                        'border-radius':'30px'

                    });
                    
                    $('#tfAnswer').val('True');
                    //alert(value);
                }
            });
            $(document).on('click','.false',function(){
                var value=$('.tfQuestion').val();
                
                if(value==''){
                    alert('You must fill the input box');
                }
                else{
                    $('.pickFalse').css({
                        'background':'black',
                        'color':'white',
                        'border':'3px solid white',
                        'border-radius':'30px'
                        
                    });
                    $('.pickTrue').css({
                        'background': 'linear-gradient(to right, #ff3d00, #ffea00)',
                        'border': '3px solid black',
                        'color': 'black',
                        'border-radius':'30px'

                    });
                    
                    $('#tfAnswer').val('False');
                    //alert(value);
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


        });
    </script>
</body>
</html>