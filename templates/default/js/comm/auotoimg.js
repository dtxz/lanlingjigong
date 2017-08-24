
//设置指定标签内容中的图片不超过大小
$(".vc").mouseover(function(){
   $(".vc").mouseover(function(){
		$('img').each(function(){ //jquery.each()循环读取所有图片
			   var height = $(this).height();
			   var width = $(this).width();
			   if(width>650){
				  $(this).css('width','650px');//如果宽度超过200px,高度等比例缩放
			   }
		});
   });
});