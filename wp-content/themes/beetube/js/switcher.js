jQuery(document).ready(function(){
								
jQuery('#style-switch').animate({left:-107});
		
jQuery('#t-row-left-ss').animate({left:0});

var selector = 1;

jQuery('#t-row-left-ss').click(function(){
										
	if (selector == 1) {
	
	jQuery('#style-switch').animate({left:0});
		
	jQuery('#t-row-left-ss').animate({left:107});
	jQuery('#t-row-left-ss').addClass('revers');
	
	

	
	selector = 0;
	
	}
	else {
		
		jQuery('#style-switch').animate({left:-107});
		
	jQuery('#t-row-left-ss').animate({left:0});
		
		selector = 1;
		}
		
		
});
jQuery('.revers').click(function(){
jQuery('#style-switch').animate({left:-107});
		
jQuery('#t-row-left-ss').animate({left:0});
jQuery('#t-row-left-ss').removeClass('revers');
});

});
