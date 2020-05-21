<?php
    include('connection.php');
    require_once('process.php');
    session_start();
    $adminpage='setting';

    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['admin']);
        header('location:login.php');
    }
    if(!isset($_SESSION['admin'])){
        header('location:login.php');
        
    }

    if ($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['changeUsername'])) {
        $myphp=new myphp();
        $myphp->changeUsername();
        exit();
    }
    if ($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['changePass'])) {
        $myphp=new myphp();
        $myphp->changePass();
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

    <div class="section no-padding">
        <div class="row ">
            <?php include('sidenavAdmin.php');?>
            
            <div id="changeUsername" class="modal popup grey darken-4"><br>
                <p class="center white-text fontStyle"><b>Learn<span class="black-text">more</b></span></p><br>
                <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" id="form">
                    <div class="modal-content noPadding">
                            <div class="row">
                                <div class="col l12" id="displayType1">
                                    <div class="input-field border-radius">
                                        <input placeholder="New Username" type="text" class="center inputAdjust border-radius border-color white-text" name="username" >
                                    </div>
                                    <div class="input-field border-radius">
                                        <input placeholder="Password" type="password" class="center inputAdjust border-radius border-color white-text" name="pass" >
                                    </div>
                                    <div class="input-field border-radius">
                                        <input placeholder="Confirm Password" type="password" class="center inputAdjust border-radius border-color white-text" name="conpass">
                                    </div>
                                    <div class="input-field white hide">
                                        <input placeholder="" type="text" class="center inputAdjust" name="accID" value="<?php echo $_GET['id']?>">
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer transparent">
                        <input id="submit" type="submit" class="white-text btn-flat " value="UPDATE" name="changeUsername">
                        <a class="modal-close modal-action waves-effect waves-red btn-flat white-text red">Cancel</a>
                    </div>
                </form>
            </div>

            <div id="changePass" class="modal popup grey darken-4"><br>
                <p class="center white-text fontStyle"><b>Learn<span class="black-text">more</b></span></p><br>
                <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" id="form">
                    <div class="modal-content noPadding">
                            <div class="row">
                                <div class="col l12" id="displayType1">
                                    <div class="input-field border-radius">
                                        <input placeholder="Current Password" type="password" class="center inputAdjust border-radius border-color white-text" name="current">
                                    </div>
                                    <div class="input-field border-radius">
                                        <input placeholder="New Password" type="password" class="center inputAdjust border-radius border-color white-text" name="new">
                                    </div>
                                    <div class="input-field border-radius">
                                        <input placeholder="Confirm Password" type="password" class="center inputAdjust border-radius border-color white-text" name="confirm">
                                    </div>
                                    <div class="input-field white hide">
                                        <input placeholder="Topic" type="text" class="center inputAdjust" name="accID" value="<?php echo $_GET['id'] ?>">
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer transparent">
                        <input id="submit" type="submit" class="white-text btn-flat " value="UPDATE" name="changePass">
                        <a class="modal-close modal-action waves-effect waves-red btn-flat white-text red">Cancel</a>
                    </div>
                </form>
            </div>

            <div class="col l10 push-l2 nav2 transition navbar-fixed" style="padding-left: 0px;padding-right: 0px;z-index:100">
                <nav>
                    <div class="nav-wrapper grey darken-4 ">
                        <ul id="nav-mobile" class="hide-on-med-and-down ">
                            <li class="side-bar-icon"><a href="#" data-activates="slide-out" class="side-out button-collapse show-on-large"><i class="fas fa-bars"></i></a></li>
                        </ul>
                        <ul id="nav-mobile " class="right hide-on-med-and-down ">
                            <li><a href="# " data-activates="slide-out " class="nav-bar button-collapse show-on-large "><i class="fas fa-bars "></i></a></li>
                        </ul>
                    </div>
                </nav><br><br><br><br><br>
                <div class="section" style="position: absolute;z-index: -100;width:100%">
                    <div class="row">
                        <div class="col l10 push-l1 grey darken-3">
                            <br>
                            <div class="col l10 push-l1"><br>
                                <a href="adminSignUp.php" class="waves-effect waves-light btn white-text btn-flat light-blue right btnModifySizeAdd"><i class="fas fa-plus iconStyle"></i> ADMIN</a>
                            </div>
                            <div class="col l10 push-l1">
                                <h5 class="white-text">Personal Information</h5>
                            </div>
                            <div class="col l10 push-l1 divider"></div>
                            <div class="col l12"><br></div>
                            <?php
                                $user=$_GET['id'];

                                $retriveName=mysqli_query($conn,"SELECT * FROM tbl_user_info INNER JOIN tbl_account ON tbl_user_info.accID=tbl_account.accID INNER JOIN tbl_admin_info ON tbl_admin_info.accID=tbl_account.accID WHERE tbl_account.accID='$user'");
                                $fetchName=mysqli_fetch_array($retriveName);
                            ?>
                            <div class="col l12">
                                <div class="col l2 push-l1 ">
                                    <h6 class="white-text right"><b>Username:</b></h6>
                                </div>
                                <div class="col l3 push-l1">
                                    <h6 class="white-text"> 
                                        <span class="back grey"><?php echo $fetchName['user']?></span>
                                    </h6>
                                </div>
                                <div class="col l5 push-l1">
                                    <a href="#changeUsername" class="modal-trigger modal-action white-text right blue-text"><i class="fas fa-edit"></i></a>
                                </div>
                            </div>
                            <div class="col l10 push-l1">
                                <br><h5 class="white-text">Security Information</h5>
                            </div>
                            <div class="col l10 push-l1 divider"></div>
                            <div class="col l12"><br></div>
                            <div class="col l12">
                                <div class="col l2 push-l1 ">
                                    <h6 class="white-text right"><b>Password:</b></h6>
                                </div>
                                <div class="col l3 push-l1">
                                    <h6 class="white-text"> 
                                        <span class="back grey"><?php 
                                            
                                            $length=strlen($_SESSION['pass']);
                                            for ($i=0; $i < $length; $i++) { 
                                                echo '*';
                                            }
                                        ?></span>
                                    </h6>
                                </div>
                                <div class="col l5 push-l1">
                                    <a href="#changePass" class="modal-trigger modal-action white-text right blue-text"><i class="fas fa-edit"></i></a>
                                </div>
                            </div>
                            <div class="col l12"><br></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="jquery/jquery-3.4.1.min.js "></script>
    <script src="materialize2.0/js/materialize.js "></script>
    <script>
        $(document).ready(function(){
            $('.modal').modal();
        });
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