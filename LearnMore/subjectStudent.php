<?php
    session_start();
    require_once('process.php');
    $page='topic';
    if(!isset($_SESSION['student'])){
        header('location:login.php');
        
    }
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        $myphp=new myphp();
        $myphp->addLesson();
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
    
    <div class="section">
        <div class="row ">
            <?php include('sidenav.php'); ?>
            <div class="col l7 push-l1"><br>
                <div class="card grey darken-4 bgCard1">
                    <div class="content">
                        <div class="row">
                            <div class="col l12">
                                <div class="col l12">
                                    <h3 class="white-text">My Topics</h3>
                                    <?php
                                        $code=$_SESSION['code'];
                                        $select=mysqli_query($conn,"SELECT tbl_lesson.lessonTitle FROM tbl_lesson INNER JOIN tbl_class ON tbl_lesson.classID=tbl_class.classID WHERE tbl_class.code='$code' GROUP BY tbl_lesson.lessonTitle");
                                        $count=mysqli_num_rows($select);
                                    ?>
                                    <p class="white-text">Number of Topics: <?php echo $count?></p>
                                </div>
                            </div>
                            <div class="col l12"><br><br>
                                <div class="collection noBorder">
                                <?php
                                    $x=0;
                                    $retrive=mysqli_query($conn,"SELECT tbl_lesson.lessonTitle FROM tbl_lesson INNER JOIN tbl_class ON tbl_lesson.classID=tbl_class.classID WHERE tbl_class.code='$code' GROUP BY tbl_lesson.lessonTitle");
                                    while($fetch=mysqli_fetch_array($retrive)):
                                    $x++;
                                ?>
                                    <a href="viewLessonStudent.php?topic=<?php echo $fetch['lessonTitle']?>" class="collection-item colHover"><?php echo '<span class="back light blue"><b> TOPIC '.$x.'</b></span>' ?><?php echo  '<span>'.$fetch['lessonTitle'].'</span>'?></a>
                                <?php
                                    endwhile;
                                ?>
                                </div>
                                <br><br>
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
        $(document).ready(function() {

            $('#submit').click(function() {
                var data = $('#myform :input').serializeArray();

                $.ajax({
                    type:'post',
                    url:$('#myform').attr("action"),
                    data:data,
                    success:function(info){
                        if(info==='success'){
                            window.location.replace('subjectTeacher.php?code=<?php echo $_SESSION['code']?>');

                        }
                        else if(info==='fail'){
                            alert('fail!');
                        }
                        else if(info==='error'){
                            alert('error!');
                        }
                    }
                });
            //clearInput();
            });

            $('#myform').submit(function() {
                return false;
            });

            function clearInput(){
                $('#myform :input').each(function(){
                    $(this).val('');

                });
            }

        });
    </script>
</body>
</html>