<?php
    session_start();
    require_once('process.php');
    $page='classmate ';
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
            <div class="col l7 push-l1"><br>
                <div class="card grey darken-4 bgCard1">
                    <div class="content">
                        <div class="row">
                            <div class="col l12">
                                <div class="col l12">
                                    <h3 class="white-text">My Classmates</h3>
                                </div>
                            </div>
                            <div class="col l12"><br><br>
                                <div class="collection noBorder">
                                <?php
                                    $x=0;
                                    $user=$_SESSION['student'];
                                    $retrive=mysqli_query($conn,"SELECT tbl_user_info.accID,tbl_user_info.userID,tbl_user_info.fn,tbl_user_info.ln FROM tbl_class INNER JOIN tbl_code on tbl_code.codeID=tbl_class.classID INNER JOIN tbl_user_info ON tbl_user_info.accID=tbl_code.studentID  WHERE tbl_class.code='$code' ORDER BY tbl_user_info.fn ASC");
                                    while($fetch=mysqli_fetch_array($retrive)):
                                    $x++;
                                ?>
                                    <a class="modal-trigger modal-action collection-item colHover" id="<?php echo $x?>"><?php 
                                        $retrive3=mysqli_query($conn,"SELECT * FROM tbl_account WHERE user='$user'");
                                        $fetch3=mysqli_fetch_array($retrive3);

                                        $retrive2=mysqli_query($conn,"SELECT tbl_friends.friendStatus,tbl_friends.userID,tbl_friends.friendsID FROM tbl_friends INNER JOIN tbl_user_info ON tbl_user_info.accID=tbl_friends.userID WHERE tbl_friends.friendsID='".$fetch['accID']."' AND tbl_friends.userID='".$fetch3['accID']."'");
                                        $row2=mysqli_num_rows($retrive2);
                                        $fetch2=mysqli_fetch_array($retrive2);

                                        $retriveDP=mysqli_query($conn,"SELECT * FROM tbl_profile_pic INNER JOIN tbl_account ON tbl_profile_pic.userID=tbl_account.accID WHERE tbl_account.accID='".$fetch['accID']."' AND  tbl_profile_pic.category='dp' ORDER BY tbl_profile_pic.ID DESC LIMIT 1");
                                        $rowDP=mysqli_num_rows($retriveDP);
                                        $fetchDP=mysqli_fetch_array($retriveDP);

                                    if($rowDP==1){
                                        echo '<div class="col l1 dpIcons" style="margin-top:-7px">
                                                <div class="user-view">
                                                    <div class="col l12 wall'.$x.'" id="">
                                                        <img class="circle left" src="'.$fetchDP['img'].'" id="dp'.$x.'"><br>
                                                    </div>
                                                </div>
                                            </div>';
                                    }
                                    else if($rowDP!=1){
                                        echo '<div class="col l1 dpIcons" style="margin-top:-7px">
                                                <div class="user-view">
                                                    <div class="col l12 wall'.$x.'" id="">
                                                        <img class="circle left" src="basketball.png" id="dp'.$x.'"><br>
                                                    </div>
                                                </div>
                                            </div>';
                                    }
                                                echo '<span style="margin-left: 15px;" id="'.$x.'" userID="'.$fetch['accID'].'" class="name'.$x.' border-line addName'.$x.'">'.$fetch['fn'].' '.$fetch['ln'].'</span>';
                                            
                                    ?></a>
                                <?php
                                    endwhile;
                                ?>
                                </div>
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
    <script>
        
        $(document).on('click','.border-line',function(){
            var id=$(this).attr('id');
            var user=$('.name'+id).attr('userID');
            window.top.location="profile.php?id="+user;
        });

    </script>
</body>
</html>