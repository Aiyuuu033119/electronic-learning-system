<?php
    session_start();
    require_once('process.php');
    include('connection.php');
    if(!isset($_SESSION['student'])){
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

<body class="bgbody">
<script src="jquery/jquery-3.4.1.min.js"></script>

    
    <div class="section">
        <div class="row ">
            
            <div class="col l8 push-l2"><br>
                <div class="card grey darken-4 bgCard1">
                    <div class="content">
                        <div class="row">
                            <br>
                            <div class="col l12">
                                <p class="center white-text fontStyle"><b>Learn<span class=" amber darken-3 black-text">more</b></span></p>
                            </div>
                            <div class="col l12"><br>
                                <h4 class="white-text center"><?php echo $_GET['topic']?></h4><br>
                            </div>
                            <?php
                                $code=$_SESSION['code'];
                                $retrive=mysqli_query($conn,"SELECT * FROM tbl_class WHERE code='$code' ");
                                $row=mysqli_num_rows($retrive);
                                if($row==1){
                                    $fetch=mysqli_fetch_array($retrive);
                                    $classID=$fetch['classID'];
                                    $subject=$_GET['topic'];
                                    $retrive1=mysqli_query($conn,"SELECT * FROM tbl_lesson WHERE tbl_lesson.classID='$classID' AND tbl_lesson.lessonTitle='$subject' ");
                                    while($fetch1=mysqli_fetch_array($retrive1)):
                            ?>

                            <div class="col l12" id="topic">   
                                <div class="row panel" id="num1"><br>
                                    <div class="col l12">
                                        <div class="row">
                                            <div class="col l12" id="displayType1">
                                                <p class="white-text zeroMargin" style="font-size:24px" ><span class="back orange"> </span><b><?php echo $fetch1['topic']?> </b></h5>
                                            </div>
                                            <div class="col l12"><br>
                                                <p class="white-text" ><?php echo $fetch1['content']?></p><br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                                endwhile;}
                            ?>
                            <div class="col l12"><br><br></div>
                            <div class="col l12 center">
                            <a href="subjectStudent.php?code=<?php echo $_SESSION['code']?>" class=" waves-effect waves-red btn-flat white-text blue"><i class="fas fa-check iconStyle"></i> Finish</a>
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
            
        });
    </script>
</body>
</html>