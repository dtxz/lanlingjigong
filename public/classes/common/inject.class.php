<?PHP 
//PHP整站防注入程序，需要在公共文件中require_once本文件 
//inject library
class inject{	
	
	function __construct(){
		global $func;
		//判断magic_quotes_gpc状态 
		if (@get_magic_quotes_gpc()){ 
			$_GET    = $this->sec($_GET); 
			$_POST   = $this->sec($_POST); 
			$_COOKIE = $this->sec($_COOKIE); 
			$_FILES  = $this->sec($_FILES); 
		} 
		$_SERVER = $this->sec($_SERVER); 
		$this->httpurlcheck();
	}

	function sec(&$array){ 
		//如果是数组，遍历数组，递归调用 
		if (is_array($array)){ 
			foreach ($array as $k =>$v) { 
				$array[$k] = $this->sec($v); 
			} 
		} elseif (is_string($array)){ 
			//使用addslashes函数来处理 
			$array = addslashes($array); 
		} elseif (is_numeric($array)){ 
			$array = intval($array); 
		} 
		return $array; 
	} 
	//整型过滤函数 
	function num_check($id){ 
	
		if (!$id){ 
			die('参数不能为空！'); 
		} //是否为空的判断 
		elseif ($this->inject_check($id)){ 
			die( '非法参数' ); 
		} //注入判断 
		elseif(!is_numeric($id)){ 
			die('非法参数'); 
		} 
		//数字判断 
		$id = intval($id); 
		//整型化 
		return $id; 
	} 
	//字符过滤函数 
	function str_check($str){ 
		if ($this->inject_check($str)){ 
			die('非法参数'); 
		} 
		//注入判断 
		$str = htmlspecialchars($str); 
		//转换html 
		return $str; 
	} 
	function search_check($str){ 
		$str = str_replace("_", "\_",$str); 
		//把"_"过滤掉 
		$str = str_replace("%", "\%",$str); 
		//把"%"过滤掉 
		$str = htmlspecialchars($str); 
		//转换html 
		return $str; 
	} 
	//表单过滤函数 
	function post_check($str,$min,$max){ 
		if (isset($min) && strlen($str)<$min){ 
			die('最少$min字节'); 
		} else if (isset($max) && strlen($str) >$max){ 
			die('最多$max字节'); 
		} 
		return $this->stripslashes_array($str); 
	} 
	//防注入函数 
	function inject_check($sql_str){ 
		return eregi('select|insert|update|delete|\'|\/\*|\*|\.\.\/|\.\/|UNION|into|load_file|outfile',$sql_str);  
	} 
	
	function stripslashes_array(&$array){ 
		if (is_array($array)){ 
			foreach ($array as $k =>$v){ 
				$array [$k] = $this->stripslashes_array ($v); 
			} 
		} elseif (is_string($array)){ 
			$array = stripslashes($array); 
		} 
		return $array; 
	}
	//url 正常检测地址
	function httpurlcheck(){
		$strurl=strtolower("http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].$_SERVER["QUERY_STRING"]);
		if (stristr($strurl, "script") || stristr($strurl, ">") || stristr($strurl, "<")  || stristr($strurl, "inert") || stristr($strurl, "update") || stristr($strurl, "delete") || stristr($strurl, "load_file") || stristr($strurl, "outfile") || stristr($strurl, "exec") || stristr($strurl, "execute") || stristr($strurl, ";") || stristr($strurl, "'")){
			echo"对不起，参数传递错误！";
			exit;
		}
	}
} 
?>