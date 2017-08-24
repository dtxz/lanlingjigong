<?php
/**
 * Links library
 */
class sysavar{
	
	function sysavar(){}
	
	/**************adver operations*******************************************************************/
	//show list  links
	function avar_list($tmpsql,$pagesize,$arrparam){
		global $db,$func;
		$page2=isset($_GET['page']) ? $_GET['page'] :1;
		$sql=$tmpsql;
		$arr=$func->get_page_num($sql,$pagesize);
		$sql.=" limit $arr[1], $pagesize";
		$rs=$db->query($sql) or die("SQL execution error！");
		
		echo "<table width='100%' border='0' align='center' cellpadding='2' cellspacing='0' class='lrbtline'>";
		echo "		<tr>";
		echo "				<td width='6%' align='center' class='lrbtlineHead'><input name=\"chkall\" type=\"checkbox\" id=\"chkall\" onclick=\"javascript:CheckAll(this.form);\"  style=\"border:0px;\"  title='全选择或者全取消' > <input type=button onclick='javascript:del(this.form);' value='×' title='删除选择项'></td>";
		echo "				<td width='10%' align='center' class='lrbtlineHead'>变量Cn</td>";
		
		echo "				<td width='10%' align='center' class='lrbtlineHead'>变量En</td>";
		echo "				<td width='10%' align='center' class='lrbtlineHead'>变量值</td>";
		echo "				<td width='15%' align='center' class='lrbtlineHead'>变量类别 </td>";
		echo "				<td width='10%' align='center' class='lrbtlineHead'>变量排序</td>";
		echo "				<td  align='center' class='lrbtlineHead'>变量描述</td>";
	
		echo "				<td width='15%' align='center' class='lrbtlineHead'>操作</td>";
		echo "		</tr>";
		
		while($row = $db->fetch_array($rs)){
				$advpic=$row['advpic'];
				$tmppic="";
				if ($advpic!=''){
				    $tmppic="<img src='".$advpic."' bordr=0 height=24>";
				}
				$advurl=$row['advurl'];
				$targeturl=$advurl;	
				echo "		<tr  class='outrow' onMouseOver=\"this.className='onrow';\" onMouseOut=\"this.className='outrow';\">";
				echo "				<td align='center'><input name='id' id='id'  type='checkbox' value='$row[id]' style='border:0px;'></td>";
				echo "				<td align='left'>".$row['var_name_cn']."</td>";
				echo "				<td align='left'>".$row['var_name']."</td>";
				echo "				<td align='center'>".$row['var_value']."</td>";
				echo "				<td align='center'>".$this->getavartypename($row['typeid'])."</td>";	
				echo "				<td align='center'>".$row['sortid']."</td>";		
				echo "				<td align='center'>".$row['description']."</td>";
				echo "				<td align='center'><a href='edit.php?page=".$page2."&action=modify&tid=".$row['typeid']."&id=".$row['id']."&".$arrparam."'><img src='../images/class_update.gif' alt='修改' /> 修改</a&nbsp;><a href='editdo.php?page=".$_GET["page"]."&action=del&id=".$row['id']."&$arrparam'  onclick=\"return configdel();\"><img src='../images/class_del.gif' alt='删除' /> 删除</a> </td>";
				echo "</tr>";
		}
		echo "</table>";
		
		new cmspage($arr[0],$pagesize,$arrparam);
	}

	//add sysavars
	function avar_add() {
		global $db,$func;
		$typeid=intval(($_POST['typeid']));
		$var_name_cn=($_POST['var_name_cn']);	
		$var_name=($_POST['var_name']);	
		$var_value=($_POST['var_value']);	
 		$description=($_POST['description']);
 		$sortid=isset($_POST['sortid'])?$_POST['sortid']:0;
 
		$sql="insert into ".PRE."system_var(typeid,var_name_cn,var_name,var_value,description,sortid) values (".$typeid.",'".$var_name_cn."','".$var_name."','".$var_value."','".$description."','".$sortid."')";

		$db->query($sql) or die("SQL execution error!");
		echo "<script type='text/javascript'> if(confirm('是否要继续添加?')){ window.location.href='edit.php?action=add&tid=0';}else{ window.location.href='list.php';	}</script>";
	}
 
