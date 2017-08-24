<?php 
if ($mdata['base']['gradeid']=="1"){
	$pic=$func->getrealpath2($mdata['personal']['pic']);
}elseif ($mdata['base']['gradeid']=="2"){
	$pic=$func->getrealpath2($mdata['company']['companylogo']);
}
?>
<div class="col-md-6"  style="width:100%;">
              <!-- Profile Image -->
              <div class="box box-primary">
                <div class="box-body box-profile">
                  <img class="profile-user-img img-responsive img-circle" src="<?php echo $pic;?>">
                  <h3 class="profile-username text-center"><?php echo $mdata['base']['username'];?></h3>
                  <p class="text-muted text-center"><?php if ($mdata['base']['gradeid']==1){echo "个人会员";}elseif ($mdata['base']['gradeid']==2){echo "企业会员";}?></p>
<ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                      <b>会员名</b> <a class="pull-right" style="padding-right:15px;"><?php echo $mdata['base']['username'];?></a>
                    </li>
                    <li class="list-group-item">
                      <b>姓名</b> <a class="pull-right" style="padding-right:15px;"><?php echo $mdata['personal']['xingming'];?></a>
                    </li>
					
                    <li class="list-group-item">
                      <b>会员级别</b> <a class="pull-right" style="padding-right:15px;"><?php if ($mdata['base']['gradeid']==1){echo "个人会员";}elseif ($mdata['base']['gradeid']==2){echo "企业会员";}?></a>
                    </li>
<!--					
					 <li class="list-group-item">
                      <b>所属企业</b> <a class="pull-right" style="padding-right:15px;">德阳中安劳务有限公司</a>
                    </li>
					<li class="list-group-item">
                      <b>所属项目</b> <a class="pull-right" style="padding-right:15px;">绵阳化工厂项目</a>
                    </li>
                    <li class="list-group-item">
                      <b>是否项目经理</b> <a class="pull-right" style="padding-right:15px;">是</a>
                    </li>-->
                    <li class="list-group-item">
                      <b>上次登录</b> <a class="pull-right" style="padding-right:15px;"><?php echo $mdata['base']['lastlogintime'];?></a>
                    </li>
                                        <li class="list-group-item">
                      <b>注册时间</b> <a class="pull-right" style="padding-right:15px;"><?php echo $mdata['base']['addtime'];?></a>
                    </li>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              <!-- About Me Box -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">信息认证</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <p>
                  <a href="#" class="btn  btn-default btn-flat btn-sm">实名</a> <a href="#" class="btn  btn-default btn-flat btn-sm">手机</a>
                  </p>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>