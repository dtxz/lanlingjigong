<?php
//city library
class city{	
	
	function __construct(){
	}

	//show list city
	function citylist($tagname,$classid){
		global $db,$func;
		$page2=isset($_GET['page']) ? $_GET['page'] :1;
 		$tmpsql = "select * from `".PRE."city` where `typename`<>''  and `fid`=" . $classid;
		$rs=$db->query($tmpsql) or die("SQL execution error！");
		while($row = $db->fetch_array($rs)){
				$tmpstr= $tagname;

				echo "		<tr  class='outrow' onMouseOver=\"this.className='onrow';\" onMouseOut=\"this.className='outrow';\">";

				echo "				<td align='center'><input name='id' id='id'  type='checkbox' value='$row[id]' style='border:0px;'></td>";
				echo "				<td>$tmpstr".$row['typename']."</td>";		
				echo "				<td align='left'>$tmpstr".$row['sortid']."</td>";

				echo "				<td align='right'><a href='edit.php?page=".$page2."&action=add&fid=".$row['id']."&".$arrparam."'><img src='../images/class_update.gif' alt='添加子项' /> 添加子项</a>&nbsp;<a href='edit.php?page=".$page2."&action=modify&id=".$row['id']."&".$arrparam."'><img src='../images/class_update.gif' alt='修改' /> 修改</a>&nbsp;<a href='editdo.php?page=".$_GET["page"]."&action=del&id=".$row['id']."&$arrparam'  onclick=\"return configdel();\"><img src='../images/class_del.gif' alt='删除' /> 删除</a> </td>";
				echo "</tr>"; 
				$this->citylist($tagname."┴─",$row['id']);
			}
	}
	
	//add city
	function city_add() {
		global $db,$func;
		$typename=($_POST['typename']);	
		$weburl=($_POST['weburl']);			
		$sortid=($_POST['sortid']);	
		$fid=($_POST['fid']);	
		$recommand=($_POST['recommand']);	
		$recommandsort=($_POST['recommandsort']);	
		
		$sql="insert into ".PRE."city (typename,sortid,fid) values ('".$typename."',".$sortid.",".$fid.")";
 


		$db->query($sql) or die("SQL execution error!");
		echo "<script type='text/javascript'> if(confirm('是否要继续添加?')){ window.location.href='edit.php?action=add&tid=0';}else{ window.location.href='list.php';	}</script>";
	}
 
	//modify city
	function city_update() {
		global $db,$func;
		$typename=($_POST['typename']);

		$sortid=($_POST['sortid']);	
		$fid=($_POST['fid']);	

		
		$act=isset($_POST['act']) ? $_POST['act'] : '';
		$keyword=isset($_POST['keyword']) ? $_POST['keyword'] : '';
		$page=isset($_POST['page']) ? $_POST['page'] :1;
		
		$url="page=".$page."&act=".$act."&keyword=".$keyword;
		
		$sql="update `".PRE."city` set `sortid` = ".$sortid.",`fid` = ".$fid.",`typename` = '".$typename."'  WHERE `id` =".$_GET['id'];	

		$db->query($sql) or die("SQL execution error!");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('修改成功！');window.location.href='list.php?$url';</SCRIPT>";
	}

	
	//delete city
	function city_del() {
		global $db;
 
		$act=isset($_GET['act']) ? $_GET['act'] : '';
		$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$page=isset($_GET['page']) ? $_GET['page'] : '';
		
		$url="page=$page&act=$act&keyword=$keyword";
		$sql = "delete from `".PRE."city` where `id` in (".$_GET['id'].")";
		$db->query($sql) or die("SQL execution error!");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='list.php?$url';</SCRIPT>";
	}
	
	//multiline delete city
	function city_delall() {
		global $db;
		$typeid=isset($_GET['typeid']) ? $_GET['typeid'] : '';
		$act=isset($_GET['act']) ? $_GET['act'] : '';
		$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$page=isset($_GET['page']) ? $_GET['page'] : '';
		
		$url="page=$page&act=$act&keyword=$keyword";
		
		$sql = "delete from `".PRE."city` where `id` in (".$_POST['delaid'].")";
		$db->query($sql) or die("SQL execution error!");

		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='list.php?$url';</SCRIPT>";
	}

