<?php
/**
 * Links library
 */
class flink{
	
	function flink(){}
	
	/**************adver operations*******************************************************************/
	//show list  links
	function link_list($tmpsql,$pagesize,$arrparam){
		global $db,$func;
		$page2=isset($_GET['page']) ? $_GET['page'] :1;
		$sql=$tmpsql;
		$arr=$func->get_page_num($sql,$pagesize);
		$sql.=" limit $arr[1], $pagesize";
		$rs=$db->query($sql) or die("SQL execution error！");
		
		echo "<table width='100%' border='0' align='center' cellpadding='2' cellspacing='0' class='lrbtline'>";
		echo "		<tr>";
		echo "				<td width='6%' align='center' class='lrbtlineHead'><input name=\"chkall\" type=\"checkbox\" id=\"chkall\" onclick=\"javascript:CheckAll(this.form);\"  style=\"border:0px;\"  title='全选择或者全取消' > <input type=button onclick='javascript:del(this.form);' value='×' title='删除选择项'></td>";
		echo "				<td width='30%' align='center' class='lrbtlineHead'>连接名称</td>";
		echo "				<td width='8%' align='center' class='lrbtlineHead'>缩略图</td>";
		echo "				<td width='21%' align='center' class='lrbtlineHead'>连接类别 </td>";

	
		echo "				<td width='15%' align='center' class='lrbtlineHead'>操作</td>";
		echo "		</tr>";
		
		while($row = $db->fetch_array($rs)){
				$advpic=$row['advpic'];
				$tmppic="";
				if ($advpic!=''){
				    $tmppic="<img src='".$advpic."' bordr=0 height=30>";
				}else{
					$tmppic="<img src='../../images/linknone.jpg' bordr=0 height=30>";
				}
				$advurl=$row['advurl'];
				$targeturl=$advurl;	
				echo "		<tr  class='outrow' onMouseOver=\"this.className='onrow';\" onMouseOut=\"this.className='outrow';\">";
				echo "				<td align='center'><input name='id' id='id'  type='checkbox' value='$row[id]' style='border:0px;'></td>";
				echo "				<td><a href=\"".$targeturl."\" target='_blank'>".$row['advname']."</a></td>";
				echo "				<td align='center'>".$tmppic."</td>";
				echo "				<td align='center'>".$this->getlinktypename($row['typeid'])."</td>";			

				echo "				<td align='center'><a href='edit.php?page=".$page2."&action=modify&tid=".$row['typeid']."&id=".$row['id']."&".$arrparam."'><img src='../images/class_update.gif' alt='修改' /> 修改</a&nbsp;><a href='editdo.php?page=".$_GET["page"]."&action=del&id=".$row['id']."&$arrparam'  onclick=\"return configdel();\"><img src='../images/class_del.gif' alt='删除' /> 删除</a> </td>";
				echo "</tr>";
		}
		echo "</table>";
		
		new cmspage($arr[0],$pagesize,$arrparam);
	}

	//add links
	function link_add() {
		global $db,$func;
		$typeid=intval(($_POST['typeid']));
		$advname=($_POST['advname']);	
		$advpic=($_POST['advpic']);	
		$advurl=($_POST['advurl']);	
 		$memo=($_POST['memo']);
 
		$time=date("Y-m-d H:i:s"); 
		$ip=$_SERVER['REMOTE_ADDR'];

		$sql="insert into ".PRE."links (typeid,advname,advpic,advurl,memo) values (".$typeid.",'".$advname."','".$advpic."','".$advurl."','".$memo."')";

		$db->query($sql) or die("SQL execution error!");
		echo "<script type='text/javascript'> if(confirm('是否要继续添加?')){ window.location.href='edit.php?action=add&tid=0';}else{ window.location.href='list.php';	}</script>";
	}
 
	//modify links
	function link_update() {
		global $db,$func;
		$typeid=intval(($_POST['typeid']));
		$advname=($_POST['advname']);	
		$advpic=($_POST['advpic']);	
		$advurl=($_POST['advurl']);	
 		$memo=($_POST['memo']);
 
		$act=isset($_POST['act']) ? $_POST['act'] : '';
		$keyword=isset($_POST['keyword']) ? $_POST['keyword'] : '';
		$page=isset($_POST['page']) ? $_POST['page'] :1;
		
		$url="page=".$page."&act=".$act."&keyword=".$keyword."&typeid=".$typeid."&fid=".$fid."";
		
		$sql="update `".PRE."links` set `typeid` = ".$typeid.",`advname` = '".$advname."',`advpic`='".$advpic."',`advurl`='".$advurl."',`memo`='".$memo."' WHERE `id` =".$_GET['id'];	
 
		$db->query($sql) or die("SQL execution error!");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('修改成功！');window.location.href='list.php?$url';</SCRIPT>";
	}

	
	//delete links
	function link_del() {
		global $db;
		$typeid=isset($_GET['typeid']) ? $_GET['typeid'] : '';
		$act=isset($_GET['act']) ? $_GET['act'] : '';
		$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$page=isset($_GET['page']) ? $_GET['page'] : '';
		
		$url="page=$page&act=$act&keyword=$keyword&typeid=$typeid";
		$sql = "delete from `".PRE."links` where `id` in (".$_GET['id'].")";
		$db->query($sql) or die("SQL execution error!");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='list.php?$url';</SCRIPT>";
	}
	
