     <?php 
        if (empty($MyID)):
    ?>
      <form action="login.php" method="post" class="navbar-form navbar-right" role="form">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" name="User_Username" value="" placeholder="Username">                                        
                        </div>

                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                            <input type="password" class="form-control" name="User_Password" value="" placeholder="Password">                                        
                        </div>
                        <button type="submit" class="btn btn-success">Login</button>
       </form>
    <?php 
        else:
        $MyUser = new user($MyID); 
    ?>
    <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <img src="http://www.abrg.group.shef.ac.uk/people/nopic.png"  class='img-circle pull-left' style="margin-top:-4px;width:30px;height:30px;margin-right: 30px;">
            <?php echo $MyUser->data["Username"];?></a>
        <ul class="dropdown-menu right-drop">
        <li class="dropdown-header">
            <i class="fa fa-bell" aria-hidden="true"></i>
            Activities
        </li>
          <li><a href="profile.php?id=<?php echo $MyID;?>">Profile</a></li>
          <li><a href="#">Messages</a></li>
        <li class="dropdown-header">
        <i class="fa fa-wrench" aria-hidden="true"></i>
        Settings
        </li>
        <li><a href="#">Edit Profile</a></li>
        <li class="divider"></li>
        <li><a href="actions/log-out.php"><i class="fa fa-sign-out"></i> Log out</a></li>
        </ul>

        </li>
    </ul>

    <?php   
    endif;
    ?>
