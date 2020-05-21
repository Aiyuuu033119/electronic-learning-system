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

    if ($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['change'])) {
        $myphp=new myphp();
        $myphp->changeDP();
        exit();
    }
    if ($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['changeWall'])) {
        $myphp=new myphp();
        $myphp->changeWall();
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
    
    <div id="wallpaper" class="modal popup grey darken-4">
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data" >
            <div class="modal-content no-padding">
                <div class="section no-padding">
                    <div class="row"><br>
                        <div class="col l12 dp-img">
                            <div class="col l12"><br><br><br><br><br><br><br><br></div>
                            <div class="user-view">
                                <div class="background" id="changeWallpaper" style="background-position: center;background-size: cover;background-repeat: no-repeat;">
                                    
                                </div>
                                <div class="col l4 push-l4 ">
                                    <div class="col l4 file-field transparent push-l4" id="pictureFeild">
                                        <div class="btn col l12 transparent center darken-1">
                                            <span><i class="fas fa-images"></i></span>
                                            <input type="file" name="wallpaper" class="center" id="wallpaper" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col l12"><br><br><br><br><br><br></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer transparent">
                <input type="submit" class="white-text btn-flat " value="change" name="changeWall" >
                <a class="modal-close modal-action waves-effect waves-red btn-flat white-text red">Cancel</a>
            </div>
        </form>
    </div>

    <div id="select" class="modal popup grey darken-4">
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data" >
            <div class="modal-content no-padding">
                <div class="section no-padding">
                    <div class="row"><br>
                        <div class="col l12 dp-img">
                            <div class="user-view">
                            <div class="col l4 push-l4">
                                    <img class="circle " src="basketball.png" id="changeDp"><br>
                                    <div class="col l4 file-field transparent push-l4" id="pictureFeild">
                                        <div class="btn col l12 transparent center darken-1">
                                            <span><i class="fas fa-images"></i></span>
                                            <input type="file" name="pictures" class="center" id="picture" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer transparent ">
                <input type="submit" class="white-text btn-flat " value="change" name="change" >
                <a class="modal-close modal-action waves-effect waves-red btn-flat white-text red">Cancel</a>
            </div>
        </form>
    </div>

    <br>    
    <div class="container bgCard">
        <div class="row">
            <div class="col l12 background-img">
                <div class="user-view" style="margin-bottom: 0px;">
                    <?php
                        $user=$_GET['id'];
                        
                        if(isset($_SESSION['student'])){
                            $superUser=$_SESSION['student'];
                        }
                        else if(isset($_SESSION['teacher'])){
                            $superUser=$_SESSION['teacher'];
                        }

                        $retriveWallpaper=mysqli_query($conn,"SELECT * FROM tbl_profile_pic INNER JOIN tbl_account ON tbl_profile_pic.userID=tbl_account.accID WHERE tbl_account.accID='$user' AND tbl_profile_pic.category='wall' ORDER BY tbl_profile_pic.ID DESC LIMIT 1");
                        $rowWallpaper=mysqli_num_rows($retriveWallpaper);
                        $fetchWallpaper=mysqli_fetch_array($retriveWallpaper);
                    ?>
                    <div class="background" id="myWallpaper" style="background:url('<?php 
                        if($rowWallpaper==1){
                            echo $fetchWallpaper['img'];
                        }
                        else{
                            echo 'wall.png';
                        }
                    ?>');background-position: center;background-size: cover;background-repeat: no-repeat;">
                        
                    </div>
                    <div class="col l4 push-l4">
                        <?php
                            $retriveDP=mysqli_query($conn,"SELECT * FROM tbl_profile_pic INNER JOIN tbl_account ON tbl_profile_pic.userID=tbl_account.accID WHERE tbl_account.accID='$user' AND tbl_profile_pic.category='dp' ORDER BY tbl_profile_pic.ID DESC LIMIT 1");
                            $rowDP=mysqli_num_rows($retriveDP);
                            $fetchDP=mysqli_fetch_array($retriveDP);
                        ?>
                        <img class="circle " id="myDp" src="<?php 
                            if($rowDP!=1){
                                echo "user.png";
                            }
                            else if($rowDP==1){
                                echo $fetchDP['img'];
                            }
                        ?>">
                        <?php
                            $retrive=mysqli_query($conn,"SELECT * FROM tbl_account INNER JOIN tbl_user_info on tbl_account.accID=tbl_user_info.accID WHERE tbl_account.accID='$user'");
                            $fetch=mysqli_fetch_array($retrive);

                            $retriveUser=mysqli_query($conn,"SELECT * FROM tbl_account WHERE user='$superUser' ");
                            $fetchUser=mysqli_fetch_array($retriveUser);
                            if($fetchUser['accID']==$user){
                                echo '<a href="#select" class="modal-trigger modal-action white-text email center" id="selectModal"><i class="fas fa-camera"></i></a>';
                            }
                        ?>
                    </div>
                    <div class="col l12"><br>
                        <p class="white-text name center"><span style="background:rgba(0,0,0,0.8);padding:0 15px;border-radius:10px"><?php echo $fetch['fn'].' '.$fetch['ln']?></span></p><br>
                        <?php
                            if($fetchUser['accID']==$user){
                                echo '<a href="#wallpaper" class="modal-trigger modal-action white-text email right" id="selectWallpaper"><i class="fas fa-camera"></i></a>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container bgCard grey darken-3">
        <div class="row"> 
            <div class="col l12">
                <div class="col l10 push-l1">
                    <div class="section">
                        <div class="card grey darken-3" style="box-shadow: none;">
                            <div class="card-content no-padding-bot-top">
                                <div class="row">
                                    <div class="col l10 push-l1">
                                        <h5 class="white-text center"><b>ABOUT ME</b></h5>
                                        <div class="divider"></div><br>
                                    </div>
                                    <div class="col l12">
                                        <div class="col l3 push-l3">
                                            <p class="white-text left"><b>Type :</b></p>
                                        </div>
                                        <div class="col l4 push-l5 ">
                                            <p class="white-text left">Student</p>
                                        </div>
                                    </div>
                                    <div class="col l12">
                                        <div class="col l3 push-l3">
                                            <p class="white-text left"><b>Email :</b></p>
                                        </div>
                                        <div class="col l4 push-l5">
                                            <p class="white-text lefts">yanny@gmail.com</p>
                                        </div>
                                    </div>
                                    <?php
                                        if($fetchUser['accID']==$user){
                                            $retriveInfo=mysqli_query($conn,"SELECT * FROM tbl_add_info WHERE accID='".$fetch['accID']."' ");
                                            $row=mysqli_num_rows($retriveInfo);
                                            if($row==1){
                                                $fetchInfo=mysqli_fetch_array($retriveInfo);
                                    ?>
                                    <div class="col l12">
                                        <div class="col l3 push-l3">
                                            <p class="white-text left"><b>Gender :</b></p>
                                        </div>
                                        <div class="col l4 push-l5">
                                            <p class="white-text left"><?php echo $fetchInfo['gender']?></p>
                                        </div>
                                    </div>
                                    <div class="col l12">
                                        <div class="col l3 push-l3">
                                            <p class="white-text left"><b>Birthday :</b></p>
                                        </div>
                                        <div class="col l4 push-l5">
                                            <p class="white-text left"><?php echo $fetchInfo['bday']?></p>
                                        </div>
                                    </div>
                                    <div class="col l12">
                                        <div class="col l3 push-l3">
                                            <p class="white-text left"><b>City :</b></p>
                                        </div>
                                        <div class="col l4 push-l5">
                                            <p class="white-text left"><?php echo $fetchInfo['city']?></p>
                                        </div>
                                    </div>
                                    <div class="col l12">
                                        <div class="col l3 push-l3">
                                            <p class="white-text left"><b>School :</b></p>
                                        </div>
                                        <div class="col l4 push-l5">
                                            <p class="white-text left"><?php echo $fetchInfo['school']?></p>
                                        </div>
                                    </div>
                                        
                                    <?php
                                            }
                                            else{
                                    ?>

                                    <div class="col l12 center">
                                        <br><a href="aboutMe.php" ><i class="fas fa-plus-circle white-text" style="font-size:20px"></i></a>
                                    </div>

                                    <?php
                                            }
                                        }
                                    ?>
                                    <div class="col l10 push-l1">
                                        <br><div class="divider"></div><br>
                                    </div>
                                    <div class="col l12">
                                        <?php
                                            if(isset($_SESSION['student'])){
                                                $retriveClass=mysqli_query($conn,"SELECT COUNT(tbl_class.code) AS counts FROM tbl_class INNER JOIN tbl_code ON tbl_code.codeID=tbl_class.classID INNER JOIN tbl_account ON tbl_account.accID=tbl_code.studentID WHERE tbl_account.accID='$user'");
                                                $fetchClass=mysqli_fetch_array($retriveClass);
                                            }
                                            else if(isset($_SESSION['teacher'])){
                                                $retriveClass=mysqli_query($conn,"SELECT COUNT(tbl_class.code) AS counts FROM tbl_class INNER JOIN tbl_account ON tbl_account.accID=tbl_class.teacherID WHERE tbl_account.accID='$user'");
                                                $fetchClass=mysqli_fetch_array($retriveClass);
                                            }
                                        ?>
                                        <div class="col l3 push-l3">
                                            <p class="left white-text"><b>Class :</b></p>
                                        </div>
                                        <div class="col l4 push-l5">
                                            <p class="left white-text "><?php echo $fetchClass['counts']?></p>
                                        </div>
                                    </div>
                                </div>
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
        $(document).on('click','#selectModal',function(){
            var dp=$('#myDp').attr('src');
            $('#changeDp').attr('src',dp);
        });

        $(document).on('click','#selectWallpaper',function(){
            var dp=$('#myWallpaper').attr('style');
            $('#changeWallpaper').attr('style',dp);
        });

        $(document).ready(function() {
            
            $(document).on('change','#picture',function(){
                $('#changeDp').removeAttr('src');
                read(this);
            });

            function read(input){
                var length=input.files.length;

                for (let index = 0; index < length; index++) {

                    var read=new FileReader();
                    
                    read.onload = function (e){
                        
                        $('#changeDp').attr('src',e.target.result);
                    };
                    read.readAsDataURL(input.files[index]);
                    
                }
            }

            $(document).on('change','#wallpaper',function(){
                $('#changeWallpaper').removeAttr('style');
                read2(this);
            });

            function read2(input){
                var length=input.files.length;

                for (let index = 0; index < length; index++) {

                    var read=new FileReader();
                    
                    read.onload = function (e){
                        
                        $('#changeWallpaper').attr('style','background:url('+e.target.result+');background-position: center;background-size: cover;background-repeat: no-repeat;');
                    };
                    read.readAsDataURL(input.files[index]);
                    
                }
            }     
        });
    </script>
</body>
</html>