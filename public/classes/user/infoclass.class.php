<?php
//city library
class infoclass{	
	
	function __construct(){}

	//show list city
	function infoclasslist($tagname,$classid){
		global $db,$func;
		$page2=isset($_GET['page']) ? $_GET['page'] :1;
 		$tmpsql = "select * from `".PRE."member_infoclass` where `typename`<>''  and `fid`=" . $classid;
		$rs=$db->query($tmpsql) or die("SQL execution error！");
		while($row = $db->fetch_array($rs)){
				$tmpstr= $tagname;
				if ($row['fid']==0){
					$stronclick=" onclick=\"showHidden(this);\"";
				}else{
					$stronclick="";
				}
				echo "		<tr  class='outrow' onMouseOver=\"this.className='onrow';\" onMouseOut=\"this.className='outrow';\" ".$stronclick.">";

				echo "				<td align='center'><input name='id' id='id'  type='checkbox' value='$row[id]' style='border:0px;'></td>";
				if ($row['fid']==0){
				echo "				<td style=\"color:green;font-weight:bold;\">$tmpstr".$row['typename']."(ID:".$row['id'].")</td>";	
				}else{
				echo "				<td>$tmpstr".$row['typename']."</td>";	
				}	
				echo "				<td align='left'>$tmpstr".$row['sortid']."</td>";
 
				echo "				<td align='right'><a href='edit.php?page=".$page2."&action=add&fid=".$row['id']."&".$arrparam."'><img src='../images/class_update.gif' alt='添加子项' /> 添加子项</a>&nbsp;<a href='edit.php?page=".$page2."&action=modify&id=".$row['id']."&".$arrparam."'><img src='../images/class_update.gif' alt='修改' /> 修改</a>&nbsp;<a href='editdo.php?page=".$_GET["page"]."&action=del&id=".$row['id']."&$arrparam'  onclick=\"return configdel();\"><img src='../images/class_del.gif' alt='删除' /> 删除</a> </td>";
				echo "</tr>"; 
				$this->infoclasslist($tagname."┴─",$row['id']);
			}
	}
	
	//add city
	function infoclass_add() {
		global $db,$func;
		$typename=($_POST['typename']);			
		$sortid=($_POST['sortid']);	
		$fid=($_POST['fid']);	
		
		$sql="insert into ".PRE."member_infoclass(typename,sortid,fid) values ('".$typename."',".$sortid.",".$fid.")";
 


		$db->query($sql) or die("SQL execution error!");
		echo "<script type='text/javascript'> if(confirm('是否要继续添加?')){ window.location.href='edit.php?action=add&fid=$fid';}else{ window.location.href='list.php';	}</script>";
	}
 
	//modify city
	function infoclass_update() {
		global $db,$func;
		$typename=($_POST['typename']);
		$sortid=($_POST['sortid']);	
		$fid=($_POST['fid']);	
		
		$act=isset($_POST['act']) ? $_POST['act'] : '';
		$keyword=isset($_POST['keyword']) ? $_POST['keyword'] : '';
		$page=isset($_POST['page']) ? $_POST['page'] :1;
		
		$url="page=".$page."&act=".$act."&keyword=".$keyword;
		
		$sql="update `".PRE."member_infoclass` set `sortid` = ".$sortid.",`fid` = ".$fid.",`typename` = '".$typename."' WHERE `id` =".$_GET['id'];	

		$db->query($sql) or die("SQL execution error!");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('修改成功！');window.location.href='list.php?$url';</SCRIPT>";
	}
	
	//delete city
	function infoclass_del() {
		global $db;
 
		$act=isset($_GET['act']) ? $_GET['act'] : '';
		$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$page=isset($_GET['page']) ? $_GET['page'] : '';
		
		$url="page=$page&act=$act&keyword=$keyword";
		$sql = "delete from `".PRE."member_infoclass` where `id` in (".$_GET['id'].")";
		$db->query($sql) or die("SQL execution error!");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='list.php?$url';</SCRIPT>";
	}
	
	//multiline delete city
	function infoclass_delall() {
		global $db;
		$typeid=isset($_GET['typeid']) ? $_GET['typeid'] : '';
		$act=isset($_GET['act']) ? $_GET['act'] : '';
		$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$page=isset($_GET['page']) ? $_GET['page'] : '';
		
		$url="page=$page&act=$act&keyword=$keyword";
		
		$sql = "delete from `".PRE."member_infoclass` where `id` in (".$_POST['delaid'].")";
		$db->query($sql) or die("SQL execution error!");

		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='list.php?$url';</SCRIPT>";
	}

	//showcity for  frontpage
	function showInfoClass(){
		global $db,$func;
 		$tmpsql = "select * from `".PRE."member_infoclass` where `typename`<>''  and `fid`=0 order by sortid asc";
		$result=$result."<table width=\"93%\"  border=\"0\" align=\"center\" cellpadding=\"4\" cellspacing=\"0\">";
		$result=$result." <tr> ";
		$tmpk=0;
		$rs=$db->query($tmpsql) or die("SQL execution error！");
		while($row = $db->fetch_array($rs)){
			$result=$result."<td width=\"50%\" height=22 align=left><a href=\"qiuzhi.php?typeid=".$row["id"]."\" style='font-size:13px;'>•".$row["typename"]."</a></td>"; 
			$tmpk=$tmpk+1;
			if ($tmpk%2==0){$result=$result."</tr><tr>";}		
		}
		$result=$result." </tr> ";
		$result=$result."</table>";
		echo $result;
	}
	
