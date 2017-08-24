<?php

//系统会员操作类
class member{	
	
	function __construct(){}
	
	//----------------------------------------------------------------------------
	//事件名称
	function getactionname($action){
		$return="";
		if ($action=='desk'){
			$return="会员基本信息";	
		
		}elseif ($action=='baseinfo'){
			$return="会员基本信息";	

		}elseif ($action=='myfavorite'){
			$return="我的收藏";	
			
		}elseif ($action=='studyinfo'){
			$return="讲师积分记录";	
			
		}elseif ($action=='process'){
			$return="课程积分记录";	
			
		}elseif ($action=='modifypwd'){
			$return="修改密码";	
				
		}elseif ($action=='edit'){
			$return="资料修改";							
		 }
		 return $return;
	}	
	
	//加载Action模块
	function LoadMoudleAction($action,$op){
		global $db,$func,$templatesdir,$infoclass,$member,$mdata,$baseinfo,$personal,$company,$session_uid,$session_usertype;
		$return="";
		if ($action=='desk' || $action==""){
			$return="我的默认桌面";	
			if ($mdata['base']['gradeid']=="1"){
				require_once('..'.$templatesdir.'user_desk.php');
			}elseif ($mdata['base']['gradeid']=="2"){
				require_once('..'.$templatesdir.'user_desk_company.php');
			}
		}elseif ($action=='baseinfo'){
		     if ($session_usertype==1){
				$return="技工信息";
				if ($op=="save"){
					$this->PageUserUpdateBaseInfo();
				}else{
					require_once('..'.$templatesdir.'user_profile.php');
				}
			}else{
				echo "您无权限访问页面！";
			}
		}elseif ($action=='resume'){
			if ($session_usertype==1){
				$return="我的简历";	
				if ($op=="save"){
					$this->PageUserUpdateResume();
				}else{
					require_once('..'.$templatesdir.'user_resume.php');
				}
			}else{
				echo "您无权限访问页面！";
			}
		}elseif ($action=='search'){
			if ($session_usertype==1){
				$return="技工查询";
				require_once('..'.$templatesdir.'user_search.php');
			}else{
				echo "您无权限访问页面！";
			}
				
		}elseif ($action=='jobapply'){
			if ($session_usertype==1){
				$return="应聘岗位";	
				if ($op=="del"){
					$this->PageApplyDel();
				}else{
					require_once('..'.$templatesdir.'user_jobapply.php');	
				}
			}else{
				echo "您无权限访问页面！";
			}
		
		}elseif ($action=='companyinfo'){
			if ($session_usertype==2){
				$return="企业信息";
				if ($op=="save"){
					$this->PageCompanyUpdateBaseInfo();
				}else{
					require_once('..'.$templatesdir.'user_companyinfo.php');
				}
			}else{
				echo "您无权限访问页面！";
			}
			
		}elseif ($action=='project'){
			$this->checkCompanyRZPermission();
			if ($session_usertype==2){
				$return="项目管理";	
				if ($op=="addsave"){
					$this->PageProjectAdd();
				}elseif ($op=="editsave"){
					$this->PageProjectUpdate();
				}elseif ($op=="del"){
					$this->PageProjectDel();				
				}else{
					require_once('..'.$templatesdir.'user_project.php');
				}
			}else{
				echo "您无权限访问页面！";
			}
			
		}elseif ($action=='job'){
			$this->checkCompanyRZPermission();
			if ($session_usertype==2){
				$return="招聘管理";
				if ($op=="addsave"){
					$this->PageJobAdd();
				}elseif ($op=="editsave"){
					$this->PageJobUpdate();
				}elseif ($op=="del"){
					$this->PageJobDel();				
				}else{
					require_once('..'.$templatesdir.'user_job.php');
				}
			}else{
				echo "您无权限访问页面！";
			}
 
		}elseif ($action=='modifypwd'){
			$return="修改密码";	
			if ($op=='modifysave'){
				$this->PageUserModifyPwd();
			}else{
				require_once('..'.$templatesdir.'user_modifypwd.php');						
			}
		 }
		// echo  $return;
	}	
		
	//执行事件
	function operateAction($action,$op){
		global $db,$func,$pageinfo;

 		if ($action=='modifypwd'){//修改密码
			if ($op=='save'){
				 $this->member_modifypwd();
			}
		}			
	}	
	
	//注册登录退出事件
	function RunAction($action){
		global $db,$func;
		if ($action==""){$action=isset($_GET["action"])?$_GET["action"]:"";}
		$action=$func->strcheck($action);
		if ($action=='register'){//注册
			$usertype=isset($_POST["usertype"])?$_POST["usertype"]:1;
			//验证码检测
			$session_pcode=$_SESSION['pcode'];
			$pcode=isset($_POST['pcode'])?$_POST['pcode']:'';
			
			$usertype=$func->strcheck($usertype);
			$pcode=$func->strcheck($pcode);
			
			if (trim(strtolower($session_pcode))!=trim(strtolower($pcode)) && $pcode!=""){
				$gourl="/user/register.php?usertype=".$usertype;
				echo "<script>alert('温馨提示：验证码填写不正确！');window.location='".$gourl."';</script>";
				exit;
			}
			$this->member_reg_do();
				
		}elseif ($action=='login'){//登录
			$usertype=$func->strcheck(isset($_POST["usertype"])?$_POST["usertype"]:1);
			$user=$func->strcheck(isset($_POST["username"])?$_POST["username"]:'');
			$password=$func->strcheck(isset($_POST["password"])?$_POST["password"]:'');
			$vcode=$func->strcheck(isset($_POST["vcode"])?$_POST["vcode"]:'');
			
			$usertype=$func->strcheck($usertype);
			$username=$func->strcheck($username);
			$password=$func->strcheck($password);
			$vcode=$func->strcheck($vcode);
			
			$vcode_session=$_SESSION['vercode'];
			$this->memberlogin($user,$password,$usertype);
		}elseif ($action=='findpwd'){//找回面
 
			$user=$func->strcheck(isset($_POST["username"])?$_POST["username"]:'');
			$email=$func->strcheck(isset($_POST["email"])?$_POST["email"]:'');
			$yourname=$func->strcheck(isset($_POST["yourname"])?$_POST["yourname"]:'');
			
			$username=$func->strcheck($username);
			$email=$func->strcheck($email);
			$yourname=$func->strcheck($yourname);
			
			$this->GetFindPwd($user,$password,$yourname);

		}elseif ($action=='logout'){//退出
			$this->SessionDestroy();
			$func->GoUrl("/");
		}		
	}		
	
	/**************技工会员操作*******************************************************************/
	
	//后台：技工会员列表
	function memberlist($tmpsql,$pagesize,$arrparam){
		global $db,$func,$type,$cidy,$content_update,$content_del;
		$page2=isset($_GET['page']) ? $_GET['page'] :1;
		$flag=isset($_GET['flag']) ? $_GET['flag'] :1;
 
		$sql=$tmpsql;
		$arr=$func->get_page_num($sql,$pagesize);
		$sql.=" limit $arr[1], $pagesize";

		$rs=$db->query($sql);// or die("SQL execution error！")
		
		echo "<table width='100%' border='0' align='center' cellpadding='2' cellspacing='0' class='lrbtline'>";
		echo "		<tr>";
		if ($func->PermitAdmin($content_del)==true){//有删除权限
			echo "				<td width='6%' align='center' class='lrbtlineHead'><input name=\"chkall\" type=\"checkbox\" id=\"chkall\" onclick=\"javascript:CheckAll(this.form);\"  style=\"border:0px;\"  title='全选择或者全取消' > <input type=button onclick='javascript:del(this.form);' value='×' title='删除选择项' class=\"btn_del\"></td>";
		}else{
			//echo "				<td width='6%' align='center' class='lrbtlineHead'></td>";
		}
/*		echo "				<td width='80'   align='left' class='lrbtlineHead'>登录账户</td>";
		echo "				<td width='50' align='center' class='lrbtlineHead'>姓名</td>";
		echo "				<td  width='70' align='center' class='lrbtlineHead'>身份证号</td>";
		echo "				<td  width='80' align='center' class='lrbtlineHead'>所在地</td>";
		echo "				<td  width='135' align='center' class='lrbtlineHead'>所属企业</td>";			
		echo "				<td   align='center' class='lrbtlineHead'>就职项目</td>";	
		echo "				<td  width='70' align='center' class='lrbtlineHead'>项目经理</td>";		
		echo "				<td  width='60' align='center' class='lrbtlineHead'>就业状态</td>";	
		echo "				<td  width='60' align='center' class='lrbtlineHead'>锁定状态</td>";	
		echo "				<td  width='60' align='center' class='lrbtlineHead'>显示状态</td>";	
		echo "				<td  width='60'  align='center' class='lrbtlineHead'>注册日期</td>";
		echo "				<td  width='100' align='center' class='lrbtlineHead'>操作</td>";*/
		echo "				<td   align='left' class='lrbtlineHead'>登录账户</td>";
		echo "				<td  align='center' class='lrbtlineHead'>姓名</td>";
		echo "				<td   align='center' class='lrbtlineHead'>身份证号</td>";
		echo "				<td   align='center' class='lrbtlineHead'>所在地</td>";
		echo "				<td   align='center' class='lrbtlineHead'>所属企业</td>";			
		echo "				<td   align='center' class='lrbtlineHead'>就职项目</td>";	
		echo "				<td   align='center' class='lrbtlineHead'>项目经理</td>";		
		echo "				<td   align='center' class='lrbtlineHead'>就业状态</td>";	
		echo "				<td   align='center' class='lrbtlineHead'>锁定状态</td>";	
		echo "				<td   align='center' class='lrbtlineHead'>显示状态</td>";	
		echo "				<td   align='center' class='lrbtlineHead'>注册日期</td>";
		echo "				<td   align='center' class='lrbtlineHead'>操作</td>";
		echo "		</tr>";
		
		while($row = $db->fetch_array($rs)){
 
				$tmp_enable="";
 				if ($row['islock']==0){
					$tmp_enable="<a href='editdo.php?page=".$page2."&action=islock&rflag=1&id=".$row['id']."&".$arrparam."' title=\"锁定账户\">锁定</a>|";
				}else{
					$tmp_enable="<a href='editdo.php?page=".$page2."&action=islock&rflag=0&id=".$row['id']."&".$arrparam."' title=\"启用账户\">启用</a>|";
				}		

				$targeturl="";
				$islock=($row["islock"]==0)?"<font color=green>启用</font>":"<font color=red>已锁定</font>";
 				$wkstatus=($row["wkstatus"]==1)?"<font color=green>在岗":"待业";
				$xmmanager=($row["xmmanager"]==1)?"<font color=green>是</font>":"否";
		 		$is_show=($row["is_show"]==1)?"<font color=green>是</font>":"否";
				echo "		<tr  class='outrow' onMouseOver=\"this.className='onrow';\" onMouseOut=\"this.className='outrow';\">";
				if ($func->PermitAdmin($content_del)==true){//有删除权限
				echo "				<td align='center'><input name='id' id='id'  type='checkbox' value='$row[id]' style='border:0px;'></td>";
				}else{//无删除权限
				//echo "				<td align='center'><input name='id' id='id'  type='checkbox' value='$row[id]' style='border:0px;' disabled></td>";
				}
				echo "				<td align='left'>".$row['username']."</td>";
				echo "				<td align='center'>".$row['xingming']."</td>";
				echo "				<td align='center'>".$row['sfzno']."</td>";					
				echo "				<td align='center'>".$row['place']."</td>";	
				echo "				<td align='center'>".$this->getcompanyname($row['companyid'])."</td>";
				echo "				<td align='center'>".$this->getxmname($row['xmid'])."</td>";
				echo "				<td align='center'>".$xmmanager."</td>";
				echo "				<td align='center'>".$wkstatus."</td>";
				echo "				<td align='center'>".$islock."</td>";	
				echo "				<td align='center'>".$is_show."</td>";	
				echo "				<td align='center'>".$func->format_datetime($row['addtime'])."</td>";
				if ($func->PermitAdmin($content_update)==true){
					echo "			<td align='right' style=\"padding-right:10px;\">".$tmp_enable."<a href=\"resumeview.php?page=".$page2."&id=".$row['id']."&".$arrparam."\" title=\"点击查看技工简历\">查看</a>|<a href=\"edit.php?page=".$page2."&action=modify&id=".$row['id']."&".$arrparam."\">修改</a></td>";
				}else{
					echo "			<td align='right' style=\"padding-right:10px;\">".$tmp_enable."<a href=\"resumeview.php?page=".$page2."&id=".$row['id']."&".$arrparam."\" title=\"点击查看技工简历\">查看</a></td>";
				}

				echo "</tr>";
		}
		echo "</table>";
		
		new cmspage($arr[0],$pagesize,$arrparam);
	}

	//后台：技工会员搜索统计列表
	function membersearchlist($tmpsql,$pagesize,$arrparam){
		global $db,$func,$type,$cidy;
		$page2=isset($_GET['page']) ? $_GET['page'] :1;
		$flag=isset($_GET['flag']) ? $_GET['flag'] :1;
 
		$sql=$tmpsql;
		$arr=$func->get_page_num($sql,$pagesize);
		$sql.=" limit $arr[1], $pagesize";

		$rs=$db->query($sql);// or die("SQL execution error！")
		
		echo "<table width='100%' border='0' align='center' cellpadding='2' cellspacing='0' class='lrbtline'>";
		echo "		<tr>";
 
		//echo "				<td width='80'   align='center' class='lrbtlineHead'>登录账户</td>";
		echo "				<td width='80' align='center' class='lrbtlineHead'>姓名</td>";
		echo "				<td  width='100' align='center' class='lrbtlineHead'>身份证号</td>";
		echo "				<td  width='80' align='center' class='lrbtlineHead'>所在地</td>";
		echo "				<td  align='center' class='lrbtlineHead'>所属企业</td>";			
		echo "				<td  width='150' align='center' class='lrbtlineHead'>就职项目</td>";	
		echo "				<td  width='70' align='center' class='lrbtlineHead'>项目经理</td>";		
		echo "				<td  width='60' align='center' class='lrbtlineHead'>就业状态</td>";	
		//echo "				<td  width='60' align='center' class='lrbtlineHead'>锁定状态</td>";	
		echo "				<td  width='60' align='center' class='lrbtlineHead'>显示状态</td>";	
		echo "				<td  width='60'  align='center' class='lrbtlineHead'>注册日期</td>";
		echo "				<td  width='100' align='center' class='lrbtlineHead'>查看简历</td>";
		echo "		</tr>";
		
		while($row = $db->fetch_array($rs)){
				$targeturl="";
				$islock=($row["islock"]==0)?"<font color=green>启用</font>":"<font color=red>已锁定</font>";
 				$wkstatus=($row["wkstatus"]==1)?"<font color=green>在岗":"待业";
				$xmmanager=($row["xmmanager"]==1)?"<font color=green>是</font>":"否";
		 		$is_show=($row["is_show"]==1)?"<font color=green>是</font>":"否";
				echo "		<tr  class='outrow' onMouseOver=\"this.className='onrow';\" onMouseOut=\"this.className='outrow';\">";
				//echo "				<td align='center'>".$row['username']."</td>";
				echo "				<td align='center'>".$row['xingming']."</td>";
				echo "				<td align='center'>".$row['sfzno']."</td>";					
				echo "				<td align='center'>".$row['place']."</td>";	
				echo "				<td align='center'>".$this->getcompanyname($row['companyid'])."</td>";
				echo "				<td align='center'>".$this->getxmname($row['xmid'])."</td>";
				echo "				<td align='center'>".$xmmanager."</td>";
				echo "				<td align='center'>".$wkstatus."</td>";
				//echo "				<td align='center'>".$islock."</td>";	
				echo "				<td align='center'>".$is_show."</td>";	
				echo "				<td align='center'>".$func->format_datetime($row['addtime'])."</td>";
				echo "			<td align='center'><a href=\"resumeview.php?page=".$page2."&id=".$row['id']."&".$arrparam."\" title=\"点击查看技工简历\">【查看】</td>";

				echo "</tr>";
		}
		echo "</table>";
		
		new cmspage($arr[0],$pagesize,$arrparam);
	}
	
