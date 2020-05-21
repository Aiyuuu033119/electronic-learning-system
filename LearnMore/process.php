<?php
    if (isset($_POST['delete'])) {
        session_start();
        $myphp=new myphp();
        $myphp->deleteLesson();
        exit();
    }


    class myphp{

        function adminAcc(){

            include('connection.php');

            $fn=$_POST['fn'];
            $ln=$_POST['ln'];
            $gender=$_POST['gender'];
            $cn=$_POST['cn'];
            $email=$_POST['email'];
            $user=$_POST['user'];
            $pass=password_hash($_POST['pass'],PASSWORD_DEFAULT);
            $conpass=$_POST['conpass'];
            
            $select=mysqli_query($conn,"SELECT * FROM tbl_account WHERE user='$user'");
            $row=mysqli_num_rows($select);

            if(empty($fn)&&empty($ln)&&empty($gender)&&empty($cn)&&empty($email)&&empty($user)&&empty($_POST['pass'])&&empty($email)){
                echo 'error';
            }
            else if($row==1){
                echo 'fail';
            }
            else if($_POST['pass']==$conpass&&$row==0){
                
                $year=date('Y');
                $month=date('m');
                $insert=mysqli_query($conn,"INSERT INTO tbl_account(user,pass,year,month) VALUES('$user','$pass','$year','$month')");
                
                if($insert){
                    $retrive=mysqli_query($conn,"SELECT * FROM tbl_account WHERE user='$user'");
                    $fetch=mysqli_fetch_array($retrive);
                    $accID=$fetch['accID'];
                    $row=mysqli_num_rows($retrive);
                    if ($row==1) {
                        $insert2=mysqli_query($conn,"INSERT INTO tbl_user_info(fn,ln,email,accID,typeID) VALUES('$fn','$ln','$email','$accID','3')");

                        if($insert2){
                            $insert3=mysqli_query($conn,"INSERT INTO tbl_admin_info(gender,contact,accID) VALUES('$gender','$cn','$accID')");
                            if($insert3){
                                echo 'success';
                            }
                        }
                    }
                }
            
            }   
        }

        //teacher sign up
        function teacherAcc(){

            include('connection.php');

            $fn=$_POST['fn'];
            $ln=$_POST['ln'];
            $email=$_POST['email'];
            $user=$_POST['user'];
            $pass=password_hash($_POST['pass'],PASSWORD_DEFAULT);
            $conpass=$_POST['conpass'];
            
            $select=mysqli_query($conn,"SELECT * FROM tbl_account WHERE user='$user'");
            $row=mysqli_num_rows($select);

            if(empty($fn)&&empty($ln)&&empty($user)&&empty($_POST['pass'])&&empty($email)){
                echo 'error';
            }
            else if($row==1){
                echo 'fail';
            }
            else if($_POST['pass']==$conpass&&$row==0){
                
                $year=date('Y');
                $month=date('m');
                $insert=mysqli_query($conn,"INSERT INTO tbl_account(user,pass,year,month) VALUES('$user','$pass','$year','$month')");
                
                if($insert){
                    $retrive=mysqli_query($conn,"SELECT * FROM tbl_account WHERE user='$user'");
                    $fetch=mysqli_fetch_array($retrive);
                    $accID=$fetch['accID'];
                    $row=mysqli_num_rows($retrive);

                    if ($row==1) {
                        $insert2=mysqli_query($conn,"INSERT INTO tbl_user_info(fn,ln,email,accID,typeID) VALUES('$fn','$ln','$email','$accID','2')");

                        if($insert2){
                            echo 'success';
                        }
                    }
                }
            }   
        }

        //student signup
        function studentAcc(){
            include('connection.php');

            $fn=$_POST['fn'];
            $ln=$_POST['ln'];
            $email=$_POST['email'];
            $user=$_POST['user'];
            $pass=password_hash($_POST['pass'],PASSWORD_DEFAULT);
            $conpass=$_POST['conpass'];
            $code=$_POST['code'];
            
            $select=mysqli_query($conn,"SELECT * FROM tbl_account WHERE user='$user'");
            $row=mysqli_num_rows($select);

            $retriveCode=mysqli_query($conn,"SELECT * FROM tbl_class WHERE code='$code'");
            $row2=mysqli_num_rows($retriveCode);
                            
            if(empty($fn)&&empty($ln)&&empty($user)&&empty($_POST['pass'])&&empty($email)&&empty($code)){
                echo 'error';
            }
            else if($row==1){
                echo 'fail';
            }
            else if($row2!=1){
                echo 'nomatch';
            }
            else if($_POST['pass']==$conpass&&$row==0){
                $fetch3=mysqli_fetch_array($retriveCode);
                
                $year=date('Y');
                $month=date('m');
                if($fetch3['classStatus']=='Open'){
                $insert=mysqli_query($conn,"INSERT INTO tbl_account(user,pass,year,month) VALUES('$user','$pass','$year','$month')");

                    if($insert){
                        $retrive=mysqli_query($conn,"SELECT * FROM tbl_account WHERE user='$user'");
                        $fetch2=mysqli_fetch_array($retrive);
                        $accID=$fetch2['accID'];
                        $row=mysqli_num_rows($retrive);

                            if ($row==1) {
                                $insert2=mysqli_query($conn,"INSERT INTO tbl_user_info(fn,ln,email,accID,typeID) VALUES('$fn','$ln','$email','$accID','1')");
        
                                if($insert2){
                                    if($row2==1){
                                        $codeID=$fetch3['classID'];
                                        $insert3=mysqli_query($conn,"INSERT INTO tbl_code(studentID,codeID) VALUES('$accID','$codeID')");
                                        if($insert3){
                                            echo 'success';
                                        }
                                    }
                                }
                            }
                        
                    }
                }
                else if($fetch3['classStatus']=='Close'){
                    echo 'close';
                }
            }
        }

        //login account
        function login(){
            include('connection.php');

            $user=$_POST['user'];
            $pass=$_POST['pass'];

            $select=mysqli_query($conn,"SELECT tbl_account.user,tbl_account.pass,tbl_acctype.accType FROM tbl_account INNER JOIN tbl_user_info ON tbl_account.accID=tbl_user_info.accID LEFT JOIN tbl_acctype ON tbl_user_info.typeID=tbl_acctype.typeID WHERE tbl_account.user='$user'  ");
            $row=mysqli_num_rows($select);

            if ($row==1) {
                $fetch=mysqli_fetch_array($select);
                $verify=password_verify($pass,$fetch['pass']);
                $type=$fetch['accType'];
                if($verify==true){
                    if($type=='student'){
                        $_SESSION['student']=$user;
                        $_SESSION['pass']=$pass;
                        echo 'student';
                    }
                    else if($type=='teacher'){
                        $_SESSION['teacher']=$user;
                        $_SESSION['pass']=$pass;
                        echo 'teacher';
                    }
                    else if($type=='admin'){
                        $_SESSION['admin']=$user;
                        $_SESSION['pass']=$pass;
                        echo 'admin';
                    }
                }
                else{
                    //pass checking
                    echo 'error';
                }
            }
            else if ($row!=1) {
                echo 'fail';
            }


        }

        // add class
        function class(){
            
            $option=$_POST['option'];
            switch ($option) {
                case '1':{
                    $myphp=new myphp();
                    $myphp->addClass();
                    exit();
                break;
                }
                case '2':{
                    $myphp=new myphp();
                    $myphp->deleteClass();
                    exit();
                break;
                }   
                case '3':{
                    $myphp=new myphp();
                    $myphp->editClass();
                    exit();
                break;
                }
                case '4':{
                    $myphp=new myphp();
                    $myphp->submitOC();
                    exit();
                break;
                }

                default:
                    # code...
                    break;
            }
        }

        function addClass(){
            include('connection.php');

            $subject=$_POST['subject'];
            $GS=$_POST['GS'];    
            $code=substr(str_shuffle(str_repeat("ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890",5)),0,5);
            $teacher=$_SESSION['teacher'];

            $retrive=mysqli_query($conn,"SELECT * FROM tbl_account WHERE user='$teacher'");
            $row=mysqli_num_rows($retrive);
            if(empty($subject)&&empty($GS)){
                echo 'fail';
            }
            else if($row==1){
                $fetch2=mysqli_fetch_array($retrive);
                $accID=$fetch2['accID'];

                $retrive1=mysqli_query($conn,"SELECT * FROM tbl_class WHERE subjects='$subject' AND g_s='$GS'");
                $row1=mysqli_num_rows($retrive1);

                if($row1==1){
                    echo 'error';
                }
                else{
                    $insert2=mysqli_query($conn,"INSERT INTO tbl_class(teacherID,subjects,g_s,code,classStatus) VALUES('$accID','$subject','$GS','$code','Close')");
                    echo 'success';
                }
            }
        }

        function deleteClass(){
            include('connection.php');
            
            $id=$_POST['classDelete'];

            $delete=mysqli_query($conn,"DELETE FROM tbl_class WHERE classID='$id'");
            if($delete){
                echo '<script>
                    window.location.replace("classTeacher.php");
                </script>';
            }
        }

        function editClass(){
            include('connection.php');

            $subject=$_POST['editSubject'];
            $GS=$_POST['editGS'];
            $id=$_POST['classID'];

            $update=mysqli_query($conn,"UPDATE tbl_class SET subjects='$subject',g_s='$GS' WHERE classID='$id'");
            if($update){
                echo '<script>
                    window.location.replace("classTeacher.php");
                </script>';
            }

        }

        function submitOC(){
            include('connection.php');

            $id=$_POST['classSecurity'];

            $retrive=mysqli_query($conn,"SELECT * FROM tbl_class WHERE classID='$id'");
            $fetch=mysqli_fetch_array($retrive);
            
            if ($fetch['classStatus']=='Open') {
                $update=mysqli_query($conn,"UPDATE tbl_class SET classStatus='Close' WHERE classID='$id'");
                if($update){
                    echo '<script>
                        window.location.replace("classTeacher.php");
                    </script>';
                }    
            }
            else if ($fetch['classStatus']=='Close') {
                $update=mysqli_query($conn,"UPDATE tbl_class SET classStatus='Open' WHERE classID='$id'");
                if($update){
                    echo '<script>
                        window.location.replace("classTeacher.php");
                    </script>';
                }
            }


            

        }

        //add lesson
        function addLesson(){
            include('connection.php');
            
            $lesson=$_POST['lesson'];
            $teacher=$_SESSION['teacher'];
            $code=$_SESSION['code'];
            $topic=$_POST['topic'];
            $content=$_POST['content'];

            $retrive=mysqli_query($conn,"SELECT * FROM tbl_account WHERE user='$teacher'");
            $row=mysqli_num_rows($retrive);
            
            if(empty($lesson)){
                echo '<script>
                    alert("Topic title should be fill!");
                    window.location.replace("subjectTeacher.php?code='.$code.'");
                </script>';
            }

            else if($row==1){
                $fetch2=mysqli_fetch_array($retrive);
                $accID=$fetch2['accID'];

                $retrive4=mysqli_query($conn,"SELECT * FROM tbl_class WHERE teacherID='$accID' AND code='$code' ");
                $row4=mysqli_num_rows($retrive4);

                if($row4==1){
                    $fetch4=mysqli_fetch_array($retrive4);
                    $classID=$fetch4['classID'];

                    $retrive5=mysqli_query($conn,"SELECT * FROM tbl_lesson WHERE lessonTitle='$lesson' AND classID='$classID' ");
                    $row5=mysqli_num_rows($retrive5);
                    if($row5>=1){
                        echo '<script>
                                alert("Topic Title is existed!");
                                window.location.replace("subjectTeacher.php?code='.$code.'");
                            </script>';
                    }
                    else if($row5==0){
                        foreach ($topic as $key => $value) {
                            $content[$key]=preg_replace("#\[nl\]#","<br>\n",$content[$key]);
                            $insert2=mysqli_query($conn,"INSERT INTO tbl_lesson(lessonTitle,topic,content,classID) VALUES('$lesson','".$conn->real_escape_string($topic[$key])."','".$conn->real_escape_string($content[$key])."','$classID')");
                        }
                        
                            
                        if($insert2){
                            echo '<script>
                                window.location.replace("subjectTeacher.php?code='.$code.'");
                            </script>';
                        }
                    }
                    
                    
                }
            }
        }

        function deleteLesson(){
            include('connection.php');
                    
            $lesson=$_POST['deleteLesson'];
            $code=$_SESSION['code'];
        
        
            $retrive=mysqli_query($conn,"SELECT * FROM tbl_class WHERE code='$code'");
            $row=mysqli_num_rows($retrive);
            if($row==1){
                $fetch2=mysqli_fetch_array($retrive);
                $classID=$fetch2['classID'];
                    
                $delete=mysqli_query($conn,"DELETE FROM tbl_lesson WHERE tbl_lesson.classID='$classID' AND tbl_lesson.lessonTitle='$lesson'");
                if($delete){
                    echo '<script>
                    window.location.replace("subjectTeacher.php?code='.$code.'");
                </script>';
                }
            }
        }

        function updateLesson(){
            include('connection.php');
                    
            $lesson=$_POST['titleLesson'];
            $id=$_POST['lessonID'];
            $topic=$_POST['titleTopic'];
            $content=$_POST['content'];
            $code=$_SESSION['code'];
        
            $content=preg_replace("#\[nl\]#","<br>\n",$content);

            $retrive=mysqli_query($conn,"SELECT * FROM tbl_class WHERE code='$code'");
            $row=mysqli_num_rows($retrive);
            if($row==1){
                $fetch2=mysqli_fetch_array($retrive);
                $classID=$fetch2['classID'];
                
                $update=mysqli_query($conn,"UPDATE tbl_lesson SET topic='$topic',content='$content' WHERE lessonTitle='$lesson' AND classID='$classID' AND lessonID='$id'");

                if($update){
                    echo '<script>
                        window.location.replace("editLesson.php?subject='.$lesson.'");
                    </script>';
                }
            
                
            }

        }

        function deleteTopic(){
            include('connection.php');

            $lesson=$_POST['titleLesson2'];
            $id=$_POST['lessonID2'];

            $delete=mysqli_query($conn,"DELETE FROM tbl_lesson WHERE lessonID='$id'");

            if($delete){
                echo '<script>
                        window.location.replace("editLesson.php?subject='.$lesson.'");
                    </script>';
            }
        }

        function updateLessonTitle(){
            include('connection.php');

            $lesson=$_POST['titleLesson3'];
            $lesson1=$_POST['titleLesson4'];

            $code=$_SESSION['code'];
        
            $retrive=mysqli_query($conn,"SELECT * FROM tbl_class WHERE code='$code'");
            $row=mysqli_num_rows($retrive);
            
            if($row==1){
                $fetch2=mysqli_fetch_array($retrive);
                $classID=$fetch2['classID'];
                $retrive5=mysqli_query($conn,"SELECT * FROM tbl_lesson WHERE lessonTitle='$lesson' AND classID='$classID' ");
                $row5=mysqli_num_rows($retrive5);
                if($row5>=1){
                    echo '<script>
                            alert("Topic Title is existed!");
                            window.location.replace("editLesson.php?subject='.$lesson1.'");
                        </script>';
                }
                else if($row5==0){
                    $update=mysqli_query($conn,"UPDATE tbl_lesson SET lessonTitle='$lesson' WHERE lessonTitle='$lesson1' AND classID='$classID'");

                    if($update){
                        echo '<script>
                                window.location.replace("editLesson.php?subject='.$lesson.'");
                            </script>';
                    }
                }
            }
        }

        function addMQuiz(){
            include('connection.php');

            $quiz=$_POST['quizTitle'];
            $question=$_POST['askQuestion'];
            $A=$_POST['choiceA'];
            $B=$_POST['choiceB'];
            $C=$_POST['choiceC'];
            $D=$_POST['choiceD'];
            $answer=$_POST['answer'];
            $code=$_SESSION['code'];
        
        
            $retrive=mysqli_query($conn,"SELECT * FROM tbl_class WHERE code='$code'");
            $row=mysqli_num_rows($retrive);
            if(empty($quiz)){
                echo '<script>
                    alert("Quiz title should be fill!");
                    window.location.replace("quizTeacher.php?code='.$code.'");
                </script>';
            }
            else if($row==1){
                $fetch=mysqli_fetch_array($retrive);
                $classID=$fetch['classID'];

                $retrive5=mysqli_query($conn,"SELECT * FROM tbl_quiz WHERE quizTitle='$quiz' AND classID='$classID' ");
                $row5=mysqli_num_rows($retrive5);
                if($row5>=1){
                    echo '<script>
                            alert("Quiz Title is existed!");
                            window.location.replace("quizTeacher.php?code='.$code.'");
                        </script>';
                }
                else if($row5==0){

                    $insert=mysqli_query($conn,"INSERT INTO tbl_quiz(quizTitle,classID,typeQuiz) VALUES('$quiz','$classID','Multiple Choice')");

                    if($insert){
                        $retrive2=mysqli_query($conn,"SELECT * FROM tbl_quiz WHERE quizTitle='$quiz' AND classID='$classID' AND typeQuiz='Multiple Choice' ");
                        $fetch2=mysqli_fetch_array($retrive2);
                        $quizID=$fetch2['quizID'];

                        foreach ($question as $key => $value) {
                            $insert=mysqli_query($conn,"INSERT INTO tbl_multiplechoice(quizID,question,a,b,c,d,answer) VALUES('$quizID','".$conn->real_escape_string($question[$key])."','".$conn->real_escape_string($A[$key])."','".$conn->real_escape_string($B[$key])."','".$conn->real_escape_string($C[$key])."','".$conn->real_escape_string($D[$key])."','".$conn->real_escape_string($answer[$key])."')");
                            
                        }
                        echo '<script>
                            window.location.replace("quizTeacher.php?code='.$code.'");
                        </script>';
                    }
                }
            }
        }


        function addTFQuiz(){
            include('connection.php');

            $quiz=$_POST['quizTitle2'];
            $question=$_POST['tfQuestion'];
            $answer=$_POST['tfAnswer'];
            $code=$_SESSION['code'];

            $retrive=mysqli_query($conn,"SELECT * FROM tbl_class WHERE code='$code'");
            $row=mysqli_num_rows($retrive);
            if(empty($quiz)){
                echo '<script>
                    alert("Quiz Title should be fill!");
                    window.location.replace("quizTeacher.php?code='.$code.'");
                </script>';
            }
            else if($row==1){
                $fetch=mysqli_fetch_array($retrive);
                $classID=$fetch['classID'];

                $retrive5=mysqli_query($conn,"SELECT * FROM tbl_quiz WHERE quizTitle='$quiz' AND classID='$classID' ");
                $row5=mysqli_num_rows($retrive5);
                if($row5>=1){
                    echo '<script>
                            alert("Quiz Title is existed!");
                            window.location.replace("quizTeacher.php?code='.$code.'");
                        </script>';
                }
                else if($row5==0){
                    $insert=mysqli_query($conn,"INSERT INTO tbl_quiz(quizTitle,classID,typeQuiz) VALUES('$quiz','$classID','True/False')");

                    if($insert){
                        $retrive2=mysqli_query($conn,"SELECT * FROM tbl_quiz WHERE quizTitle='$quiz' AND classID='$classID' AND typeQuiz='True/False' ");
                        $fetch2=mysqli_fetch_array($retrive2);
                        $quizID=$fetch2['quizID'];

                        foreach ($question as $key => $value) {
                            $insert=mysqli_query($conn,"INSERT INTO tbl_true_false(quizID,question,answer) VALUES('$quizID','".$conn->real_escape_string($question[$key])."','".$conn->real_escape_string($answer[$key])."')");
                            
                        }
                        echo '<script>
                            window.location.replace("quizTeacher.php?code='.$code.'");
                        </script>';
                    }
                }
            }
        }


        function editChoice(){
            include('connection.php');

            $quizID=$_POST['quizID'];
            $question=$_POST['editQuestion'];
            $question1=$_POST['editQuestion1'];
            $A=$_POST['choiceA'];
            $B=$_POST['choiceB'];
            $C=$_POST['choiceC'];
            $D=$_POST['choiceD'];
            $answer=$_POST['answer'];
            $num=$_POST['number'];
            $title=$_POST['numberTitle'];
            $choice=$_POST['quizChoiceID'];
            $code=$_SESSION['code'];
        
        
            $retrive=mysqli_query($conn,"SELECT * FROM tbl_class WHERE code='$code'");
            $row=mysqli_num_rows($retrive);
            
            if($row==1){
                $fetch=mysqli_fetch_array($retrive);
                $classID=$fetch['classID'];

                $update=mysqli_query($conn,"UPDATE tbl_multiplechoice SET question='$question',a='$A',b='$B',c='$C',d='$D',answer='$answer' WHERE quizID='$choice' AND question='$question1'");

                if($update){
                    echo '<script>
                        window.location.replace("editMQuiz.php?title='.$title.'&num='.$num.'&id='.$choice.'");
                    </script>';
                }
            }
        }

        function deleteQuiz(){
            include('connection.php');

            $quiz=$_POST['deleteQuizID'];
            $num=$_POST['deleteNum'];
            $title=$_POST['deleteTitle'];
            $id=$_POST['deleteID'];

            $delete=mysqli_query($conn,"DELETE FROM tbl_multiplechoice WHERE ID='$id'");

            if($delete){
                echo '<script>
                        window.location.replace("editMQuiz.php?title='.$title.'&num='.$num.'&id='.$quiz.'");
                    </script>';
            }

        }

        function editQuizTitle(){
            include('connection.php');

            $quiz=$_POST['quizIDS'];
            $title=$_POST['quizTitles'];
            $title1=$_POST['quizTitles1'];
            $num=$_POST['quizNums'];

            $code=$_SESSION['code'];
        
            $retrive=mysqli_query($conn,"SELECT * FROM tbl_class WHERE code='$code'");
            $row=mysqli_num_rows($retrive);
            if($row==1){
                $fetch2=mysqli_fetch_array($retrive);
                $classID=$fetch2['classID'];
                
                $retrive5=mysqli_query($conn,"SELECT * FROM tbl_quiz WHERE quizTitle='$title' AND classID='$classID' ");
                $row5=mysqli_num_rows($retrive5);
                if($row5>=1){
                    echo '<script>
                            alert("Quiz Title is existed!");
                            window.location.replace("editMQuiz.php?title='.$title1.'&num='.$num.'&id='.$quiz.'");
                        </script>';
                }
                else if($row5==0){
                    $update=mysqli_query($conn,"UPDATE tbl_quiz SET quizTitle='$title' WHERE quizID='$quiz' AND classID='$classID'");

                    if($update){
                        echo '<script>
                            window.location.replace("editMQuiz.php?title='.$title.'&num='.$num.'&id='.$quiz.'");
                        </script>';
                    }
                }
            }
        }


        function deleteQuizList(){
            include('connection.php');

            $quiz=$_POST['quizIDS'];
            $code=$_SESSION['code'];

            $delete=mysqli_query($conn,"DELETE FROM tbl_quiz WHERE quizID='$quiz'");

            if($delete){
                echo '<script>
                    window.location.replace("quizTeacher.php?code='.$code.'");
                </script>';
            }
        }


        function editTFQuiz(){
            include('connection.php');

            $quizID=$_POST['tfid'];
            
            $question=$_POST['tfQuestion'];
            $question1=$_POST['tfQuestion1'];
            $answer=$_POST['tfAnswer'];
            
            $num=$_POST['tfnum'];
            $title=$_POST['tftitle'];
            $choice=$_POST['tfquizID'];
            $code=$_SESSION['code'];
        
        
            $retrive=mysqli_query($conn,"SELECT * FROM tbl_class WHERE code='$code'");
            $row=mysqli_num_rows($retrive);
            
            if($row==1){
                $fetch=mysqli_fetch_array($retrive);
                $classID=$fetch['classID'];

                $update=mysqli_query($conn,"UPDATE tbl_true_false SET question='$question',answer='$answer' WHERE quizID='$choice' AND question='$question1'");

                if($update){
                    echo '<script>
                        window.location.replace("editTFQuiz.php?title='.$title.'&num='.$num.'&id='.$choice.'");
                    </script>';
                }
            }
        }


        function deleteTFQuiz(){
            include('connection.php');

            $quiz=$_POST['deleteQuizID'];
            $num=$_POST['deleteNum'];
            $title=$_POST['deleteTitle'];
            $id=$_POST['deleteID'];

            $delete=mysqli_query($conn,"DELETE FROM tbl_true_false WHERE ID='$id'");

            if($delete){
                echo '<script>
                        window.location.replace("editTFQuiz.php?title='.$title.'&num='.$num.'&id='.$quiz.'");
                    </script>';
            }
        }


        function editTitleTFQuiz(){
            include('connection.php');

            $quiz=$_POST['quizIDS'];
            $title=$_POST['quizTitles'];
            $title1=$_POST['quizTitles1'];
            $num=$_POST['quizNums'];

            $code=$_SESSION['code'];
        
            $retrive=mysqli_query($conn,"SELECT * FROM tbl_class WHERE code='$code'");
            $row=mysqli_num_rows($retrive);
            if($row==1){
                $fetch2=mysqli_fetch_array($retrive);
                $classID=$fetch2['classID'];
                
                $retrive5=mysqli_query($conn,"SELECT * FROM tbl_quiz WHERE quizTitle='$title' AND classID='$classID' ");
                $row5=mysqli_num_rows($retrive5);
                if($row5>=1){
                    echo '<script>
                            alert("Quiz Title is existed!");
                            window.location.replace("editTTFQuiz.php?title='.$title1.'&num='.$num.'&id='.$quiz.'");
                        </script>';
                }
                else if($row5==0){
                    $update=mysqli_query($conn,"UPDATE tbl_quiz SET quizTitle='$title' WHERE quizID='$quiz' AND classID='$classID'");

                    if($update){
                        echo '<script>
                            window.location.replace("editTFQuiz.php?title='.$title.'&num='.$num.'&id='.$quiz.'");
                        </script>';
                    }
                }
            }
        }

        function addFiles(){
            include('connection.php');

            $filename=$_POST['filename'];

            $code=$_SESSION['code'];
        
            $imgtmp=$_FILES['picture']['tmp_name'];
            $imgname=$_FILES['picture']['name'];
            $imgtype=$_FILES['picture']['type'];

            $vidtmp=$_FILES['video']['tmp_name'];
            $vidname=$_FILES['video']['name'];
            $vidtype=$_FILES['video']['type'];

            $doctmp=$_FILES['doc']['tmp_name'];
            $docname=$_FILES['doc']['name'];
            $doctype=$_FILES['doc']['type'];


            //move_uploaded_file($imgtmp,$transfer);
            $date=date('Y-m-d_h_i_s');
            $retrive=mysqli_query($conn,"SELECT * FROM tbl_class WHERE code='$code'");
            $row=mysqli_num_rows($retrive);
            if(empty($filename)){
                echo '<script>
                    alert("Name is empty ");
                    window.location.replace("fileTeacher.php?code='.$code.'");
                </script>';
            }
            else if(empty($imgname)&&empty($vidname)&&empty($docname)){
                echo '<script>
                    alert("Please Select File ");
                    window.location.replace("fileTeacher.php?code='.$code.'");
                </script>';
            }
            else if($row==1){
                $fetch2=mysqli_fetch_array($retrive);
                $classID=$fetch2['classID'];
                
                $retrive5=mysqli_query($conn,"SELECT * FROM tbl_file WHERE fileNames='$filename' AND classID='$classID' ");
                $row5=mysqli_num_rows($retrive5);
                if($row5==1){
                    echo '<script>
                            alert("Name is existed!");
                            window.location.replace("fileTeacher.php?code='.$code.'");
                        </script>';
                }

                else if(isset($imgname)&&$imgname!=''){
                    $transfer="files/image/$date.$imgname";
                    move_uploaded_file($imgtmp,$transfer);
                    $insert=mysqli_query($conn,"INSERT INTO tbl_file(fileNames,fileLoc,names,fileType,classID) VALUES('$filename','$transfer','$imgname','$imgtype','$classID')");

                    if($insert){
                        echo '<script>
                            window.location.replace("fileTeacher.php?code='.$code.'");
                        </script>';
                    }
                }
                else if(isset($vidname)&&$vidname!=''){
                    $transfer2="files/video/$date.$vidname";
                    move_uploaded_file($vidtmp,$transfer2);
                    $insert=mysqli_query($conn,"INSERT INTO tbl_file(fileNames,fileLoc,names,fileType,classID) VALUES('$filename','$transfer2','$vidname','$vidtype','$classID')");
                    
                    if($insert){
                        echo '<script>
                            window.location.replace("fileTeacher.php?code='.$code.'");
                        </script>';
                    }
                }
                else if(isset($docname)&&$docname!=''){
                    $transfer3="files/document/$date.$docname";
                    move_uploaded_file($doctmp,$transfer3);

                    switch ($doctype) {
                        case 'application/pdf':{
                            $type='PDF';
                            $insert=mysqli_query($conn,"INSERT INTO tbl_file(fileNames,fileLoc,names,fileType,classID) VALUES('$filename','$transfer3','$docname','$type','$classID')");
                            if($insert){
                                echo '<script>
                                    window.location.replace("fileTeacher.php?code='.$code.'");
                                </script>';
                            }
                            break;
                        }
                        case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':{
                            $type='Document/Word';
                            $insert=mysqli_query($conn,"INSERT INTO tbl_file(fileNames,fileLoc,names,fileType,classID) VALUES('$filename','$transfer3','$docname','$type','$classID')");
                            if($insert){
                                echo '<script>
                                    window.location.replace("fileTeacher.php?code='.$code.'");
                                </script>';
                            }
                            break;
                        }
                        case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':{
                            $type='Stylesheet/Excel';
                            $insert=mysqli_query($conn,"INSERT INTO tbl_file(fileNames,fileLoc,names,fileType,classID) VALUES('$filename','$transfer3','$docname','$type','$classID')");
                            if($insert){
                                echo '<script>
                                    window.location.replace("fileTeacher.php?code='.$code.'");
                                </script>';
                            }
                            break;
                        }
                        case 'application/vnd.openxmlformats-officedocument.presentationml.presentation':{
                            $type='Presentation/PowerPoint';
                            $insert=mysqli_query($conn,"INSERT INTO tbl_file(fileNames,fileLoc,names,fileType,classID) VALUES('$filename','$transfer3','$docname','$type','$classID')");
                            if($insert){
                                echo '<script>
                                    window.location.replace("fileTeacher.php?code='.$code.'");
                                </script>';
                            }
                            break;
                        }
                        case 'application/vnd.ms-publisher':{
                            $type='Publisher';
                            $insert=mysqli_query($conn,"INSERT INTO tbl_file(fileNames,fileLoc,names,fileType,classID) VALUES('$filename','$transfer3','$docname','$type','$classID')");
                            if($insert){
                                echo '<script>
                                    window.location.replace("fileTeacher.php?code='.$code.'");
                                </script>';
                            }
                            break;
                        }
                        default:
                            # code...
                            break;
                    }
                }
            } 
        }

        function deleteFile(){
            include('connection.php');

            $id=$_POST['fileID'];
            $location=$_POST['location'];
            $code=$_SESSION['code'];
            
            unlink($location);
            $delete=mysqli_query($conn,"DELETE FROM tbl_file WHERE fileID='$id'");

            if($delete){
                echo '<script>
                    window.location.replace("fileTeacher.php?code='.$code.'");
                </script>';
            }

        }

        function updateFile(){
            include('connection.php');
            
            $id=$_POST['fileIDS'];
            $location=$_POST['fileLoc'];
            $filename=$_POST['editName'];

            $code=$_SESSION['code'];
        
            $imgtmp=$_FILES['editpicture']['tmp_name'];
            $imgname=$_FILES['editpicture']['name'];
            $imgtype=$_FILES['editpicture']['type'];

            $vidtmp=$_FILES['editvideo']['tmp_name'];
            $vidname=$_FILES['editvideo']['name'];
            $vidtype=$_FILES['editvideo']['type'];

            $doctmp=$_FILES['editdoc']['tmp_name'];
            $docname=$_FILES['editdoc']['name'];
            $doctype=$_FILES['editdoc']['type'];

            $date=date('Y-m-d_h_i_s');
            $retrive=mysqli_query($conn,"SELECT * FROM tbl_class WHERE code='$code'");
            $row=mysqli_num_rows($retrive);
            if(!empty($filename)&&!empty($id)&&empty($imgname)&&empty($vidname)&&empty($docname)){
                $update=mysqli_query($conn,"UPDATE tbl_file SET fileNames='$filename' WHERE  fileID='$id'");
                if($update){
                    echo '<script>
                        window.location.replace("fileTeacher.php?code='.$code.'");
                    </script>';
                }
            }
            else if(empty($filename)&&empty($des)){
                echo '<script>
                    alert("Name is empty ");
                    window.location.replace("fileTeacher.php?code='.$code.'");
                </script>';
            }
            else if(empty($imgname)&&empty($vidname)&&empty($docname)){
                echo '<script>
                    alert("Please Select File ");
                    window.location.replace("fileTeacher.php?code='.$code.'");
                </script>';
            }
            else if($row==1&&!empty($filename)&&!empty($id)&&!empty($imgname)||!empty($vidname)||!empty($docname)){
                $fetch2=mysqli_fetch_array($retrive);
                $classID=$fetch2['classID'];
                
                if(isset($imgname)&&$imgname!=''){
                    $transfer="files/image/$date.$imgname";
                    unlink($location);
                    move_uploaded_file($imgtmp,$transfer);
                    $update=mysqli_query($conn,"UPDATE tbl_file SET fileNames='$filename',fileLoc='$transfer',names='$imgname',fileType='$imgtype' WHERE  fileID='$id'");

                    if($update){
                        echo '<script>
                            window.location.replace("fileTeacher.php?code='.$code.'");
                        </script>';
                    }
                }
                else if(isset($vidname)&&$vidname!=''){
                    $transfer2="files/video/$date.$vidname";
                    unlink($location);
                    move_uploaded_file($vidtmp,$transfer2);
                    $update=mysqli_query($conn,"UPDATE tbl_file SET fileNames='$filename',fileLoc='$transfer2',names='$vidname',fileType='$vidtype' WHERE  fileID='$id'");
                    
                    if($update){
                        echo '<script>
                            window.location.replace("fileTeacher.php?code='.$code.'");
                        </script>';
                    }
                }
                else if(isset($docname)&&$docname!=''){
                    $transfer3="files/document/$date.$docname";
                    unlink($location);
                    move_uploaded_file($doctmp,$transfer3);

                    switch ($doctype) {
                        case 'application/pdf':{
                            $type='PDF';
                            $update=mysqli_query($conn,"UPDATE tbl_file SET fileNames='$filename',fileLoc='$transfer3',names='$docname',fileType='$type' WHERE  fileID='$id'");
                            if($update){
                                echo '<script>
                                    window.location.replace("fileTeacher.php?code='.$code.'");
                                </script>';
                            }
                            break;
                        }
                        case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':{
                            $type='Document/Word';
                            $update=mysqli_query($conn,"UPDATE tbl_file SET fileNames='$filename',fileLoc='$transfer3',names='$docname',fileType='$type' WHERE  fileID='$id'");
                            if($update){
                                echo '<script>
                                    window.location.replace("fileTeacher.php?code='.$code.'");
                                </script>';
                            }
                            break;
                        }
                        case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':{
                            $type='Stylesheet/Excel';
                            $update=mysqli_query($conn,"UPDATE tbl_file SET fileNames='$filename',fileLoc='$transfer3',names='$docname',fileType='$type' WHERE  fileID='$id'");
                            if($update){
                                echo '<script>
                                    window.location.replace("fileTeacher.php?code='.$code.'");
                                </script>';
                            }
                            break;
                        }
                        case 'application/vnd.openxmlformats-officedocument.presentationml.presentation':{
                            $type='Presentation/PowerPoint';
                            $update=mysqli_query($conn,"UPDATE tbl_file SET fileNames='$filename',fileLoc='$transfer3',names='$docname',fileType='$type' WHERE  fileID='$id'");
                            if($update){
                                echo '<script>
                                    window.location.replace("fileTeacher.php?code='.$code.'");
                                </script>';
                            }
                            break;
                        }
                        case 'application/vnd.ms-publisher':{
                            $type='Publisher';
                            $update=mysqli_query($conn,"UPDATE tbl_file SET fileNames='$filename',fileLoc='$transfer3',names='$docname',fileType='$type' WHERE  fileID='$id'");
                            if($update){
                                echo '<script>
                                    window.location.replace("fileTeacher.php?code='.$code.'");
                                </script>';
                            }
                            break;
                        }
                        default:
                            # code...
                            break;
                    }
                }
            }
            
        }


        function record(){
            include('connection.php');

            $stdID=$_POST['names'];
            $date=$_POST['dates'];
            $stat=$_POST['stat'];

            $code=$_SESSION['code'];
        
            $retrive=mysqli_query($conn,"SELECT * FROM tbl_class WHERE code='$code'");
            $row=mysqli_num_rows($retrive);
            if(empty($date)){
                echo '<script>
                    window.location.replace("attendanceTeacher.php?code='.$code.'");
                </script>';
            }
            else if($row==1){
                $fetch=mysqli_fetch_array($retrive);
                $classID=$fetch['classID'];

                foreach ($stdID as $key => $value) {
                    $insert=mysqli_query($conn,"INSERT INTO tbl_attendance(dates, studentID, stdStatus, classID) VALUES ('$date','".$conn->real_escape_string($stdID[$key])."','".$conn->real_escape_string($stat[$key])."','$classID')");
                }
                echo '<script>
                    window.location.replace("attendanceTeacher.php?code='.$code.'");
                </script>';
                
            
            }
            

            
        }


        function addCodeClass(){
            include('connection.php');

            $code=$_POST['code'];
            $user=$_SESSION['student'];
            $select=mysqli_query($conn,"SELECT * FROM tbl_account WHERE user='$user'");
            $row=mysqli_num_rows($select);
            if($row==1){
                $fetch=mysqli_fetch_array($select);
                $id=$fetch['accID'];

                $select2=mysqli_query($conn,"SELECT * FROM tbl_class WHERE code='$code'");
                $row2=mysqli_num_rows($select2);
                if($row2==1){
                    $fetch2=mysqli_fetch_array($select2);
                    $codeID=$fetch2['classID'];

                    $select3=mysqli_query($conn,"SELECT * FROM tbl_code WHERE studentID='$id' AND codeID='$codeID'");
                    $row3=mysqli_num_rows($select3);
                    if($row3==1){
                        echo 'error';
                    }
                    else{
                        if($fetch2['classStatus']=='Open'){
                            $insert=mysqli_query($conn,"INSERT INTO tbl_code(studentID,codeID) VALUES('$id','$codeID')");
                            if($insert){
                                echo 'success';
                            }
                        }
                        else if($fetch2['classStatus']=='Close'){
                            echo 'close';
                        }
                        
                    }
                }
                else{
                    echo 'nothing';
                }
            }
        }

        function takeMQuiz(){
            include('connection.php');

            $code=$_SESSION['code'];
            $user=$_SESSION['student'];
            $quizID=$_POST['id'];
            $title=$_POST['title'];
            $num=$_POST['num'];
            $empty=$_POST['empty'];
            $average=$_POST['average'];
            $a=$_POST['correction1'];
            $b='';
            $c='';
            $d='';
            $e='';
            $f='';
            $g='';
            $h='';
            $i='';
            $j='';
            
            if(!isset($_POST['correction2'])){
                $b='Wrong';
            }
            else if(isset($_POST['correction2'])){
                $b=$_POST['correction2'];
            }
            if(!isset($_POST['correction3'])){
                $c='Wrong';
            }
            else if(isset($_POST['correction3'])){
                $c=$_POST['correction3'];
            }
            if(!isset($_POST['correction4'])){
                $d='Wrong';
            }
            else if(isset($_POST['correction4'])){
                $d=$_POST['correction4'];
            }
            if(!isset($_POST['correction5'])){
                $e='Wrong';
            }
            else if(isset($_POST['correction5'])){
                $e=$_POST['correction5'];
            }
            if(!isset($_POST['correction6'])){
                $f='Wrong';
            }
            else if(isset($_POST['correction6'])){
                $f=$_POST['correction6'];
            }
            if(!isset($_POST['correction7'])){
                $g='Wrong';
            }
            else if(isset($_POST['correction7'])){
                $g=$_POST['correction7'];
            }
            if(!isset($_POST['correction8'])){
                $h='Wrong';
            }
            else if(isset($_POST['correction8'])){
                $h=$_POST['correction8'];
            }
            if(!isset($_POST['correction9'])){
                $i='Wrong';
            }
            else if(isset($_POST['correction9'])){
                $i=$_POST['correction9'];
            }
            if(!isset($_POST['correction10'])){
                $j='Wrong';
            }
            else if(isset($_POST['correction10'])){
                $j=$_POST['correction10'];
            }
            
            $select=mysqli_query($conn,"SELECT * FROM tbl_account WHERE user='$user'");
            $row=mysqli_num_rows($select);
            if($row==1){
                $fetch=mysqli_fetch_array($select);
                $id=$fetch['accID'];
                if($empty=='1'||$empty=='2'||$empty=='3'||$empty=='4'||$empty=='5'||$empty=='6'||$empty=='7'||$empty=='8'||$empty=='9'||$empty=='10'){
                    echo '<script>
                        window.location.replace("viewMQuizStudent.php?title='.$title.'&num='.$num.'&id='.$quizID.'");
                    </script>';
                }
                else{
                    $insert=mysqli_query($conn,"INSERT INTO tbl_score(studentID,quizNum,quizID,a,b,c,d,e,f,g,h,i,j,average) VALUES('$id','Quiz $num','$quizID','$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$average')");
                    if($insert){
                        echo '<script>
                            window.location.replace("resultQuiz.php?title='.$title.'&num='.$num.'&id='.$quizID.'");
                        </script>';
                    }
                }
                

                
            }
        }

        function takeTFQuiz(){
            include('connection.php');

            $code=$_SESSION['code'];
            $user=$_SESSION['student'];
            $quizID=$_POST['id'];
            $title=$_POST['title'];
            $num=$_POST['num'];
            $empty=$_POST['empty'];
            $average=$_POST['average'];
            $a=$_POST['correction1'];
            $b='';
            $c='';
            $d='';
            $e='';
            $f='';
            $g='';
            $h='';
            $i='';
            $j='';
            
            if(!isset($_POST['correction2'])){
                $b='Wrong';
            }
            else if(isset($_POST['correction2'])){
                $b=$_POST['correction2'];
            }
            if(!isset($_POST['correction3'])){
                $c='Wrong';
            }
            else if(isset($_POST['correction3'])){
                $c=$_POST['correction3'];
            }
            if(!isset($_POST['correction4'])){
                $d='Wrong';
            }
            else if(isset($_POST['correction4'])){
                $d=$_POST['correction4'];
            }
            if(!isset($_POST['correction5'])){
                $e='Wrong';
            }
            else if(isset($_POST['correction5'])){
                $e=$_POST['correction5'];
            }
            if(!isset($_POST['correction6'])){
                $f='Wrong';
            }
            else if(isset($_POST['correction6'])){
                $f=$_POST['correction6'];
            }
            if(!isset($_POST['correction7'])){
                $g='Wrong';
            }
            else if(isset($_POST['correction7'])){
                $g=$_POST['correction7'];
            }
            if(!isset($_POST['correction8'])){
                $h='Wrong';
            }
            else if(isset($_POST['correction8'])){
                $h=$_POST['correction8'];
            }
            if(!isset($_POST['correction9'])){
                $i='Wrong';
            }
            else if(isset($_POST['correction9'])){
                $i=$_POST['correction9'];
            }
            if(!isset($_POST['correction10'])){
                $j='Wrong';
            }
            else if(isset($_POST['correction10'])){
                $j=$_POST['correction10'];
            }
            
            $select=mysqli_query($conn,"SELECT * FROM tbl_account WHERE user='$user'");
            $row=mysqli_num_rows($select);
            if($row==1){
                $fetch=mysqli_fetch_array($select);
                $id=$fetch['accID'];
                if($empty=='1'||$empty=='2'||$empty=='3'||$empty=='4'||$empty=='5'||$empty=='6'||$empty=='7'||$empty=='8'||$empty=='9'||$empty=='10'){
                    echo '<script>
                        window.location.replace("viewTFQuizStudent.php?title='.$title.'&num='.$num.'&id='.$quizID.'");
                    </script>';
                }
                else{
                    $insert=mysqli_query($conn,"INSERT INTO tbl_score(studentID,quizNum,quizID,a,b,c,d,e,f,g,h,i,j,average) VALUES('$id','Quiz $num','$quizID','$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$average')");
                    if($insert){
                        echo '<script>
                            window.location.replace("resultQuiz.php?title='.$title.'&num='.$num.'&id='.$quizID.'");
                        </script>';
                    }
                }
                
            }
        }

        function excelQuiz(){
            include('connection.php');

            $excel='
            <table>
                <thead class="black white-text">
                    <tr>
                        <th>Name</th>';
                        
                            $code=$_SESSION['code'];
                            $date=date('d/m/Y');
                            $x=0;
                            $retrive=mysqli_query($conn,"SELECT * FROM tbl_quiz INNER JOIN tbl_class ON tbl_class.classID=tbl_quiz.classID WHERE tbl_class.code='$code' ");
                            while($fetch=mysqli_fetch_array($retrive)):
                                $x++;
                        $excel.='   
                        <th>Quiz'.$x.'</th>';
                        
                            endwhile;
                    $excel.='  
                        <th>Total</th>
                    </tr>
                </thead>

                <tbody id="table" class="resize">';

                    $retrive=mysqli_query($conn,"SELECT tbl_user_info.accID,tbl_user_info.fn,tbl_user_info.ln FROM tbl_class INNER JOIN tbl_code on tbl_code.codeID=tbl_class.classID INNER JOIN tbl_user_info ON tbl_user_info.accID=tbl_code.studentID WHERE tbl_class.code='$code' ORDER BY tbl_user_info.ln");
                        while($fetch=mysqli_fetch_array($retrive)):
                    $excel.='
                    <tr class="textColor">
                        <td class="white-text no-paddingTbl2">'.$fetch['ln'].','.$fetch['fn'].'</td>';
                        
                        $retrive2=mysqli_query($conn,"SELECT * FROM tbl_quiz INNER JOIN tbl_class ON tbl_class.classID=tbl_quiz.classID WHERE tbl_class.code='$code' ");
                        $sum=0;
                        $row2=mysqli_num_rows($retrive2);
                        while($fetch2=mysqli_fetch_array($retrive2)):
                            
                            $retrive3=mysqli_query($conn,"SELECT tbl_score.average FROM tbl_user_info INNER JOIN tbl_score ON tbl_user_info.accID=tbl_score.studentID INNER JOIN tbl_quiz ON tbl_score.quizID=tbl_quiz.quizID INNER JOIN tbl_class ON tbl_class.classID=tbl_quiz.classID WHERE tbl_class.code='$code' AND tbl_user_info.accID='".$fetch['accID']."' AND tbl_quiz.quizID='".$fetch2['quizID']."' ");
                            $row3=mysqli_num_rows($retrive3);
                            if($row3==1){
                                $fetch3=mysqli_fetch_array($retrive3);
                            
                                $excel.='
                                <td class="white-text no-paddingTbl2">'; 
                                    if($fetch3['average']<50){
                                        $sum=$sum+$fetch3['average'];
                                        $excel.= '<span class="back red-text">'.$fetch3['average'].'</span>';
                                    }
                                    else if($fetch3['average']>=50&&$fetch3['average']<=99){
                                        $sum=$sum+$fetch3['average'];
                                        $excel.= '<span class="back green-text">'.$fetch3['average'].'</span>';
                                    }
                                    else if($fetch3['average']==100){
                                        $sum=$sum+$fetch3['average'];
                                        $excel.= '<span class="back blue-text">'.$fetch3['average'].'</span>';
                                    }
                                $excel.='</td>';
                        
                            } 
                            else if($row3!=1){
                                $sum=$sum+0;
                                $excel.='
                                <td class="white-text no-paddingTbl2"><span class="back red">0</span></td>';

                            }    
                        endwhile;
                        $excel.='
                                <td class="white-text no-paddingTbl2"><span class="back red">'.intval($sum/$row2).'%</span></td>';
                    $excel.='</tr>';
                    
                        endwhile;
                $excel.='    
                </tbody>
            </table>';
            header('Content-Type: application/xls');
            header('Content-Disposition: attachment; filename=quiz.xls');

            echo $excel;
        }

        function excelAttendance(){
            include('connection.php');

            $excel='
            <table>
                <thead class="black white-text">
                    <tr>
                        <th>Name</th>';
                            $code=$_SESSION['code'];
                            $date=date('d/m/Y');
                            $retrive=mysqli_query($conn,"SELECT * FROM tbl_attendance INNER JOIN tbl_class ON tbl_class.classID=tbl_attendance.classID WHERE tbl_class.code='$code' GROUP BY dates");
                            while($fetch=mysqli_fetch_array($retrive)):
                        $excel.='
                            <th>'.$fetch['dates'].'</th>';
                        
                            endwhile;
                    $excel.='
                        <th>Absent</th>
                        <th>Present</th>
                    </tr>
                </thead>

                <tbody id="table" class="resize">';
                    
                        $retrive=mysqli_query($conn,"SELECT tbl_user_info.accID,tbl_user_info.fn,tbl_user_info.ln FROM tbl_class INNER JOIN tbl_code on tbl_code.codeID=tbl_class.classID INNER JOIN tbl_user_info ON tbl_user_info.accID=tbl_code.studentID WHERE tbl_class.code='$code' ORDER BY tbl_user_info.ln");
                        while($fetch=mysqli_fetch_array($retrive)):
                    $excel.='
                    <tr class="textColor">
                        <td class="white-text no-paddingTbl">'.$fetch['ln'].','.$fetch['fn'].'</td>';
                        
                        $x=0;
                        $y=0;
                        $retrive2=mysqli_query($conn,"SELECT * FROM tbl_attendance INNER JOIN tbl_class ON tbl_class.classID=tbl_attendance.classID WHERE tbl_class.code='$code' GROUP BY dates");
                        while($fetch2=mysqli_fetch_array($retrive2)):
                            
                            $retrive3=mysqli_query($conn,"SELECT tbl_attendance.dates,tbl_attendance.stdStatus,tbl_attendance.studentID FROM tbl_class INNER JOIN tbl_attendance ON tbl_class.classID=tbl_attendance.classID INNER JOIN tbl_user_info ON tbl_user_info.accID=tbl_attendance.studentID WHERE tbl_class.code='$code' AND tbl_user_info.accID='".$fetch['accID']."' AND tbl_attendance.dates='".$fetch2['dates']."' GROUP BY tbl_attendance.dates ORDER BY tbl_user_info.ln DESC ");
                            $row3=mysqli_num_rows($retrive3);
                            if($row3==1){
                                $fetch3=mysqli_fetch_array($retrive3);
                            
                        $excel.='
                        <td class="white-text no-paddingTbl2">'; 
                            if($fetch3['stdStatus']=='Present'){
                                $x++;
                                $excel.='<span class="back blue">'.$fetch3['stdStatus'].'</span>';
                            }
                            else{
                                $y++;
                                $excel.='<span class="back red">'.$fetch3['stdStatus'].'</span>';
                            }
                        $excel.='</td>';
                        
                            } 
                            else if($row3!=1){
                                $y++;
                                $excel.='
                                <td class="white-text no-paddingTbl2"><span class="back red">Absent</span></td>';
                        
                            }    
                        endwhile;
                    $excel.='
                            <td class="white-text no-paddingTbl2"><span class="back red">'.$y.'</span></td>
                            <td class="white-text no-paddingTbl2"><span class="back red">'.$x.'</span></td>
                        </tr>';
                    
                        endwhile;
                $excel.='    
                </tbody>
            </table>';
            
            header('Content-Type: application/xls');
            header('Content-Disposition: attachment; filename=attendance.xls');
            
            echo $excel;

        }

        function addInfo(){
            include('connection.php');
            if(isset($_SESSION['student'])){
                $user=$_SESSION['student'];
            }
            else if(isset($_SESSION['teacher'])){
                $user=$_SESSION['teacher'];
            }

            $gender=$_POST['gender'];
            $bday=$_POST['bday'];
            $city=$_POST['city'];
            $school=$_POST['school'];

            $select=mysqli_query($conn,"SELECT * FROM tbl_account WHERE user='$user'");
            $row=mysqli_num_rows($select);
            if($row==1){
                $fetch=mysqli_fetch_array($select);
                $id=$fetch['accID'];

                $insert=mysqli_query($conn,"INSERT INTO tbl_add_info(gender,bday,city,school,accID) VALUES('$gender','$bday','$city','$school',$id)");
                if($insert){
                    echo '<script>
                        window.location.replace("profile.php?id='.$id.'");
                    </script>';
                }
            }
        }

        function changeDP(){
            include('connection.php');
            
            if(isset($_SESSION['student'])){
                $user=$_SESSION['student'];
            }
            else if(isset($_SESSION['teacher'])){
                $user=$_SESSION['teacher'];
            }
            else if(isset($_SESSION['admin'])){
                $user=$_SESSION['admin'];
            }

            $imgtmp=$_FILES['pictures']['tmp_name'];
            $imgname=$_FILES['pictures']['name'];
            $imgtype=$_FILES['pictures']['type'];

            $date=date('Y-m-d_h_i_s');

            $select=mysqli_query($conn,"SELECT * FROM tbl_account WHERE user='$user'");
            $row=mysqli_num_rows($select);

            $fetch=mysqli_fetch_array($select);
            $id=$fetch['accID'];
            
            if(empty($imgname)){
                echo '<script>
                    alert("Please Select File ");
                    window.location.replace("profile.php?id='.$id.'&stat=2");
                </script>';
            }

            if($row==1){
                
                if(isset($imgname)&&$imgname!=''){
                    $transfer="files/profile_pic/$date.$imgname";
                    move_uploaded_file($imgtmp,$transfer);
                    $insert=mysqli_query($conn,"INSERT INTO tbl_profile_pic(img,userID,category) VALUES('$transfer','$id','dp')");

                    if($insert){
                        
                        if(isset($_SESSION['student'])){
                            echo '<script>
                                window.location.replace("profile.php?id='.$id.'&stat=2");
                            </script>';
                        }
                        else if(isset($_SESSION['teacher'])){
                            echo '<script>
                                window.location.replace("profile.php?id='.$id.'&stat=2");
                            </script>';
                        }
                        else if(isset($_SESSION['admin'])){
                            echo '<script>
                                window.location.replace("profileAdmin.php?id='.$id.'");
                            </script>';
                        }
                    }
                }
            }

        }

        function changeWall(){
            include('connection.php');

            if(isset($_SESSION['student'])){
                $user=$_SESSION['student'];
            }
            else if(isset($_SESSION['teacher'])){
                $user=$_SESSION['teacher'];
            }
            else if(isset($_SESSION['admin'])){
                $user=$_SESSION['admin'];
            }
            
            $imgtmp=$_FILES['wallpaper']['tmp_name'];
            $imgname=$_FILES['wallpaper']['name'];
            $imgtype=$_FILES['wallpaper']['type'];

            $date=date('Y-m-d_h_i_s');

            $select=mysqli_query($conn,"SELECT * FROM tbl_account WHERE user='$user'");
            $row=mysqli_num_rows($select);

            $fetch=mysqli_fetch_array($select);
            $id=$fetch['accID'];

            if(empty($imgname)){
                echo '<script>
                    alert("Please Select File ");
                    window.location.replace("profile.php?id='.$id.'&stat=2");
                </script>';
            }

            if($row==1){
                
                if(isset($imgname)&&$imgname!=''){
                    $transfer="files/profile_pic/$date.$imgname";
                    move_uploaded_file($imgtmp,$transfer);
                    $insert=mysqli_query($conn,"INSERT INTO tbl_profile_pic(img,userID,category) VALUES('$transfer','$id','wall')");

                    if($insert){
                        
                        if(isset($_SESSION['student'])){
                            echo '<script>
                                window.location.replace("profile.php?id='.$id.'&stat=2");
                            </script>';
                        }
                        else if(isset($_SESSION['teacher'])){
                            echo '<script>
                                window.location.replace("profile.php?id='.$id.'&stat=2");
                            </script>';
                        }
                        else if(isset($_SESSION['admin'])){
                            echo '<script>
                                window.location.replace("profileAdmin.php?id='.$id.'");
                            </script>';
                        }
                    }
                }
            }

        }



        function changeUsername(){
            include('connection.php');

            $user=$_POST['username'];
            $pass=$_POST['pass'];
            $conpass=$_POST['conpass'];
            $id=$_POST['accID'];

            if($conpass!=$pass){
                
                if(isset($_SESSION['admin'])){
                    echo '<script>
                        alert("Password is not match!");
                        window.top.location="setting.php?id='.$id.'";
                    </script>';
                }
                else if(isset($_SESSION['student'])){
                    echo '<script>
                        alert("Password is not match!");
                        window.top.location="settingAccount.php?id='.$id.'";
                    </script>';
                }
                else if(isset($_SESSION['teacher'])){
                    echo '<script>
                        alert("Password is not match!");
                        window.top.location="settingAccount.php?id='.$id.'";
                    </script>';
                }
            }
            else if($conpass==$pass){
                $select=mysqli_query($conn,"SELECT * FROM tbl_account WHERE accID='$id'");
                $fetch=mysqli_fetch_array($select);
                $verify=password_verify($pass,$fetch['pass']);
                
                if($verify==true){
                    $update=mysqli_query($conn,"UPDATE tbl_account SET user='$user' WHERE accID='$id'");
                    if($update){
                        if(isset($_SESSION['admin'])){
                            $_SESSION['admin']=$user;
                            echo '<script>
                                window.top.location="setting.php?id='.$id.'";
                            </script>';
                        }
                        else if(isset($_SESSION['student'])){
                            $_SESSION['student']=$user;
                            echo '<script>
                                window.top.location="settingAccount.php?id='.$id.'";
                            </script>';
                        }
                        else if(isset($_SESSION['teacher'])){
                            $_SESSION['teacher']=$user;
                            echo '<script>
                                window.top.location="settingAccount.php?id='.$id.'";
                            </script>';
                        }
                    }
                }
                else if($verify==false){
                    if(isset($_SESSION['admin'])){
                        echo '<script>
                            alert("Password is not match!");
                            window.top.location="setting.php?id='.$id.'";
                        </script>';
                    }
                    else if(isset($_SESSION['student'])){
                        echo '<script>
                            alert("Password is not match!");
                            window.top.location="settingAccount.php?id='.$id.'";
                        </script>';
                    }
                    else if(isset($_SESSION['teacher'])){
                        echo '<script>
                            alert("Password is not match!");
                            window.top.location="settingAccount.php?id='.$id.'";
                        </script>';
                    }
                }
            }
        }

        function changePass(){
            include('connection.php');

            $current=$_POST['current'];
            $new=$_POST['new'];
            $confirm=$_POST['confirm'];
            $id=$_POST['accID'];

            $select=mysqli_query($conn,"SELECT * FROM tbl_account WHERE accID='$id'");
            $fetch=mysqli_fetch_array($select);
            $verify=password_verify($current,$fetch['pass']);
            
            if($verify==true){

                if($new!=$confirm){
                    if (isset($_SESSION['admin'])) {
                        echo '<script>
                            alert("Your new password is not match!");
                            window.top.location="setting.php?id='.$id.'";
                        </script>';
                    }
                    else if (isset($_SESSION['student'])) {
                        echo '<script>
                            alert("Your new password is not match!");
                            window.top.location="settingAccount.php?id='.$id.'";
                        </script>';
                    }
                    else if (isset($_SESSION['teacher'])) {
                        echo '<script>
                            alert("Your new password is not match!");
                            window.top.location="settingAccount.php?id='.$id.'";
                        </script>';
                    }
                }
                
                else if($new==$confirm){
                    $pass=password_hash($new,PASSWORD_DEFAULT);
                    
                    $update=mysqli_query($conn,"UPDATE tbl_account SET pass='$pass' WHERE accID='$id'");
                    if($update){
                        if (isset($_SESSION['admin'])) {
                            $_SESSION['pass']=$new;
                            echo '<script>
                                window.top.location="setting.php?id='.$id.'";
                            </script>';
                        }
                        else if (isset($_SESSION['student'])) {
                            $_SESSION['pass']=$new;
                            echo '<script>
                                window.top.location="settingAccount.php?id='.$id.'";
                            </script>';
                        }
                        else if (isset($_SESSION['teacher'])) {
                            $_SESSION['pass']=$new;
                            echo '<script>
                                window.top.location="settingAccount.php?id='.$id.'";
                            </script>';
                        }
                        
                    }
                    
                }
                
            }
            else if($verify==false){
                echo '<script>
                    alert("Your current password is not match!");
                    window.top.location="setting.php?id='.$id.'";
                </script>';
            }

        }


    }


?>