	//show cityselect
	function cityselect($tagname,$classid,$selid){
		global $db,$func;
		$page2=isset($_GET['page']) ? $_GET['page'] :1;
 		$tmpsql = "select * from `".PRE."city` where `typename`<>''  and `fid`=" . $classid." order by sortid asc";
		$rs=$db->query($tmpsql) or die("SQL execution error！");
		while($row = $db->fetch_array($rs)){
				$tmpstr= $tagname;
				if (trim($row['id'])==trim($selid)){
					echo "<option value='".$row['id']."' selected>$tmpstr".$row['typename']."</option>"; 
					$this->cityselect($tagname."─┴",$row['id'],$selid);

				}else{
					echo "<option value='".$row['id']."'>$tmpstr".$row['typename']."</option>"; 
					$this->cityselect($tagname."─┴",$row['id'],$selid);
				}
			}
	}
	
	//showcity for  frontpage
	function showcity(){
		global $db,$func;
 		$tmpsql = "select * from `".PRE."city` where `typename`<>''  and `fid`=0 order by sortid asc";
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
	/*****************************************************************
	* 取得分类名称。
	*/
	function GetCityName($typeid){
		global $db,$func;
		$tsql="select typename from  ".PRE."city  where id=".$typeid;
		$rst=mysql_query($tsql) or die ("SQL execution error!");
		$ok=is_array($rowt=mysql_fetch_array($rst));
		$result=$this->replace_keywords($rowt['typename']);
		return $result;
	}
	//Categories and products_class to get ID
	function get_array_classid($id){
		global $db;
		$arr_cid=$id;

		if(!$this->is_leaf($id)){
			$sql="select * from `".PRE."city` where `fid`=".$id."";
			 
			$rs=$db->query($sql);
			$t=0;
			while($row=$db->fetch_array($rs)){
				if ($t==0)
				{
					$arr_cid=$arr_cid.",".$row['id'];
					$sql2="select * from `".PRE."city` where `fid`=".$row['id']."";
					$rs2=$db->query($sql2);
					while($row2=$db->fetch_array($rs2)){
					$arr_cid=$arr_cid.",".$row2['id'];
					}
				}
				else
				{
					$arr_cid=$arr_cid.",".$row['id'];
					$sql2="select * from `".PRE."city` where `fid`=".$row['id']."";
					
					$rs2=$db->query($sql2);
					while($row2=$db->fetch_array($rs2)){
					$arr_cid=$arr_cid.",".$row2['id'];
					}
				}
				$t=$t+1;
			}
		}
		return $arr_cid;
	}
 
	function is_leaf($class_id) {
		global $db;
		$sql = "select * from `".PRE."city` where `fid`=".$class_id;

		$rs = $db->query($sql);
		if ($db->num_rows($rs) > 0) {
			return false;
		} else {
			return true; 
		}
	}
	//替换函数
	function  replace_keywords($typename){
		$typename=str_replace("市","",$typename);
		$typename=str_replace("省","",$typename);
		$typename=str_replace("壮族自治区","",$typename);
		$typename=str_replace("回族自治区","",$typename);
		$typename=str_replace("维吾尔自治区","",$typename);
		$typename=str_replace("特别行政区","",$typename);
		$typename=str_replace("自治区","",$typename);
		$typename=str_replace(" ","",$typename);
		return $typename;
	}
	
	//前台显示推荐城市
	function showcommandcity($topnum){
		global $db,$func;
		$result="";
 		$tmpsql = "select * from ".PRE."city where typename<>''  and  recommand=1   order by recommandsort asc limit 0,".$topnum."";
		$rs=$db->query($tmpsql) or die("SQL execution error！");
		$v=1;
		while($row = $db->fetch_array($rs)){
			if ($v==1){
				$result.="<a href=\"cityinfo.php?cityid=".$row['id']."\"  target='_top'  class='citylink' title=\"".$this->replace_keywords($row['typename'])."的店铺\">".$this->replace_keywords($row['typename'])."</a>";
			}else{
				$result.=" <a href=\"cityinfo.php?cityid=".$row['id']."\"  target='_top'  class='citylink'  title=\"".$this->replace_keywords($row['typename'])."的店铺\">".$this->replace_keywords($row['typename'])."</a>";
			}
			$v=$v+1;
		}
		echo $result."   <a href=\"###\" id=\"facebook\" class=\"yellowlink\" title=\"更多城市\">更多&gt;&gt;</a>";
	}
	
	//前台显示直辖市
	function show_zxs_city(){
		global $db,$func;
		$result="";
 		$tmpsql = "select * from ".PRE."city where typename<>''  and  zxs=1  and status=1  order by sortid  asc";
		$rs=$db->query($tmpsql) or die("SQL execution error！");
		$v=1;
		while($row = $db->fetch_array($rs)){
			if ($v==1){
				$result.="<a href=\"cityinfo.php?cityid=".$row['id']."\"  target=_top  class='citylink'  style=\"color:#FF0000;\">".$this->replace_keywords($row['typename'])."</a>";
			}else{
				$result.=" <a href=\"cityinfo.php?cityid=".$row['id']."\"  target=_top  class='citylink'  style=\"color:#FF0000;\">".$this->replace_keywords($row['typename'])."</a>";
			}
			$v=$v+1;
		}
		echo $result;
	}	
	
	//前台显示各省城市
	function show_provice_city(){
		global $db,$func;
		$result="";
 		$tmpsql = "select * from ".PRE."city where typename<>''  and  zxs=0  and fid=0  order by sortid  asc";
		$rs=$db->query($tmpsql) or die("SQL execution error！");
		
		while($row = $db->fetch_array($rs)){
			$ctmpsql = "select * from ".PRE."city where typename<>''  and  fid=".$row['id']."  order by sortid  asc";
			$rst=$db->query($ctmpsql) or die("SQL execution error！");
			$v=1;
			$result.="<li style=\"border-bottom:1px dotted #ccc;\"><strong>".$this->replace_keywords($row['typename'])."</strong>:";
			while($rowt = $db->fetch_array($rst)){
				if ($v==1){
				    if ($rowt['recommand']==1){
					$result.="<a href=\"cityinfo.php?cityid=".$rowt['id']."\" target='_top'  class='citylink' style=\"color:#FF0000;\">".$this->replace_keywords($rowt['typename'])."</a>";
					}else{
					$result.="<a href=\"cityinfo.php?cityid=".$rowt['id']."\" target='_top'  class='citylink'>".$this->replace_keywords($rowt['typename'])."</a>";
					}
				}else{
					$result.=" <a href=\"cityinfo.php?cityid=".$rowt['id']."\" target='_top'  class='citylink'>".$this->replace_keywords($rowt['typename'])."</a>";
				}
				$v=$v+1;
			}
			$result.="</li>";
		}
		echo $result;
	}
	//show cityselect
	function select_city($fid,$selid){
		global $db,$func;
		$page2=isset($_GET['page']) ? $_GET['page'] :1;
		$result="";
 		$htmpsql = "select * from `".PRE."city` where `typename`<>''  and `fid`=" . $fid." order by sortid asc";
		$rsh=$db->query($htmpsql) or die("SQL execution error！");
		$k=0;
		while($rowh = $db->fetch_array($rsh)){
			if (trim($rowh['id'])==trim($selid)){
				$result.="<option value='".$rowh['id']."' selected>".$this->replace_keywords($rowh['typename'])."</option>"; 
			}else{
				$result.="<option value='".$rowh['id']."'>".$this->replace_keywords($rowh['typename'])."</option>"; 
			}
			$k=$k+1;
		}
		return $result;
	}

	function select_city_op($selfid,$selid){
		global $db,$func;
		if (($selfid==0 && $selid==0) || ($selfid=="" && $selid=="")){$selfid=22;$selid=491;}
		echo "<select name='provinceid' id='provinceid' onchange='changelocation(this.value)' class=\"usertext\"><option value='' selected>选择省...</option>".$this->select_city(0,$selfid)."</select>&nbsp;";
		echo"<select name='cityid' id='cityid' class=\"usertext\">".$this->select_city($selfid,$selid)."</select>";
	}
	
	function array_cityid($id){
		global $db;
		$arr_cid=$id;

		if(!$this->is_leaf($id)){
			$sql="select * from `".PRE."city` where `fid`=".$id."";
			 
			$rs=$db->query($sql);
			$t=0;
			while($row=$db->fetch_array($rs)){
				if ($t==0)
				{
					$arr_cid=$arr_cid.",".$row['id'];
					$sql2="select * from `".PRE."city` where `fid`=".$row['id']."";
					$rs2=$db->query($sql2);
					while($row2=$db->fetch_array($rs2)){
					$arr_cid=$arr_cid.",".$row2['id'];
					}
				}
				else
				{
					$arr_cid=$arr_cid.",".$row['id'];
					$sql2="select * from `".PRE."city` where `fid`=".$row['id']."";
					
					$rs2=$db->query($sql2);
					while($row2=$db->fetch_array($rs2)){
					$arr_cid=$arr_cid.",".$row2['id'];
					}
				}
				$t=$t+1;
			}
		}
		return $arr_cid;
	}		
	
	
}
?>