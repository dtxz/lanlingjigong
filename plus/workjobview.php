<?php require("../public/appconfig.php");?>
<?php 
$keyword=isset($_GET['keyword'])?$_GET['keyword']:"";
$keyword=rawurldecode($keyword);
$keyword=iconv("GB2312","UTF-8",$keyword);
//$keyword=$func->gbktoutf($keyword);

//ȡ�õ�ǰ��Ŀ��λ��
$curClassName="վ������";
$curPosInfo="��ǰλ�ã�<a href=\"".$func->get_param_html_root("index")."\">��ҳ</a> &gt; ".$curClassName;

//��������
$pagesize=10; //��ҳ������������
$arrparam="keyword=$keyword";
$tmpsql="";

if ($ishtml==1){
	$arrparam="/search-{page}-".$keyword.".html";
}else{
	$arrparam="keyword=$keyword";
}
$tmpsql="select * from `".PRE."article` where  title like '%".$keyword."%'  and a.ischeck=1";		
$tmpsql.=" order by  `is_top` desc,`time` desc";

//����ģ���ļ�
require_once("../".$templatesfile."list_search.php");

/******************************************************************/

$db->close();//�ر�����

?>

 