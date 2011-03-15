
	(function($) {
	    $(document).ready(function() {	         
	         
	         if($(".markdown").length) {
	         	
	         	$("textarea.markdown").markItUp(mySettings);
	         	
	         } else if ($(".textile").length) {
	         
	         	$(".textarea.markdown").markItUp(mySettings);
	         }
	              
	    });
	})(jQuery.noConflict());