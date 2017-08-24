<?php
/**
 * cms模型管理
 */
class articelmodel{ 

	/**模型列表**/
	function Modellist($tmpsql,$pagesize,$arrparam){
		global $db,$func,$type;
		$page2=isset($_GET['page']) ? $_GET['page'] :1;
		$sql=$tmpsql;
		$arr=$func->get_page_num($sql,$pagesize);
		$sql.=" limit $arr[1], $pagesize";
		$rs=$db->query($sql) or die("SQL execution error！");
		$result=$result."<table width='100%' border='0' align='center' cellpadding='2' cellspacing='0' class='lrbtline'>";
		$result=$result."		<tr>";
		$result=$result."				<td width='120' align='center' class='lrbtlineHead'>模型名称</td>";
		$result=$result."				<td  align='center' class='lrbtlineHead'></td>";
		$result=$result."				<td width='150' align='right' class='lrbtlineHead'>操作</td>";
		$result=$result."		</tr>";
		while($row = $db->fetch_array($rs)){
			$result=$result."		<tr  class='outrow' onMouseOver=\"this.className='onrow';\" onMouseOut=\"this.className='outrow';\">";
			$result=$result."		  <td align='center' style=\"padding:5px;\">├ ".$row['modelname']."(ID:".$row["modelid"].")</td>";		
			$result=$result."		  <td align='center' style=\"padding:5px;\"></td>";
			if ($row["modelid"]!=1 && $row["modelid"]!=2 && $row["modelid"]!=3 && $row["modelid"]!=6 && $row["modelid"]!=4 && $row["modelid"]!=5){
			$result=$result."		  <td align='right' style=\"padding:5px;\"><a href='model_list.php?modelid=".$row['modelid']."&".$arrparam."'><img src='../images/class_update.gif' alt='模型字段' />模型字段</a> | <a href='editdo.php?action=del&modelid=".$row['modelid']."&".$arrparam."'><img src='../images/class_del.gif' alt='删除模型' /> 删除</a> </td>";
			}else{
			$result=$result."		  <td align='right' style=\"color:#cccccc;padding:5px;\"><a href='model_list.php?modelid=".$row['modelid']."&".$arrparam."'><img src='../images/class_update.gif' alt='模型字段' />模型字段</a> | <img src='../images/class_del.gif' alt='删除模型' /> 删除</td>";
			}


			$result=$result."    </tr>";
		}
		$result=$result."</table>";
		echo $result;
		new cmspage($arr[0],$pagesize,$arrparam);
	}

	/**添加模型**/
	function Model_Add() {
		global $db,$func;
		$modelname=trim($_POST['modelname']);	
 
 		$modelid=trim($_POST['modelid']);
		
		$sql="insert into ".PRE."article_model (modelid,modelname) values ('".$modelid."','".$modelname."')";
		$db->query($sql) or die("SQL execution error!");
		
		//$this->CreatModelTable($tablename);
		
		echo "<script type='text/javascript'> if(confirm('是否要继续添加?')){ window.location.href='edit.php?action=add&tid=0';}else{ window.location.href='list.php';	}</script>";
	}
 
	/**修改模型**/
	function Model_Update() {
		global $db,$func;
		$modelname=trim($_POST['modelname']);	
 
		$modelid=trim($_POST['modelid']);
		$act=isset($_POST['act']) ? $_POST['act'] : '';
		$page=isset($_POST['page']) ? $_POST['page'] :1;
		$url="page=".$page;
		
		$sql="update `".PRE."article_model` set `modelid` = '".$modelid."',`modelname` = '".$modelname."'   WHERE `modelid` =".$_GET['mid'];	
		$db->query($sql) or die("SQL execution error!");
		
		//$this->CreatModelTable($tablename);
		
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('修改成功！');window.location.href='list.php?$url';</SCRIPT>";
	}

	
	/**删除模型**/
	function Model_Del() {
		global $db;
		$act=isset($_GET['act']) ? $_GET['act'] : '';
		$page=isset($_GET['page']) ? $_GET['page'] : '';
		$url="page=$page";
		$modelid=$_GET['modelid'];
		$sql = "delete from `".PRE."article_model` where `modelid` in (".$modelid.")";
		$db->query($sql) or die("SQL execution error!");
		
		$sql = "delete from `".PRE."article_model_column` where `modelid` in (".$modelid.")";
		$db->query($sql) or die("SQL execution error!");		
		
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='list.php?$url';</SCRIPT>";
	}
 
