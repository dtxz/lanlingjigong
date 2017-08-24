<?php
/**
 * Content section library
 */
class type {
	private $level = 1;//Column depth value
	public $cls_order=0;//Column order value
	public $num_level;
	public $cls_depth=0;
	private $class_name="";//Display category used when the path
	private $arr_cid=array();//Category ID array
	
	function __construct() {
	}

	//The lower part shows the current directory
	function child_class($id,$type){
		global $db;
		$sql="select * from `".PRE."type` where `type`=".intval($type)." and `fid`=".$id;
		$rs=$db->query($sql) or die ("SQL execution error!");
		$show="<div class='title_bg'>";
		$show.="	<div class='title_t'>下级栏目</div>";
		$show.="</div>";
		$show.="<div class='main1_l_new_list'>";
		while($row=$db->fetch_array($rs)){
			$show.="<div><a href='".$this->get_url($row['type']).".php?cid=".$row['id']."'>".$row['name']."</a></div>";
		}
		$show.="</div>";
		return $show;
	}
	
	//Show Path
	function class_path($id){
		global $db;
		if(!empty($id)){
			$sql="select * from `".PRE."type` where id=".$id;
			$rs=$db->query($sql) or die ("SQL execution error!");
			while($row=$db->fetch_array($rs)){				
				$this->class_name=" > <a href='".$this->get_url($row['type']).".php?cid=".$row['id']."'>".$row['name']."</a>".$this->class_name;
				if($row['fid']!=0){
					$this->class_path($row['fid']);
				}
			}
		}
		return "您的位置 > <a href='index.php'>首页</a>".$this->class_name;
	}
	
	//Obtain the value of each field
	function get_class_infor($type){
		global $db;
		$id=$_GET[cid];
		if(!empty($id)){
			$sql="select `name`,`keywords`,`smalltext` from `".PRE."type` where `type`=".$type." and `id`=".$id;
			$rs=$db->query($sql) or die ("SQL execution error!");
			if(is_array($row=$db->fetch_array($rs))){
				return $row;								  	
			}
		}				
	}

	//Recursion depth and modify part of the order, when the change in column
	function class_add_update($tid){
		global $db;
		$sql="select * from `".PRE."type` where `fid`=".$tid ;
		$rs=$db->query($sql);
		while($row = $db->fetch_array($rs)){
			$temp_order=$this->cls_order++;
			$temp_depth=$this->get_level($row['id']);
			//Columns arranged in modifier used when			
			if ($this->get_level($row['id']) == 1) {
				$pic_num = 1;//Top Category Number
			}
			elseif ($this->is_leaf($row['id'])) {
				$pic_num = 2;//At the end of class Classification Number
			} else {
				$pic_num = 3;//Other Classification Number
			}			
			$in_sql = "update `".PRE."type` set `order`=".$temp_order.",`depth`=".$temp_depth.",`pic_num`=".$pic_num." where `id`=".$row['id'];
			//$in_sql = "update `".PRE."type` set `order`=".$temp_order.",`depth`=".$temp_depth.",`pic_num`=".$pic_num." where `id`=".$row['id'];
			
			$db->query($in_sql)or die("SQL execution error!");
			$this->level = 1;
			$this->class_add_update($row['id']);
		}
	}
	
	//Columns list shows 
	function class_list($tagname,$class_type){
		global $db,$func;
		$sql="select * from `".PRE."type` where `fid`='".$class_type."' order by `order`";
		$rs=$db->query($sql);
		while($row = $db->fetch_array($rs)){
			$zs="";
			$fid=$row['fid'];

			for($i=1;$i<$row['depth'];$i++){
				$zs.="<img src='../images/vertline.gif'/>";
			}
			switch($row['pic_num']){
				case 1:
					$list_img = "<img src='../images/open.gif'/>";
					break;

				default:
					$list_img = "<img src='../images/lastnodeline.gif'/>";
			}
			
			
		$sql2 = "select max(`order`) as sortid from `".PRE."type` where fid=".$row['id'];
		$rs2 = $db->query($sql2);
		$row2 = $db->fetch_array($rs2);
		$maxorder=$row2['sortid'];
		unset($row2);
		$maxorder=$maxorder;
		
			$addinfo="<a href='edit.php?action=add&type=".$row['type']."&tid=".$row['id']."&sortnum=".$maxorder."&depth=".$row['depth']."' ><img src='../images/class_add.gif' alt='添加子类' / > 添加子类</a>";

			if ($row["pagetype"]==0){
				$pagetype="<font color=green>单记录</font>";
			}else if ($row["pagetype"]==1){
				$pagetype="<font color=blue>多记录</font>";
			}
			if ($row['isenable']==1){
				$templateinfo="<font color=green>(模)</font>";
			}else if ($row["isenable"]==0){
				$templateinfo="";
			}			
			echo("<tr class='outrow' onMouseOver=\"this.className='onrow';\" onMouseOut=\"this.className='outrow';\">\n");
			echo("		<td align='center'  >".$row['id']."</td>\n");
			echo("		<td >$zs$list_img".$row['name']."</td>\n");
			echo("		<td align='center'  >".$func->getmodelname($row['modelid'])."</td>\n");
			echo("		<td align='left'  >".$pagetype."".$templateinfo."</td>\n");				
			echo("		<td align='left'  >$tagname".$row['order']."</td>\n");
			echo("		<td align='center' ><a href='../article/list.php?page=1&act=search&typeid=".$row['id']."' class=yellowlink >内容管理</a></td>\n");				
			echo("		<td align='center' >".$addinfo."</td>\n	<td align='left'  >");
			echo("<a href='edit.php?action=modify&type=".$row['type']."&tid=".$row['id']."'><img src='../images/class_update.gif' alt='修改类别' /> 修改</a> ");

			echo("<a onClick='DelOK(".$row['id'].")' href='#'><img src='../images/class_del.gif' alt='删除类别' /> 删除</a>");

			echo("</td>\n</tr>\n");

			$this->class_list($tagname."┴─",$row['id']);
		}

	}