	//取得分类名称
	function getInfoClassName($typeid){
		global $db,$func;
		$tsql="select typename from  ".PRE."member_infoclass  where id=".$typeid;
		$rst=mysql_query($tsql) or die ("SQL execution error!");
		$ok=is_array($rowt=mysql_fetch_array($rst));
		$result=$rowt['typename'];
		return $result;
	}

	function is_leaf($class_id) {
		global $db;
		$sql = "select * from `".PRE."member_infoclass` where `fid`=".$class_id;

		$rs = $db->query($sql);
		if ($db->num_rows($rs) > 0) {
			return false;
		} else {
			return true; 
		}
	}
	//Select选择下拉菜单
	function Info_Class_Select($tagname,$classid,$selid){
		global $db,$func;
		$page2=isset($_GET['page']) ? $_GET['page'] :1;
 		$tmpsql = "select * from `".PRE."member_infoclass` where `typename`<>''  and `fid`=" . $classid." order by sortid asc";
		$rs=$db->query($tmpsql) or die("SQL execution error！".$tmpsql);
		while($row = $db->fetch_array($rs)){
				$tmpstr= $tagname;
				if (trim($row['id'])==trim($selid)){
					echo "<option value='".$row['id']."' selected>$tmpstr".$row['typename']."</option>"; 
					$this->Info_Class_Select($tagname."─┴",$row['id'],$selid);

				}else{
					echo "<option value='".$row['id']."'>$tmpstr".$row['typename']."</option>"; 
					$this->Info_Class_Select($tagname."─┴",$row['id'],$selid);
				}
			}
	}
	
	//Select选择下拉菜单
	function InfoClassSelect($dataid,$data,$datacolumn){
		global $db,$func;
		$page2=isset($_GET['page']) ? $_GET['page'] :1;
		$result="<select name=\"".$datacolumn."\" id=\"".$datacolumn."\" style=\"width:272px;\">";
		$result.="  <option value=''></option>"; 
		
 		$htmpsql = "select * from `".PRE."member_infoclass` where `fid`=" . $dataid." order by sortid asc";
		$rsh=$db->query($htmpsql) or die("SQL execution error！".$htmpsql);
		$k=0;
		while($rowh = $db->fetch_array($rsh)){
				if ($data==trim($rowh['typename'])){
					$selected="selected";
				}else{
					$selected="";
				}
				$result.="<option value='".$rowh['typename']."' ".$selected.">".$rowh['typename']."</option>"; 
			$k=$k+1;
		}
		$result.="</select>";
		echo $result;
	}
	//Select选择下拉菜单
	function InfoClassSelectPage($dataid,$data,$datacolumn,$tagname,$width,$class){
		global $db,$func;
		$page2=isset($_GET['page']) ? $_GET['page'] :1;
		$result="<select name=\"".$datacolumn."\" id=\"".$datacolumn."\" class=\"".$class."\" style=\"width:".$width.";\">";
		$result.="  <option value=''>".$tagname."</option>"; 
		
 		$htmpsql = "select * from `".PRE."member_infoclass` where `fid`=" . $dataid." order by sortid asc";
		$rsh=$db->query($htmpsql) or die("SQL execution error！".$htmpsql);
		$k=0;
		while($rowh = $db->fetch_array($rsh)){
				if ($data==trim($rowh['typename'])){
					$selected="selected";
				}else{
					$selected="";
				}
				$result.="<option value='".$rowh['typename']."' ".$selected.">".$rowh['typename']."</option>"; 
			$k=$k+1;
		}
		$result.="</select>";
		echo $result;
	}

	//Select选择下拉菜单
	function UserInfoClassSelect($dataid,$data,$datacolumn,$class){
		global $db,$func;
		$page2=isset($_GET['page']) ? $_GET['page'] :1;
		$result="<select name=\"".$datacolumn."\" id=\"".$datacolumn."\" class=\"".$class."\" >";
		$result.="  <option value=''></option>"; 
		
 		$htmpsql = "select * from `".PRE."member_infoclass` where `fid`=" . $dataid." order by sortid asc";
		$rsh=$db->query($htmpsql) or die("SQL execution error！");
		$k=0;
		while($rowh = $db->fetch_array($rsh)){
				if ($data==trim($rowh['typename'])){
					$selected="selected";
				}else{
					$selected="";
				}
				$result.="<option value='".$rowh['typename']."' ".$selected.">".$rowh['typename']."</option>"; 
			$k=$k+1;
		}
		$result.="</select>";
		echo $result;
	}
	
	//生成多选
	function InfoClassCheckBox($dataid,$data,$datacolumn){
		global $db,$func,$type,$ishtml;
		$sql.="select * from ".PRE."member_infoclass where fid='".$dataid."' order by sortid asc";
		$rs=$db->query($sql);
		echo "";
		$i=0;
		while($row = $db->fetch_array($rs)){
				$status=strstr($data,$row['typename']);
				if ($status){
					$checked="checked";
				}else{
					$checked="";
				}
 				echo "<input type=\"checkbox\" id=\"".$datacolumn."[]\" name=\"".$datacolumn."[]\" value=\"".$row['typename']."\" ".$checked."> ".$row['typename']."  ";
				$i=$i+1;
				if ($i%10==0){echo "<br>";}
		}
		echo "";
	}
	
}
?>