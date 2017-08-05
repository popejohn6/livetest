<ul class="nav navbar-top-links navbar-right">
                 <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i>  <span style="color:red; " id="count"></span>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <a href="mailunread.php"><span style="color:red;padding-left: 68%;">Clear All </span></a>
                         <span id="mail_count"></span> 
                      
                        
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="mail.php">
                                <strong>Read All Mail</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
        
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
               
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i>  <span style="color:red; " id="countnotys"></span>  <i class="fa fa-caret-down"> </i>


                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                         <a href="notyunread.php"><span style="color:red;padding-left: 75%;">Clear All </span></a>
                       <span id="notification_count"></span>
                        
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="index.php">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                       
                        <img style="width:50px;height:50px;padding-bottom: 0px" alt="<?php echo $row['fname']?>" src="admin/upload/<?php echo $row['image']?>"/> 
                    
                        </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="profile.php"><i class="fa fa-user fa-fw"></i> <?php echo $row['fname']; ?> Profile</a>
                        </li>
                        
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>