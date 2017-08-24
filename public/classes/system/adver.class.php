<?php
/**
 * 广告管理类库
 */
class adver{

	/****后台-广告管理***************************************************************************/
	//首页-广告列表
	function adverlist($tmpsql,$pagesize,$arrparam){
		global $db,$func,$type;
		$page2=isset($_GET['page']) ? $_GET['page'] :1;
		$sql=$tmpsql;
		$arr=$func->get_page_num($sql,$pagesize);
		$sql.=" limit $arr[1], $pagesize";
		$rs=$db->query($sql) or die("SQL execution error！");
		
		echo "<table width='100%' border='0' align='center' cellpadding='2' cellspacing='0' class='lrbtline'>";
		echo "		<tr>";
		echo "				<td width='6%' align='center' class='lrbtlineHead'><input name=\"chkall\" type=\"checkbox\" id=\"chkall\" onclick=\"javascript:CheckAll(this.form);\"  style=\"border:0px;\"  title='全选择或者全取消' > <input type=button onclick='javascript:del(this.form);' value='×' title='删除选择项'></td>";
		echo "				<td width='30%' align='center' class='lrbtlineHead'>广告标题</td>";
		echo "				<td width='21%' align='center' class='lrbtlineHead'>广告类别 </td>";
		echo "				<td width='10%' align='center' class='lrbtlineHead'>排序号 </td>";
		echo "				<td width='8%' align='center' class='lrbtlineHead'>缩略图</td>";
	
		echo "				<td width='15%' align='center' class='lrbtlineHead'>操作</td>";
		echo "		</tr>";
		
		while($row = $db->fetch_array($rs)){
				$advpic=$row['advpic'];
				$advurl=$row['advurl'];
				$width=$row['width']/3;
				$height=$row['height']/3;
				$targeturl=$advurl;	
				$ext=strtolower($func->GetFieExt($advpic));
				echo "		<tr  class='outrow' onMouseOver=\"this.className='onrow';\" onMouseOut=\"this.className='outrow';\">";
				echo "				<td align='center'><input name='id' id='id'  type='checkbox' value='$row[id]' style='border:0px;'></td>";
				echo "				<td><a href=\"".$targeturl."\" target='_blank'>".$row['advname']."</a>  ( ID:".$row['id']." )</td>";
				echo "				<td align='left'>".$this->getadvtypename($row['typeid'])."</td>";	
				echo "				<td align='center'>".$row['sortid']."</td>";	
				
				if ($ext=="jpg" || $ext=="gif" || $ext=="jpeg" || $ext=="bmp" || $ext=="png"){
					echo "				<td align='left'><a href=\"".$advpic."\" target=_blank><img src='".$advpic."' bordr=0 height=24></a></td>";
				}elseif ($ext=="swf"){
					$result="<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000'  codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0' width='$width' height='$height'>  <param name='movie' value='$advpic' /> <param name='quality' value='high' />  <embed src='$advpic' width='$width' height='$height' quality='high' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash'></embed>  </object>";
					echo "				<td align='left'>$result</td>";
				}
				
				
				echo "				<td align='center'><a href='edit.php?page=".$page2."&action=modify&tid=".$row['typeid']."&id=".$row['id']."&".$arrparam."'><img src='../images/class_update.gif' alt='修改' /> 修改</a&nbsp;><a href='editdo.php?page=".$_GET["page"]."&action=del&id=".$row['id']."&$arrparam'   onclick=\"return configdel();\" ><img src='../images/class_del.gif' alt='删除' /> 删除</a> </td>";
				echo "</tr>";
		}
		echo "</table>";
		
		new cmspage($arr[0],$pagesize,$arrparam);
	}

	//首页-添加广告
	function adver_add() {
		global $db,$type,$func;
		$typeid=intval(($_POST['typeid']));
		$advname=($_POST['advname']);	
		$advpic=($_POST['advpic']);	
		$advurl=($_POST['advurl']);	
 		$memo=($_POST['memo']);
 		$width=$_POST['width']; 
		$height=$_POST['height']; 
		$sortid=$_POST['sortid']; 
		$time=date("Y-m-d H:i:s"); 
		$ip=$_SERVER['REMOTE_ADDR'];

		$sql="insert into ".PRE."adv (typeid,advname,advpic,advurl,memo,sortid) values (".$typeid.",'".$advname."','".$advpic."','".$advurl."','".$memo."',".$sortid.")";
 

		$db->query($sql) or die("SQL execution error!");
		echo "<script type='text/javascript'> if(confirm('是否要继续添加?')){ window.location.href='edit.php?action=add&tid=0';}else{ window.location.href='list.php';	}</script>";
	}
 
