<?php
    include('connection.php');
    require_once('process.php');
    session_start();
    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['teacher']);
        header('location:login.php');
    }
    if(!isset($_SESSION['teacher'])){
        header('location:login.php');
        
    }
    
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        $myphp=new myphp();
        $myphp->class();
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
    
    <div id="add" class="modal popup grey darken-4">
        <div class="section no-padding-bottom">
            <p class="center white-text fontStyle"><b>Learn<span class="black-text">more</b></span></p>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" id="myform">
            <div class="modal-content no-padding-bot-top" >
                <div class="section">
                    <div class="input-field border-radius">
                        <input placeholder="Subject" type="text" class="center inputAdjust border-radius border-color white-text" name="subject">
                    </div>
                    <div class="input-field border-radius">
                        <input placeholder="Grade & Section" type="text" class="center inputAdjust border-radius border-color white-text" name="GS">
                    </div>
                    <div class="input-field white hide">
                        <input type="text" class="center inputAdjust" name="option" value="1">
                    </div>
                </div>
            </div>
            <div class="modal-footer transparent">
                <input type="submit" class="white-text btn-flat " value="ADD" name="add" id="submit">
                <a class="modal-close modal-action waves-effect waves-red btn-flat white-text red">Cancel</a>
            </div>
        </form>
    </div>

    <div id="update" class="modal popup grey darken-4">
        <div class="section no-padding-bottom">
            <p class="center white-text fontStyle"><b>Learn<span class="black-text">more</b></span></p>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" >
            <div class="modal-content">
                <div class="section">
                    <div class="input-field border-radius">
                        <input placeholder="Subject" type="text" class="center inputAdjust border-radius border-color white-text" name="editSubject" id="editSubject">
                    </div>
                    <div class="input-field border-radius">
                        <input placeholder="Grade & Section" type="text" class="center inputAdjust border-radius border-color white-text" name="editGS" id="editGS">
                    </div>
                    <div class="input-field white hide">
                        <input type="text" class="center inputAdjust" name="classID" id="classID">
                    </div>
                    <div class="input-field white hide">
                        <input type="text" class="center inputAdjust" name="option" value="3">
                    </div>
                </div>
            </div>
            <div class="modal-footer transparent">
                <input type="submit" class="white-text btn-flat " value="UPDATE" name="edit" id="submit">
                <a class="modal-close modal-action waves-effect waves-red btn-flat white-text red">Cancel</a>
            </div>
        </form>
    </div>

    <div id="delete" class="modal popup grey darken-4">
        <div class="section">
            <p class="center white-text fontStyle"><b>Learn<span class=" black-text">more</b></span></p><br>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" id="myform2">
            <div class="modal-content" id="displayTextDelete">
                <div class="col l12">
                    <p class="center"><i class="fas fa-trash iconType"></i></p>
                    <h5 class="white-text center">Are you sure? You want to delete this Class?</h5>
                    <div class="input-field white hide">
                        <input placeholder="Subject" type="text" class="center inputAdjust" name="classDelete" id="classDelete">
                    </div>
                    <div class="input-field white hide">
                        <input type="text" class="center inputAdjust" name="option" value="2">
                    </div>
                </div>
            </div>
            <div class="modal-footer transparent">
                <input type="submit" class="white-text btn-flat " value="delete" name="submitDelete" id="submitDelete">
                <a class="modal-close modal-action waves-effect waves-red btn-flat white-text red">Cancel</a>
            </div>
        </form>
    </div>

    <div id="security" class="modal popup grey darken-4">
        <div class="section no-padding-bottom">
            <p class="center white-text fontStyle"><b>Learn<span class="black-text">more</b></span></p><br>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" >
            <div class="modal-content no-padding-bot-top" id="displayTextDelete">
                <div class="col l12">
                    <p class="center"><i class="" id="icon"></i></p>
                    <h5 class="white-text center closeOpen"></h5>
                    <div class="input-field white hide">
                        <input type="text" class="center inputAdjust" name="classSecurity" id="classSecurity">
                    </div>
                    <div class="input-field white hide">
                        <input type="text" class="center inputAdjust" name="option" value="4">
                    </div><br>
                    <div class="col l12 center">
                        <input type="submit" class="white-text btn blue " value="DONE" name="submitOC" id="submitOC">
                    </div>
                    <br><br>
                </div>
            </div>
        </form>
    </div>

    <br>
    <div class="container bgCard grey darken-4">
        <div class="row">
            <div class="col l12"><br>
                <div class="col l12">
                    <h3 class="white-text">My Class</h3>
                </div>
                <div class="col l12 ">
                    <a href="#add" class="modal-trigger right waves-effect waves-light btn-large light-blue darken-3 btnModifySizeAdd"><i class="fas fa-plus iconStyle"></i> Class</a>
                </div>
                <div class="col l12"><br><br></div>
                <div class="col l12">
                    <table class=" highlight centered bordered " id="table">
                        <thead class="black white-text">
                            <tr>
                                <th style="width:15%">Code</th>
                                <th style="width:35%">Class</th>
                                <th style="width:15%">Section & Grade</th>
                                <th style="width:35%">Action</th>
                            </tr>
                        </thead>

                        <tbody id="table" class="resize">
                            <?php
                                $teacher=$_SESSION['teacher'];
                                $retrive=mysqli_query($conn,"SELECT tbl_class.classStatus,tbl_class.classID,tbl_class.subjects,tbl_class.g_s,tbl_class.code FROM tbl_account INNER JOIN tbl_class ON tbl_class.teacherID=tbl_account.accID WHERE tbl_account.user='$teacher'");
                                while($fetch=mysqli_fetch_array($retrive)):
                            ?>
                            <tr class="textColor">
                                <td class="white-text no-paddingTbl" style="width:15%" id="<?php echo $fetch['classStatus']?>"><?php echo $fetch['code']?></td>
                                <td class="click no-paddingTbl" style="width:35%" id="<?php echo $fetch['code']?>"><?php echo $fetch['subjects']?></td>
                                <td class="white-text no-paddingTbl" style="width:15%"><?php echo $fetch['g_s']?></td>
                                <td class="white-text no-paddingTbl" style="width:35%"> <a href="#update" class="modal-trigger btn orange darken-2 updateBtn" id="<?php echo $fetch['classID']?>"><i class="fas fa-edit iconStyle"></i> Edit</a><span> </span><a href="#delete" class="modal-trigger btn red deleteBtn" id="<?php echo $fetch['classID']?>"><i class="fas fa-trash iconStyle"></i> Delete</a><span> </span><?php 
                                    if($fetch['classStatus']=='Close'){
                                        echo '<a href="#security" class="modal-trigger btn green securityBtn" id="'.$fetch['classID'].'"><i class="fas fa-lock iconStyle"></i> Close</a>';
                                    }
                                    else if($fetch['classStatus']=='Open'){
                                        echo '<a href="#security" class="modal-trigger btn green securityBtn" id="'.$fetch['classID'].'"><i class="fas fa-unlock iconStyle"></i> Open</a>';
                                    }
                                ?><span></td>   
                            </tr>
                            <?php
                                endwhile;
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="col l12"><br><br></div>
            </div>
        </div>
    </div>



    <script src="jquery/jquery-3.4.1.min.js"></script>
    <script src="materialize2.0/js/materialize.js"></script>
    <script src="main.js"></script>
    <script>
        $(document).ready(function() {
            
            $(document).on('click','.securityBtn',function(){
                var row=$(this).closest('tr');
                var id=$(this).attr('id');
                var status=row.find('td:eq(0)').attr('id');
                
                if(status=='Close'){
                    $('#classSecurity').val(id);
                    $('.closeOpen').text('The class are now open!');
                    $('#icon').attr('class','fas fa-unlock iconType');
                }
                else if(status=='Open'){
                    $('#classSecurity').val(id);
                    $('.closeOpen').text('The class are now close!');
                    $('#icon').attr('class','fas fa-lock iconType');

                }

            });

            $(document).on('click','.deleteBtn',function(){
                var id=$(this).attr('id');

                $('#classDelete').val(id);
            });

            $('#submit').click(function() {
                var data = $('#myform :input').serializeArray();

                $.ajax({
                    type:'post',
                    url:$('#myform').attr("action"),
                    data:data,
                    success:function(info){
                        if(info==='success'){
                            alert('Successfully Added!');
                            window.location.replace('classTeacher.php');
                        }
                        else if(info==='error'){
                            alert('Name is already existed!');
                            window.location.replace('classTeacher.php');
                        }
                        else if(info==='fail'){
                            alert('Please fill all information needed!');
                            window.location.replace('classTeacher.php');
                        }
                    }
                });
            });

            $('#myform').submit(function() {
                return false;
            });

            function clearInput(){
                $('#myform :input').each(function(){
                    $(this).val('');

                });
            }

            $('.click').click(function(){
                var code=$(this).attr('id');
                window.location.replace('subjectTeacher.php?code='+code);
            });

            $(document).on('click','.updateBtn',function(){
                var row=$(this).closest('tr');
                var id=$(this).attr('id');
                var code=row.find('td:eq(0)').text();
                var classroom=row.find('td:eq(1)').text();
                var section=row.find('td:eq(2)').text();

                $('#editGS').val(section);
                $('#editSubject').val(classroom);
                $('#classID').val(id);

            });

        });
    </script>
</body>
</html>