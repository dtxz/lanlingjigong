<?php require_once("../../../public/appconfig.php");?>
var onecount;
subcat = new Array();
<?php 
$atmpsql = "select a.id,a.typename,a.fid,b.typename as ftypename from ".PRE."city a left outer join ".PRE."city b on a.fid=b.id  order by a.sortid  asc";
$ars=$db->query($atmpsql) or die("SQL execution error！".$atmpsql);
$i=0;
while($arow = $db->fetch_array($ars)){
?>
subcat[<?php echo $i;?>] = new Array("<?php echo $arow['id'];?>","<?php echo $arow['typename'];?>","<?php echo $arow['ftypename'];?>");
<?php
	$i=$i+1;
}
?>
onecount=<?php echo $i;?>;

//选择二级城市
function changelocation(locationid,tagname){

 	var obj=document.getElementById(tagname);
	obj.length = 0; 
	var i;
	for (i=0;i < onecount; i++){
 			if (subcat[i][2]==locationid && locationid!=""){
			
			obj.options[obj.length] = new Option(subcat[i][1], subcat[i][1]);
			
			}
     
	}
} 
 //选择二级城市
function changelocationobj(locationid,obj){
	obj.length = 0; 
	var i;
	for (i=0;i < onecount; i++){
 			if (subcat[i][2]==locationid && locationid!=""){
			
			obj.options[obj.length] = new Option(subcat[i][1], subcat[i][1]);
			
			}
     
	}
} 