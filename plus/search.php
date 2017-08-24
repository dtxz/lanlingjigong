<?php require("../public/appconfig.php");?>
<?php 
$action=isset($_REQUEST['action'])?$_REQUEST['action']:"";
//取得当前栏目、位置
$curClassName="站内搜索";
$curPosInfo="当前位置：<a href=\"".$func->get_param_html_root("index")."\">首页</a> &gt; ".$curClassName;
 
$pagesize=20; //分页数从这里设置
//加载模板文件
if ($action=="job"){
	$pagesize=20; 
	$salary_s=$func->strcheck(isset($_REQUEST['salary_s'])?$_REQUEST['salary_s']:0);
	$salary_e=$func->strcheck(isset($_REQUEST['salary_e'])?$_REQUEST['salary_e']:0);
	$experience=$func->strcheck(isset($_REQUEST['experience'])?$_REQUEST['experience']:"");
	$zgtype=$func->strcheck(isset($_REQUEST['zgtype'])?$_REQUEST['zgtype']:"");
	$province=$func->strcheck(isset($_REQUEST['province'])?$_REQUEST['province']:"");
	$city=$func->strcheck(isset($_REQUEST['city'])?$_REQUEST['city']:"");

	
	$salary_s   =$func->strcheck($salary_s);
	$salary_e   =$func->strcheck($salary_e);
	$experience =$func->strcheck($experience);
	$zgtype     =$func->strcheck($zgtype);
	$province   =$func->strcheck($province);
	$city       =$func->strcheck($city);

	$arrparam="action=$action&salary_s=$salary_s&salary_e=$salary_e&experience=$experience&zgtype=$zgtype&province=$province&city=$city";
	$tmpsql="";
	$tmpsql="select a.*,b.companyname from `".PRE."member_job`a left outer join ".PRE."member_company b on a.memid=b.memid where  a.jobname<>'' ";
	
	if ($salary_e!=0){
		$tmpsql.=" and  ((a.salary_s>=".$salary_s." and a.salary_e>=".$salary_s.") and  (a.salary_s<=".$salary_e."))";
	}
 
	if ($experience!=""){
		$tmpsql.=" and  a.gznxyq>".$experience." ";
	}
	if ($zgtype!=""){
		$tmpsql.=" and  a.zgtype='".$zgtype."' ";
	}
	if ($province!=""){
		$tmpsql.=" and  a.place like '%".$province."%' ";
	}
	if ($city!=""){
		$tmpsql.=" and  a.place like '%".$city."%' ";
	}
	$tmpsql.=" order by a.istj desc,a.gxtime desc";
 	//echo $tmpsql;
	
	require_once("../".$templatesfile."search_job.php");
}elseif ($action=="resume"){
	//$member->checkCompanyRZPermission();//必须为认证企业才能查看简历资料
	$pagesize=10;
	$sex=$func->strcheck(isset($_REQUEST['sex'])?$_REQUEST['sex']:'');
	$hy=$func->strcheck(isset($_REQUEST['hy'])?$_REQUEST['hy']:'');
	$experience=$func->strcheck(isset($_REQUEST['experience'])?$_REQUEST['experience']:"");
	$gz=$func->strcheck(isset($_REQUEST['gz'])?$_GET['gz']:"");
	$jycd=$func->strcheck(isset($_REQUEST['jycd'])?$_REQUEST['jycd']:"");	
	$province=$func->strcheck(isset($_REQUEST['province'])?$_REQUEST['province']:"");
	$city=$func->strcheck(isset($_REQUEST['city'])?$_REQUEST['city']:"");
 
	$sex   =$func->strcheck($sex);
	$hy   =$func->strcheck($hy);
	$experience =$func->strcheck($experience);
	$gz     =$func->strcheck($gz);
	$jycd     =$func->strcheck($jycd);	
	$province   =$func->strcheck($province);
	$city       =$func->strcheck($city);

	$arrparam="action=$action&sex=$sex&hy=$hy&experience=$experience&gz=$gz&province=$province&city=$city&jycd=$jycd";
	$tmpsql="";
	$tmpsql="select a.*  from  ".PRE."member_personal a  left outer join ".PRE."member c on a.memid=c.id  where a.is_show=1 and   a.xingming<>'' ";
	
	if ($sex!=""){
		$tmpsql.=" and  a.sex='".$sex."' ";
	}
	if ($hy!=""){
		$tmpsql.=" and  a.hy='".$hy."' ";
	}
	if ($experience!=""){
		$tmpsql.=" and  a.gzjy>".$experience." ";
	}
	if ($gz!=""){
		$tmpsql.=" and  a.gz='".$gz."' ";
	}
	if ($jycd!=""){
		$tmpsql.=" and  a.jycd='".$jycd."' ";
	}	
	if ($province!=""){
		$tmpsql.=" and  a.place like '%".$province."%' ";
	}
	if ($city!=""){
		$tmpsql.=" and  a.place like '%".$city."%' ";
	}
	$tmpsql.=" order by c.istj desc,a.gxtime desc";
 	//echo $tmpsql;

	require_once("../".$templatesfile."search_resume.php");
}
/******************************************************************/

$db->close();//关闭连接

?>

 