	/**模型字段列表**/
	function ModelColumnlist($tmpsql,$pagesize,$arrparam){
		global $db,$func,$type;
		$page2=isset($_GET['page']) ? $_GET['page'] :1;
		$sql=$tmpsql;
		$arr=$func->get_page_num($sql,$pagesize);
		$sql.=" limit $arr[1], $pagesize";
		$rs=$db->query($sql) or die("SQL execution error！");
		$result=$result."<table width='100%' border='0' align='center' cellpadding='2' cellspacing='0' class='lrbtline'>";
		$result=$result."		<tr>";
		$result=$result."				<td width='10%' align='center' class='lrbtlineHead'>字段名</td>";
		$result=$result."				<td width='10%' align='center' class='lrbtlineHead'>字段中文</td>";
		$result=$result."				<td width='10%' align='center' class='lrbtlineHead'>字段类型</td>";
		$result=$result."				<td width='10%' align='center' class='lrbtlineHead'>字段长度</td>";
		$result=$result."				<td width='10%' align='center' class='lrbtlineHead'>字段默认值</td>";
		$result=$result."				<td width='8%'align='center' class='lrbtlineHead'>上传类型</td>";
		$result=$result."				<td align='center' class='lrbtlineHead'>是否下拉菜单</td>";
		$result=$result."				<td width='8%' align='center' class='lrbtlineHead'>字段排序</td>";
		$result=$result."				<td width='150'  align='center' class='lrbtlineHead'>操作</td>";
		$result=$result."		</tr>";
		while($row = $db->fetch_array($rs)){
			$result=$result."		<tr  class='outrow' onMouseOver=\"this.className='onrow';\" onMouseOut=\"this.className='outrow';\">";	
			$result=$result."		  <td align='left' style=\"padding:5px;\">".$row['columnname']."</td>";		
			$result=$result."		  <td align='center' style=\"padding:5px;\">".$row['columncn']."</td>";
			$result=$result."		  <td align='center' style=\"padding:5px;\">".$row['datatype']."</td>";		
			$result=$result."		  <td align='center' style=\"padding:5px;\">".$row['length']."</td>";
			$result=$result."		  <td align='center' style=\"padding:5px;\">".$row['defaultfalue']."</td>";	
			$result=$result."		  <td align='center' style=\"padding:5px;\">".($row['columnupbtn']==1?"是":"否")."</td>";	
			$result=$result."		  <td align='center' style=\"padding:5px;\">".($row['columnisdown']==1?"是":"否")."</td>";
			$result=$result."		  <td align='center' style=\"padding:5px;\">".$row['sortid']."</td>";	
			$result=$result."		  <td align='center' style=\"padding:5px;\"><a href='model_edit.php?page=".$page2."&action=modify&id=".$row['columnid']."&".$arrparam."'><img src='../images/class_update.gif' alt='修改' /> 修改</a&nbsp;><a href='model_editdo.php?page=".$_GET["page"]."&action=del&id=".$row['columnid']."&modelid=".$row['modelid']."&columnname=".$row['columnname']."&$arrparam'   ><img src='../images/class_del.gif' alt='删除' /> 删除</a> </td>";
			$result=$result."    </tr>";
		}
		$result=$result."</table>";
		echo $result;
		new cmspage($arr[0],$pagesize,$arrparam);
	}
	
	/**创建表名***/
	function CreatModelTable($tablename){
		global $db,$func;
		$sql="DROP TABLE IF EXISTS `".PRE."$tablename`";
		$db->query($sql) or die("SQL execution error!");
		
		$sql="CREATE TABLE `".PRE."$tablename`(  `id` int(11) NOT NULL AUTO_INCREMENT,  `aid` int(11) DEFAULT NULL DEFAULT '0',  `mid` int(11)  DEFAULT '0',PRIMARY KEY (`id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8";
		$db->query($sql) or die("SQL execution error!");		
	}
	
	/*取得模型的表名*/
	function GetModelTableName($mid){
		global $db,$func;
		/*$sql="select * from ".PRE."article_model where modelid=".$mid;
		$rs=$db->query($sql) or die("SQL execution error！");		
		$row = $db->fetch_array($rs);
		$tablename=$row['tablename'];
		unset($row);
		unset($rs);*/
		$tablename="article_column";
		return $tablename;
	}
		
