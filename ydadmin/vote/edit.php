<?php
require_once("../include/conn.php");
require_once("permit.php");
if ($_GET['item_id']!=""){
$sql="select * from `".PRE."vote_item` where `item_id`=".$func->safe_check($_GET['item_id'],0);
		$rs=$db->query($sql);
		while($row=$db->fetch_array($rs)){
			$item_id=$row["item_id"];
			$vote_id=$row["vote_id"];
			$item_name=$row["item_name"];
			$item_logo=$row["item_logo"];
			$vote_num=$row["vote_num"];
		}
	}
if ($vote_num==""){$vote_num=0;}
if ($vote_id==""){$vote_id=$_GET["vote_id"];}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../skins/css/main.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../scripts/listcommon2.js" ></script>
<script type="text/javascript" src="../scripts/public.js"></script>
<script type="text/javascript" src="../scripts/ajax.js"></script>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="td_content"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td height="36"><div id="NavTitle">⊙当前位置：系统设置-&gt;投票管理-&gt;选项编辑</div></td>
      </tr>
    </table>
	
      <table width="100%" border="0" align="center" cellpadding="4" cellspacing="0" class="lrbtline">
        <tr>
          <td height="24" colspan="2" valign="top" class="lrbtlineHead">编辑选项</td>
        </tr>
        <form action="editsave.php" method="post">
          <tr>
            <td width="20%" height="26" align="right" valign="top">选项名称：</td>
            <td width="80%" valign="middle"><input name="item_name" type="text" id="item_name" value="<?php echo $item_name;?>"/></td>
          </tr>
<!--          <tr>
            <td height="26" align="right" valign="top">选票图片：</td>
            <td valign="middle"><input name="item_pic" type="text" id="item_pic" value="<?php //echo $item_logo;?>"/> <input name="button" type="button" class="button" onclick="javascript:openScript('../../public/upload/up.php?upath=votelogo&rcolumname=item_pic&iscreatesmall=false',460,220);" value="上传" />
              (图片规格：120*50像素)</td>
          </tr> -->
          <tr>
            <td height="26" align="right" valign="top">投票数量：</td>
            <td valign="middle"><input name="vote_num" type="text" id="vote_num" value="<?php echo $vote_num;?>"/></td>
          </tr>
          <tr>
            <td height="41" valign="top">&nbsp;</td>
            <td valign="top"><input type="submit" name="Submit" value="提交保存"  class="button"/>
                <input  type="hidden" name="item_id" value="<?php echo $item_id;?>" />
                <input  type="hidden" name="vote_id" value="<?php echo $vote_id;?>" />
                <input type="button" name="Submit2" value="返回"  onclick="window.location='list.php';" class="button"/></td>
          </tr>
        </form>
      </table></td>
  </tr>
</table>
<?php  $func->getmicrotime();?>
</body>
</html>

