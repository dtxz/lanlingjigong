<?php
/**
 * Administrator user library
 */
class manager{		
	function __construct(){
	}
	/**************manager operations**************************************/
	//show list manager
	function admin_list(){
		global $db,$type,$func;
		$sql="select * from `".PRE."admin` order by `id` asc";
		$rs=$db->query($sql) or die ("SQL execution error!");
		
		echo "<table width=\"100%\" height=\"57\" border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"0\" class=\"lrbtline\">";
		echo "		<tr>";
		echo "				<td width=\"5%\" height=\"26\" align=\"center\" class=\"lrbtlineHead\">编号</td>";
		echo "				<td width=\"62%\" align=\"center\" class=\"lrbtlineHead\">管理帐户 </td>";
		echo "				<td width=\"15%\" align=\"center\" class=\"lrbtlineHead\">所属权限组</td>";
		echo "				<td width=\"18%\" align=\"center\" class=\"lrbtlineHead\">操作</td>";
		echo "		</tr>";
		
		while($row=$db->fetch_array($rs)){
		
			if ($row['admin_Lock']==1){$mpic="<img src='../images/AdminUnLock.gif' border=0> ";}
			if ($row['admin_Lock']==0){$mpic="<img src='../images/AdminLock.gif' border=0> ";}
			if ($row['isdefault']==0)
			{

				echo "		<tr   class='outrow' onMouseOver=\"this.className='onrow';\" onMouseOut=\"this.className='outrow';\">";
				echo "				<td height=\"26\" align=\"center\">$row[id]</td>";
				echo "				<td>$mpic".$row['admin_id']."(".$row['admin_name'].")</td>";
				echo "				<td align=\"center\">".$func->getadmintype($row['admin_type'])."</td>";
				echo "				<td align=\"center\"><a href='edit.php?action=modify&tid=".$row['admin_type']."&aid=".$row['id']."'><img src='../images/class_update.gif' alt='修改'/> 修改</a>&nbsp;<a href='editdo.php?action=del&aid=".$row['id']."'   onClick='javascript:return ConfirmDel();' ><img src='../images/class_del.gif' alt='删除' /> 删除</a></td>";
				echo "		</tr>";
			}
			else
			{

				echo "		<tr   class='outrow' onMouseOver=\"this.className='onrow';\" onMouseOut=\"this.className='outrow';\">";
				echo "				<td height=\"26\" align=\"center\">$row[id]</td>";
				echo "				<td>$mpic".$row['admin_id']."(".$row['admin_name'].")</td>";
				echo "				<td align=\"center\">".$func->getadmintype($row['admin_type'])."</td>";
				echo "				<td align=\"center\"><a href='edit.php?action=modify&tid=".$row['admin_type']."&aid=".$row['id']."'><img src='../images/class_update.gif' alt='修改'/> 修改</a>&nbsp;<font color=#cccccc><img src='../images/class_del.gif' alt='删除' /> 删除</font</td>";
				echo "		</tr>";
			}
		}
		echo "</table>";
	}
	
	//add manager
	function admin_add(){
		global $db;
		$admin_type=$_POST['admin_type'];
		$admin_id=($_POST['admin_id']);
		$admin_pass=($_POST['admin_pass']);
		$admin_code=($_POST['admin_code']);
		$admin_name=($_POST['admin_name']);
	
		$admin_Lock=$_POST['admin_Lock'];
		$admin_pass=md5($admin_pass.CMS);
		
		$array=$_POST['admin_code'];
		$admin_code="";

		$size = count($array);
		for($i=0; $i<$size; $i++)
		{
			if ($i==0)
			{
			$admin_code = $array[$i];
			}
			else
			{
			$admin_code = $admin_code.",".$array[$i];
			}
		}
		
		$sql="insert into `".PRE."admin`(`admin_type`,`admin_id`,`admin_pass`,`admin_code`,`admin_name`,`admin_Lock`) values(".$admin_type.",'".$admin_id."','".$admin_pass."','".$admin_code."','".$admin_name."',".$admin_Lock.")";


		$db->query($sql) or die ("SQL execution error!");
		echo "<script type='text/javascript'> if(confirm('是否继续添加？')){ window.location.href='edit.php?action=add';} else{ window.location.href='list.php'}</script>";												 
	}
	