	//首页-修改广告
	function adver_update() {
		global $db,$type,$func;
		$typeid=intval(($_POST['typeid']));
		$advname=($_POST['advname']);	
		$advpic=($_POST['advpic']);	
		$advurl=($_POST['advurl']);	
 		$memo=($_POST['memo']);
 		$width=$_POST['width']; 
		$height=$_POST['height']; 
		$sortid=$_POST['sortid']; 
		$act=isset($_POST['act']) ? $_POST['act'] : '';
		$keyword=isset($_POST['keyword']) ? $_POST['keyword'] : '';
		$page=isset($_POST['page']) ? $_POST['page'] :1;
		
		$url="page=".$page."&act=".$act."&keyword=".$keyword."&typeid=".$typeid."&fid=".$fid."";
		
		$sql="update `".PRE."adv` set `typeid` = ".$typeid.",`advname` = '".$advname."',`advpic`='".$advpic."',`advurl`='".$advurl."',`memo`='".$memo."',`sortid`=".$sortid." WHERE `id` =".$_GET['id'];	
 
		$db->query($sql) or die("SQL execution error!");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('修改成功！');window.location.href='list.php?$url';</SCRIPT>";
	}

	//首页-删除单个广告
	function adver_del() {
		global $db;
		$typeid=isset($_GET['typeid']) ? $_GET['typeid'] : '';
		$act=isset($_GET['act']) ? $_GET['act'] : '';
		$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$page=isset($_GET['page']) ? $_GET['page'] : '';
		
		$url="page=$page&act=$act&keyword=$keyword&typeid=$typeid";
		$sql = "delete from `".PRE."adv` where `id` in (".$_GET['id'].")";
		$db->query($sql) or die("SQL execution error!");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='list.php?$url';</SCRIPT>";
	}
	
	//首页-删除多个广告
	function adver_delall() {
		global $db;
		$typeid=isset($_GET['typeid']) ? $_GET['typeid'] : '';
		$act=isset($_GET['act']) ? $_GET['act'] : '';
		$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$page=isset($_GET['page']) ? $_GET['page'] : '';
		
		$url="page=$page&act=$act&keyword=$keyword&typeid=$typeid";
		$sql = "delete from `".PRE."adv` where `id` in (".$_POST['delaid'].")";
 
		$db->query($sql) or die("SQL execution error!");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='list.php?$url';</SCRIPT>";
	}
		
	//首页-取得广告分类名
	function getadvtypename($typeid){
		global $db;
		if($typeid!="" &&$typeid!="0"){
			$sql="select typename from `".PRE."advtype` where `id`=".intval($typeid);

			$rs=mysql_query($sql) or die ("SQL execution error!");
			$ok=is_array($row=mysql_fetch_array($rs));
			return $row["typename"];
		}	
	}
	
	/**************后台-广告分类管理*******************************************************************/
	