 	//后台：注册技工会员
	function memberadd() {
		global $db,$func;

		$gradeid      =1;				
		$username     =trim($_POST['username']);	
		$password     =md5($_POST['password']);
		$xingming     =$_POST['xingming'];
		$usercode     =$_POST['usercode'];	 	
		$sex          =$_POST['sex'];		
		$borndate     =$_POST['borndate'];		
		$sfzno        =$_POST['sfzno'];
 		$mz           =$_POST['mz'];
		$hy           =$_POST['hy']; 	
		$hj           =$_POST['province']."-".$_POST['city'];	
 		$jycd         =$_POST['jycd'];	
		$byxx         =$_POST['byxx'];	
		$teleno       =$_POST['teleno'];
 		$mobile       =$_POST['mobile'];
		$address      =$_POST['address']; 	
		$jkzk         =$_POST['jkzk'];
		$sxyz         =$_POST['sxyz'];	
		$sxyz_data="";

		$size = count($sxyz);
		for($i=0; $i<$size; $i++)
		{
			if ($i==0)
			{
			$sxyz_data = $sxyz[$i];
			}
			else
			{
			$sxyz_data = $sxyz_data.",".$sxyz[$i];
			}
		}
		$sxyz=$sxyz_data;		
 		$hz           =$_POST['hz'];	
		$pic          =$_POST['pic'];			
		$wkstatus     =isset($_POST['wkstatus'])?$_POST['wkstatus']:0;	
 		$zw           =$_POST['zw'];
		$gz           =$_POST['gz']; 	
		$place        =$_POST['province2']."-".$_POST['city2'];
 		$companyid    =isset($_POST['companyid'])?$_POST['companyid']:0;	
		$xmid         =isset($_POST['xmid'])?$_POST['xmid']:0;			
		$xmmanager    =isset($_POST['xmmanager'])?$_POST['xmmanager']:0;		
		$is_show      =isset($_POST['is_show'])?$_POST['is_show']:0;	
		$islock       =isset($_POST['islock'])?$_POST['islock']:0;	
		$ischeck      =1;					
		$addtime      =date('Y-m-d H:i:s'); 
 		$gxtime       =$addtime;
		$updatetime   =$addtime;
		$isdel        =0;


		$jszc       =$_POST['jszc'];
 		$gzjy       =$_POST['gzjy'];
		$email      =$_POST['email']; 	
		$qq         =$_POST['qq'];
		$gzjl         =$_POST['gzjl'];	
		
		
		//保存基本账户
		$column="";
		$column.="gradeid";
		$column.=",username";
		$column.=",password";
		$column.=",islock";
		$column.=",ischeck";
		$column.=",addtime";
		$column.=",updatetime";
		$column.=",isdel";
		
		$columnvalue="";
		$columnvalue.="'".$gradeid."'";
		$columnvalue.=",'".$username."'";
		$columnvalue.=",'".$password."'";
		$columnvalue.=",'".$islock."'";
		$columnvalue.=",'".$ischeck."'";
		$columnvalue.=",'".$addtime."'";
		$columnvalue.=",'".$updatetime."'";
		$columnvalue.=",'".$isdel."'";		

		//检测账户是否重名
		if ($username!=""){
		$this->checkmember($username,$gradeid);
		}
		//检测身份证号码是否重名
		$this->checkmembersfzno($sfzno);
		
		//写入账户信息
		//if ($username!=""){
		$sql="insert into ".PRE."member(".$column.") values (".$columnvalue.")";
		$db->query($sql) or die("SQL execution error!-401");
		//取得最新的会员id
		$memid = mysql_insert_id();
		//}else{
			//$memid=0;
		//}

		//保存技工信息
		$column="";
		$column.="memid";
		$column.=",usercode";		
		$column.=",pic";
		$column.=",xingming";
		$column.=",sex";
		$column.=",borndate";
		$column.=",sfzno";
		$column.=",mz";
		$column.=",hy";
		
		$column.=",hj";
		$column.=",jycd";
		$column.=",byxx";
		$column.=",teleno";
		$column.=",mobile";
		$column.=",address";
		$column.=",jkzk";		
		
		$column.=",sxyz";
		$column.=",hz";
		$column.=",wkstatus";
		$column.=",gz";
		$column.=",zw";
		$column.=",place";
		$column.=",companyid";			
		
		$column.=",xmid";
		$column.=",xmmanager";
		$column.=",gxtime";
		$column.=",is_show";
		
		$column.=",jszc";
		$column.=",gzjy";
		$column.=",email";
		$column.=",qq";
		$column.=",gzjl";		
		
			
		$columnvalue="";
		$columnvalue.="'".$memid."'";
		$columnvalue.=",'".$usercode."'";		
		$columnvalue.=",'".$pic."'";
		$columnvalue.=",'".$xingming."'";
		$columnvalue.=",'".$sex."'";
		$columnvalue.=",'".$borndate."'";
		$columnvalue.=",'".$sfzno."'";
		$columnvalue.=",'".$mz."'";
		$columnvalue.=",'".$hy."'";	
		$columnvalue.=",'".$hj."'";
		$columnvalue.=",'".$jycd."'";
		$columnvalue.=",'".$byxx."'";
		$columnvalue.=",'".$teleno."'";
		$columnvalue.=",'".$mobile."'";
		$columnvalue.=",'".$address."'";
		$columnvalue.=",'".$jkzk."'";	
		
		$columnvalue.=",'".$sxyz."'";
		$columnvalue.=",'".$hz."'";
		$columnvalue.=",'".$wkstatus."'";
		$columnvalue.=",'".$gz."'";
		$columnvalue.=",'".$zw."'";			
		
		$columnvalue.=",'".$place."'";
		$columnvalue.=",'".$companyid."'";
		$columnvalue.=",'".$xmid."'";
		$columnvalue.=",'".$xmmanager."'";
		$columnvalue.=",'".$gxtime."'";						
		$columnvalue.=",'".$is_show."'";	
		
		$columnvalue.=",'".$jszc."'";
		$columnvalue.=",'".$gzjy."'";
		$columnvalue.=",'".$email."'";
		$columnvalue.=",'".$qq."'";
		$columnvalue.=",'".$gzjl."'";		
	
		//写入技工信息表
		$sql="insert into ".PRE."member_personal(".$column.") values (".$columnvalue.")";
		$db->query($sql) or die("SQL execution error!-402");

		//保存简历信息
		$column="";
		$column.="memid";
		//$column.=",usercode";		
		$column.=",xingming";
		$column.=",gz";
		$column.=",sfzno";
		$column.=",pic";
		$column.=",sex";
		$column.=",place";			
		$column.=",borndate";
		$column.=",jycd";
		$column.=",byxx";
		$column.=",mz";
		$column.=",mobile";
		$column.=",status";
		$column.=",openstatus";			
		$column.=",gxtime";

				
		$columnvalue="";
		$columnvalue.="'".$memid."'";
		//$columnvalue.=",'".$usercode."'";
		$columnvalue.=",'".$xingming."'";		
		$columnvalue.=",'".$gz."'";
		$columnvalue.=",'".$sfzno."'";
		$columnvalue.=",'".$pic."'";
		$columnvalue.=",'".$sex."'";
		$columnvalue.=",'".$place."'";	
		$columnvalue.=",'".$borndate."'";
		$columnvalue.=",'".$jycd."'";
		$columnvalue.=",'".$byxx."'";
		$columnvalue.=",'".$mz."'";
		$columnvalue.=",'".$mobile."'";
		$columnvalue.=",'0'";
		$columnvalue.=",'3'";			
		$columnvalue.=",'".$gxtime."'";						
		
		//写入简历信息表
		//$sql="insert into ".PRE."member_resume(".$column.") values (".$columnvalue.")";
		//$db->query($sql) or die("SQL execution error!-403".$sql);
		
		echo "<script type='text/javascript'> if(confirm('是否要继续添加技工信息?')){ window.location.href='edit.php?action=add';}else{ window.location.href='list.php';	}</script>";
	}
 
	//修改技工会员
	function memberupdate() {
		global $db,$func,$log;
		$username     =trim($_POST['username']);	
		$password     =trim($_POST['password']);
		$xingming     =$_POST['xingming']; 	
		$sex          =$_POST['sex'];		
		$borndate     =$_POST['borndate'];		
		$sfzno        =$_POST['sfzno'];
 		$mz           =$_POST['mz'];
		$hy           =$_POST['hy']; 	
		$hj           =$_POST['province']."-".$_POST['city'];	
 		$jycd         =$_POST['jycd'];	
		$byxx         =$_POST['byxx'];	
		$teleno       =$_POST['teleno'];
 		$mobile       =$_POST['mobile'];
		$address      =$_POST['address']; 	
		$jkzk         =$_POST['jkzk'];
		$sxyz         =$_POST['sxyz'];	
		$sxyz_data="";

		$size = count($sxyz);
		for($i=0; $i<$size; $i++)
		{
			if ($i==0)
			{
			$sxyz_data = $sxyz[$i];
			}
			else
			{
			$sxyz_data = $sxyz_data.",".$sxyz[$i];
			}
		}
		$sxyz=$sxyz_data;	
 
 		$hz           =$_POST['hz'];	
		$pic          =$_POST['pic'];			
		$wkstatus     =isset($_POST['wkstatus'])?$_POST['wkstatus']:0;	
 		$zw           =$_POST['zw'];
		$gz           =$_POST['gz']; 	
		$place        =$_POST['province2']."-".$_POST['city2'];
 		$companyid    =isset($_POST['companyid'])?$_POST['companyid']:0;	
		$xmid         =isset($_POST['xmid'])?$_POST['xmid']:0;			
		$xmmanager    =isset($_POST['xmmanager'])?$_POST['xmmanager']:0;		
		$is_show      =isset($_POST['is_show'])?$_POST['is_show']:0;	
		$islock       =isset($_POST['islock'])?$_POST['islock']:0;	
 		$gxtime       =date('Y-m-d H:i:s');
		
		$jszc       =$_POST['jszc'];
 		$gzjy       =$_POST['gzjy'];
		$email      =$_POST['email']; 	
		$qq         =$_POST['qq'];
		$gzjl         =$_POST['gzjl'];	
		
		//查询所带参数
		$act=isset($_POST['act']) ? $_POST['act'] : '';
		$keyword=isset($_POST['keyword']) ? $_POST['keyword'] : '';
		$page=isset($_POST['page']) ? $_POST['page'] :1;
		$sdate=isset($_POST['sdate']) ? $_POST['sdate'] : '';
		$edate=isset($_POST['edate']) ? $_POST['edate'] : '';
		$wkstatusnew=isset($_POST['wkstatusnew']) ? $_POST['wkstatusnew'] :0;
		$islocknew=isset($_POST['islocknew']) ? $_POST['islocknew'] : '';
 
		$url="page=".$page."&act=".$act."&keyword=".$keyword."&sdate=".$sdate."&edate=".$edate."&islock=".$islocknew."&wkstatus=".$wkstatusnew;

		//取得最新的会员id
		$memid = $_GET['id'];

		
		//检测身份证号码是否重名
		$this->checkmembersfzno2($sfzno,$memid);
		
		//修改密码
		$str="";
		if ($password!=""){
			$sql2="update ".PRE."member set `password` = '".md5($password)."' where id=".$memid."";
			$db->query($sql2) or die("SQL execution error!-modify password");
		}
		if ($username!=""){
			$sql2="update ".PRE."member set `username` = '".$username."' where id=".$memid."";
			$db->query($sql2) or die("SQL execution error!-modify username");
		}
		//保存账户扩展信息
		$columnvalue="";
		$columnvalue.="xingming='".$xingming."'";
		$columnvalue.=",pic='".$pic."'";		
		$columnvalue.=",sex='".$sex."'";
		$columnvalue.=",borndate='".$borndate."'";
		$columnvalue.=",sfzno='".$sfzno."'";
		$columnvalue.=",mz='".$mz."'";
		$columnvalue.=",hy='".$hy."'";
		$columnvalue.=",hj='".$hj."'";
		$columnvalue.=",jycd='".$jycd."'";
		$columnvalue.=",byxx='".$byxx."'";
		$columnvalue.=",teleno='".$teleno."'";
		$columnvalue.=",mobile='".$mobile."'";
		$columnvalue.=",address='".$address."'";
		$columnvalue.=",jkzk='".$jkzk."'";
		$columnvalue.=",sxyz='".$sxyz."'";
		$columnvalue.=",hz='".$hz."'";
		$columnvalue.=",wkstatus='".$wkstatus."'";
		$columnvalue.=",gz='".$gz."'";
		$columnvalue.=",zw='".$zw."'";
		$columnvalue.=",place='".$place."'";
		$columnvalue.=",companyid='".$companyid."'";
		$columnvalue.=",xmid='".$xmid."'";				
		$columnvalue.=",xmmanager='".$xmmanager."'";
		$columnvalue.=",gxtime='".$gxtime."'";
		$columnvalue.=",is_show='".$is_show."'";
		
		$columnvalue.=",jszc='".$jszc."'";
		$columnvalue.=",gzjy='".$gzjy."'";
		$columnvalue.=",email='".$email."'";
		$columnvalue.=",qq='".$qq."'";
		$columnvalue.=",gzjl='".$gzjl."'";		
		$columnvalue.=",flag='1'";		
 
		$sql="update ".PRE."member_personal set ".$columnvalue." where memid='".$memid."' ";
		$db->query($sql) or die("SQL execution error!-modify memberinfo");
		
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('修改成功！');window.location.href='list.php?$url';</SCRIPT>";
	}
 
	//删除技工会员
	function memberdel() {
		global $db;
 
		$act=isset($_GET['act']) ? $_GET['act'] : '';
		$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$page=isset($_GET['page']) ? $_GET['page'] : '';
		$sdate=isset($_GET['sdate']) ? $_GET['sdate'] : '';
		$edate=isset($_GET['edate']) ? $_GET['edate'] : '';
		$islock=isset($_GET['islock']) ? $_GET['islock'] : '';
		$enable=isset($_GET['wkstatus']) ? $_GET['wkstatus'] : '';		
		$url="page=$page&act=$act&keyword=$keyword&sdate=$sdate&edate=$edate&islock=$islock&wkstatus=$wkstatus";

		$sql = "delete from `".PRE."member` where `id` in (".$_GET['id'].")";
		$db->query($sql) or die("SQL execution error!");

		$sql = "delete from `".PRE."member_personal` where `memid` in (".$_GET['id'].")";
		$db->query($sql) or die("SQL execution error!");
		
		$sql = "delete from `".PRE."member_resume` where `memid` in (".$_GET['id'].")";
		$db->query($sql) or die("SQL execution error!");

		
		$sql = "delete from `".PRE."member_company` where `memid` in (".$_GET['id'].")";
		$db->query($sql) or die("SQL execution error!");

		$sql = "delete from `".PRE."member_project` where `memid` in (".$_GET['id'].")";
		$db->query($sql) or die("SQL execution error!");
		
		$sql = "delete from `".PRE."member_job` where `memid` in (".$_GET['id'].")";
		$db->query($sql) or die("SQL execution error!");
		
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='list.php?$url';</SCRIPT>";
	}
 	
	//多记录删除技工会员
	function memberdelall() {
		global $db;
		$act=isset($_GET['act']) ? $_GET['act'] : '';
		$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$page=isset($_GET['page']) ? $_GET['page'] : '';
		$sdate=isset($_GET['sdate']) ? $_GET['sdate'] : '';
		$edate=isset($_GET['edate']) ? $_GET['edate'] : '';
		$islock=isset($_GET['islock']) ? $_GET['islock'] : '';
		$enable=isset($_GET['wkstatus']) ? $_GET['wkstatus'] : '';
		
		$url="page=$page&act=$act&keyword=$keyword&sdate=$sdate&edate=$edate&wkstatus=$wkstatus&islock=$islock";
 
		$sql = "delete from  `".PRE."member`   where `id` in (".$_POST['delaid'].")";	
		$db->query($sql) or die("SQL execution error!");
		
		$sql = "delete from  `".PRE."member_personal`   where `memid` in (".$_POST['delaid'].")";		
		$db->query($sql) or die("SQL execution error!");
		
		$sql = "delete from  `".PRE."member_resume`   where `memid` in (".$_POST['delaid'].")";		
		$db->query($sql) or die("SQL execution error!");

		
		$sql = "delete from  `".PRE."member_company`   where `memid` in (".$_POST['delaid'].")";		
		$db->query($sql) or die("SQL execution error!");
		
		$sql = "delete from  `".PRE."member_project`   where `memid` in (".$_POST['delaid'].")";		
		$db->query($sql) or die("SQL execution error!");
		
		$sql = "delete from  `".PRE."member_job`   where `memid` in (".$_POST['delaid'].")";		
		$db->query($sql) or die("SQL execution error!");	
		
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='list.php?$url';</SCRIPT>";
	}
	
	//更新会员是否关闭状态
	function memberupdateislock($id,$flag){
		global $db,$func,$log;

		$act=isset($_GET['act']) ? $_GET['act'] : '';
		$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$page=isset($_GET['page']) ? $_GET['page'] :1;
		$wkstatus=isset($_GET['wkstatus']) ? $_GET['wkstatus'] :'';
		$rflag=isset($_GET['rflag']) ? $_GET['rflag'] :1;
		$sdate=isset($_GET['sdate']) ? $_GET['sdate'] : '';
		$edate=isset($_GET['edate']) ? $_GET['edate'] : '';		
		$islock=isset($_GET['islock']) ? $_GET['islock'] : '';
		
		$url="page=".$page."&act=".$act."&keyword=".$keyword."&sdate=".$sdate."&edate=".$edate."&islock=".$islock."&wkstatus=".$wkstatus;
		
		$sql="update `".PRE."member` set `islock` =".$rflag."  WHERE `id` =".$id;	
		$db->query($sql) or die("SQL execution error!");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('操作成功！');window.location.href='list.php?$url';</SCRIPT>";
	}
	
	//取得会员账户名
	function getmembername($memid){
		global $db;
 
		$tsql="select username from ".PRE."member  where  id=".intval($memid);
		$rst=mysql_query($tsql) or die ("SQL execution error!");
		$okt=is_array($rowt=mysql_fetch_array($rst));
		return $rowt[0];
 
	}	
	
	//取得真实姓名
	function getmemrealname($memid){
		global $db;
 
		$tsql="select realname from ".PRE."member  where  id=".intval($memid);
		$rst=mysql_query($tsql) or die ("SQL execution error!");
		$okt=is_array($rowt=mysql_fetch_array($rst));
		return $rowt[0];
 
	}	

	/**************技工会员应聘管理**************************************/
	
	//后台：技工会员应聘列表
	function jobapplylist($tmpsql,$pagesize,$arrparam){
		global $db,$func,$type,$cidy,$content_del,$content_deal;
		$page2=isset($_GET['page']) ? $_GET['page'] :1;
		$flag=isset($_GET['flag']) ? $_GET['flag'] :1;
 
		$sql=$tmpsql;
		$arr=$func->get_page_num($sql,$pagesize);
		$sql.=" limit $arr[1], $pagesize";

		$rs=$db->query($sql);// or die("SQL execution error！")
		
		echo "<table width='100%' border='0' align='center' cellpadding='2' cellspacing='0' class='lrbtline'>";
		echo "		<tr>";
		if ($func->PermitAdmin($content_del)==true){//有删除权限
		echo "				<td width='6%' align='center' class='lrbtlineHead'><input name=\"chkall\" type=\"checkbox\" id=\"chkall\" onclick=\"javascript:CheckAll(this.form);\"  style=\"border:0px;\"  title='全选择或者全取消' > <input type=button onclick='javascript:del(this.form);' value='×' title='删除选择项' class=\"btn_del\"></td>";
		}
		echo "				<td width='100' align='center' class='lrbtlineHead'>应聘技工</td>";
		echo "				<td   align='left' class='lrbtlineHead'>应聘职位</td>";
		echo "				<td  width='100' align='center' class='lrbtlineHead'>应聘时间</td>";
		echo "				<td  width='150' align='center' class='lrbtlineHead'>招聘单位</td>";
		echo "				<td  width='100' align='center' class='lrbtlineHead'>应聘状态</td>";	
		if ($func->PermitAdmin($content_deal)==true){			
		echo "				<td  width='60' align='center' class='lrbtlineHead'>操作</td>";
		}
		echo "		</tr>";
		
		while($row = $db->fetch_array($rs)){
				$targeturl="";
 				$status="";
				if ($row["applystatus"]==0){
					$status="<font color=blue>待处理</font>";
				}elseif($row["applystatus"]==1){
					$status="<font color=green>应聘成功</font>";
				}elseif($row["applystatus"]==-1){
					$status="<font color=red>应聘失败</font>";
				}
				echo "		<tr  class='outrow' onMouseOver=\"this.className='onrow';\" onMouseOut=\"this.className='outrow';\">";
				if ($func->PermitAdmin($content_del)==true){//有删除权限
				echo "				<td align='center'><input name='id' id='id'  type='checkbox' value='$row[id]' style='border:0px;'></td>";
				}
				echo "				<td align='center'><a href=\"../member/resumeview.php?id=".$row['memid']."\">".$row['xingming']."</td>";
				echo "				<td align='left'><a href=\"/plus/jobview.php?id=".$row['id']."\" target=_blank>".$row['jobname']."</a></td>";					
				echo "				<td align='center'>".$func->format_datetime($row['applytime'])."</td>";
				echo "				<td align='center'>".$this->getcompanyname($row['companyid'])."</td>";
				echo "				<td align='center'>".$status."</td>";	
				if ($func->PermitAdmin($content_deal)==true){
				echo "			<td align='center' style=\"padding-right:10px;\"><a href=\"edit.php?page=".$page2."&action=modify&id=".$row['id']."&".$arrparam."\">【处理】</a></td>";
				}
				echo "</tr>";
		}
		echo "</table>";
		
		new cmspage($arr[0],$pagesize,$arrparam);
	}