	//modify manager
	function admin_update(){
		global $db,$func;
		
		$admin_type=$_POST['admin_type'];
		$admin_id=$_POST['admin_id'];
		$admin_pass=($_POST['admin_pass']);
		$admin_pass_old=($_POST['admin_pass_old']);
		$admin_code=($_POST['admin_code']);
		$admin_name=($_POST['admin_name']);
		$admin_Lock=$_POST['admin_Lock'];

		if ($_POST['admin_pass']==$admin_pass_old)
		{
			$admin_pass=$admin_pass_old;
			
		}
		else
		{
			$admin_pass=md5($admin_pass.CMS);
		}

		
		$array=$_POST['admin_code'];
		$admin_code="";

		$size = count($array);
		for($i=0; $i<$size; $i++)
		{
			if ($i==0)
			{
			$admin_code = $array[$i];
			}
			else
			{
			$admin_code = $admin_code.",".$array[$i];
			}
		}
		
		$sql="update `".PRE."admin` set `admin_type`=".$admin_type.",`admin_id`='".$admin_id."',`admin_pass`='".$admin_pass."',`admin_code`='".$admin_code."',`admin_name`='".$admin_name."',`admin_Lock`=".$admin_Lock." where `id`=".$func->safe_check($_GET['aid'],0);

		$db->query($sql) or die ("SQL execution error!");
		echo "<script type='text/javascript'>alert('修改成功！'); window.location.href='list.php';</script>";
	}
	
	//delete manager
	function admin_del(){
		global $db;
		$sql="delete from `".PRE."admin` where `id`=".$_GET['aid'];
		$db->query($sql) or die ("SQL execution error!");
		echo "<script type='text/javascript'>alert('删除成功！'); window.location.href='list.php';</script>";
	}

	/**************admintype operations**************************************/
	
		//show list admintype
	function admintypelist(){
		global $db,$func;
		$page2=isset($_GET['page']) ? $_GET['page'] :1;
 		$tmpsql = "select * from `".PRE."admintype` where `typename`<>'' order by sortid asc ";
		$rs=$db->query($tmpsql) or die("SQL execution error！");
		while($row = $db->fetch_array($rs)){
				$tmpstr= $tagname;
				echo "		<tr  class='outrow' onMouseOver=\"this.className='onrow';\" onMouseOut=\"this.className='outrow';\">";
				echo "				<td align='center'><input name='id' id='id'  type='checkbox' value='$row[id]' style='border:0px;'></td>";
				echo "				<td>$tmpstr".$row['typename']."</td>";		
				echo "				<td align='left'>$tmpstr".$row['sortid']."</td>";
				if ($row['admingroup']==1){
				echo "				<td align='right'><a href='edit.php?page=".$page2."&action=modify&id=".$row['id']."&".$arrparam."'><img src='../images/class_update.gif' alt='修改' /> 修改</a> </td>";
		        }else{
				echo "				<td align='right'><a href='edit.php?page=".$page2."&action=modify&id=".$row['id']."&".$arrparam."'><img src='../images/class_update.gif' alt='修改' /> 修改</a>&nbsp;<a href='editdo.php?page=".$_GET["page"]."&action=del&id=".$row['id']."&$arrparam'   ><img src='../images/class_del.gif' alt='删除' /> 删除</a> </td>";
				}
				echo "</tr>"; 
			}
	}

	//add admintype
	function admintype_add() {
		global $db,$func;
		$typename=($_POST['typename']);	
		$sortid=($_POST['sortid']);	
		$array="";
		$array=($_POST['itemcode']);
		$itemcode="";

		$size = count($array);
		for($i=0; $i<$size; $i++)
		{
			if ($i==0)
			{
			$itemcode = $array[$i];
			}
			else
			{
			$itemcode = $itemcode.",".$array[$i];
			}
		}
		
		$sql="insert into ".PRE."admintype (typename,sortid,itemcode) values ('".$typename."',".$sortid.",'".$itemcode."')";

		$db->query($sql) or die("SQL execution error!");
		echo "<script type='text/javascript'> if(confirm('是否要继续添加?')){ window.location.href='edit.php?action=add&tid=0';}else{ window.location.href='list.php';	}</script>";
	}
 
	//modify member_worktype
	function admintype_update() {
		global $db,$func;
		$typename=($_POST['typename']);	
		$sortid=($_POST['sortid']);	
		$array="";
		$array=($_POST['itemcode']);
		$itemcode="";

		$size = count($array);
		for($i=0; $i<$size; $i++)
		{
			if ($i==0)
			{
			$itemcode = $array[$i];
			}
			else
			{
			$itemcode = $itemcode.",".$array[$i];
			}
		}
 	
		$act=isset($_POST['act']) ? $_POST['act'] : '';
		$keyword=isset($_POST['keyword']) ? $_POST['keyword'] : '';
		$page=isset($_POST['page']) ? $_POST['page'] :1;
		
		$url="page=".$page."&act=".$act."&keyword=".$keyword;
		
		$sql="update `".PRE."admintype` set `sortid` = ".$sortid.",`itemcode` = '".$itemcode."',`typename` = '".$typename."'   WHERE `id` =".$_GET['id'];	

		$db->query($sql) or die("SQL execution error!");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('修改成功！');window.location.href='list.php?$url';</SCRIPT>";
	}

	
	//delete member_worktype
	function admintype_del() {
		global $db;
 
		$act=isset($_GET['act']) ? $_GET['act'] : '';
		$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$page=isset($_GET['page']) ? $_GET['page'] : '';
		
		$url="page=$page&act=$act&keyword=$keyword";
		$sql = "delete from `".PRE."admintype` where `id` in (".$_GET['id'].")";
		$db->query($sql) or die("SQL execution error!");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='list.php?$url';</SCRIPT>";
	}
	
