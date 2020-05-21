<?php
    session_start();
    require_once('process.php');
    $page='topic';
    if(!isset($_SESSION['teacher'])){
        header('location:login.php');
        
    }
    if ($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['addLesson'])) {
        $myphp=new myphp();
        $myphp->addLesson();
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
    
    <div id="add" class="modal popup2 grey darken-4">
        <div class="section no-padding-bottom">
            <p class="center white-text fontStyle"><b>Learn<span class="black-text">more</b></span></p><br>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" id="form">
            <div class="modal-content no-padding-bot-top">
                <div class="input-field border-radius">
                    <input placeholder="Topic Title" type="text" class="center inputAdjust border-radius border-color white-text" name="lesson">
                </div>
                <div class="section">
                    <div class="row"><br>
                        
                        <!--Add subtopic item -->
                        <div class="col l2">
                            <div class="row panel"><br>
                                <p class="white-text center">Sub-Topic</p>
                                <a id="topicBtn" class="waves-effect waves-red btn-flat white-text red col l10 push-l1 center"><i class="fas fa-plus iconStyle"></i></a>
                                <div class="col l12">
                                    <div class="collection noBorder" id="topicItem">
                                        <a href="#num1"  class="collection-item colHover2 center">1</a>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <!--Add subtopic item -->
                        <div class="col l10" id="topic">
                            <div class="row panel" id="num1"><br>
                                
                                <div class="col l12">
                                    <div class="row">
                                        <div class="col l12" id="displayType1">
                                            <div class="input-field border-radius">
                                                <input placeholder="Sub-Topic" type="text" class="center inputAdjust border-radius border-color white-text" name="topic[]">
                                            </div>
                                            <div class="input-field white hide">
                                                <textarea id="txt1" name="content[]" placeholder="Discussion... Minimum 2500 letters" class="materialize-textarea inputAdjust"></textarea>
                                            </div>
                                            <div class="input-field border-radius ">
                                                <textarea placeholder="Content" id="1" name="" class="materialize-textarea inputAdjust msg content1 center border-radius border-color white-text"></textarea>
                                            </div>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer transparent">
                <input id="submit" type="submit" class="white-text btn-flat " value="ADD" name="addLesson">
                <a class="modal-action modal-close waves-effect waves-red btn-flat white-text red">Cancel</a>
            </div>
        </form>
    </div>

    <div id="delete" class="modal popup grey darken-4">
        <div class="section">
            <p class="center white-text fontStyle"><b>Learn<span class=" black-text">more</b></span></p><br>
        </div>
        <form action="process.php" method="POST">
            <div class="modal-content no-padding-bot-top" id="displayTextDelete">
                <p class="center"><i class="fas fa-trash iconType"></i></p>
                <h5 class="white-text center">Are you sure? You want to delete this Topic?</h5>
                <div class="input-field hide">
                    <input placeholder="First Name..." id="deleteLesson" type="text" class="center black-text inputAdjust" name="deleteLesson">
                </div>
            </div>
            <div class="modal-footer transparent">
                <input type="submit" class="white-text btn-flat" value="Delete" name="delete">
                <a class=" modal-action modal-close waves-effect waves-red btn-flat white-text red">Cancel</a>
            </div>
        </form>
    </div>

    <div class="section">
        <div class="row ">
            <?php include('sidenav.php'); ?>
            <div class="col l7 push-l1 "><br>
                <div class="card grey darken-4 bgCard1">
                    <div class="content">
                        <div class="row">
                            <div class="col l12">
                                <div class="col l12">
                                    <h3 class="white-text">My Topics</h3>
                                    <?php
                                        $code=$_SESSION['code'];
                                        $select=mysqli_query($conn,"SELECT tbl_lesson.lessonTitle FROM tbl_lesson INNER JOIN tbl_class ON tbl_lesson.classID=tbl_class.classID WHERE tbl_class.code='$code' GROUP BY tbl_lesson.lessonTitle ORDER BY tbl_lesson.lessonID asc");
                                        $count=mysqli_fetch_array($select);
                                        $row=mysqli_num_rows($select);
                                    ?>
                                    <p class="white-text">Number of Topics: <?php echo $row;?></p>
                                </div>
                            </div>
                            <div class="col l12 ">
                                <a href="#add" class="modal-trigger right waves-effect waves-light btn-large light-blue darken-3 btnModifySizeAdd"><i class="fas fa-plus iconStyle"></i> Lesson</a>
                            </div>
                            <div class="col l10 push-l1"><br><br>
                                <table class=" highlight centered" id="table">
                                    <thead class="blue white-text" style="border:unset">
                                        <tr>
                                            <th>Topic</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody id="table" class="resize" style="border-radius: 0 0 25px 25px;border-bottom: 4px solid #2196f3;border-left: 4px solid #2196f3;border-right: 4px solid #2196f3;">
                                        <?php
                                            $code=$_SESSION['code'];
                                            $retrive=mysqli_query($conn,"SELECT tbl_lesson.lessonTitle FROM tbl_lesson INNER JOIN tbl_class ON tbl_lesson.classID=tbl_class.classID WHERE tbl_class.code='$code' GROUP BY tbl_lesson.lessonTitle ORDER BY tbl_lesson.lessonID asc");
                                            while($fetch=mysqli_fetch_array($retrive)):
                                        ?>
                                        <tr class="textColor" >
                                            <td class="white-text no-paddingTbl" id="<?php echo $fetch['code'];?>"><?php echo $fetch['lessonTitle']?></td>
                                            <td class="white-text no-paddingTbl"> <a class="modal-trigger btn light blue" id="updateBtn"><i class="fas fa-edit iconStyle"></i> Edit</a><span> </span><a href="#delete" class="modal-trigger btn red" id="deleteBtn"><i class="fas fa-trash iconStyle"></i> Delete</a></td>
                                        </tr>
                                        <?php
                                            endwhile;
                                        ?>
                                    </tbody>
                                </table><br><br>
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
        $(document).ready(function() {

            $(document).on('keyup','.msg',function(){
                var id=$(this).attr('id');
                var txt2=$('.content'+id).val();
                txt2=txt2.replace(/\n/g,'[nl]');
                $('#txt'+id).val(txt2);
                return false;
            });
            

            $('#myform').submit(function() {
                return false;
            });

            function clearInput(){
                $('#myform :input').each(function(){
                    $(this).val('');

                });
            }
            var row;
            $(document).on('click','#updateBtn',function(){
                row=$(this).closest('tr');
                var id=parseInt(row.find('td:eq(0)').text());
                var topic=row.find('td:eq(0)').text();
                
                window.top.location='editLesson.php?subject='+topic;
            });


            $(document).on('click','#deleteBtn',function(){
                row=$(this).closest('tr');
                var id=parseInt(row.find('td:eq(0)').text());
                var topic=row.find('td:eq(0)').text();
                var ln=row.find('td:eq(2)') .text();
                
                $('#deleteLesson').val(topic);


            });
            
            
            $('.topic').click(function(){
                $(this).addClass("btnHoverActive");
            });
        });
    </script>
</body>
</html>
