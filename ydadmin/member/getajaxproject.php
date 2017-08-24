<?php 
require_once("../include/conn.php");
require_once("permit.php");
?>
<?php 
global $db,$func;
$companyid=$_GET['companyid'];
$aid=$_GET['aid'];
$sql="select * from `".PRE."member_project` where memid=".$companyid."  order by id desc";
$rs=$db->query($sql);
$res="<option value=\"\"></option>\n";
$i=0;
while($row=$db->fetch_array($rs)){

 if ($row['id']==$aid){
  $res.="<option value=\"".$row["id"]."\" selected>".$row["projectname"]."</option>\n";
 }else{
  $res.="<option value=\"".$row["id"]."\">".$row["projectname"]."</option>\n";
 }
 $i=$i+1;
}
echo $res;
?>