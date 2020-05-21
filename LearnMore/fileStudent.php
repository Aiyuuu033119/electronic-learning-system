<?php
    session_start();
    $page='file';
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
    
    <div id="add" class="modal addLesson grey darken-4">
        <div class="section">
            <p class="center white-text fontStyle"><b>Add<span class=" amber darken-3 black-text">files</b></span></p>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
            <div class="modal-content">
                <div class="input-field white">
                    <input placeholder="Lesson Title" id="modalItm" type="text" class="center  inputAdjust" name="itm">
                </div>
                <div class="section">
                    <div class="row panel"><br>
                        <div class="col l12">
                            <p class="white-text">Sub-Topic</p>
                        </div>
                        <div class="col l12">
                            <div class="input-field white ">
                                <input placeholder="Sub Topic" id="modalPrc" type="text" class="center inputAdjust" name="prc">
                            </div>
                            <div class="file-field input-field">
                                <div class="btn">
                                    <span>File</span>
                                    <input type="file">
                                </div>
                                <div class="file-path-wrapper white">
                                    <input class="file-path validate" type="text" placeholder="Insert images or videos">
                                </div>
                            </div>
                            <div class="input-field white ">
                                <textarea id="" placeholder="Discussion" class="materialize-textarea inputAdjust"></textarea>
                            </div><br>
                        </div>
                    </div>
                    <p class="white-text right">Add Sub-Topic</p>
                </div>
            </div>
            <div class="modal-footer transparent">
                <input type="submit" class="white-text btn-flat " value="Next" name="buy">
                <a href="subjectTeacher.php?code=<?php echo $_GET['code']?>" class="modal-action waves-effect waves-red btn-flat white-text red">Cancel</a>
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
                                    <h3 class="white-text">Library Files</h3>
                                    <?php
                                        $select=mysqli_query($conn,"SELECT tbl_file.fileLoc,tbl_file.names,tbl_file.fileType FROM tbl_class INNER JOIN tbl_file ON tbl_class.classID=tbl_file.classID WHERE tbl_class.code='$code' ORDER BY tbl_file.fileID DESC");
                                        $count=mysqli_num_rows($select);
                                    ?>  
                                    <p class="white-text">Number of files: <?php echo $count?></p>
                                </div>
                            </div>
                            <div class="col l12 autoScroll"><br><br>
                                <?php
                                    $code=$_SESSION['code'];
                                    $retrive=mysqli_query($conn,"SELECT tbl_file.fileLoc,tbl_file.names,tbl_file.fileType FROM tbl_class INNER JOIN tbl_file ON tbl_class.classID=tbl_file.classID WHERE tbl_class.code='$code' ORDER BY tbl_file.fileID DESC");
                                    while($fetch=mysqli_fetch_array($retrive)):
                                        if($fetch['fileType']=="image/png"||$fetch['fileType']=="image/jpeg"||$fetch['fileType']=="image/gif"||$fetch['fileType']=="image/tiff"||$fetch['fileType']=="image/jpg"){
                                ?>
                                            <div class="col l3 subject" >
                                                <div class="card bgCard">
                                                    <div class="card-content center tooltipped" data-tooltip="<?php echo $fetch['names']?>">
                                                        <img src="icon/image.png" class="iconImages">
                                                        <p class="text-wrapper truncate"><b><?php echo $fetch['names']?></b> </p>
                                                        <a href="<?php echo $fetch['fileLoc']?>" download="<?php echo $fetch['names']?>"><i class="fas fa-download blue-text"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                <?php
                                        }
                                        else if($fetch['fileType']=="video/mp4"){
                                ?>
                                            <div class="col l3 subject" >
                                                <div class="card bgCard">
                                                    <div class="card-content center tooltipped" data-tooltip="<?php echo $fetch['names']?>">
                                                        <img src="icon/video.png" class="iconImages">
                                                        <p class="text-wrapper truncate"><b><?php echo $fetch['names']?></b> </p>
                                                        <a href="<?php echo $fetch['fileLoc']?>" download="<?php echo $fetch['names']?>"><i class="fas fa-download blue-text"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                <?php
                                        }
                                        else if($fetch['fileType']=="PDF"){
                                ?>
                                            <div class="col l3 subject" >
                                                <div class="card bgCard">
                                                    <div class="card-content center tooltipped" data-tooltip="<?php echo $fetch['names']?>">
                                                        <img src="icon/pdf.png" class="iconImages">
                                                        <p class="text-wrapper truncate "><b><?php echo $fetch['names']?></b> </p>
                                                        <a href="<?php echo $fetch['fileLoc']?>" download="<?php echo $fetch['names']?>"><i class="fas fa-download blue-text"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                <?php   
                                        }
                                        else if($fetch['fileType']=="Document/Word"){
                                ?>
                                            <div class="col l3 subject" >
                                                <div class="card bgCard">
                                                    <div class="card-content center tooltipped" data-tooltip="<?php echo $fetch['names']?>">
                                                        <img src="icon/word.png" class="iconImages">
                                                        <p class="text-wrapper truncate"><b><?php echo $fetch['names']?></b> </p>
                                                        <a href="<?php echo $fetch['fileLoc']?>" download="<?php echo $fetch['names']?>"><i class="fas fa-download blue-text"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                <?php   
                                        }
                                        else if($fetch['fileType']=="Stylesheet/Excel"){
                                ?>
                                            <div class="col l3 subject" >
                                                <div class="card bgCard">
                                                    <div class="card-content center tooltipped" data-tooltip="<?php echo $fetch['names']?>">
                                                        <img src="icon/excel.png" class="iconImages">
                                                        <p class="text-wrapper truncate"><b><?php echo $fetch['names']?></b> </p>
                                                        <a href="<?php echo $fetch['fileLoc']?>" download="<?php echo $fetch['names']?>"><i class="fas fa-download blue-text"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                <?php   
                                        }
                                        else if($fetch['fileType']=="Presentation/PowerPoint"){
                                ?>
                                            <div class="col l3 subject" >
                                                <div class="card bgCard">
                                                    <div class="card-content center tooltipped" data-tooltip="<?php echo $fetch['names']?>">
                                                        <img src="icon/ppt.png" class="iconImages">
                                                        <p class="text-wrapper truncate"><b><?php echo $fetch['names']?></b> </p>
                                                        <a href="<?php echo $fetch['fileLoc']?>" download="<?php echo $fetch['names']?>"><i class="fas fa-download blue-text"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                <?php   
                                        }
                                        else if($fetch['fileType']=="Publisher"){
                                ?>
                                            <div class="col l3 subject" >
                                                <div class="card bgCard">
                                                    <div class="card-content center tooltipped" data-tooltip="<?php echo $fetch['names']?>">
                                                        <img src="icon/pub.png" class="iconImages">
                                                        <p class="text-wrapper truncate"><b><?php echo $fetch['names']?></b> </p>
                                                        <a href="<?php echo $fetch['fileLoc']?>" download="<?php echo $fetch['names']?>"><i class="fas fa-download blue-text"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                <?php   
                                        }

                                    endwhile;
                                ?>
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
        
        $(document).ready(function(){
            $('.tooltipped').tooltip({
                delay: 50
            });
            
        });
                
    </script>
</body>
</html>