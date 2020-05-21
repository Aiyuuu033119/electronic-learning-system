<?php
    include('connection.php');
    require_once('process.php');
    session_start();
    $adminpage='report';
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['admin']);
        header('location:login.php');
    }
    if(!isset($_SESSION['admin'])){
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
    <link rel="stylesheet" href="chart.js/Chart.css">
</head>

<body class="bgbody">

    <div class="section no-padding">
        <div class="row ">
            <?php include('sidenavAdmin.php');?>

            <div class="col l10 push-l2 nav2 transition navbar-fixed" style="padding-left: 0px;padding-right: 0px; z-index:100">
                <nav>
                    <div class="nav-wrapper grey darken-4 ">
                        <ul id="nav-mobile" class="hide-on-med-and-down ">
                            <li class="side-bar-icon"><a href="#" data-activates="slide-out" class="side-out button-collapse show-on-large"><i class="fas fa-bars"></i></a></li>
                        </ul>
                        <ul id="nav-mobile " class="right hide-on-med-and-down ">
                            <li><a href="# " data-activates="slide-out " class="nav-bar button-collapse show-on-large "><i class="fas fa-bars "></i></a></li>
                        </ul>
                    </div>
                </nav><br><br><br>
                <div class="section " style="position: absolute;z-index: -100;width:100%">
                    <div class="row">
                        <div class="col l6">
                            <div class="row panel grey darken-3">
                                <div class="col l12 ">
                                    <h3 class="white-text">Teacher Records</h3><br>
                                </div>
                                <div class="col l12">
                                    <table class=" highlight centered " id="table">
                                        <thead class="blue white-text" style="border:unset">
                                            <tr>
                                                <th style="width:50%">Teacher</th>
                                                <th style="width:50%">Class</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table" class="resize" style="border-radius: 0 0 25px 25px;border-bottom: 4px solid #2196f3 ;border-left: 4px solid #2196f3 ;border-right: 4px solid #2196f3 ;">
                                            <?php
                                                $retrive=mysqli_query($conn,"SELECT tbl_class.teacherID,COUNT(tbl_class.teacherID)as count,tbl_account.user  FROM tbl_account INNER JOIN tbl_class ON tbl_class.teacherID=tbl_account.accID GROUP BY tbl_class.teacherID");
                                                while($fetch=mysqli_fetch_array($retrive)):
                                            ?>
                                            <tr class="textColor">
                                                <td class="white-text no-paddingTbl" style="width:50%" id=""><?php echo $fetch['user']?></td>
                                                <td class="white-text   no-paddingTbl" style="width:50%" id=""><?php echo $fetch['count']?></td>
                                            </tr>
                                            <?php
                                                endwhile;
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col l12"><br></div>
                            </div>
                        </div>
                        <div class="col l6">
                            <div class="row panel grey darken-3">
                                <div class="col l12">
                                    <h3 class="white-text">Student Records</h3><br>
                                </div>
                                <div class="col l12">
                                    <table class=" highlight centered" id="table">
                                        <thead class="red white-text" style="border:unset">
                                            <tr>
                                                <th style="width:50%">Teacher</th>
                                                <th style="width:50%">Class</th>
                                            </tr>
                                        </thead>

                                        <tbody id="table" class="resize" style="border-radius: 0 0 25px 25px;border-bottom: 4px solid #f44336 ;border-left: 4px solid #f44336 ;border-right: 4px solid #f44336 ;">
                                            <?php
                                                $retrive=mysqli_query($conn,"SELECT tbl_code.studentID,COUNT(tbl_code.studentID)as count,tbl_account.user  FROM tbl_account INNER JOIN tbl_code ON tbl_code.studentID=tbl_account.accID GROUP BY tbl_code.studentID");
                                                while($fetch=mysqli_fetch_array($retrive)):
                                            ?>
                                            <tr class="textColor">
                                                <td class="white-text no-paddingTbl" style="width:50%" id=""><?php echo $fetch['user']?></td>
                                                <td class="white-text no-paddingTbl" style="width:50%" id=""><?php echo $fetch['count']?></td>
                                            </tr>
                                            <?php
                                                endwhile;
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col l12"><br></div>
                            </div>
                        </div>
                        <div class="col l8 push-l2">
                            <div class="row panel grey darken-3">
                                <div class="col l12">
                                    <h3 class="white-text">Admin Records</h3><br>
                                </div>
                                <div class="col l12">
                                    <table class=" highlight centered " id="table">
                                        <thead class="green white-text" style="border:unset">
                                            <tr>
                                                <th style="width:25%">Name</th>
                                                <th style="width:15%">Contact No.</th>
                                                <th style="width:30%">Email</th>
                                                <th style="width:30%">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody id="table" class="resize" style="border-radius: 0 0 25px 25px;border-bottom: 4px solid #4caf50 ;border-left: 4px solid #4caf50 ;border-right: 4px solid #4caf50 ;">
                                            <?php
                                                $retrive=mysqli_query($conn,"SELECT * FROM tbl_account INNER JOIN tbl_user_info ON tbl_user_info.accID=tbl_account.accID INNER JOIN tbl_admin_info ON tbl_user_info.accID=tbl_admin_info.accID WHERE tbl_user_info.typeID='3'  ");
                                                while($fetch=mysqli_fetch_array($retrive)):
                                            ?>
                                            <tr class="textColor">
                                                <td class="click white-text no-paddingTbl" style="width:25%" id=""><?php echo $fetch['fn'].' '.$fetch['ln'] ?></td>
                                                <td class="white-text no-paddingTbl" style="width:15%" id=""><?php echo $fetch['contact']?></td>
                                                <td class="white-text no-paddingTbl" style="width:30%" id=""><?php echo $fetch['email']?></td>
                                                <td class="white-text no-paddingTbl" style="width:30%"><a href="#delete" class="modal-trigger btn red deleteBtn" id=""><i class="fas fa-trash iconStyle"></i> Delete</a><span> </span><span></td>   
                                            </tr>
                                            <?php
                                                endwhile;
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col l12"><br></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="jquery/jquery-3.4.1.min.js "></script>
    <script src="materialize2.0/js/materialize.js "></script>
    <script>
        $(document).on('click', '.side-bar', function() {
            $('.nav1').removeClass("col l1a");
            $('.nav1').addClass("col l2 ");
            $('.nav2').removeClass("col l11a ");
            $('.nav2').addClass("col l10 push-l2 ");
            $('.side-bar').remove();
            $('.side-bar-icon').append('<a href="# " data-activates="slide-out " class="side-out button-collapse show-on-large "><i class="fas fa-bars "></i></a>');
            // $('.side-bar-wrapper').removeClass('col l12');
            // $('.side-bar-wrapper').addClass('col l2');
            $('.text').removeClass('non-visible');
            $('.text').addClass('visible');
            $('.web-title').removeClass('hide');
            $('.web-logo').addClass('hide');
            sideBar = 'open';
        });

        $(document).on('click', '.side-out', function() {
            $('.nav1').removeClass("col l2 ");
            $('.nav1').addClass("col l1a");
            $('.nav2').removeClass("col l10 push-l2");
            $('.nav2').addClass("col l11a push-l1a");
            $('.side-out').remove();
            $('.side-bar-icon').append('<a href="# " data-activates="slide-out " class="side-bar button-collapse show-on-large " ><i class="fas fa-bars "></i></a>');
            // $('.side-bar-wrapper').removeClass('col l2');
            // $('.side-bar-wrapper').addClass('col l12');
            $('.text').removeClass('visible');
            $('.text').addClass('non-visible');
            $('.web-logo').removeClass('hide');
            $('.web-title').addClass('hide');

            sideBar = 'close';

        });
    </script>
</body>

</html>