	//后台-广告分类泪飚
	function advertypelist($tmpsql,$pagesize,$arrparam){
		global $db,$func,$type;
		$page2=isset($_GET['page']) ? $_GET['page'] :1;
		$sql=$tmpsql;
		$arr=$func->get_page_num($sql,$pagesize);
		$sql.=" limit $arr[1], $pagesize";
		$rs=$db->query($sql) or die("SQL execution error！");
		
		echo "<table width='100%' border='0' align='center' cellpadding='2' cellspacing='0' class='lrbtline'>";
		echo "		<tr>";
		echo "				<td width='60' align='center' class='lrbtlineHead'><input name=\"chkall\" type=\"checkbox\" id=\"chkall\" onclick=\"javascript:CheckAll(this.form);\"  style=\"border:0px;\"  title='全选择或者全取消' > <input type=button onclick='javascript:del(this.form);' value='×' title='删除选择项'></td>";
		echo "				<td   width='50' align='center' class='lrbtlineHead'>ID</td>"; 
		echo "				<td   align='center' class='lrbtlineHead'>类别名称(ID)</td>";
		echo "				<td width='8%' align='center' class='lrbtlineHead'>排序</td>";
	    echo "				<td width='25%' align='center' class='lrbtlineHead'>广告尺寸</td>"; 
		echo "				<td width='150' align='center' class='lrbtlineHead'>操作</td>";
		echo "		</tr>";
		
		while($row = $db->fetch_array($rs)){
				if ($row['width']!=0 && $row['width']!=0){
					$imgsizeinfo="".$row['width']."×".$row['height']."像素";
				}else{
					$imgsizeinfo="";
				}
				echo "		<tr  class='outrow' onMouseOver=\"this.className='onrow';\" onMouseOut=\"this.className='outrow';\">";
					
				echo "				<td align='center'><input name='id' id='id'  type='checkbox' value='$row[id]' style='border:0px;'></td>";
				echo "				<td  align='center'>".$row['id']."</td>";	
				echo "				<td>".$row['typename']."</td>";		
				echo "				<td align='center'>".$row['sortid']."</td>";
				echo "				<td align='center'>".$imgsizeinfo."</td>";
				/*echo "				<td align='left'><input type=text value='<!--".$row['typename']."--><script src=\"/common/getadv.php?typeid=".$row['id']."\"></script>' style='width:300px;' onclick='select();'></td>";		*/	
				echo "				<td align='center'><a href='edit.php?page=".$page2."&action=modify&id=".$row['id']."&".$arrparam."'><img src='../images/class_update.gif' alt='修改' /> 修改</a&nbsp;><a href='editdo.php?page=".$_GET["page"]."&action=del&id=".$row['id']."&$arrparam'   ><img src='../images/class_del.gif' alt='删除' /> 删除</a> </td>";
				echo "</tr>";
		}
		echo "</table>";
		
		new cmspage($arr[0],$pagesize,$arrparam);
	}

	//后台-添加广告分类
	function advertype_add() {
		global $db,$func;
		$typename=($_POST['typename']);	
		$sortid=($_POST['sortid']);	
		$width=($_POST['width']);	 
		$height=($_POST['height']);	 		
		
		
		$sql="insert into ".PRE."advtype (typename,sortid,width,height) values ('".$typename."',".$sortid.",".$width.",".$height.")";

		$db->query($sql) or die("SQL execution error!");
		echo "<script type='text/javascript'> if(confirm('是否要继续添加?')){ window.location.href='edit.php?action=add&tid=0';}else{ window.location.href='list.php';	}</script>";
	}
 
	//后台-修改广告分类
	function advertype_update() {
		global $db,$func;
		$typename=($_POST['typename']);	
		$sortid=($_POST['sortid']);	
		$width=($_POST['width']);	 
		$height=($_POST['height']);	
		
		$act=isset($_POST['act']) ? $_POST['act'] : '';
		$keyword=isset($_POST['keyword']) ? $_POST['keyword'] : '';
		$page=isset($_POST['page']) ? $_POST['page'] :1;
		
		$url="page=".$page."&act=".$act."&keyword=".$keyword;
		
		$sql="update `".PRE."advtype` set `sortid` = ".$sortid.",`typename` = '".$typename."',`width` = '".$width."',`height` = '".$height."'   WHERE `id` =".$_GET['id'];	

		$db->query($sql) or die("SQL execution error!");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('修改成功！');window.location.href='list.php?$url';</SCRIPT>";
	}

	//后台-删除单个广告分类
	function advertype_del() {
		global $db;
 
		$act=isset($_GET['act']) ? $_GET['act'] : '';
		$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$page=isset($_GET['page']) ? $_GET['page'] : '';
		
		$url="page=$page&act=$act&keyword=$keyword";
		$sql = "delete from `".PRE."advtype` where `id` in (".$_GET['id'].")";
		$db->query($sql) or die("SQL execution error!");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='list.php?$url';</SCRIPT>";
	}
	
	//后台-删除多个广告分类
	function advertype_delall() {
		global $db;
		$typeid=isset($_GET['typeid']) ? $_GET['typeid'] : '';
		$act=isset($_GET['act']) ? $_GET['act'] : '';
		$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$page=isset($_GET['page']) ? $_GET['page'] : '';
		
		$url="page=$page&act=$act&keyword=$keyword";
		$sql = "delete from `".PRE."advtype` where `id` in (".$_POST['delaid'].")";
 
		$db->query($sql) or die("SQL execution error!");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='list.php?$url';</SCRIPT>";
	}
	
	/**************后台-广告调用*******************************************************************/
	
