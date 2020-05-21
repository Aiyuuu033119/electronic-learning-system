<?php
    session_start();
    require_once('process.php');
    include('connection.php');
    if(!isset($_SESSION['teacher'])){
        header('location:login.php');
        
    }
    if ($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['update'])) {
        $myphp=new myphp();
        $myphp->updateLesson();
        exit();
    }
    if ($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['delete1'])) {
        $myphp=new myphp();
        $myphp->deleteTopic();
        exit();
    }
    if ($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['updateTitle'])) {
        $myphp=new myphp();
        $myphp->updateLessonTitle();
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

    <!-- EDIT TITLE TOPIC -->
    <div id="editLesson" class="modal popup grey darken-4"><br>
        <p class="center white-text fontStyle"><b>Learn<span class="black-text">more</b></span></p><br>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" id="form">
            <div class="modal-content noPadding">
                    <div class="row">
                        <div class="col l12" id="displayType1">
                            <div class="input-field border-radius">
                                <input placeholder="Topic" type="text" class="center inputAdjust border-radius border-color white-text" name="titleLesson3" id="titleLesson3">
                            </div>
                            <div class="input-field white hide">
                                <input placeholder="Topic" type="text" class="center inputAdjust" name="titleLesson4" id="titleLesson4">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer transparent">
                <input id="submit" type="submit" class="white-text btn-flat " value="UPDATE" name="updateTitle">
                <a class="modal-close modal-action waves-effect waves-red btn-flat white-text red">Cancel</a>
            </div>
        </form>
    </div>

    <!-- EDIT SUB-TOPIC -->
    <div id="edit" class="modal popup grey darken-4"><br>
        <p class="center white-text fontStyle"><b>Learn<span class=" black-text">more</b></span></p><br>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" >
            <div class="modal-content noPadding">
                <div class="row">
                    <div class="col l12" id="displayType1">
                        <div class="input-field border-radius ">
                            <input placeholder="Sub-Topic" type="text" class="center inputAdjust border-radius border-color white-text" name="titleTopic" id="titleTopic">
                        </div>
                        <div class="input-field hide">
                            <input placeholder="Sub-Topic" type="text" class="center inputAdjust " name="titleLesson" id="titleLesson">
                        </div>
                        <div class="input-field white hide">
                            <input placeholder="Sub-Topic" type="text" class="center inputAdjust" name="lessonID" id="lessonID">
                        </div>
                        <div class="input-field white hide">
                            <textarea name="content" placeholder="Discussion... Minimum 2500 letters" class="materialize-textarea inputAdjust" id="content"></textarea>
                        </div>
                        <div class="input-field border-radius">
                            <textarea id="1" name="" placeholder="Content" class="materialize-textarea inputAdjust msg white-text border-radius center border-color"></textarea>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
            <div class="modal-footer transparent">
                <input id="submit" type="submit" class="white-text btn-flat " value="UPDATE" name="update">
                <a class="modal-close modal-action waves-effect waves-red btn-flat white-text red">Cancel</a>
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
                <h5 class="white-text center">Are you sure? You want to delete this sub-topic?</h5>
                <div class="input-field white hide">
                    <input placeholder="Sub-Topic " type="text" class="center inputAdjust" name="lessonID2" id="lessonID2">
                </div>
                <div class="input-field white hide">
                    <input placeholder="Sub-Topic " type="text" class="center inputAdjust" name="titleLesson2" id="titleLesson2">
                </div>
                
            </div>
            <div class="modal-footer transparent">
                <input type="submit" class="white-text btn-flat lineBlue" value="DELETE" name="delete1">
                <a class=" modal-action modal-close waves-effect waves-red btn-flat white-text red">Cancel</a>
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
                    <a href="subjectTeacher.php?code=<?php echo $_SESSION['code']?>" class="modal-trigger modal-close waves-effect waves-light btn-large blue darken-3 btnModifySizeAdd">Okay</a>
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
                                <p class="center white-text fontStyle"><b>Learn<span class=" black-text">more</b></span></p><br>
                            </div>
                            <div class="col l12">
                                <span class="right"><a href="#editLesson" class="modal-trigger editTopic back light blue white-text"><i class="fas fa-edit"></i></a></span>

                                <div class="col l12 ">
                                    <h4 class="white-text center zeroMargin" id="title"><?php echo $_GET['subject']?></h4>
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
                                                $subject=$_GET['subject'];
                                                $retrive1=mysqli_query($conn,"SELECT * FROM tbl_lesson WHERE tbl_lesson.classID='$classID' AND tbl_lesson.lessonTitle='$subject' ");
                                                while($fetch1=mysqli_fetch_array($retrive1)):
                                            
                                        ?>
                                        <!--DISPLAY SUB-TOPIC -->
                                        <div class="col l12" id="topic">
                                            <div class="row panel" id="num1"><br>
                                                <div class="col l12">
                                                    <span class="right callModal"><a href="#delete" class="modal-trigger modal-action delete back red white-text" id="<?php echo $fetch1['lessonID']?>"><i class="fas fa-trash iconStyle"></i></a></span>
                                                    <span class="right callModal"><a href="#edit" class="modal-trigger modal-action edit back light blue white-text" id="<?php echo $fetch1['lessonID']?>"><i class="fas fa-edit iconStyle"></i></a></span>
                                                </div>
                                                <div class="col l12">
                                                    <div class="row">
                                                        <div class="col l12" id="displayType1">
                                                            <h5 class="white-text zeroMargin" id="topic<?php echo $fetch1['lessonID']?>"><span class="back orange"> </span><?php echo $fetch1['topic']?> </h5>
                                                            <p class="white-text txtFormat" id="content<?php echo $fetch1['lessonID']?>"><?php echo $fetch1['content']?></p><br>
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
                                <a href="#save" class="modal-trigger modal-action waves-effect waves-red white-text btn light blue"><i class="fas fa-check iconStyle"></i> Finish</a>
                            </div>
                            <div class="col l12"><br><br></div>
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
        $(document).ready(function() {
            
            $(document).on('keyup','.msg',function(){
                var id=$(this).attr('id');
                var txt2=$('.msg').val();
                txt2=txt2.replace(/\n/g,'[nl]');
                $('#content').val(txt2);
                return false;
            });

            //EDIT MODAL
            $(document).on('click','.edit',function(){
                var id=$(this).attr('id');
                var title=$('#title').text()
                var topic=$('#topic'+id).text()
                var content=$('#content'+id).text()

                $('#titleLesson').val(title);
                $('#lessonID').val(id);
                $('#titleTopic').val(topic);
                $('#content').val(content);
                $('.msg').val(content);
            });

            //DELETE MODAL 
            $(document).on('click','.delete',function(){
                var id=$(this).attr('id');
                var title=$('#title').text()
                var topic=$('#topic'+id).text()
                var content=$('#content'+id).text()

                $('#titleLesson2').val(title);
                $('#lessonID2').val(id);
                $('#titleTopic2').val(topic);
                $('#content2').val(content);
            });

            //EDIT TOPIC TITLE
            $(document).on('click','.editTopic',function(){
                var title=$('#title').text()

                $('#titleLesson3').val(title);
                $('#titleLesson4').val(title);
            });
        });
    </script>
</body>
</html>