	/*增加附件数据*/
	function InsertModelTableData($aid,$mid){
		global $db,$func;
		$strsql="select * from ".PRE."article_model_column where mid=".$mid;
		$rst=$db->query($strsql) or die(sql_error);
		$columnName="`mid`,`aid`";
		$columnValue="'".$mid."','".$aid."'";
		while($row=$db->fetch_array($rst)){
			$cName=$row['cName'];
			$array=$this->getInputPostParamInfo($cName);
			$columnName=$columnName.",`".$array['key']."`";
			$columnValue=$columnValue.",'".$array['value']."'";
		}
		unset($rst);
		unset($row);
	
		//添加附表
		$tablename=$this->GetModelTableName($mid);
		$sql="insert into ".PRE.$tablename."(".$columnName.") values(".$columnValue.")";
		$db->query($sql) or die("SQL execution error!"+$sql);
	}
	
	/*增加字段类型*/
	function AddModelTableColumn($id,$mid){
		global $db,$func;
		$columnname=$_POST["columnname"];
		$columncn=$_POST["columncn"];
		$datatype=$_POST["datatype"];
		$length=$_POST["length"];
		$defaultvalue=$_POST["defaultvalue"];
	    $cOldName=$_POST["cOldName"];
		$sortid=$_POST["sortid"];
		$columnupbtn=isset($_POST["columnupbtn"])?$_POST["columnupbtn"]:0;
		$columnisdown=isset($_POST["columnisdown"])?$_POST["columnisdown"]:0;
		$columndownsource=$_POST["columndownsource"];
		$columndesc=$_POST["columndesc"];
		$tablename=$this->GetModelTableName($mid);
		
		if ($id!=0 && $id!=""){
			//修改字段
			$sql="update ".PRE."article_model_column set columnname='".$columnname."',columncn='".$columncn."',datatype='".$datatype."',length='".$length."',defaultvalue='".$defaultvalue."',sortid='".$sortid."',columnupbtn='".$columnupbtn."',columnisdown='".$columnisdown."',columndownsource='".$columndownsource."',columndesc='".$columndesc."' where columnid =".$id." and modelid=".$mid."";
			$db->query($sql) or die("SQL execution error!0");
			
			if (strtoupper($datatype)=="DATETIME"){
				$sql="alter table `".PRE.$tablename."`  change `".$cOldName."` `".$columnname."` ".$datatype."";
			}else{
 
				$sql="alter table `".PRE.$tablename."`  change `".$cOldName."` `".$columnname."` ".$datatype."(".$length.") NULL DEFAULT '".$defaultvalue."'";
			}
;
			$db->query($sql) or die("SQL execution error!2".$sql);
		}else{
			//添加字段
			$sql="insert into ".PRE."article_model_column(modelid,columnname,columncn,datatype,length,defaultvalue,sortid,columnupbtn,columnisdown,columndownsource,columndesc) values('".$mid."','".$columnname."','".$columncn."','".$datatype."','".$length."','".$defaultvalue."','".$sortid."','".$columnupbtn."','".$columnisdown."','".$columndownsource."','".$columndesc."')";
			$db->query($sql) or die("SQL execution error!1");
			
			if (strtoupper($datatype)=="DATETIME"){
				$sql="alter table `".PRE.$tablename."` ADD `".$columnname."`  ".$datatype."";
			}else{
				$sql="alter table `".PRE.$tablename."` ADD `".$columnname."` ".$datatype."(".$length.") NULL DEFAULT '".$defaultvalue."'";
			}
			$db->query($sql) or die("SQL execution error!3");
		}
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('操作成功！');window.location.href='model_list.php?modelid=".$mid."';</SCRIPT>";
		exit;
	}
	
	/**删除字段**/
	function ModelColumn_Del($id,$mid,$cName) {
		global $db;
 		
		$sql = "delete from `".PRE."article_model_column` where `columnid` in (".$id.") and modelid=".$mid." and columnname='".$cName."'";
		$db->query($sql) or die("SQL execution error!");
		
		$tablename=$this->GetModelTableName($mid);
		$sql="alter table `".PRE.$tablename."`  DROP `".$cName."`";
		$db->query($sql) or die("SQL execution error!");

		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='model_list.php?modelid=".$mid."';</SCRIPT>";
		exit;
	}
 
	//Get Class TypeName
	function GetModelName($modelid){
		global $db;
		$sql="select * from `".PRE."article_model` where modelid=".$modelid;
		$rs=$db->query($sql);
		while($row=$db->fetch_array($rs)){
			return $row["modelname"];
		}
	}
	
}
?>