	//显示广告图
	function advshowpic($typeid){
		global $db,$func;
 		$tmpsql = "select * from `".PRE."adv` where `advname`<>''  and `typeid`=".$typeid." order by id asc limit 0,1";
 
		$tmpk=0;
		$rs=$db->query($tmpsql) or die("SQL execution error！");
		while($row = $db->fetch_array($rs)){
			$advpic="../".$func->getrealpath($row["advpic"]);
			$result=$result."<a href=\"".$row["advurl"]."\" title=\"".$row["advname"]."\"><img src=\"".$advpic."\" style=\"border:1px solid #ddd;\"></a>"; 
			$tmpk=$tmpk+1;
			if ($tmpk%5==0){$result=$result."";}		
		}
 
		echo $result;
	}
	
	//显示swf广告
	function advshowswf($typeid){
		global $db,$func;
 		$tmpsql = "select * from `".PRE."adv` where `advname`<>''  and `typeid`=".$typeid." order by id asc";
		$resultlink="";
		$resultpic="";
		$tmpk=0;
		$rs=$db->query($tmpsql) or die("SQL execution error！");
		while($row = $db->fetch_array($rs)){
			if ($tmpk==0){
			$resultlink=$row["advurl"];
			$resultpic=$func->getrealpath($row["advpic"]);
			}else{
			$resultlink=$resultlink."|".$row["advurl"];
			$resultpic=$resultpic."|".$func->getrealpath($row["advpic"]);
			}
			$tmpk=$tmpk+1;
		}

		echo "<script type=\"text/javascript\">";
		echo "AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0','width','950','height','340','src','swf/show','quality','high','wmode','transparent','pluginspage','http://www.macromedia.com/go/getflashplayer','bgcolor','#000000','menu','false','flashvars','bcastr_file=$resultpic&bcastr_link=$resultlink&AutoPlayTime=5&Tween=3','movie','swf/show' ); //end AC code";
		echo "</script>";
		echo $result;
	}	
	
	function bannershow_index($typeid){
		global $db,$func;
 		$tmpsql = "select * from `".PRE."adv` where `advpic`<>''  and `typeid`=".$typeid." order by advname asc limit 0,6";
		$tmpk=0;
 
		$rs=$db->query($tmpsql) or die("SQL execution error！");
		while($row = $db->fetch_array($rs)){
			$advpic=$func->getrealpath($row["advpic"]);
			if ($tmpk==0){
				$result=$result."<a href=\"".$row["advurl"]."\" style=\"background-image: url('".$advpic."')\" target=\"_blank\"></a> \n";
			}else{
				$result=$result."<a href=\"".$row["advurl"]."\" style=\"background-image: url('".$advpic."')\" target=\"_blank\"></a>\n";
			}
			$tmpk=$tmpk+1;
		}
		echo $result;
	}
	
	function bannershow_indexNumber($typeid){
		global $db,$func;
 		$tmpsql = "select * from `".PRE."adv` where `advpic`<>''  and `typeid`=".$typeid." order by advname asc limit 0,6";
		$tmpk=0;
 
		$rs=$db->query($tmpsql) or die("SQL execution error！");
		while($row = $db->fetch_array($rs)){
			$advpic=$func->getrealpath($row["advpic"]);
			if ($tmpk==0){
				$result=$result."<a href=\"javascript:void(0)\" class=\"current\"></a>\n";
			}else{
				$result=$result."<a href=\"javascript:void(0);\"></a>\n";
			}
			$tmpk=$tmpk+1;
		}
		echo $result;
	}
	
	//显示内页广告
	function nyadv($typeid){
		global $db,$func;
 		$tmpsql = "select * from `".PRE."adv` where `advpic`<>''  and `typeid`=".$typeid." limit 0,1";
		$tmpk=0;
		$advpic="";
		$result="";
		$w=$this->getadvtype_w($typeid);
		$h=$this->getadvtype_h($typeid);
		$rs=$db->query($tmpsql) or die("SQL execution error！");
		while($row = $db->fetch_array($rs)){
			$advpic=$func->getrealpath2($row["advpic"]);
			$result="<div style=\"background:url(".$advpic.") no-repeat top center;  height:".$h."px;\"></div>";
		}
		echo $result;
	}
	//显示招聘广告
	function jobAdvShow($typeid){
		global $db,$func;
 		$tmpsql = "select * from `".PRE."adv` where `advpic`<>''  and `typeid`=".$typeid." order by advname asc limit 0,6";
		$tmpk=0;
 
		$rs=$db->query($tmpsql) or die("SQL execution error！");
		while($row = $db->fetch_array($rs)){
			$advpic=$func->getrealpath2($row["advpic"]);
			$result=$result."<li><a href=\"".$row["advurl"]."\" target=_blank><img src=\"".$advpic."\" border=0></a></li>\n";
		}
		echo $result;
	}
	
