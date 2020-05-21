<?php
    session_start();
    require_once('process.php');
    $page='file';
    if(!isset($_SESSION['teacher'])){
        header('location:login.php');        
    }
    if ($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['addFiles'])) {
        $myphp=new myphp();
        $myphp->addFiles();
        exit();
    }
    if ($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['deleteFile'])) {
        $myphp=new myphp();
        $myphp->deleteFile();
        exit();
    }
    if ($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['updateFile'])) {
        $myphp=new myphp();
        $myphp->updateFile();
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
    
    <div id="add" class="modal popup3 grey darken-4">
        <div class="section">
            <p class="center white-text fontStyle"><b>Learn<span class=" black-text">more</b></span></p>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">
            <div class="modal-content no-padding-bot-top">
                <div class="section no-padding">
                    <div class="row panel"><br>
                        <div class="col l12">
                            <div class="row">
                                <div class="col l12">
                                    <div class="input-field border-radius">
                                        <input placeholder="Name" id="" type="text" class="center inputAdjust border-radius border-color white-text" name="filename">
                                    </div>
                                </div>
                            </div>
                            <div class="col l12" ><br>
                                <div class="row" id="imgFrame">
                                    
                                </div>
                            </div>
                            <div class="col l1 file-field " id="pictureFeild">
                                <div class="btn col l12 transparent">
                                    <span><i class="fas fa-images blue-text"></i></span>
                                    <input type="file" name="picture" class="center" id="picture" accept="image/*">
                                </div>
                            </div>
                            <div class="col l1 file-field " id="videoFeild">
                                <div class="btn col l12 transparent">
                                    <span><i class="fas fa-video red-text"></i></span>
                                    <input type="file" name="video" class="center" id="video" accept="video/*">
                                </div>
                            </div>
                            <div class="col l1 file-field " id="docFeild">
                                <div class="btn col l12 transparent">
                                    <span><i class="fas fa-file orange-text"></i></span>
                                    <input type="file" name="doc" class="center" id="doc" accept=".docx,.pub,.xlsx,.pptx,.pdf,">
                                </div>
                            </div>
                            <div class="col l12"><br></div>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer transparent">
                <input type="submit" class="white-text btn-flat " value="ADD" name="addFiles" id="addFiles">
                <a href="fileTeacher.php?code=<?php echo $_GET['code']?>" class="modal-action waves-effect waves-red btn-flat white-text red">Cancel</a>
            </div>
        </form>
    </div>

    <div id="update" class="modal popup3 grey darken-4">
        <div class="section">
            <p class="center white-text fontStyle"><b>Learn<span class=" amber darken-3 black-text">more</b></span></p>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="section">
                    <div class="row panel"><br>
                        <div class="col l12">
                            <div class="row">
                                <div class="col l12">
                                    <div class="input-field white hide">
                                        <input placeholder="File Name" id="fileLoc" type="text" class="center inputAdjust" name="fileLoc">
                                    </div>
                                    <div class="input-field white hide">
                                        <input placeholder="File Name" id="fileIDS" type="text" class="center inputAdjust" name="fileIDS">
                                    </div>
                                    <div class="col l12">
                                        <p class="white-text center back">Name</p>
                                    </div>
                                    <div class="input-field border-radius">
                                        <input placeholder="File Name" id="editName" type="text" class="center inputAdjust border-radius border-color white-text" name="editName">
                                    </div>
                                </div>
                            </div>
                            <div class="col l12" >
                                <div class="row" id="imgFrame1">
                                    
                                </div>
                            </div>
                            <div class="col l1 file-field " id="editpictureFeild">
                                <div class="btn col l12 transparent">
                                    <span><i class="fas fa-images blue-text"></i></span>
                                    <input type="file" name="editpicture" class="center" id="editpicture" accept="image/*">
                                </div>
                            </div>
                            <div class="col l1 file-field " id="editvideoFeild">
                                <div class="btn col l12 transparent">
                                    <span><i class="fas fa-video red-text"></i></span>
                                    <input type="file" name="editvideo" class="center" id="editvideo" accept="video/*">
                                </div>
                            </div>
                            <div class="col l1 file-field " id="editdocFeild">
                                <div class="btn col l12 transparent">
                                    <span><i class="fas fa-file orange-text"></i></span>
                                    <input type="file" name="editdoc" class="center" id="editdoc" accept=".docx,.pub,.xlsx,.pptx,.pdf,">
                                </div>
                            </div>
                            <div class="col l12"><br></div>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer transparent">
                <input type="submit" class="white-text btn-flat " value="UPDATE" name="updateFile" id="updateFile">
                <a href="fileTeacher.php?code=<?php echo $_GET['code']?>" class=" modal-action waves-effect waves-red btn-flat white-text red">Cancel</a>
            </div>
        </form>
    </div>

    <div id="delete" class="modal popup grey darken-4">
        <div class="section">
            <p class="center white-text fontStyle"><b>Learn<span class=" black-text">more</b></span></p>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
            <div class="modal-content" id="displayTextDelete">
                <p class="center"><i class="fas fa-trash iconType"></i></p>
                <h5 class="white-text center">Are you sure? You want to delete this row?</h5>
                <div class="input-field hide">
                    <input placeholder="First Name..." id="fileID" type="text" class="center black-text inputAdjust" name="fileID">
                </div>
                <div class="input-field hide">
                    <input placeholder="First Name..." id="location" type="text" class="center black-text inputAdjust" name="location">
                </div>
            </div>
            <div class="modal-footer transparent">
                <input type="submit" class="white-text btn-flat" value="Delete" name="deleteFile">
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
                                    <?php
                                        $code=$_SESSION['code'];
                                        $retrive=mysqli_query($conn,"SELECT COUNT(tbl_file.fileID) AS counts FROM tbl_file INNER JOIN tbl_class ON tbl_file.classID=tbl_class.classID WHERE tbl_class.code='$code'");
                                        $fetch=mysqli_fetch_array($retrive)
                                    ?>
                                    <h3 class="white-text">Files Library</h3>
                                    <p class="white-text">Number of files: <?php echo $fetch['counts'];?></p>
                                </div>
                            </div>
                            <div class="col l12 ">
                                <a href="#add" class="modal-trigger right waves-effect waves-light btn-large light-blue darken-3 btnModifySizeAdd"><i class="fas fa-plus iconStyle"></i> File</a>
                            </div>
                            <div class="col l10 push-l1"><br><br>
                                <table class=" highlight centered  " id="table">
                                    <thead class="deep-orange white-text" style="border:unset">
                                        <tr>
                                            <th style="width:20%">Name</th>
                                            <th style="width:35%">File Name</th>
                                            <th style="width:15%">File Type</th>
                                            <th style="width:40%">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody id="table" class="resize" style="border-radius: 0 0 25px 25px;border-bottom: 4px solid #ff5722;border-left: 4px solid #ff5722 ;border-right: 4px solid #ff5722 ;">
                                        <?php
                                            $retrive=mysqli_query($conn,"SELECT tbl_file.names,tbl_file.fileLoc,tbl_file.fileID,tbl_file.fileNames,tbl_file.fileType FROM tbl_file INNER JOIN tbl_class ON tbl_file.classID=tbl_class.classID WHERE tbl_class.code='$code' ORDER BY tbl_file.fileID DESC");
                                            while($fetch=mysqli_fetch_array($retrive)):
                                        ?>
                                        <tr class="textColor">
                                            <td class="white-text no-paddingTbl" style="width:20%"><b><?php echo $fetch['fileNames']?></b></td>
                                            <td class="white-text no-paddingTbl tooltipped " style="width:35%"  data-tooltip="<?php echo $fetch['names']?>" id="<?php echo $fetch['fileLoc']?>"><span class="truncate"><?php echo $fetch['names']?></span></td>
                                            <td class="white-text no-paddingTbl" style="width:15%" id="<?php echo $fetch['fileType']?>"><?php 
                                                if($fetch['fileType']=='Publisher'){
                                                    echo '<img src="icon/pub.png" class="tblIcon" >';
                                                }
                                                else if($fetch['fileType']=='PDF'){
                                                    echo '<img src="icon/pdf.png" class="tblIcon" >';
                                                }
                                                else if($fetch['fileType']=='Document/Word'){
                                                    echo '<img src="icon/word.png" class="tblIcon" >';
                                                }
                                                else if($fetch['fileType']=='Stylesheet/Excel'){
                                                    echo '<img src="icon/excel.png" class="tblIcon" >';
                                                }
                                                else if($fetch['fileType']=='Presentation/PowerPoint'){
                                                    echo '<img src="icon/ppt.png" class="tblIcon" >';
                                                }
                                                else if($fetch['fileType']=='video/mp4'){
                                                    echo '<img src="icon/video.png" class="tblIcon" >';
                                                }
                                                else if($fetch['fileType']=='image/jpeg'||$fetch['fileType']=='image/jpg'||$fetch['fileType']=='image/png'||$fetch['fileType']=='image/gif'||$fetch['fileType']=='image/tiff'){
                                                    echo '<img src="icon/image.png" class="tblIcon" >';
                                                }
                                            ?></td>
                                            <td class="white-text no-paddingTbl" style="width:40%"> <a href="#update" class="modal-trigger btn light blue updateBtn" id="<?php echo $fetch['fileID']?>"><i class="fas fa-edit iconStyle"></i> edit</a><span> </span><a href="#delete" class="modal-trigger btn red deleteBtn" id="<?php echo $fetch['fileID']?>"><i class="fas fa-trash iconStyle"></i> Delete</a></td>
                                        </tr>
                                        <?php
                                            endwhile;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col l12">
                                <br><br>
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

            $('#addFiles').attr('disabled',true);

            $(document).on('change','#picture',function(){
                if($('div').hasClass('remove')){
                    $('.remove').remove();
                    read(this);
                    var hide1=$('#videoFeild');
                    var hide2=$('#docFeild');
                    var hide3=$('#pictureFeild');
                    click(hide1,hide2,hide3);
                }
                else{
                    read(this);
                    var hide1=$('#videoFeild');
                    var hide2=$('#docFeild');
                    var hide3=$('#pictureFeild');
                    click(hide1,hide2,hide3);

                }
                $('#addFiles').removeAttr('disabled');

            });

            function read(input){
                var length=input.files.length;
                for (let index = 0; index < length; index++) {

                    var read=new FileReader();
                    
                    read.onload = function (e){
                        
                        $('#imgFrame').append('<div class="col l6 push-l3 remove" id="remove'+index+'"><span class="removeBtn button1 col l12 blue center" id="'+index+'" style="padding:10px">REMOVE</span><img src="'+e.target.result+'" class="responsive-img" id="img'+index+'"></div>');
                    };
                    read.readAsDataURL(input.files[index]);
                        
                    
                }
            }

            $(document).on('change','#video',function(){
                
                if($('div').hasClass('remove')){
                    $('.remove').remove();
                    $('.fileName').remove();
                    read1(this);
                    var hide1=$('#videoFeild');
                    var hide2=$('#docFeild');
                    var hide3=$('#pictureFeild');
                    click(hide1,hide2,hide3);
                }
                else{
                    read1(this);
                    var hide1=$('#videoFeild');
                    var hide2=$('#docFeild');
                    var hide3=$('#pictureFeild');
                    click(hide1,hide2,hide3);
                }
                $('#addFiles').removeAttr('disabled');
            });

            function read1(input){
                var length=input.files.length;
                for (let index = 0; index < length; index++) {

                    var read=new FileReader();
                    
                    read.onload = function (e){
                        
                        $('#imgFrame').append('<div class="col l6 push-l3 remove no-padding" id="remove'+index+'" ><span class="removeBtn button1 center col l12 blue" id="'+index+'" style="padding:10px">REMOVE</span><video class="responsive-video" id="img'+index+'"><source src="'+e.target.result+'"></video></div>');
                    };
                    read.readAsDataURL(input.files[index]);
                        
                    
                }
            }

            $(document).on('change','#doc',function(){
                
                if($('div').hasClass('remove')){
                    $('.remove').remove();
                    $('.fileName').remove();
                    read2(this);
                    var hide1=$('#videoFeild');
                    var hide2=$('#docFeild');
                    var hide3=$('#pictureFeild');
                    click(hide1,hide2,hide3);
                    $('#addFiles').removeAttr('disabled');
                }
                else{
                    read2(this);
                    

                }
                
            });

            function read2(input){
                var length=input.files.length;
                var file=input.files[0].name;
                var type=input.files[0].type;

                var filetype= /(.*?)\.(docx|pub|xlsx|pptx|pdf)$/;
                if(file.match(filetype)){
                    switch (type) {
                        case 'application/pdf':{
                            $src='icon/pdf.png';
                            onloadImg(input,length,file,$src);
                            break;
                        }
                        case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':{
                            $src='icon/word.png';
                            onloadImg(input,length,file,$src);
                            break;
                        }
                        case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':{
                            $src='icon/excel.png';
                            onloadImg(input,length,file,$src);
                            break;
                        }
                        case 'application/vnd.openxmlformats-officedocument.presentationml.presentation':{
                            $src='icon/ppt.png';
                            onloadImg(input,length,file,$src);
                            break;
                        }
                        case 'application/vnd.ms-publisher':{
                            $src='icon/pub.png';
                            onloadImg(input,length,file,$src);
                            break;
                        }
                        default:
                            break;
                    }
                    var hide1=$('#videoFeild');
                    var hide2=$('#docFeild');
                    var hide3=$('#pictureFeild');
                    click(hide1,hide2,hide3);
                    $('#addFiles').removeAttr('disabled');
                }
                else{
                    alert('Error');
                    $('#doc').val('');
                    var hide1=$('#videoFeild');
                    var hide2=$('#docFeild');
                    var hide3=$('#pictureFeild');
                    unclick(hide1,hide2,hide3);
                }
                
            }

            function onloadImg(input,length,file,src){
                for (let index = 0; index < length; index++) {

                    var read=new FileReader();

                    read.onload = function (e){

                        $('#imgFrame').append('<div class="col l4 push-l4 remove" id="remove'+index+'"><span class="removeBtn button1 center col l12 blue" id="'+index+'" style="padding:10px; border-radius:20px 20px 0 0">REMOVE</span><img src="'+src+'" style="border-radius:0 0 20px 20px ;border:2px solid white; padding:20px" class="responsive-img white" id="img'+index+'"></div><div class="col l12 center fileName'+index+' fileName"><br><h5 class="white-text">'+file+'</h5></div>');
                    };
                    read.readAsDataURL(input.files[index]);

                }
            }



            $(document).on('click','.button1',function(){
                var id=$(this).attr('id');
                $('#remove'+id).remove();
                $('#picture').val('');
                $('#video').val('');
                $('#doc').val('');
                $('.fileName'+id).remove();

                var hide1=$('#videoFeild');
                var hide2=$('#docFeild');
                var hide3=$('#pictureFeild');
                unclick(hide1,hide2,hide3);

                $('#addFiles').attr('disabled',true);
            });

            function click(med1,med2,med3){
                
                $(med1).css({
                    'display':'none '
                });
                $(med2).css({
                    'display':'none '
                });
                $(med3).css({
                    'display':'none '
                });
            }

            function unclick(med1,med2,med3){
                $(med1).css({
                    'display':'unset'
                });
                $(med2).css({
                    'display':'unset'
                });
                $(med3).css({
                    'display':'unset'
                });
            }

            $(document).on('click','.deleteBtn',function(){
                var row=$(this).closest('tr');
                var id=$(this).attr('id');
                var loc=row.find('td:eq(1)') .attr('id');
                
                $('#fileID').val(id);
                $('#location').val(loc);
                //alert(loc);
            });

            $(document).on('click','.updateBtn',function(){
                var row=$(this).closest('tr');
                var id=$(this).attr('id');
                var name=row.find('td:eq(0)').text();
                var files=row.find('td:eq(1)') .text();
                var loc=row.find('td:eq(1)') .attr('id');
                var type=row.find('td:eq(2)') .attr('id');
                
                $('#fileIDS').val(id);
                $('#editName').val(name);
                $('#fileLoc').val(loc);

                $('.remove').remove();
                $('.fileName').remove();
                //alert(type);
                if(type=='image/jpeg'||type=='image/png'||type=='image/jpg'||type=='image/gif'||type=='image/tiff'){
                    $('#imgFrame1').append('<div class="col l6 push-l3 remove" id="remove0"><span class="removeBtn button4 center col l12 blue" id="0" style="padding:10px">REMOVE</span><img src="'+loc+'" class="responsive-img" id="img0"></div>');
                }
                else if(type=='video/mp4'){
                    $('#imgFrame1').append('<div class="col l6 push-l3 remove" id="remove0"><span class="removeBtn button4 center col l12 blue" id="0" style="padding:10px">REMOVE</span><video class="responsive-video" controls id="img0"><source src="'+loc+'"></video></div>');
                }
                else if(type=='PDF'){
                    $('#imgFrame1').append('<div class="col l4 push-l4 remove" id="remove0"><span class="removeBtn button4 center col l12 blue" id="0" style="padding:10px; border-radius:20px 20px 0 0">REMOVE</span><img src="icon/pdf.png" class="responsive-img white" id="img0" style="border-radius:0 0 20px 20px ;border:2px solid white; padding:20px"></div><div class="col l12 center fileName0 fileName"><br><h5 class="white-text">'+files+'</h5></div>');
                }
                else if(type=='Document/Word'){
                    $('#imgFrame1').append('<div class="col l4 push-l4 remove" id="remove0"><span class="removeBtn button4 center col l12 blue" id="0" style="padding:10px; border-radius:20px 20px 0 0">REMOVE</span><img src="icon/word.png" class="responsive-img white" id="img0" style="border-radius:0 0 20px 20px ;border:2px solid white; padding:20px"></div><div class="col l12 center fileName0 fileName"><br><h5 class="white-text">'+files+'</h5></div>');
                }
                else if(type=='Stylesheet/Excel'){
                    $('#imgFrame1').append('<div class="col l4 push-l4 remove" id="remove0"><span class="removeBtn button4 center col l12 blue" id="0" style="padding:10px; border-radius:20px 20px 0 0">REMOVE</span><img src="icon/excel.png" class="responsive-img white" id="img0" style="border-radius:0 0 20px 20px ;border:2px solid white; padding:20px"></div><div class="col l12 center fileName0 fileName"><br><h5 class="white-text">'+files+'</h5></div>');
                }
                else if(type=='Presentation/PowerPoint'){
                    $('#imgFrame1').append('<div class="col l4 push-l4 remove" id="remove0"><span class="removeBtn button4 center col l12 blue" id="0" style="padding:10px; border-radius:20px 20px 0 0">REMOVE</span><img src="icon/ppt.png" class="responsive-img white" id="img0" style="border-radius:0 0 20px 20px ;border:2px solid white; padding:20px"></div><div class="col l12 center fileName0 fileName"><br><h5 class="white-text">'+files+'</h5></div>');
                }
                else if(type=='Publisher'){
                    $('#imgFrame1').append('<div class="col l4 push-l4 remove" id="remove0"><span class="removeBtn button4 center col l12 blue" id="0" style="padding:10px; border-radius:20px 20px 0 0">REMOVE</span><img src="icon/pub.png" class="responsive-img white" id="img0" style="border-radius:0 0 20px 20px ;border:2px solid white; padding:20px"></div><div class="col l12 center fileName0 fileName"><br><h5 class="white-text">'+files+'</h5></div>');
                }
                var hide1=$('#editvideoFeild');
                var hide2=$('#editdocFeild');
                var hide3=$('#editpictureFeild');
                click(hide1,hide2,hide3);

            });
            

            $(document).on('change','#editpicture',function(){
                
                if($('div').hasClass('remove')){
                    $('.remove').remove();
                    $('.fileName').remove();
                    editread(this);
                    var hide1=$('#editvideoFeild');
                    var hide2=$('#editdocFeild');
                    var hide3=$('#editpictureFeild');
                    click(hide1,hide2,hide3);

                    
                }
                else{
                    editread(this);
                    var hide1=$('#editvideoFeild');
                    var hide2=$('#editdocFeild');
                    var hide3=$('#editpictureFeild');
                    click(hide1,hide2,hide3);

                }
                $('#updateFile').removeAttr('disabled');
            });

            function editread(input){
                var length=input.files.length;
                for (let index = 0; index < length; index++) {

                    var read=new FileReader();
                    
                    read.onload = function (e){
                        
                        $('#imgFrame1').append('<div class="col l6 push-l3 remove" id="remove'+index+'"><span class="removeBtn button4 center col l12 blue" id="'+index+'" style="padding:10px">REMOVE</span><img src="'+e.target.result+'" class="responsive-img" id="img'+index+'"></div>');
                    };
                    read.readAsDataURL(input.files[index]);
                        
                    
                }
            }

            $(document).on('click','.button4',function(){
                var id=$(this).attr('id');
                $('#remove'+id).remove();
                $('#editpicture').val('');
                $('#editvideo').val('');
                $('.fileName'+id).remove();
                $('#editdoc').val('');
                $('#updateFile').attr('disabled',true);

                var hide1=$('#editvideoFeild');
                var hide2=$('#editdocFeild');
                var hide3=$('#editpictureFeild');
                unclick(hide1,hide2,hide3);
            });

            $(document).on('change','#editvideo',function(){
                
                if($('div').hasClass('remove')){
                    $('.remove').remove();
                    $('.fileName').remove();
                    editread1(this);
                    var hide1=$('#editvideoFeild');
                    var hide2=$('#editdocFeild');
                    var hide3=$('#editpictureFeild');
                    click(hide1,hide2,hide3);
                }
                else{
                    editread1(this);
                    var hide1=$('#editvideoFeild');
                    var hide2=$('#editdocFeild');
                    var hide3=$('#editpictureFeild');
                    click(hide1,hide2,hide3);

                }
                $('#updateFile').removeAttr('disabled');
            });

            function editread1(input){
                var length=input.files.length;
                for (let index = 0; index < length; index++) {

                    var read=new FileReader();
                    
                    read.onload = function (e){
                        
                        $('#imgFrame1').append('<div class="col l6 push-l3 remove" id="remove'+index+'"><span class="removeBtn button4 center col l12 blue" id="'+index+'" style="padding:10px">REMOVE</span><video class="responsive-video" id="img'+index+'"><source src="'+e.target.result+'"></video></div>');
                    };
                    read.readAsDataURL(input.files[index]);
                        
                    
                }
            }

            $(document).on('change','#editdoc',function(){
                
                if($('div').hasClass('remove')){
                    $('.remove').remove();
                    $('.fileName').remove();
                    editread2(this);
                    var hide1=$('#editvideoFeild');
                    var hide2=$('#editdocFeild');
                    var hide3=$('#editpictureFeild');
                    click(hide1,hide2,hide3);
                    $('#updateFile').removeAttr('disabled');
                }
                else{
                    editread2(this);
                    

                }

            });

            function editread2(input){
                var length=input.files.length;
                var file=input.files[0].name;
                var type=input.files[0].type;

                var filetype= /(.*?)\.(docx|pub|xlsx|pptx|pdf)$/;
                if(file.match(filetype)){
                    switch (type) {
                        case 'application/pdf':{
                            $src='icon/pdf.png';
                            editonloadImg(input,length,file,$src);
                            break;
                        }
                        case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':{
                            $src='icon/word.png';
                            editonloadImg(input,length,file,$src);
                            break;
                        }
                        case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':{
                            $src='icon/excel.png';
                            editonloadImg(input,length,file,$src);
                            break;
                        }
                        case 'application/vnd.openxmlformats-officedocument.presentationml.presentation':{
                            $src='icon/ppt.png';
                            editonloadImg(input,length,file,$src);
                            break;
                        }
                        case 'application/vnd.ms-publisher':{
                            $src='icon/pub.png';
                            editonloadImg(input,length,file,$src);
                            break;
                        }
                        default:
                            break;
                    }
                    var hide1=$('#editvideoFeild');
                    var hide2=$('#editdocFeild');
                    var hide3=$('#editpictureFeild');
                    click(hide1,hide2,hide3);
                    $('#updateFile').removeAttr('disabled');
                }
                else{
                    alert('Error');
                    $('#editdoc').val('');
                    var hide1=$('#editvideoFeild');
                    var hide2=$('#editdocFeild');
                    var hide3=$('#editpictureFeild');
                    unclick(hide1,hide2,hide3);
                }
                
            }

            function editonloadImg(input,length,file,src){
                for (let index = 0; index < length; index++) {

                    var read=new FileReader();

                    read.onload = function (e){

                        $('#imgFrame1').append('<div class="col l4 push-l4 remove" id="remove'+index+'"><span class="removeBtn1 button4 center col l12 blue white-text" id="'+index+'" style="padding:10px; border-radius:20px 20px 0 0">REMOVE</span><img src="'+src+'" class="responsive-img white" id="img'+index+'" style="border-radius:0 0 20px 20px ;border:2px solid white; padding:20px"></div><div class="col col l12 center fileName'+index+' fileName"><br><h5 class="white-text">'+file+'</h5></div>');
                    };
                    read.readAsDataURL(input.files[index]);

                }
            }

        });

    </script>
</body>
</html>