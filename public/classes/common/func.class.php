<?php
/**
 * Common functions class library
 */
class func{

	function func(){}
	
	//********The following function has nothing to do with the database******************************************************
	//Call Editor
	function CallFCKEditor($FieldName,$FieldValue){
 	$sBasePath = $_SERVER['PHP_SELF'] ;
		$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;
		$oFCKeditor = new FCKeditor($FieldName) ;

		$oFCKeditor->Value =$FieldValue ;
		$oFCKeditor->Width = FCK_Width;   
		$oFCKeditor->Height = FCK_Height;
		$oFCKeditor->Create() ; 
 
	}
	
	//Call the front desk editor	
	function CallFCKEditorForPage($FieldName,$FieldValue){
		$sBasePath = $_SERVER['PHP_SELF'] ;
		$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "_samples" ) ) ;
		$oFCKeditor = new FCKeditor($FieldName) ;
		$oFCKeditor->ToolbarSet ='Basic';
		$oFCKeditor->Value =$FieldValue ;
		$oFCKeditor->Width = FCK_Width;   
		$oFCKeditor->Height = FCK_Height;
		$oFCKeditor->Create() ;
	}
	//取得编辑器中第一张图片地址	
	function GetEditorPic($Content){
		$pattern="/<img.*?src=[\'|\"](.*?(?:[\.gif|\.jpg]))[\'|\"].*?[\/]?>/";
		$output = preg_match_all($pattern,$Content,$matchs);
		$firstpic=$matchs[1][0];
		return $firstpic;
	}	
	//取得图片的高度
	function getHeight($image) {
		$sizes = getimagesize($image);
		$height = $sizes[1];
		return $height;
	}
	//取得图片的宽度
	function getWidth($image) {
		$sizes = getimagesize($image);
		$width = $sizes[0];
		return $width;
	}
	//Computing time and version information script
	function getmicrotime(){ 
		global $timer,$site;
		$timer->stop();   //In the script file to call this method at the end
		echo "<div style='padding-top:10px; color:#135294;' align=center>Technical Support：<b>cdydinfo inc</b>.&nbsp;&nbsp;Version：v1.01</b>&nbsp;&nbsp;Script Running Time：<b>".$timer->spent()."</b>&nbsp;秒</div>";  //Output page run time execution
    } 
 
	//检测是否在指定内容
	function ischeck($tar,$sel){
		$str = $tar;
		if( strrpos($str,$sel)!=false )
		{
			return 1;
		}
		else
		{
		 return 0;
		}
	}
	//Whether for IE6
	function IsIE6(){
		if(strpos($_SERVER['HTTP_USER_AGENT'],'MSIE 6.0') !== false ){
			return false;
		}else{
			return true;
		}	
	}
	
	//Obtain the existence of the specified word address uri
	function checkuri($subcode){
		$res=$_SERVER["REQUEST_URI"];
		$is_exist = is_int(strpos($res,$subcode));
		if ($is_exist)
		{
			return true;
		}else{
			return false;
		}
	}
	//取得主机的当前地址
	function GetHttpHost(){
		$res="http://".$_SERVER['HTTP_HOST']."/";
		return $res;
	}

	//Get file extension
	function GetFieExt($file_name){
		$ext=$file_name;
		$extstr=explode('.',$ext);
		$count=count($extstr)-1;
		return $extstr[$count];
	}
	
	 //Static and dynamic mode switching function
	 function  getexthtml($paramName,$paramID){
	 	global $ishtml,$site_extname;
		if ($ishtml=="1"){
			return "_".$paramID.$site_extname;	
		}else if ($ishtml=="0"){
			return ".php?".$paramName."=".$paramID;	
		}
 
	 }
	 
	 //Static and dynamic mode switching function
	 function  get_param_html_two($paramName,$tid,$sid){
	 	global $db,$ishtml,$site_extname;
		$isouturl=0;
		$outurl="";
		$sql="select * from `".PRE."type` where `id`=".intval($sid)."";
		$rs=mysql_query($sql) or die ("SQL execution error!");
		$ok=is_array($row=mysql_fetch_array($rs));
		if ($ok){
			$isouturl=$row['isouturl'];
			$outurl=$row['outurl'];
		}
		if ($outurl!=""){
			return $outurl;	
		}else{
			if ($ishtml=="1"){
				return "/".$paramName."_".$tid."_".$sid.$site_extname;	
			}else if ($ishtml=="0"){
				return "".PAGEDIR."".$paramName.".php?tid=".$tid."&sid=".$sid;	
			}
		}
	 }
	function  get_param_html_three($paramName,$tid,$sid,$aid){
	 	global $db,$ishtml,$site_extname;
		$isouturl=0;
		$outurl="";
		$sql="select * from `".PRE."type` where `id`=".intval($aid)."";
		$rs=mysql_query($sql) or die ("SQL execution error!");
		$ok=is_array($row=mysql_fetch_array($rs));
		if ($ok){
			$isouturl=$row['isouturl'];
			$outurl=$row['outurl'];
		}
		if ($outurl!=""){
			return $outurl;	
		}else{
			if ($ishtml=="1"){
				return "/".$paramName."_".$tid."_".$sid."_".$aid.$site_extname;	
			}else if ($ishtml=="0"){
				return "".PAGEDIR."".$paramName.".php?tid=".$tid."&sid=".$sid."&aid=".$aid;	
			}
		}
	 }
	 //Static and dynamic mode switching function
	 function  get_param_html_one($paramName,$tid){
	 	global $db,$ishtml,$site_extname;
		$isouturl=0;
		$outurl="";
		$sql="select * from `".PRE."type` where `id`=".intval($tid)."";
		$rs=mysql_query($sql) or die ("SQL execution error!");
		$ok=is_array($row=mysql_fetch_array($rs));
		if ($ok){
			$isouturl=$row['isouturl'];
			$outurl=$row['outurl'];
		}
		if ($outurl!=""){
			return $outurl;	
		}else{	
			if ($ishtml=="1"){
				return "/".$paramName."_".$tid.$site_extname;	
			}else if ($ishtml=="0"){
				return "".PAGEDIR."".$paramName.".php?tid=".$tid;	
			}
		}
	 }
	 function  get_param_html($paramName){
	 	global $ishtml;
		if ($ishtml=="1"){
			return "/".$paramName.$site_extname;	
		}else if ($ishtml=="0"){
			return "".PAGEDIR."".$paramName.".php";	
		}
	 }
	 function  get_param_html_root($paramName){
	 	global $ishtml,$site_extname;
		if ($ishtml=="1"){
			return "/".$paramName.$site_extname;	
		}else if ($ishtml=="0"){
			return "/".$paramName.".php";	
		}
	 }
	 function  get_html_Id($paramName,$ID){
	 	global $ishtml,$site_extname;
		if ($ishtml=="1"){
			return "/".$paramName."-".$ID.$site_extname;	
		}else if ($ishtml=="0"){
			return "".PAGEDIR."".$paramName.".php?id=".$ID;	
		}
	 }
	 
	 //Static and dynamic mode switching function
	 function  replacefont($info){
	 		$str=$info;
 			$str=str_replace("请选择省份","",$str);
			$str=str_replace("请选择城市","",$str);
			return $str;
	 }
	 //恢复textarea函数
	 function  ReplaceTextArea($info){
	 		$info = str_replace("\n", '<br>', $info); 
			$str=$info;
			return $str;
	 }	 
	 
	 //Static and dynamic mode switching function
	 function  FilterArea($info){
	 		$str=$info;
			if ($str==""){
				return "不限";
			}else if ($str=="北美洲" || $str=="南美洲"  || $str=="亚洲"  || $str=="非洲"  || $str=="欧洲"  || $str=="大洋洲" ){
				return "其他";
			}else{
				return $str;
			}
	 }	
   
	//Get access to the actual ip real ip
	function getrealip(){
		//php get ip algorithm
		if ($_SERVER["HTTP_X_FORWARDED_FOR"]) {
		  if ($_SERVER["HTTP_CLIENT_IP"]) {
				$proxy = $_SERVER["HTTP_CLIENT_IP"];
		  } else {
			   $proxy = $_SERVER["REMOTE_ADDR"];
		  }
     		$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
		} else {
			 if ($_SERVER["HTTP_CLIENT_IP"]) {
					$ip = $_SERVER["HTTP_CLIENT_IP"];
			  } else {
				   $ip = $_SERVER["REMOTE_ADDR"];
			  }
		}
		if (isset($proxy)) {
			$ip=$proxy;
		}
		return $ip;
	}	
	
	//Name to generate thumbnails
	function create_spic($pic){
		$arr=explode("/",$pic);
		$pic_name=$arr[count($arr)-1];//Get rid of the file name after the path
		$spic=str_replace($pic_name,"s_".$pic_name,$pic);//Replace the file name
		return $spic;
	}
	
	//Tip steering function
	function GoUrl($gourl){
		echo "<script language='javascript' >window.location.href='".$gourl."'</script>";
		exit;
	}	
	//Shift function prompt message
	function GoAlertUrl($alertinfo,$gourl){
		echo "<script language='javascript'>alert('".$alertinfo."');window.location.href='".$gourl."'</script>";
		exit;
	}	
	//Shift function prompt message
	function numberic_check($paramid){
		if (!is_numeric($paramid)){
			echo"对不起，参数传递错误！";
			exit;
		}
	}	
	//url 正常检测地址
	function httpurlcheck(){
		$strurl=strtolower("http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].$_SERVER["QUERY_STRING"]);
		if (stristr($strurl, "script") || stristr($strurl, ">") || stristr($strurl, "<")  || stristr($strurl, "inert") || stristr($strurl, "update") || stristr($strurl, "delete") || stristr($strurl, "load_file") || stristr($strurl, "outfile") || stristr($strurl, "exec") || stristr($strurl, "execute") || stristr($strurl, ";") || stristr($strurl, "'")){
			echo"对不起，参数传递错误！";
			exit;
		}
	}
	//Shift function prompt message
	function PermitCheckAdmin($itemcode){
		global $func;
		if (!$func->PermitAdmin($itemcode)){
			echo "<script language='javascript'>alert('对不起，您没有操作的权限。');history.back();</script>";
			exit;
		}
	}	
	//Determine whether the user timeout
	function overtime($in_time,$url){
		//$new_time=mktime();
		//if($new_time-$in_time>12000){
		//	$tipword="由于你长时间未有任何操作，登录超时！";
			//$this->SessionDestroy();
		//	$this->GoAlertUrl($tipword,$url);
		//}else{
			//$_SESSION["in_time"]=mktime();
		//}		
	}
		
	//Verify that administrator privileges
	function checkadmin($uid,$adminshell,$url){
		if($uid=="" || $adminshell==""){
			$this->SessionDestroy();
			$this->GoUrl($url);
		}
	}
	
	//System to clear out session
	function SessionDestroy(){
		 $_SESSION["uid"]='';
		 $_SESSION["adminuser"]='';
		 $_SESSION["admintype"]='';
		 $_SESSION["admincode"]='';
		 $_SESSION["adminname"]='';
		 $_SESSION["isdefault"]='';
		 $_SESSION["admin_shell"]='';
		 $_SESSION["itemcode"]='';
		 //$_SESSION["in_time"]='';
		 unset( $_SESSION["uid"]);
		 unset( $_SESSION["adminuser"]);	 
		 unset( $_SESSION["admintype"]);	 
		 unset( $_SESSION["admincode"]);
		 unset( $_SESSION["adminname"]);
		 unset( $_SESSION["isdefault"]);
		 unset( $_SESSION["admin_shell"]);
		 unset( $_SESSION["itemcode"]);
		// unset( $_SESSION["in_time"]);	 	
	}	
	
	
	//Authority to determine whether there CODE
	function PermitAdmin($code)
	{
		$result=false;
		$sessioncode=$_SESSION["itemcode"];
		$arry=explode(",",$sessioncode); 
		$tcount = substr_count($sessioncode,',');
		for($i=0;$i<=$tcount;$i++){
			str_replace(" ","",$code); 
			if ($arry[$i]==$code)
			{
				$result=true;
			}
		}
		return $result;
	}
	
	//Background rights are to be selected
	function PermitSelect($sessioncode,$code){
		$result=false;
		$arry=explode(",",$sessioncode);
		$tcount = substr_count($sessioncode,',');
		for($i=0;$i<=$tcount;$i++){
			str_replace(" ","",$code); 
			if ($arry[$i]==$code)
			{
				$result=true;
			}
		}
		return $result;
	}
	
	//Return new icon
	function GetIconNew($svalue){
		if ($svalue==1)
		{
			return "<img src='images/new.gif' border=0>";
		}
	}
	//Return hot icon
	function GetIconHot($svalue){
		if ($svalue==1)
		{
			return "<img src='images/hot.gif' border=0>";
		}
	}
	
	//Address to obtain the actual picture
	function getrealpath($picinfo){
		return str_replace('../','',$picinfo);
	}
	//Address to obtain the actual picture
	function getrealpath2($picinfo){
		return str_replace('../../','/',$picinfo);
	}
	//Select Radio Checked
	function checkradio($columname,$columnvalue){
		if ($columname==$columnvalue){echo "checked";}
	}
	//Select selected
	function checkselect($columname,$columnvalue){
		if ($columname==$columnvalue){echo "selected";}
	}
	
	//GBK coding transto UTF8
	function gbktoutf($info){
		return iconv("gbk","utf-8",$info);
	}
		
	//UTF8 coding transto GBK
	function utftogbk($info){
		return iconv("utf-8","gbk",$info);
	}
	
	//	
	function is_utf8_encode($str, $flag=false){
		static $charset = null;
		if($charset == null){    //gbk中的汉字，但是满足utf-8的编码规范，对于这些汉字当做gbk字符处理
			$charstr = '陇搂篓掳卤路脳脿谩猫茅锚矛铆貌贸梅霉煤眉膩膿臎墨艅艌艒奴菐菒菕菙菛菢菤菧蓱伞藝藟藠藡藱螒螔螕螖螘螙螚螛螜螝螞螠螡螢螣螤巍危韦违桅围唯惟伪尾纬未蔚味畏胃喂魏位渭谓尉慰蟺蟻蟽蟿蠀蠁蠂蠄蠅衼袗袘袙袚袛袝袞袟袠袡袣袥袦袧袨袩袪小孝校肖啸笑效楔些歇蝎鞋协挟携邪斜胁谐写械卸蟹懈泄泻谢屑薪芯锌褉褋褌褍褎褏褑褔褕褖褗褘褜褝褞褟褢';
			$charset = str_split($charstr, 2);
			$charset = array_flip($charset);
		}
		$pflag = true;$qflag = false;
		$len = strlen($str);
		for($i = 0; $i < $len; $i ++){    //判断是否满足utf-8的编码规范
			$ord = ord($str[$i]);
			if($ord < 128)continue;
			$pflag = false;
			if(($ord & 0xF8)==0xF0)$num = 4;
			else if(($ord & 0xF0)==0xE0)$num = 3;
			else if(($ord & 0xE0)==0xC0)$num = 2;
			else return false;
			if(!$qflag && $num==3)$qflag = true;
			while(--$num)if(++$i==$len || (ord($str[$i]) & 0xC0)!=0x80)return false;
		}
		if($pflag)return $flag;    //全为英文字符，默认是gbk编码的
		if($qflag)return true;    //如果该字符串中一个字符由3个字节组成，则必然是utf8编码
		for($i = 0; $i < $len; $i ++){    //对于既是utf8编码，又是gbk编码的字符进行判断
			$ord = ord($str[$i]);
			if($ord < 128)continue;
			$s = $str[$i].$str[++$i];
			if(isset($charset[$s]))
				return false;
		}
		return true;
	}
	//Time Format
	function format_date($str,$num){
		$str=$str+(8*60*60);
		switch ($num) {
			case 1:
				return date('Y-m-d',$str);//2009-08-02 
				break;
			case 2:
				return date('Y-m-d H:i:s',$str);//2009-08-02 10:45:03 
				break;
			case 3:
				return date('Y年m月d日',$str);//2009年08月02日 
				break;
			case 4:
				return date('m月d日',$str);//08月02日 
				break;
			default:
				return date('F j,Y,g:i a',$str);//August 2,2009,10:48 am  
		}
	}
	
	//Injection of anti-filtering character
	//If you include SQL characters returns true, otherwise returns false
	function inject_check($str){
 		return eregi('select|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile', $str);	
	}
	
	//Submitted to verify the value of the parameter
	//Parameters: str: need to verify the character, parameter: num, 0 for the number, the other for the word符
	function safe_check($str,$num){
		if(!$str){
			exit('没有提交参数');//Determine whether the parameter is empty
		}
 
		if($num==0){
			if(!is_numeric($str)){
				exit('提交参数非法');//Determine whether the digital type
			}else{
				$str=intval($str);//Rounded
			}
		}else{
			 if (!get_magic_quotes_gpc()) {    // Determine whether to open magic_quotes_gpc
			   $str = addslashes($str);    // Filter   
			 }   
			 $str = str_replace("_", "\_", $str);    //The '_' filter out
			 $str = str_replace("%", "\%", $str);    // The '%' filter out
		}
		return $str;
	}
	
	//Injection, and HTML character filtering
	function htmldecode($str){
		 if(empty($str)) return;
		 if($str=="") return $str;
		 $str=str_replace("&amp;","&",$str);
		 $str=str_replace("&gt;",">",$str);
		 $str=str_replace("&lt;","<",$str);
		 $str=str_replace("sel&#101;ct","select",$str);
		 $str=str_replace("jo&#105;n","join",$str);
		 $str=str_replace("un&#105;on","union",$str);
		 $str=str_replace("wh&#101;re","where",$str);
		 $str=str_replace("ins&#101;rt","insert",$str);
		 $str=str_replace("del&#101;te","delete",$str);
		 $str=str_replace("up&#100;ate","update",$str);
		 $str=str_replace("lik&#101;","like",$str);
		 $str=str_replace("dro&#112;","drop",$str);
		 $str=str_replace("cr&#101;ate","create",$str);
		 $str=str_replace("mod&#105;fy","modify",$str);
		 $str=str_replace("ren&#097;me","rename",$str);
		 $str=str_replace("alt&#101;r","alter",$str);
		 $str=str_replace("ca&#115;","cast",$str);
		 $str = str_replace("&nbsp;", "", $str);
		 return $str;
	}
	
	//Filtering HTML format
	function html_clean($content) {
		$content = htmlspecialchars($content);
		$content = str_replace("\n", "<br />", $content);
		$content = str_replace("  ", "&nbsp;&nbsp;", $content);
		$content = str_replace("\t", "&nbsp;&nbsp;&nbsp;&nbsp;", $content);
		return $content;
	}
	
	//Get the current page number for paging
	function get_page_num($sql,$pagesize){
		global $db;
		$page=isset($_GET['page']) ? $_GET['page'] : '';
		if(!$page||$page<1){
			$page=1;
		}
		$totle=$db->num_rows($db->query($sql));
		$maxpage=ceil($totle/$pagesize);
		if($maxpage<1){
			$maxpage=1;
		}
		$page=$page>=$maxpage?$maxpage:$page;
		$firstpage=($page-1)*$pagesize;
		$arr=array($totle,$firstpage);
		return $arr;
	}
	
	//显示Aarea中的换行
	function ShwoAreaContent($strtext){
		$strtext = str_replace("\n", '<br>', $strtext);
		return $strtext;
		
	}
	//Clear code and html code word
	function ClearHTML($strtext){
			$strtext=str_replace(" ","",$strtext);
			$strtext=str_replace("　","",$strtext);
			$strtext=strip_tags($strtext);
			//$strtext=$this->delete_htm($strtext);
			if (strpos($strtext,"<")>-1)
			{
				$startpos=0;
				$endpos=0;
				$tmpstr="";
				$startpos=strpos($strtext,"<");
				$endpos=strpos($strtext,">");
				$tmpstr=substr_replace($strtext,"",$startpos,$endpos+1-$startpos);
				if (strpos($tmpstr,"<")>-1)
				{
					$strtext=$this->ClearHTML($tmpstr);
				}
			}
			$strtext=strip_tags($strtext);

			return $strtext;
	}
	//Html function with clear
	function delete_htm($scr) 
	{ 
		for($i=0;$i<strlen($scr);$i++) 
		{ 
			if(substr($scr,$i,1)=="<") 
			{ 
				while(substr($scr,$i,1)!=">")$i++; 
				$i++; 
			} 
			$str=$str.substr($scr,$i,1); 
		} 	
		return($str); 
	} 


	//Clear HTML
	function htmldecode2($scr) 
	{ 
	for($i=0;$i<strlen($scr);$i++) 
	{ 
		if(substr($scr,$i,1)=="<") 
		{ 
			while(substr($scr,$i,1)!=">")$i++; 
				$i++; 
			} 
			$str=$str.substr($scr,$i,1); 
		} 
		$str = str_replace(">", "", $str);
		$str = str_replace("<", "", $str);
		return($str); 
	} 

	//Replace character function
	function strreplace($str,$oldstr,$newstr)
	{
		$result=strtr($str,$oldstr,$newstr);
		return $result;
	}
	
	//Time Format
	function format_datetime($sdate)
	{
		$result="";
		$array = explode(" ",$sdate); 
		$result=$array[0];

		return $result;
	}
	//Time Format
	function format_datetime_month_day($sdate)
	{
		$result="";
		$array = explode("-",$sdate); 
		$result=$array[1]."-".$array[2];

		return $result;
	}
 
	//Time difference
	function diffday($a,$b)
	{
		 $a_dt=getdate(strtotime($a));
		 $b_dt=getdate(strtotime($b));
		 $a_new=mktime(12,0,0,$a_dt['mon'],$a_dt['mday'],$a_dt['year']);
		 $b_new=mktime(12,0,0,$b_dt['mon'],$b_dt['mday'],$b_dt['year']);
		 return round(($a_new-$b_new)/86400);
	}
 
	//Time difference
	function formattopnum($num)
	{
		 $result="";
		 if ($num<=9)
		 {
		 	$result="0".$num;
		 }
		 elseif ($num>=10 && $num<=99)
		 {
		 	$result=$num;
		 }
		 return $result;
	}
	//Intercept length of the specified character
	function subs($str, $width){
			 $i = 0; $j = 0;
			 while($i < $width){
					 if(strlen(mb_substr($str,$j++,1,'utf-8'))>1){
							 $i += 2;
					 }else{
							 $i += 1;
					 }
			 }
			 return mb_substr($str, 0, $j ,'utf-8');
	}

	//Intercept utf8 string
	function str_len($str, $width) {    
		 $str=str_replace("<p>","",$str); 
		 $str=str_replace("</p>","",$str);		 
		 $str=str_replace("<span>","",$str); 
		 $str=str_replace("</span>","",$str); 
		 $str=str_replace("<div>","",$str); 
		 $str=str_replace("</div>","",$str); 	 
		 $str=str_replace("</br>","",$str); 			 
		 $str=str_replace("<br>","",$str);  
		 $str=str_replace("&nbsp;","",$str);  
		 $i = 0; 
		 $j = 0;
		 while($i < $width){
				 if(strlen(mb_substr($str,$j++,1,'utf-8'))>1){
						 $i += 2;
				 }else{
						 $i += 1;
				 }
		 }
		 
		 //$str.=replaceHtmlAndJs($str);
		 return mb_substr($str, 0, $j ,'utf-8');  
	}
	
	//Intercept encode string
	function htmltext($design_str) 
	{ 
		$str=trim($design_str); // 取得字串同时去掉头尾空格和空回车 
		   
		//$str=str_replace("<br>","",$str); // 去掉<br>标签 
			
		//$str="<p>".trim($str); // 在文本头加入<p> 
		   
		$str=str_replace("\r\n","<br>",$str); // 用p标签取代换行符 
		  
		//$str.="</p>\n"; // 文本尾加入</p> 
		   
		$str=str_replace("<p></p>","",$str); // 去除空段落 
		  
		$str=str_replace("\n","",$str); // 去掉空行并连成一行 
		   
		$str=str_replace("</p>","</p>\n",$str); //整理html代码 
		  
		return $str; 
	}
	//Intercept utf8 string
	function strhtmlEncode($string) { 
		$string=trim($string); 
		$string=str_replace("&","&",$string); 
		$string=str_replace("'","'",$string); 
		$string=str_replace("&amp;","&",$string); 
		$string=str_replace("&quot;"," ",$string); 
		$string=str_replace("\""," ",$string); 
		$string=str_replace("&lt;","<",$string); 
		$string=str_replace("<","<",$string); 
		$string=str_replace("&gt;",">",$string); 
		$string=str_replace(">",">",$string); 
		$string=str_replace("&nbsp;"," ",$string); 
		$string=nl2br($string); 
		return $string; 
	} 

	//Intercept utf8 string
	function str_len2($str, $len) {    
		$i = 0;    
		$tlen = 0;    
		$tstr = '';    
		while ($tlen < $len) {    
			$chr = mb_substr($str, $i, 1, 'utf8');//mb_substr:按字符计算
			$chrLen = ord($chr) > 127 ? 2 : 1;    
			if ($tlen + $chrLen > $len) break;    
			$tstr .= $chr;    
			$tlen += $chrLen;    
			$i ++;    
		 }       
		return $tstr;    
	}
	//中文字符计算为2个字符，英文字符计算为1个，可以统计中文字符串长度的函数。
	function abslength($str){
		$len=strlen($str);
		$i=0;
		while($i<$len)
		{
			if(preg_match("/^[".chr(0xa1)."-".chr(0xff)."]+$/",$str[$i]))
			{
				$i+=2;
			}
			else
			{
				$i+=1;
			}
		}
		return $i;
	} 
	// 说明：计算 UTF-8 字符串长度（忽略字节的方案） 
	function strlen_utf8($str) {
		$i = 0;
		$count = 0;
		$len = strlen ($str);
		while ($i < $len) {
		$chr = ord ($str[$i]);
		$count++;
		$i++;
		if($i >= $len) break;
		if($chr & 0x80) {
		$chr <<= 1;
		while ($chr & 0x80) {
		$i++;
		$chr <<= 1;
		}
		}
		}
		return $count;
	}
 
	/* 
	 Utf-8, gb2312 support Chinese characters interception function
	 cut_str (string, length of the interception, starting length, encoding);
	 Encoding defaults to utf-8
	 Start defaults to 0 length 
	*/ 
 	function cut_str($string, $sublen, $start = 0, $code = 'UTF-8') 
	{ 
			if($code == 'UTF-8') 
			{ 
				$pa = "/[x01-x7f]|[xc2-xdf][x80-xbf]|xe0[xa0-xbf][x80-xbf]|[xe1-xef][x80-xbf][x80-xbf]|xf0[x90-xbf][x80-xbf][x80-xbf]|[xf1-xf7][x80-xbf][x80-xbf][x80-xbf]/"; 
				preg_match_all($pa, $string, $t_string); 
		 
				if(count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen))."..."; 
				return join('', array_slice($t_string[0], $start, $sublen)); 
			} 
			else 
			{ 
				$start = $start*2; 
				$sublen = $sublen*2; 
				$strlen = strlen($string); 
				$tmpstr = ''; 
		 
				for($i=0; $i< $strlen; $i++) 
				{ 
					if($i>=$start && $i< ($start+$sublen)) 
					{ 
						if(ord(substr($string, $i, 1))>129) 
						{ 
							$tmpstr.= substr($string, $i, 2); 
						} 
						else 
						{ 
							$tmpstr.= substr($string, $i, 1); 
						} 
					} 
					if(ord(substr($string, $i, 1))>129) $i++; 
				} 
				if(strlen($tmpstr)< $strlen ) $tmpstr.= "..."; 
				return $tmpstr; 
			} 
	} 
	
	//检测是否在中文
	function isChinese($getStr)
	{
		return (preg_match("/[\x80-\xff]./", $getStr)) ? 1 : 0;
	}
	//检测字符非法注入
	function strcheck($str){
		$str=strtolower($str);
		$str=htmlspecialchars($str);
		$str=htmlentities($str);
		$str=strip_tags($str);
		
		if ($this->strconbain($str, "script")  || $this->strconbain($strurl, "+") || $this->strconbain($strurl, "+") || $this->strconbain($str, ">") || $this->strconbain($str, "<")  || $this->strconbain($str, "insert") || $this->strconbain($str, "update") || $this->strconbain($str, "delete") || $this->strconbain($str, "load_file") || $this->strconbain($str, "outfile") || $this->strconbain($str, "exec") || $this->strconbain($str, "execute") || $this->strconbain($strurl, "%") || $this->strconbain($strurl, ";") || $this->strconbain($str, "'") || $this->strconbain($str, "*") || $this->strconbain($str, "union") || $this->strconbain($str, "into") || $this->strconbain($str, '"') || $this->strconbain($str, "user")  || $this->strconbain($str, "pass")  || $this->strconbain($str, "or")  || $this->strconbain($str, "concat") || $this->strconbain($str, ",") || $this->strconbain($str, "sleep") || $this->strconbain($str, "union") || $this->strconbain($str, "select") || $this->strconbain($str, "and") || $this->strconbain($str, "where")  || $this->strconbain($str, "=") || $this->strconbain($str, "@") || $this->strconbain($str, "extractvalue") || $this->strconbain($str, "updatexml")){
			echo"对不起，内容含有禁止的非法字符！";
			exit;
		}else{
			return $str;
		}
	}
	
	
	//判断字符是否在指定字符串中
	function strconbain($str,$in){
		$output=strpos(strtolower($str),$in);
		if ($output!="" && $output>=0){
			return true;
		}else{
			return false;
		}
	}
	//检测是否在指定内容
	function isconbain($tar,$sel){
		$str = $tar;
		if( strrpos($str,$sel)!=false )
		{
			return 1;
		}
		else
		{
		 return 0;
		}
	}
	//People get the file extension
	function getextendname($file_name){ 
		$extend =explode("." , $file_name); 
		$va=count($extend)-1;
		return $extend[$va]; 
	} 
	//格式化为人民币格式
	function doFormatMoney($money){
		$format_money = "￥"; 
		$format_money .= number_format($money,2);
		return $format_money;
	}
	//格式化为人民币格式
	function doFormatMoney2($money){
		$format_money .= number_format($money,2);
		return $format_money;
	}
	// 生成0123456789abcdefghijklmnopqrstuvwxyz中的一个字符  
	function getOptions(){  
		$options = array();  
		$result = array();  
		for($i=48; $i<=57; $i++){  
			array_push($options,chr($i));    
		}  
		for($i=65; $i<=90; $i++){  
			$j = 32;  
			$small = $i + $j;  
			array_push($options,chr($small)); 
		}  
		return $options;  
	}
	
	
	//生成随机函数
	function getrndnum(){
		$len = 10;
		
		// 随机生成数组索引，从而实现随机数
		for($j=0; $j<100; $j++)
		{
			$result = "";
			$options = $this->getOptions();
			$lastIndex = 35;
			while (strlen($result)<$len)
			{
				// 从0到35中随机取一个作为索引
				$index = rand(0,$lastIndex);
				// 将随机数赋给变量 $chr
				$chr = $options[$index];
				// 随机数作为 $result 的一部分
				$result .= $chr;
				$lastIndex = $lastIndex-1;
				// 最后一个索引将不会参与下一次随机抽奖
				$options[$index] = $options[$lastIndex];
			}
			echo $result;
		}
	}
	
   //取得随机码 
   function random($length){
		 $strChars = '12345678910';
		 $max = strlen($strChars) - 1;
		 mt_srand((double)microtime() * 1000000);
			 for($i = 0; $i < $length; $i++)
			 {
				 $strStartName .= $strChars[mt_rand(0, $max)];
			 }
			 return $strStartName;
	}

	//Play the video function
	function play($url)
	{
		$width = 499;
		$height = 370;
		$ext=$this->getextendname($url);
	  
		if($ext=='swf'){
			$play ="<embed src=\"{$url}\"  type=\"application/x-shockwave-flash\" width=\"{$width}\" height=\"{$height}\"></embed>";
			return $play;
			exit();
		}else if($ext=='wmv' || $ext=='mpg' || $ext=='mp4'){
			$play = "<object id=\"player\" height=\"{$height}\" width=\"{$width}\" classid=\"CLSID:6BF52A52-394A-11d3-B153-00C04F79FAA6\"> 
				<param name=\"AutoStart\" VALUE=\"-1\"> 
				<param name=\"url\" value=\"{$url}\"> 
				<param name=\"PlayCount\" VALUE=\"1\"> 
				<param name=\"volume\" value=\"50\"> 
				<param name=\"mute\" value=\"0\"> 
				<param name=\"uiMode\" value=\"full\"> 
				<param name=\"windowlessVideo\" value=\"1\"> 
				<param name=\"fullScreen\" value=\"0\"> 
				<param name=\"enableErrorDialogs\" value=\"-1\"> 
				<embed SRC type=\"audio/x-pn-realaudio-plugin\" CONSOLE=\"Clip1\" CONTROLS=\"ImageWindow,controlpanel\" HEIGHT=\"{$height}\" WIDTH=\"{$width}\" AUTOSTART=\"true\"> 
				</object>";
				
			return $play;
			exit();
		}else if($players=='rm' || $players=='rmvb'){
			$play = "<OBJECT ID=video1 CLASSID=\"clsid:CFCDAA03-8BE4-11cf-B84B-0020AFBBCCFA\" HEIGHT={$height} WIDTH={$width}> 
				<param name=\"_ExtentX\" value=\"9313\"> 
				<param name=\"_ExtentY\" value=\"7620\"> 
				<param name=\"AUTOSTART\" value=\"1\"> 
				<param name=\"SHUFFLE\" value=\"0\"> 
				<param name=\"PREFETCH\" value=\"0\"> 
				<param name=\"NOLABELS\" value=\"0\"> 
				<param name=\"SRC\" value=\"{$url}\"> 
				<param name=\"CONTROLS\" value=\"ImageWindow,controlpanel\"> 
				<param name=\"CONSOLE\" value=\"Clip1\"> 
				<param name=\"LOOP\" value=\"0\"> 
				<param name=\"NUMLOOP\" value=\"0\"> 
				<param name=\"CENTER\" value=\"0\"> 
				<param name=\"MAINTAINASPECT\" value=\"0\"> 
				<param name=\"BACKGROUNDCOLOR\" value=\"#000000\">
				<embed SRC type=\"audio/x-pn-realaudio-plugin\" CONSOLE=\"Clip1\" CONTROLS=\"ImageWindow,controlpanel\" HEIGHT=\"{$height}\" WIDTH=\"{$width}\" AUTOSTART=\"true\"> 
				</OBJECT> ";
			return $play;
			exit();
		}else if ($ext=="swf"){
				$play="<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0\" width=\"{$width}\" height=\"{$height}\"><param name=\"movie\" value=\"{$url}\" /><param name=\"quality\" value=\"high\" /><param name=\"wmode\" value=\"transparent\" /><embed src=\"{$url}\" width=\"{$width}\" height=\"{$height}\" quality=\"high\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" type=\"application/x-shockwave-flash\" wmode=\"transparent\"></embed></object>";
				return $play;
				exit();
	 
		}else if($ext=='flv'){
				$play = "<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0\" width=\"{$width}\" height=\"{$height}\">  <param name=\"movie\" value=\"scripts/swf/Bbmc.swf\" />  <param name=\"quality\" value=\"high\" />  <param name=\"allowFullScreen\" value=\"true\" /> <param name=\"FlashVars\" value=\"vcastr_file={$url}\" /> <embed src=\"scripts/swf/Bbmc.swf\" allowfullscreen=\"true\" quality=\"high\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\"
		   type=\"application/x-shockwave-flash\" width=\"{$width}\" height=\"{$height}\"></embed> </object>";		

				return $play;
				exit();
	 
		}else if($players=='mp3'){
	
			$play="<embed src=\"{$url}\"; loop=\"false\" autostart=\"true\" name=\"bgss\" width=\"{$width}\" height=\"{$height}\">";
	
			return $play;
			exit();
		}
	}
	
	//********The following functions and related database******************************************************
	
	//Department to obtain the name of the administrator
	function getadmintype($typeid){
		if($typeid!="" &&$typeid!="0"){
			$sql="select typename from `".PRE."admintype` where `id`=".intval($typeid);

			$rs=mysql_query($sql) or die ("SQL execution error!");
			$ok=is_array($row=mysql_fetch_array($rs));
			return $row["typename"];
		}

	}	
 
	//Get model typename
	function getmodelname($modelid){
		if($modelid!="" &&$modelid!="0"){
			$sql="select modelname from `".PRE."article_model` where `modelid`=".intval($modelid);

			$rs=mysql_query($sql) or die ("SQL execution error!");
			$ok=is_array($row=mysql_fetch_array($rs));
			return $row["modelname"];
		}
		if($modelid=="0" || $modelid=="" ){
			return "";
		}		
	}	
	//Get model type
	function getmodelid($typeid){
		if($typeid!="" &&$typeid!="0"){
			$sql="select modelid from `".PRE."type` where `id`=".intval($typeid);

			$rs=mysql_query($sql) or die ("SQL execution error!");
			$ok=is_array($row=mysql_fetch_array($rs));
			return $row["modelid"];
		}else{
			return 0;
		}
	}
	
	 //Get article link style
	function GetLinkClass($productid){
		if($productid!="" &&$productid!="0"){
			$sql="select css from `".PRE."css` where `id`=".intval($productid);
			$rs=mysql_query($sql);
			$ok=is_array($row=mysql_fetch_array($rs));
			return $row['css'];
		}	
	}
		
	//Administrator login function
	function ManagerLogin($user,$password){
		global $db,$func;
		$sql="select id,admin_type,admin_code,admin_id,admin_pass,admin_name from `".PRE."admin` where `admin_id`='".$user."'";

		$rs=$db->query($sql) or die ("SQL execution error!");
		$arr=is_array($row=$db->fetch_array($rs));
		if (!$arr){
			$this->GoAlertUrl('用户名错误！',AdminLoginUrl);
		}
		$pass=$arr?md5($password.CMS)==$row['admin_pass']:false;
		if($pass){	
			$_SESSION["uid"]        ="";
			$_SESSION["adminuser"]  ="";
			$_SESSION["admintype"]  ="";
			$_SESSION["admincode"]  ="";
			$_SESSION["adminname"]  ="";			
			$_SESSION["admin_shell"]="";
			$_SESSION["itemcode"]   ="";
			
			$_SESSION["uid"]=$row['id'];
			$_SESSION["adminuser"]=$row['admin_id'];
			$_SESSION["admintype"]=$row['admin_type'];
			$_SESSION["admincode"]=$row['admin_code'];
			$_SESSION["adminname"]=$row['admin_name'];			
			$_SESSION["admin_shell"]=md5($row['admin_id'].$row['admin_pass'].CMS);
			
			$_SESSION["itemcode"]=$this->GetAdminItemCode($row['admin_type']);
			//$_SESSION["in_time"]=mktime();
			
			$loginsuccessurl="index.php";

			$this->GoUrl($loginsuccessurl);
		}else{
			//$this->GoUrl(AdminLoginUrl);
			$this->GoAlertUrl('密码错误！',AdminLoginUrl);
		}	
	}
	 //Get article link style
	function GetAdminItemCode($typeid){
		if($typeid!="" &&$typeid!="0"){
			$sql="select itemcode from `".PRE."admintype` where `id`=".intval($typeid);
			$rs=mysql_query($sql);
			$ok=is_array($row=mysql_fetch_array($rs));
			return $row['itemcode'];
		}	
	}
	//******************************************************************************
	function is_gb2312($str)
	{
			for($i=0; $i<strlen($str); $i++) {
					$v = ord( $str[$i] );
					if( $v > 127) {
							if( ($v >= 228) && ($v <= 233) )
							{
									if( ($i+2) >= (strlen($str) - 1)) return true;  // not enough characters
									$v1 = ord( $str[$i+1] );
									$v2 = ord( $str[$i+2] );
									if( ($v1 >= 128) && ($v1 <=191) && ($v2 >=128) && ($v2 <= 191) ) // utf编码
											return false;
									else
											return true;
							}
					}
			}
			return true;
	}

	
	function playvideo($url,$width,$height){
	   
		$ext=strtolower($this->getextendname($url));
		
		if($ext=='swf'){
			$play ="<embed src=\"$url\"  type=\"application/x-shockwave-flash\" width=\"".$width."\" height=\"".$height."\"></embed>";
			return $play;
			exit();
		}else if($ext=='mpeg' || $ext=='avi' ){
			$play = "<object id=\"player\" height=\"".$height."\" width=\"".$width."\" classid=\"CLSID:6BF52A52-394A-11d3-B153-00C04F79FAA6\"> 
				<param name=\"AutoStart\" VALUE=\"-1\"> 
				<param name=\"url\" value=\"$url\"> 
				<param name=\"PlayCount\" VALUE=\"1\"> 
				<param name=\"volume\" value=\"50\"> 
				<param name=\"mute\" value=\"0\"> 
				<param name=\"uiMode\" value=\"full\"> 
				<param name=\"windowlessVideo\" value=\"1\"> 
				<param name=\"fullScreen\" value=\"0\"> 
				<param name=\"enableErrorDialogs\" value=\"-1\"> 
				<embed SRC type=\"audio/x-pn-realaudio-plugin\" CONSOLE=\"Clip1\" CONTROLS=\"ImageWindow,controlpanel\" HEIGHT=\"".$height."\" WIDTH=\"".$width."\" AUTOSTART=\"true\"> 
				</object>";
				
			return $play;
			exit();
		}else if($ext=='rm'){
			$play = "<OBJECT ID=video1 CLASSID=\"clsid:CFCDAA03-8BE4-11cf-B84B-0020AFBBCCFA\" HEIGHT=$height WIDTH=$width> 
				<param name=\"_ExtentX\" value=\"9313\"> 
				<param name=\"_ExtentY\" value=\"7620\"> 
				<param name=\"AUTOSTART\" value=\"1\"> 
				<param name=\"SHUFFLE\" value=\"0\"> 
				<param name=\"PREFETCH\" value=\"0\"> 
				<param name=\"NOLABELS\" value=\"0\"> 
				<param name=\"SRC\" value=\"$url\"> 
				<param name=\"CONTROLS\" value=\"ImageWindow,controlpanel\"> 
				<param name=\"CONSOLE\" value=\"Clip1\"> 
				<param name=\"LOOP\" value=\"0\"> 
				<param name=\"NUMLOOP\" value=\"0\"> 
				<param name=\"CENTER\" value=\"0\"> 
				<param name=\"MAINTAINASPECT\" value=\"0\"> 
				<param name=\"BACKGROUNDCOLOR\" value=\"#000000\">
				<embed SRC type=\"audio/x-pn-realaudio-plugin\" CONSOLE=\"Clip1\" CONTROLS=\"ImageWindow,controlpanel\" HEIGHT=\"".$height."\" WIDTH=\"".$width."\" AUTOSTART=\"true\"> 
				</OBJECT> ";
			return $play;
			exit();
		}else if($ext=='flv'){
	 
			if ($ext=="swf"){
				$play="<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0\" width=\"".$width."\" height=\"".$height."\"><param name=\"movie\" value=\"$url\" /><param name=\"quality\" value=\"high\" /><param name=\"wmode\" value=\"transparent\" /><embed src=\"$url\" width=\"".$width."\" height=\"".$height."\" quality=\"high\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\" type=\"application/x-shockwave-flash\" wmode=\"transparent\"></embed>
							</object>";
				return $play;
				exit();
			}else{
			
		   $play = "<object classid=\"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000\" codebase=\"http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0\" width=\"".$width."\" height=\"".$height."\">  <param name=\"movie\" value=\"scripts/swf/Bbmc.swf\" />  <param name=\"quality\" value=\"high\" />  <param name=\"allowFullScreen\" value=\"true\" /> <param name=\"FlashVars\" value=\"vcastr_file=".$url."&autoplay=true\" /> <embed src=\"scripts/swf/Bbmc.swf\" allowfullscreen=\"true\" quality=\"high\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\"
		   type=\"application/x-shockwave-flash\" width=\"".$width."\" height=\"".$height."\"></embed> </object>";
 
			
				return $play;
				exit();
			}
		}
	}
		 function  gethtml(){
	 	global $ishtml;
		if ($ishtml==1){
			echo "html";	
		}else{
			echo "php";	
		}
	 }
	 function  gethtmlvalue(){
	 	global $ishtml;
		if ($ishtml==1){
			return "html";	
		}else{
			return "php";	
		}
	 }
	 //取得星期日期
	 function  GetDayWeek($days){
	 	global $ishtml;
		if ($days==1){
			return "星期一";	
		}elseif ($days==2){
			return "星期二";	
		}elseif ($days==3){
			return "星期三";		
		}elseif ($days==4){
			return "星期四";	
		}elseif ($days==5){
			return "星期五";	
		}elseif ($days==6){
			return "星期六";	
		}elseif ($days==7){
			return "星期日";	
		}
	 }
	 
	 //上传检查过滤
	function checkupload($file){
		$fileinfo=$_FILES[$file]["tmp_name"];
		$filetype=$_FILES[$file]['type'];
		
		$fp = fopen($fileinfo,'r');
		$contents = fread ($fp, filesize ($fileinfo));
		fclose($fp);

		if(strstr(strtolower($filetype),".asp") ||  strstr(strtolower($filetype),".php") ||  strstr(strtolower($filetype),".jsp") ||  strstr(strtolower($filetype),"cgi")){    
			echo "Sorry,Upload file type is not correct-1!\n";
			exit;
		}

		if(strstr(strtolower($contents),".asp") ||  strstr(strtolower($contents),".php") ||  strstr(strtolower($contents),".jsp") ||  strstr(strtolower($contents),"cgi")){    
			//echo "Sorry,Upload file type is not correct-2!\n";
			//exit;
		}		

		$typecode=$this->file_type($fileinfo);
		
		if ($typecode!="rar" && $typecode!="zip"  && $typecode!="jpg" && $typecode!="jpeg"  && $typecode!="gif" && $typecode!="bmp"  && $typecode!="png"){
			echo "Upload file type is not correct";
			exit;
		}
	}
	//判断文件类型防止修改后缀		
	function file_type($filename)   
	{   
		$file = fopen($filename, "rb");   
		$bin = fread($file, 2); //只读2字节   
		fclose($file);   
		$strInfo = @unpack("C2chars", $bin);   

		$typeCode = intval($strInfo['chars1'].$strInfo['chars2']);   
		$fileType = '';   
		
		switch ($typeCode)   
		{   
		
			//case 7790:   
			//	$fileType = 'exe';   
			//	break;   
			//case 7784:   
			//	$fileType = 'midi';   
			//	break;   
			case 8297:   
				$fileType = 'rar';   
				break;           
			case 8075:   
				$fileType = 'zip';   
				break;   
			case 255216:   
				$fileType = 'jpg';   
				break;   
			case 7173:   
				$fileType = 'gif';   
				break;   
			case 6677:   
				$fileType = 'bmp';   
				break;   
			case 13780:   
				$fileType = 'png';   
				break;   
			default:   
				$fileType = 'unknown: '.$typeCode;   
		}   
	  
		//Fix   
		if ($strInfo['chars1']=='-1' AND $strInfo['chars2']=='-40' ) return 'jpg';   
		if ($strInfo['chars1']=='-119' AND $strInfo['chars2']=='80' ) return 'png';   
	  
		return $fileType;   
	} 
	
	 /*****文件目录和保存目录文件**********************************************************************************/
	 
	 /**
	  * 保存文件
	  *
	  * @param string $fileName 文件名（含相对路径）
	  * @param string $text 文件内容
	  * @return boolean
	  */
	 function saveFile($fileName, $text) {
	  if (!$fileName || !$text)
	   return false;
	  if (makeDir(dirname($fileName))) {
	   if ($fp = fopen($fileName, "w")) {
		if (@fwrite($fp, $text)) {
		 fclose($fp);
		 return true;
		} else {
		 fclose($fp);
		 return false;
		}
	   }
	  }
	  return false;
	 }
	 
	 /**********************************************************************************************
	  * 连续创建目录
	  *
	  * @param string $dir 目录字符串
	  * @param int $mode 权限数字
	  * @return boolean
	  */
	 function makeDir($dir, $mode=0777) {
	     /*function makeDir($dir, $mode="0777") { 此外0777不能加单引号和双引号，
		  加了以后，"0400" = 600权限，处以为会这样，我也想不通*/
		  if (!dir) return false;
		  if(!file_exists($dir)) {
		   return mkdir($dir,$mode,true);
		  } else {
		   return true;
		  }
	 }
	 
	 /**********************************************************************************************
	  * 连续创建目录和写入目标文件
	  * @param string $dir 目录字符串
	  * @return null
	  */
	 function makeSaveDir($dir){
		$content = ob_get_contents();//取得php页面输出的全部内容
		$fp = fopen("test/0001.html", "w");
		fwrite($fp, $content);
		fclose($fp);
	 }
	 
	 /***********************************************************************************************/
	 //取得字符中的第一个汉字
	 function getFirstWord($str){
	 	global $session_uid;
		if ($session_uid!=""){
			return $str;
		}else{
	 		return $this->str_len( $str,2)."老师";
		}
	 }
	 
	 //替换textarea文本中的换行符处理
	 function showTextAreaInfo($str){
	 	$str=str_replace("\n",'<br/>',$str);
		return $str;	
	 }
	//5秒后条状到指定地址
	function showMessage($msg){
		$return_url=$_SERVER['HTTP_REFERER'];
		$return_url="/user/login.php";
		echo "<html><title>温馨提示_蓝领技工</title><body><div style=\"margin:0 auto;\"><div  style=\"width: 560px;
    margin: 10px auto;clear: both;line-height: 38px; height:250px;padding: 6px;border: 1px solid #ddd; background: #f5f5f5;color: #444; font-family:'微软雅黑';font-size:24px;\" align=center><h2 style=\"color:#ff0000;\">温馨提示</h2>".$msg."<br>5秒后即将<a href=\"".$return_url."\" style=\"color:#ff0000;text-decoration:none;font-size:24px;\">返回登录页面</a>。</div></div><script language=javascript> setTimeout('window.location=\"".$return_url."\"',5000) </script></body></html>";
		exit;
	}
	//5秒后条状到指定地址
	function showMessageUrl($msg,$url){
		echo "<html><title>温馨提示_蓝领技工</title><body><div style=\"margin:0 auto;\"><div  style=\"width: 560px;
    margin: 10px auto;clear: both;line-height: 28px; height:150px;padding: 6px;border: 1px solid #ddd; background: #f5f5f5;color: #444; font-family:'微软雅黑';\" align=center><h2 style=\"color:#ff0000;\">温馨提示</h2>".$msg."<br>5秒后即将<a href=\"".$url."\" style=\"color:#ff0000;text-decoration:none;\">返回页面</。</div></div><script language=javascript> setTimeout('window.location=\"".$url."\"',5000) </script></body></html>";
		exit;
	}
	//错误放回地址
	function showErrowPage($msg){
		echo "<html><title>温馨提示_蓝领技工</title><body><div style=\"margin:0 auto;\"><div  style=\"width: 560px;
    margin: 10px auto;clear: both;line-height: 28px; height:150px;padding: 6px;border: 1px solid #ddd; background: #f5f5f5;color: #444; font-family:'微软雅黑';\" align=center><h2 style=\"color:#ff0000;\">温馨提示</h2>".$msg."<br>请<a href=\"javascript:void(0);\" onclick=\"window.history.back();\" style=\"color:#ff0000;text-decoration:none;\">返回页面</。</div></di</body></html>";
		exit;
	}
		 
	function showNoPermissionInfo(){
		echo "<html><title>温馨提示_蓝领技工</title><body><div style=\"margin:0 auto;\"><div  style=\"width: 560px;
    margin: 10px auto;clear: both;line-height: 28px; height:150px;padding: 6px;border: 1px solid #ddd; background: #f5f5f5;color: #444; font-family:'微软雅黑';\" align=center><h2 style=\"color:#ff0000;\">温馨提示</h2>您没有访问的权限,<br>请<a href=\"javascript:void(0);\" onclick=\"window.history.back();\" style=\"color:#ff0000;text-decoration:none;\">返回页面</。</div></di</body></html>";
		exit;
	}		
	
}
?>