<?php
    require_once('process.php');
    if ($_SERVER['REQUEST_METHOD']=='POST') {
        $myphp=new myphp();
        $myphp->teacherAcc();
        exit();
    }
    
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Learnmore</title>
        <link rel="icon" href="icon/icon.png" type="image/x-icon">
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="materialize2.0/css/materialize.css">
    </head>

    <body class="bgbody">
        <div class="row">
            <div class="col l6 push-l3"><br><br><br>
                <div class="card grey darken-4 bgCard">
                    <div class="col l12">
                        <br>
                        <h6 class="center white-text fontStyle "><b>Teacher<span class=" amber darken-3 black-text">user</b></span>
                        </h6><br>
                    </div>
                    <div class="card-content">
                        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" id="myform">
                            <div class="row">
                                <div class="input-field border-radius">
                                    <div class="col l6 "><br>
                                        <input type="text" name="fn" placeholder="First Name" class="center border-radius border-color white-text">
                                    </div>
                                    <div class="col l6 "><br>
                                        <input type="text" name="ln"  placeholder="Last Name" class="center border-radius border-color white-text">
                                    </div>
                                    <div class="col l12"><br>
                                        <input type="text" name="email" placeholder="Email" class="center border-radius border-color white-text">
                                    </div>
                                    <div class="col l12 "><br>
                                        <input type="text" name="user" placeholder="Username" class="center border-radius border-color white-text" >
                                        <div id="error" class=""></div>
                                    </div>
                                    <div class="col l6 "><br>
                                        <input type="password" name="pass" placeholder="Password" class="center border-radius border-color white-text">
                                    </div>
                                    <div class="col l6 "><br>
                                        <input type="password" name="conpass" placeholder="Confirm Password" class="center border-radius border-color white-text">
                                    </div>
                                    <div class="col l12 center"><br>
                                        <button id="submit" name="signupTchr" class="waves-effect waves-light btn-large light-blue darken-3 btnModifySizeAdd">Sign Up</button>
                                    </div>
                                </div>
                            </div>
                        </form>
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
                        success:function(info){
                            if(info==='success'){
                                window.location.replace('login.php');
                            }
                            else if(info==='fail'){
                                $('#error').append('<p class="white-text" id="taken"> Username is already taken! </p>');
                            }
                            else if(info==='error'){
                                alert('Please fullfill needed requirements');
                                $('#taken').remove();

                            }
                        }
                    });
                clearInput();
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
    </br>