	//show  bannershow for  frontpage
	function bannershow($typeid){
		global $db,$func;
 		$tmpsql = "select * from `".PRE."adv` where `advpic`<>''  and `typeid`=".$typeid." order by advname asc limit 0,6";
		$tmpk=0;
 
		$rs=$db->query($tmpsql) or die("SQL execution error！");
		while($row = $db->fetch_array($rs)){
			$advpic=$func->getrealpath($row["advpic"]);
			$result=$result."<li><a href=\"".$row["advurl"]."\" style=\"background:url(".$advpic.") no-repeat top center;width:1260px;\"></a></li>";

		}
		echo $result;
	}
	
	function bannershow2($typeid){
		global $db,$func;
 		$tmpsql = "select * from `".PRE."adv` where `advpic`<>''  and `typeid`=".$typeid." order by advname asc limit 0,6";
		$tmpk=0;
 
		$rs=$db->query($tmpsql) or die("SQL execution error！");
		while($row = $db->fetch_array($rs)){
			$advpic=$func->getrealpath($row["advpic"]);
			$result=$result."<li><a href=\"".$row["advurl"]."\" style=\"background:url(".$advpic.") no-repeat top center;height:221px; width:1200px;\" ></a></li>";

		}
		echo $result;
	}
	
	//自动判断广告信息，自动调用类型。(单张广告调用)
	function showadv($typeid){
		global $db,$func;
 		$tmpsql = "select a.*,b.width,b.height from `".PRE."adv` a  left outer join  `".PRE."advtype` b on a.typeid=b.id where a.advpic<>''  and a.typeid=".$typeid." order by a.id desc limit 0,1";
		//echo $tmpsql;
		$rs=$db->query($tmpsql) or die("SQL execution error！");
		while($row = $db->fetch_array($rs)){
			$advpic=$func->getrealpath($row["advpic"]);
			$advname=$row["advname"];
			$advurl=$row["advurl"];
			$width=$row["width"];
			$height=$row["height"];
		}
		if ($advpic!=""){
			if ($advurl!=""){
			$result="<a href=\"".$advurl."\" target=_blank><img src='".$advpic."'  width=\"".$width."\"  height=\"".$height."\" border='0' style=\"border:0px solid #fff;\"></a>";	
			}else{
			$result="<img src='".$advpic."'  width=\"".$width."\"  height=\"".$height."\" border='0' style=\"border:0px solid #fff;\">";	
			}
		}
		
		echo  $result;
	}
	
	//广告首页
	function index_advslide($typeid,$topnum){
		global $db,$func;
 		$tmpsql = "select * from `".PRE."adv` where `advpic`<>''  and `typeid`=".$typeid." order by sortid desc limit 0,".$topnum."";
		
		$tmpk=0;
		$rs=$db->query($tmpsql) or die("SQL execution error！");
		while($row = $db->fetch_array($rs)){
			$advpic=$func->getrealpath2($row["advpic"]);
			$advname=$row["advname"];
			$advurl=$row["advurl"];
			$result=$result."<li><a href=\"".$advurl."\" target=_blank><img src=\"".$advpic."\" width=\"1000\" height=\"315\" border=\"0\" /></a></li>\n";		
			$tmpk=$tmpk+1;
		}
		echo $result;
	}
	
	///广告首页
	function showslideadv_index($typeid){
		global $db,$func;
 		$tmpsql = "select * from `".PRE."adv` where `advpic`<>''  and `typeid`=".$typeid." order by sortid desc limit 0,4";
		
		$tmpk=1;
		$rs=$db->query($tmpsql) or die("SQL execution error！");
		while($row = $db->fetch_array($rs)){
			$advpic=$func->getrealpath2($row["advpic"]);
			$advname=$row["advname"];
			$advurl=$row["advurl"];
			$result=$result."<li style=\"background:url('".$advpic."') no-repeat center top\"><a href=\"".$advurl."\" target=\"_blank\">pwstrick".$tmpk."</a></li>\n";	
				
			$tmpk=$tmpk+1;
		}
		echo $result;
	}
 