	//后台：处理技工的应聘状态
	function jobapplysetstatus($id,$flag){
		global $db,$func,$log;

		$act=isset($_GET['act']) ? $_GET['act'] : '';
		$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$page=isset($_GET['page']) ? $_GET['page'] :1;
		$applystatus=isset($_POST['applystatus']) ? $_POST['applystatus'] :0;
		$rflag=isset($_GET['rflag']) ? $_GET['rflag'] :1;
		$sdate=isset($_GET['sdate']) ? $_GET['sdate'] : '';
		$edate=isset($_GET['edate']) ? $_GET['edate'] : '';		
		$islock=isset($_GET['islock']) ? $_GET['islock'] : '';
			
		$url="page=".$page."&act=".$act."&keyword=".$keyword."&sdate=".$sdate."&edate=".$edate."&islock=".$islock."&applystatus=".$applystatusnew;
		$sql="update `".PRE."member_jobapply` set `applystatus` ='".$applystatus."'  WHERE `id` =".$id;	
		
		$db->query($sql) or die("SQL execution error!");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('操作成功！');window.location.href='list.php?$url';</SCRIPT>";
	}
	//多记录删除
	function jobapplydelall() {
		global $db;
		$act=isset($_GET['act']) ? $_GET['act'] : '';
		$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$page=isset($_GET['page']) ? $_GET['page'] :1;
		$applystatus=isset($_POST['applystatus']) ? $_POST['applystatus'] :0;
		$rflag=isset($_GET['rflag']) ? $_GET['rflag'] :1;
		$sdate=isset($_GET['sdate']) ? $_GET['sdate'] : '';
		$edate=isset($_GET['edate']) ? $_GET['edate'] : '';		
		$islock=isset($_GET['islock']) ? $_GET['islock'] : '';
			
		$url="page=".$page."&act=".$act."&keyword=".$keyword."&sdate=".$sdate."&edate=".$edate."&islock=".$islock."&applystatus=".$applystatusnew;
		$sql = "delete from  `".PRE."member_jobapply`   where `id` in (".$_POST['delaid'].")";	
		$db->query($sql) or die("SQL execution error!");

		
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='list.php?$url';</SCRIPT>";
	}
	
	/**************企业会员管理中心**************************************/
	
	//后台：企业会员列表
	function memberlist_company($tmpsql,$pagesize,$arrparam){
		global $db,$func,$type,$cidy,$content_update,$content_del;
		$page2=isset($_GET['page']) ? $_GET['page'] :1;
		$flag=isset($_GET['flag']) ? $_GET['flag'] :1;
 
		$sql=$tmpsql;
		$arr=$func->get_page_num($sql,$pagesize);
		$sql.=" limit $arr[1], $pagesize";

		$rs=$db->query($sql);// or die("SQL execution error！")
		
		echo "<table width='100%' border='0' align='center' cellpadding='2' cellspacing='0' class='lrbtline'>";
		echo "		<tr>";
		if ($func->PermitAdmin($content_del)==true){//有删除权限
		echo "				<td width='6%' align='center' class='lrbtlineHead'><input name=\"chkall\" type=\"checkbox\" id=\"chkall\" onclick=\"javascript:CheckAll(this.form);\"  style=\"border:0px;\"  title='全选择或者全取消' > <input type=button onclick='javascript:del(this.form);' value='×' title='删除选择项'  class=\"btn_del\"></td>";
		}
		echo "				<td width='100'   align='left' class='lrbtlineHead'>登录账户</td>";
		echo "				<td align='center'  align='center' class='lrbtlineHead'>企业名称</td>";
		echo "				<td  width='100' align='center' class='lrbtlineHead'>企业类型</td>";
		echo "				<td  width='100' align='center' class='lrbtlineHead'>所在地</td>";
		echo "				<td width='80' class='lrbtlineHead'>成立时间</td>";			
		echo "				<td  width='60' align='center' class='lrbtlineHead'>员工人数</td>";	
		echo "				<td  width='70' align='center' class='lrbtlineHead'>锁定状态</td>";	
		echo "				<td  width='70' align='center' class='lrbtlineHead'>是否推荐</td>";
		echo "				<td  width='70' align='center' class='lrbtlineHead'>认证状态</td>";
		echo "				<td  width='100'  align='center' class='lrbtlineHead'>注册日期</td>";
 
		echo "				<td  width='80' align='center' class='lrbtlineHead'>操作</td>";
 
		echo "		</tr>";
		
		while($row = $db->fetch_array($rs)){
 
				$tmp_enable="";
 				if ($row['islock']==0){
					$tmp_enable="<a href='editdo.php?page=".$page2."&action=islock&rflag=1&id=".$row['id']."&".$arrparam."' title=\"锁定账户\">锁定</a>|";
				}else{
					$tmp_enable="<a href='editdo.php?page=".$page2."&action=islock&rflag=0&id=".$row['id']."&".$arrparam."' title=\"启用账户\">启用</a>|";
				}	
				$tmp_ischeck="";
 				if ($row['ischeck']==0){
					$tmp_ischeck="<font color=gray>未认证</font>";
				}elseif ($row['ischeck']==1){
					$tmp_ischeck="<font color=green>已认证</font>";
				}	
				
				$tmp_tj="";
 				if ($row['istj']==0){
					$tmp_tj="<font color=gray>否</font>";
				}elseif ($row['istj']==1){
					$tmp_tj="<font color=red>是</font>";
				}	
				$targeturl="";
				$islock=($row["islock"]==0)?"<font color=green>启用</font>":"<font color=red>关闭</font>";
				echo "		<tr  class='outrow' onMouseOver=\"this.className='onrow';\" onMouseOut=\"this.className='outrow';\">";
				if ($func->PermitAdmin($content_del)==true){//有删除权限
				echo "				<td align='center'><input name='id' id='id'  type='checkbox' value='$row[id]' style='border:0px;'></td>";
				}
				echo "				<td align='left'>&nbsp;".$row['username']."</td>";
				echo "				<td align='left'>&nbsp;".$row['companyname']."</td>";
				echo "				<td align='center'>".$row['companytype']."</td>";	
				echo "				<td align='center'>".$row['place']."</td>";				
				echo "				<td align='center'>".$row['setupdate']."</td>";	
				echo "				<td align='center'>".$row['employeenum']."</td>";
				echo "				<td align='center'>".$islock."</td>";	
				echo "				<td align='center'>".$tmp_tj."</td>";
				echo "				<td align='center'>".$tmp_ischeck."</td>";
				echo "				<td align='center'>".$func->format_datetime($row['addtime'])."</td>";
				if ($func->PermitAdmin($content_update)==true){//有删除权限
				echo "			<td align='center' style=\"padding-right:10px;\">".$tmp_enable."<a href=\"edit.php?page=".$page2."&action=modify&id=".$row['id']."&".$arrparam."\">修改</a></td>";
				}else{
				echo "			<td align='center' style=\"padding-right:10px;\"><a href='editdo.php?page=".$page2."&action=islock&rflag=1&id=".$row['id']."&".$arrparam."' title=\"锁定账户\">锁定</a></td>";
				}

				echo "</tr>";
		}
		echo "</table>";
		
		new cmspage($arr[0],$pagesize,$arrparam);
	}

 	//后台：注册企业会员
	function memberadd_company() {
		global $db,$func;

		$gradeid      =2;				
		$username     =($_POST['username']);	
		$password     =md5($_POST['password']);
		
		$companylogo   =$_POST['companylogo']; 	
		$companyname  =$_POST['companyname'];		
		$companytype  =$_POST['companytype'];		
		$setupdate    =$_POST['setupdate'];
 		$employeenum  =$_POST['employeenum'];
		$place=$_POST['province']."-".$_POST['city']; 	
		$teleno       =$_POST['teleno']; 	
		$fax          =$_POST['fax'];		
		$address      =$_POST['address'];		
		$postcode     =$_POST['postcode'];
 		$http         =$_POST['http'];
		$email        =$_POST['email']; 	 
 		$profile      =$_POST['content'];
		$istj         =isset($_POST['istj'])?$_POST['istj']:0;
		$ischeck         =isset($_POST['ischeck'])?$_POST['ischeck']:0;					
		$addtime      =date('Y-m-d H:i:s'); 
 		$gxtime       =$addtime;
		$updatetime   =$addtime;
		$isdel        =0;
 
		//保存基本账户
		$column="";
		$column.="gradeid";
		$column.=",username";
		$column.=",password";
		$column.=",islock";
		$column.=",ischeck";
		$column.=",addtime";
		$column.=",updatetime";
		$column.=",isdel";
		$column.=",istj";	
			
		$columnvalue="";
		$columnvalue.="'".$gradeid."'";
		$columnvalue.=",'".$username."'";
		$columnvalue.=",'".$password."'";
		$columnvalue.=",'".$islock."'";
		$columnvalue.=",'".$ischeck."'";
		$columnvalue.=",'".$addtime."'";
		$columnvalue.=",'".$updatetime."'";
		$columnvalue.=",'".$isdel."'";		
		$columnvalue.=",'".$istj."'";	
		//检测账户是否重名
		$this->checkmember($username,$gradeid);
		
		//检测企业名称是否重复
		$this->checkmembercompanyname($companyname);
		
		//写入账户信息
		$sql="insert into ".PRE."member(".$column.") values (".$columnvalue.")";
		$db->query($sql) or die("SQL execution error!-401");
		//取得最新的会员id
		$memid = mysql_insert_id();

		//保存企业信息
		$column="";
		$column.="memid";
		$column.=",companylogo";
		$column.=",yyzz";		
		$column.=",companyname";
		$column.=",companytype";
		$column.=",setupdate";
		$column.=",employeenum";
		$column.=",place";
		$column.=",teleno";
		
		$column.=",fax";
		$column.=",address";
		$column.=",postcode";
		$column.=",http";
		$column.=",email";
		$column.=",profile";
		$column.=",gxtime";
					
		$columnvalue="";
		$columnvalue.="'".$memid."'";
		$columnvalue.=",'".$companylogo."'";
		$columnvalue.=",'".$yyzz."'";		
		$columnvalue.=",'".$companyname."'";
		$columnvalue.=",'".$companytype."'";
		$columnvalue.=",'".$setupdate."'";
		$columnvalue.=",'".$employeenum."'";
		$columnvalue.=",'".$place."'";
		$columnvalue.=",'".$teleno."'";	
		$columnvalue.=",'".$fax."'";
		$columnvalue.=",'".$address."'";
		$columnvalue.=",'".$postcode."'";
		$columnvalue.=",'".$http."'";
		$columnvalue.=",'".$email."'";
		$columnvalue.=",'".$profile."'";
		$columnvalue.=",'".$gxtime."'";		
					
		//写入企业信息表
		$sql="insert into ".PRE."member_company(".$column.") values (".$columnvalue.")";
		$db->query($sql) or die("SQL execution error!-402");
		
		echo "<script type='text/javascript'> if(confirm('是否要继续添加账户?')){ window.location.href='edit.php?action=add&usertype=".$usertype."';}else{ window.location.href='list.php?usertype=".$usertype."';	}</script>";
	}
 
	//修改企业会员
	function memberupdate_company() {
		global $db,$func,$log;
		$companylogo  =$_POST['companylogo']; 	
		$yyzz         =$_POST['yyzz']; 		
		$companyname  =$_POST['companyname'];	
		$password     =trim($_POST['password']);	
		$companytype  =$_POST['companytype'];		
		$setupdate    =$_POST['setupdate'];
 		$employeenum  =$_POST['employeenum'];
		$place=$_POST['province']."-".$_POST['city']; 	
		$teleno       =$_POST['teleno']; 	
		$fax          =$_POST['fax'];		
		$address      =$_POST['address'];		
		$postcode     =$_POST['postcode'];
 		$http         =$_POST['http'];
		$email        =$_POST['email']; 	 
 		$profile      =$_POST['content'];
		$gxtime       =date('Y-m-d H:i:s');
		$istj         =isset($_POST['istj'])?$_POST['istj']:0;
		$ischeck      =isset($_POST['ischeck'])?$_POST['ischeck']:0;
		
		//搜索条件参数
		$act          =isset($_POST['act']) ? $_POST['act'] : '';
		$keyword      =isset($_POST['keyword']) ? $_POST['keyword'] : '';
		$page         =isset($_POST['page']) ? $_POST['page'] :1;
		$sdate        =isset($_POST['sdate']) ? $_POST['sdate'] : '';
		$edate        =isset($_POST['edate']) ? $_POST['edate'] : '';
		$islocknew    =isset($_POST['islocknew']) ? $_POST['islocknew'] : '';
		$url          ="page=".$page."&act=".$act."&keyword=".$keyword."&sdate=".$sdate."&edate=".$edate."&islock=".$islocknew;

		//取得最新的会员id
		$memid = $_GET['id'];
		//修改密码
		$str="";
		if ($password!=""){
			$sql2="update ".PRE."member set `password` = '".md5($password)."' where id=".$memid."";
			$db->query($sql2) or die("SQL execution error!-modify password");
		}
		if ($istj!=""){
			$sql2="update ".PRE."member set `istj` = '".$istj."' where id=".$memid."";
			$db->query($sql2) or die("SQL execution error!-modify istj");
		}
		if ($ischeck!=""){
			$sql2="update ".PRE."member set `ischeck` = '".$ischeck."' where id=".$memid."";
			$db->query($sql2) or die("SQL execution error!-modify ischeck");
		}			
		//保存账户扩展信息

		$columnvalue="";
		$columnvalue.="companylogo='".$companylogo."'";
		$columnvalue.=",yyzz='".$yyzz."'";		
		$columnvalue.=",companyname='".$companyname."'";
		$columnvalue.=",companytype='".$companytype."'";
		$columnvalue.=",setupdate='".$setupdate."'";
		$columnvalue.=",employeenum='".$employeenum."'";
		$columnvalue.=",place='".$place."'";
		$columnvalue.=",teleno='".$teleno."'";
		$columnvalue.=",fax='".$fax."'";
		$columnvalue.=",address='".$address."'";
		$columnvalue.=",postcode='".$postcode."'";
		$columnvalue.=",http='".$http."'";
		$columnvalue.=",email='".$email."'";
		$columnvalue.=",profile='".$profile."'";	
		$columnvalue.=",gxtime='".$gxtime."'";	
			
		$sql="update ".PRE."member_company set ".$columnvalue." where memid=".$memid."";

		$db->query($sql) or die("SQL execution error!-modify memberinfo");

		echo "<SCRIPT LANGUAGE='JavaScript'>alert('修改成功！');window.location.href='list.php?$url';</SCRIPT>";
	}
 
	//删除企业会员
	function memberdel_company() {
		global $db;
 
		$act=isset($_GET['act']) ? $_GET['act'] : '';
		$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$page=isset($_GET['page']) ? $_GET['page'] : '';
		$sdate=isset($_GET['sdate']) ? $_GET['sdate'] : '';
		$edate=isset($_GET['edate']) ? $_GET['edate'] : '';
		$islock=isset($_GET['islock']) ? $_GET['islock'] : '';

		$url="page=$page&act=$act&keyword=$keyword&sdate=$sdate&edate=$edate&islock=$islock";
		
		$sql = "delete from `".PRE."member` where `id` in (".$_GET['id'].")";
		$db->query($sql) or die("SQL execution error!");
		$sql = "delete from `".PRE."member_company` where `memid` in (".$_GET['id'].")";
		$db->query($sql) or die("SQL execution error!");
		
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='list.php?$url';</SCRIPT>";
	}
 	
	//多记录删除企业会员
	function memberdelall_company() {
		global $db;
		$act=isset($_GET['act']) ? $_GET['act'] : '';
		$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$page=isset($_GET['page']) ? $_GET['page'] : '';
		$sdate=isset($_GET['sdate']) ? $_GET['sdate'] : '';
		$edate=isset($_GET['edate']) ? $_GET['edate'] : '';
		$islock=isset($_GET['islock']) ? $_GET['islock'] : '';

		$url="page=$page&act=$act&keyword=$keyword&sdate=$sdate&edate=$edate&islock=$islock";
		$sql = "delete from  `".PRE."member`   where `id` in (".$_POST['delaid'].")";		
		$db->query($sql) or die("SQL execution error!");
		$sql = "delete from  `".PRE."member_company`   where `memid` in (".$_POST['delaid'].")";		
		$db->query($sql) or die("SQL execution error!");
		
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='list.php?$url';</SCRIPT>";
	}
	
	//取得企业公司名称
	function getcompanyname($memid){
		global $db;
		$tsql="select companyname from ".PRE."member_company where  memid=".intval($memid);
		$rst=mysql_query($tsql) or die ("SQL execution error!");
		$okt=is_array($rowt=mysql_fetch_array($rst));
		return $rowt[0];
 
	}	

	/**************项目管理中心****************************************/
	
	//后台：企业项目列表
	function xmlist($tmpsql,$pagesize,$arrparam){
		global $db,$func,$type,$cidy,$content_update,$content_del,$content_job_pub;
		$page2=isset($_GET['page']) ? $_GET['page'] :1;
		$flag=isset($_GET['flag']) ? $_GET['flag'] :1;
 
		$sql=$tmpsql;
		$arr=$func->get_page_num($sql,$pagesize);
		$sql.=" limit $arr[1], $pagesize";

		$rs=$db->query($sql);// or die("SQL execution error！")
		
		echo "<table width='100%' border='0' align='center' cellpadding='2' cellspacing='0' class='lrbtline'>";
		echo "		<tr>";
		if ($func->PermitAdmin($content_del)==true){//有删除权限
		echo "				<td width='6%' align='center' class='lrbtlineHead'><input name=\"chkall\" type=\"checkbox\" id=\"chkall\" onclick=\"javascript:CheckAll(this.form);\"  style=\"border:0px;\"  title='全选择或者全取消' > <input type=button onclick='javascript:del(this.form);' value='×' title='删除选择项'  class=\"btn_del\"></td>";
		}
		echo "				<td width='170' align='center' class='lrbtlineHead'>项目名称</td>";
		echo "				<td  width='140' align='center' class='lrbtlineHead'>所属企业</td>";
		echo "				<td  width='150' align='center' class='lrbtlineHead'>主要项目</td>";
		echo "				<td  align='center' class='lrbtlineHead'>项目地址</td>";	
		echo "				<td  width='90'  align='center' class='lrbtlineHead'>更新日期</td>";		
		echo "				<td  width='90'  align='center' class='lrbtlineHead'>发布日期</td>";
		if ($func->PermitAdmin($content_job_pub)==true || $func->PermitAdmin($content_job_pub)==true){
		echo "				<td  width='110' align='center' class='lrbtlineHead'>操作</td>";
		}
		echo "		</tr>";
		
		while($row = $db->fetch_array($rs)){
				$targeturl="";
				$st="";
				if ($row["istj"]==1){
					$st.="<img src=\"../images/tj.gif\"> ";
				}
				echo "		<tr  class='outrow' onMouseOver=\"this.className='onrow';\" onMouseOut=\"this.className='outrow';\">";
				if ($func->PermitAdmin($content_del)==true){//有删除权限
				echo "				<td align='center'><input name='id' id='id'  type='checkbox' value='$row[id]' style='border:0px;'></td>";
				}
				echo "				<td align='left'>&nbsp;".$row['projectname']." ".$st."</td>";
				echo "				<td align='center'>".$row['companyname']."</td>";
				echo "				<td align='center'>".$row['major']."</td>";					
				echo "				<td align='left'>".$row['address']."</td>";	
				echo "				<td align='center'>".$func->format_datetime($row['gxtime'])."</td>";
				echo "				<td align='center'>".$func->format_datetime($row['addtime'])."</td>";
				if ($func->PermitAdmin($content_job_pub)==true || $func->PermitAdmin($content_job_pub)==true){
				echo "			<td align='center' style=\"padding-right:10px;\">";
				}
				if ($func->PermitAdmin($content_job_pub)==true){//有发布招聘权限
				echo "<a href=\"../job/edit.php?action=add&xmid=".$row['id']."&companyid=".$row['memid']."\">发布招聘</a> |"; 				}
				if ($func->PermitAdmin($content_update)==true){//有删除权限
				echo "<a href=\"edit.php?page=".$page2."&action=modify&id=".$row['id']."&".$arrparam."\">修改</a>";
				}
				if ($func->PermitAdmin($content_job_pub)==true || $func->PermitAdmin($content_job_pub)==true){
				echo "</td>";
				}
				

				echo "</tr>";
		}
		echo "</table>";
		
		new cmspage($arr[0],$pagesize,$arrparam);
	}

