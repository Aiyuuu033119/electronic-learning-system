            <div class="col l3 push-l1"><br>
                <div class="card grey darken-4 bgCard1">
                    <div class="card-content padBot">
                        <div class="row">
                            <div class="col l12">
                                <?php
                                    include('connection.php');
                                    $code=$_GET['code'];
                                    $_SESSION['code']=$code;
                                    if(isset($_SESSION['teacher'])){

                                        $teacher=$_SESSION['teacher'];
                                        $retrive=mysqli_query($conn,"SELECT tbl_class.subjects,tbl_class.g_s,tbl_class.code FROM tbl_account INNER JOIN tbl_class ON tbl_class.teacherID=tbl_account.accID WHERE tbl_account.user='$teacher' AND tbl_class.code='$code' ");
                                        while($fetch=mysqli_fetch_array($retrive)):
                                    
                                ?>
                                <span class="card-title white-text"><h5><b><?php echo $fetch['subjects'];?></b></h5></span>
                                <p class="white-text"><?php echo $fetch['g_s'];?></p>
                                <p class="white-text">
                                    <?php 
                                        $retrive2=mysqli_query($conn,"SELECT COUNT(tbl_code.codeID) as code FROM tbl_code INNER JOIN tbl_class on tbl_code.codeID=tbl_class.classID  WHERE tbl_class.code='$code'");
                                        $fetch2=mysqli_fetch_array($retrive2);
                                        echo $fetch2['code']; ?>
                                members</p>
                                <p class="white-text">Class Code: <?php echo $code?></p>
                                <br><div class="divider"></div>
                                <?php
                                        endwhile;
                                    }
                                    else if(isset($_SESSION['student'])){
                                        $student=$_SESSION['student'];
                                        $retrive=mysqli_query($conn,"SELECT tbl_class.subjects,tbl_class.g_s,tbl_class.code FROM tbl_class INNER JOIN tbl_code ON tbl_code.codeID=tbl_class.classID INNER JOIN tbl_account ON tbl_account.accID=tbl_code.studentID WHERE tbl_account.user='$student' AND tbl_class.code='$code'");
                                        while($fetch=mysqli_fetch_array($retrive)):
                                ?>
                                <span class="card-title white-text"><h5><b><?php echo $fetch['subjects'];?></b></h5></span>
                                <p class="white-text"><?php echo $fetch['g_s'];?></p>
                                <p class="white-text">
                                    <?php 
                                        $retrive2=mysqli_query($conn,"SELECT COUNT(tbl_code.codeID) as code FROM tbl_code INNER JOIN tbl_class on tbl_code.codeID=tbl_class.classID  WHERE tbl_class.code='$code'");
                                        $fetch2=mysqli_fetch_array($retrive2);
                                        echo $fetch2['code']; ?>
                                members</p>
                                <p class="white-text">Class Code: <?php echo $code?></p>
                                <br><div class="divider"></div>
                                <?php
                                        endwhile;
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                        if(isset($_SESSION['teacher'])){
                    ?>
                    <div class="content">
                        <div class="row">
                            <div class="col l12"><br><br><br>
                                <ul>
                                    <li><a href="/LearnMore/subjectTeacher.php?code=<?php echo $_GET['code']?>" class="<?php if($page=='topic'){echo 'btnHoverActive';} ?> btn-large btnHover col l12 ">TOPIC</a></li>
                                    <li><a href="/LearnMore/quizTeacher.php?code=<?php echo $_SESSION['code']?>" class="<?php if($page=='quiz'){echo 'btnHoverActive';} ?> btn-large btnHover col l12 ">QUIZ</a></li>
                                    <li><a href="/LearnMore/fileTeacher.php?code=<?php echo $_SESSION['code']?>" class="<?php if($page=='file'){echo 'btnHoverActive';} ?> btn-large btnHover col l12 ">FILE</a></li>
                                    <li><a href="/LearnMore/attendanceTeacher.php?code=<?php echo $_SESSION['code']?>" class="<?php if($page=='attend'){echo 'btnHoverActive';} ?> btn-large btnHover col l12 ">ATTENDANCE</a></li>
                                    <li><a href="/LearnMore/report.php?code=<?php echo $_SESSION['code']?>" class="<?php if($page=='report'){echo 'btnHoverActive';} ?> btn-large btnHover col l12 report">REPORT</a></li>
                                    <li><a href="/LearnMore/classTeacher.php" class=" btn-large btnHover col l12 ">BACK</a></li>
                                </ul>
                                <div class="col l12">
                                    <br><br><br><br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                    <?php
                        if(isset($_SESSION['student'])){
                    ?>
                    <div class="content">
                        <div class="row">
                            <div class="col l12"><br><br><br>
                                <ul>
                                    <li><a href="subjectStudent.php?code=<?php echo $_GET['code']?>" class="<?php if($page=='topic'){echo 'btnHoverActive';} ?> btn-large btnHover col l12 ">TOPIC</a></li>
                                    <li><a href="quizStudent.php?code=<?php echo $_SESSION['code']?>" class="<?php if($page=='quiz'){echo 'btnHoverActive';} ?> btn-large btnHover col l12 ">QUIZ</a></li>
                                    <li><a href="fileStudent.php?code=<?php echo $_SESSION['code']?>" class="<?php if($page=='file'){echo 'btnHoverActive';} ?> btn-large btnHover col l12 ">FILE</a></li>
                                    <li><a href="attendanceStudent.php?code=<?php echo $_SESSION['code']?>" class="<?php if($page=='attend'){echo 'btnHoverActive';} ?> btn-large btnHover col l12 ">ATTENDANCE</a></li>
                                    <li><a href="myClassmate.php?code=<?php echo $_SESSION['code']?>" class="<?php if($page=='classmate'){echo 'btnHoverActive';} ?> btn-large btnHover col l12 ">CLASSMATE</a></li>
                                    <li><a href="classStudent.php" class=" btn-large btnHover col l12 ">BACK</a></li>
                                </ul>
                                <div class="col l12">
                                    <br><br><br><br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>