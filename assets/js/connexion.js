
function processJson(data) { 
	if(data.id_utilisateur < 1){
		$('#msg').html('<div class="error">Veuillez verifier votre mail/mots de passe</div>');
	}else{
		//alert(base_url);
		if(data.type_utilisateur == 1){
			$(location).attr('href' , base_url + "admin.html");
		}else if(data.type_utilisateur == 2){
			$(location).attr('href' , base_url + "espace-chirurgien.html");
		}else if(data.type_utilisateur == 3){
			$(location).attr('href' , base_url + "espace-chirurgien.html");
		}else if(data.type_utilisateur == 4){
			$(location).attr('href' , base_url + "espace-client.html");
		}
	}
}
$(document).ready(function() {
	$("#connexion").validate({
		rules: {
			pass: {
				required: true,
			},
			email: {
				required: true,
				email: true
			}
		},
		messages: {
			username: {
				required: "Please enter a username",
				minlength: "Your username must consist of at least 2 characters"
			},
			pass: {
				required: "Please provide a password",
			},
			email: "Please enter a valid email address"
		}
	});
    var options = { 
		dataType:  'json', 
        beforeSubmit:  validate,     // pre-submit callback 
		beforeSend: function() {
			$('#msg').html('<img src="' + base_url + 'assets/images/loader.gif"> En cours');
		},
        success:       processJson  // post-submit callback 
    };
    $('#connexion').ajaxForm(options); 
	
});
function validate(){
	return $('#connexion').valid();
}