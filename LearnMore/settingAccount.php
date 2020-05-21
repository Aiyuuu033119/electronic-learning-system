<?php
    include('connection.php');
    require_once('process.php');
    session_start();
    if (isset($_GET['logout'])) {
        if(isset($_SESSION['student'])){
            session_destroy();
            unset($_SESSION['student']);
            header('location:login.php');
        }
        else if(isset($_SESSION['teacher'])){
            session_destroy();
            unset($_SESSION['student']);
            header('location:login.php');
        }
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


    <?php include('navigation.php'); ?>
    
    <br>
    <div class="container bgCard grey darken-4">
        <div class="row">
            <div class="col l12"><br>
                <div class="col l12">
                    <h3 class="white-text center">Setting</h3>
                </div>
                <div class="col l10 push-l1">
                    <h5 class="white-text">Personal Information</h5>
                </div>
                <div class="col l10 push-l1 divider"></div>
                <div class="col l12"><br></div>
                <?php
                    $user=$_GET['id'];

                    $retriveName=mysqli_query($conn,"SELECT * FROM tbl_user_info INNER JOIN tbl_account ON tbl_user_info.accID=tbl_account.accID WHERE tbl_account.accID='$user'");
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
                <div class="col l12"><br><br></div>
            </div>
        </div>
    </div>



    <script src="jquery/jquery-3.4.1.min.js"></script>
    <script src="materialize2.0/js/materialize.js"></script>
    <script src="main.js"></script>
    
</body>
</html>