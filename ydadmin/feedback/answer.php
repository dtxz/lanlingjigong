<?php
require_once("../include/conn.php");
require_once("permit.php");
$typeid=isset($_GET['typeid'])?$_GET['typeid']:0;
$page=isset($_GET['page'])?$_GET['page']:1;
$typename=$guest->get_typename($typeid);
$answercontent="";
$sql="select * from `".PRE."feedback` where `id`=".$func->safe_check($_GET['id'],0);
		$rs=$db->query($sql);
		while($row=$db->fetch_array($rs)){
			$id=$row["id"];
			$answercontent=$row["answercontent"];
			$pageshow=$row["pageshow"];
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../skins/css/main.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../scripts/listcommon2.js" ></script>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="td_content"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="36"><div id="NavTitle">⊙当前位置：系统设置-&gt;<?php echo $typename;?>-&gt;回复留言</div></td>
      </tr>
    </table>
      <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="lrbtline">
        <tr>
          <td height="24" colspan="2" valign="top" class="lrbtlineHead">留言回复</td>
        </tr>
        <form action="answersave.php" method="post">
          <tr>
            <td width="11%" height="87" align="right" valign="top">回复内容：</td>
            <td width="89%" valign="middle"><textarea name="answercontent" id="answercontent" cols="80" rows="15"><?php echo $answercontent;?></textarea></td>
          </tr>
          <tr>
            <td height="41" valign="top">&nbsp;</td>
            <td valign="top"><input name="pageshow" type="checkbox" id="pageshow" value="1"  <?php if ($pageshow==1){echo "checked";}?>/>
前台显示</td>
          </tr>
          <tr>
            <td height="41" valign="top">&nbsp;</td>
            <td valign="top"><input type="submit" name="Submit" value="提交"  class="button"/>
                <input  type="hidden" name="id" value="<?php echo $id;?>" />
				<input  type="hidden" name="typeid" value="<?php echo $typeid;?>" />
				<input  type="hidden" name="page" value="<?php echo $page;?>" />
				
								</td>
          </tr>
        </form>
    </table></td>
  </tr>
</table>
<?php  $func->getmicrotime();?>	
</body>
</html>

