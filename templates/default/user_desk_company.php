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
                      <b>会员级别</b> <a class="pull-right" style="padding-right:15px;"><?php if ($mdata['base']['gradeid']==1){echo "个人会员";}elseif ($mdata['base']['gradeid']==2){echo "企业会员";}?></a>
                    </li>
                    <li class="list-group-item">
                      <b>企业名称</b> <a class="pull-right" style="padding-right:15px;"><?php echo $mdata['company']['companyname'];?></a>
                    </li>
                    <li class="list-group-item">
                      <b>认证状态</b> <a class="pull-right" style="padding-right:15px;"><?php echo ($mdata['base']['ischeck']==1)?'已认证':'<font color=red>未通过认证</font>';?></a>
                    </li> 
					 <li class="list-group-item">
                      <b>企业类型</b> <a class="pull-right" style="padding-right:15px;"><?php echo $mdata['company']['companytype'];?></a>
                    </li>
					<li class="list-group-item">
                      <b>成立时间</b> <a class="pull-right" style="padding-right:15px;"><?php echo $mdata['company']['setupdate'];?></a>
                    </li>
                    <li class="list-group-item">
                      <b>员工人数</b> <a class="pull-right" style="padding-right:15px;"><?php echo $mdata['company']['employeenum'];?></a>
                    </li>
                    <li class="list-group-item">
                      <b>所在地点</b> <a class="pull-right" style="padding-right:15px;"><?php echo $mdata['company']['place'];?></a>
                    </li>					
                    <li class="list-group-item">
                      <b>联系电话</b> <a class="pull-right" style="padding-right:15px;"><?php echo $mdata['company']['teleno'];?></a>
                    </li>						
                    <li class="list-group-item">
                      <b>传真号码</b> <a class="pull-right" style="padding-right:15px;"><?php echo $mdata['company']['fax'];?></a>
                    </li>	
                    <li class="list-group-item">
                      <b>联系地址</b> <a class="pull-right" style="padding-right:15px;"><?php echo $mdata['company']['address'];?></a>
                    </li>						
                    <li class="list-group-item">
                      <b>邮政编码</b> <a class="pull-right" style="padding-right:15px;"><?php echo $mdata['company']['postcode'];?></a>
                    </li>
                    <li class="list-group-item">
                      <b>企业网址</b> <a class="pull-right" style="padding-right:15px;"><?php echo $mdata['company']['http'];?></a>
                    </li>	
                    <li class="list-group-item">
                      <b>电子邮箱</b> <a class="pull-right" style="padding-right:15px;"><?php echo $mdata['company']['email'];?></a>
                    </li>					
																				
                    <li class="list-group-item">
                      <b>上次登录</b> <a class="pull-right" style="padding-right:15px;"><?php echo $mdata['base']['lastlogintime'];?></a>
                    </li>
                                        <li class="list-group-item">
                      <b>注册时间</b> <a class="pull-right" style="padding-right:15px;"><?php echo $mdata['base']['addtime'];?></a>
                    </li>
                  </ul>
				  <button class="btn btn-block btn-info btn-lg btn-block"  type="button" name="submit" value=" 修改资料 " onclick="window.location='/user/?action=companyinfo';"> 修改企业资料 </button>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
 
            </div>