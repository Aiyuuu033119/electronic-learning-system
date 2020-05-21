<?php
    include('connection.php');
    require_once('process.php');
    session_start();
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['student']);
        header('location:login.php');
    }
    if(!isset($_SESSION['student'])){
        header('location:login.php');
        
    }
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        $myphp=new myphp();
        $myphp->addCodeClass();
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
    
    <div id="add" class="modal addLesson grey darken-4">
        <div class="section">
            <p class="center white-text fontStyle"><b>Add<span class=" black-text">class</b></span></p>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" id="myform">
            <div class="modal-content">
                <div class="section">
                    <div class="row panel"><br>
                        <div class="col l12">
                            <div class="col l12">
                                <p class="white-text center back">Class Code</p>
                            </div>
                            <div class="input-field border-radius">
                                <input type="text" class="center inputAdjust border-radius border-color white-text" name="code" id="code">
                            </div>
                            <br><br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer transparent">
                <input type="submit" class="white-text btn-flat " value="ADD" name="addCode" id="addCode">
                <a href="classTeacher.php" class=" modal-action waves-effect waves-red btn-flat white-text red">Cancel</a>
            </div>
        </form>
    </div>
    <br>
    <div class="container bgCard grey darken-3">
        <div class="row">
            <div class="col l12"><br>
                <div class="col l12">
                    <h3 class="white-text center">My Class</h3>
                </div>
                <div class="col l12 ">
                    <a href="#add" class="modal-trigger right waves-effect waves-light btn-large light-blue darken-3 btnModifySizeAdd"><i class="fas fa-plus iconStyle"></i> Class</a>
                </div>
                <div class="col l12"><br></div>
                <?php
                    $student=$_SESSION['student'];
                    $retrive=mysqli_query($conn,"SELECT tbl_class.subjects,tbl_class.g_s,tbl_class.code FROM tbl_class INNER JOIN tbl_code ON tbl_code.codeID=tbl_class.classID INNER JOIN tbl_account ON tbl_account.accID=tbl_code.studentID WHERE tbl_account.user='$student'");
                    while($fetch=mysqli_fetch_array($retrive)):
                        
                ?>
                <div class="col l4 subject" id="class<?php echo $i?>">
                    <div class="card bgCard">
                        <div class="card-content">
                            <p class="truncate card-title classSub" id="<?php echo $fetch['code']?>"><b><?php echo $fetch['subjects'];?></b> </p>
                            <p><?php echo $fetch['g_s'];?></>
                            <p><?php 
                                    $code=$fetch['code'];
                                    $retrive2=mysqli_query($conn,"SELECT COUNT(tbl_code.codeID) as code FROM tbl_code INNER JOIN tbl_class on tbl_code.codeID=tbl_class.classID  WHERE tbl_class.code='$code'");
                                    $fetch2=mysqli_fetch_array($retrive2);
                                    echo $fetch2['code']; 
                                ?> members</p>
                        </div>
                    </div><br>
                </div>
                <?php
                    endwhile;
                ?>
            </div>
        </div>
    </div>



    <script src="jquery/jquery-3.4.1.min.js"></script>
    <script src="materialize2.0/js/materialize.js"></script>
    <script src="main.js"></script>
    <script>
        $(document).ready(function() {

            $('#addCode').click(function() {
                var data = $('#myform :input').serializeArray();

                $.ajax({
                    type:'post',
                    url:$('#myform').attr("action"),
                    data:data,
                    success:function(info){
                        if(info==='success'){
                            alert('Successfully Added!');
                            window.location.replace('classTeacher.php');
                        }
                        else if(info==='error'){
                            alert('You are already enrolled!');
                            window.location.replace('classTeacher.php');
                        }
                        else if(info==='close'){
                            alert('The class is not open!');
                            window.location.replace('classTeacher.php');
                        }
                        else if(info==='nothing'){
                            alert('This class is not existed!');
                            window.location.replace('classTeacher.php');
                        }
                    }
                });
            });

            $('#myform').submit(function() {
                return false;
            });

            function clearInput(){
                $('#myform :input').each(function(){
                    $(this).val('');

                });
            }

            $(document).on('click','.classSub',function(){
                var classes=$(this).attr('id');
                
                window.location.replace('subjectStudent.php?code='+classes);
                
            });
            
        });
    </script>
</body>
</html>