function getResource(ids, parentId, types){     
	var resource = document.getElementById(ids);  

	if(resource.checked==true){   
		fresourceChecked(resource.id,resource.getAttribute('pId'));   
		sresourceChecked(resource.id,resource.getAttribute('pId'));                    
		resource.checked=true;   
	}else{   
		  unResourceChecked(resource.id,resource.getAttribute('pId'));     
		  resource.checked=false;      
	}   
}    
function fresourceChecked(ids,parentId){   
   var resource = document.getElementsByName('itemcode');   
   for(var i = 0;i<resource.length;i++){   
	   if(resource[i].id==parentId){   
		  resource[i].checked = true;    
		  fresourceChecked(resource[i].id,resource[i].getAttribute('pId'));   
	   }   
   }     
}   
   
function sresourceChecked(ids,parentId){   
   var resource = document.getElementsByName('itemcode');   
   for(var i = 0;i<resource.length;i++){   
	   if(resource[i].getAttribute('pId')==ids){   
		  resource[i].checked = true;    
		  sresourceChecked(resource[i].id,resource[i].getAttribute('pId'));   
	   }   
   }     
}   
	
function unResourceChecked(ids,parentId){   
	 var resource = document.getElementsByName('itemcode');   
	 for(var i = 0;i<resource.length;i++){   
	   if(resource[i].getAttribute('pId')==ids){   
		  resource[i].checked = false;   
		  unResourceChecked(resource[i].id,resource[i].getAttribute('pId'));   
	   }   
   }           
}   
function CheckAll(form)  
{
  var svalue="";
  var k=1;
  var obj=eval(form)
  for (var i=0;i<obj.elements.length;i++)    
  {
    var e = obj.elements[i];
	e.checked = !e.checked; 
	k=k+1;
   }
} 