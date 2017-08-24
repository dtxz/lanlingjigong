
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>会员注册 | 蓝领技工网</title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.5 -->
<link rel="stylesheet" href="<?php echo $templatesdir;?>style/admin/bootstrap/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="<?php echo $templatesdir;?>style/font-awesome/4.5.0/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="<?php echo $templatesdir;?>style/ionicons/2.0.1/css/ionicons.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="<?php echo $templatesdir;?>style/admin/dist/css/AdminLTE.min.css">
<link rel="stylesheet" href="<?php echo $templatesdir;?>style/admin/dist/css/skins/_all-skins.min.css">
<!-- iCheck -->
<link rel="stylesheet" href="<?php echo $templatesdir;?>style/admin/plugins/iCheck/square/blue.css">
<link  type="text/css" rel="stylesheet" href="<?php echo $templatesdir;?>css/layout.css">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<script src="<?php echo $templatesdir;?>js/jquery/jquery-1.9.0.min.js" language="javascript"></script>
<script src="<?php echo $templatesdir;?>js/comm/user_validate.js" language="javascript"></script>
</head>
<body class="hold-transition register-page skin-blue layout-top-nav" style="cursor: default; background-image: url(<?php echo $templatesdir;?>style/new/images/reglogin-bg.jpg);">
<div class="wrapper">
  <header class="main-header" id="user_header">
    <nav class="navbar navbar-static-top"  id="user_nav">
      <div class="container">
        <div class="navbar-header "> <a href="/index.php" class="navbar-brand"><b>蓝领技工</b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" style="background:url(/templates/default/images/mobile/icon_menu.png); background-position:left; background-repeat:no-repeat;"> <i class="fa fa-bars"></i> </button>
        </div>
        
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left"  id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li> <a href="/plus/project.php">施工项目</a> </li>
            <li> <a href="/plus/search.php?action=job">热门工作</a> </li>
            <li> <a href="/plus/search.php?action=resume">技术工人</a> </li>
            <li> <a href="/plus/jnpx.php">技能培训</a> </li>
            <li> <a href="/bbs">蓝领社区</a> </li>
          </ul>
        </div>
        <!-- /.navbar-collapse --> 
        <!-- Navbar Right Menu --> 
        <!-- /.navbar-custom-menu --> 
      </div>
      <!-- /.container-fluid --> 
    </nav>
  </header>
</div>