 	//后台：添加项目
	function xmadd() {
		global $db,$func,$session_uid;
		$companyid=isset($_POST['companyid'])?$_POST['companyid']:0;	
		$memid=isset($_POST['memid'])?$_POST['memid']:0;				
		$projectname=($_POST['projectname']);	
		$pic=($_POST['pic']);	
		$major=$_POST['major']; 	
		$introduction=$_POST['content'];
		$xmplace=$_POST['xmplace'];			
		$address=$_POST['address'];		
		$map=$_POST['map'];
		$addtime=date('Y-m-d H:i:s'); 
 		$gxtime=$addtime;
		$istj=isset($_POST['istj']) ? $_POST['istj'] :0;	
		
		//保存项目信息
		$column="";
		$column.="memid";
		$column.=",projectname";
		$column.=",pic";		
		$column.=",major";
		$column.=",introduction";
		$column.=",xmplace";		
		$column.=",address";
		$column.=",map";
		$column.=",gxtime";
		$column.=",addtime";
		$column.=",istj";		
		
		$columnvalue="";
		$columnvalue.="'".$companyid."'";
		$columnvalue.=",'".$projectname."'";
		$columnvalue.=",'".$pic."'";		
		$columnvalue.=",'".$major."'";
		$columnvalue.=",'".$introduction."'";
		$columnvalue.=",'".$xmplace."'";		
		$columnvalue.=",'".$address."'";
		$columnvalue.=",'".$map."'";
		$columnvalue.=",'".$gxtime."'";
		$columnvalue.=",'".$addtime."'";		
		$columnvalue.=",'".$istj."'";
		
		$sql="insert into ".PRE."member_project(".$column.") values (".$columnvalue.")";
		$db->query($sql) or die("SQL execution error!-401");
		
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('添加成功！');window.location.href='list.php?$url';</SCRIPT>";
		exit;
 
	}
 
	//修改项目
	function xmupdate() {
		global $db,$func,$log;
		$companyid=isset($_POST['companyid'])?$_POST['companyid']:0;	
		$projectname=($_POST['projectname']);	
		$major=$_POST['major']; 	
		$introduction=$_POST['content'];
		$xmplace=$_POST['xmplace'];			
		$address=$_POST['address'];		
		$map=$_POST['map'];
		$pic=$_POST['pic'];	
		$addtime=date('Y-m-d H:i:s'); 
 		$gxtime=$addtime;
		$istj=isset($_POST['istj']) ? $_POST['istj'] :0;	
		
		$act=isset($_POST['act']) ? $_POST['act'] : '';
		$keyword=isset($_POST['keyword']) ? $_POST['keyword'] : '';
		$page=isset($_POST['page']) ? $_POST['page'] :1;
		$sdate=isset($_POST['sdate']) ? $_POST['sdate'] : '';
		$edate=isset($_POST['edate']) ? $_POST['edate'] : '';	
			
		$url="page=".$page."&act=".$act."&keyword=".$keyword."&sdate=".$sdate."&edate=".$edate;

		//取得项目信息ID
		$projectid = $_GET['id'];
 
		//保存项目信息
		$columnvalue="";
		$columnvalue.="memid='".$companyid."'";
		$columnvalue.=",projectname='".$projectname."'";
		$columnvalue.=",major='".$major."'";
		$columnvalue.=",introduction='".$introduction."'";
		$columnvalue.=",xmplace='".$xmplace."'";		
		$columnvalue.=",address='".$address."'";
		$columnvalue.=",map='".$map."'";
		$columnvalue.=",pic='".$pic."'";		
		$columnvalue.=",gxtime='".$gxtime."'";
		$columnvalue.=",istj='".$istj."'";
		
		$sql="update ".PRE."member_project set ".$columnvalue." where id=".$projectid."";
		$db->query($sql) or die("SQL execution error!-modify member_project");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('修改成功！');window.location.href='list.php?$url';</SCRIPT>";
	}
 
	//删除项目
	function xmdel() {
		global $db;
 
		$act=isset($_GET['act']) ? $_GET['act'] : '';
		$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$page=isset($_GET['page']) ? $_GET['page'] : '';
		$sdate=isset($_GET['sdate']) ? $_GET['sdate'] : '';
		$edate=isset($_GET['edate']) ? $_GET['edate'] : '';
		$url="page=$page&act=$act&keyword=$keyword&sdate=$sdate&edate=$edate";
		
		$sql = "delete from `".PRE."member_project` where `id` in (".$_GET['id'].")";
		$db->query($sql) or die("SQL execution error!");

		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='list.php?$url';</SCRIPT>";
	}
 	
	//多记录删除项目
	function xmdelall() {
		global $db;
		$act=isset($_GET['act']) ? $_GET['act'] : '';
		$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$page=isset($_GET['page']) ? $_GET['page'] : '';
		$sdate=isset($_GET['sdate']) ? $_GET['sdate'] : '';
		$edate=isset($_GET['edate']) ? $_GET['edate'] : '';

		$url="page=$page&act=$act&keyword=$keyword&sdate=$sdate&edate=$edate";
		$sql = "delete from  `".PRE."member_project`   where `id` in (".$_POST['delaid'].")";		
		$db->query($sql) or die("SQL execution error!");
		
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='list.php?$url';</SCRIPT>";
	}
	
	//确定项目名称
	function getxmname($xmid){
		global $db;
		$tsql="select projectname from ".PRE."member_project where  id=".intval($xmid);
		$rst=mysql_query($tsql) or die ("SQL execution error!");
		$okt=is_array($rowt=mysql_fetch_array($rst));
		return $rowt[0];
	}	
	
	/**************招聘管理中心****************************************/
	
	//后台：招聘招聘列表
	function joblist($tmpsql,$pagesize,$arrparam){
		global $db,$func,$type,$cidy,$content_update,$content_del;
		$page2=isset($_GET['page']) ? $_GET['page'] :1;
		$flag=isset($_GET['flag']) ? $_GET['flag'] :1;
 
		$sql=$tmpsql;
		$arr=$func->get_page_num($sql,$pagesize);
		$sql.=" limit $arr[1], $pagesize";

		$rs=$db->query($sql);// or die("SQL execution error！")
		
		echo "<table width='100%' border='0' align='center' cellpadding='2' cellspacing='0' class='lrbtline'>";
		echo "		<tr>";
		if ($func->PermitAdmin($content_del)==true){//有删除权限
		echo "				<td width='6%' align='center' class='lrbtlineHead'><input name=\"chkall\" type=\"checkbox\" id=\"chkall\" onclick=\"javascript:CheckAll(this.form);\"  style=\"border:0px;\"  title='全选择或者全取消' > <input type=button onclick='javascript:del(this.form);' value='×' title='删除选择项'  class=\"btn_del\"></td>";
		}
		echo "				<td  align='center' class='lrbtlineHead'>招聘职位</td>";
		echo "				<td  width='140' align='center' class='lrbtlineHead'>所属项目</td>";
		echo "				<td  width='140' align='center' class='lrbtlineHead'>所属企业</td>";
		echo "				<td  width='70' align='center' class='lrbtlineHead'>工作地点</td>";
		echo "				<td  width='70'align='center'  class='lrbtlineHead'>学历要求</td>";	
		echo "				<td  width='70'  align='center' class='lrbtlineHead'>招聘人数</td>";	
		echo "				<td  width='90'  align='center' class='lrbtlineHead'>待遇水平</td>";	
		echo "				<td  width='70'  align='center' class='lrbtlineHead'>截止日期</td>";	
		echo "				<td  width='70'  align='center' class='lrbtlineHead'>发布日期</td>";
		if ($func->PermitAdmin($content_update)==true){//有修改权限
		echo "				<td  width='70' align='center' class='lrbtlineHead'>操作</td>";
		}
		echo "		</tr>";
		
		while($row = $db->fetch_array($rs)){
 
				$targeturl="";
				$st="";
				if ($row["ishot"]==1){
					$st.="<img src=\"../images/hot2.gif\"> ";
				}
				if ($row["istj"]==1){
					$st.="<img src=\"../images/tj.gif\"> ";
				}
				
				
				echo "		<tr  class='outrow' onMouseOver=\"this.className='onrow';\" onMouseOut=\"this.className='outrow';\">";
				if ($func->PermitAdmin($content_del)==true){//有删除权限
				echo "				<td align='center'><input name='id' id='id'  type='checkbox' value='$row[id]' style='border:0px;'></td>";
				}
				echo "				<td align='left'>&nbsp;".$row['jobname']." ".$st."</td>";
				echo "				<td align='center'>".$row['projectname']."</td>";
				echo "				<td align='center'>".$row['companyname']."</td>";					
				echo "				<td align='center'>".$row['place']."</td>";	
				echo "				<td align='center'>".$row['xlyq']."</td>";
				echo "				<td align='center'>".$row['jobnum']."</td>";
				echo "				<td align='center'>".$row['salary_s']."-".$row['salary_e']."元/月</td>";
				echo "				<td align='center'>".$func->format_datetime($row['endtime'])."</td>";
				echo "				<td align='center'>".$func->format_datetime($row['addtime'])."</td>";
				if ($func->PermitAdmin($content_update)==true){//有修改权限
				echo "			<td align='center' style=\"padding-right:10px;\"><a href=\"edit.php?page=".$page2."&action=modify&id=".$row['id']."&".$arrparam."\">修改</a></td>";
				}

				echo "</tr>";
		}
		echo "</table>";
		
		new cmspage($arr[0],$pagesize,$arrparam);
	}

 	//后台：添加招聘
	function jobadd() {
		global $db,$func,$session_uid;
		$memid=isset($_POST['memid'])?$_POST['memid']:0;	
		$xmid=isset($_POST['xmid'])?$_POST['xmid']:0;				
		$jobname=($_POST['jobname']);	
		$zgtype=$_POST['zgtype'];
		$xlyq=$_POST['xlyq']; 	
		$xbyq=$_POST['xbyq'];
		$nlyq=$_POST['nlyq'];		
		$gznxyq=$_POST['gznxyq'];		
		$place=$_POST['province']."-".$_POST['city'];
		$jobnum=($_POST['jobnum']);	
		$salary_s=$_POST['salary_s']; 	
		$salary_e=$_POST['salary_e'];		
		$jobcontent=$_POST['content'];		
 		$endtime=$_POST['endtime'];
		$addtime=date('Y-m-d H:i:s'); 
 		$gxtime=$addtime;
		$ishot=isset($_POST['ishot']) ? $_POST['ishot'] :0;
		$istj=isset($_POST['istj']) ? $_POST['istj'] :0;	
		$islock=isset($_POST['islock']) ? $_POST['islock'] :0;			
		//保存项目信息
		$column="";
		$column.="memid";
		$column.=",xmid";
		$column.=",jobname";
		$column.=",zgtype";		
		$column.=",xlyq";
		$column.=",xbyq";
		$column.=",nlyq";		
		$column.=",gznxyq";
		$column.=",place";
		$column.=",jobnum";
		$column.=",salary_s";
		$column.=",salary_e";		
		$column.=",jobcontent";
		if ($endtime!=""){
		$column.=",endtime";	
		}		
		$column.=",gxtime";
		$column.=",addtime";
		$column.=",ishot";
		$column.=",istj";
		$column.=",islock";			
		$columnvalue="";
		$columnvalue.="'".$memid."'";
		$columnvalue.=",'".$xmid."'";
		$columnvalue.=",'".$jobname."'";
		$columnvalue.=",'".$zgtype."'";		
		$columnvalue.=",'".$xlyq."'";
		$columnvalue.=",'".$xbyq."'";
		$columnvalue.=",'".$nlyq."'";		
		$columnvalue.=",'".$gznxyq."'";
		$columnvalue.=",'".$place."'";
		$columnvalue.=",'".$jobnum."'";	
		
		$columnvalue.=",'".$salary_s."'";
		$columnvalue.=",'".$salary_e."'";
		$columnvalue.=",'".$jobcontent."'";
		$columnvalue.=",'".$endtime."'";
		if ($endtime!=""){
		$columnvalue.=",'".$gxtime."'";
		}
		$columnvalue.=",'".$addtime."'";			
		$columnvalue.=",'".$ishot."'";
		$columnvalue.=",'".$istj."'";	
		$columnvalue.=",'".$islock."'";			
		$sql="insert into ".PRE."member_job(".$column.") values (".$columnvalue.")";
		$db->query($sql) or die("SQL execution error!-401");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='list.php';</SCRIPT>";
	    exit;
	}
 
	//修改招聘
	function jobupdate() {
		global $db,$func,$log;
		$memid=isset($_POST['memid'])?$_POST['memid']:0;	
		$xmid=isset($_POST['xmid'])?$_POST['xmid']:0;				
		$jobname=($_POST['jobname']);
		$zgtype=$_POST['zgtype']; 	
		$xlyq=$_POST['xlyq']; 	
		$xbyq=$_POST['xbyq'];
		$nlyq=$_POST['nlyq'];		
		$gznxyq=$_POST['gznxyq'];		
		$place=$_POST['province']."-".$_POST['city'];
		$jobnum=($_POST['jobnum']);	
		$salary_s=$_POST['salary_s']; 	
		$salary_e=$_POST['salary_e'];		
		$jobcontent=$_POST['content'];		
 		$endtime=$_POST['endtime'];
		$addtime=date('Y-m-d H:i:s'); 
 		$gxtime=$addtime;
		
		$act=isset($_POST['act']) ? $_POST['act'] : '';
		$keyword=isset($_POST['keyword']) ? $_POST['keyword'] : '';
		$page=isset($_POST['page']) ? $_POST['page'] :1;
		$sdate=isset($_POST['sdate']) ? $_POST['sdate'] : '';
		$edate=isset($_POST['edate']) ? $_POST['edate'] : '';	
		$ishot=isset($_POST['ishot']) ? $_POST['ishot'] :0;
		$istj=isset($_POST['istj']) ? $_POST['istj'] :0;	
		$islock=isset($_POST['islock']) ? $_POST['islock'] :0;					
		$url="page=".$page."&act=".$act."&keyword=".$keyword."&sdate=".$sdate."&edate=".$edate;

		//取得项目信息ID
		$jobid = $_GET['id'];
 
		//保存项目信息
		$columnvalue="";
		$columnvalue.="memid='".$memid."'";
		$columnvalue.=",xmid='".$xmid."'";
		$columnvalue.=",jobname='".$jobname."'";
		$columnvalue.=",zgtype='".$zgtype."'";
		$columnvalue.=",xlyq='".$xlyq."'";
		$columnvalue.=",xbyq='".$xbyq."'";
		$columnvalue.=",nlyq='".$nlyq."'";		
		$columnvalue.=",gznxyq='".$gznxyq."'";
		$columnvalue.=",place='".$place."'";
		$columnvalue.=",jobnum='".$jobnum."'";
		$columnvalue.=",salary_s='".$salary_s."'";
		$columnvalue.=",salary_e='".$salary_e."'";
		$columnvalue.=",jobcontent='".$jobcontent."'";
		$columnvalue.=",endtime='".$endtime."'";
		$columnvalue.=",gxtime='".$gxtime."'";	
		$columnvalue.=",ishot='".$ishot."'";
		$columnvalue.=",istj='".$istj."'";			
		$columnvalue.=",islock='".$islock."'";	 
		$sql="update ".PRE."member_job set ".$columnvalue." where id=".$jobid."";

		$db->query($sql) or die("SQL execution error!-modify member_project");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('修改成功！');window.location.href='list.php?$url';</SCRIPT>";
	}
 
	//删除招聘
	function jobdel() {
		global $db;
 
		$act=isset($_GET['act']) ? $_GET['act'] : '';
		$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$page=isset($_GET['page']) ? $_GET['page'] : '';
		$sdate=isset($_GET['sdate']) ? $_GET['sdate'] : '';
		$edate=isset($_GET['edate']) ? $_GET['edate'] : '';
		$url="page=$page&act=$act&keyword=$keyword&sdate=$sdate&edate=$edate";
		
		$sql = "delete from `".PRE."member_job` where `id` in (".$_GET['id'].")";
		$db->query($sql) or die("SQL execution error!");

		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='list.php?$url';</SCRIPT>";
	}
 	
	//多记录删除招聘
	function jobdelall() {
		global $db;
		$act=isset($_GET['act']) ? $_GET['act'] : '';
		$keyword=isset($_GET['keyword']) ? $_GET['keyword'] : '';
		$page=isset($_GET['page']) ? $_GET['page'] : '';
		$sdate=isset($_GET['sdate']) ? $_GET['sdate'] : '';
		$edate=isset($_GET['edate']) ? $_GET['edate'] : '';

		$url="page=$page&act=$act&keyword=$keyword&sdate=$sdate&edate=$edate";
		$sql = "delete from  `".PRE."member_job`   where `id` in (".$_POST['delaid'].")";		
		$db->query($sql) or die("SQL execution error!");
		
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='list.php?$url';</SCRIPT>";
	}
	
	//确定招聘名称
	function getjobname($jobid){
		global $db;
		$tsql="select jobname from ".PRE."member_job where  id=".intval($jobid);
		$rst=mysql_query($tsql) or die ("SQL execution error!");
		$okt=is_array($rowt=mysql_fetch_array($rst));
		return $rowt[0];
	}	
	
	/**************企业会员管理中心**************************************/

