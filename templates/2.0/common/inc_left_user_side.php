<?php 
if ($mdata['base']['gradeid']=="1"){
	$pic=$func->getrealpath2($mdata['personal']['pic']);
}elseif ($mdata['base']['gradeid']=="2"){
	$pic=$func->getrealpath2($mdata['company']['companylogo']);
}
?>
<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo $pic;?>" class="img-circle" alt="wolfelove">
            </div>
            <div class="pull-left info">
              <p><?php echo $mdata['base']['username'];?></p>
			  <a href="/user?action=modifypwd">修改密码</a>
              <a href="/user/userdo.php?action=logout">退出登录</a>
            </div>
          </div>
          <ul class="sidebar-menu">
            <li class="header">菜单</li>
			<?php if ($mdata['base']['gradeid']==1){?>
			<li class="treeview active">
              <a href="#">
                <i class="fa fa-files-o" style="background:url(/templates/default/images/mobile/member_person.png); background-position:left; background-repeat:no-repeat;"></i>
                <span>会员管理</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
				<li ><a href="/user?action=baseinfo"><i class="fa fa-circle-o" ></i>我的信息</a></li>
                <!--<li><a href="/user?action=resume"><i class="fa fa-circle-o"></i>我的简历</a></li>-->
				<li><a href="/user?action=jobapply"><i class="fa fa-circle-o"></i>应聘岗位</a></li>
				<?php if ($mdata['personal']['xmmanager']==1){?>
				<li><a href="/user?action=search"><i class="fa fa-circle-o"></i>技工查询</a></li>
				<?php }?>
              </ul>
            </li>
			<?php }elseif ($mdata['base']['gradeid']==2){?>
			<li class="treeview active">
              <a href="#">
                <i  class="fa fa-files-o" style="background:url(/templates/default/images/mobile/member_file.png); background-position:left; background-repeat:no-repeat;"></i>
                <span>企业管理</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
				<li ><a href="/user?action=companyinfo"><i class="fa fa-circle-o"></i>企业信息</a></li>
                <li><a href="/user?action=project"><i class="fa fa-circle-o"></i>项目管理</a></li>
				<li><a href="/user?action=job"><i class="fa fa-circle-o"></i>职位管理</a></li>

              </ul>
            </li>
			<?php }?>
			<li class="treeview active">
              <a href="#">
                <i  class="fa fa-files-o" style="background:url(/templates/default/images/mobile/member_file.png); background-position:left; background-repeat:no-repeat;"></i>
                <span>帮助中心</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
            <li><a href="/plus/list.php?tid=<?php echo $tid_question;?>" target="_blank"><i class="fa fa-circle-o text-red"></i> <span>常见问题</span></a></li>
			<li><a href="/plus/list.php?tid=<?php echo $tid_xszd;?>" target="_blank"><i class="fa fa-circle-o text-yellow"></i> <span>新手指导</span></a></li>
            <li><a href="/plus/list.php?tid=<?php echo $tid_contact;?>" target="_blank"><i class="fa fa-circle-o text-yellow"></i> <span>联系蓝领</span></a></li>
              </ul>
            </li>
 
          </ul>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>