<?php 

$page   =$func->strcheck(isset($_GET['page'])?$_GET['page']:1);

$data_sql="select a.* from ".PRE."teachers a where a.status=0 ";
if ($act=="search"){//搜索调用
	if ($keyword!=""){
		$keyword=str_replace("  "," ",$keyword);
		$keyArray=explode(' ',$keyword);
		if (count($keyArray)>1){
			for($i=0;$i<count($keyArray);$i++){
				$data_sql.=" and (a.teachername like '%".$keyArray[$i]."%' ";
				$data_sql.=" or a.teacherbg like '%".$keyArray[$i]."%' ";
				$data_sql.=" or a.teachtrade like '%".$keyArray[$i]."%' ";
				$data_sql.=" or a.coursename like '%".$keyArray[$i]."%' ";
				$data_sql.=" or a.customerservice like '%".$keyArray[$i]."%' ";
				$data_sql.=" or a.teachlanguage='".$keyArray[$i]."' ";		
				$data_sql.=" or a.teachfield like '%".$keyArray[$i]."%' ";		
				$data_sql.=" or a.place like '%".$keyArray[$i]."%') ";
			}
		}else{
			$data_sql.=" and (a.teachername like '%".$keyword."%' ";
			$data_sql.=" or a.teacherbg like '%".$keyword."%' ";
			$data_sql.=" or a.teachtrade like '%".$keyword."%' ";
			$data_sql.=" or a.coursename like '%".$keyword."%' ";
			$data_sql.=" or a.customerservice like '%".$keyword."%' ";
			$data_sql.=" or a.teachlanguage='".$keyword."' ";		
			$data_sql.=" or a.teachfield like '%".$keyword."%' ";		
			$data_sql.=" or a.place like '%".$keyword."%') ";
		}
	}
	
	$arrparam="act=$act&keyword=$keyword";//传递参数
}elseif ($act=="supersearch"){//高级搜索调用
	if ($teachername!=""){
		$data_sql.=" and a.teachername like '%".$teachername."%' ";
	}
	if ($sex!=""){
		$data_sql.=" and a.sex='".$sex."' ";
	}
	if ($teacherbg!=""){
		$data_sql.=" and a.teacherbg like '%".$teacherbg."%' ";
	}
	if ($teachtrade!=""){
		$data_sql.=" and a.teachtrade like '%".$teachtrade."%' ";
	}
	if ($coursename!=""){
		$data_sql.=" and a.coursename like '%".$coursename."%' ";
	}
	if ($customerservice!=""){
		$data_sql.=" and a.customerservice like '%".$customerservice."%' ";
	}
	if ($teachlanguage!=""){
		if ($teachlanguage=="中文" || $teachlanguage=="英文"){
			$data_sql.=" and (a.teachlanguage like '%".$teachlanguage."%' or a.teachlanguage='中英双语') ";
		}else{
			$data_sql.=" and a.teachlanguage like '%".$teachlanguage."%' ";
		}
	}
	if ($teachsalary!=""){
		$data_sql.=" and a.gradeid='".$teachsalary."' ";
	}
	if ($haseval!=""){
		$data_sql.=" and a.haseval='".$haseval."' ";
	}
	if ($hasvideo!=""){
		$data_sql.=" and a.hasvideo='".$hasvideo."' ";
	}
	if ($teachfield!=""){
		$data_sql.=" and (";
		//对授课领域进行分解
		$fieldArray=explode(',',$teachfield);
		if (count($fieldArray)>1){
			for($i=0;$i<count($fieldArray);$i++){
				if ($i==0){
					$data_sql.=" a.teachfield like '%".$fieldArray[$i]."%' ";
				}else{
					$data_sql.=" or a.teachfield like '%".$fieldArray[$i]."%' ";
				}	
			}
		}else{
			$data_sql.=" a.teachfield like '%".$fieldArray[0]."%' ";
		}
		$data_sql.=")";
	}
	if ($place!=""){
		$data_sql.=" and (";
		//对常驻地进行分解
		$fieldArray=explode('-',$place);
		if (count($fieldArray)>1){
			for($i=0;$i<count($fieldArray);$i++){
				if ($fieldArray[$i]!=""){
					if ($i==0){
						$data_sql.=" a.place like '%".$fieldArray[$i]."%' ";
					}else{
						$data_sql.=" and a.place like '%".$fieldArray[$i]."%' ";
					}	
				}
			}
		}else{
			$data_sql.=" a.place like '%".$fieldArray[0]."%' ";	
		}
		$data_sql.=")";
	}
	$arrparam="act=$act&teachername=$teachername&sex=$sex&place=$place&teachsalary=$teachsalary
&teacherbg=$teacherbg&teachfield=$teachfield&teachtrade=$teachtrade&coursename=$coursename&customerservice=$customerservice&haseval=$haseval&hasvideo=$hasvideo&teachlanguage=$teachlanguage";//传递参数	
}
$data_sql.=" order by a.istop desc, a.id desc";
$pagesize=25;//结果分页
//显示搜索结果
$member->PageTeacherList($data_sql,$pagesize,$arrparam);

?>