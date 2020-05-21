<?php
    include('connection.php');
    require_once('process.php');
    session_start();
    $adminpage='admin';
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

            <div class="col l10 push-l2 nav2 transition navbar-fixed" style="padding-left: 0px;padding-right: 0px;z-index: 100;">
                <nav>
                    <div class="nav-wrapper grey darken-4 ">
                        <ul id="nav-mobile" class="hide-on-med-and-down">
                            <li class="side-bar-icon"><a href="#" data-activates="slide-out" class="side-out button-collapse show-on-large"><i class="fas fa-bars"></i></a></li>
                        </ul>
                        <ul id="nav-mobile " class="right hide-on-med-and-down ">
                            <li><a href="# " data-activates="slide-out " class="nav-bar button-collapse show-on-large "><i class="fas fa-bars "></i></a></li>
                        </ul>
                    </div>
                </nav><br><br><br>
                <div class="section" style="position: absolute;z-index: -100;">
                    <div class="row">
                        <div class="col l12">
                            <div class="col l4">
                                <div class="card" style="border: 2px solid white;border-radius: 20px;background: url('icon/blue.png');">
                                    <div class="card-content">
                                        <div class="row">
                                            <div class="col l12 ">
                                                <h4 class="white-text center"><i class="fas fa-user"></i> Teacher</h4>
                                            </div>
                                            <div class="col l12 ">
                                                <?php 
                                                    $retriveTeacher=mysqli_query($conn,"SELECT COUNT(tbl_user_info.typeID) as count FROM tbl_user_info INNER JOIN tbl_acctype ON tbl_user_info.typeID=tbl_acctype.typeID WHERE tbl_user_info.typeID='2'");
                                                    $fetchTeacher=mysqli_fetch_array($retriveTeacher);
                                                ?>
                                                <h2 class="white-text center" style="margin-top: 0px;margin-bottom: 0px;"><?php echo $fetchTeacher['count']?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col l4">
                                <div class="card green " style="border: 2px solid white;border-radius: 20px;background: url('icon/green.png');">
                                    <div class="card-content">
                                        <div class="row">
                                            <div class="col l12 ">
                                                <h4 class="white-text center"><i class="fas fa-user"></i> Student</h4>
                                            </div>
                                            <div class="col l12 ">
                                                <?php 
                                                    $retriveStudent=mysqli_query($conn,"SELECT COUNT(tbl_user_info.typeID) as count FROM tbl_user_info INNER JOIN tbl_acctype ON tbl_user_info.typeID=tbl_acctype.typeID WHERE tbl_user_info.typeID='1'");
                                                    $fetchStudent=mysqli_fetch_array($retriveStudent);
                                                ?>
                                                <h2 class="white-text center" style="margin-top: 0px;margin-bottom: 0px;"><?php echo $fetchStudent['count']?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col l4">
                                <div class="card amber" style="border: 2px solid white;border-radius: 20px;background: url('icon/orange.png');">
                                    <div class="card-content">
                                        <div class="row">
                                            <div class="col l12 ">
                                                <h4 class="white-text center"><i class="fas fa-user"></i> Class</h4>
                                            </div>
                                            <div class="col l12 ">
                                                <?php 
                                                    $retriveClass=mysqli_query($conn,"SELECT COUNT(tbl_class.classID) as count FROM tbl_class");
                                                    $fetchClass=mysqli_fetch_array($retriveClass);
                                                ?>
                                                <h2 class="white-text center" style="margin-top: 0px;margin-bottom: 0px;"><?php echo $fetchClass['count']?></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col l12 ">
                            <div class="row"><br>
                                <div class="col l5 grey-text" >
                                    <canvas class="white" id="pie" width="400" height="315" style="border-radius: 20px; padding: 10px 10px 15px 10px;"></canvas>
                                </div>
                                <div class="col l7 grey-text" >
                                    <canvas class="white" id="line" width="400" height="220" style="border-radius: 20px;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="jquery/jquery-3.4.1.min.js "></script>
    <script src="materialize2.0/js/materialize.js "></script>
    <script src="chart.js/Chart.js"></script>
    <script>
        var sideBar = 'close';

        var pie = document.getElementById('pie').getContext('2d');

        var myDoughnutChart = new Chart(pie, {
            type: 'doughnut',
            data: {
                labels: ['Teacher', 'Student'],
                datasets: [{
                    data: [<?php echo $fetchTeacher['count'].','.$fetchStudent['count']?>],
                    backgroundColor: [
                        'rgba(255,99,132,0.9)',
                        'rgba(54,162,235,0.9)',
                    ],
                    borderColor: 'rgba(255,255,255,1)',
                    borderWidth: 3,
                }],
            },
            options: {
                cutoutPercentage: 50,
                rotation: 10,
            }
        });

        var line = document.getElementById('line').getContext('2d');

        var stackedLine = new Chart(line, {
            type: 'line',
            data: {
                labels: [<?php
                    $retriveMonth=mysqli_query($conn,"SELECT COUNT(accID) as count, tbl_date.Month,tbl_account.year FROM tbl_account INNER JOIN tbl_date ON tbl_account.month=tbl_date.ID GROUP BY tbl_account.year,tbl_account.month ORDER BY tbl_account.year DESC,tbl_account.month DESC LIMIT 5");
                    $rowMonth=mysqli_num_rows($retriveMonth);

                    $x=0;
                    while($fetchMonth=mysqli_fetch_array($retriveMonth)):
                        $x++;
                        if($x<$rowMonth){
                            echo '"'.$fetchMonth['Month'].'",';
                        }
                        else if($x==$rowMonth){
                            echo '"'.$fetchMonth['Month'].'"';
                        }
                    endwhile;
                ?>],
                datasets: [{
                    label: 'Teacher',
                    data: [<?php

                        $retriveMonth=mysqli_query($conn,"SELECT tbl_date.Month,tbl_account.year FROM tbl_account INNER JOIN tbl_date ON tbl_account.month=tbl_date.ID GROUP BY tbl_account.year,tbl_account.month ORDER BY tbl_account.year DESC,tbl_account.month DESC LIMIT 5");
                        $rowMonth=mysqli_num_rows($retriveMonth);

                        $x=0;
                        while($fetchMonth=mysqli_fetch_array($retriveMonth)):
                            $x++;
                            $retriveT=mysqli_query($conn,"SELECT COUNT(tbl_account.accID) as count, tbl_date.Month,tbl_account.year FROM tbl_date INNER JOIN tbl_account ON tbl_account.month=tbl_date.ID INNER JOIN tbl_user_info ON tbl_user_info.accID=tbl_account.accID INNER JOIN tbl_acctype ON tbl_user_info.typeID=tbl_acctype.typeID WHERE tbl_acctype.accType='teacher' AND tbl_date.Month='".$fetchMonth['Month']."'");
                            $rowT=mysqli_num_rows($retriveT);
                            $fetchT=mysqli_fetch_array($retriveT);
                            if($rowT==1){
                                if($x<$rowMonth){
                                    echo $fetchT['count'].',';
                                }
                                else if($x==$rowMonth){
                                    echo $fetchT['count'];
                                }
                            }
                            else if($rowT!=1){
                                if($x<$rowMonth){
                                    echo '0,';
                                }
                                else if($x==$rowMonth){
                                    echo '0';
                                }
                            }
                        endwhile;
                    ?>],
                    borderCapStyle: 'butt',
                    backgroundColor:' rgba(255,99,132,0.9)',
                    borderColor: 'rgba(255,99,132,1)',
                    borderJoinStyle: 'miter',
                    borderWidth: 3,
                    cubicInterpolationMode: 'default',
                    fill: false,
                    lineTension: 0.4,
                    pointBackgroundColor: 'rgba(255,99,132,1)',
                    pointBorderColor: 'rgba(255,99,132,1)',
                    pointBorderWidth: 2,
                    pointHitRadius: 0,
                    pointRadius: 7,
                    pointRotation: 0,
                    pointStyle: 'circle',
                    showLine: true,
                    spanGaps: true,
                    steppedLine: false,
                    pointHoverBackgroundColor: 'rgba(255,99,132,1)',
                    pointHoverBorderColor: 'rgba(255,99,132,1)',
                    pointHoverBorderWidth: 2,
                    pointHoverRadius: 7
                },
                {
                    label: 'Students',
                    data: [<?php

                        $retriveMonth=mysqli_query($conn,"SELECT tbl_date.Month,tbl_account.year FROM tbl_account INNER JOIN tbl_date ON tbl_account.month=tbl_date.ID GROUP BY tbl_account.year,tbl_account.month ORDER BY tbl_account.year DESC,tbl_account.month DESC LIMIT 5");
                        $rowMonth=mysqli_num_rows($retriveMonth);

                        $x=0;
                        while($fetchMonth=mysqli_fetch_array($retriveMonth)):
                            $x++;
                            $retriveT=mysqli_query($conn,"SELECT COUNT(tbl_account.accID) as count, tbl_date.Month,tbl_account.year FROM tbl_date INNER JOIN tbl_account ON tbl_account.month=tbl_date.ID INNER JOIN tbl_user_info ON tbl_user_info.accID=tbl_account.accID INNER JOIN tbl_acctype ON tbl_user_info.typeID=tbl_acctype.typeID WHERE tbl_acctype.accType='student' AND tbl_date.Month='".$fetchMonth['Month']."'");
                            $rowT=mysqli_num_rows($retriveT);
                            $fetchT=mysqli_fetch_array($retriveT);
                            if($rowT==1){
                                if($x<$rowMonth){
                                    echo $fetchT['count'].',';
                                }
                                else if($x==$rowMonth){
                                    echo $fetchT['count'];
                                }
                            }
                            else if($rowT!=1){
                                if($x<$rowMonth){
                                    echo '0,';
                                }
                                else if($x==$rowMonth){
                                    echo '0';
                                }
                            }
                        endwhile;
                        ?>],
                    borderCapStyle: 'butt',
                    backgroundColor: 'rgba(54,162,235,0.5)',
                    borderColor: 'rgba(54,162,235,1)',
                    borderJoinStyle: 'miter',
                    borderWidth: 3,
                    cubicInterpolationMode: 'default',
                    fill: false,
                    lineTension: 0.4,
                    pointBackgroundColor: 'rgba(54,162,235,1)',
                    pointBorderColor: 'rgba(54,162,235,1)',
                    pointBorderWidth: 2,
                    pointHitRadius: 5,
                    pointRadius: 7,
                    pointRotation: 0,
                    pointStyle: 'circle',
                    showLine: true,
                    spanGaps: true,
                    steppedLine: false,
                    pointHoverBackgroundColor: 'rgba(54,162,235,1)',
                    pointHoverBorderColor: 'rgba(54,162,235,1)',
                    pointHoverBorderWidth: 2,
                    pointHoverRadius: 7
                }],
            },
            options: {
                scales: {
                    yAxes: [{
                        stacked: false
                    }]
                }
            }
        });

        $(document).on('click', '.side-bar', function() {
            $('.nav1').removeClass("col l1a");
            $('.nav1').addClass("col l2 ");
            $('.nav2').removeClass("col l11a ");
            $('.nav2').addClass("col l10 push-l2 ");
            $('.side-bar').remove();
            $('.side-bar-icon').append('<a href="# " data-activates="slide-out " class="side-out button-collapse show-on-large "><i class="fas fa-bars "></i></a>');
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
            $('.text').removeClass('visible');
            $('.text').addClass('non-visible');
            $('.web-logo').removeClass('hide');
            $('.web-title').addClass('hide');

            sideBar = 'close';

        });
    </script>
</body>

</html>