	//modify sysavars
	function avar_update() {
		global $db,$func;
		$typeid=intval(($_POST['typeid']));
		$var_name_cn=($_POST['var_name_cn']);	
		$var_name=($_POST['var_name']);	
		$var_value=($_POST['var_value']);	
 		$description=($_POST['description']);
 		$sortid=isset($_POST['sortid'])?$_POST['sortid']:0;
 
		$act=isset($_POST['act']) ? $_POST['act'] : '';
		$keyword=isset($_POST['keyword']) ? $_POST['keyword'] : '';
		$page=isset($_POST['page']) ? $_POST['page'] :1;
		
		$url="page=".$page."&act=".$act."&keyword=".$keyword."&typeid=".$typeid."&fid=".$fid."";
		
		$sql="update `".PRE."system_var` set `typeid` = ".$typeid.",`var_name_cn` = '".$var_name_cn."',`var_name`='".$var_name."',`var_value`='".$var_value."',`description`='".$description."',`sortid`='".$sortid."' WHERE `id` =".$_GET['id'];	
 
		$db->query($sql) or die("SQL execution error!");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('修改成功！');window.location.href='list.php?$url';</SCRIPT>";
	}

	
	//delete sysavars
	function avar_del() {
		global $db;
		$typeid=isset($_GET['typeid']) ? $_GET['typeid'] : '';
		$act=isset($_GET['act']) ? $_GET['act'] : '';
		$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$page=isset($_GET['page']) ? $_GET['page'] : '';
		
		$url="page=$page&act=$act&keyword=$keyword&typeid=$typeid";
		$sql = "delete from `".PRE."system_var` where `id` in (".$_GET['id'].")";
		$db->query($sql) or die("SQL execution error!");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='list.php?$url';</SCRIPT>";
	}
	
	//multiline delete sysavars
	function avar_delall() {
		global $db;
		$typeid=isset($_GET['typeid']) ? $_GET['typeid'] : '';
		$act=isset($_GET['act']) ? $_GET['act'] : '';
		$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$page=isset($_GET['page']) ? $_GET['page'] : '';
		
		$url="page=$page&act=$act&keyword=$keyword&typeid=$typeid";
		$sql = "delete from `".PRE."system_var` where `id` in (".$_POST['delaid'].")";
 
		$db->query($sql) or die("SQL execution error!");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='list.php?$url';</SCRIPT>";
	}
		
	//get sysavars typename
	function getavartypename($typeid){
		global $db;
		if($typeid!="" &&$typeid!="0"){
			$sql="select typename from `".PRE."system_vartype` where `id`=".intval($typeid);

			$rs=mysql_query($sql) or die ("SQL execution error!");
			$ok=is_array($row=mysql_fetch_array($rs));
			return $row["typename"];
		}	
	}
	/**************sysavarstype operations*******************************************************************/
	