	function class_list_update($tagname,$class_type,$flag){
		global $db,$func;
		$sql="select * from `".PRE."type` where `fid`='".$class_type."' order by `order`";
		$rs=$db->query($sql);
		$k=1;
		while($row = $db->fetch_array($rs)){
			$zs="";
			$fid=$row['fid'];

			for($i=1;$i<$row['depth'];$i++){
				$zs.="<img src='../images/vertline.gif'/>";
			}
			switch($row['pic_num']){
				case 1:
					$list_img = "<span  style='cursor:pointer' onClick=\"LoadSuns('suns".$k."',".$row['id'].");\"  title=\"点击展开或关闭\"><img src='../images/class_sopen.gif' border=0/></a> ";
					break;

				default:
					$list_img = "<img src='../images/lastnodeline.gif'/>";
			}
			
			
		$sql2 = "select max(`order`) as sortid from `".PRE."type` where fid=".$row['id'];
		$rs2 = $db->query($sql2);
		$row2 = $db->fetch_array($rs2);
		$maxorder=$row2['sortid'];
		unset($row2);
		$maxorder=$maxorder;
		
			$addinfo="<a href='edit.php?action=add&type=".$row['type']."&tid=".$row['id']."&sortnum=".$maxorder."&depth=".$row['depth']."' ><img src='../images/class_add.gif' alt='添加子类' / > 添加子类</a>";

			if ($row["pagetype"]==0){
				$pagetype="<font color=green>单记录</font>";
			}else if ($row["pagetype"]==1){
				$pagetype="<font color=blue>多记录</font>";
			}
			if ($row['isenable']==1){
				$templateinfo="<font color=green>(模)</font>";
			}else if ($row["isenable"]==0){
				$templateinfo="";
			}	

			if ($flag==1){
			echo("     <table width='100%' height='28' border='0' align='center' cellpadding='4' cellspacing='0'  class='lrbtline' style=\"border-top:1px;\">\n");	
			echo("<tr class='onrow' style=\"background-color:#f2f5f8;\">\n");
			}else{	
			echo("     <table width='100%' height='28' border='0' align='center' cellpadding='4' cellspacing='0'  class='lrbtline' style=\"border-top:1px;\">\n");	
			echo("<tr class='outrow'>\n");
			}
			echo("		<td width='8%' align='center'  >".$row['id']."</td>\n");
			echo("		<td width='30%' >$zs$list_img".$row['name']."</td>\n");
			echo("		<td width='8%' align='center'  >".$func->getmodelname($row['modelid'])."</td>\n");
			echo("		<td width='8%' align='left'  >".$pagetype."".$templateinfo."</td>\n");				
			echo("		<td width='8%' align='left'  >$tagname".$row['order']."</td>\n");
			echo("		<td width='10%' align='center' ><a href='../article/list.php?page=1&act=search&typeid=".$row['id']."' class=yellowlink >内容管理</a></td>\n");				
			echo("		<td width='15%' align='center' >".$addinfo."</td>\n	<td width='15%' align='left'  >");
			echo("<a href='edit.php?action=modify&type=".$row['type']."&tid=".$row['id']."'><img src='../images/class_update.gif' alt='修改类别' /> 修改</a> ");

			echo("<a onClick='DelOK(".$row['id'].")' href='#'><img src='../images/class_del.gif' alt='删除类别' /> 删除</a>");

			echo("</td>\n</tr>\n");
			echo("</table>\n");
			if ($flag==0){
				echo("<div id='suns".$k."'></div>\n");
			}
			if ($flag==1){
				$this->class_list_update($tagname."┴─",$row['id'],$flag);
			}
			$k=$k+1;
		}

	}
	
	//When you add and modify columns
	function art_select_new($tagname,$fid,$typeid){
		global $db,$func;
		$sql="select * from `".PRE."type` where `fid`='".$fid."' order by `order`";
		$rs=$db->query($sql);
		while($row = $db->fetch_array($rs)){
			$zs="";
			$fid=$row['fid'];

			for($i=1;$i<$row['depth'];$i++){
				$zs.="┆";
			}
			switch($row['depth']){
				case 1:
					$list_img = "";
					break;
				case 2:
					$list_img = "└";
					break;
				case 3:
					$list_img = "└";
					break;
				default:
					$list_img = "├";
			}
		   if ($row["id"]==$typeid){
		   echo "<option value='$row[id]' selected>$zs$list_img".$row["name"]."</option>\n";
		   }else{
		   echo "<option value='$row[id]'>$zs$list_img".$row["name"]."</option>\n";
		   }
			$this->art_select_new($tagname."┴─",$row['id'],$typeid);
		}

	}	

