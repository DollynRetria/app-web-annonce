/*$(document).ready(function() {
	$('#close').click(function(e){
		e.preventDefault();
		$("fieldset#signin_menu").slideUp();
	});
	$(".login").click(function(e) {
		e.preventDefault();
		$("fieldset#signin_menu").toggle();
		$(".login").toggleClass("menu-open");
	});

	$("fieldset#signin_menu").mouseup(function() {
		return false
	});
});
$(document).mouseup(function(e) {
	if($(e.target).parent("a.login").length==0) {
		$(".login").removeClass("menu-open");
		$("fieldset#signin_menu").hide();
	}
});*/