		//show list sysavarstype
	function avartype_list($tmpsql,$pagesize,$arrparam){
		global $db,$func;
		$page2=isset($_GET['page']) ? $_GET['page'] :1;
		$sql=$tmpsql;
		$arr=$func->get_page_num($sql,$pagesize);
		$sql.=" limit $arr[1], $pagesize";
		$rs=$db->query($sql) or die("SQL execution error！");
		
		echo "<table width='100%' border='0' align='center' cellpadding='2' cellspacing='0' class='lrbtline'>";
		echo "		<tr>";
		echo "				<td width='6%' align='center' class='lrbtlineHead'><input name=\"chkall\" type=\"checkbox\" id=\"chkall\" onclick=\"javascript:CheckAll(this.form);\"  style=\"border:0px;\"  title='全选择或者全取消' > <input type=button onclick='javascript:del(this.form);' value='×' title='删除选择项'></td>";
		echo "				<td width='30%' align='center' class='lrbtlineHead'>类别名称</td>";
		echo "				<td width='8%' align='center' class='lrbtlineHead'>排序</td>";
		echo "				<td width='15%' align='center' class='lrbtlineHead'>操作</td>";
		echo "		</tr>";
		
		while($row = $db->fetch_array($rs)){
				echo "		<tr  class='outrow' onMouseOver=\"this.className='onrow';\" onMouseOut=\"this.className='outrow';\">";
				echo "				<td align='center'><input name='id' id='id'  type='checkbox' value='$row[id]' style='border:0px;'></td>";
				echo "				<td>".$row['typename']."</td>";		
				echo "				<td align='center'>".$row['sortid']."</td>";
				echo "				<td align='center'><a href='edit.php?page=".$page2."&action=modify&id=".$row['id']."&".$arrparam."'><img src='../images/class_update.gif' alt='修改' /> 修改</a&nbsp;><a href='editdo.php?page=".$_GET["page"]."&action=del&id=".$row['id']."&$arrparam'  onclick=\"return configdel();\"><img src='../images/class_del.gif' alt='删除' /> 删除</a> </td>";
				echo "</tr>";
		}
		echo "</table>";
		
		new cmspage($arr[0],$pagesize,$arrparam);
	}

	//add sysavarstype
	function avartype_add() {
		global $db,$func;
		$typename=($_POST['typename']);	
		$sortid=($_POST['sortid']);	
 
		$sql="insert into ".PRE."system_vartype (typename,sortid) values ('".$typename."',".$sortid.")";

		$db->query($sql) or die("SQL execution error!");
		echo "<script type='text/javascript'> if(confirm('是否要继续添加?')){ window.location.href='edit.php?action=add&tid=0';}else{ window.location.href='list.php';	}</script>";
	}
 
	//modify sysavarstype
	function avartype_update() {
		global $db,$func;
		$typename=($_POST['typename']);	
		$sortid=($_POST['sortid']);	

		$act=isset($_POST['act']) ? $_POST['act'] : '';
		$keyword=isset($_POST['keyword']) ? $_POST['keyword'] : '';
		$page=isset($_POST['page']) ? $_POST['page'] :1;
		
		$url="page=".$page."&act=".$act."&keyword=".$keyword;
		
		$sql="update `".PRE."system_vartype` set `sortid` = ".$sortid.",`typename` = '".$typename."'   WHERE `id` =".$_GET['id'];	

		$db->query($sql) or die("SQL execution error!");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('修改成功！');window.location.href='list.php?$url';</SCRIPT>";
	}

	
	//delete sysavarstype
	function avartype_del() {
		global $db;
 
		$act=isset($_GET['act']) ? $_GET['act'] : '';
		$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$page=isset($_GET['page']) ? $_GET['page'] : '';
		
		$url="page=$page&act=$act&keyword=$keyword";
		$sql = "delete from `".PRE."system_vartype` where `id` in (".$_GET['id'].")";
		$db->query($sql) or die("SQL execution error!");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='list.php?$url';</SCRIPT>";
	}
	
	//multiline delete sysavarstype
	function avartype_delall() {
		global $db;
		$typeid=isset($_GET['typeid']) ? $_GET['typeid'] : '';
		$act=isset($_GET['act']) ? $_GET['act'] : '';
		$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$page=isset($_GET['page']) ? $_GET['page'] : '';
		
		$url="page=$page&act=$act&keyword=$keyword";
		$sql = "delete from `".PRE."system_vartype` where `id` in (".$_POST['delaid'].")";
 
		$db->query($sql) or die("SQL execution error!");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='list.php?$url';</SCRIPT>";
	}

}
?>