<?php
    session_start();
    require_once('process.php');
    include('connection.php');
    $page='attend';
    if(!isset($_SESSION['teacher'])){
        header('location:login.php');
        
    }
    if ($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['record'])) {
        $myphp=new myphp();
        $myphp->record();
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
                <div class="card grey darken-4 bgCard1">
                    <div class="content">
                        <div class="row">
                            <div class="col l12">
                                <div class="col l12"><br>       
                                    <span class="white-text right back green">Date: <span><?php echo date('d/m/Y');?></span></span>
                                </div>
                                <div class="col l12">
                                    <?php       
                                        $code=$_SESSION['code'];
                                        $retrive=mysqli_query($conn,"SELECT COUNT(tbl_user_info.accID) AS counts FROM tbl_class INNER JOIN tbl_code on tbl_code.codeID=tbl_class.classID INNER JOIN tbl_user_info ON tbl_user_info.accID=tbl_code.studentID WHERE tbl_class.code='$code' ORDER BY tbl_user_info.ln");
                                        $fetch=mysqli_fetch_array($retrive)
                                    ?>
                                    <h3 class="white-text">Students Attendance</h3>
                                    <p class="white-text">Number of students: <?php echo $fetch['counts'];?></p>
                                </div>
                            </div>
                            <div class="col l10 push-l1">
                                <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                                    <div class="input-field white hide">
                                        <input placeholder="Date" type="text" class="center inputAdjust" name="dates" id="dates">
                                    </div><br><br>
                                    <table class=" highlight centered ">
                                        <thead class="green white-text" style="border:unset">
                                            <tr>
                                                <th class="center">Name</th>
                                                <th class="center">
                                                    <p class="center">
                                                        <input type="checkbox" class="all" id="all" value=""/>
                                                        <label for="all" id="" class="white-text">Check All</label>
                                                    </p>
                                                </th>
                                                <th class="center">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table" class="resize" style="border-radius: 0 0 25px 25px;border-bottom: 4px solid #4caf50 ;border-left: 4px solid #4caf50  ;border-right: 4px solid #4caf50  ;">
                                            <?php
                                                $x=0;
                                                $retrive=mysqli_query($conn,"SELECT tbl_user_info.accID,tbl_user_info.fn,tbl_user_info.ln FROM tbl_class INNER JOIN tbl_code on tbl_code.codeID=tbl_class.classID INNER JOIN tbl_user_info ON tbl_user_info.accID=tbl_code.studentID WHERE tbl_class.code='$code' ORDER BY tbl_user_info.ln");
                                                while($fetch=mysqli_fetch_array($retrive)):
                                                    $x++;
                                            ?>
                                            <tr class="textColor">
                                                <td class="center white-text no-paddingTbl"><b> <?php echo $fetch['fn'].' '.$fetch['ln']?> </b></td>
                                                <td class="center hide">
                                                    <div class="input-field white">
                                                        <input id="names" type="text" class="center inputAdjust black-text" name="names[]" value="<?php echo $fetch['accID']?>">
                                                    </div>
                                                </td>
                                                <td class="no-paddingTbl">
                                                    <p class="center">
                                                        <input type="checkbox" class="check" id="<?php echo $x?>" value="Absent"/>
                                                        <label for="<?php echo $x?>" class="white-text "></label>
                                                    </p>
                                                </td>
                                                <td class="no-paddingTbl"><span class="back white-text labels" id="label<?php echo $x?>">Absent</span></td>
                                                <td class="center hide">
                                                    <div class="input-field white">
                                                        <input id="stat<?php echo $x?>" type="text" class="center inputAdjust black-text stats" name="stat[]" value="Absent">
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                                endwhile;
                                            ?>
                                        </tbody>
                                    </table><br>
                                    <div class="col l12 center">
                                        <input type="submit" class="white-text btn-flat blue" value="Record" name="record" id="record">
                                    </div>
                                <br>
                                </form>
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

            <?php $date=date('d/m/Y'); ?>
            $('#dates').val('<?php echo $date ?>');

            <?php
                $date=date('d/m/Y');
                $retrive=mysqli_query($conn,"SELECT * FROM tbl_attendance WHERE dates='$date' GROUP BY dates");
                $row=mysqli_num_rows($retrive);
                if($row==1){
            ?>
                $('input[type="checkbox"].all').attr('disabled',true);
                $('input[type="checkbox"].check').attr('disabled',true);
                $('#record').attr('disabled',true);
            <?php
                }
                else{
            ?>
                $('input[type="checkbox"].all').removeAttr('disabled');
                $('input[type="checkbox"].check').removeAttr('disabled');
                $('#record').removeAttr('disabled');

            <?php
                }
            ?>

            $('input[type="checkbox"].check').click(function(){
                var id=$(this).attr('id');
                if($(this).prop("checked")==true){
                    $('#label'+id).text('Present');
                    $('#stat'+id).val('Present');
                    $('#label'+id).css({
                        'background':'#2196f3',
                    });
                }
                else{
                    $('#label'+id).text('Absent');
                    $('#stat'+id).val('Absent');
                    $('#label'+id).css({
                        'background':'#f44336',
                    });

                }
            });

            $('input[type="checkbox"].all').click(function(){
                var id=$(this).attr('id');
                if($(this).prop("checked")==true){
                    $('input[type="checkbox"].check').prop('checked',true);
                    $('.labels').text('Present');
                    $('.labels').css({
                        'background':'#2196f3',
                    });
                    $('.stats').val('Present');

                }
                else{
                    $('input[type="checkbox"].check').prop('checked',false);
                    $('.labels').text('Absent');
                    $('.labels').css({
                        'background':'#f44336',
                    });
                    $('.stats').val('Absent');

                }
            });
        });
        $('.labels').css({
            'background':'#f44336',
        });
    </script>
</body>
</html>