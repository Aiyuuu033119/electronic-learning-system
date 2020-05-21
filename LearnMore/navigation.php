    
    
    
    <?php
        if(isset($_SESSION['teacher'])){
            include('connection.php');
    ?>
        <nav>
            <div class="nav-wrapper grey darken-4">
            <a href="#" class="brand-logo center fontStyleHome"><b>Learn<span class=" black-text">more</b></span></a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="classTeacher.php" class="tooltipped" data-tooltip="Class"><i class="fas fa-chalkboard-teacher"></i></a></li>
            </ul>
            <ul id="nav-mobile" class="left hide-on-med-and-down">
                <li><a href="#" data-activates="slide-out" class="button-collapse show-on-large"><i class="fas fa-bars"></i></a></li>
            </ul>
            
            <ul id="slide-out" class="side-nav">
                <li>
                    <div class="user-view">
                        <?php
                            $user=$_SESSION['teacher'];
                    
                            $retriveWall=mysqli_query($conn,"SELECT * FROM tbl_profile_pic INNER JOIN tbl_account ON tbl_profile_pic.userID=tbl_account.accID WHERE tbl_account.user='$user' AND tbl_profile_pic.category='wall' ORDER BY tbl_profile_pic.ID DESC LIMIT 1");
                            $rowWall=mysqli_num_rows($retriveWall);
                            $fetchWall=mysqli_fetch_array($retriveWall);
                        ?>
                        <div class="background">
                            <img src="<?php 
                                if($rowWall!=1){
                                    echo "wall.png";
                                }
                                else if($rowWall==1){
                                    echo $fetchWall['img'];
                                }
                            ?>">
                        </div>
                        <?php
                        
                            $retriveDP=mysqli_query($conn,"SELECT * FROM tbl_profile_pic INNER JOIN tbl_account ON tbl_profile_pic.userID=tbl_account.accID WHERE tbl_account.user='$user' AND tbl_profile_pic.category='dp' ORDER BY tbl_profile_pic.ID DESC LIMIT 1");
                            $rowDP=mysqli_num_rows($retriveDP);
                            $fetchDP=mysqli_fetch_array($retriveDP);
                        ?>
                        <a href="#!user"><img class="circle" src="<?php 
                                if($rowDP!=1){
                                    echo "user.png";
                                }
                                else if($rowDP==1){
                                    echo $fetchDP['img'];
                                }
                            ?>"></a>
                        <?php
                            $retrive=mysqli_query($conn,"SELECT * FROM tbl_account INNER JOIN tbl_user_info on tbl_account.accID=tbl_user_info.accID WHERE user='$user'");
                            $fetch=mysqli_fetch_array($retrive);
                        ?>
                        <a href="#!name"><span class="white-text name"><?php echo $fetch['fn'].' '.$fetch['ln']?></span></a>
                        <a href="#!email"><span class="white-text email"><?php echo $fetch['email']?></span></a>
                    </div>
                </li>
                <li><a href="profile.php?id=<?php echo $fetch['accID']?>">Profile</a></li>
                <li><a href="classStudent.php">Class</a></li>
                <li><a href="settingAccount.php?id=<?php echo $fetch['accID']?>">Setting</a></li>
                <!-- <ul class="collapsible collapsible-accordion">
                    <li>
                        <a class="collapsible-header">Setting</a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="#!">General Info</a></li>
                                <li><a href="#!">Security</a></li>
                            </ul>
                        </div>
                    </li>
                </ul> -->
                <li><a href="classTeacher.php?logout=true">Log Out</a></li>

            </ul>
            </div>
        </nav>
    <?php
        }
        else if(isset($_SESSION['student'])){
            include('connection.php');
    ?>  
        
        <nav>
            <div class="nav-wrapper grey darken-4">
            <a href="#" class="brand-logo center fontStyleHome"><b>Learn<span class=" black-text">more</b></span></a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="classStudent.php" class="tooltipped" data-tooltip="Class"><i class="fas fa-chalkboard-teacher"></i></a></li>
            </ul>
            <ul id="nav-mobile" class="left hide-on-med-and-down">
                <li><a href="#" data-activates="slide-out" class="button-collapse show-on-large"><i class="fas fa-bars"></i></a></li>
            </ul>
            
            <ul id="slide-out" class="side-nav">
                <li>
                    <div class="user-view">
                        <?php
                            $user=$_SESSION['student'];
                    
                            $retriveWall=mysqli_query($conn,"SELECT * FROM tbl_profile_pic INNER JOIN tbl_account ON tbl_profile_pic.userID=tbl_account.accID WHERE tbl_account.user='$user' AND tbl_profile_pic.category='wall' ORDER BY tbl_profile_pic.ID DESC LIMIT 1");
                            $rowWall=mysqli_num_rows($retriveWall);
                            $fetchWall=mysqli_fetch_array($retriveWall);
                        ?>
                        <div class="background">
                            <img src="<?php 
                                if($rowWall!=1){
                                    echo "wall.png";
                                }
                                else if($rowWall==1){
                                    echo $fetchWall['img'];
                                }
                            ?>">
                        </div>
                        <?php
                        
                            $retriveDP=mysqli_query($conn,"SELECT * FROM tbl_profile_pic INNER JOIN tbl_account ON tbl_profile_pic.userID=tbl_account.accID WHERE tbl_account.user='$user' AND tbl_profile_pic.category='dp' ORDER BY tbl_profile_pic.ID DESC LIMIT 1");
                            $rowDP=mysqli_num_rows($retriveDP);
                            $fetchDP=mysqli_fetch_array($retriveDP);
                        ?>
                        <a href="#!user"><img class="circle" src="<?php 
                                if($rowDP!=1){
                                    echo "user.png";
                                }
                                else if($rowDP==1){
                                    echo $fetchDP['img'];
                                }
                            ?>"></a>
                        <?php
                            
                            $retrive=mysqli_query($conn,"SELECT * FROM tbl_account INNER JOIN tbl_user_info on tbl_account.accID=tbl_user_info.accID WHERE user='$user'");
                            $fetch=mysqli_fetch_array($retrive);

                        ?>
                        <a href="#!name"><span class="white-text name"><?php echo $fetch['fn'].' '.$fetch['ln']?></span></a>
                        <a href="#!email"><span class="white-text email"><?php echo $fetch['email']?></span></a>
                    </div>
                </li>
                <li><a href="profile.php?id=<?php echo $fetch['accID']?>">Profile</a></li>
                <li><a href="classStudent.php">Class</a></li>
                <li><a href="settingAccount.php?id=<?php echo $fetch['accID']?>">Setting</a></li>
                <!-- <ul class="collapsible collapsible-accordion">
                    <li>
                        <a class="collapsible-header">Setting</a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="#!">General Info</a></li>
                                <li><a href="#!">Security</a></li>
                            </ul>
                        </div>
                    </li>
                </ul> -->
                <li><a href="classStudent.php?logout=true">Log Out</a></li>

            </ul>
                

                <ul id='friends' class="dropdown-content">
                <?php
                    $retrive=mysqli_query($conn,"SELECT * FROM tbl_account WHERE user='$user'");
                    $fetch=mysqli_fetch_array($retrive);

                    $retrive2=mysqli_query($conn,"SELECT tbl_user_info.fn, tbl_user_info.ln, tbl_friends.ID FROM tbl_friends INNER JOIN tbl_user_info ON tbl_user_info.accID=tbl_friends.userID WHERE tbl_friends.friendsID='".$fetch['accID']."' AND tbl_friends.friendStatus='WAITING' ORDER BY tbl_friends.ID DESC");
                    $row2=mysqli_num_rows($retrive2);
                    if($row2>=1){
                        $x=0;
                        while ($fetch2=mysqli_fetch_array($retrive2)):
                            $x++;
                    

                ?>
                            <li><span class="dropdownHover"> <span class="names"><?php echo $fetch2['fn'].' '.$fetch2['ln'] ?></span><span class="right red decline back3" id="<?php echo $x?>"><span class="dec<?php echo $x?>" id="<?php echo $fetch2['ID'] ?>">decline</span></span><span class="right blue accept back3" id="<?php echo $x?>"><span class="acc<?php echo $x?>" id="<?php echo $fetch2['ID'] ?>">accept</span></span></span></li>
                <?php
                        endwhile;
                    }
                    else{
                ?>
                        <li><a class="dropdownHover"> No result</a></li>
                <?php
                    }
                ?>
                </ul>
                
            </div>
        </nav>
    <?php
        }
    ?>
    <script src="jquery/jquery-3.4.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".button-collapse").sideNav();
            $('.collapsible').collapsible();
        });
        $(document).on('click','.decline',function(){
            var id=$(this).attr('id');
            var userID=$('.dec'+id).attr('id');
            
            $('#deleteFriend').modal('open');

            $('#declineFriend').val(userID);
        }); 

        $(document).on('click','.accept',function(){
            var id=$(this).attr('id');
            var userID=$('.acc'+id).attr('id');

            $('#acceptFriend').modal('open');

            $('#navAccept').val(userID);
        });
    </script>