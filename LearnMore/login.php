<?php
    session_start();

    if(isset($_SESSION['student'])){
        header('Location:classStudent.php');
    }

    if(isset($_SESSION['teacher'])){
        header('Location:classTeacher.php');
    }

    if(isset($_SESSION['admin'])){
        header('Location:classTeacher.php');
    }

    require_once('process.php');
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        $myphp=new myphp();
        $myphp->login();
        exit();
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>Learnmore</title>
	<link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="materialize2.0/css/materialize.css">
    <link rel="icon" href="icon/icon.png" type="image/x-icon">
</head>
<body class="bgbody">
	<div class="row">
        <div class="col l4 push-l4"><br><br><br><br><br>
            <div class="card grey darken-4 bgCard">
                <div class="card-content">
                    <div class="row">
                        <div class="col l12">
                            <h6 class="center white-text fontStyle"><b>Learn<span class="black-text">more</b></span></h6>
                        </div>
                        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" id="myform">
                            <div class="input-field border-radius">
                                <div class="col l12 "><br>
                                    <input type="text" name="user" id="" placeholder="Username" class="center border-radius border-color white-text" >
                                </div>
                            </div>
                            <div class="input-field border-radius">
                                <div class="col l12 "><br>
                                    <input type="password" name="pass" id="" placeholder="Password" class="center border-radius border-color white-text" >
                                </div>
                            </div>
                                <div class="col l12 center"><br>
                                    <button id="submit" name="login" class="waves-effect waves-light btn-large light-blue darken-3 btnModifySizeAdd">Login</button>
                                </div>
                        </form>
                        <div class="col l12 center"><br>
                            <a href="typeUser.php" class=" white-text">Create account now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="jquery/jquery-3.4.1.min.js"></script>
    <script src="materialize2.0/js/materialize.js"></script>
    <script>
        $(document).ready(function() {
            $('#submit').click(function() {

                var data = $('#myform :input').serializeArray();

                $.ajax({
                    type:'post',
                    url:$('#myform').attr("action"),
                    data:data,
                    success:function(log){
                        if(log==='fail'){
                            alert('Invalid username or password! \n Please check your username and password carefully');
                            clearInput();
                        }
                        else if(log==='student'){
                            window.location.replace('classStudent.php');
                        }
                        else if(log==='teacher'){  
                            window.location.replace('classTeacher.php');
                        }
                        else if(log==='admin'){  
                            window.location.replace('admin.php');
                        }
                        else if(log==='error'){
                            alert('This account does not existed!');
                            clearInput();
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
                $('#taken').remove();

                });
            }
        });
    </script>
</body>
</html>