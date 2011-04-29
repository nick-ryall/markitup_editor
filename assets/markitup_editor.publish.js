
	(function($) {
	    $(document).ready(function() {	         
	         
	         if($(".markdown").length) {
	         	
	         	$("textarea.markdown").markItUp(mySettings);
	         	
	         } else if ($(".textileplus").length) {

	         	$("textarea.textileplus").markItUp(mySettings);
	         }
	              
	    });
	})(jQuery.noConflict());