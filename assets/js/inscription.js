
	
function processJson(data) { 
	$('#msg').html('<div class="' + data.msg + '">' + data.value);
}
$(document).ready(function() {
	$("#inscription").validate({
		rules: {
			nom: "required",
			prenom: "required",
			username: {
				required: true,
				minlength: 2
			},
			pass: {
				required: true,
				minlength: 5
			},
			confirm_pass: {
				required: true,
				minlength: 5,
				equalTo: "#password"
			},
			jours :{
				required: true,
			},
			mois :{
				required: true,
			},
			annee :{
				required: true,
			},
			tel :{
				required: true,
			},
			email: {
				required: true,
				email: true,
				depends: function(element) {
					testMail();
				  //return $("#contactform_email:checked")
				}
			},
			topic: {
				required: "#newsletter:checked",
				minlength: 2
			},
			cgv: "required"
		},
		messages: {
			nom: "Veuillez entrer votre nom",
			prenom: "Veuillez entrer votre prenom",
			username: {
				required: "Please enter a username",
				minlength: "Your username must consist of at least 2 characters"
			},
			pass: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long"
			},
			confirm_pass: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long",
				equalTo: "Please enter the same password as above"
			},
			email: "Please enter a valid email address",
			cgv: "Please accept our policy"
		}
	});
	
	
    var options = { 
		clearForm: true,
		//resetForm: true,
		dataType    : 'json', 
		
        beforeSubmit: validate,     // pre-submit callback 
		beforeSend  : function() {
			$('#msg').text('En cours');
		},
        success:       processJson  // post-submit callback 
    };
    $('#inscription').ajaxForm(options); 
	
});
function validate(){
	return $('#inscription').valid();
}
function testMail(){
	var mail = $("#email").val();
	var zAction                = base_url + 'client/countMail/' ;
	var tformData = {mail:mail};
	$.ajax({
		url : zAction,
		type: "POST",
		data : tformData,
		success: function(data, textStatus, jqXHR)
		{
			if(data>0){
				$('#mailError').html('Cette mail existe déjà dans notre base de donnée') ;
				$("#send").attr('disabled','disabled');
			}else{
				$("#send").removeAttr('disabled');
				$('#mailError').html('') ;
			}
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
		
		}
	});
}