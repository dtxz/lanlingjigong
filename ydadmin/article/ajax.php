<?php 
require_once("../include/conn.php");
require_once("permit.php");
?>
<?php 
global $db,$func;
$action=$_GET['action'];
if ($action=="getcolumn"){//添加
	$cid=$_GET['cid'];
	
	$sql="select * from `".PRE."type` where id=".$cid;
	$rs=$db->query($sql);
	$row=$db->fetch_array($rs);
	$modelid=$row["modelid"];
 	
	
	$sql="select * from `".PRE."article_model_column` where modelid=".$modelid."  order by sortid asc";

	$rs=$db->query($sql);
	while($row=$db->fetch_array($rs)){
		$columncn=$row["columncn"];	
		$columnname=$row["columnname"];
		$columnupbtn=$row["columnupbtn"];
		$datatype=$row["datatype"];
		
		//下拉设置
		$columnisdown=$row["columnisdown"];
		$columndownsource=$row["columndownsource"];
		$columndesc="<font color=gray>".$row["columndesc"]."</font>";
		
		echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\">
			  <tr>
				<td width=\"82\" align=\"right\">".$columncn."：</td>
				<td>";
				
		if ($columnisdown==1){
			echo "<select name=\"".$columnname."\"  id=\"".$columnname."\" style=\"width:100px;\">";
			echo "<option value=''></option>";
			$arr=explode("|",$columndownsource);
			for($i=0;$i<count($arr);$i++){
				$sitemarray=explode(":",$arr[$i]);
				echo "<option value=\"".$sitemarray[1]."\">".$sitemarray[0]."</option>";
			}
			echo "</select>".$columndesc;
		}else{		
			if ($datatype=="TEXT"){
				echo "<textarea name=\"".$columnname."\" id=\"".$columnname."\" style=\"width: 450px;\"  rows=\"4\"/></textarea>&nbsp;";
			}else{
				echo "<input name=\"".$columnname."\" id=\"".$columnname."\"  type=\"".$datatype."\" style=\"width: 350px;\" />&nbsp;";
				if ($columnupbtn==1){
					echo "<input name=\"button\" type=\"button\" class=\"button\" onclick=\"javascript:openScript('/include/upload/up.php?upath=file&rcolumname=".$columnname."&isadd=0',460,220);\" value=\"上传\" />";
				}
			}
			echo $columndesc;
		}
		
		echo "</td>
			  </tr>
			</table>";
	}
}
else if ($action=="getcolumnvalue"){//修改
	$cid=$_GET['cid'];
	$aid=$_GET['aid'];
	$sql="select * from `".PRE."type` where id=".$cid;
	$rs=$db->query($sql);
	$row=$db->fetch_array($rs);
	$modelid=$row["modelid"];
	
	$sql="select * from `".PRE."article_model_column` where modelid=".$modelid." order by sortid asc";
	
	$rs=$db->query($sql);
	while($row=$db->fetch_array($rs)){
		$columncn=$row["columncn"];	
		$columnname=$row["columnname"];
		$columnupbtn=$row["columnupbtn"];
		$datatype=$row["datatype"];
		$columnvalue="";
 
		$columnvalue=getcolumnvalue($aid,$columnname);
 		
		//下拉设置
		$columnisdown=$row["columnisdown"];
		$columndownsource=$row["columndownsource"];
		$columndesc="<font color=gray>".$row["columndesc"]."</font>";	
		
		//if (trim($columnvalue)!="" || trim($columnvalue)==""){
		echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\">
			  <tr>
				<td width=\"82\" align=\"right\">".$columncn."：</td>
				<td>";
				
		if ($columnisdown==1){//下拉菜单
			echo "<select name=\"".$columnname."\"  id=\"".$columnname."\" style=\"width:100px;\">";
			echo "<option value=''></option>";
			$arr=explode("|",$columndownsource);
			for($i=0;$i<count($arr);$i++){
				$sitemarray=explode(":",$arr[$i]);
				if ($sitemarray[1]==$columnvalue){
					echo "<option value=\"".$sitemarray[1]."\" selected>".$sitemarray[0]."</option>";
				}else{
					echo "<option value=\"".$sitemarray[1]."\">".$sitemarray[0]."</option>";
				}
			}
			echo "</select>".$columndesc;
		}else{//文本或多行文本
		
			if ($datatype=="TEXT"){
				echo "<textarea name=\"".$columnname."\" id=\"".$columnname."\" style=\"width: 450px;\" rows=\"4\">".$columnvalue."</textarea>&nbsp;";
			}else{
				echo "<input name=\"".$columnname."\" id=\"".$columnname."\"  type=\"".$datatype."\" style=\"width: 350px;\"  value=\"".$columnvalue."\"/>&nbsp;";
				if ($columnupbtn==1){
					echo "<input name=\"button\" type=\"button\" class=\"button\" onclick=\"javascript:openScript('/include/upload/up.php?upath=file&rcolumname=".$columnname."&isadd=0',460,220);\" value=\"上传\" />";
				}
			
			}
			echo $columndesc;
		}
		echo "</td>
			  </tr>
			</table>";
		/*}else{
		
			echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"3\">
				  <tr>
					<td width=\"82\" align=\"right\">".$columncn."：</td>
					<td><input name=\"".$columnname."\" id=\"".$columnname."\"  type=\"".$datatype."\"style=\"width: 350px;\"  value=\"".$columnvalue."\"/>&nbsp;";
			if ($columnupbtn==1){
				echo "<input name=\"button\" type=\"button\" class=\"button\" onclick=\"javascript:openScript('/include/upload/up.php?upath=file&rcolumname=".$columnname."&isadd=0',460,220);\" value=\"上传\" />";
			}
			echo "</td>
				  </tr>
				</table>";
		}*/
	}
	
}

function getcolumnvalue($aid,$columnname){
	global $db;
	$asql="select ".$columnname." from `".PRE."article_column` where aid=".$aid." order by aid desc limit 0,1";

	$ars=$db->query($asql);
	$arow=$db->fetch_array($ars);
	if ($arow){
		return $arow[$columnname];
	}else{
		return "";
	}
}
?>