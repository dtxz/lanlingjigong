
jQuery(document).ready(function (){

	
    var gotopCon="<div id='gotopDiv' class='goto_top'><a href='#' style='display:block; cursor:pointer; outline:none;'><img src='"+picsrc+"' width='26' height='91' /></a></div>"
	jQuery("body").attr("style","position:relative;overflow-x:auto;_overflow-x:hidden")
	jQuery("body").append(gotopCon);
	jQuery(window).resize(function(){if(jQuery(window).width()<1000){jQuery(window).width(1000)}})
	jQuery("#gotopDiv").click(function(){
		if(jQuery(window).scrollTop()!=0){
				jQuery(window).unbind();
				jQuery("#gotopDiv").hide();
				jQuery("html").scrollTop(0);
				jQuery("body").scrollTop(0);

				jQuery(window).bind('scroll',function(){
					if(jQuery(this).scrollTop() < showDistance){
						jQuery("#gotopDiv").fadeOut("fast");
					}else{
						jQuery("#gotopDiv").fadeIn("fast");
					}
				});
			
		}
	
        return false;
	});
		
		
    if(jQuery(window).scrollTop() < showDistance){jQuery("#gotopDiv").hide();}
    jQuery(window).scroll(function(){
		     if(jQuery(this).scrollTop() < showDistance){
           		jQuery("#gotopDiv").fadeOut("fast");
            }else{
            	jQuery("#gotopDiv").fadeIn("fast");
            }
        });
    });