	//multiline delete links
	function link_delall() {
		global $db;
		$typeid=isset($_GET['typeid']) ? $_GET['typeid'] : '';
		$act=isset($_GET['act']) ? $_GET['act'] : '';
		$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$page=isset($_GET['page']) ? $_GET['page'] : '';
		
		$url="page=$page&act=$act&keyword=$keyword&typeid=$typeid";
		$sql = "delete from `".PRE."links` where `id` in (".$_POST['delaid'].")";
 
		$db->query($sql) or die("SQL execution error!");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='list.php?$url';</SCRIPT>";
	}
		
	//get links typename
	function getlinktypename($typeid){
		global $db;
		if($typeid!="" &&$typeid!="0"){
			$sql="select typename from `".PRE."linkstype` where `id`=".intval($typeid);

			$rs=mysql_query($sql) or die ("SQL execution error!");
			$ok=is_array($row=mysql_fetch_array($rs));
			return $row["typename"];
		}	
	}
	/**************linkstype operations*******************************************************************/
	
		//show list linkstype
	function linkstypelist($tmpsql,$pagesize,$arrparam){
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
		//echo "				<td width='8%' align='center' class='lrbtlineHead'>缩略图</td>";	
		echo "				<td width='8%' align='center' class='lrbtlineHead'>排序</td>";
		echo "				<td width='15%' align='center' class='lrbtlineHead'>操作</td>";
		echo "		</tr>";
		
		while($row = $db->fetch_array($rs)){
				$advpic=$row['advpic'];
				$tmppic="";
				if ($advpic!=''){
				    $tmppic="<img src='".$advpic."' bordr=0 height=30>";
				}else{
					$tmppic="<img src='../../images/linknone.jpg' bordr=0 height=30>";
				}
				echo "		<tr  class='outrow' onMouseOver=\"this.className='onrow';\" onMouseOut=\"this.className='outrow';\">";
				echo "				<td align='center'><input name='id' id='id'  type='checkbox' value='$row[id]' style='border:0px;'></td>";
				echo "				<td>".$row['typename']."<font color=green>(ID:<b>".$row['id']."</b>)</font></td>";		
				//echo "				<td align='center'>".$tmppic."</td>";				
				echo "				<td align='center'>".$row['sortid']."</td>";
				echo "				<td align='center'><a href='edit.php?page=".$page2."&action=modify&id=".$row['id']."&".$arrparam."'><img src='../images/class_update.gif' alt='修改' /> 修改</a&nbsp;><a href='editdo.php?page=".$_GET["page"]."&action=del&id=".$row['id']."&$arrparam'  onclick=\"return configdel();\"><img src='../images/class_del.gif' alt='删除' /> 删除</a> </td>";
				echo "</tr>";
		}
		echo "</table>";
		
		new cmspage($arr[0],$pagesize,$arrparam);
	}

	//add linkstype
	function linkstype_add() {
		global $db,$func;
		$typename=($_POST['typename']);	
		$advpic=($_POST['advpic']);	
		$sortid=($_POST['sortid']);	
 
		$sql="insert into ".PRE."linkstype (typename,advpic,sortid) values ('".$typename."','".$advpic."',".$sortid.")";

		$db->query($sql) or die("SQL execution error!");
		echo "<script type='text/javascript'> if(confirm('是否要继续添加?')){ window.location.href='edit.php?action=add&tid=0';}else{ window.location.href='list.php';	}</script>";
	}
 
	//modify linkstype
	function linkstype_update() {
		global $db,$func;
		$typename=($_POST['typename']);	
		$advpic=($_POST['advpic']);	
		$sortid=($_POST['sortid']);	

		$act=isset($_POST['act']) ? $_POST['act'] : '';
		$keyword=isset($_POST['keyword']) ? $_POST['keyword'] : '';
		$page=isset($_POST['page']) ? $_POST['page'] :1;
		
		$url="page=".$page."&act=".$act."&keyword=".$keyword;
		
		$sql="update `".PRE."linkstype` set `sortid` = ".$sortid.",`typename` = '".$typename."',`advpic` = '".$advpic."'   WHERE `id` =".$_GET['id'];	

		$db->query($sql) or die("SQL execution error!");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('修改成功！');window.location.href='list.php?$url';</SCRIPT>";
	}

	
	//delete linkstype
	function linkstype_del() {
		global $db;
 
		$act=isset($_GET['act']) ? $_GET['act'] : '';
		$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$page=isset($_GET['page']) ? $_GET['page'] : '';
		
		$url="page=$page&act=$act&keyword=$keyword";
		$sql = "delete from `".PRE."linkstype` where `id` in (".$_GET['id'].")";
		$db->query($sql) or die("SQL execution error!");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='list.php?$url';</SCRIPT>";
	}
	
