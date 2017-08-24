function CheckAll(form)  {
  for (var i=0;i<form.elements.length;i++)    {
    var e = form.elements[i];
    if (e.name != 'chkall')    
	   e.checked = form.chkall.checked; 
   }
 
  }
  
  function searchAll(){
  var str="";
  var obj=document.getElementsByName("aid");
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

//删除
function del(obj){
	 var str=searchAll();
	 if (str=="")
	 {
		alert("你尚未选择任何删除项");
		return false; 
	 }
	 else
	 {
		 var count=str.split(",").length;
		 if(count<0){alert("你尚未选择任何删除项");return false;}
			if(confirm("你确定删除这"+count+"项条目吗？")){
				obj.delaid.value=str;
				obj.submit();
			}else{
				return false;
			}
	 }
}
function transdata(obj){

	 var str=searchAll();
	 if (str=="")
	 {
		alert("你尚未选择任何转移项");
		return false; 
	 }
	 else
	 {
		 var count=str.split(",").length;
		 if(count<0){alert("你尚未选择任何转移项");return false;}
			if(confirm("你确定转移这"+count+"项条目吗？")){
				obj.delaid.value=str;
				obj.action="transdata.php";
				obj.submit();
			}else{
				return false;
			}
	 }
}
//审核通过
function datapass(obj){

	 var str=searchAll();
	 if (str=="")
	 {
		alert("你尚未选择任何项");
		return false; 
	 }
	 else
	 {
		 var count=str.split(",").length;
		 if(count<0){alert("你尚未选择任何项");return false;}
			if(confirm("你确定对这"+count+"项通过审核吗？")){
				obj.delaid.value=str;
				obj.action="datapass.php";
				obj.submit();
			}else{
				return false;
			}
	 }
}
//审核不通过
function datapassno(obj){
	 var str=searchAll();
	 if (str=="")
	 {
		alert("你尚未选择任何项");
		return false; 
	 }
	 else
	 {
		 var count=str.split(",").length;
		 if(count<0){alert("你尚未选择任何项");return false;}
			if(confirm("你确定对这"+count+"项取消审核吗？")){
				obj.delaid.value=str;
				obj.action="datapassno.php";
				obj.submit();
			}else{
				return false;
			}
	 }
}
function configdel(){
	if(confirm("你确认要删除吗？")){ 
		return true;
	}else{ 
		return false;	
	}
}
function configdel_news(){
	if(confirm("专题下属文章将被删除，你确认要删除吗？")){ 
		return true;
	}else{ 
		return false;	
	}
}
function configdel_all(){
	if(confirm("你确认要删除吗？讲师相关信息将一起被删除！")){ 
		return true;
	}else{ 
		return false;	
	}
}