	//multiline delete member_worktype
	function admintype_delall() {
		global $db;
		$typeid=isset($_GET['typeid']) ? $_GET['typeid'] : '';
		$act=isset($_GET['act']) ? $_GET['act'] : '';
		$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$page=isset($_GET['page']) ? $_GET['page'] : '';
		
		$url="page=$page&act=$act&keyword=$keyword";
		$sql = "delete from `".PRE."admintype` where `id` in (".$_POST['delaid'].")";
 
		$db->query($sql) or die("SQL execution error!");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='list.php?$url';</SCRIPT>";
	}

	//show downlist member_worktype
	function admintypeselect($selid){
		global $db,$func;
		$page2=isset($_GET['page']) ? $_GET['page'] :1;
 		$tmpsql = "select * from `".PRE."admintype` where `typename`<>'' order by sortid asc";
		$rs=$db->query($tmpsql) or die("SQL execution error！");
		while($row = $db->fetch_array($rs)){
				if (trim($row['id'])==trim($selid)){
					echo "<option value='".$row['id']."' selected>".$row['typename']."</option>"; 
				}else{
					echo "<option value='".$row['id']."'>".$row['typename']."</option>"; 
			 }
	    }
	}

	/**************admincode operations**************************************/
	
		//show list admincode
	function admincodelist($tagname,$classid){
		global $db,$func;
		$page2=isset($_GET['page']) ? $_GET['page'] :1;
 		$tmpsql = "select * from `".PRE."admincode` where `typename`<>''  and `fid`=" . $classid;
		$rs=$db->query($tmpsql) or die("SQL execution error！");
		while($row = $db->fetch_array($rs)){
				$tmpstr= $tagname;
				echo "		<tr  class='outrow' onMouseOver=\"this.className='onrow';\" onMouseOut=\"this.className='outrow';\">";
				echo "				<td align='center'><input name='id' id='id'  type='checkbox' value='$row[id]' style='border:0px;'></td>";
				echo "				<td>$tmpstr".$row['typename']."</td>";	
				echo "				<td align='center'>".$row['itemcode']."</td>";					
				echo "				<td align='left'>$tmpstr".$row['sortid']."</td>";
				echo "				<td align='right'><a href='edit.php?page=".$page2."&action=add&fid=".$row['id']."&".$arrparam."'><img src='../images/class_update.gif' alt='添加子选项' /> 添加子选项</a>&nbsp;<a href='edit.php?page=".$page2."&action=modify&id=".$row['id']."&".$arrparam."'><img src='../images/class_update.gif' alt='修改' /> 修改</a>&nbsp;<a href='editdo.php?page=".$_GET["page"]."&action=del&id=".$row['id']."&$arrparam'   ><img src='../images/class_del.gif' alt='删除' /> 删除</a> </td>";
				echo "</tr>"; 
				$this->admincodelist($tagname."┴─",$row['id']);
			}
	}

	//add admincode
	function admincode_add() {
		global $db,$func;
		$typename=($_POST['typename']);
		$itemcode=trim($_POST['itemcode']);
		$sortid=($_POST['sortid']);	
		$fid=($_POST['fid']);	
 
		$sql="insert into ".PRE."admincode (typename,sortid,fid,itemcode) values ('".$typename."',".$sortid.",".$fid.",'".$itemcode."')";

		$db->query($sql) or die("SQL execution error!");
		echo "<script type='text/javascript'> if(confirm('是否要继续添加?')){ window.location.href='edit.php?action=add&tid=0';}else{ window.location.href='list.php';	}</script>";
	}
 