	//multiline delete linkstype
	function linkstype_delall() {
		global $db;
		$typeid=isset($_GET['typeid']) ? $_GET['typeid'] : '';
		$act=isset($_GET['act']) ? $_GET['act'] : '';
		$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$page=isset($_GET['page']) ? $_GET['page'] : '';
		
		$url="page=$page&act=$act&keyword=$keyword";
		$sql = "delete from `".PRE."linkstype` where `id` in (".$_POST['delaid'].")";
 
		$db->query($sql) or die("SQL execution error!");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='list.php?$url';</SCRIPT>";
	}
	/**************links for frontpage operations*******************************************************************/
	//show downlist links for  frontpage
 
	//
	function getlink($typeid){
		global $db,$func;
 		$tmpsql = "select * from `".PRE."links` where `advname`<>''  and `typeid`=".$typeid." order by id asc";
		$tmpk=0;
		$rs=$db->query($tmpsql) or die("SQL execution error！");
		while($row = $db->fetch_array($rs)){
			if ($tmpk==0){
				$result=$result."<a href='".$row["advurl"]."' title='".$row["advname"]."'target='_blank'>".$row["advname"]."</a>\n";
			}else{
				$result=$result." | <a href='".$row["advurl"]."' title='".$row["advname"]."'  target='_blank'>".$row["advname"]."</a>\n"; 
			}
			$tmpk=$tmpk+1;
		}
		echo   $result;
	}
	//
	function getScrollLink($typeid){
		global $db,$func;
 		$tmpsql = "select * from `".PRE."links` where `advname`<>''  and `typeid`=".$typeid." order by id asc limit 0,8";
		$tmpk=0;
		$rs=$db->query($tmpsql) or die("SQL execution error！");
		while($row = $db->fetch_array($rs)){
				$result=$result."<td align=\"center\" width=165><a href=\"".$row["advurl"]."\"  target=\"_blank\"><img src=\"".$func->getrealpath2($row["advpic"])."\" width=\"147\" height=\"52\" style=\"border:1px solid #ddd;\"/></a></td>\n";
		}
		echo   $result;
	}
	
	//取得连接
	function getoptionlink($typeid){
		global $db,$func;
 		$tmpsql = "select * from `".PRE."links` where typeid =".$typeid."  order by id asc";
		$tmpk=0;
		$rs=$db->query($tmpsql) or die("SQL execution error！");
		while($row = $db->fetch_array($rs)){
			if ($tmpk==0){
				$result=$result."<option value='".$row["advurl"]."'>--".$row["advname"]."</option>";
			}else{
				$result=$result."<option value='".$row["advurl"]."'>--".$row["advname"]."</option>"; 
			}
			$tmpk=$tmpk+1;
		}
		echo  $result;
	}
	//文字/图片链接
	function linkshow($typeid,$flag,$topnum){
		global $db,$func;
 		$tmpsql = "select * from `".PRE."links` where `advname`<>''  and `typeid`=".$typeid." order by id asc limit 0,$topnum";
		if ($flag==1){
			$result=$result."<table   border=\"0\" align=\"center\" cellpadding=\"4\" cellspacing=\"0\">";
		}elseif ($flag==2){
			$result=$result."<table   border=\"0\" align=\"left\" cellpadding=\"4\" cellspacing=\"0\">";
		}
		$result=$result." <tr> ";
		$tmpk=0;
		$rs=$db->query($tmpsql) or die("SQL execution error！");
		while($row = $db->fetch_array($rs)){
			if ($flag==2){
				$advpic=$func->getrealpath($row["advpic"]);
				if ($tmpk%6==0){
					$align="center";
				}elseif ($tmpk%5==0){
				}else{
					$align="center";
				}
				
				if ($advpic!=''){
					$result=$result."<td width=\"150\" height=55 align=".$align." style=\"background-color:#efefef; border:1px solid #ddd;\"><a href=\"".$row["advurl"]."\" title=\"".$row["advname"]."\"  target=_blank><img src=\"".$advpic."\" width=\"100\" height=\"40\" style=\"border:1px solid #efefef;\"></a></td>"; 
				}else{
					$result=$result."<td width=\"150\" height=55 align=center style=\"background-color:#efefef; border:1px solid #ddd;\"><img src=\"".$advpic."\" width=\"100\" height=\"40\" style=\"border:1px solid #efefef;\"></td>"; 
				}
				$tmpk=$tmpk+1;
				if ($tmpk%5==0){$result=$result."</tr><tr>";}	
			}elseif ($flag==1){
				$result=$result."<td width=\"150\" height=55 style='padding:0px;background-color:#efefef; border:1px solid #ddd;' align=center valign=middle><a href=\"".$row["advurl"]."\" title=\"".$row["advname"]."\"  target=_blank style=\"line-height:55px; height:55px; font-size:16px; color:#666;\">".$row["advname"]."</a></td>"; 
				$tmpk=$tmpk+1;
				if ($tmpk%2==0){$result=$result."</tr><tr>";}	
			}
		}
		$result=$result." </tr> ";
		$result=$result."</table>";
		echo $result;
	}
}
?>