<?php
require_once("../include/conn.php");
require_once("permit.php");
$modelid=isset($_GET['modelid']) ? $_GET['modelid'] :0;
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
        <td height="25">⊙当前位置：系统设置-&gt;模型管理 -&gt; (<?php echo $articelmodel->GetModelName($modelid);?>)模型字段管理</td>
        <td align="right" ><table width="96%" height="38" border="0" align="center" cellpadding="0" cellspacing="0">
 
              <tr>
                <td height="38" align="right"><input type="button" name="Submit2" value="添加字段"  onclick="window.location='model_edit.php?action=add&modelid=<?php echo $modelid;?>';" class="button"/>&nbsp;<input type="button" name="Submit2" value="模型管理"  onclick="window.location='list.php';" class="button"/>
 
        </table></td>
      </tr>
    </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
       <form action="delall.php?page=<?php echo $page2;?>&modelid=<?php echo $modelid;?>" method="post"  name="formdel" id="formdel">
	    <tr>
          <td>
        <?php
	$pagesize=15; //分页数从这里设置。
	$csql="";
	$csql="select * from `".PRE."article_model_column` where `columnname`<>'' and modelid=".$modelid." order by `columnid` asc";
	$articelmodel->ModelColumnlist($csql,$pagesize,$urlparam);
	?>
        <input name="delaid" value="" type="hidden" />
      </td>
        </tr></form>
      </table>
      </td>
  </tr>
</table>
<?php  $func->getmicrotime();?>
</body>
</html>
