<?PHP
require_once("../include/conn.php");
require_once("permit.php"); 
 
echo "<br>请等待，数据正在导出中...<br><br>";  
     
//$sqlfilename = "data/".DB_DATABASE."".date('Y-m-d').".sql";           
$sqlfilename =$_POST['sqlfilename'];
if ($sqlfilename==''){
	$sqlfilename = "../../backup/data/".DB_DATABASE."_data_".date('Y-m-d').".bak";  
}
//列出表名           
$query = mysql_query ("show tables;");
$sql3="";         
while ($row = mysql_fetch_array ($query))         
{            
    //得到创建表的SQL语句    
    $sql = "SHOW CREATE TABLE $row[0]";        
    $res = mysql_query($sql);        
    $jiegourow = mysql_fetch_row($res);        
    //构建创建表的SQL语句    
    $sql3 .= "\n# ---create table  ".$row[0]."  ------------------------------------\nDROP TABLE IF EXISTS `".$row[0]."`;\n".$jiegourow[1].";\n# ---insert   ".$row[0]."  data------------------------------------\n";        
    $sql2 = "select * from `".$row[0]."`";          
    $res2 = mysql_query($sql2);     
    //获取表的字段数         
    $numrows = mysql_num_fields($res2);               
    //构建向表中插入数据的SQL语句    
    while ($row2 = mysql_fetch_array($res2))        
    {            
        $comma2 = "";            
        $sql3 .= "insert into `".$row[0]."` values(";            
        for($i = 0; $i < $numrows; $i++) {            
              $sql3 .= $comma2."'".str_replace ("'", "\'",$row2[$i])."'";            
              $comma2 = ",";            
        }            
        $sql3 .= ");\n";    
		      
    }                           
}   
     
      
$sqldump = "# ------------------------------------------------------\n".        
            "# MySql Data Dump\n".        
            "# CreateDate: ".date('Y-m-d H:i',time())."\n".  
            "# Technology Support: wolfelove QQ:42768813\n".  		      
            "# Company: Chengdu Yuanding Information Inc.\n".  
			"# Web Address: http://www.cdydinfo.com\n".      
            "# --------------------------------------------------------\n\n\n".$sql3;   
unset($sql3);   
			
 
//写入文件    
if(@$fp = fopen($sqlfilename, 'wb'))        
{        
    @flock($fp, 2);        
    if(!fwrite($fp, $sqldump))         
    {        
        @fclose($fp);        
        exit("<font color=red>数据导出失败！</font><a href=\"index.php\">返回</a>");        
    } else         
    {        
        exit("<font color=red>数据导出成功！</font><a href=\"index.php\">返回</a>");        
    }        
}else       
{        
    echo "<font color=red>文件打开失败！</font><a href=\"index.php\">返回</a>";        
}        

?>