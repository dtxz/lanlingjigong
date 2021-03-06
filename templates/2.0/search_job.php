
<!doctype html>
<html class="no-js" lang="zh-CN">
<head>
<meta charset="utf-8">
<meta property="qc:admins" content="15313765564167625136367" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<!-- Set render engine for 360 browser -->
<meta name="renderer" content="webkit">
<title>工作岗位_蓝领技工</title>
<?php require_once("common/inc_share_page.php");?>
<script type="text/javascript" src="<?php echo $templatesdir;?>common/inc_city.php"></script>
<style>
.am-table {
    width: 100%;
    margin-bottom: 1.6rem;
    border-spacing: 0;
    border-collapse:collapse;	
	
}
.am-text-middle{ border-top: 1px solid #fff; border-bottom: 1px solid #f1f1f1; font-size:14px;}
.am-text-top{ border-top: 1px solid #fff;border-top: 1px solid #fff;}

</style>
</head>
<body>
<!--顶部BEGIN-->
<?php require_once("common/inc_top_v2.php");?>
<!--NAV Mobile--> 
<!-- 《md show E --> 
<!-- 《sm Show B --> 
<!-- 《sm show E --> 
<header data-am-widget="header" class="am-header am-header-default am-show-sm-only am-no-layout">
  <div class="am-header-left am-header-nav"> <a href="/"> <i class="am-header-icon am-icon-home"></i> </a> </div>
  <h1 class="am-header-title">工作岗位</h1>
</header>
<?php require_once("common/inc_top_mobile.php");?>
<!--顶部END-->

<!--主体开始-->
<div class="box">
   <div class="am-container white"> 
        
<ol class="am-breadcrumb lanling-ol">
  <li><a href="/" class="am-icon-home">蓝领首页</a></li>
  
   <li><a href="/plus/search.php?action=job">推荐工作</a></li>
</ol>

<!--spacing-->
<div class="vertical-high-30">&nbsp;</div>
<!--spacing-end--> 

  <?php //$member->PageJobSearchList($tmpsql,$pagesize,$arrparam);;?>     
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
	<tr>
	<td valign="top"> 
	<?php $member->PageJobSearchListNew($tmpsql,$pagesize,$arrparam);;?>  
</td>
<td  valign="top" id="job_adv" align="right">
<div class="right_adv_top">
	<ul>
		<?php $adv->jobAdvShow($adv_job);?>

	</ul>
</div>
</td>
</table>

<hr data-am-widget="divider" style="" class="am-divider am-divider-dashed" />
<div class="am-g">
   
<!--手机端-->
<div id="search_wap">
<form class="am-form am-form-horizontal" action="/plus/search.php">
<input type="hidden" name="action" id="action" value="job"/>
<div class="am-form-group">
	<div class=" am-u-sm-12 am-u-md-6">
		<label class="am-u-sm-3">    <a class="am-btn am-btn-secondary am-btn-block am-btn-sm" >待遇水平</a></label>
		<div class="am-u-sm-4">
		 <input class="am-input-sm" type="text"  name="salary_s" value="<?php if ($salary_s!=""){echo $salary_s;}else{echo "0";}?>"/>
		</div>
		--
		  <div class="am-u-sm-4">
		 <input class="am-input-sm"  type="text"  name="salary_e" value="<?php if ($salary_e!=""){echo $salary_e;}else{echo "0";}?>"/>
		</div>  
   </div>   
</div>
 
 
<div class="am-form-group">
    <div class="am-u-sm-12 am-u-md-6">
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
	<div class="am-u-sm-12 am-u-md-6">
		<label class="am-u-sm-3">    <a class="am-btn am-btn-secondary am-btn-block am-btn-sm" >技术工种</a></label>
			<div class="am-u-sm-9">
				<?php $infoclass->InfoClassSelectPage(3,$zgtype,'zgtype','技术工种','100%','');?>
			</div>
	  </div>   
</div>    
 

 
<div class="am-form-group" style="width:100%;">

	<div class="am-u-sm-12 am-u-md-6">
    <label class="am-u-sm-3"><a class="am-btn am-btn-secondary am-btn-block am-btn-sm" >工作地区</a></label>
    
		<div class="am-u-sm-9">
		<select name="province" id="province" onChange="changelocation(this.options[this.selectedIndex].value,'city');" style="width:50%; float:left;">
                      <option value="">省份</option>
						<?php 
						$asql="select * from `".PRE."city` where fid=0 order by 'sortid' asc";
						$drs=mysql_query($asql);
						while($drow=mysql_fetch_array($drs)){
						?>
					  <option value="<?php echo $drow["typename"];?>" <?php if ($drow['typename']==$province){echo "selected";}?>><?php echo $drow["typename"];?></option>
					  <?php } ?>
                    </select>
					
					<select name="city" id="city" style="width:50%; float:left;">
                      <option value="">城市</option>
					  <?php 
						$asql="select a.* from `".PRE."city` a left outer join `".PRE."city` b on a.fid=b.id where b.typename='".$place_arr[0]."' order by a.sortid asc";
						$drs=mysql_query($asql);
						while($drow=mysql_fetch_array($drs)){
						?>
					  <option value="<?php echo $drow["typename"];?>"  <?php if ($drow['typename']==$city){echo "selected";}?>><?php echo $drow["typename"];?></option>
					  <?php } ?>
                    </select>
		</div>
  </div>       
</div>
<div class="am-u-sm-12 am-u-md-6">
	  <div class="am-u-sm-6"> <button type="button image" class="am-btn am-btn-success am-btn-block">搜索工作</button> </div> 
	  <div class="am-u-sm-6"><a href="/plus/search.php?action=job" class="am-btn am-btn-default am-btn-block" rel="nofollow">重新搜索</a>  </div>

 </div>
</form> 
 </div> 
 <!--手机端 结束-->
 
 <!--PC端-->
 <div id="search_pc">

 <table width="100%" border="0" cellspacing="10" cellpadding="0">
  <form class="am-form am-form-horizontal" action="/plus/search.php">
  <input type="hidden" name="action" id="action" value="job"/>
     <tr>
       <td width="8%" height="60"><a class="am-btn am-btn-secondary am-btn-block am-btn-sm" style="width:100px;">待遇水平</a></td>
       <td width="42%"><input class="usertext" type="text"  name="salary_s" value="<?php if ($salary_s!=""){echo $salary_s;}else{echo "0";}?>" style="width:37%;"/>--<input class="usertext"  type="text"  name="salary_e" value="<?php if ($salary_e!=""){echo $salary_e;}else{echo "0";}?>" style="width:37%;"/></td>
       <td width="8%"><a class="am-btn am-btn-secondary am-btn-block am-btn-sm" style="width:100px;">工作经验</a></td>
       <td width="42%"><select name="experience"  class="usertext" style="width:80%;">
			<option value="" selected>工作经验</option>
		  <?php for ($i=1;$i<50;$i++){?>
		  <option value="<?php echo $i;?>" <?php if ($i==$experience){echo "selected";}?>><?php echo $i;?>年以上</option>
		  <?php }?>
		</select></td>
     </tr>
     <tr>
       <td width="8%" height="60"><a class="am-btn am-btn-secondary am-btn-block am-btn-sm" style="width:100px;">技术工种</a></td>
       <td width="42%"><?php $infoclass->InfoClassSelectPage(3,$zgtype,'zgtype','技术工种','80%','usertext');?></td>
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
	  <div class="am-u-sm-6"> <button type="button image" class="am-btn am-btn-success am-btn-block" style="width:50%;">搜索工作</button> </div> 
	  <div class="am-u-sm-6"><a href="/plus/search.php?action=job" class="am-btn am-btn-default am-btn-block" rel="nofollow" style="width:50%;">重新搜索</a>   </td>
       </tr>
	   </form> 
   </table>
   
 </div>
 <!--PC端end-->
</div>

<!--spacing-->
<div class="vertical-high-30">&nbsp;</div>
<!--spacing-end--> 
<!--spacing-->
<div class="vertical-high-30">&nbsp;</div>
<!--spacing-end--> 
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