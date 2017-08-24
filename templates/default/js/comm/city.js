//选择省份城市框
function CallCity(sDiv,sType){
	if (sType==1){
	ChangeCity('pd_condiv',1);
	$('#'+sDiv).css('display','block');
	}else{
	$('#'+sDiv).css('display','none');
	}
}
//设置省份
function SelProvince(sDivCon,sDiv,sValue){
	$('#'+sDiv).val(sValue);
	//切换省份到城市
	$('#province').removeClass('pd_seldiv');
	$('#province').addClass('pd_nosel');
	
	$('#city').removeClass('pd_nosel');
	$('#city').addClass('pd_seldiv');
	
	//获取下属城市
	var rethtml=ShowCity(sValue);
	$('#'+sDivCon).html(rethtml);
}
//设置省份
function SelCity(sDivCon,sDiv,sValue){
	$('#'+sDiv).val(sValue);
 	CallCity(sDivCon,0);
}
//省份与城市切换
function ChangeCity(sDivCon,sType){
 
	var rethtml="";

	if (sType==1){//显示省份数据
			//切换省份到城市
		$('#province').removeClass('pd_nosel');
		$('#province').addClass('pd_seldiv');
 
		$('#city').removeClass('pd_seldiv');
		$('#city').addClass('pd_nosel');
		rethtml=ShowProvince();
	}else if (sType==0){
		//切换省份到城市
		$('#province').removeClass('pd_seldiv');
		$('#province').addClass('pd_nosel');
		
		$('#city').removeClass('pd_nosel');
		$('#city').addClass('pd_seldiv');
		rethtml="";
	}
	$('#'+sDivCon).html(rethtml);
}

//选择二级城市
function ShowProvince(){
	var result="";
	for (var i=0;i < onecount; i++){
		if (subcat[i][2]=='0'){ 
			result=result+"<a href=\"javascript:;\" onclick=\"SelProvince('pd_condiv','place','"+subcat[i][1]+"');\">"+subcat[i][1]+"</a>";
		}        
	}
	return result;
}  

function ShowCity(sValue){
	var result="";
	for (var i=0;i < onecount; i++){
		if (subcat[i][3]==sValue){ 
			result=result+"<a href=\"javascript:;\" onclick=\"SelCity('placeholder','place','"+sValue+'-'+subcat[i][1]+"');\">"+subcat[i][1]+"</a>";
		}        
	}
	return result;
}  

//--------------------------------------------------------
//选择授课领域
function CallTeachField(sDiv,sType){
	if (sType==1){
	$('#'+sDiv).css('display','block');
	}else{
	$('#'+sDiv).css('display','none');
	}
}
//搜索授课领域
function teachfieldSelAll(){
  var str="";
  var obj=document.getElementsByName("teachfield");
  var k=0;
  for(var i=0;i<obj.length;i++){
    if(obj[i].checked){
		k=k+1;
		if (k==1){
			str+=obj[i].value;
		}else{
			str+=","+obj[i].value;	
		}
     }
  }
  return str;
}
//取得授课领域
function getSelectStr(){
	 var str=teachfieldSelAll();
	 return str;
}
//选择授课领域
function configselfield(){
	var ret=getSelectStr();
	document.getElementById('teachfield').value=ret;
	CallTeachField('placeholder_field',0);
}
//--------------------------------------------------------

//选择擅长行业
function CallTradeField(sDiv,sType){
	if (sType==1){
	$('#'+sDiv).css('display','block');
	}else{
	$('#'+sDiv).css('display','none');
	}
}

//搜索擅长行业
function teachtradeSelAll(){
  var str="";
  var obj=document.getElementsByName("teachtrade");
  var k=0;
  for(var i=0;i<obj.length;i++){
    if(obj[i].checked){
		k=k+1;
		if (k==1){
			str+=obj[i].value;
		}else{
			str+=","+obj[i].value;	
		}
     }
  }
  return str;
}

//取得擅长行业
function getSelectStr_trade(){
	 var str=teachtradeSelAll();
	 return str;
}

//选择擅长行业
function configseltrade(){
	var ret=getSelectStr_trade();
	document.getElementById('teachtrade').value=ret;
	CallTradeField('placeholder_trade',0);
}