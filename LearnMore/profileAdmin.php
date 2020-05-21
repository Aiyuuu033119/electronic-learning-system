<?php
    include('connection.php');
    require_once('process.php');
    session_start();
    $adminpage='profile';
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['admin']);
        header('location:login.php');
    }
    if(!isset($_SESSION['admin'])){
        header('location:login.php');
        
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

    <div class="section no-padding">
        <div class="row ">
            <?php include('sidenavAdmin.php');?>
            
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
                    <div class="modal-footer transparent ">
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
                </nav><br><br><br><br>
                <div class="section" style="position: absolute;z-index: -100;width:100%">
                    <div class="row">
                        <div class="col l8 push-l2 admin" style="padding-left: 0px;padding-right: 0px;">
                            <div class="user-view" style="margin-bottom: 0px;">
                                <?php
                                    $user=$_GET['id'];
                                    
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
                                    
                                    <a href="#select" class="modal-trigger modal-action white-text email center" id="selectModal"><i class="fas fa-camera"></i></a>
                                    
                                </div>
                                <div class="col l12"><br>
                                    <?php
                                        $retriveName=mysqli_query($conn,"SELECT * FROM tbl_user_info INNER JOIN tbl_account ON tbl_user_info.accID=tbl_account.accID INNER JOIN tbl_admin_info ON tbl_admin_info.accID=tbl_account.accID WHERE tbl_account.accID='$user'");
                                        $fetchName=mysqli_fetch_array($retriveName);
                                    ?>
                                    <p class="white-text name center"><span style="background:rgba(0,0,0,0.8);padding:0 15px;border-radius:10px"><?php echo $fetchName['fn'].' '.$fetchName['ln']?></span></p><br>
                                    
                                    <a href="#wallpaper" class="modal-trigger modal-action white-text email right" id="selectWallpaper"><i class="fas fa-camera"></i></a>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col l12"><br><br></div>
                        <div class="col l8 push-l2 grey darken-3" style="border-radius: 10px;">
                            <h2 class="white-text center">About Me</h2>
                            <div class="col l12 divider"></div>
                            <div class="col l12"><br></div>
                            <div class="col l12">
                                <div class="col l4">
                                    <h6 class="white-text right">Account Type:</h6>
                                </div>
                                <div class="col l5 push-l1">
                                    <h6 class="white-text right">Admin</h6>
                                </div>
                            </div>
                            <div class="col l12">
                                <div class="col l4">
                                    <h6 class="white-text right">Gender:</h6>
                                </div>
                                <div class="col l5 push-l1">
                                    <h6 class="white-text right"><?php echo $fetchName['gender']?></h6>
                                </div>
                            </div>
                            <div class="col l12">
                                <div class="col l4">
                                    <h6 class="white-text right">Email:</h6>
                                </div>
                                <div class="col l5 push-l1">
                                    <h6 class="white-text right"><?php echo $fetchName['email']?></h6>
                                </div>
                            </div>
                            <div class="col l12">
                                <div class="col l4">
                                    <h6 class="white-text right">Contact No:</h6>
                                </div>
                                <div class="col l5 push-l1">
                                    <h6 class="white-text right"><?php echo $fetchName['contact']?></h6>
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

        $(document).on('click','#selectModal',function(){
            var dp=$('#myDp').attr('src');
            $('#changeDp').attr('src',dp);
        });

        $(document).on('click','#selectWallpaper',function(){
            var dp=$('#myWallpaper').attr('style');
            $('#changeWallpaper').attr('style',dp);
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