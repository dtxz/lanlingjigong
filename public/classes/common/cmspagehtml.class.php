<?php
/**
 * Pagination Class
 */
 @$page = $_GET['page'];
class cmspagehtml{
	private $totle;//Record number
	private $pagesize;//Page size
	private $page;//Show page number
	private $url;//Need to display the page
	private $param;//Custom parameters
	private $htmlurl;
	
	/**
	 * Page Constructor
	 * @param integer totles Library name
	 * @param integer $size Model Name
	 * @param integer $params Other parameters	 
	 */
	function __construct($totles,$size,$htmlurl){
		$this->totle=$totles;//The total number of records
		$this->pagesize=$size;//Page Size
		if ($htmlurl!="")
		{
			$this->htmlurl=$htmlurl;
		}
		else
		{
			$this->htmlurl="";
		}
	
		//$this->cmspageshow();
		$this->pageft($this->totle,$this->pagesize,1,1,1,3,'?'.$this->htmlurl.'');
	}

	function pageft($totle,$displaypg=20,$shownum=0,$showtext=0,$showselect=0,$showlvtao=10,$url=''){

	//定义几个全局变量：
	//$page：当前页码；
	//$firstcount：（数据库）查询的起始项；
	//$pagenav：页面导航条代码，函数内部并没有将它输出；
	//$_SERVER：读取本页URL“$_SERVER["REQUEST_URI"]”所必须。
	global $page,$firstcount,$pagenav,$_SERVER;

	//为使函数外部可以访问这里的“$displaypg”，将它也设为全局变量。注意一个变量重新定义为全局变量后，原值被覆盖，所以这里给它重新赋值。
	$GLOBALS["displaypg"]=$displaypg;

	if(!$page) $page=1;
	//$url=$url."&df=list";
	//如果$url使用默认，即空值，则赋值为本页URL：
	if(!$url){ $url=$_SERVER["REQUEST_URI"];}
	$url=str_replace("?", "", $url);
	
	//URL分析：
	$parse_url=parse_url($url);
	$url_query=$parse_url["query"]; //单独取出URL的查询字串
	
	if($url_query){
	//因为URL中可能包含了页码信息，我们要把它去掉，以便加入新的页码信息。
	//这里用到了正则表达式，请参考“PHP中的正规表达式”
	$url_query=ereg_replace("(^|&)page=$page","",$url_query);
	
	//将处理后的URL的查询字串替换原来的URL的查询字串：
	$url=str_replace($parse_url["query"],$url_query,$url);
	
	//在URL后加page查询信息，但待赋值：
	if($url_query) $url.="&page"; else $url.="page";
	}else {
	$url.="?page";
	}

	//页码计算：
	$lastpg=ceil($totle/$displaypg); //最后页，也是总页数
	$page=min($lastpg,$page);
	$prepg=$page-1; //上一页
	$nextpg=($page==$lastpg ? 0 : $page+1); //下一页
	$firstcount=($page-1)*$displaypg;
	if ($lastpg>1){
	$pagenav="<div style=\"height:65px; padding-top:15px; padding-left:50px;\"><div class=\"msdn\">";
	//开始分页导航条代码：
	//if ($showtext==1){
		//$pagenav.="<span class='disabled'>".($totle?($firstcount+1):0)."-".min($firstcount+$displaypg,$totle)."/$totle 记录</span><span class='disabled'>$page/$lastpg 页</span>";
		//$pagenav.="<span class='curren'>当前第<strong>$page</strong>页/$lastpg 页</span>&nbsp;&nbsp;<span class='curren'>总记录:<strong>$totle</strong> </span>&nbsp;&nbsp;&nbsp;";
	//}else{
	//$pagenav="";	
	//}
	$url=$this->page_replace($url);
	
	//如果只有一页则跳出函数：
	if($lastpg<=1) return false;

	if($prepg) $pagenav.="<a href='?page=1&".$url."'>首页</a>"; else $pagenav.='<span class="disabled"><<</span>';
	if($prepg) $pagenav.="<a href='?page=".$prepg."&".$url."'>上一页</a>"; else $pagenav.='<span class="disabled"><</span>';
	if ($shownum==1){
		$o=$showlvtao;//中间页码表总长度，为奇数
		$u=ceil($o/2);//根据$o计算单侧页码宽度$u
		$f=$page-$u;//根据当前页$currentPage和单侧宽度$u计算出第一页的起始数字
		//str_replace('{p}',,$fn)//替换格式
		if($f<0){$f=0;}//当第一页小于0时，赋值为0
		$n=$lastpg;//总页数,20页
		if($n<1){$n=1;}//当总数小于1时，赋值为1
		if($page==1){
			$pagenav.='<span class="current">1</span>';
		}else{
			$pagenav.="<a href='?page=1&".$url."'>1</a>";
		}
		///////////////////////////////////////
		for($i=1;$i<=$o;$i++){
			if($n<=1){break;}//当总页数为1时
			$c=$f+$i;//从第$c开始累加计算
			if($i==1 && $c>2){
				$pagenav.='...';
			}
			if($c==1){continue;}
			if($c==$n){break;}

			if($c==$page){
				$pagenav.='<span class="current">'.$page.'</span>';
			}else{
				$pagenav.="<a href='?page=".$c."&".$url."'>$c</a>";
			}
			if($i==$o && $c<$n-1){
				$pagenav.='...';
			}
			if($i>$n){break;}//当总页数小于页码表长度时	
		}
		if($page==$n && $n!=1){
			$pagenav.='<span class="current">'.$n.'</span>';
		}else{
			$pagenav.="<a href='?page=".$n."&".$url."'>$n</a>";
			}
	}
	
	if($nextpg) $pagenav.="<a href='?page=".$nextpg."&".$url."'>下一页</a>"; else $pagenav.='<span class="disabled">></span>';
	if($nextpg) $pagenav.="<a href='?page=".$lastpg."&".$url."'>末页</a>"; else $pagenav.='<span class="disabled">>></span>';
	
	
	
	//if ($showselect==1){
	//下拉跳转列表，循环列出所有页码：
/* 
		$pagenav.="&nbsp;&nbsp;&nbsp;跳至<select name='topage' size='1' onchange='window.location=\"+this.value'>\n";
		
		for($i=1;$i<=$lastpg;$i++){
			if($i==$page){
				$pagenav.="<option value='$i' selected>$i</option>\n";
			}else{
				$pagenav.="<option value='$i'>$i</option>\n";
			}
		}
		$pagenav.="</select>&nbsp;页";*/
	//}
	//if ($showtext==1){
	//	$pagenav.="";
	//}
	$pagenav.="&nbsp;&nbsp;&nbsp;<span style=\" color:#999999;\">共找到 <span style=\"color:#006ec2; font-weight:bold;\">".$totle."</span> 个信息  <span style=\"color:#006ec2;font-weight:bold;\">".$displaypg."</span>条记录/页</span>";
	$pagenav.="</div></div>";
	}else{
	echo "<div style=\"height:50px; line-height:50px;\"><div class=\"msdn\"><span class=\"current\">1</span>&nbsp;&nbsp;<span style=\"color:#999999;\">共找到 <span style=\"color:#006ec2; font-weight:bold;\">".$totle."</span> 个信息  <span style=\"color:#006ec2;font-weight:bold;\">".$displaypg."</span>条记录/页</span></div></div>";
	}
	echo $pagenav;	
  }
  //----------
	private function page_replace($url){ //地址替换
		$url=str_replace("?page","",$url);
			
		//$url=str_replace("{page}",$page,$url);
		return $url;
	}
	
/*	private function page_replace($page,$url){ //地址替换
		echo $url."<br>";
		$url=str_replace("?page","",$url);
			
		//$url=str_replace("{page}",$page,$url);
		return $url;
	}*/
}
?>