	//modify admincode
	function admincode_update() {
		global $db,$func;
		$typename=($_POST['typename']);	
		$itemcode=trim($_POST['itemcode']);

		$sortid=($_POST['sortid']);	
		$fid=($_POST['fid']);	
		
		$act=isset($_POST['act']) ? $_POST['act'] : '';
		$keyword=isset($_POST['keyword']) ? $_POST['keyword'] : '';
		$page=isset($_POST['page']) ? $_POST['page'] :1;
		
		$url="page=".$page."&act=".$act."&keyword=".$keyword;
		
		$sql="update `".PRE."admincode` set `sortid` = ".$sortid.",`fid` = ".$fid.",`typename` = '".$typename."',`itemcode` = '".$itemcode."'   WHERE `id` =".$_GET['id'];	

		$db->query($sql) or die("SQL execution error!");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('修改成功！');window.location.href='list.php?$url';</SCRIPT>";
	}

	
	//delete admincode
	function admincode_del() {
		global $db;
 
		$act=isset($_GET['act']) ? $_GET['act'] : '';
		$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$page=isset($_GET['page']) ? $_GET['page'] : '';
		
		$url="page=$page&act=$act&keyword=$keyword";
		$sql = "delete from `".PRE."admincode` where `id` in (".$_GET['id'].")";
		$db->query($sql) or die("SQL execution error!");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='list.php?$url';</SCRIPT>";
	}
	
	//multiline delete admincode
	function admincode_delall() {
		global $db;
		$typeid=isset($_GET['typeid']) ? $_GET['typeid'] : '';
		$act=isset($_GET['act']) ? $_GET['act'] : '';
		$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$page=isset($_GET['page']) ? $_GET['page'] : '';
		
		$url="page=$page&act=$act&keyword=$keyword";
		$sql = "delete from `".PRE."admincode` where `id` in (".$_POST['delaid'].")";
 
		$db->query($sql) or die("SQL execution error!");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='list.php?$url';</SCRIPT>";
	}

	//show downlist admincode
	function admincodeselect($tagname,$classid,$selid){
		global $db,$func;
		$page2=isset($_GET['page']) ? $_GET['page'] :1;
 		$tmpsql = "select * from `".PRE."admincode` where `typename`<>''  and `fid`=" . $classid." order by sortid asc";
		$rs=$db->query($tmpsql) or die("SQL execution error！");
		while($row = $db->fetch_array($rs)){
			$tmpstr= $tagname;
			if (trim($row['id'])==trim($selid)){
				echo "<option value='".$row['id']."' selected>$tmpstr".$row['typename']."</option>"; 
				$this->admincodeselect($tagname."─┴",$row['id'],$selid);
	
			}else{
				echo "<option value='".$row['id']."'>$tmpstr".$row['typename']."</option>"; 
				$this->admincodeselect($tagname."─┴",$row['id'],$selid);
			}
		}
	}

	//show downlist itemcodeselect
	function itemcodeselect($tagname,$classid,$itemcode){
		global $db,$func;
 		$tmpsql = "select * from `".PRE."admincode` where `typename`<>''  and `fid`=" . $classid." order by sortid asc";
		$rs=$db->query($tmpsql) or die("SQL execution error！");
		while($row = $db->fetch_array($rs)){
			$tmpstr= $tagname;
			$ischek="";
			if ($func->PermitSelect($itemcode,$row["itemcode"])==true){$ischek="checked";}
			echo "  <tr class=\"TableDetail2\"> <td class=\"tableline1\">$tmpstr<input type=CHECKBOX style=\"border:0px;\" value=\"".$row['itemcode']."\"  onclick=\"//getResource('".$row['itemcode']."',0,0)\" pId=\"".$row['itemcode']."\"  id=\"".$row['itemcode']."\" name=\"itemcode[]\"  $ischek>".$row['typename'].":<span class=\"Infofont\">".$row['itemcode']."</span></td>	<td class=\"tableline1\"></td></tr>"; 
 
			$tmpstr2= $tagname."─┴";
			$tmpsql2 = "select * from `".PRE."admincode` where `typename`<>''  and `fid`=" . $row['id']." order by sortid asc";
			$rs2=$db->query($tmpsql2) or die("SQL execution error！");
			while($row2 = $db->fetch_array($rs2)){
				$ischek="";
				if ($func->PermitSelect($itemcode,$row2["itemcode"])==true){$ischek="checked";}
				echo "  <tr class=\"TableDetail2\"> <td class=\"tableline1\">$tmpstr2<input type=CHECKBOX style=\"border:0px;\" value=\"".$row2['itemcode']."\"  onclick=\"//getResource('".$row2['itemcode']."','".$row['itemcode']."',1)\" pId=\"".$row['itemcode']."\"  id=\"".$row2['itemcode']."\" name=\"itemcode[]\"   $ischek>".$row2['typename'].":<span class=\"Infofont\">".$row2['itemcode']."</span></td>	<td class=\"tableline1\"></td></tr>"; 
			}
		}
	}	
}
?>