	//找回密码
	function findpwd($username,$email){
		global $db,$func,$smtpmail,$site_webname;
		$tsql="select *  from ".PRE."member   where  username='".$username."' and email='".$email."'";
		$rst=mysql_query($tsql) or die ("SQL execution error!");
		$okt=is_array($rowt=mysql_fetch_array($rst));
		if ($okt){
			$defaultpwd=md5("123456");
			$sql="update ".PRE."member set password='".$defaultpwd."' where id=".$rowt['id']."";
			$db->query($sql) or die("SQL execution error!");
			
			//通过邮件找回密码信息
			$mailto          = $email; //发送至邮箱
			$subject     = "【".$site_webname."】找回密码通知！";
			$body        = "<h1><b>".$username."</b>，您已在".$site_webname."的密码已经成功找回，密码被设置为<b>123456</b>,请尽快登录会员系统修改密码信息。<br>谢谢你对【".$site_webname."】的支持。</h1>";
			$send=$smtpmail->sendemail($mailto,$subject,$body);
		
			$func->GoUrl("/user/findpwd.php?action=result&flag=1&username=".$username);
		}else{
			$func->GoAlertUrl("用户名或者邮箱地址不匹配！","../user/findpwd.php");
		}
	}
	
	//会员登录
	function memberlogin($user,$password,$usertype){
		global $db,$func;
		$sql="select * from `".PRE."member` where `username`='".$user."' and gradeid='".$usertype."'  and isdel=0";

		$rs=$db->query($sql) or die ("SQL execution error!");
		$arr=is_array($row=$db->fetch_array($rs));

		$pass=$arr?trim(md5($password))==trim($row['password']):false;

			if($pass){	
				if ($row['islock']==1){
					$func->GoAlertUrl('此账户已被管理员锁定！请与管理员联系！',"/user/login.php");
				}
 			
				$_SESSION["session_uid"]=$row['id'];
				$_SESSION["session_username"]=$row['username'];
				$_SESSION["session_realname"]=$row['realname'];
				$_SESSION["session_usertype"]=$row['gradeid'];
				$_SESSION["session_data"]=$row;
				//$refer=isset($_POST['refer'])?$_POST['refer']:'';
				if ($refer!=""){
					$url=$refer;
				}else{
					$url="/";
				}
				//$func->GoUrl($url);
				echo "<script>window.location='".$url."';</script>";
				exit;
 
			}else{
					$func->GoAlertUrl('此账户或密码错误！',"/user/login.php?usertype=".$usertype."");
			}
	
	}
 
	//会员退出
	function SessionDestroy(){
		 $_SESSION["session_uid"]='';
		 $_SESSION["session_username"]='';
		 $_SESSION["session_usertype"]='';
		 unset($_SESSION["session_uid"]);
		 unset($_SESSION["session_username"]);	 
		 unset($_SESSION["session_usertype"]);
	}
	
	//管理中心安全检查
	function member_check(){
		global $func;
		if ($_SESSION['session_uid']=='' || $_SESSION['session_uid']==null){
			$func->GoUrl("/user/login.php");
		}
	}	
 
	//验证会员是否存在
	function checkmember($username,$gradeid){
		global $db,$func;
		$gourl="";
		$tsql="select count(*)  from `".PRE."member`  where  username='".$username."' and gradeid='".$gradeid."'";
		$rst=mysql_query($tsql) or die ("SQL execution error!ErrCode:checkmember01");
		$okt=is_array($rowt=mysql_fetch_array($rst));
		if ($rowt[0]>0){
			$gourl="edit.php?action=add";
			$func->GoAlertUrl("温馨提示：对不起，此账户名已经存在，请更换账户名！",$gourl);
		}
	}		
 
	//验证会员是否存在
	function checkmembersfzno($sfzno){
		global $db,$func;
		$gourl="";
		$tsql="select count(*)  from `".PRE."member_personal`  where  sfzno='".$sfzno."'";

		$rst=mysql_query($tsql) or die ("SQL execution error!ErrCode:checkmembersfzno02");
		$okt=is_array($rowt=mysql_fetch_array($rst));
		if ($rowt[0]>0){
			$gourl="edit.php?action=add";
			$func->GoAlertUrl("温馨提示：对不起，此身份证号码已经存在，请换更换身份证号码！",$gourl);
		}
	}	
 
	//验证会员是否存在
	function checkmembersfzno2($sfzno,$memid){
		global $db,$func;
		$gourl="";
		$tsql="select count(*)  from `".PRE."member_personal`  where  sfzno='".$sfzno."' and memid<>'".$memid."'";

		$rst=mysql_query($tsql) or die ("SQL execution error!ErrCode:checkmembersfzno02");
		$okt=is_array($rowt=mysql_fetch_array($rst));
		if ($rowt[0]>0){
			echo "<script>alert('温馨提示：对不起，此身份证号码已经存在，请换更换身份证号码！');history.back();</script>";
			exit;
		}
	}			
 	//验证会员身份证是否存在
	function CheckPageSFZNo($sfzno,$memid){
		global $db,$func;
		$gourl="";
		$tsql="select count(*)  from `".PRE."member_personal`  where  sfzno='".$sfzno."' and memid<>'".$memid."'";

		$rst=mysql_query($tsql) or die ("SQL execution error!ErrCode:checkmembersfzno02");
		$okt=is_array($rowt=mysql_fetch_array($rst));
		if ($rowt[0]>0){
			$gourl="/user?action=baseinfo";
			$func->GoAlertUrl("温馨提示：对不起，此身份证号码已经存在，请换更换身份证号码！",$gourl);
		}
	}

 	//验证会员是否存在简历信息
	function CheckExistResum($memid){
		global $db,$func;
		$gourl="";
		$tsql="select count(*)  from `".PRE."member_resume`  where  memid='".$memid."'";

		$rst=mysql_query($tsql) or die ("SQL execution error!ErrCode:CheckExistResum");
		$okt=is_array($rowt=mysql_fetch_array($rst));
		return $rowt[0];
	}
	
	//验证公司是否存在
	function checkmembercompanyname($companyname){
		global $db,$func;
		$gourl="";
		$tsql="select count(*)  from `".PRE."member_company`  where  companyname='".$companyname."'";

		$rst=mysql_query($tsql) or die ("SQL execution error!ErrCode:checkmembercompanyname02");
		$okt=is_array($rowt=mysql_fetch_array($rst));
		if ($rowt[0]>0){
			$gourl="edit.php?action=add";
			$func->GoAlertUrl("温馨提示：对不起，此公司名称已经存在，请换更换公司名称！",$gourl);
		}
	}	
			
	//注册时验证会员是否存在
	function checkmemberforpage($username){
		global $db,$func;

 		if ($username!=""){
			$tsql="select count(*)  from `".PRE."member`  where  username='".$username."' and isdel=0";
			$rst=mysql_query($tsql) or die ("SQL execution error!");
			$okt=is_array($rowt=mysql_fetch_array($rst));
			if ($rowt[0]>0){
				header("location:../user/register.php?err=401");
				exit;
			}
		}else{
			header("location:../user/register.php?err=402");
			exit;
		}
	}
	
	//判断手机和身份证是否存在技工信息表中，如果存在就直接获取他的账户信息和ID
	function getUserInfoID($mobile,$sfzno){
		global $db,$func;

 		if ($mobile!="" && $sfzno!=""){
			$tsql="select memid from `".PRE."member_personal`  where  mobile='".$mobile."' and sfzno='".$sfzno."' ";
			$rst=mysql_query($tsql) or die ("SQL execution error!".$tsql);
			$okt=is_array($rowt=mysql_fetch_array($rst));
			if ($rowt[0]>0){
				return $rowt['memid'];
			}
		}else{
			return 0;
		}
	}	
	
	//注册时验证会员是否存在
	function checkmemberforpage2($username,$usertype){
		global $db,$func;

 		if ($username!=""){
			$tsql="select count(*)  from `".PRE."member`  where  username='".$username."' and gradeid='".$usertype."' and ischeck=1  and isdel=0";
			$rst=mysql_query($tsql) or die ("SQL execution error!");
			$okt=is_array($rowt=mysql_fetch_array($rst));
			if ($rowt[0]>0){
				echo "<script>alert('已经存在该用户名！');window.location='/user/register.php?err=401&usertype".$usertype.";</script>";
				exit;
			}
		}
	}
	
	//注册时验证会员是否存在改企业名称
	function checkcompany($companyname){
		global $db,$func;

 		if ($username!=""){
			$tsql="select count(*)  from `".PRE."member_company`  where  companyname='".$companyname."' ";
			$rst=mysql_query($tsql) or die ("SQL execution error!");
			$okt=is_array($rowt=mysql_fetch_array($rst));
			if ($rowt[0]>0){
				echo "<script>alert('已经存在该企业名称！');window.location='/user/register.php?err=401&usertype".$usertype.";</script>";
				exit;
			}
		}
	}	
	
	//取得会员的详细信息
	function ShowMemberInfo($uid){
		global $db,$func;
		$sql="select a.*  from ".PRE."member a  where a.id=".$uid;
		$rs=mysql_query($sql) or die ("SQL execution error!1".$sql);
		$ok=is_array($row=mysql_fetch_array($rs));
		
		$sql2="select b.* from  ".PRE."member_personal b where b.memid=".$uid;
		$rs2=mysql_query($sql2) or die ("SQL execution error!2");
		$ok2=is_array($row2=mysql_fetch_array($rs2));
		
		$sql3="select b.* from ".PRE."member_resume b  where b.memid=".$uid;
		$rs3=mysql_query($sql3) or die ("SQL execution error!3");
		$ok3=is_array($row3=mysql_fetch_array($rs3));
		
		$sql4="select a.* from ".PRE."member_company a  where a.memid=".$uid;
		$rs4=mysql_query($sql4) or die ("SQL execution error!4");
		$ok4=is_array($row4=mysql_fetch_array($rs4));
		
		$result=array('base'        =>$row,				  
					  'personal'    =>$row2,
					  'resume'      =>$row3,
					  'company'     =>$row4
					  );
 
		return $result;
	}
	
	//会员基本信息
	function ShowMemberBaseInfo($uid){
		global $db,$func;
		$sql="select a.*  from ".PRE."member a  where a.id=".$uid;
		$rs=mysql_query($sql) or die ("SQL execution error!1".$sql);
		$ok=is_array($row=mysql_fetch_array($rs));
		
		$sql2="select b.* from  ".PRE."member_personal b where b.memid=".$uid;
		$rs2=mysql_query($sql2) or die ("SQL execution error!2");
		$ok2=is_array($row2=mysql_fetch_array($rs2));
		
		$sql3="select b.* from ".PRE."member_resume b  where b.memid=".$uid;
		$rs3=mysql_query($sql3) or die ("SQL execution error!3");
		$ok3=is_array($row3=mysql_fetch_array($rs3));
		
		$sql4="select a.* from ".PRE."member_company a  where a.memid=".$uid;
		$rs4=mysql_query($sql4) or die ("SQL execution error!4");
		$ok4=is_array($row4=mysql_fetch_array($rs4));
		
		$result=array('base'        =>$row,				  
					  'personal'    =>$row2,
					  'resume'      =>$row3,
					  'company'     =>$row4
					  );
 
		return $result;
	}
 
	//修改密码
	function member_modifypwd(){
		global $db,$func,$session_uid;
		$uid=$session_uid;
		$password=md5(trim($_POST["password"]));

		$sql="update ".PRE."member set password='".$password."' where id=".$uid."";
		$db->query($sql) or die("SQL execution error!");
		$func->GoAlertUrl("密码修改成功，请牢记！","../user/index.php?action=modifypwd");
	}	
	
	//修改基本账户
	function member_update_do(){
		global $db,$func,$session_uid;

	}

 	//前台注册会员
	function member_reg_do() {
		global $db,$func,$site_webname;
		
		$usertype=isset($_POST['usertype'])?$_POST['usertype']:1;			
		$username=$func->strcheck($_POST['username']);	
		$password=md5($func->strcheck($_POST['password']));
		$xingming=$func->strcheck($_POST['xingming']);
		$sfzno=$func->strcheck($_POST['sfzno']);
		if ($usertype==1){
			$mobile=$username;
		}
		$companyname=$func->strcheck($_POST['companyname']);
		$email=$func->strcheck($_POST['email']);
		$teleno=$func->strcheck($_POST['teleno']);	
			
		$regtime=date('Y-m-d H:i:s'); 
		if ($usertype==2){
			$ischeck=0;//企业注册需要审核
		}elseif ($usertype==1){
			$ischeck=1;//个人注册不需要审核
		}
		
 
		$this->checkmemberforpage2($username,$usertype);
		
		if ($usertype==2){//如果是企业验证企业是否存在。
			$this->checkcompany($companyname);
		}
		if ($usertype==1){
			//验证系统是否存在手机号码和身份证的匹配记录
			$memid=$this->getUserInfoID($mobile,$sfzno);
			if ($memid=="" && $memid==0){
				//保存基本账户
				$sql="insert into ".PRE."member(gradeid,username,password,nickname,addtime,ischeck) values ('".$usertype."','".$username."','".$password."','".$xingming."','".$regtime."','".$ischeck."')";
		
				$db->query($sql) or die("SQL execution error!ErrCode:01");
				$memid = mysql_insert_id();
			}else{
				//修改用户名和密码
				$sql="update ".PRE."member set username='".$username."',password='".$password."',nickname='".$xingming."' where id='".$memid."'";
		
				$db->query($sql) or die("SQL execution error!ErrCode:01-3");
			}
			
		}else{
			//保存基本账户
			$sql="insert into ".PRE."member(gradeid,username,password,addtime,ischeck) values ('".$usertype."','".$username."','".$password."','".$regtime."','".$ischeck."')";
	
			$db->query($sql) or die("SQL execution error!ErrCode:01");
			$memid = mysql_insert_id();
		}

		
		if ($usertype==1){
			
			//如果存在就更新账户名和密码，然后直接就登录。
			//if ($memid=="" && $memid==0){
				//保存技工账户扩展信息
				$extra_column="";
				$extra_column.="memid";
				$extra_column.=",xingming";
				$extra_column.=",sfzno";
				$extra_column.=",mobile";
				$extra_column.=",gxtime";
				//$extra_column.=",pic";		
				
				$extra_columnvalue="";
				$extra_columnvalue.="'".$memid."'";
				$extra_columnvalue.=",'".$xingming."'";
				$extra_columnvalue.=",'".$sfzno."'";				
				$extra_columnvalue.=",'".$mobile."'";
				$extra_columnvalue.=",'".$regtime."'";	
				//$extra_columnvalue.=",'/templates/default/images/user/nouser.jpg'";
				
				//填写个人资料
				$sql="insert into ".PRE."member_personal(".$extra_column.",pic) values (".$extra_columnvalue.",'/templates/default/images/user/nouser.jpg')";
				
				$db->query($sql) or die("SQL execution error!ErrCode:02-1".$sql);
			//}
			//默认写入简历
			//$sql="insert into ".PRE."member_resume(".$extra_column.") values (".$extra_columnvalue.")";
			//$db->query($sql) or die("SQL execution error!ErrCode:02-2".$sql);
			
		}elseif ($usertype==2){
		
			//保存企业账户扩展信息
			$extra_column="";
			$extra_column.="memid";
			$extra_column.=",companyname";
			$extra_column.=",email";
			$extra_column.=",teleno";	
			$extra_column.=",companylogo";		
			$extra_columnvalue="";
			$extra_columnvalue.="'".$memid."'";
			$extra_columnvalue.=",'".$companyname."'";
			$extra_columnvalue.=",'".$email."'";
			$extra_columnvalue.=",'".$teleno."'";		
			$extra_columnvalue.=",'/templates/default/images/user/nopic.jpg'";		
			$sql="insert into ".PRE."member_company(".$extra_column.") values (".$extra_columnvalue.")";

			$db->query($sql) or die("SQL execution error!ErrCode:03");
		}
	    //注册后就登录。
		$_SESSION["session_uid"]=$memid;
		$_SESSION["session_username"]=$username;
		$_SESSION["session_usertype"]=$usertype;
		
		if ($usertype==1){
			$url="/user/?action=baseinfo";
		}elseif ($usertype==2){
			$url="/user/?action=companyinfo";
		}
		//保存完毕后提示
		if ($usertype==1){
			echo "<script type='text/javascript'>alert('尊敬的".$username."，恭喜您已成功注册成为【".$site_webname."】会员,马上去完善资料！');window.location.href='".$url."';</script>";
		}elseif ($usertype==2){
			echo "<script type='text/javascript'>alert('尊敬的".$username."，恭喜您已成功注册成为【".$site_webname."】会员,马上去上传认证资料信息！');window.location.href='".$url."';</script>";
		}
		exit;	
	}	
	
	/**************首页调用**************************************/
	//前台Top推荐企业（推荐）
	function TopCompany($topnum,$titlelength){
		global $db,$type,$func,$ishtml,$site_extname;
		$titlelength=$titlelength*2;
		$strsql="select a.* from `".PRE."member_company` a  left outer join  ".PRE."member b on a.memid=b.id where b.gradeid=2 and b.istj=1  and b.isdel=0 order by  a.gxtime desc limit 0,".$topnum."";
 
		$rs=$db->query($strsql)  or die("SQL execution error!");
		$result="";
		$k=0;
		while($row = $db->fetch_array($rs)){
				$targeturl="/plus/companyview.php?id=".$row["memid"];
				$pic=$func->getrealpath2($row['companylogo']);
				$titlelimit=0;
				$title=$row['companyname'];
				$titlelen=$titlelength;
				if (strlen($title)>$titlelen){
					$titlelimit=$func->str_len($title,($titlelen))."";
				}else{
					$titlelimit=$title;
				}

				$result=$result."<li><a href=\"".$targeturl."\" target=\"_blank\"><img src=\"".$pic."\"  height=\"80\" /><p>".$title."</p></a></li>\n";
			$k=$k+1;
		}

		echo $result;
	}
	
	//前台Top最新项目（推荐）
	function TopProject($topnum,$titlelength){
		global $db,$type,$func,$ishtml,$site_extname;
		$titlelength=$titlelength*2;
		$strsql="select a.*,b.place from `".PRE."member_project` a  left outer join  ".PRE."member_company b on a.memid=b.memid where   a.istj=1  order by  a.addtime desc limit 0,".$topnum."";
 
		$rs=$db->query($strsql)  or die("SQL execution error!");
		$result="";
		$k=0;
		while($row = $db->fetch_array($rs)){
				$targeturl="/plus/pview.php?id=".$row["id"];
				$pic=$func->getrealpath2($row['pic']);
				$titlelimit=0;
				$title=$row['projectname'];
				$titlelen=$titlelength;
				if (strlen($title)>$titlelen){
					$titlelimit=$func->str_len($title,($titlelen))."";
				}else{
					$titlelimit=$title;
				}
				$k=$k+1;
				$lastcss="";		
 				if ($k%4==0){
					$lastcss=" item-li-last";
				}
				$result=$result."<li class=\"item-li".$lastcss."\">
									<a href=\"".$targeturl."\" target=\"_blank\" class=\"item-a\"><img  class=\"item-img\" src=\"".$pic."\"/></a>
									<h3 class=\"item-title\"><a target=\"_blank\" href=\"".$targeturl."\" style=\"font-size:14px;\">".$title."</a> </h3>
									
									<div class=\"p-outer\">
										  <div class=\"p-bar\">
											<div style=\"width: 0%\"></div>
										  </div>
									</div>
									<div class=\"p-items\">
										<div class=\"p-target\"><span class=\"p-title\" style=\"font-size:14px;\">".$row['xmplace']."</span> </div>
									</div>
									</li>\n";
									//<p class=\"item-detail\"> <a href=\"".$targeturl."\" target=\"_blank\">".$row['major']."</a> </p>
		}

		echo $result;
	}
	
