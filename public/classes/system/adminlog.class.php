<?php
/**
 * adminlog library
 */
class adminlog{
	
	function adminlog(){}
	
	/**************adver operations*******************************************************************/
	//show list  links
	function log_list($tmpsql,$pagesize,$arrparam){
		global $db,$func,$manager;
		$page2=isset($_GET['page']) ? $_GET['page'] :1;
		$sql=$tmpsql;
		$arr=$func->get_page_num($sql,$pagesize);
		$sql.=" limit $arr[1], $pagesize";
		$rs=$db->query($sql) or die("SQL execution error！");
		
		echo "<table width='100%' border='0' align='center' cellpadding='2' cellspacing='0' class='lrbtline'>";
		echo "		<tr>";
		echo "				<td width='80' align='center' class='lrbtlineHead'><input name=\"chkall\" type=\"checkbox\" id=\"chkall\" onclick=\"javascript:CheckAll(this.form);\"  style=\"border:0px;\"  title='全选择或者全取消' > <input type=button onclick='javascript:del(this.form);' value='×' title='删除选择项'></td>";
		echo "				<td width='80' align='center' class='lrbtlineHead'>操作人</td>";
		echo "				<td width='100' align='center' class='lrbtlineHead'>日志类型</td>";
		echo "				<td  align='center' class='lrbtlineHead'>日志内容 </td>";
		echo "				<td width='130' align='center' class='lrbtlineHead'>操作时间</td>";
		echo "				<td width='80' align='center' class='lrbtlineHead'>IP</td>";
		echo "				<td width='80' align='center' class='lrbtlineHead'>操作</td>";
		echo "		</tr>";
		
		while($row = $db->fetch_array($rs)){
 
				echo "		<tr  class='outrow' onMouseOver=\"this.className='onrow';\" onMouseOut=\"this.className='outrow';\">";
				echo "				<td align='center'><input name='id' id='id'  type='checkbox' value='$row[id]' style='border:0px;'></td>";
				echo "				<td align='center'>".$row['admin_id']."</td>";
				echo "				<td align='center'>".$row['ctype']."</td>";
				echo "				<td align='left'>".$row['logcontent']."</td>";		
				echo "				<td align='center'>".$row['logtime']."</td>";	
				echo "				<td align='center'>".$row['logip']."</td>";
				echo "				<td align='center'><a href='editdo.php?page=".$_GET["page"]."&action=del&id=".$row['id']."&$arrparam'  onclick=\"return configdel();\"><img src='../images/class_del.gif' alt='删除' /> 删除</a> </td>";
				echo "</tr>";
		}
		echo "</table>";
		
		new cmspage($arr[0],$pagesize,$arrparam);
	}

	//add adminlog
	function logadd($ctype,$targetid,$logcontent){
		global $db,$func,$session_appid;
		$operateid=$_SESSION['uid'];
		$logtime=date("Y-m-d H:i:s");	
 		$logip=$_SERVER['REMOTE_ADDR'];
		if ($logip=="::1"){
			$logip="127.0.0.1";
		}

		$sql="insert into ".PRE."oprecords(operateid,ctype,targetid,logcontent,logtime,logip) values ('".$operateid."','".$ctype."','".$targetid."','".$logcontent."','".$logtime."','".$logip."')";
		$db->query($sql) or die("SQL execution error!");
	}
  
	//delete adminlog
	function logdel() {
		global $db;
		$typeid=isset($_GET['typeid']) ? $_GET['typeid'] : '';
		$act=isset($_GET['act']) ? $_GET['act'] : '';
		$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$page=isset($_GET['page']) ? $_GET['page'] : '';
		
		$url="page=$page&act=$act&keyword=$keyword&typeid=$typeid";
		$sql = "delete from `".PRE."oprecords` where `id` in (".$_GET['id'].")";
		$db->query($sql) or die("SQL execution error!");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='list.php?$url';</SCRIPT>";
	}
	
	//multiline delete adminlog
	function logdelall() {
		global $db;
		$typeid=isset($_GET['typeid']) ? $_GET['typeid'] : '';	
		$act=isset($_GET['act']) ? $_GET['act'] : '';
		$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$page=isset($_GET['page']) ? $_GET['page'] : '';
		
		$url="page=$page&act=$act&keyword=$keyword&typeid=$typeid";
		$sql = "delete from `".PRE."oprecords` where `id` in (".$_POST['delaid'].")";
 
		$db->query($sql) or die("SQL execution error!");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='list.php?$url';</SCRIPT>";
	}
}
?>