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
$arrparam="";
$tmpsql="";

$tmpsql="select a.* from `".PRE."member_company` a  left outer join  ".PRE."member b on a.memid=b.id where b.gradeid=2  and b.isdel=0 order by  b.istj desc,a.gxtime desc";

//����ģ���ļ�
require_once("../".$templatesfile."list_company.php");

/******************************************************************/

$db->close();//�ر�����

?>

 