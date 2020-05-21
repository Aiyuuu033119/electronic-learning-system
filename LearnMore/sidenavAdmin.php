
            <div class="col l2 nav1 transition" style="padding-left: 0px;padding-right: 0px;position: fixed;z-index: 1;height: 100%;">
                <nav class="grey darken-3" style="border-right: 2px solid white;">
                    <div class="col l12 ">
                        <a href="admin.php" class="brand-logo center web-title"><b>Learn<span class=" black-text">more</b></span></a>
                        <a href="admin.html" class="brand-logo center web-logo hide" style="font-family: 'Paytone One', sans-serif;font-size: 25px;background: linear-gradient(to right,#ff3d00 35%, #ffea00 65%);-webkit-background-clip: text;-webkit-text-fill-color: transparent;-webkit-text-stroke: 1px transparent;"><b>LM</a>
                    </div>
                </nav>
                <div class="col l12 side-bar-containe grey darken-3" style="height: 90%;border-right: 2px solid white;">
                    <br><br><br><br>

                    <div id="admin" class="col l12 adminHover <?php if($adminpage=='admin'){echo 'adminClick';} ?>" style="padding:5px 0px;margin-top: 5px;">
                        <div class="col l2 side-bar-wrapper" style="padding-left: 0px;margin-left: 0px;padding-right: 0px;">
                            <div class="col l12 center ">
                                <a style="font-size: 22px;" class=""><i class="fas fa-chart-area"></i></a>
                            </div>
                        </div>
                        <div class="col l8 text visible">
                            <div class="col l12 ">
                                <a style="font-size: 22px;" class="left ">DASHBOARD</a>
                            </div>
                        </div>
                    </div>
                    <div id="report" class="col l12 adminHover <?php if($adminpage=='report'){echo 'adminClick';} ?>" style="padding:5px 0px;margin-top: 5px;">
                        <div class="col l2 side-bar-wrapper" style="padding-left: 0px;margin-left: 0px;padding-right: 0px;">
                            <div class="col l12 center ">
                                <a style="font-size: 22px;" class=""><i class="fas fa-table"></i></a>
                            </div>
                        </div>
                        <div class="col l8 text visible">
                            <div class="col l12 ">
                                <a style="font-size: 22px;" class="left">REPORTS</a>
                            </div>
                        </div>
                    </div>
                    
                    <div id="profile" class="col l12 adminHover <?php if($adminpage=='profile'){echo 'adminClick';} ?>" style="padding:5px 0px;margin-top: 5px;">
                        <div class="col l2 side-bar-wrapper" style="padding-left: 0px;margin-left: 0px;padding-right: 0px;">
                            <div class="col l12 center ">
                                <a style="font-size: 22px;" class=""><i class="fas fa-user"></i></a>
                            </div>
                        </div>
                        <div class="col l8 text visible">
                            <div class="col l12 ">
                                <a style="font-size: 22px;" class="left">ADMIN</a>
                            </div>
                        </div>
                    </div>
                    <div id="setting" class="col l12 adminHover <?php if($adminpage=='setting'){echo 'adminClick';} ?>" style="padding:5px 0px;margin-top: 5px;">
                        <div class="col l2 side-bar-wrapper" style="padding-left: 0px;margin-left: 0px;padding-right: 0px;">
                            <div class="col l12 center ">
                                <a style="font-size: 22px;" class=""><i class="fas fa-cog"></i></a>
                            </div>
                        </div>
                        <div class="col l8 text visible">
                            <div class="col l12 ">
                                <a style="font-size: 22px;" class="left ">SETTING</a>
                            </div>
                        </div>
                    </div>
                    <div id="logout" class="col l12 adminHover <?php if($adminpage=='topic'){echo 'adminClick';} ?>" style="padding:5px 0px;margin-top: 5px;">
                        <div class="col l2 side-bar-wrapper" style="padding-left: 0px;margin-left: 0px;padding-right: 0px;">
                            <div class="col l12 center ">
                                <a style="font-size: 22px;"><i class="fas fa-power-off"></i></a>
                            </div>
                        </div>
                        <div class="col l8 text visible">
                            <div class="col l12 ">
                                <a style="font-size: 22px;" class="left">LOGOUT</a>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        
            <script src="jquery/jquery-3.4.1.min.js "></script>
            <script>
                <?php
                    $retrive=mysqli_query($conn,"SELECT * FROM tbl_account WHERE user='".$_SESSION['admin']."'");
                    $fetch=mysqli_fetch_array($retrive);
                ?>
                $('#admin').click(function(){
                    window.top.location="admin.php";
                });
                $('#report').click(function(){
                    window.top.location="reportAdmin.php";
                });
                $('#profile').click(function(){
                    window.top.location="profileAdmin.php?id=<?php echo $fetch['accID'] ?>";
                });
                $('#setting').click(function(){
                    window.top.location="setting.php?id=<?php echo $fetch['accID'] ?>";
                });
                $('#logout').click(function(){
                    window.top.location="admin.php?logout=true";
                });
            </script>
