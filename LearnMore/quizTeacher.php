<?php
    session_start();
    require_once('process.php');
    $page='quiz';
    if(!isset($_SESSION['teacher'])){
        header('location:login.php');
    }
    if ($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['addChoice'])) {
        $myphp=new myphp();
        $myphp->addMQuiz();
        exit();
    }
    if ($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['addtf'])) {
        $myphp=new myphp();
        $myphp->addTFQuiz();
        exit();
    }
    if ($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['deleteQuizList'])) {
        $myphp=new myphp();
        $myphp->deleteQuizList();
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

    <?php include('navigation.php'); ?>
    
    <div id="multiple" class="modal popup2 grey darken-4">
        <div class="section">
            <p class="center white-text fontStyle"><b>Learn<span class=" black-text">more</b></span></p>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
            <div class="modal-content">
                <div class="input-field border-radius">
                    <input placeholder="Quiz Title"  type="text" class="center inputAdjust border-radius border-color white-text" name="quizTitle">
                </div>
                <div class="section">
                    <div class="row">
                        <div class="col l2">
                            <div class="row panel"><br>
                                <p class="white-text center">Question</p>
                                <a id="questBtn" class="waves-effect waves-red btn-flat white-text red col l10 push-l1 center">ADD</a>
                                <div class="col l12">
                                    <div class="collection noBorder" id="colItem">
                                        <a href="#num1"  class="collection-item colHover2 center">1</a>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <!--Add Quiz Question -->
                        <div class="col l10 " id="question">
                            <div class="row panel" id="num1"><br>
                                <div class="col l12">
                                    <div class="section row">
                                        <div class="col l12" id="displayType1">
                                            <div class="input-field border-radius">
                                                <input placeholder="Question 1" id="askQuestion" type="text" class="center inputAdjust border-radius border-color white-text" name="askQuestion[]">
                                            </div>
                                            <div class="input-field row">
                                                <div class="col l1 lettera pickA1" id="1">
                                                    <p class="center letter" >A</p>
                                                </div>
                                                <input style="position:absolute" placeholder="Choice 1" id="choiceA1" type="text" class="center col l11 inputAdjust border-radius2 border-color white-text" name="choiceA[]">
                                            </div>
                                            <div class="input-field row">
                                                <div class="col l1 letterb pickB1" id="1">
                                                    <p class="center letter" >B</p>
                                                </div>
                                                <input style="position:absolute" placeholder="Choice 2" id="choiceB1" type="text" class="center col l11 inputAdjust border-radius2 border-color white-text" name="choiceB[]">
                                            </div>
                                            <div class="input-field row">
                                                <div class="col l1 letterc pickC1" id="1">
                                                    <p class="center letter" >C</p>
                                                </div>
                                                <input style="position:absolute" placeholder="Choice 3" id="choiceC1" type="text" class="center col l11 inputAdjust border-radius2 border-color white-text" name="choiceC[]">
                                            </div>
                                            <div class="input-field row">
                                                <div class="col l1 letterd pickD1" id="1">
                                                    <p class="center letter" >D</p>
                                                </div>
                                                <input style="position:absolute" placeholder="Choice 4" id="choiceD1" type="text" class="center col l11 inputAdjust border-radius2 border-color white-text" name="choiceD[]">
                                            </div>
                                            <div class="divider"></div>
                                            <div class="input-field white hide">
                                                <input id="answer1" type="text" class="col l11 inputAdjust" name="answer[]">
                                            </div>
                                            <div class="col l12">
                                                <h6 class="white-text" >Answer: <span id="showAnswer1"> Please select the letter for the answer</span></h5>
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
                <input type="submit" class="white-text btn-flat " value="ADD" name="addChoice">
                <a href="quizTeacher.php?code=<?php echo $_SESSION['code']?>" class="modal-close modal-action waves-effect waves-red btn-flat white-text red">Cancel</a>
            </div>
        </form>
    </div>


    <div id="tf" class="modal popup2 grey darken-4">
        <div class="section">
            <p class="center white-text fontStyle"><b>Learn<span class=" black-text">more</b></span></p>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
            <div class="modal-content">
                <div class="input-field border-radius">
                    <input placeholder="Quiz Title"  type="text" class="center inputAdjust border-radius border-color white-text" name="quizTitle2">
                </div>
                <div class="section">
                    <div class="row">
                        <div class="col l2">
                            <div class="row panel"><br>
                                <p class="white-text center">Question</p>
                                <a id="questBtn2" class="waves-effect waves-red btn-flat white-text red col l10 push-l1 center">ADD</a>
                                <div class="col l12">
                                    <div class="collection noBorder" id="colItem2">
                                        <a href="#nums1"  class="collection-item colHover2 center">1</a>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        
                        <!--Add Quiz Question -->
                        <div class="col l10 " id="question2">
                            <div class="row panel" id="num1"><br>
                                <div class="col l12">
                                    <div class="section row">
                                        <div class="col l12" id="displayType1">
                                            <div class="input-field border-radius">
                                                <input placeholder="Question 1" id="1" type="text" class="center inputAdjust tfQuestion1 border-radius border-color white-text" name="tfQuestion[]">
                                            </div><br>
                                            <div class="col l12">
                                                <h6 class="white-text" >Take Note: <span id="showAnswer1"> Please select the for the right answer</span></h5><br>
                                            </div>
                                            <div class="col l12">
                                                <div class="col l3 push-l3 true pickTrue1" id="1">
                                                    <p class="center letter" >True</p>
                                                </div>
                                                <div class="col l3 push-l3 false pickFalse1" id="1">
                                                    <p class="center letter " >False</p>
                                                </div>
                                            </div>
                                            <div class="input-field white hide">
                                                <input id="tfanswer1" type="text" class="col l11 inputAdjust" name="tfAnswer[]">
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
                <input type="submit" class="white-text btn-flat " value="ADD" name="addtf">
                <a href="quizTeacher.php?code=<?php echo $_SESSION['code']?>" class="modal-action modal-close waves-effect waves-red btn-flat white-text red">Cancel</a>
            </div>
        </form>
    </div>

    <div id="type" class="modal popup2 grey darken-4">
        <div class="section">
            <p class="center white-text fontStyle"><b>Learn<span class=" black-text">more</b></span></p>
        </div>
        <div class="modal-content noPadding">
            <div class="row">
                <!-- TRUE/FALSE -->
                <div class="col l5 push-l1">
                    <div class="card grey darken-4 bgCard">
                        <div class="card-content noPadding">
                            <div class="row">
                                <div class="col l12">
                                    <br><p class="center"><i class="fas fa-chalkboard-teacher iconType2"></i></p><br>
                                </div>
                                <div class="col l12">
                                    <h6 class="center white-text fontStyle2 "><b>Multiple<span class=" black-text">choice</b></span></h6>
                                </div>
                                <div class="col l12 center"><br>
                                    <a href="#multiple" class=" modal-trigger modal-close waves-effect waves-light btn light blue btnModifySizeAdd"><i class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TRUE/FALSE -->
                <div class="col l5 push-l1">
                    <div class="card grey darken-4 bgCard">
                        <div class="card-content noPadding">
                            <div class="row">
                                <div class="col l12">
                                    <br><p class="center"><i class="fas fa-users iconType2"></i></p><br>
                                </div>
                                <div class="col l12">
                                    <h6 class="center white-text fontStyle2 "><b>TRUE<span class=" black-text">/false</b></span></h6>
                                </div>
                                <div class="col l12 center"><br>
                                    <a href="#tf" class="modal-trigger modal-close waves-effect waves-light btn red btnModifySizeAdd"><i class="fas fa-arrow-right"></i></a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer transparent">
            <a class="modal-action modal-close waves-effect waves-red btn-flat white-text red">Cancel</a>
        </div>
    </div>

    <div id="delete" class="modal popup grey darken-4">
        <div class="section">
            <p class="center white-text fontStyle"><b>Learn<span class=" black-text">more</b></span></p>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
            <div class="modal-content" id="displayTextDelete">
                <p class="center"><i class="fas fa-trash iconType"></i></p>
                <h5 class="white-text center">Are you sure? You want to delete this Quiz?</h5>
                <div class="input-field white hide">
                    <input placeholder="Sub-Topic " type="text" class="center inputAdjust" name="quizIDS" id="quizIDS">
                </div>
            </div>
            <div class="modal-footer transparent">
                <input type="submit" class="white-text btn-flat" value="DELETE" name="deleteQuizList">
                <a class=" modal-action modal-close waves-effect waves-red btn-flat white-text red">Cancel</a>
            </div>
        </form>
    </div>

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
                                        $code=$_SESSION['code'];
                                        $select=mysqli_query($conn,"SELECT COUNT(tbl_quiz.quizID) as count FROM tbl_quiz INNER JOIN tbl_class ON tbl_quiz.classID=tbl_class.classID WHERE tbl_class.code='$code'");
                                        $count=mysqli_fetch_array($select);
                                    ?>
                                    <p class="white-text">Number of quiz: <?php echo $count['count']?></p>
                                </div>
                            </div>
                            <div class="col l12 ">
                                <a href="#type" class="modal-trigger right waves-effect waves-light btn-large light-blue darken-3 btnModifySizeAdd"><i class="fas fa-plus iconStyle"></i> Quiz</a>
                            </div>
                            <div class="col l12"><br><br>
                                <table class=" highlight centered " id="table">
                                    <thead class="red white-text" style="border:unset">
                                        <tr>
                                            <th style="width:10%">Number</th>
                                            <th style="width:35%">Quiz Title</th>
                                            <th style="width:15%">Type</th>
                                            <th style="width:40">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody id="table" class="resize" style="border-radius: 0 0 25px 25px;border-bottom: 4px solid #f44336 ;border-left: 4px solid #f44336 ;border-right: 4px solid #f44336 ;">
                                        <?php
                                            $x=0;
                                            $retrive=mysqli_query($conn,"SELECT tbl_quiz.quizID,tbl_quiz.quizTitle,tbl_quiz.typeQuiz FROM tbl_quiz INNER JOIN tbl_class ON tbl_quiz.classID=tbl_class.classID WHERE tbl_class.code='$code'");
                                            while($fetch=mysqli_fetch_array($retrive)):
                                                $x++;
                                        ?>
                                        <tr class="textColor" >
                                            <td class="white-text no-paddingTbl" style="width:10%">Quiz <?php echo $x?></td>
                                            <td class="white-text no-paddingTbl" style="width:35%" id="<?php echo $x?>"><?php echo $fetch['quizTitle']?></td>
                                            <td class="white-text no-paddingTbl" style="width:15%"><?php 
                                            if($fetch['typeQuiz']=='Multiple Choice'){
                                                echo '<span class="back4">'.$fetch['typeQuiz'].'</span>';
                                            }
                                            else if($fetch['typeQuiz']=='True/False'){
                                                echo '<span class="back5 ">'.$fetch['typeQuiz'].'</span>';
                                            }
                                            ?></td>
                                            <td class="white-text no-paddingTbl" style="width:40%"> <a class="modal-trigger btn light blue updateBtn2" id="<?php echo $fetch['quizID']?>"><i class="fas fa-edit iconStyle"></i> edit</a><span> </span><a href="#delete" class="modal-trigger btn red deleteBtn2" id="<?php echo $fetch['quizID']?>"><i class="fas fa-trash iconStyle"></i> Delete</a></td>
                                        </tr>
                                        <?php
                                            endwhile;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col l12">
                                <br><br>
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

            $(document).on('click','.updateBtn2',function(){
                var row=$(this).closest('tr');
                var id=$(this).attr('id');
                var num=parseInt(row.find('td:eq(0)').text());
                var title=row.find('td:eq(1)').text();
                var titleID=row.find('td:eq(1)').attr('id');
                var type=row.find('td:eq(2)').text();
                
                if(type=="Multiple Choice"){
                    window.top.location='editMQuiz.php?title='+title+'&num='+titleID+'&id='+id;
                }
                else if(type=="True/False"){
                    window.top.location='editTFQuiz.php?title='+title+'&num='+titleID+'&id='+id;
                }
            });

            $(document).on('click','.deleteBtn2',function(){
                var row=$(this).closest('tr');
                var id=$(this).attr('id');
                
                $('#quizIDS').val(id);
            });

            $(document).on('click','.lettera',function(){
                var id=$(this).attr('id');
                var value=$('#choiceA'+id).val();
                
                if(value==''){
                    alert('You must fill the input box');
                }
                else{
                    $('.pickA'+id).css({
                    'background':'black',
                    'color':'white',
                    'border':'2px solid white'
                    });
                    $('#choiceA'+id).css({
                        'background':'black',
                        'color':'white',
                        'border':'2px solid white'
                    });
                    $('.pickB'+id).css({
                        'background': 'linear-gradient(to right, #ff3d00, #ffea00)',
                        'border': '2px solid black',
                        'color': 'black'
                    });
                    $('#choiceB'+id).css({
                        'background':'transparent',
                        'color':'white',
                        'border':'2px solid #424242'
                    });
                    $('.pickC'+id).css({
                        'background': 'linear-gradient(to right, #ff3d00, #ffea00)',
                        'border': '2px solid black',
                        'color': 'black'
                    });
                    $('#choiceC'+id).css({
                        'background':'transparent',
                        'color':'white',
                        'border':'2px solid #424242'
                    });
                    $('.pickD'+id).css({
                        'background': 'linear-gradient(to right, #ff3d00, #ffea00)',
                        'border': '2px solid black',
                        'color': 'black'
                    });
                    $('#choiceB'+id).css({
                        'background':'transparent',
                        'color':'white',
                        'border':'2px solid #424242'
                    });
                    $('#answer'+id).val(value);
                    $('#showAnswer'+id).text('A');
                    //alert(value);
                }
            });
            $(document).on('click','.letterb',function(){
                var id=$(this).attr('id');
                var value=$('#choiceB'+id).val();
                if(value==''){
                    alert('You must fill the input box');
                }
                else{
                    $('.pickB'+id).css({
                        'background':'black',
                        'color':'white',
                        'border':'2px solid white'
                    });
                    $('#choiceB'+id).css({
                        'background':'black',
                        'color':'white',
                        'border':'2px solid white'
                    });
                    $('.pickA'+id).css({
                        'background': 'linear-gradient(to right, #ff3d00, #ffea00)',
                        'border': '2px solid black',
                        'color': 'black'
                    });
                    $('#choiceA'+id).css({
                        'background':'transparent',
                        'color':'white',
                        'border':'2px solid #424242'
                    });
                    $('.pickC'+id).css({
                        'background': 'linear-gradient(to right, #ff3d00, #ffea00)',
                        'border': '2px solid black',
                        'color': 'black'
                    });
                    $('#choiceC'+id).css({
                        'background':'transparent',
                        'color':'white',
                        'border':'2px solid #424242'
                    });
                    $('.pickD'+id).css({
                        'background': 'linear-gradient(to right, #ff3d00, #ffea00)',
                        'border': '2px solid black',
                        'color': 'black'
                    });
                    $('#choiceD'+id).css({
                        'background':'transparent',
                        'color':'white',
                        'border':'2px solid #424242'
                    });
                    $('#answer'+id).val(value);
                    $('#showAnswer'+id).text('B');
                    //alert(value);
                }
            });
            $(document).on('click','.letterc',function(){
                var id=$(this).attr('id');
                var value=$('#choiceC'+id).val();
                if(value==''){
                    alert('You must fill the input box');
                }
                else{
                    $('.pickC'+id).css({
                        'background':'black',
                        'color':'white',
                        'border':'2px solid white'
                    });
                    $('#choiceC'+id).css({
                        'background':'black',
                        'color':'white',
                        'border':'2px solid white'
                    });
                    $('.pickB'+id).css({
                        'background': 'linear-gradient(to right, #ff3d00, #ffea00)',
                        'border': '2px solid black',
                        'color': 'black'
                    });
                    $('#choiceB'+id).css({
                        'background':'transparent',
                        'color':'white',
                        'border':'2px solid #424242'
                    });
                    $('.pickA'+id).css({
                        'background': 'linear-gradient(to right, #ff3d00, #ffea00)',
                        'border': '2px solid black',
                        'color': 'black'
                    });
                    $('#choiceA'+id).css({
                        'background':'transparent',
                        'color':'white',
                        'border':'2px solid #424242'
                    });
                    $('.pickD'+id).css({
                        'background': 'linear-gradient(to right, #ff3d00, #ffea00)',
                        'border': '2px solid black',
                        'color': 'black'
                    });
                    $('#choiceD'+id).css({
                        'background':'transparent',
                        'color':'white',
                        'border':'2px solid #424242'
                    });
                    $('#answer'+id).val(value);
                    $('#showAnswer'+id).text('C');        
                    //alert(value);
                }
            });
            $(document).on('click','.letterd',function(){
                var id=$(this).attr('id');
                var value=$('#choiceD'+id).val();
                if(value==''){
                    alert('You must fill the input box');
                }
                else{
                    $('.pickD'+id).css({
                        'background':'black',
                        'color':'white',
                        'border':'2px solid white'
                    });
                    $('#choiceD'+id).css({
                        'background':'black',
                        'color':'white',
                        'border':'2px solid white'
                    });
                    $('.pickB'+id).css({
                        'background': 'linear-gradient(to right, #ff3d00, #ffea00)',
                        'border': '2px solid black',
                        'color': 'black'
                    });
                    $('#choiceB'+id).css({
                        'background':'transparent',
                        'color':'white',
                        'border':'2px solid #424242'
                    });
                    $('.pickC'+id).css({
                        'background': 'linear-gradient(to right, #ff3d00, #ffea00)',
                        'border': '2px solid black',
                        'color': 'black'
                    });
                    $('#choiceC'+id).css({
                        'background':'transparent',
                        'color':'white',
                        'border':'2px solid #424242'
                    });
                    $('.pickA'+id).css({
                        'background': 'linear-gradient(to right, #ff3d00, #ffea00)',
                        'border': '2px solid black',
                        'color': 'black'
                    });
                    $('#choiceA'+id).css({
                        'background':'transparent',
                        'color':'white',
                        'border':'2px solid #424242'
                    });
                    $('#answer'+id).val(value);
                    $('#showAnswer'+id).text('D');
                    //alert(value);
                }
            });

            $(document).on('click','.true',function(){
                var id=$(this).attr('id');
                var value=$('.tfQuestion'+id).val();
                
                if(value==''){
                    alert('You must fill the input box');
                }
                else{
                    $('.pickTrue'+id).css({
                    'background':'black',
                    'color':'white',
                    'border':'3px solid white'
                    });
                    $('.pickFalse'+id).css({
                        'background': 'linear-gradient(to right, #ff3d00, #ffea00)',
                        'border': '3px solid black',
                        'color': 'black'
                    });
                    
                    $('#tfanswer'+id).val('True');
                    //alert(value);
                }
            });
            $(document).on('click','.false',function(){
                var id=$(this).attr('id');
                var value=$('.tfQuestion'+id).val();
                
                if(value==''){
                    alert('You must fill the input box');
                }
                else{
                    $('.pickFalse'+id).css({
                    'background':'black',
                    'color':'white',
                    'border':'3px solid white'
                    });
                    $('.pickTrue'+id).css({
                        'background': 'linear-gradient(to right, #ff3d00, #ffea00)',
                        'border': '3px solid black',
                        'color': 'black'
                    });
                    
                    $('#tfanswer'+id).val('False');
                    //alert(value);
                }
            });


        });
    </script>
</body>
</html>