<?php 
if ($mdata['base']['gradeid']=="1"){
	$pic=$func->getrealpath2($mdata['personal']['pic']);
}elseif ($mdata['base']['gradeid']=="2"){
	$pic=$func->getrealpath2($mdata['company']['companylogo']);
}
?>
      <header class="main-header"  id="user_header">
 
        <!-- Logo -->
        <a href="/user" class="logo hidden-xs">
          <span class="logo-mini"><b>管理中心</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>管理中心</b></span>
        </a>
 
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation"   id="user_nav">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button" style="background:url(/templates/default/images/mobile/member_menu2.png); background-position:left; background-repeat:no-repeat;">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo $pic;?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $mdata['base']['username'];?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?php echo $pic;?>" class="img-circle" alt="<?php echo $mdata['base']['username'];?>">
                    <p>
                      <?php echo $mdata['base']['username'];?>
                    </p>
                  </li>

                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-right">
                      <a href="/user/userdo.php?action=logout" class="btn btn-default btn-flat">退出登陆</a>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                <a href="/index.php" target="_blank"><i class="fa fa-fw fa-home"  style="background:url(/templates/default/images/mobile/member_home.png); background-position:left; background-repeat:no-repeat;"></i></a>
              </li>
            </ul>
          </div>
        </nav>
      </header> 