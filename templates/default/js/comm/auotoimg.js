
//����ָ����ǩ�����е�ͼƬ��������С
$(".vc").mouseover(function(){
   $(".vc").mouseover(function(){
		$('img').each(function(){ //jquery.each()ѭ����ȡ����ͼƬ
			   var height = $(this).height();
			   var width = $(this).width();
			   if(width>650){
				  $(this).css('width','650px');//�����ȳ���200px,�߶ȵȱ�������
			   }
		});
   });
});