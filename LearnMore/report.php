<?php
    session_start();
    require_once('process.php');
    include('connection.php');
    $page='report';
    if(!isset($_SESSION['teacher'])){
        header('location:login.php');
        
    }
    if ($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['excelQuiz'])) {
        $myphp=new myphp();
        $myphp->excelQuiz();
        exit();
    }
    if ($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['excelAttendance'])) {
        $myphp=new myphp();
        $myphp->excelAttendance();
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

            <div class="col l7 push-l1 "><br>
                <div class="card transparent">
                    <div class="content">
                        <div class="row panel grey darken-4">
                            <div class="col l12">
                                <div class="col l12">
                                    <h3 class="white-text">Quiz Record</h3>
                                </div>
                            </div>
                            <div class="col l12 ">
                                <div class="row ">
                                    <div class="col l2 right">
                                        <a id="quizPDF" class="waves-effect waves-light btn white-text btn-flat red darken-2 btnModifySizeAdd"><i class="fas fa-print iconStyle"></i> PDF</a>
                                    </div>
                                    <div class="col l2 right">
                                        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                                            <button type="submit" class="right waves-effect waves-light btn white-text btn-flat green accent-4 btnModifySizeAdd" name="excelQuiz"><i class="fas fa-print iconStyle"></i> EXCEL</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col l12"><br>
                                <table class=" highlight centered " id="table">
                                    <thead class="red white-text" style="border:unset">
                                        <tr>
                                            <th style="width:25%">Name</th>
                                            <?php
                                                $code=$_SESSION['code'];
                                                $date=date('d/m/Y');
                                                $x=0;
                                                $retrive=mysqli_query($conn,"SELECT * FROM tbl_quiz INNER JOIN tbl_class ON tbl_class.classID=tbl_quiz.classID WHERE tbl_class.code='$code' ");
                                                while($fetch=mysqli_fetch_array($retrive)):
                                                    $x++;
                                                ?>
                                            <th style="width:10%">
                                                <?php
                                                    echo 'Quiz'.$x;
                                                ?>
                                            </th>
                                            <?php
                                                endwhile;
                                            ?>
                                            <th style="width:10%">Total</th>
                                        </tr>
                                    </thead>

                                    <tbody id="table" class="resize" style="border-radius: 0 0 25px 25px;border-bottom: 4px solid #f44336 ;border-left: 4px solid #f44336 ;border-right: 4px solid #f44336 ;">
                                        <?php
                                            $retrive=mysqli_query($conn,"SELECT tbl_user_info.accID,tbl_user_info.fn,tbl_user_info.ln FROM tbl_class INNER JOIN tbl_code on tbl_code.codeID=tbl_class.classID INNER JOIN tbl_user_info ON tbl_user_info.accID=tbl_code.studentID WHERE tbl_class.code='$code' ORDER BY tbl_user_info.ln");
                                            while($fetch=mysqli_fetch_array($retrive)):
                                        ?>
                                        <tr class="textColor">
                                            <td style="width:25%" class="white-text no-paddingTbl2"><?php echo $fetch['ln'].','.$fetch['fn']?></td>
                                            <?php
                                            $retrive2=mysqli_query($conn,"SELECT * FROM tbl_quiz INNER JOIN tbl_class ON tbl_class.classID=tbl_quiz.classID WHERE tbl_class.code='$code' ");
                                            $sum=0;
                                            $row2=mysqli_num_rows($retrive2);
                                            while($fetch2=mysqli_fetch_array($retrive2)):
                                                
                                                $retrive3=mysqli_query($conn,"SELECT tbl_score.average FROM tbl_user_info INNER JOIN tbl_score ON tbl_user_info.accID=tbl_score.studentID INNER JOIN tbl_quiz ON tbl_score.quizID=tbl_quiz.quizID INNER JOIN tbl_class ON tbl_class.classID=tbl_quiz.classID WHERE tbl_class.code='$code' AND tbl_user_info.accID='".$fetch['accID']."' AND tbl_quiz.quizID='".$fetch2['quizID']."' ");
                                                $row3=mysqli_num_rows($retrive3);
                                                if($row3==1){
                                                    $fetch3=mysqli_fetch_array($retrive3);
                                                
                                            ?>
                                                    <td style="width:10%" class="white-text no-paddingTbl2"><?php 
                                                        if($fetch3['average']<50){
                                                            $sum=$sum+$fetch3['average'];
                                                            echo '<span class="back red-text">'.$fetch3['average'].'</span>';
                                                        }
                                                        else if($fetch3['average']>=50&&$fetch3['average']<=99){
                                                            $sum=$sum+$fetch3['average'];
                                                            echo '<span class="back green-text">'.$fetch3['average'].'</span>';
                                                        }
                                                        else if($fetch3['average']==100){
                                                            $sum=$sum+$fetch3['average'];
                                                            echo '<span class="back blue-text">'.$fetch3['average'].'</span>';
                                                        }
                                                    ?></td>
                                            <?php 
                                                } 
                                                else if($row3!=1){
                                                    $sum=$sum+0;
                                            ?>
                                            
                                                    <td style="width:10%" class="white-text no-paddingTbl2"><span class="back red-text">0</span></td>
                                            <?php
                                                }    
                                            endwhile;
                                                echo '<td style="width:10%" class="white-text no-paddingTbl2"><span class="back green">'.intval($sum/$row2).'%</span></td>';
                                            ?>
                                        </tr>
                                        <?php
                                            endwhile;
                                        ?>

                                    </tbody>
                                </table><br>
                            </div>
                            <div class="col l12">
                                <br><br>
                            </div>
                        </div>
                        <div class="row panel panel grey darken-4">
                            <div class="col l12">
                                <div class="col l12">
                                    <h3 class="white-text">Attendance Record</h3>
                                </div>
                                <div class="col l12 ">
                                    <div class="row ">
                                        <div class="col l2 right">
                                            <a id="attendancePDF" class="waves-effect waves-light btn white-text btn-flat red darken-2 btnModifySizeAdd"><i class="fas fa-print iconStyle"></i> PDF</a>
                                        </div>
                                        <div class="col l2 right">
                                            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                                                <button type="submit" class="right waves-effect waves-light btn white-text btn-flat green accent-4 btnModifySizeAdd" name="excelAttendance"><i class="fas fa-print iconStyle"></i> EXCEL</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col l12"><br>
                                <table class=" highlight centered " id="table">
                                    <thead class="green white-text" style="border:unset">
                                        <tr>
                                            <th style="width:25%">Name</th>
                                            <?php
                                                $code=$_SESSION['code'];
                                                $date=date('d/m/Y');
                                                $retrive=mysqli_query($conn,"SELECT * FROM tbl_attendance INNER JOIN tbl_class ON tbl_class.classID=tbl_attendance.classID WHERE tbl_class.code='$code' GROUP BY dates");
                                                while($fetch=mysqli_fetch_array($retrive)):
                                                ?>
                                            <th style="width:10%">
                                                <?php
                                                    echo $fetch['dates'];
                                                ?>
                                            </th>
                                            <?php
                                                endwhile;
                                            ?>
                                            <th style="width:5%">Absent</th>
                                            <th style="width:5%">Present</th>
                                        </tr>
                                    </thead>

                                    <tbody id="table" class="resize" style="border-radius: 0 0 25px 25px;border-bottom: 4px solid #4caf50 ;border-left: 4px solid #4caf50  ;border-right: 4px solid #4caf50  ;">
                                        <?php
                                            $retrive=mysqli_query($conn,"SELECT tbl_user_info.accID,tbl_user_info.fn,tbl_user_info.ln FROM tbl_class INNER JOIN tbl_code on tbl_code.codeID=tbl_class.classID INNER JOIN tbl_user_info ON tbl_user_info.accID=tbl_code.studentID WHERE tbl_class.code='$code' ORDER BY tbl_user_info.ln");
                                            while($fetch=mysqli_fetch_array($retrive)):
                                        ?>
                                        <tr class="textColor">
                                            <td style="width:25%" class="white-text no-paddingTbl"><?php echo $fetch['ln'].','.$fetch['fn']?></td>
                                            <?php
                                            $x=0;
                                            $y=0;
                                            $retrive2=mysqli_query($conn,"SELECT * FROM tbl_attendance INNER JOIN tbl_class ON tbl_class.classID=tbl_attendance.classID WHERE tbl_class.code='$code' GROUP BY dates");
                                            while($fetch2=mysqli_fetch_array($retrive2)):
                                        
                                                $retrive3=mysqli_query($conn,"SELECT tbl_attendance.dates,tbl_attendance.stdStatus,tbl_attendance.studentID FROM tbl_class INNER JOIN tbl_attendance ON tbl_class.classID=tbl_attendance.classID INNER JOIN tbl_user_info ON tbl_user_info.accID=tbl_attendance.studentID WHERE tbl_class.code='$code' AND tbl_user_info.accID='".$fetch['accID']."' AND tbl_attendance.dates='".$fetch2['dates']."' GROUP BY tbl_attendance.dates ORDER BY tbl_user_info.ln DESC ");
                                                $row3=mysqli_num_rows($retrive3);
                                                if($row3==1){
                                                    $fetch3=mysqli_fetch_array($retrive3);
                                                
                                            ?>
                                            <td style="width:10%" class="white-text no-paddingTbl2"><?php 
                                                if($fetch3['stdStatus']=='Present'){
                                                    $x++;
                                                    echo '<span class="back blue">'.$fetch3['stdStatus'].'</span>';
                                                }
                                                else{
                                                    $y++;
                                                    echo '<span class="back red">'.$fetch3['stdStatus'].'</span>';
                                                }
                                            ?></td>
                                            <?php 
                                                } 
                                                else if($row3!=1){
                                                    $y++;
                                            ?>
                                                    
                                                    <td style="width:10%" class="white-text no-paddingTbl2"><span class="back red">Absent</span></td>
                                            <?php
                                                }    
                                            endwhile;
                                                echo '<td style="width:5%" class="white-text no-paddingTbl2"><span class="back red-text">'.$x.'</span></td>';
                                                echo '<td style="width:5%" class="white-text no-paddingTbl2"><span class="back blue-text">'.$y.'</span></td>';
                                            ?>
                                        </tr>
                                        <?php
                                            endwhile;
                                        ?>
                                    </tbody>
                                </table><br><br>
                            </div>
                            <div class="col l12">
                                <br>
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

            $(document).on('click','#quizPDF',function(){
                window.open("QuizPDF.php?code=<?php echo $_SESSION['code']?>");
            });

            $(document).on('click','#attendancePDF',function(){
                window.open("AttendancePDF.php?code=<?php echo $_SESSION['code']?>");
            });


            $(document).on('click','#recordAttendance',function(){
                //var d=new Date();
                <?php
                    $date=date('d/m/Y');
                    $retrive=mysqli_query($conn,"SELECT * FROM tbl_attendance WHERE dates='$date' GROUP BY dates");
                    $row=mysqli_num_rows($retrive);
                    if($row==1){
                ?>
                    alert("You've done for recording, tomorrow again");
                    $('.modal').modal('close');
                <?php
                    }
                    else{
                ?>
                    $('#dates').val('<?php echo $date ?>');
                <?php
                    }
                ?>
                
            });

            $('input[type="checkbox"].check').click(function(){
                var id=$(this).attr('id');
                if($(this).prop("checked")==true){
                    $('#label'+id).text('Present');
                    $('#stat'+id).val('Present');

                }
                else{
                    $('#label'+id).text('Absent');
                    $('#stat'+id).val('Absent');

                }
            });

            $('input[type="checkbox"].all').click(function(){
                var id=$(this).attr('id');
                if($(this).prop("checked")==true){
                    $('input[type="checkbox"].check').prop('checked',true);
                    $('.labels').text('Present');
                    $('.stats').val('Present');

                }
                else{
                    $('input[type="checkbox"].check').prop('checked',false);
                    $('.labels').text('Absent');
                    $('.stats').val('Absent');

                }
            });
        });
    
    </script>
</body>
</html>