<div class="register-box"  style="height:450px;">
  <div class="register-logo "> <a href="/index.php"><b class="text-yellow">蓝领技工</b></a> </div>
  <div class="register-box-body">
  <?php if ($usertype==1){?>
  <!--技工会员注册-->
  <div style="display:block;">
   <p class="login-box-msg"><a href="/user/register.php?usertype=1" class="reg">技工会员注册</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/user/register.php?usertype=2">企业会员注册</a></p>
      <form action="/user/userdo.php" method="post"  onSubmit="return checkRegInfo(this,1);">
           <input name="action" type="hidden" id="action" value="register"/>
		    <input name="usertype" type="hidden" id="usertype" value="1"/>
          <div class="form-group has-feedback">
            <input  class="form-control"  type="text"  name="username" id="username" autocomplete="off"  placeholder="请输入您的11位手机号码"  maxlength="11"  onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')"/>
                      
          </div>
 
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" id="password"   autocomplete="off" placeholder="请输入您的密码"/>
            
          </div>
          
 
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password2" id="password2"  autocomplete="off" placeholder="请确认您的密码"/>
   
          </div>
   
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="xingming" id="xingming"   placeholder="请输入您的真实姓名"/>
  
          </div>
  
          <div class="form-group has-feedback" >
            <input type="text" class="form-control" name="sfzno" id="sfzno" placeholder="请输入您的18位身份证号码" maxlength="18"   onkeyup="this.value=this.value.replace(/\D/g,'')" onafterpaste="this.value=this.value.replace(/\D/g,'')"/>
            
          </div>
<!--           <div class="form-group has-feedback" >         
        
            <input type="text" class="form-control" name="email" id="email" placeholder="请输入您的邮箱"  />
           </div>-->
          <div class="form-group has-feedback">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td width="50%"><input type="text" class="form-control" name="pcode" id="pcode"  placeholder="请输入验证码"  style="text-transform:uppercase;"/></td>
			<td style="padding-left:15px;"><a href="javascript:void(0);"><img src="/public/valide/PageCode.php" onClick="this.src='/public/valide/PageCode.php?act=captcha&'+Math.random();" style="cursor:hand; height:28px;"  title="看不清？点击更换另一个验证码。" border="0" /></a></td>
		  </tr>
		</table> 
		  </div>
          <div class="row">
        
            <div class="row col-xs-8 col-xs-offset-2">
              <button type="submit" name="submit" class="btn btn-primary  btn-block btn-flat">立即注册</button> 已是本站会员，立即<a href="login.php">登录</a> 
            </div><!-- /.col -->
          </div>
        </form>
	</div>
  <!--技工会员注册 end-->
  <?php }else if ($usertype==2){?>
  <!--企业会员注册-->
  <div style="display:block;">
   <p class="login-box-msg"><a href="/user/register.php?usertype=1">技工会员注册</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/user/register.php?usertype=2" class="reg">企业会员注册</a></p>
      <form action="/user/userdo.php" method="post"  onSubmit="return checkRegInfo(this,2);">
          <input name="action" type="hidden" id="action" value="register"/>
		 <input name="usertype" type="hidden" id="usertype" value="2"/>
          <div class="form-group has-feedback" >
            <input  class="form-control"  type="text"  name="username" id="username"  autocomplete="off"  placeholder="请输入您的用户名"/>    
          </div>
 
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" id="password"  autocomplete="off" placeholder="请输入您的密码"/>
          </div>
          
 
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password2" id="password2" autocomplete="off" placeholder="请确认您的密码"/>
          </div>
   
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="companyname" id="companyname"  placeholder="请输入您的企业名称"/>
          </div>
  
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="email" id="email"  placeholder="请输入您的企业邮箱"/>
          </div>
                    
          <div class="form-group has-feedback">
          <input type="text" class="form-control" name="teleno" id="teleno"  placeholder="请输入您的联系电话" />
		  </div>
          <div class="form-group has-feedback">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td width="50%"><input type="text" class="form-control" name="pcode" id="pcode"  placeholder="请输入验证码"  style="text-transform:uppercase;"/></td>
			<td style="padding-left:15px;"><a href="javascript:void(0);"><img src="/public/valide/PageCode.php" onClick="this.src='/public/valide/PageCode.php?act=captcha&'+Math.random();" style="cursor:hand; height:28px;"  title="看不清？点击更换另一个验证码。" border="0" /></a></td>
		  </tr>
		</table> 
		  </div>          
          
          <div class="row">
            <div class="row col-xs-8 col-xs-offset-2" align="center">
            <button type="submit" name="submit" class="btn btn-primary  btn-block btn-flat">立即注册</button> 已是本站会员，立即<a href="login.php">登录</a>
			</div>
            <!-- /.col -->
          </div>
        </form>
	</div>
	<!--企业会员注册 end -->
	<?php }?>
  </div>
</div>
<!-- /.form-box -->
</div>
<!-- /.register-box --> 
<script src="<?php echo $templatesdir;?>style/admin/plugins/jQuery/jQuery-2.1.4.min.js"></script> 
<!-- Bootstrap 3.3.5 --> 
<script src="<?php echo $templatesdir;?>style/admin/bootstrap/js/bootstrap.min.js"></script> 
<!-- iCheck --> 
<script src="<?php echo $templatesdir;?>style/admin/plugins/iCheck/icheck.min.js"></script> 

</body>
</html>
