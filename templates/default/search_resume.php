
<!doctype html>
<html class="no-js" lang="zh-CN">
<head>
<meta charset="utf-8">
<meta property="qc:admins" content="15313765564167625136367" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<!-- Set render engine for 360 browser -->
<meta name="renderer" content="webkit">
<title>技术工人_蓝领技工</title>
<?php require_once("common/inc_share_page.php");?>
<script type="text/javascript" src="<?php echo $templatesdir;?>common/inc_city.php"></script>
</head>
<body>
<!--顶部BEGIN-->
<?php require_once("common/inc_top.php");?>
<!--NAV Mobile--> 
<!-- 《md show E --> 
<!-- 《sm Show B --> 
<!-- 《sm show E --> 
<header data-am-widget="header" class="am-header am-header-default am-show-sm-only am-no-layout">
  <div class="am-header-left am-header-nav"> <a href="/"> <i class="am-header-icon am-icon-home"></i> </a> </div>
  <h1 class="am-header-title">技术工人</h1>
</header>
<?php require_once("common/inc_top_mobile.php");?>
<!--顶部END-->

<!--主体开始-->
<div class="box">
   <div class="am-container white">    
<ol class="am-breadcrumb">
  <li><a href="/" class="am-icon-home">蓝领首页</a></li>
  
  <li>技工人才</li>
  
</ol>
<div class="am-g">  
<div id="search_wap">
<form  class="am-form am-form-horizontal" action="/plus/search.php" method="get">
<input type="hidden" name="action" id="action" value="resume"/>
            
            
           <div class="am-form-group">
<div class=" am-u-sm-12 am-u-md-6">
    <label class="am-u-sm-3">    <a class="am-btn am-btn-secondary am-btn-block am-btn-sm" >性别要求</a></label>
    
    
    
    <div class="am-u-sm-9">
     
     
     
<select name="sex" class="am-input-sm">
<option value="">性别要求</option>
<option value="男" <?php if ($sex=='男'){echo "selected";}?>>男士</option>
<option value="女" <?php if ($sex=='女'){echo "selected";}?>>女士</option>
</select>
            
     
    </div>
    
    
    
    
     </div>  
    
   </div>   
    
<div class="am-form-group">
<div class=" am-u-sm-12 am-u-md-6">
    <label class="am-u-sm-3">    <a class="am-btn am-btn-secondary am-btn-block am-btn-sm" >婚姻状况</a></label>
    
    
    
    <div class="am-u-sm-9">
     
     
 
            
            
           <select name="hy" class="am-input-sm">
			<option value="">婚姻状况</option>
			<option value="未婚" <?php if ($hy=='未婚'){echo "selected";}?>>未婚</option>
			<option value="已婚" <?php if ($hy=='已婚'){echo "selected";}?>>已婚</option>
			</select>
            
     
    </div>
 
 
    
  </div> 
 </div> 
<div class="am-form-group">
<div class=" am-u-sm-12 am-u-md-6">
    <label class="am-u-sm-3">    <a class="am-btn am-btn-secondary am-btn-block am-btn-sm" >工作经验</a></label>
    
    
    
    <div class="am-u-sm-9">
     
     
            
            
            <select name="experience"  class="am-input-sm">
			<option value="" selected>工作经验</option>
		  <?php for ($i=1;$i<50;$i++){?>
		  <option value="<?php echo $i;?>" <?php if ($i==$experience){echo "selected";}?>><?php echo $i;?>年以上</option>
		  <?php }?>
		</select>
            
     
    </div>
 
 
    
  </div>
   </div>    
<div class="am-form-group">
<div class=" am-u-sm-12 am-u-md-6">
    <label class="am-u-sm-3">    <a class="am-btn am-btn-secondary am-btn-block am-btn-sm" >教育程度</a></label>
    
    
    
    <div class="am-u-sm-9">
     <?php $infoclass->InfoClassSelectPage(2,$jycd,'jycd','教育程度','100%','');?>         
    </div>
 
 
    
  </div>
   </div>   
          
<div class="am-form-group">
<div class=" am-u-sm-12 am-u-md-6">
    <label class="am-u-sm-3">    <a class="am-btn am-btn-secondary am-btn-block am-btn-sm" >技术工种</a></label>
    
    
    
    <div class="am-u-sm-9">
     <?php $infoclass->InfoClassSelectPage(3,$gz,'gz','技术工种','100%','');?>         
     
    </div>
 
 
    
  </div>
   </div>
<div class="am-form-group">
<div class=" am-u-sm-12 am-u-md-6">
    <label class="am-u-sm-3">    <a class="am-btn am-btn-secondary am-btn-block am-btn-sm" >所在地区</a></label>
    
    
    
    <div class="am-u-sm-9">
     <select name="province" id="province" onChange="changelocationobj(this.options[this.selectedIndex].value,this.form.city);"   class="usertext"style="width:46%; float:left;">
                      <option value="">省份</option>
						<?php 
						$asql="select * from `".PRE."city` where fid=0 order by 'sortid' asc";
						$drs=mysql_query($asql);
						while($drow=mysql_fetch_array($drs)){
						?>
					  <option value="<?php echo $drow["typename"];?>" <?php if ($drow['typename']==$province){echo "selected";}?>><?php echo $drow["typename"];?></option>
					  <?php } ?>
                    </select>
					
					<select name="city" id="city" class="usertext" style="width:46%; float:right;">
                      <option value="">城市</option>
					  <?php 
					  if ($province!=""){
						$asql="select a.* from `".PRE."city` a left outer join `".PRE."city` b on a.fid=b.id where b.typename='".$province."' order by a.sortid asc";
						$drs=mysql_query($asql);
						while($drow=mysql_fetch_array($drs)){
						?>
					  <option value="<?php echo $drow["typename"];?>"  <?php if ($drow['typename']==$city){echo "selected";}?>><?php echo $drow["typename"];?></option>
					  <?php }} ?>
                    </select>         
     
    </div>
 
 
    
  </div>
   </div>