	//When you add and modify columns
	function class_select($class_type){
		global $db,$func;
		$sql="select * from `".PRE."type` where `type`='".$class_type."' order by `order`";
			
		$rs=$db->query($sql);
		while($row = $db->fetch_array($rs)){
			$zs="";
			for($i=1;$i<$row["depth"];$i++){
				$zs.="┆";
			}
			switch($row["pic_num"]){
				case 1:
					$list_img = "";
					break;
				case 2:
					$list_img = "└";
					break;
				default:
					$list_img = "├";
			}
			if (intval($_GET['tid'])== $row["id"] && $_GET['action']=='add') {
				echo "<option value='".$row["id"]."' selected='selected'>".$zs."".$list_img."".$row["name"]."</option>\n";
			}elseif ($this->get_farent_id(intval($_GET['tid'])) == $row["id"] && $_GET['action'] == 'modify'){
				echo "<option value='".$row["id"]."' selected='selected'>$zs$list_img$row[name]</option>\n";
			}else {
				echo "<option value='".$row["id"]."'>".$zs."".$list_img."".$row["name"]."</option>\n";
			}
		}
	}

	//Get Class TypeName
	function class_name($id){
		global $db;
		$sql="select * from `".PRE."type` where id=".$id;
 
		$rs=$db->query($sql);
		while($row=$db->fetch_array($rs)){
			return $row["name"];
		}
	}
	
	//Get current TypeName
	function get_current_class_name($str_id){
		global $db;
		$result="";
		$sql="select * from `".PRE."type` where	 `id` in (".$str_id.") order by `id` asc";
		$t=0;
		$rs=$db->query($sql);
		while($row=$db->fetch_array($rs)){
			if ($t==0)
			{
				$result=$row["name"];
			}
			else
			{
				$result=$result."  > ".$row["name"]."";
			}
			$t=$t+1;
		}

		return $result;
	}	
	
	//Get current TypeName by link
	function get_current_class_namebylink($str_id,$linkname){
		global $db,$ishtml,$func;
		
		$exthtml=".php";
		$cid=1;
		if ($ishtml=="1"){
			$exthtml=".html";	
		}
		$result="";
		$sql="select * from `".PRE."type` where	 `id` in (".$str_id.") order by `id` asc";
		$t=0;
		$rs=$db->query($sql);
		while($row=$db->fetch_array($rs)){
			if ($t==0)
			{
				$result="<a href=\"".$linkname.$func->getexthtml("cid",$row["id"])."\" >".$row["name"]."</a>";
			}
			else
			{
				$result=$result." -> <a href=\"".$linkname."list".$func->getexthtml("cid",$row["id"])."\"  >".$row["name"]."</a>";
			}
			$t=$t+1;
		}

		return $result;
	}
	
	//Categories and subcategories to get ID
	function array_classid($id){
		global $db;
/*		$this->arr_cid[]=$id;
		if(!$this->is_leaf($id)){
			$sql="select * from `".PRE."type` where `fid`=".$id;
			$rs=$db->query($sql) or die ("SQL execution error!");
			while($row=$db->fetch_array($rs)){
				$this->array_classid($row['id']);
			}
		}
		return implode(",",$this->arr_cid);
		*/
		return $this->array_classid2($id);
		
	}

	//Determine whether the column is empty
	function is_class_null($id,$type){
		global $db,$func;
		$sql="select * from ".$this->get_table_name($type)." where cid=".$id;

		$rs=$db->query($sql) or die ("SQL execution error!");

		if($db->num_rows($rs)>0){
			return false;
		}else{
			return true;
		}
	}
	//Get the parent ID number
	function get_farent_id($class_id) {
		global $db;
		$sql = "select * from `".PRE."type` where `id`=".$class_id;
		$rs = $db->query($sql);
		while ($row = $db->fetch_array($rs)) {
			return $row["fid"];
		}
	}

	//Determine the category is not a leaf
	function is_leaf($class_id) {
		global $db;
		$sql = "select * from `".PRE."type` where `fid`=".$class_id;

		$rs = $db->query($sql);
		if ($db->num_rows($rs) > 0) {
			return false; //If there is a subclass, it is not leaf node
		} else {
			return true; //If there is no sub-categories, there are leaf nodes
		}
	}

	//Get the depth of class
	function get_level($class_id) {
		global $db;
		if ($class_id!=0){
			$sql = "select * from `".PRE."type` where `id`=".$class_id;
			$rs = $db->query($sql);
			while ($row = $db->fetch_array($rs)) {
				$this->level=$row["depth"]+1;
				/*if ($row["fid"] != 0) {
					$this->level=3;
					//$this->get_level($row["fid"]);
				}else{
					$this->level=2;
				}*/
			}
		}else{
			$this->level=1;
		}
		return $this->level;
	}
	
	//Get the root category ID
	function get_rootidfunc($fid) {
		global $db,$resultrootid;
		$sql = "select * from `".PRE."type` where `id`=".$fid;
 
		$rs = $db->query($sql);
		while ($row = $db->fetch_array($rs)) {
		
			if ($row["fid"]==0) {
				$resultrootid=$fid;
				break;
			}
			else
			{
			$this->get_rootidfunc($row["fid"]);

			}
		}
	}