	//前台项目列表
	function ProjectList($titlelength){
		global $db,$type,$func,$ishtml,$site_extname;
		$titlelength=$titlelength*2;
		$strsql="select a.*,b.place,b.companyname from `".PRE."member_project` a  left outer join  ".PRE."member_company b on a.memid=b.memid   order by  a.addtime desc ";
 
		$rs=$db->query($strsql)  or die("SQL execution error!");
		$result="";
		$k=0;
		while($row = $db->fetch_array($rs)){
				$targeturl="/plus/pview.php?id=".$row["id"];
				$pic=$func->getrealpath2($row['pic']);
				$titlelimit=0;
				$title=$row['projectname'];
				$titlelen=$titlelength;
				if (strlen($title)>$titlelen){
					$titlelimit=$func->str_len($title,($titlelen))."";
				}else{
					$titlelimit=$title;
				}
				$k=$k+1;
 
				$result=$result."			 <li class=\"am-u-sm-12 am-u-md-6 am-padding-horizontal-xs am-padding-vertical-sm\" style=\"float:left;\">
												 <div class=\"white\">
													<div class=\"channel-list-img\">
														<a href=\"".$targeturl."\" class=\"\" target=_blank> <img src=\"".$pic."\"  class=\"am-img-responsive\"/> </a>
													</div>
													<div class=\"channel-list-con clearfix am-padding-vertical\">
															<div class=\"am-u-sm-12 am-u-md-9 channel-list-des\">
													
																<dd class=\"am-sm-only-text-center\">".$title."</dd>
															</div>
															<div class=\"am-u-sm-12 am-u-md-3\"><a class=\"am-btn  am-btn-warning am-btn-block\" href=\"".$targeturl."\" target=_blank >查看项目</a></div>
													</div>
												</div>
											</li>\n";
		}

		echo $result;
	}	
	//前台企业的项目列表
	function MemberProjectList($memid){
		global $db,$type,$func,$ishtml,$site_extname;
		$titlelength=$titlelength*2;
		$strsql="select a.*,b.place,b.companyname from `".PRE."member_project` a  left outer join  ".PRE."member_company b on a.memid=b.memid  where  b.memid='".$memid."'  order by  a.addtime desc ";
 //echo $strsql;

		$rs=$db->query($strsql)  or die("SQL execution error!");
		$result="";
		$k=0;
		while($row = $db->fetch_array($rs)){
				$targeturl="/plus/pview.php?id=".$row["id"];
				$pic=$func->getrealpath2($row['pic']);
				$titlelimit=0;
				$title=$row['projectname'];
				$titlelen=$titlelength;
				if (strlen($title)>$titlelen){
					$titlelimit=$func->str_len($title,($titlelen))."";
				}else{
					$titlelimit=$title;
				}
				$k=$k+1;
 
				$result=$result."			 <li class=\"am-u-sm-12 am-u-md-6 am-padding-horizontal-xs am-padding-vertical-sm\" style=\"float:left;\"><a href=\"".$targeturl."\" target=_blank  style=\"align:center;\">◇&nbsp;&nbsp;".$title."</a></li>\n";
		}

		echo $result;
	}	
		
	//前台项目的招聘
	function ProjectJobInfo($projectid,$titlelength,$topnum){
		global $db,$type,$func,$ishtml,$site_extname;
		$titlelength=$titlelength*2;
		$strsql="select a.* from `".PRE."member_job` a  where a.xmid='".$projectid."'  order by  a.addtime desc limit 0,".$topnum."";
 
 
		$rs=$db->query($strsql)  or die("SQL execution error!");
		$result="<table width=\"100%\" border=0>";
		$k=0;
		while($row = $db->fetch_array($rs)){
				$targeturl="/plus/jobview.php?id=".$row["id"];
				$titlelimit=0;
				$title=$row['jobname'];
				$titlelen=$titlelength;
				if (strlen($title)>$titlelen){
					$titlelimit=$func->str_len($title,($titlelen))."";
				}else{
					$titlelimit=$title;
				}
				$k=$k+1;
				$result=$result."<tr>
				<td width=\"30%\" style=\"font-size:12px;\">· <a href=\"".$targeturl."\" target=\"_blank\" class=\"font-size-base link-basecolor\" title=\"".$title."\">".$titlelimit."</a></td>
				<td width=\"25%\" style=\"font-size:12px;\">".$row['salary_s']."-".$row['salary_e']."元</td>
				<td width=\"15%\" style=\"font-size:12px;\">".$row['zgtype']."</td>
				<td width=\"15%\" style=\"font-size:12px;\">".$row['place']."</td>
				<td width=\"15%\" style=\"padding:5px 0;\"><a href=\"".$targeturl."\" target=\"_blank\" class=\"version-btn-h30\">立即申请</a></td>
				</tr> \n";
		}
		$result.="</table>";
		return $result;
	}
 
	//top招聘调用
	function TopJobInfo($jobtype,$topnum,$titlelength){
		global $db,$type,$func,$ishtml,$site_extname;
		$titlelength=$titlelength*2;
		if ($jobtype==1){//热门
			$strsql="select a.*,b.projectname from `".PRE."member_job` a  left outer join  ".PRE."member_project b on a.memid=b.memid where   a.ishot=1  order by  a.addtime desc limit 0,".$topnum."";
		}elseif ($jobtype==2){//最新
			$strsql="select a.*,b.projectname from `".PRE."member_job` a  left outer join  ".PRE."member_project b on a.memid=b.memid  order by  a.addtime desc limit 0,".$topnum."";
		}elseif ($jobtype==3){//即将到期7天内
			$strsql="select a.*,b.projectname from `".PRE."member_job` a  left outer join  ".PRE."member_project b on a.memid=b.memid  where Datediff(a.addtime,'".date('Y-m-d')."')<7 order by  a.addtime desc limit 0,".$topnum."";
		}elseif ($jobtype==4){//推荐
			$strsql="select a.*,b.projectname from `".PRE."member_job` a  left outer join  ".PRE."member_project b on a.memid=b.memid where   a.istj=1  order by  a.addtime desc limit 0,".$topnum."";
		}
		
 
		$rs=$db->query($strsql)  or die("SQL execution error!");
		$result="";
		$k=0;
		while($row = $db->fetch_array($rs)){
				$targeturl="/plus/jobview.php?id=".$row["id"];
				$titlelimit=0;
				$title=$row['jobname'];
				$titlelen=$titlelength;
				if (strlen($title)>$titlelen){
					$titlelimit=$func->str_len($title,($titlelen))."";
				}else{
					$titlelimit=$title;
				}
				$k=$k+1;
				$result=$result."<div class=\"project-item\">
								  <div class=\"\">
									  <span class=\"grid-wh-155  lt\"> <a href=\"".$targeturl."\" target=\"_blank\" class=\"font-size-base link-basecolor\">".$title."</a> </span> 
									  <span class=\"grid-wh-100 justify-center lt\"> <span class=\"global-orange font-size-large font-arial\">".$row['salary_s']."-".$row['salary_e']."</span> </span> 
									  <span class=\"grid-wh-80 justify-center lt\"> ".$row['zgtype']." </span>
									   <div class=\"grid-wh-80 justify-center lt lt\" style=\"width:120px;\"> <span class=\"distance-left\"> ".$row['place']."</span> </div>
									   <span class=\"grid-wh-100 justify-center lt\" style=\"width:70px;\"> <a href=\"".$targeturl."\" target=\"_blank\" class=\"version-btn-h30\">立即申请</a> </span>
								   </div>
								</div>\n";
		}

		echo $result;
	}
	
	//top技工简历
	function TopResumeInfo($topnum,$titlelength){
		global $db,$type,$func,$ishtml,$site_extname;
		$titlelength=$titlelength*2;
		$strsql="select a.* from  ".PRE."member_personal a left outer join  ".PRE."member c on a.memid=c.id  where a.is_show=1 and a.flag=1 order by  a.gxtime desc limit 0,".$topnum."";
		$rs=$db->query($strsql)  or die("SQL execution error!");
		$result="";
		$k=0;
		while($row = $db->fetch_array($rs)){
				$targeturl="/plus/resumeview.php?id=".$row["memid"];
				$result=$result."<div class=\"project-item\">
								  <div class=\"\">
									   <span class=\"grid-wh-100 justify-center lt\"> <a href=\"".$targeturl."\" target=\"_blank\" class=\"font-size-base link-basecolor\">".$row["xingming"]."</a> </span> 
									   <span class=\"grid-wh-155 justify-center lt\"> <span class=\"global-orange font-size-large font-arial\">".$row["gz"]."</span> </span>
									   <span class=\"grid-wh-135 justify-center lt\"> <span class=\"\">".$row["gzjy"]."年</span> </span> 
									   <span class=\"grid-wh-140 justify-center lt\"> <span class=\"\"> ".$row["place"]."</span> </span>
								  </div>
								</div>\n";
		}

		echo $result;
	}
	
	//前台：企业列表
	function PageCompanyList($tmpsql,$pagesize,$arrparam){
		global $db,$func,$type,$cidy;
		$page2=isset($_GET['page']) ? $_GET['page'] :1;
		$flag=isset($_GET['flag']) ? $_GET['flag'] :1;
 
		$sql=$tmpsql;
		$arr=$func->get_page_num($sql,$pagesize);
		$sql.=" limit $arr[1], $pagesize";

		$rs=$db->query($sql);// or die("SQL execution error！")
		
		$result="<div class=\"colist\"><ul>";
		
		while($row = $db->fetch_array($rs)){
 
				$targeturl="/plus/companyview.php?id=".$row['memid'];
				$pic=$func->getrealpath2($row['companylogo']);
				$content=$func->str_len($func->ClearHTML($row['profile']),55*2);
				$contentlimit=$func->str_len($content,55*2)."...";
				
				$result.="<li>
				     <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
						  <tr>
							<td valign=\"top\" align=\"center\" width=\"120\" style=\"padding:10px;\"><a href=\"".$targeturl."\" target=\"_blank\"><img src=\"".$pic."\" style=\" padding:10px;border:1px solid #f0f0f0;width:100px;height:100px;\"></a></td>
							<td align=\"left\" valign=\"top\" style=\" padding:10px;\">
							<p><a href=\"".$targeturl."\">".$row['companyname']."</a><span class=\"cocity\">".$row['place']."</span></p>
							<p class=\"codes\">".$contentlimit."</p>
							<p><a href=\"".$targeturl."\" class=\"am-btn am-btn-success am-fr am-btn-sm\" >查看详情</a></p>
							</td>
						  </tr>
						</table>
						</li>\n";
		}
		if ($arr[0]>0){
			echo $result."</ul></div>";
			new cmspage($arr[0],$pagesize,$arrparam);
		}else{
			echo "<div style=\"padding-left:20%;\">暂时还没有企业信息！</div>";
		}
		echo "<div style=\"height:50px;\"></div>";
	}	
	
	//前台：招聘搜索结果
	function PageJobSearchList($tmpsql,$pagesize,$arrparam){
		global $db,$func,$type,$cidy;
		$page2=isset($_GET['page']) ? $_GET['page'] :1;
		$flag=isset($_GET['flag']) ? $_GET['flag'] :1;
 
		$sql=$tmpsql;
		$arr=$func->get_page_num($sql,$pagesize);
		$sql.=" limit $arr[1], $pagesize";

		$rs=$db->query($sql);// or die("SQL execution error！")
		
		echo "";
		
		while($row = $db->fetch_array($rs)){
 
				$targeturl="/plus/jobview.php?id=".$row['id'];
				echo "<li class=\"am-u-sm-12 am-u-md-6 am-fl\" style=\"float:left\">
					  <div><strong><a href=\"".$targeturl."\" target=_blank>".$row['jobname']."</a></strong> <a class=\"am-btn am-btn-success am-fr am-btn-sm\" href=\"".$targeturl."\" target=\"_blank\">申请此工作</a> </div>
					  <div>".$row['place']."      
					  <em class=\"am-margin-horizontal-xs\">|</em>".$row['companyname']."</div>
					  <div><span class=\"am-text-warning\">".$row['salary_s']." - ".$row['salary_e']."</span><span class=\"am-badge am-fr\">".$func->format_datetime($row['addtime'])."</span></div>
					  <hr style=\"margin-top:1rem;\" />
					</li>";
		}
		if ($arr[0]>0){
			new cmspage($arr[0],$pagesize,$arrparam);
		}else{
			echo "<div style=\"padding-left:20%;\">
				 <strong>建议您：</strong><br>
				  1、看看输入的文字是否有误<br>
				  2、去掉可能不必要的字词，如“的”、“什么”等<br>
				  3、调整更确切的关键词或搜索条件<br></div>";
		}
	}
	
	//前台：招聘搜索结果--更新后的
	function PageJobSearchListNew($tmpsql,$pagesize,$arrparam){
		global $db,$func,$type,$cidy;
		$page2=isset($_GET['page']) ? $_GET['page'] :1;
		$flag=isset($_GET['flag']) ? $_GET['flag'] :1;
 
		$sql=$tmpsql;
		$arr=$func->get_page_num($sql,$pagesize);
		$sql.=" limit $arr[1], $pagesize";

		$rs=$db->query($sql);// or die("SQL execution error！")
		
		$header="<table class=\"am-table am-table-hover \">
 
					<tr>
					  <td align=\"left\" class=\"am-text-top\"><strong>职位名称</strong></td>
					  <td align=\"center\" class=\"am-text-top am-show-md-up\"><strong>项目名称</strong></td>
					  <td align=\"center\" class=\"am-text-top\"><strong>薪资</strong></td>
					  <td align=\"center\" class=\"am-text-top am-show-md-up\"><strong>工作地点</strong></td>
					  <td  width=\"120\" align=\"center\"  class=\"am-text-top am-show-md-up\"><strong>发布日期</strong></td>
					  <td width=\"100\" align=\"center\" class=\"am-text-top\"><strong>操作</strong></td>
					</tr>\n";
			
		 $result="";
		
		while($row = $db->fetch_array($rs)){
 
				$targeturl="/plus/jobview.php?id=".$row['id'];
				$result.= "<tr >
						<td class=\"am-text-middle\"><a href=\"".$targeturl."\" target=\"_blank\"><b>".$row['jobname']."</b></a></td><!--职位名称 -->
						<td class=\"am-text-middle  am-show-md-up\">".$this->getxmname($row['xmid'])."</td><!--项目名称 -->
						<td align=\"center\" class=\"am-text-middle\"><span class=\"am-text-warning\">".$row['salary_s']." - ".$row['salary_e']."元</span></td>
						<!--薪资 -->    
						<td align=\"center\" class=\"am-text-middle  am-show-md-up\">".$row['place']."</td>
						<!--工作地点 -->
						<td align=\"center\" class=\"am-text-middle  am-show-md-up\">".$func->format_datetime($row['addtime'])."</td>
						<!--发布日期 --> 
						<td align=\"center\" class=\"am-text-middle\"><a class=\"am-btn am-btn-success am-fr am-btn-sm\" href=\"".$targeturl."\" target=\"_blank\">申请此岗位</a></td> 
						<!--申请此岗位 -->  
					</tr>\n";
		}
		$bottom.="</table>\n";
		if ($arr[0]>0){
			echo $header.$result.$bottom;
			new cmspage($arr[0],$pagesize,$arrparam);
		}else{
			echo $header."<tr><td colspan=6><div style=\"padding-left:20%;\">
				<br><br><br><strong>建议您：</strong><br>
				  1、看看输入的文字是否有误<br>
				  2、去掉可能不必要的字词，如“的”、“什么”等<br>
				  3、调整更确切的关键词或搜索条件<br><br><br></div></td></tr>".$bottom;
		}
	}
	
	//前台：技工搜索结果
	function PageResumeSearchList($tmpsql,$pagesize,$arrparam){
		global $db,$func,$type,$cidy;
		$page2=isset($_GET['page']) ? $_GET['page'] :1;
		$flag=isset($_GET['flag']) ? $_GET['flag'] :1;
 
		$sql=$tmpsql;
		$arr=$func->get_page_num($sql,$pagesize);
		$sql.=" limit $arr[1], $pagesize";

		$rs=$db->query($sql);// or die("SQL execution error！")
		$tablepre="<table class=\"am-table am-table-bordered am-table-radius am-table-striped am-table-hover am-table-centered am-table-compact\" >
				<thead >
					<tr>
					  <th>照片</th>
					  <th>姓名</th>
					  <th>性别</th>
					  <th>年龄</th>
					  <th>专业</th>
					  <th class=\"am-show-md-up\">职称证书</th>
					  <th class=\"am-show-md-up\">工作经验</th>
					  <th class=\"am-show-md-up\">现居住地</th>
					</tr>
				  </thead>
				<tbody>";
		$result="";
		
		while($row = $db->fetch_array($rs)){
 
				$targeturl="/plus/resumeview.php?id=".$row['memid'];
				
				$borndate   =$row['borndate'];
				$darray=explode('-',$borndate);
				$bornyear   =intval(date('Y'))-intval($darray[0]);
				$result.="<tr >
						<td><a href=\"".$targeturl."\" target=\"_blank\"><img src=\"".$func->getrealpath2($row['pic'])."\" width=\"100\" height=\"100\"  class=\"am-radius\" alt=\"".$row['xingming']."\"></a></td>
						<td class=\"am-text-middle\"><a href=\"".$targeturl."\" target=\"_blank\"><b>".$row['xingming']."</b></a></td><!--姓名 -->
						<td class=\"am-text-middle\">".$row['sex']."</td><!--性别 -->
						<td class=\"am-text-middle\">".$bornyear."岁</td><!--年龄 -->    
						<td class=\"am-text-middle\">".$row['gz']."</td><!--专业 -->
						<td class=\"am-text-middle am-show-md-up\">".$row['jszc']."</td><!--职称证书 --> 
						<td class=\"am-text-middle am-show-md-up\">".$row['gzjy']."年</td> <!--工作经验 --> 
						<td class=\"am-text-middle am-show-md-up\"> ".$row['place']." </td><!--居住地 -->      
					</tr>";
		}
		$result.="</tbody></table>";
		if ($arr[0]>0){
		    echo $tablepre.$result;
			new cmspage($arr[0],$pagesize,$arrparam);
		}else{
			echo "<div style=\"padding-left:20%;\">
				 <strong>建议您：</strong><br>
				  1、看看输入的文字是否有误<br>
				  2、去掉可能不必要的字词，如“的”、“什么”等<br>
				  3、调整更确切的关键词或搜索条件<br></div>";
		}
	}
	
