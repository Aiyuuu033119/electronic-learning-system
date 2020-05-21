<?php
    session_start();
    require_once('process.php');
    include('connection.php');
    
    if ($_SERVER['REQUEST_METHOD']=='POST'&&isset($_POST['addInfo'])) {
        $myphp=new myphp();
        $myphp->addInfo();
        exit();
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="materialize2.0/css/materialize.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
</head>

<body>
<script src="jquery/jquery-3.4.1.min.js"></script>

    <!-- BODY -->
    <div class="section">
        <div class="row ">
            <div class="col l6 push-l3"><br>
                <div class="card grey darken-4 bgCard1">
                    <div class="content">
                        <div class="row">
                            <br>
                            <div class="col l12">
                                <p class="center white-text fontStyle"><b>About<span class=" amber darken-3 black-text">me</b></span></p>
                            </div>
                            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" id="myform">
                                <div class="col l12">
                                    <div class="section">
                                        <div class="row"><br>
                                            
                                            <!--DISPLAY SUB-TOPIC -->
                                            <div class="col l12" id="topic">
                                                <div class="row panel" id="num1"><br>
                                                    <div class="col l12">
                                                        <div class="row">
                                                            <div class="col l12" id="displayType1">
                                                                <div class="input-field border-radius">
                                                                    <input placeholder="Gender" type="text" class="center inputAdjust border-radius border-color white-text" name="gender" id="gender">
                                                                </div>
                                                                <span class="wrong"></span>
                                                                <br>
                                                                <div class="input-field border-radius">
                                                                    <input placeholder="Birthday" type="text" class="datepicker center inputAdjust border-radius border-color white-text" name="bday" id="city">
                                                                </div><br>
                                                                <div class="input-field border-radius">
                                                                    <input placeholder="City" type="text" class="center inputAdjust border-radius border-color white-text" name="city">
                                                                </div><br>
                                                                <div class="input-field border-radius">
                                                                    <input placeholder="School" type="text" class="center inputAdjust border-radius border-color white-text" name="school">
                                                                </div><br>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col l12 center">
                                    <button id="addInfo" name="addInfo" class="go waves-effect waves-light btn light-blue darken-3 btnModifySizeAdd">Finish</button>
                                    <a href="profile.php" class=" waves-effect waves-red btn-flat white-text red">Cancel</a>
                                </div>
                            </form>
                            <div class="col l12" ><br><br></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="materialize2.0/js/materialize.js"></script>
    <script src="main.js"></script>
    <script>
        $(document).ready(function(){
            $('.datepicker').pickadate({
                selectYears:100,
            });
            
            
        });

        // $(document).on('keyup','#gender',function(){
        //     var type=$(this).val();
        //     if(type!='F'&&type!='M'&&type!='Fe'&&type!='Ma'&&type!='Fem'&&type!='Mal'&&type!='Fema'&&type!='Male'&&type!='Femal'&&type!='m'&&type!='Female'&&type!='ma'&&type!='f'&&type!='mal'&&type!='fe'&&type!='male'&&type!='fem'&&type!='fema'&&type!='femal'&&type!='female'){
        //         $('.wrong').text('wrong');
        //         $('#gender').css({
        //             'border':'2px solid #f44336 ',
        //         });
        //         $('#addInfo').attr('disabled',true);
        //     }
        //     else{
        //         $('#gender').css({
        //             'border':'2px solid #f39e1f',
        //         });
        //         $('#addInfo').removeAttr('disabled');
        //         $('.wrong').text('');
        //     }
        // });

    </script>
</body>
</html>