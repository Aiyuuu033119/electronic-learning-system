<?php
    session_start();
    $page='attend';
    if(!isset($_SESSION['student'])){
        header('location:login.php');
        
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
                <div class="card grey darken-4 bgCard1">
                    <div class="content">
                        <div class="row">
                            <div class="col l12">
                                <div class="col l12">
                                    <h3 class="white-text">Students Attendance</h3>
                                </div>
                            </div>
                            <div class="col l10 push-l1"><br><br>
                                <table class=" highlight centered " id="table">
                                    <thead class="green white-text" style="border:unset">
                                        <tr>
                                            <th class="center">Dates</th>
                                            <th class="center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table" class="resize" style="border-radius: 0 0 25px 25px;border-bottom: 4px solid #4caf50;border-left: 4px solid #4caf50;border-right: 4px solid #4caf50;">
                                        <?php
                                            $code=$_SESSION['code'];
                                            $user=$_SESSION['student'];

                                            $retrive=mysqli_query($conn,"SELECT * FROM tbl_attendance INNER JOIN tbl_class ON tbl_class.classID=tbl_attendance.classID WHERE tbl_class.code='$code' GROUP BY dates");
                                            while($fetch=mysqli_fetch_array($retrive)):

                                        ?>
                                        <tr class="textColor" >
                                            <?php
                                                
                                                $retrive2=mysqli_query($conn,"SELECT tbl_attendance.dates,tbl_attendance.stdStatus,tbl_attendance.studentID FROM tbl_class INNER JOIN tbl_attendance INNER JOIN tbl_account ON tbl_account.accID=tbl_attendance.studentID WHERE tbl_class.code='$code' AND tbl_account.user='$user' AND tbl_attendance.dates='".$fetch['dates']."' GROUP BY tbl_attendance.dates ");
                                                $row2=mysqli_num_rows($retrive2);
                                                if($row2==1){
                                                    $fetch2=mysqli_fetch_array($retrive2);
                                            ?>
                                                    <td class="white-text"><?php echo $fetch['dates'] ?></td>
                                                    <td class="white-text"><?php 
                                                        if($fetch2['stdStatus']=="Present"){
                                                            echo '<span class="back light-blue accent-4"><b>'.$fetch2['stdStatus'].'</b></span>';
                                                        }
                                                        else if($fetch2['stdStatus']=="Absent"){
                                                            echo '<span class="back red"><b>'.$fetch2['stdStatus'].'</b></span>';
                                                        }                                                        
                                                    ?></td>
                                            <?php
                                                }
                                                else{
                                            ?>
                                                    <td class="white-text"><?php echo $fetch['dates'] ?></td>
                                                    <td class="white-text"><span class="back red"><b>Absent</b></span></td>
                                            <?php
                                                }

                                            ?>
                                            
                                            
                                        </tr>
                                        <?php
                                            endwhile;
                                        ?>
                                    </tbody>
                                </table>
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
</body>
</html>