	//Add Category
	function class_add() {
		global $db;
		$name=isset($_POST['name']) ? $_POST['name'] : '';
		$fid=isset($_POST['fid']) ? $_POST['fid'] : 0;
		$type=isset($_GET['type']) ? $_GET['type'] : 0;
		$modelid=isset($_POST['modelid']) ? $_POST['modelid'] : 1;	
		$picdes=isset($_POST['picdes']) ? $_POST['picdes'] : "";	
		$keywords=isset($_POST['keywords']) ? $_POST['keywords'] : '';
		$smalltext=isset($_POST['smalltext']) ? $_POST['smalltext'] : '';
		$outurl=isset($_POST['outurl']) ? $_POST['outurl'] : '';
		$pagetype=isset($_POST['pagetype']) ? $_POST['pagetype'] : 0;	
 		$order=isset($_POST['order']) ? $_POST['order'] : 1;	
		$templatesfile=$_POST['templatesfile'];
		$isenable=isset($_POST['isenable']) ? $_POST['isenable'] : 0;	 
		//Select the sub-class roots to obtain ID
		global $resultrootid;
		$resultrootid=0;
		$this->get_rootidfunc($fid);
		$rootid=$resultrootid;

		$temp_depth=$this->get_level($fid);
 
 
		$sql="insert into `".PRE."type`(`id`,`type`,`modelid`,`fid`,`name`,`keywords`,`smalltext`,`order`,`depth`,`pic_num`,`is_show`,`rootid`,`outurl`,`picdes`,`pagetype`,`templatesfile`,`isenable`) values(null,".$type.",".$modelid.",".$fid.",'".$name."','".$keywords."','".$smalltext."',".$order.",".$temp_depth.",".$temp_depth.",0,".$rootid.",'".$outurl."','".$picdes."',".$pagetype.",'".$templatesfile."','".$isenable."')";


 
		$db->query($sql);
	//	$this->class_add_update(0);
		echo "<script type='text/javascript'> if(confirm('是否要继续添加?')){ window.location.href='edit.php?action=add&type=$type&tid=$fid';}else{ window.location.href='list.php?type=$type';	}</script>";
	}
	
	//Modify the class
	function class_update() {
		global $db;
		$name=($_POST['name']);
		$keywords=($_POST['keywords']);
		$content=($_POST['content']);
		
		$fid=intval(($_POST['fid']));
		
		$modelid=isset($_POST['modelid']) ? $_POST['modelid'] : 1;
		$picdes=isset($_POST['picdes']) ? $_POST['picdes'] : "";
		
		$outurl=isset($_POST['outurl']) ? $_POST['outurl'] : '';	
		$pagetype=isset($_POST['pagetype']) ? $_POST['pagetype'] :0;

		//Select the sub-class roots to obtain ID
		global $resultrootid;
		$resultrootid=0;
		$this->get_rootidfunc($fid);
		$rootid=$resultrootid;
		
		$order=isset($_POST['order']) ? $_POST['order'] : 0;	
		$templatesfile=$_POST['templatesfile'];
		$isenable=isset($_POST['isenable']) ? $_POST['isenable'] : 0;	 
		
		
		//Select the sub-class roots to obtain ID
		$sql = "update ".PRE."type set `name`='".$name."',`keywords`='".$keywords."',`smalltext`='".$content."',`fid`=".$fid.",`rootid`=".$rootid.",`outurl`='".$outurl."',`order`=".$order.",`modelid`=".$modelid.",`picdes`='".$picdes."' ,`pagetype`='".$pagetype."',`templatesfile`='".$templatesfile."',`isenable`='".$isenable."' where `id`=".$_GET['tid'];
 
		
		$db->query($sql);
		//$this->class_add_update(0);
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('修改成功！');window.location.href='list.php?type=".$_GET['type']."';</SCRIPT>";
	}

	//Delete a category
	function class_del($class_id,$table) {
		global $db;

		$arr_id=$this->array_classid($class_id);
				
		$sql = "delete from `".PRE."type` where `id` in (".$arr_id.")";

		$db->query($sql) or die ("SQL execution error!");		
		$db->query("delete from `".PRE."article` where `cid` in (".$arr_id.")") or die ("SQL execution error!");
		//$this->class_add_update(0);
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='list.php?type=".$_GET["type"]."';</SCRIPT>";
	}	
 
	//Delete a category
	function class_child_del($class_id,$table,$sfid) {
		global $db;
 
		$arr_id=$this->array_classid($class_id);
		$sql = "delete from `".PRE."type` where `id` in (".$arr_id.")";
		$db->query($sql) or die ("SQL execution error!");		
		$db->query("delete from ".$table." where `cid` in (".$arr_id.")") or die ("SQL execution error!");
	//	$this->class_add_update(0);
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='list.php?type=".$_GET['type']."&fid=".$sfid."';</SCRIPT>";
	}		
	
	//Modify the class
	function class_child_update($sfid) {
		global $db;
		$name=($_POST['name']);
		$keywords=($_POST['keywords']);
		$content=($_POST['content']);
 		$sortnum=($_POST['sortnum']);
		$modelid=isset($_POST['modelid']) ? $_POST['modelid'] : 1;
		$picdes=isset($_POST['picdes']) ? $_POST['picdes'] : "";
		$pagetype=isset($_POST['pagetype']) ? $_POST['pagetype'] :0;

		$sql = "update ".PRE."type set `name`='".$name."',`modelid`=".$modelid.",`sortnum`=".$sortnum.",`keywords`='".$keywords."',`smalltext`='".$content."',`picdes`='".$picdes."',`pagetype`=".$pagetype." where `id`=".$_GET['tid'];
		$db->query($sql);
		//$this->class_add_update(0);
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('修改成功！');window.location.href='list.php?type=$_GET[type]&fid=$sfid';</SCRIPT>";
	}	
	