<div class=" am-u-sm-12 am-u-md-6">
  
  <div class="am-u-sm-6"> <button type="button image" class="am-btn am-btn-success am-btn-block">搜索工人</button> </div> 
         
<div class="am-u-sm-6">
            
            <a href="/plus/search.php?action=resume" class="am-btn am-btn-default am-btn-block" rel="nofollow">重新搜索</a></div>        
 </div> 
</form>
</div>      
 <div id="search_pc">

 <table width="100%" border="0" cellspacing="10" cellpadding="0">
  <form class="am-form am-form-horizontal" action="/plus/search.php">
  <input type="hidden" name="action" id="action" value="resume"/>
     <tr>
       <td width="8%" height="60"><a class="am-btn am-btn-secondary am-btn-block am-btn-sm" style="width:100px;">性别要求</a></td>
       <td width="42%"><select name="sex"  class="usertext" style="width:80%;">
<option value="" selected>性别要求</option>
<option value="男" <?php if ($sex=="男"){echo "selected";}?>>男士</option>
<option value="女" <?php if ($sex=="女"){echo "selected";}?>>女士</option>
</select></td>
       <td width="8%"><a class="am-btn am-btn-secondary am-btn-block am-btn-sm" style="width:100px;">婚姻状况</a></td>
       <td width="42%"><select name="hy"  class="usertext" style="width:80%;">
			<option value="" selected>婚姻状况</option>
			<option value="未婚" <?php if ($hy=="未婚"){echo "selected";}?>>未婚</option>
			<option value="已婚" <?php if ($hy=="已婚"){echo "selected";}?>>已婚</option>
			</select></td>
     </tr>
     <tr>
       <td width="8%" height="60"><a class="am-btn am-btn-secondary am-btn-block am-btn-sm" style="width:100px;">工作经验</a></td>
       <td width="42%"><select name="experience"  class="usertext" style="width:80%;">
			<option value="" selected>工作经验</option>
		  <?php for ($i=1;$i<50;$i++){?>
		  <option value="<?php echo $i;?>" <?php if ($i==$experience){echo "selected";}?>><?php echo $i;?>年以上</option>
		  <?php }?>
		</select></td>
       <td width="8%"><a class="am-btn am-btn-secondary am-btn-block am-btn-sm" style="width:100px;">教育程度</a></td>
       <td width="42%"><?php $infoclass->InfoClassSelectPage(2,$jycd,'jycd','教育程度','80%','usertext');?> </td>
     </tr>	 
	 
     <tr>
       <td width="8%" height="60"><a class="am-btn am-btn-secondary am-btn-block am-btn-sm" style="width:100px;">技术工种</a></td>
       <td width="42%"><?php $infoclass->InfoClassSelectPage(3,$gz,'gz','技术工种','80%','usertext');?></td>
       <td width="8%"><a class="am-btn am-btn-secondary am-btn-block am-btn-sm" style="width:100px;">工作地区</a></td>
       <td width="42%"><select name="province" id="province" onChange="changelocationobj(this.options[this.selectedIndex].value,this.form.city);"   class="usertext"style="width:39%; float:left;">
                      <option value="">省份</option>
						<?php 
						$asql="select * from `".PRE."city` where fid=0 order by 'sortid' asc";
						$drs=mysql_query($asql);
						while($drow=mysql_fetch_array($drs)){
						?>
					  <option value="<?php echo $drow["typename"];?>" <?php if ($drow['typename']==$province){echo "selected";}?>><?php echo $drow["typename"];?></option>
					  <?php } ?>
                    </select>
					
					<select name="city" id="city" class="usertext" style="width:39%; float:left;">
                      <option value="">城市</option>
					  <?php 
					  if ($province!=""){
						$asql="select a.* from `".PRE."city` a left outer join `".PRE."city` b on a.fid=b.id where b.typename='".$province."' order by a.sortid asc";
						$drs=mysql_query($asql);
						while($drow=mysql_fetch_array($drs)){
						?>
					  <option value="<?php echo $drow["typename"];?>"  <?php if ($drow['typename']==$city){echo "selected";}?>><?php echo $drow["typename"];?></option>
					  <?php }} ?>
                    </select></td>
     </tr>

     <tr>
       <td colspan="4" align="center"> 
	  <div class="am-u-sm-6"> <button type="button image" class="am-btn am-btn-success am-btn-block" style="width:50%;">搜索工人</button> </div> 
	  <div class="am-u-sm-6"><a href="/plus/search.php?action=resume" class="am-btn am-btn-default am-btn-block" rel="nofollow" style="width:50%;">重新搜索</a>   </td>
       </tr>
	   </form> 
   </table>
   
 </div>

</div>
            
 <hr data-am-widget="divider" style="" class="am-divider am-divider-dashed" />
 <?php 
 $member->PageResumeSearchList($tmpsql,$pagesize,$arrparam);
 ?>
 
        </div>
<!--spacing-->
<div class="vertical-high-30">&nbsp;</div>
<!--spacing-end--> 
</div>


<!--主体 end-->

<!--footer-->
<?php require_once("common/inc_page_footer.php");?>
<!--底部-->

</body>
</html> 