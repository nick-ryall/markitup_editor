(function($) {
	// Where mySettings is defined in either /sets/Markdown/markitup.set.js
	// or /sets/textile/markitup.set.js
	$(document).ready(function() {
		$("textarea").filter(function() {
			return this.className.search(/(markdown|textile)/i) !== -1
		}).markItUp(mySettings);
	});
})(jQuery.noConflict());