<?php 

    if(isset($_POST['lesson'])){
        include('connection.php');
            
            $lesson=$_POST['lesson'];
            $teacher=$_SESSION['teacher'];
            $code=$_SESSION['code'];
            $topic=$_POST['topic'];
            $content=$_POST['content'];

            

            $retrive=mysqli_query($conn,"SELECT * FROM tbl_account where user='$teacher'");
            $row=mysqli_num_rows($retrive);
            
            if($row==1){
                $fetch2=mysqli_fetch_array($retrive);
                $accID=$fetch2['accID'];

                $retrive4=mysqli_query($conn,"SELECT * FROM tbl_class where teacherID='$accID' AND code='$code' ");
                $row4=mysqli_num_rows($retrive4);

                if($row4){
                    $fetch4=mysqli_fetch_array($retrive4);
                    $classID=$fetch4['classID'];
                    $insert2=mysqli_query($conn,"INSERT INTO tbl_lesson(lessonTitle,topic,content,classID) VALUES('$lesson','$topic','$content','$classID')");
                    
                    if($insert2){
                        echo 'success';
                    }
                    
                }
            }
    }

?>