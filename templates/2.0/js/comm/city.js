//ѡ��ʡ�ݳ��п�
function CallCity(sDiv,sType){
	if (sType==1){
	ChangeCity('pd_condiv',1);
	$('#'+sDiv).css('display','block');
	}else{
	$('#'+sDiv).css('display','none');
	}
}
//����ʡ��
function SelProvince(sDivCon,sDiv,sValue){
	$('#'+sDiv).val(sValue);
	//�л�ʡ�ݵ�����
	$('#province').removeClass('pd_seldiv');
	$('#province').addClass('pd_nosel');
	
	$('#city').removeClass('pd_nosel');
	$('#city').addClass('pd_seldiv');
	
	//��ȡ��������
	var rethtml=ShowCity(sValue);
	$('#'+sDivCon).html(rethtml);
}
//����ʡ��
function SelCity(sDivCon,sDiv,sValue){
	$('#'+sDiv).val(sValue);
 	CallCity(sDivCon,0);
}
//ʡ��������л�
function ChangeCity(sDivCon,sType){
 
	var rethtml="";

	if (sType==1){//��ʾʡ������
			//�л�ʡ�ݵ�����
		$('#province').removeClass('pd_nosel');
		$('#province').addClass('pd_seldiv');
 
		$('#city').removeClass('pd_seldiv');
		$('#city').addClass('pd_nosel');
		rethtml=ShowProvince();
	}else if (sType==0){
		//�л�ʡ�ݵ�����
		$('#province').removeClass('pd_seldiv');
		$('#province').addClass('pd_nosel');
		
		$('#city').removeClass('pd_nosel');
		$('#city').addClass('pd_seldiv');
		rethtml="";
	}
	$('#'+sDivCon).html(rethtml);
}

//ѡ���������
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
//ѡ���ڿ�����
function CallTeachField(sDiv,sType){
	if (sType==1){
	$('#'+sDiv).css('display','block');
	}else{
	$('#'+sDiv).css('display','none');
	}
}
//�����ڿ�����
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
//ȡ���ڿ�����
function getSelectStr(){
	 var str=teachfieldSelAll();
	 return str;
}
//ѡ���ڿ�����
function configselfield(){
	var ret=getSelectStr();
	document.getElementById('teachfield').value=ret;
	CallTeachField('placeholder_field',0);
}
//--------------------------------------------------------

//ѡ���ó���ҵ
function CallTradeField(sDiv,sType){
	if (sType==1){
	$('#'+sDiv).css('display','block');
	}else{
	$('#'+sDiv).css('display','none');
	}
}

//�����ó���ҵ
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

//ȡ���ó���ҵ
function getSelectStr_trade(){
	 var str=teachtradeSelAll();
	 return str;
}

//ѡ���ó���ҵ
function configseltrade(){
	var ret=getSelectStr_trade();
	document.getElementById('teachtrade').value=ret;
	CallTradeField('placeholder_trade',0);
}