	//Add Category
	function class_child_add($sfid) {
		global $db;
		$name=($_POST['name']);
		$fid=intval(($_POST['fid']));
  		
		$type=intval(($_GET['type']));
		
		$modelid=isset($_POST['modelid']) ? $_POST['modelid'] : 1;
		$picdes=isset($_POST['picdes']) ? $_POST['picdes'] : "";
		$pagetype=isset($_POST['pagetype']) ? $_POST['pagetype'] :0;
		
		$keywords=($_POST['keywords']);
		$smalltext=($_POST['content']);
		$sortnum=($_POST['sortnum']);
		
		$sql="insert into `".PRE."type`(`id`,`type`,`modelid`,`fid`,`name`,`keywords`,`smalltext`,`sortnum`,`depth`,`pic_num`,`picdes`,`is_show`,`pagetype`) values(null,".$type.",".$modelid.",".$fid.",'".$name."','".$keywords."','".$smalltext."','".$picdes."',".$sortnum.",1,1,0,".$pagetype.")";

		$db->query($sql);
		//$this->class_add_update(0);
		echo "<script type='text/javascript'> if(confirm('是否要继续添加?')){ window.location.href='edit.php?action=add&type=".$type."&tid=0&fid=".$sfid."';}else{ window.location.href='list.php?type=".$type."&fid=".$sfid."';	}</script>";
	}
	