	/*----手机版------------------------------------------------------*/
	
	//热门招聘
	function WapTopJobInfo($topnum,$titlelength){
		global $db,$type,$func,$ishtml,$site_extname;
		$titlelength=$titlelength*2;
		$strsql="select a.*,b.companyname from `".PRE."member_job` a left outer join ".PRE."member_company b on a.memid=b.memid  where   a.ishot=1  order by  a.addtime desc limit 0,".$topnum."";
		$rs=$db->query($strsql)  or die("SQL execution error!");
		$result="";
		$k=0;
		while($row = $db->fetch_array($rs)){
				$targeturl="/plus/jobview.php?id=".$row["id"];
				$titlelimit=0;
				$title=$row['jobname'];
				$titlelen=$titlelength;
				if (strlen($title)>$titlelen){
					$titlelimit=$func->str_len($title,($titlelen))."";
				}else{
					$titlelimit=$title;
				}
				$k=$k+1;
				$result=$result."<li class=\"am-margin-top-sm am-margin-horizontal-sm\" >
									<div><strong><a href=\"".$targeturl."\">".$title."</a></strong> <a class=\"am-btn am-btn-success am-fr am-btn-sm\" href=\"".$targeturl."\" target=\"_blank\">申请此工作</a> </div>
									<div>".$row['place']."<em class=\"am-margin-horizontal-xs\">|</em>".$row['companyname']."</div>
									<div><span class=\"am-text-warning\">".$row['salary_s']." - ".$row['salary_e']."</span><span class=\"am-badge am-fr\">".$func->format_datetime($row['addtime'])."</span></div>
								</li>\n";
		}

		echo $result;
	}
	
	//人才技工
	function WapTopResumeInfo($topnum,$titlelength){
		global $db,$type,$func,$ishtml,$site_extname;
		$titlelength=$titlelength*2;
		$strsql="select a.*,c.pic from `".PRE."member_resume` a  left outer join  ".PRE."member b on a.memid=b.id   left outer join  ".PRE."member_personal c on a.memid=c.memid  where c.is_show=1 order by  a.gxtime desc limit 0,".$topnum."";
		$rs=$db->query($strsql)  or die("SQL execution error!");
		$result="";
		$k=0;
		while($row = $db->fetch_array($rs)){
				$targeturl="/plus/resumeview.php?id=".$row["memid"];
				$titlelimit=0;
				$title=$row['xingming'];
				$titlelen=$titlelength;
				if (strlen($title)>$titlelen){
					$titlelimit=$func->str_len($title,($titlelen))."";
				}else{
					$titlelimit=$title;
				}
				$k=$k+1;
				$result=$result." <li>
									<div class=\"am-gallery-item\">
										<a href=\"".$targeturl."\" class=\"\">
										  <img src=\"/templates/default/style/echo/loading.gif\"  data-echo=\"".$func->getrealpath2($row['pic'])."\"  alt=\"".$row["xingming"]."\" class=\"am-circle\"/>
											<h3 class=\"am-gallery-title am-text-center\">".$title."</h3>
											<div class=\"am-gallery-desc am-text-center\">".$row["gz"]."</div>
										</a>
									</div>
								  </li>\n";
		}

		echo $result;
	}
	
	//最新项目（推荐）
	function WapTopProject($topnum,$titlelength){
		global $db,$type,$func,$ishtml,$site_extname;
		$titlelength=$titlelength*2;
		$strsql="select a.*,b.place,b.companyname from `".PRE."member_project` a  left outer join  ".PRE."member_company b on a.memid=b.memid where   a.istj=1  order by  a.addtime desc limit 0,".$topnum."";
 
		$rs=$db->query($strsql)  or die("SQL execution error!");
		$result="";
		$k=0;
		while($row = $db->fetch_array($rs)){
				$targeturl="/plus/pview.php?id=".$row["id"];
				$pic=$func->getrealpath2($row['pic']);
				$titlelimit=0;
				$title=$row['projectname'];
				$titlelen=$titlelength;
				if (strlen($title)>$titlelen){
					$titlelimit=$func->str_len($title,($titlelen))."";
				}else{
					$titlelimit=$title;
				}
				$k=$k+1;
 
				$result=$result."<li data-thumb=\"".$pic."\"> 
								<a  href=\"".$targeturl."\"><img src=\"".$pic."\"></a>
								<div class=\"am-slider-desc\"><h2 class=\"am-slider-title\">".$companyname."</h2><p>".$title."</p></div>
								</li>\n";
		}

		echo $result;
	}
	
	/*----会员管理中心-------------------------------------------------------*/
	//修改密码
	function PageUserModifyPwd(){
		global $db,$func,$session_uid;
		$uid=$session_uid;
		$password=md5(trim($_POST["password"]));
		$sql="update ".PRE."member set password='".$password."' where id=".$uid."";
		$db->query($sql) or die("SQL execution error!");
		$func->GoAlertUrl("密码修改成功，请牢记！","/user?action=modifypwd");
	}	
	
	//修改技工会员
	function PageUserUpdateBaseInfo(){
		global $db,$func,$session_uid;
		$photo="";
		//上传的图片验证
		$filesize	       =$_FILES['file']['size'];
		//echo $filesize."<br>";
		if ($filesize>0){
 			$func->checkupload("file");
			$upfile = new upfilenew("file");
			$upfile->file_subfolder="user";	
			$upfile->is_upload_file();
			$upfile->check_file_name();
			$upfile->is_big();
			$upfile->check_type();
			$result=$upfile->upload_file(0,200,200);
			$photo=str_replace("../","/",$result);
		}
		$xingming     =$_POST['xingming']; 	
		$sex          =$_POST['sex'];		
		$borndate     =$_POST['borndate'];		
		$sfzno        =$_POST['sfzno'];
 		$mz           =$_POST['mz'];
		$hy           =$_POST['hy']; 	
		$hj           =$_POST['province2']."-".$_POST['city2'];	
 		$jycd         =$_POST['jycd'];	
		$byxx         =$_POST['byxx'];	
		$teleno       =$_POST['teleno'];
 		$mobile       =$_POST['mobile'];
		$address      =$_POST['address']; 	
		$jkzk         =$_POST['jkzk'];
		$sxyz         =$_POST['sxyz'];	
		$sxyz_data="";

		$size = count($sxyz);
		for($i=0; $i<$size; $i++)
		{
			if ($i==0)
			{
			$sxyz_data = $sxyz[$i];
			}
			else
			{
			$sxyz_data = $sxyz_data.",".$sxyz[$i];
			}
		}
		$sxyz=$sxyz_data;	
 		$hz           =$_POST['hz'];	
		$pic          =$photo;			
		$wkstatus     =isset($_POST['wkstatus'])?$_POST['wkstatus']:0;	
 		$zw           =$_POST['zw'];
		$gz           =$_POST['gz']; 	
		$place        =$_POST['province']."-".$_POST['city'];
 		$companyid    =isset($_POST['companyid'])?$_POST['companyid']:0;	
		$xmid         =isset($_POST['xmid'])?$_POST['xmid']:0;			
		$xmmanager    =isset($_POST['xmmanager'])?$_POST['xmmanager']:0;		
 
		$jszc       =$_POST['jszc'];
 		$gzjy       =$_POST['gzjy'];
		$email      =$_POST['email']; 	
		$qq         =$_POST['qq'];
		$gzjl         =$_POST['gzjl'];			
		
		//查询所带参数
		$act=isset($_GET['action']) ? $_GET['action'] : '';
 		$url="action=baseinfo";
		$memid = $session_uid;
		//检查身份号码重复
		$this->CheckPageSFZNo($sfzno,$memid);
 
		//保存账户扩展信息
		$columnvalue="";
		$columnvalue.="xingming='".$xingming."'";
		if ($photo!=""){
			$columnvalue.=",pic='".$pic."'";	
		}	
		$columnvalue.=",sex='".$sex."'";
		$columnvalue.=",borndate='".$borndate."'";
		$columnvalue.=",sfzno='".$sfzno."'";
		$columnvalue.=",mz='".$mz."'";
		$columnvalue.=",hy='".$hy."'";
		$columnvalue.=",hj='".$hj."'";
		$columnvalue.=",jycd='".$jycd."'";
		$columnvalue.=",byxx='".$byxx."'";
		$columnvalue.=",teleno='".$teleno."'";
		$columnvalue.=",mobile='".$mobile."'";
		$columnvalue.=",address='".$address."'";
		$columnvalue.=",jkzk='".$jkzk."'";
		$columnvalue.=",sxyz='".$sxyz."'";
		$columnvalue.=",hz='".$hz."'";
		$columnvalue.=",wkstatus='".$wkstatus."'";
		$columnvalue.=",gz='".$gz."'";
		$columnvalue.=",zw='".$zw."'";
		$columnvalue.=",place='".$place."'";
		
		$columnvalue.=",jszc='".$jszc."'";
		$columnvalue.=",gzjy='".$gzjy."'";
		$columnvalue.=",email='".$email."'";
		$columnvalue.=",qq='".$qq."'";
		$columnvalue.=",gzjl='".$gzjl."'";		
		$columnvalue.=",flag='1'";
		
		$sql="update ".PRE."member_personal set ".$columnvalue." where memid='".$memid."' ";


		$db->query($sql) or die("SQL execution error!-modify memberinfo");
		
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('修改成功！');window.location.href='/user?$url';</SCRIPT>";
		exit;
	}
	//修改简历
	function PageUserUpdateResume(){
		global $db,$func,$session_uid;
		$xingming     =$_POST['xingming']; 	
		$sex          =$_POST['sex'];		
		$borndate     =$_POST['borndate'];		
		$sfzno        =$_POST['sfzno'];
 		$mz           =$_POST['mz'];
 		$jycd         =$_POST['jycd'];	
		$byxx         =$_POST['byxx'];	
		$email       =$_POST['email'];
 		$mobile       =$_POST['mobile'];
		$qq           =$_POST['qq']; 	
		$gz           =$_POST['gz']; 	
		$place        =$_POST['province']."-".$_POST['city'];
 		$jszc         =$_POST['jszc'];
		$gzjy         =$_POST['gzjy'];
		$gzjl         =$_POST['gzjl']; 	
		$status       =isset($_POST['status'])?$_POST['status']:0; 	
		$gxtime       =date('Y-m-d H:i:s'); 
		
		//查询所带参数
		$act=isset($_GET['action']) ? $_GET['action'] : '';
 		$url="action=resume";
		$memid = $session_uid;
		//检查身份号码重复
		//$this->CheckPageSFZNo($sfzno,$memid);
 
 		if ($this->CheckExistResum($session_uid)==1){
			//保存账户扩展信息
			$columnvalue="";
			$columnvalue.="xingming='".$xingming."'";
			$columnvalue.=",sex='".$sex."'";
			$columnvalue.=",borndate='".$borndate."'";
			$columnvalue.=",sfzno='".$sfzno."'";
			$columnvalue.=",mz='".$mz."'";
			$columnvalue.=",jycd='".$jycd."'";
			$columnvalue.=",byxx='".$byxx."'";
			$columnvalue.=",email='".$email."'";
			$columnvalue.=",mobile='".$mobile."'";
			$columnvalue.=",qq='".$qq."'";
			$columnvalue.=",gz='".$gz."'";
			$columnvalue.=",place='".$place."'";
			$columnvalue.=",jszc='".$jszc."'";
			$columnvalue.=",gzjy='".$gzjy."'";
			$columnvalue.=",gzjl='".$gzjl."'";	
			$columnvalue.=",status='".$status."'";		
			$columnvalue.=",gxtime='".$gxtime."'";	
			$sql="update ".PRE."member_resume set ".$columnvalue." where memid='".$memid."' ";

			$db->query($sql) or die("SQL execution error!-modify PageUserUpdateResume");
			echo "<SCRIPT LANGUAGE='JavaScript'>alert('简历修改成功！');window.location.href='/user?$url';</SCRIPT>";
		}else{
			//保存账户扩展信息
			$column="";
			$column.="xingming";
			$column.=",sex";
			$column.=",borndate";
			$column.=",sfzno";
			$column.=",mz";
			$column.=",jycd";
			$column.=",byxx";
			$column.=",mobile";
			$column.=",email";
			$column.=",qq";
			$column.=",gz";
			$column.=",place";
			$column.=",jszc";
			$column.=",gzjy";
			$column.=",gzjl";	
			$column.=",status";		
			$column.=",gxtime";	
			
			//保存账户扩展信息
			$columnvalue="";
			$columnvalue.="'".$xingming."'";
			$columnvalue.=",'".$sex."'";
			$columnvalue.=",'".$borndate."'";
			$columnvalue.=",'".$sfzno."'";
			$columnvalue.=",'".$mz."'";
			$columnvalue.=",'".$jycd."'";
			$columnvalue.=",'".$byxx."'";
			$columnvalue.=",'".$mobile."'";
			$columnvalue.=",'".$email."'";
			$columnvalue.=",'".$qq."'";
			$columnvalue.=",'".$gz."'";
			$columnvalue.=",'".$place."'";
			$columnvalue.=",'".$jszc."'";
			$columnvalue.=",'".$gzjy."'";
			$columnvalue.=",'".$gzjl."'";	
			$columnvalue.=",'".$status."'";	
			$columnvalue.=",'".$gxtime."'";	
		
			$sql="insert into".PRE."member_resume (".$column.") values(".$columnvalue.")";
			//echo $sql;
			//exit;
			$db->query($sql) or die("SQL execution error!-modify PageUserUpdateResume");
			echo "<SCRIPT LANGUAGE='JavaScript'>alert('简历保存成功！');window.location.href='/user?$url';</SCRIPT>";
			exit;
		}
	}	
	//会员应聘列表
	function Pagejobapplylist($tmpsql,$pagesize,$arrparam){
		global $db,$func,$type,$cidy;
		$page2=isset($_GET['page']) ? $_GET['page'] :1;
		$flag=isset($_GET['flag']) ? $_GET['flag'] :1;
 
		$sql=$tmpsql;
		$arr=$func->get_page_num($sql,$pagesize);
		$sql.=" limit $arr[1], $pagesize";

		$rs=$db->query($sql);// or die("SQL execution error！")
		
		echo "<table class=\"table table-hover\">
        <tr>
          <th>应聘职位</th>
          <th>招聘公司</th>
          <th>应聘时间</th>
          <th>应聘状态</th>
          <th width=\"100\">操作</th>
        </tr>";
		
		while($row = $db->fetch_array($rs)){
				$targeturl="/plus/jobview.php?id=".$row['id'];
 				$status="";
				$link="";
				if ($row["applystatus"]==0){
					$status="<font color=blue>待处理</font>";
					$link="<a href=\"/user?page=".$page2."&action=jobapply&op=del&id=".$row['id']."&".$arrparam."\" onClick=\"return confirm('确定要删除吗？此操作将不可撤销');\">删除</a>";
				}elseif($row["applystatus"]==1){
					$status="<font color=green>应聘成功</font>";
				}elseif($row["applystatus"]==-1){
					$status="<font color=red>应聘失败</font>";
				}
				echo "<tr onMouseOver=\"this.className='on';\" onMouseOut=\"this.className='';\">
          <td><a href=\"".$targeturl."\" target=\"_blank\" class=\"t\">".$row['jobname']."</a></td>
          <td>".$this->getcompanyname($row['companyid'])."</td>
          <td>".$func->format_datetime($row['applytime'])."</td>
          <td>".$status."</td>
          <td>".$link."</td>
        </tr>";
		}
		echo "</table>";
		
		new cmspage($arr[0],$pagesize,$arrparam);
	}
	//删除应聘
	function PageApplyDel() {
		global $db;
 
		$act=isset($_GET['act']) ? $_GET['act'] : '';
		$page=isset($_GET['page']) ? $_GET['page'] : '';
		$url="page=$page&action=jobapply";
		$sql = "delete from `".PRE."member_jobapply` where `id` in (".$_GET['id'].")";
		$db->query($sql) or die("SQL execution error!");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='/user?$url';</SCRIPT>";
		exit;
	}
	
