<?php
/**
 * Site information function class
 */
class site { 
	                             
	function GetSiteVer(){
		return $this->GetConfig("copyright");
	}
	function GetSiteUrl(){
		return $this->GetConfig("weburl");
	}
	function GetSiteResource(){
		return $this->GetConfig("webname");
	}
	function GetSiteKeywords(){
		return $this->GetConfig("keywords");
	}
	function GetSiteDescription(){
		return $this->GetConfig("smalltext");
	}	
	function GetSiteTitle(){
		return $this->GetConfig("title");
	}
	
				
	//get adver typename
	function GetConfig($ColumnName){
		global $db;
		if($ColumnName!="" ){
			$sql="select ".$ColumnName." from `".PRE."system`  order by id desc limit 0,1";
			$rs=mysql_query($sql) or die ("SQL execution error!");
			$ok=is_array($row=mysql_fetch_array($rs));
			return $row[$ColumnName];
		}	
	}
	//分割菜单函数
	function GetAdminMenu($TempStr){
		$Menu_1=explode("||",$TempStr);//函数把字符串分割为数组
		$BRCount = substr_count($TempStr, '||'); //计算","为多少个
		for($i=0;$i<=$BRCount;$i++){
			$Menu_2 =explode("@@",$Menu_1[$i]);
			$BRCount2 = substr_count($Menu_1[$i],"@@"); //计算","为多少个
			echo"<li id=\"menu_".$i."\" onMouseOver=\"Menus.Show(this,0)\" onMouseOut=\"Menus.Hide(0);\"  onClick=\"getleftbar(this,$i);\">";
			echo"<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">";
			echo"<tr>";
			echo"<td height=\"23\" valign=\"bottom\">".$Menu_2[0]."</td>";
			echo"<td width=\"6\" height=\"23\"></td>";
			echo"<td width=\"3\" height=\"23\"><img src=\"skins/images/menu01_right.gif\" width=\"3\" height=\"23\" /></td>";
			echo"</tr>";
			echo"</table>";
			echo"<div class=\"menu_childs\">";
			echo"<ul>";
		 
			for ($j=1;$j<=$BRCount2;$j++){
				echo "<li>".$Menu_2[$j]."</li>";
			}
			echo"</ul>";
			echo"</div>";
			echo"</li>";
		  } 
	 }
	//设置后台菜单函数
	function GetAdminMenuTempStr(){
		global $db,$func;
		$TempStr = "<a style='cursor:hand;'>我的面板</a>";
		$TempStr = $TempStr. "@@<a href='../' target='_blank'>网站首页</a>";
		$TempStr = $TempStr. "@@<a href='index.php' target='_top'>后台首页</a>";
		$TempStr = $TempStr. "@@<a href='personal/index.php' target='frmright'>修改密码</a>";
		$TempStr = $TempStr ."@@<a href='logout.php' target='_top'>退出管理</a>";
		
		if ($func->PermitAdmin("B0001")){
			$TempStr = $TempStr ."||<a style='cursor:hand;'>内容管理</a>";
			$TempStr = $TempStr ."@@<a href='article/edit.php?action=add' target='frmright'>内容添加</a>";
			$TempStr = $TempStr ."@@<a href='article/list.php' target='frmright'>内容管理</a>";
			$TempStr = $TempStr ."@@<a href='type/list.php?type=1' target='frmright'>栏目管理</a>";
		}

		if ($func->PermitAdmin("M0001")){
			$TempStr = $TempStr ."||<a style='cursor:hand;'>系统设置</a>";
			$TempStr = $TempStr ."@@<a href='config/index.php' target='frmright'>站点配置</a>";
			$TempStr = $TempStr ."@@<a href='guest/list.php' target='frmright'>留言管理</a>";
			$TempStr = $TempStr ."@@<a href='adv/list.php' target='frmright'>广告管理</a>";
			$TempStr = $TempStr ."@@<a href='links/list.php' target='frmright'>友情链接</a>";
			$TempStr = $TempStr ."@@<a href='comment/list.php' target='frmright'>评论管理</a>";
			$TempStr = $TempStr ."@@<a href='vote/list.php' target='frmright'>在线调查</a>";
			$TempStr = $TempStr ."@@<a href='manager/list.php' target='frmright'>管理员管理</a>";
			$TempStr = $TempStr ."@@<a href='managertype/list.php' target='frmright'>管理权限组</a>";
			$TempStr = $TempStr ."@@<a href='backup/sql.php' target='frmright'>数据备份</a>";
		}	
		return $TempStr;
	}
	
	function GetAdminDefaultMenuItem(){
	    global $db,$func;
		if ($func->PermitAdmin("F0001")){
			$TempStr = $TempStr ."<li><a href=\"article/edit.php?action=add\" target='frmright'>内容发布</a></li>";
			$TempStr = $TempStr ."<li><a href=\"article/list.php\" target='frmright'>内容管理</a></li>";	
		}

		if ($func->PermitAdmin("A1002")){
			$TempStr = $TempStr ."<li><a href=\"personal/index.php\" target='frmright'>修改密码</a></li>";
		}
		$TempStr = $TempStr ."<li><a href=\"logout.php\" target='_top'>退出管理</a></li>";
		return $TempStr;
	}
} 
?>