	//Categories and subcategories to get ID
	function array_classid2_($id){
		global $db;
		$arr_cid=$id;

		if(!$this->is_leaf($id)){
			$sql="select * from `".PRE."type` where `fid`=".$id."";
			 
			$rs=$db->query($sql);
			$t=0;
			while($row=$db->fetch_array($rs)){
				if ($t==0)
				{
					$arr_cid=$arr_cid.",".$row['id'];
					$sql2="select * from `".PRE."type` where `fid`=".$row['id']."";
					$rs2=$db->query($sql2);
					while($row2=$db->fetch_array($rs2)){
					$arr_cid=$arr_cid.",".$row2['id'];
					}
				}
				else
				{
					$arr_cid=$arr_cid.",".$row['id'];
					$sql2="select * from `".PRE."type` where `fid`=".$row['id']."";
					
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
	
	//Categories and subcategories to get ID
	function array_classid3($id){
		global $db;
		$sql="select * from `".PRE."type` where `id`=".$id."";	 
		$rs=$db->query($sql);
		while($row=$db->fetch_array($rs)){
			$fid=$row['fid'];
			
		}
		return $fid;
	}
			
	//Add and modify the contents of each module used
	function art_child_select($class_type,$fid){
		global $db;
		$sql="select * from `".PRE."type` where `type`='".$class_type."' and `rootid`=".intval($fid)."  order by `order`";

		$rs=$db->query($sql);
		while($row = $db->fetch_array($rs)){
 
			$zs="";
			for($i=1;$i<$row['depth'];$i++){
				$zs.="┆";
			}
			switch($row['pic_num']){
				case 1:
					$list_img = "";
					break;
				case 2:
					$list_img = "└";
					break;
				default:
					$list_img = "├";
			}
			if (isset($_GET['tid']) && $_GET['tid']==intval($row['id']) && $_GET['action']=='modify') {
				echo "<option value='".$row['id']."' selected='selected'>".$zs.$list_img.$row['name']."</option>\n";
			}else {
				echo "<option value='".$row['id']."'>".$zs.$list_img.$row['name']."</option>\n";
			}
 
		}
	}
	
	//When you add and modify columns
	function class_child_select($class_type,$fid){
		echo $_GET[tid];
		global $db;
		$sql="select * from `".PRE."type` where `type`='".$class_type."' and `fid`=".$fid." order by `order`";
		$rs=$db->query($sql);
		while($row = $db->fetch_array($rs)){
			$zs="";
			for($i=1;$i<$row['depth'];$i++){
				$zs.="┆";
			}
			switch($row['pic_num']){
				case 1:
					$list_img = "";
					break;
				case 2:
					$list_img = "└";
					break;
				default:
					$list_img = "├";
			}
			
			if (intval($_GET['tid'])== intval($row['id']) && $_GET['action']=='add') {
				echo "<option value='".$row['id']."' selected>$zs$list_img$row[name]</option>\n";
			}elseif (intval($_GET['tid']) == intval($row['id']) && $_GET['action'] == 'modify'){
				echo "<option value='".$row['id']."' selected>".$zs.$list_img.$row['name']."</option>\n";
			}else {
				echo "<option value='".$row['id']."'>".$zs.$list_img.$row['name']."</option>\n";
			}
		}
	}
	//Columns list shows
	function class_child_list($class_type,$fid){
		global $db;
		$sql="select * from `".PRE."type` where `type`='".$class_type."' and `fid`=".$fid." order by `order`";
		$rs=$db->query($sql);
		
		echo("     <table width='96%' height='28' border='0' align='center' cellpadding='4' cellspacing='1'  class='lrbtline'>\n");
		echo("        <tr>");
		echo("				<td width='8%' align='center' class='lrbtlineHead'>编号</td>\n");
		echo("				<td width='50%' align='center' class='lrbtlineHead'>类别名称</td>\n");
		echo("				<td width='14%' align='center' class='lrbtlineHead'>排序</td>\n");
 
		echo("				<td width='16%' align='center' class='lrbtlineHead'>操作</td>\n");
		echo("		</tr>");
		
		while($row = $db->fetch_array($rs)){
			$zs="";
			$fid=$row[fid];
			for($i=1;$i<$row["depth"];$i++){
				$zs.="<img src='../images/vertline.gif'/>";
			}
			switch($row[pic_num]){
				case 1:
					$list_img = "<img src='../images/open.gif'/>";
					break;
				case 2:
					$list_img = "<img src='../images/lastnodeline.gif'/>";
					break;
				default:
					$list_img = "<img src='../images/midopenedfolder.gif'/>";
			}
			if ($fid==0)
			{

				echo("<tr class='outrow' onMouseOver=\"this.className='onrow';\" onMouseOut=\"this.className='outrow';\">\n");
				echo("		<td align='center'  >".$row['id']."</td>\n");
				echo("		<td  >$zs$list_img"." "."".$row["name"]."</td>\n");
				echo("		<td align='center'  >".$row["order"]."</td>\n");
 
				echo("		<td align='center'  ><a href='edit.php?action=modify&type=".$row['type']."&tid=".$row['id']."&fid=".$fid."'><img src='../images/class_update.gif' alt='修改类别' /> 修改</a> <a onClick='DelOK(".$row['id'].",".$fid.")' href='#'><img src='../images/class_del.gif' alt='删除类别' /> 删除</a></td>\n");
				echo("</tr>\n");
			}
			else
			{
				echo("<tr class='outrow' onMouseOver=\"this.className='onrow';\" onMouseOut=\"this.className='outrow';\">\n");
				echo("		<td align='center'  >".$row['id']."</td>\n");
				echo("		<td  >$zs$list_img"." "."".$row['name']."</td>\n");
				echo("		<td align='center'  >".$row['sortnum']."</td>\n");
 
				echo("		<td align='center'  ><a href='eidt.php?action=modify&type=".$row['type']."&tid=".$row['id']."&fid=".$fid."'><img src='../images/class_update.gif' alt='修改类别' /> 修改</a> <a onClick='DelOK(".$row['id'].",".$fid.")' href='#'><img src='../images/class_del.gif' alt='删除类别' /> 删除</a></td>\n");
				echo("</tr>\n");
			}
		}
		echo("</table>\n");
	}

	//Get the depth of class
	function get_maxsortnum($class_id) {
		global $db;
		$sql = "select max(sortnum) as `aa` from `".PRE."type` where `fid`=".$class_id;

		$rs = $db->query($sql);
		$row = $db->fetch_array($rs);
		return $row['aa']+1;
	}
	
	/************** For Aritcle Called by FrontPage **************************************/
	//取得分类的记录类型
	function GetClassPageType($tid){
		if($tid!="" &&$tid!="0"){
			$sql="select pagetype from `".PRE."type` where `id`=".intval($tid)."";
			$rs=mysql_query($sql) or die ("查询出现错误");
			$ok=is_array($row=mysql_fetch_array($rs));
			return $row["pagetype"];
		}	
	}
	//取得分类的记录类型
	function GetTypeInfo($typeid){
		global $db,$func;
		$sql="select a.* from ".PRE."type a where a.id=".$typeid;
		$rs=mysql_query($sql) or die ("SQL execution error!");
		$ok=is_array($row=mysql_fetch_array($rs));
		$result=array('id'           =>$row['id'],	
			  		  'type'         =>$row['type'],
					  'modelid'      =>$row['modelid'],
					  'fid'          =>$row['fid'],
					  'pagetype'     =>$row['pagetype'],
					  'rootid'       =>$row['rootid'],
					  'name'         =>$row['name'],
					  'english'      =>$row['english'],
					  'keywords'     =>$row['keywords'],
					  'smalltext'    =>$row['smalltext'],
					  'order'        =>$row['order'],
			  		  'depth'        =>$row['depth'],
					  'isouturl'     =>$row['isouturl'],
					  'outurl'       =>$row['outurl'],
					  'templatesfile'=>$row['templatesfile'],					  
					  'isenable'     =>$row['isenable']
					  );
 
		return $result;
 
	}
	//取得信息分类
	function getclasstypename($typeid){
		if($typeid!="" &&$typeid!="0"){
			$sql="select * from `".PRE."type` where `ID`=".intval($typeid);
	
			$rs=mysql_query($sql) or die ("查询出现错误");
			$ok=is_array($row=mysql_fetch_array($rs));
			return $row["name"];
		}	
	}
	
	function getclasstypename_en($typeid){
		if($typeid!="" &&$typeid!="0"){
			$sql="select * from `".PRE."type` where `ID`=".intval($typeid);
	
			$rs=mysql_query($sql) or die ("查询出现错误");
			$ok=is_array($row=mysql_fetch_array($rs));
			return $row["english"];
		}	
	}
	
	 //取得底部子菜单
	function GetBottomMenuClass($tid,$targurl){
		global $db,$func;
		$result="";
		if($tid!="" && $tid!="0"){
			$strsql="select * from `".PRE."type` where `fid`=".intval($tid)."  order by `order` asc";
			$rst=$db->query($strsql) or die("查询错误");
			while($row=$db->fetch_array($rst)){
				$outurl=$row['OutUrl'];	
				$targeturl="";	
				if ($outurl!=""){
					$targeturl=$outurl;
				}else{
					$targeturl=$targurl."?sid=".$row['id'];
				}
				$result.=" | <a href=\"".$targeturl."\">".$row["name"]."</a>";
			}
		}
		echo $result;
	}
	
	//取得子菜单
	function GetLeftMenuClass($tid,$sid,$aid,$targurl_name){
		global $db;
		$result="";
		if($tid!="" && $tid!="0"){
			$strsql="select * from `".PRE."type` where `fid`=".intval($tid)."   order by `order` asc";
			$rst=$db->query($strsql) or die(sql_error);
			while($row=$db->fetch_array($rst)){
				$outurl=$row['outurl'];	
				$targeturl="";	
				$isblank="";
				if ($outurl!="")
				{
					$targeturl=$outurl;
					$isblank="target='_blank'";
				}
				else
				{
					$targeturl=$targurl_name."?tid=".$tid."&sid=".$row['id'];
				}

				if ($sid==$row['id']){
					//三级统计
					$cstrsql="select count(*) from `".PRE."type` where `fid`=".intval($row["id"])."   order by `order` asc";
					$crst=$db->query($cstrsql) or die(sql_error);
					$crow=$db->fetch_array($crst);
					$count=$crow[0];
 					$class="aboutsubmenusel";
					if ($count>0){
						$class="";
						if ($aid!=0 || $aid!=''){
						$result=$result."<li><span><a href=\"".$targeturl."\"   ".$isblank.">".$row["name"]."</a></span></li>";
						}else{
						$result=$result."<li><span><a href=\"".$targeturl."\"  class=\"".$class."\"  ".$isblank.">".$row["name"]."</a></span></li>";
						}
						
						$cstrsql="select * from `".PRE."type` where `fid`=".intval($row["id"])."   order by `order` asc";
						$arst=$db->query($cstrsql) or die(sql_error);
						while($arow=$db->fetch_array($arst)){
							$outurl=$arow['outurl'];	
							$targeturl="";	
							$isblank="";
							if ($outurl!="")
							{
								$targeturl=$outurl;
								$isblank="target='_blank'";
							}
							else
							{
								$targeturl=$targurl_name."?tid=".$tid."&sid=".$row['id']."&aid=".$arow['id'];
							}
							if ($aid==$arow['id']){
								$result=$result."<li class=\"itemsel\"><span><a href=\"".$targeturl."\"  class=\"aboutsubmenusel\" ".$isblank." >&nbsp;&nbsp;>&nbsp;".$arow["name"]."</a></span></li>";
							}else{
								$result=$result."<li class=\"itemsel\"><span><a href=\"".$targeturl."\" ".$isblank." >&nbsp;&nbsp;>&nbsp;".$arow["name"]."</a></span></li>";
							}

						}
					}else{
					$result=$result."<li><span><a href=\"".$targeturl."\"  class=\"".$class."\" ".$isblank.">".$row["name"]."</a></span></li>";
					}
				}else{
					
					$result=$result."<li><span><a href=\"".$targeturl."\"  ".$isblank.">".$row["name"]."</a></span></li>";
				}
								
			}
			echo $result;
		}	
	}
 
	//取得子菜单
	function GetSubMenu($tid,$sid,$targurl){
		global $db,$func,$ishtml,$site_extname;
		$result="";
		if($tid!="" && $tid!="0"){
			$strsql="select * from `".PRE."type` where `fid`=".intval($tid)."   order by `order` asc";
			$rst=$db->query($strsql) or die(sql_error);
			while($row=$db->fetch_array($rst)){
				$outurl=$row['outurl'];	
				$targeturl="";	
				if ($outurl!="")
				{
					$targeturl=$outurl."\" target=\"_blank\"";
				}
				else
				{
					if ($ishtml=="1"){
 						$targeturl="/list_".$tid."_".$row['id'].$site_extname;	
					}else{
 					    $targeturl="/pages/".$targurl."?tid=".$tid."&sid=".$row['id'];
					}
				}
				
				$result=$result." <td width=\"100\" align=\"center\"><a href=\"".$targeturl."\" style=\"color:#fff;\">".$row["name"]."</a></td>\n";
			}
			echo $result;
		}	
	} 
	
	//取得子菜单
	function GetSubMenuTop($tid,$targurl,$topnum){
		global $db,$func,$ishtml,$site_extname;
		$result="";
		if($tid!="" && $tid!="0"){
			$strsql="select * from `".PRE."type` where `fid`=".intval($tid)."   order by `order` asc limit 0,".$topnum."";
			$rst=$db->query($strsql) or die(sql_error);
			while($row=$db->fetch_array($rst)){
				$outurl=$row['outurl'];	
				$targeturl="";	
				if ($outurl!="")
				{
					$targeturl=$outurl."\" target=\"_blank\"";
				}
				else
				{	
					if ($ishtml=="1"){
 						$targeturl="/list_".$tid."_".$row['id'].$site_extname;					
					}else{
 						$targeturl="/pages/list.php?tid=".$tid."&sid=".$row['id'];
					}
				}
				
				$result=$result."<a href=\"".$targeturl."\" style=\"color:#fff;\">· ".$row["name"]."</a><br>\n";
			}
			echo $result;
		}	
	}	
	
	//取得信息分类
	function getdefaultclassid($tid){
		if($tid!="" &&$tid!="0"){
			$sql="select * from `".PRE."type` where `fid`=".intval($tid)." order by `order` asc limit 0,1";
			$rs=mysql_query($sql) or die (sql_error);
			$ok=is_array($row=mysql_fetch_array($rs));
			return $row["id"];
		}	
	}
	
	//取得信息分类
	function getparentclassid($tid){
		if($tid!="" &&$tid!="0"){
			$sql="select * from `".PRE."type` where `id`=".intval($tid)." order by `order` asc limit 0,1";
			$rs=mysql_query($sql) or die (sql_error);
			$ok=is_array($row=mysql_fetch_array($rs));
			return $row["fid"];
		}	
	}
	
	//取得分类信息
	function getClassInfo($typeid){
		if($typeid!="" && $typeid!="0"){
			$sql="select * from `".PRE."type` where `id`=".intval($typeid);
			
			$rs=mysql_query($sql) or die ("查询出现错误");
			$ok=is_array($row=mysql_fetch_array($rs));
			$result=array('id'         =>$row['id'],	
						  'name'    =>$row['name'],
						  'english'    =>$row['english']
						  );
			return $result;
		}	
	}
	
	//取得分类的记录类型
	function GetSubCount($tid){
		$sql="select count(*) from `".PRE."type` where `fid`=".intval($tid)."";
		$rs=mysql_query($sql) or die ("查询出现错误");
		$ok=is_array($row=mysql_fetch_array($rs));
		return $row[0];
	}
	
	//取得菜单消息 
	function getMenuInfo($tid){
		global $db,$type,$func,$site_keywords,$site_description;
		if($tid!="" &&$tid!="0"){
			$sql="select * from `".PRE."type` where `id`=".intval($tid)."";
			$rs=mysql_query($sql) or die ("SQL execution error!");
			$ok=is_array($row=mysql_fetch_array($rs));
			if ($row['keywords']!=""){
				$keywords=$row['keywords'];
			}else{
				$keywords=$site_keywords;
			}
			if ($row['smalltext']!=""){
				$smalltext=$row['smalltext'];
			}else{
				$smalltext=$site_description;
			}	
			$site_keywords=$keywords;
			$site_description=$smalltext;
			
			$result=array('id'           =>$row['id'],	
						  'keywords'     =>$keywords,
						  'smalltext'    =>$smalltext,
						  'name'         =>$row['name']
						  );
			return $result;
		}
	}
	
	/***分类调用函数****************************************************/
	
	//添加编辑分类调用函数
	function art_select($class_type,$fid,$selectid){
		global $db,$func;
		$sql="select * from `".PRE."type` where `type`='".$class_type."' and fid='".$fid."' order by `fid` asc,`order` asc";

		$rs=$db->query($sql);
		while($row = $db->fetch_array($rs)){
			$fid=$row['fid'];
			$zs="";
			for($i=1;$i<$row["depth"];$i++){
				if ($i==1){
					$zs.="├";				
				}else{
					$zs.="┴─";
				}
			}
			switch($row["pic_num"]){
				case 1:
					$list_img = "├";
					break;
				case 2:
					$list_img = "┴─";
					break;
				default:
					$list_img = "┴─";
			}
			if (isset($selectid) && $selectid==intval($row['id']) && $func->safe_check($_GET['action'],1)=='modify') {
				echo "<option value='".$row["id"]."' selected='selected'>$zs$list_img$row[name]</option>\n";
			}else {
				echo "<option value='$row[id]'>".$zs."".$list_img."".$row["name"]."</option>\n";
			}
			$this->art_select($class_type,$row["id"],$selectid);
		}
	}
	
	//– 获取无限分类ID下面的子类ID集 --子函数
	function getChildrenIds($classid){ 
		global $db; 
		$ids = ""; 
		$sql = "SELECT * FROM `".PRE."type` WHERE `fid` = '".$classid."' "; 
		$res=$db->query($sql); 
		if ($res) 
		{ 
			while ($row = $db->fetch_array ($res)) 
			{ 
				$ids.= ','.$row['id']; 
				$ids.= $this->getChildrenIds($row['id']); 
			}
		 } 
		return $ids; 
	} 
	//– 获取无限分类ID下面的子类ID集 
	function  downstrid($classid){
		$str= $this->getChildrenIds($classid);
/*		$str1 = substr($str,0,1);
		if ($str1==","){
			$str=substr($str,1,strlen($str)-1);
		}else if($str1==""){
			$str="0";
		}*/
		return $classid.$str;
	}
	
	//– 获取无限分类ID下面的子类ID集 
	function  array_classid2($classid){
		$str= $this->getChildrenIds($classid);
/*		$str1 = substr($str,0,1);
		if ($str1==","){
			$str=substr($str,1,strlen($str)-1);
		}else if($str1==""){
			$str="0";
		}*/
		
		return $classid.$str;
	}
	
	/*******************************************************/
}	
?>