	//项目经理搜索技工信息
	function PageResumSearchlist($tmpsql,$pagesize,$arrparam){
		global $db,$func,$type,$cidy;
		$page2=isset($_GET['page']) ? $_GET['page'] :1;
		$flag=isset($_GET['flag']) ? $_GET['flag'] :1;
 
		$sql=$tmpsql;
		$arr=$func->get_page_num($sql,$pagesize);
		$sql.=" limit $arr[1], $pagesize";

		$rs=$db->query($sql);// or die("SQL execution error！")
		
		echo "";
		
		while($row = $db->fetch_array($rs)){
			$targeturl="/plus/resumeview.php?id=".$row['memid'];
			echo "<li class=\"user-header\" style=\"float:left; margin:5px 10px;\">
					<a href=\"".$targeturl."\" target=_blank>
					<img src=\"".$func->getrealpath2($row['pic'])."\" class=\"img-circle\"  height=\"120\" width=\"120\">
					<p align=\"center\">
					  <div align=\"center\" style=\"font-size:1.2em;\"></div>
					  <div class=\"am-gallery-desc am-text-center\"  align=\"center\">".$row['xingming']." ".$row['gz']."</div>
					  <div class=\"am-gallery-desc am-text-center\"  align=\"center\">技工编号：".$row['usercode']."</div>
					</p>
					</a>
					</li>";
		}
		new cmspage($arr[0],$pagesize,$arrparam);
	}	
	
	
	//修改企业信息
	function PageCompanyUpdateBaseInfo(){
		global $db,$func,$session_uid;
		$photo="";
		$photo2="";
		//上传的图片验证
		$filesize	       =$_FILES['file']['size'];
		if ($filesize>0){
 			$func->checkupload("file");
			$upfile = new upfilenew("file");
			$upfile->file_subfolder="logo";	
			$upfile->is_upload_file();
			$upfile->check_file_name();
			$upfile->is_big();
			$upfile->check_type();
			$result=$upfile->upload_file(0,200,200);
			$photo=str_replace("../","/",$result);
		}
		$companylogo  =$photo; 	
		
		//上传的营业执照
		$filesize2	       =$_FILES['yyzz']['size'];
		if ($filesize2>0){
 			$func->checkupload("yyzz");
			$upfile2 = new upfilenew("yyzz");
			$upfile2->file_subfolder="yyzz";	
			$upfile2->is_upload_file();
			$upfile2->check_file_name();
			$upfile2->is_big();
			$upfile2->check_type();
			$result2=$upfile2->upload_file(0,200,200);
			$photo2=str_replace("../","/",$result2);
		}
		$yyzz  =$photo2; 
		
		$companyname  =$_POST['companyname'];		
		$companytype  =$_POST['companytype'];		
		$setupdate    =$_POST['setupdate'];
 		$employeenum  =$_POST['employeenum'];
		$place        =$_POST['province']."-".$_POST['city']; 	
		$teleno       =$_POST['teleno']; 	
		$fax          =$_POST['fax'];		
		$address      =$_POST['address'];		
		$postcode     =$_POST['postcode'];
 		$http         =$_POST['http'];
		$email        =$_POST['email']; 	 
 		$profile      =$_POST['profile'];
		$gxtime       =date('Y-m-d H:i:s');
 
		//搜索条件参数
		$url          ="action=companyinfo";

		//取得最新的会员id
		$memid = $session_uid;
 	
		//保存账户扩展信息
		$columnvalue="";
		$columnvalue.="companyname='".$companyname."'";
		$columnvalue.=",companytype='".$companytype."'";
		$columnvalue.=",setupdate='".$setupdate."'";
		$columnvalue.=",employeenum='".$employeenum."'";
		$columnvalue.=",place='".$place."'";
		$columnvalue.=",teleno='".$teleno."'";
		$columnvalue.=",fax='".$fax."'";
		$columnvalue.=",address='".$address."'";
		$columnvalue.=",postcode='".$postcode."'";
		$columnvalue.=",http='".$http."'";
		$columnvalue.=",email='".$email."'";
		$columnvalue.=",profile='".$profile."'";	
		$columnvalue.=",gxtime='".$gxtime."'";	
		$columnvalue.=",flag='1'";	
		
		if ($companylogo!=""){
			$columnvalue.=",companylogo='".$companylogo."'";
 		}
		if ($yyzz!=""){
			$columnvalue.=",yyzz='".$yyzz."'";
 		}
		$sql="update ".PRE."member_company set ".$columnvalue." where memid='".$memid."' ";

		$db->query($sql) or die("SQL execution error!-modify PageCompanyUpdateBaseInfo");
		
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('保存成功！');window.location.href='/user?$url';</SCRIPT>";
		exit;
	}	
	
	
	//企业项目列表
	function PageProjectList($tmpsql,$pagesize,$arrparam){
		global $db,$func,$type;
		$page2=isset($_GET['page']) ? $_GET['page'] :1;
		$flag=isset($_GET['flag']) ? $_GET['flag'] :1;
 
		$sql=$tmpsql;
		$arr=$func->get_page_num($sql,$pagesize);
		$sql.=" limit $arr[1], $pagesize";
		$rs=$db->query($sql);
		
		$result= "<table class=\"table table-hover\">
					<tr>
					<th width=\"80\" align=center>项目图片</th>
					<th>项目名称</th>
					<th width=\"100\" align=center>更新日期</th>
					<th width=\"100\" align=center>操作</th>
					</tr>";
		while($row = $db->fetch_array($rs)){
				$targeturl="/user?page=".$page2."&op=edit&id=".$row['id']."&".$arrparam."";
 				$status="";
				$link="";
				$link="<a href=\"/user?page=".$page2."&op=edit&id=".$row['id']."&".$arrparam."\" );\">修改</a> <a href=\"/user?page=".$page2."&op=del&id=".$row['id']."&".$arrparam."\" onClick=\"return confirm('确定要删除吗？此操作将不可撤销');\">删除</a>";
				$result.="<tr onMouseOver=\"this.className='on';\" onMouseOut=\"this.className='';\">";
				$result.="<td><img src=\"".$func->getrealpath2($row['pic'])."\" width=30 height=30 border=0></td>";
				$result.="<td><a href=\"".$targeturl."\"  class=\"t\">".$row['projectname']."</a></td>";
				$result.="<td>".$func->format_datetime($row['gxtime'])."</td>";
				$result.="<td>".$link."</td>";
				$result.="</tr>";
		}
		$result.="</table>";
		if ($arr[0]>0){
			echo $result;
			new cmspage($arr[0],$pagesize,$arrparam);
		}else{
			echo "<div  align=center>目前还没有发布项目信息！赶快去<a href=\"/user/?action=project&op=edit\">发布项目</a>信息吧！</div>";
		}
	}	
	
	//删除项目
	function PageProjectDel() {
		global $db;
 
		$act=isset($_GET['act']) ? $_GET['act'] : '';
		$page=isset($_GET['page']) ? $_GET['page'] : '';
		$url="page=$page&action=project";
		$sql = "delete from `".PRE."member_project` where `id` in (".$_GET['id'].")";
		$db->query($sql) or die("SQL execution error!");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='/user?$url';</SCRIPT>";
		exit;
	}
	
 	//添加项目
	function PageProjectAdd() {
		global $db,$func,$session_uid;
		$photo="";
		//上传的图片验证
		$filesize	       =$_FILES['file']['size'];
		if ($filesize>0){
 			$func->checkupload("file");
			$upfile = new upfilenew("file");
			$upfile->file_subfolder="project";	
			$upfile->is_upload_file();
			$upfile->check_file_name();
			$upfile->is_big();
			$upfile->check_type();
			$result=$upfile->upload_file(0,200,200);
			$photo=str_replace("../","/",$result);
		}
		$companyid=isset($_POST['companyid'])?$_POST['companyid']:0;	
		$memid=isset($_POST['memid'])?$_POST['memid']:0;				
		$projectname=($_POST['projectname']);	
		$pic=$photo;	
		$major=$_POST['major']; 	
		$introduction=$_POST['introduction'];	
		$address=$_POST['xmplace'];				
		$address=$_POST['address'];		
		$addtime=date('Y-m-d H:i:s'); 
 		$gxtime=$addtime;
		
		//保存项目信息
		$column="";
		$column.="memid";
		$column.=",projectname";
		$column.=",pic";		
		$column.=",major";
		$column.=",introduction";
		$column.=",xmplace";		
		$column.=",address";
		$column.=",gxtime";
		$column.=",addtime";
		
		$columnvalue="";
		$columnvalue.="'".$companyid."'";
		$columnvalue.=",'".$projectname."'";
		$columnvalue.=",'".$pic."'";	
		$columnvalue.=",'".$major."'";
		$columnvalue.=",'".$introduction."'";
		$columnvalue.=",'".$xmplace."'";		
		$columnvalue.=",'".$address."'";
		$columnvalue.=",'".$gxtime."'";
		$columnvalue.=",'".$addtime."'";		
		
		$sql="insert into ".PRE."member_project(".$column.") values (".$columnvalue.")";

		$db->query($sql) or die("SQL execution error!-401 PageProjectAdd");
		$url="action=project";
		
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('提交成功！');window.location.href='/user/?$url';</SCRIPT>";
		exit;
 
	}
 
	//修改项目
	function PageProjectUpdate() {
		global $db,$func,$log;
		$photo="";
		//上传的图片验证
		$filesize	       =$_FILES['file']['size'];
		if ($filesize>0){
 			$func->checkupload("file");
			$upfile = new upfilenew("file");
			$upfile->file_subfolder="project";	
			$upfile->is_upload_file();
			$upfile->check_file_name();
			$upfile->is_big();
			$upfile->check_type();
			$result=$upfile->upload_file(0,200,200);
			$photo=str_replace("../","/",$result);
		}
		$companyid=isset($_POST['companyid'])?$_POST['companyid']:0;	
		$projectname=($_POST['projectname']);	
		$major=$_POST['major']; 	
		$introduction=$_POST['introduction'];
		$xmplace=$_POST['xmplace'];					
		$address=$_POST['address'];		
 		$pic=$photo;
		$addtime=date('Y-m-d H:i:s'); 
 		$gxtime=$addtime;
		$istj=isset($_POST['istj']) ? $_POST['istj'] :0;	
		
		$act=isset($_POST['act']) ? $_POST['act'] : '';
		$keyword=isset($_POST['keyword']) ? $_POST['keyword'] : '';
		$page=isset($_POST['page']) ? $_POST['page'] :1;
		$sdate=isset($_POST['sdate']) ? $_POST['sdate'] : '';
		$edate=isset($_POST['edate']) ? $_POST['edate'] : '';	
			
		$url="page=".$page."&action=project";

		//取得项目信息ID
		$projectid = $_GET['id'];
 
		//保存项目信息
		$columnvalue="";
		$columnvalue.="memid='".$companyid."'";
		$columnvalue.=",projectname='".$projectname."'";
		$columnvalue.=",major='".$major."'";
		$columnvalue.=",introduction='".$introduction."'";
		$columnvalue.=",xmplace='".$xmplace."'";		
		$columnvalue.=",address='".$address."'";
		$columnvalue.=",gxtime='".$gxtime."'";
		if ($pic!=""){
		$columnvalue.=",pic='".$pic."'";
		}
		$sql="update ".PRE."member_project set ".$columnvalue." where id=".$projectid."";
		$db->query($sql) or die("SQL execution error!-modify PageProjectUpdate");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('修改成功！');window.location.href='/user/?$url';</SCRIPT>";
		exit;
	}
	
	//企业职位列表
	function PageJobList($tmpsql,$pagesize,$arrparam){
		global $db,$func,$type,$cidy;
		$page2=isset($_GET['page']) ? $_GET['page'] :1;
		$flag=isset($_GET['flag']) ? $_GET['flag'] :1;
 
		$sql=$tmpsql;
		$arr=$func->get_page_num($sql,$pagesize);
		$sql.=" limit $arr[1], $pagesize";

		$rs=$db->query($sql);// or die("SQL execution error！")
		
		echo "<table class=\"table table-hover\">
        <tr>
          <th>职位名称</th>
          <th>工作地点</th>

          <th width=\"100\">操作</th>
        </tr>";
		
		while($row = $db->fetch_array($rs)){
				$targeturl="/plus/jobview.php?id=".$row['id'];
 				$status="";
				$link="";
				if ($row["applystatus"]==0){
					$link="<a href=\"/user?page=".$page2."&op=edit&id=".$row['id']."&".$arrparam."\" );\">修改</a> <a href=\"/user?page=".$page2."&op=del&id=".$row['id']."&".$arrparam."\" onClick=\"return confirm('确定要删除吗？此操作将不可撤销');\">删除</a>";
				}
				echo "<tr onMouseOver=\"this.className='on';\" onMouseOut=\"this.className='';\">
					  <td><a href=\"".$targeturl."\" target=\"_blank\" class=\"t\">".$row['jobname']."</a></td>
					  <td>".$row['place']."</td>
					  <td>".$link."</td>
					</tr>";
		}
		echo "</table>";
		
		new cmspage($arr[0],$pagesize,$arrparam);
	}
	
 	//添加职位
	function PageJobAdd() {
		global $db,$func,$session_uid;
		$memid=isset($_POST['companyid'])?$_POST['companyid']:0;	
		$xmid=isset($_POST['xmid'])?$_POST['xmid']:0;				
		$jobname=($_POST['jobname']);	
		$zgtype=$_POST['zgtype'];
		$xlyq=$_POST['xlyq']; 	
		$xbyq=$_POST['xbyq'];
		$nlyq=$_POST['nlyq'];		
		$gznxyq=$_POST['gznxyq'];		
		$place=$_POST['province']."-".$_POST['city'];
		$jobnum=($_POST['jobnum']);	
		$salary_s=$_POST['salary_s']; 	
		$salary_e=$_POST['salary_e'];		
		$jobcontent=$_POST['jobcontent'];		
 		$endtime=$_POST['endtime'];
		$addtime=date('Y-m-d H:i:s'); 
 		$gxtime=$addtime;
		
		//保存项目信息
		$column="";
		$column.="memid";
		$column.=",xmid";
		$column.=",jobname";
		$column.=",zgtype";		
		$column.=",xlyq";
		$column.=",xbyq";
		$column.=",nlyq";		
		$column.=",gznxyq";
		$column.=",place";
		$column.=",jobnum";
		$column.=",salary_s";
		$column.=",salary_e";		
		$column.=",jobcontent";
		if ($endtime!=""){
		$column.=",endtime";
		}			
		$column.=",gxtime";
		$column.=",addtime";
			
		$columnvalue="";
		$columnvalue.="'".$memid."'";
		$columnvalue.=",'".$xmid."'";
		$columnvalue.=",'".$jobname."'";
		$columnvalue.=",'".$zgtype."'";		
		$columnvalue.=",'".$xlyq."'";
		$columnvalue.=",'".$xbyq."'";
		$columnvalue.=",'".$nlyq."'";		
		$columnvalue.=",'".$gznxyq."'";
		$columnvalue.=",'".$place."'";
		$columnvalue.=",'".$jobnum."'";	
		
		$columnvalue.=",'".$salary_s."'";
		$columnvalue.=",'".$salary_e."'";
		$columnvalue.=",'".$jobcontent."'";
		if ($endtime!=""){
		$columnvalue.=",'".$endtime."'";
		}
		$columnvalue.=",'".$gxtime."'";
		$columnvalue.=",'".$addtime."'";			
		
		$sql="insert into ".PRE."member_job(".$column.") values (".$columnvalue.")";

		$db->query($sql) or die("SQL execution error!-401 PageJobAdd");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='/user/?action=job';</SCRIPT>";
	    exit;
	}
 
	//修改职位
	function PageJobUpdate() {
		global $db,$func,$log;
		$memid=isset($_POST['companyid'])?$_POST['companyid']:0;	
		$xmid=isset($_POST['xmid'])?$_POST['xmid']:0;				
		$jobname=($_POST['jobname']);
		$zgtype=$_POST['zgtype']; 	
		$xlyq=$_POST['xlyq']; 	
		$xbyq=$_POST['xbyq'];
		$nlyq=$_POST['nlyq'];		
		$gznxyq=$_POST['gznxyq'];		
		$place=$_POST['province']."-".$_POST['city'];
		$jobnum=($_POST['jobnum']);	
		$salary_s=$_POST['salary_s']; 	
		$salary_e=$_POST['salary_e'];		
		$jobcontent=$_POST['jobcontent'];		
 		$endtime=$_POST['endtime'];
		$addtime=date('Y-m-d H:i:s'); 
 		$gxtime=$addtime;
		
		$page=isset($_POST['page']) ? $_POST['page'] :1;	
				
		$url="page=".$page."&action=job";

		//取得项目信息ID
		$jobid = $_GET['id'];
 
		//保存项目信息
		$columnvalue="";
		$columnvalue.="memid='".$memid."'";
		$columnvalue.=",xmid='".$xmid."'";
		$columnvalue.=",jobname='".$jobname."'";
		$columnvalue.=",zgtype='".$zgtype."'";
		$columnvalue.=",xlyq='".$xlyq."'";
		$columnvalue.=",xbyq='".$xbyq."'";
		$columnvalue.=",nlyq='".$nlyq."'";		
		$columnvalue.=",gznxyq='".$gznxyq."'";
		$columnvalue.=",place='".$place."'";
		$columnvalue.=",jobnum='".$jobnum."'";
		$columnvalue.=",salary_s='".$salary_s."'";
		$columnvalue.=",salary_e='".$salary_e."'";
		$columnvalue.=",jobcontent='".$jobcontent."'";
		$columnvalue.=",endtime='".$endtime."'";
		$columnvalue.=",gxtime='".$gxtime."'";		
 
		$sql="update ".PRE."member_job set ".$columnvalue." where id=".$jobid."";

		$db->query($sql) or die("SQL execution error!-modify PageJobUpdate");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('修改成功！');window.location.href='/user/?$url';</SCRIPT>";
		exit;
	}
	
	//删除职位
	function PageJobDel() {
		global $db;
		$act=isset($_GET['act']) ? $_GET['act'] : '';
		$page=isset($_GET['page']) ? $_GET['page'] : '';
		$url="page=$page&action=job";
		$sql = "delete from `".PRE."member_job` where `id` in (".$_GET['id'].")";
		$db->query($sql) or die("SQL execution error!");
		echo "<SCRIPT LANGUAGE='JavaScript'>alert('删除成功！');window.location.href='/user/?$url';</SCRIPT>";
		exit;
	}
	
 	//首页统计会员总数
	function GetUserCount($usertype){
		global $db,$func;
		$gourl="";
		$tsql="select count(*)  from `".PRE."member` where gradeid='".$usertype."'";
		$rst=mysql_query($tsql) or die ("SQL execution error!ErrCode:GetUserCount");
		$okt=is_array($rowt=mysql_fetch_array($rst));
		return $rowt[0];
	}
	
	//找回密码
	function GetFindPwd($username,$email,$yourname){
		global $db,$func,$smtpmail,$site_webname;
		$tsql="select a.*  from ".PRE."member a left outer join ".PRE."member_personal b on a.id=b.memid left outer join ".PRE."member_company c on a.id=c.memid   where  a.username='".$username."' and (b.xingming='".$yourname."' or c.companyname='".$yourname."')";
		$rst=mysql_query($tsql) or die ("SQL execution error!");
		$okt=is_array($rowt=mysql_fetch_array($rst));
		if ($okt){
			$defaultpwd=md5("123456");
			$sql="update ".PRE."member set password='".$defaultpwd."' where id=".$rowt['id']."";
			$db->query($sql) or die("SQL execution error!");
			
			//通过邮件找回密码信息
			$mailto          = $email; //发送至邮箱
			$subject     = "【".$site_webname."】找回密码通知！";
			$body        = "".$username."，您的密码已设置为:123456,请尽快登录修改密码！";
			//$send=$smtpmail->sendemail($mailto,$subject,$body);
		
			$func->GoAlertUrl($body,"/user/forgetpwd.php");
		}else{
			$func->GoAlertUrl("您填写的信息不匹配，请重试！","/user/forgetpwd.php");
		}
	}
	
	
	/**只能登录的企业会员才能进行查看***/
	function checkResumePermission(){
		global $db,$func,$session_uid,$session_usertype;
		if ($session_uid=="" || $session_uid==null){
			$message="Sorry,当前操作需要企业用户登录后才可以访问！";
			$func->showMessage($message);
		}elseif ($session_usertype!=2){
			$message="Sorry,当前操作只允许企业用户访问！";
			$func->showMessage($message);
		}		
	}
	
	/**个人会员登录后，并且资料完整才能进行查看***/
	function checkJobPermission(){
		global $db,$func,$session_uid,$session_usertype;
		
		if ($session_uid==""){
			$message="Sorry,当前操作需要会员登录后才可以访问！";
			$func->showMessage($message);

		}else{
			if ($session_usertype==1){
				$tsql="select flag from ".PRE."member_personal  where  memid=".$session_uid;
				$rst=mysql_query($tsql) or die ("SQL execution error!");
				$rowt=mysql_fetch_array($rst);
				if ($rowt['flag']==0){
					$message="Sorry,您还没有填写完整的资料！";
					$func->showMessageUrl($message,"/user/?action=baseinfo");
				}
			}
		}

		
	}
	
	/**企业会员认证后，才可以进行操作***/
	function checkCompanyRZPermission(){
		global $db,$func,$session_uid,$session_usertype;
		
		if ($session_uid==""){
			$message="Sorry,当前操作需要登录认证后才可以访问！";
			$func->showMessage($message);

		}else{
			if ($session_usertype==2){
				$tsql="select ischeck from ".PRE."member  where  id=".$session_uid;
				$rst=mysql_query($tsql) or die ("SQL execution error!");
				$rowt=mysql_fetch_array($rst);
				if ($rowt['ischeck']==0){
					$message="Sorry,您目前还未通过认证，认证后才可访问！";
					$func->showMessage($message);
				}
			}
		}

		
	}
}
?>