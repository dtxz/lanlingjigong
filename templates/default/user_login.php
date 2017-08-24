
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>会员登陆 | 蓝领技工网</title>
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

<div class="register-box" >
  <div class="register-logo "> <a href="/index.php"><b class="text-yellow">蓝领技工</b></a> </div>
  <div class="register-box-body"  style="height:370px;">
  <p class="login-box-msg">会员登陆</p>
  <form method="post" action="userdo.php" onSubmit="return checklogin(this);">
    <div class="form-group has-feedback">
      <input  class="form-control"  type="text"  name="username"  id="username" value="" placeholder="请输入您的用户名或手机号码"/>
	  </div>
    <div class="form-group has-feedback">
      <input  class="form-control" type="password" name="password" id="password" placeholder="请输入您的密码" value="">
    </div>
 
	    <div class="form-group has-feedback"  align="center">
		<select class="form-control" name="usertype" id="usertype">
		<option value="1">技工会员</option>
		<option value="2">企业会员</option>
		</select>
    </div>
	<div class="form-group has-feedback">
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td width="50%"><input type="text" class="form-control" name="pcode" id="pcode"  placeholder="请输入验证码"  style="text-transform:uppercase;"/></td>
		<td style="padding-left:15px;"><a href="javascript:void(0);"><img src="/public/valide/PageCode.php" onClick="this.src='/public/valide/PageCode.php?act=captcha&'+Math.random();" style="cursor:hand; height:28px;"  title="看不清？点击更换另一个验证码。" border="0" /></a></td>
	  </tr>
	</table> 
	  </div>
	<div class="form-group has-feedback">
      <button type="submit" name="submit" class="btn btn-primary  btn-block btn-flat" value=" 登 录 ">登录</button>
    </div>
 
	<input type="hidden" name="action" id="action" value="login">
  </form>
  
  
  <div class="form-group has-feedback">
    <div class="col-xs-6" style="padding-top:10px">
      <button  type="button" value="注册会员"  class="btn btn-default  btn-flat btn-block" onClick="window.location='/user/register.php';">注册会员</button>
    </div>
    <div class="col-xs-6" style="padding-top:10px">
      <button type="button"  class="btn btn-default  btn-flat btn-block"  onClick="window.location='/user/forgetpwd.php';">忘记密码</button>
    </div>
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
<script>
function checklogin(obj){
	if (obj.username.value==''){
		alert('请输入用户名');
		obj.username.focus();
		return false;
	}
	if (obj.password.value==''){
		alert('请输入登录密码');
		obj.password.focus();
		return false;
	}
	return true;
}
</script>
</body>
</html>