	///广告首页
	function showslideadv($typeid,$topnum){
		global $db,$func;
 		$tmpsql = "select * from `".PRE."adv` where `advpic`<>''  and `typeid`=".$typeid." order by sortid desc limit 0,".$topnum."";
		
		$tmpk=0;
		$rs=$db->query($tmpsql) or die("SQL execution error！");
		while($row = $db->fetch_array($rs)){
			$advpic=$func->getrealpath2($row["advpic"]);
			$advname=$func->getrealpath2($row["advname"]);
			//$result=$result."<li><a href=\"".$row["advurl"]."\"><img src=\"".$advpic."\" width=\"1002\" height=\"300\" border=0></a></li>";		
			$result=$result."<a href=\"".$row["advurl"]."\" class=\"img\" style=\"background:url(".$advpic.") no-repeat center top\"></a>";
		}
		echo $result;
	}
	
	//显示数字
	function showslideadv_number($typeid,$topnum){
		global $db,$func;
 		$tmpsql = "select * from `".PRE."adv` where `advpic`<>''  and `typeid`=".$typeid." order by sortid desc limit 0,".$topnum."";
		$tmpk=0;
		$result="";
		$rs=$db->query($tmpsql) or die("SQL execution error！");
		while($row = $db->fetch_array($rs)){
			$tmpk=$tmpk+1;
			//$result=$result."<li><a href=\"javascript:void(0);\">".$tmpk."</a></li>";		
			$result=$result."\n<td><div><img src=\"/images/img49.png\" width=\"18\" height=\"18\" class=\"t1\" /><img src=\"/images/img50.png\" width=\"18\" height=\"18\"/></div></td>\n";
		}
		echo $result;
	}
	
	//取得广告宽度
	function getadvtype_w($typeid){
		global $db;
		if($typeid!="" &&$typeid!="0"){
			$sql="select width from `".PRE."advtype` where `id`=".intval($typeid);
			$rs=mysql_query($sql) or die ("SQL execution error!");
			$ok=is_array($row=mysql_fetch_array($rs));
			return $row["width"];
		}	
	}
	
	//取得广告高度
	function getadvtype_h($typeid){
		global $db;
		if($typeid!="" &&$typeid!="0"){
			$sql="select height from `".PRE."advtype` where `id`=".intval($typeid);
			$rs=mysql_query($sql) or die ("SQL execution error!");
			$ok=is_array($row=mysql_fetch_array($rs));
			return $row["height"];
		}	
	}

	//项目施工广告
	function WapShowPic($typeid){
		global $db,$func;
 		$tmpsql = "select * from `".PRE."adv` where `advname`<>''  and `typeid`=".$typeid." order by id asc limit 0,1";
 
		$tmpk=0;
		$rs=$db->query($tmpsql) or die("SQL execution error！");
		while($row = $db->fetch_array($rs)){
			$advpic=$func->getrealpath2($row["advpic"]);
			$result=$result."<img src=\"".$advpic."\" alt=\"\" class=\"am-img-responsive\">"; 
			$tmpk=$tmpk+1;
		}
 
		echo $result;
	}
	
	//技能培训广告
	function WapAdvPage($typeid){
		global $db,$func;
 		$tmpsql = "select * from `".PRE."adv` where `advname`<>''  and `typeid`=".$typeid." order by id asc limit 0,1";
 
		$tmpk=0;
		$rs=$db->query($tmpsql) or die("SQL execution error！");
		while($row = $db->fetch_array($rs)){
			$advpic=$func->getrealpath2($row["advpic"]);
			$result=$result."<div class=\"newbie-banner\" style=\"background: url('".$advpic."')top center; height:310px;\"></div>"; 
			$tmpk=$tmpk+1;
		}
 
		echo $result;
	}
	
	/*----手机版------------------------------------------------------*/
	//移动端BANNER
	function wapBanner($typeid){
		global $db,$func;
 		$tmpsql = "select * from `".PRE."adv` where `advpic`<>''  and `typeid`=".$typeid." order by advname asc limit 0,6";
		$tmpk=0;
 
		$rs=$db->query($tmpsql) or die("SQL execution error！");
		while($row = $db->fetch_array($rs)){
			$advpic=$func->getrealpath2($row["advpic"]);
			$result=$result."<li><img src=\"".$advpic."\" ></li>\n";

		}
		echo $result;
	}
}
?>