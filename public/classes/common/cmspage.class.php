<?php
/**
 * Pagination Class
 */
class cmspage{
	private $totle;//Record number
	private $pagesize;//Page size
	private $page;//Show page number
	private $url;//Need to display the page
	private $param;//Custom parameters
	
	/**
	 * Page Constructor
	 * @param integer totles Library name
	 * @param integer $size Model Name
	 * @param integer $params Other parameters	 
	 */
	function __construct($totles,$size,$params){
		$this->totle=$totles;//The total number of records
		$this->pagesize=$size;//Page Size
		if ($params!="")
		{
			$this->param="&".$params;
		}
		else
		{
			$this->param="";
		}
	
		$this->cmspageshow();
	}

	function cmspageshow(){
		global $func;
		if(!$this->url){
			$this->url=$_SERVER['REQUEST_URI'];	
		}
		$page=isset($_GET['page']) ? $_GET['page'] : '';
		$this->page= $func->htmldecode($page); 

		//分析URL
		$p_url=parse_url($this->url); 
		$url_query=isset($p_url["query"])?$p_url["query"]:''; 
		if($url_query){ 
			if(substr_count($url_query,'page=')>0){
				//$url_query = ereg_replace("(^|&)page=$this->page", "", $url_query);
				$url_query = preg_replace("/(^|&)page=$this->page/", "", $url_query);
				
				$this->url=str_replace($p_url["query"],$url_query,$this->url);
			}
			
			if($url_query){
				$this->url.="&page";
			}else{
				$this->url.="page";
			}
		}else{
			$this->url.="?page"; 
		}
		$this->page=intval($this->page);
		if(!$this->page||$this->page<1){
			$this->page=1;
		}
		//Definition Page
		$lastpage=ceil($this->totle/$this->pagesize);//Total number of records per page in addition to the total number of pages was the whole)
		$this->page=min($lastpage,$this->page);//When the page displays the total number of pages over the last page
		
		$prepage=$this->page<=1?1:$this->page-1;//Previous
		
		$nextpage=$this->page>=$lastpage?$lastpage:$this->page+1;//Next
		
 
		if ($lastpage>1){
			$show="<div class=page  align=center>当前第<span class=font12redb>".$this->page."</span>/<span class=font12redb>".$lastpage."</span>　共<span class=font12redb>".$this->totle."</span>条记录 <span class=font12redb>".$this->pagesize."</span>条/页&nbsp;&nbsp;&nbsp;";
	
			if($this->page<=1){
				$show.="<span class=graynolink>首页</span>&nbsp;|&nbsp;<span class=graynolink>上页</span>&nbsp;|&nbsp;";
			}else{
				$show.="<a href='?page=1$this->param'>首页</a>&nbsp;|&nbsp;<a href='?page=$prepage$this->param'>上页</a>&nbsp;|&nbsp;";
			}
			if($this->page>=$lastpage){
				$show.="<span class=graynolink>下页</span>&nbsp;|&nbsp;<span class=graynolink>尾页</span>&nbsp;";
			}else{
				$show.="<a href='?page=$nextpage$this->param'>下页</a>&nbsp;|&nbsp;<a href='?page=$lastpage$this->param'>尾页</a>&nbsp;";
			}
			$show.="</div>";
			echo $show;
		}
	}
	
}
?>