function processJson(data) {
	$('#msg').html(data);
	setTimeout( function() {$.fancybox.close(); },1500);
}
/* partie inscription */
$(document).ready(function() {
	
	$("#inscriptionForm").validate({
		rules: {
			nom: "required",
			prenom: "required",
			username: {
				required: true,
				minlength: 2
			},
			pseudo: {
				required: true,
				minlength: 5,
				depends: function(element) {
					testPseudo();
				}
			},

			pass: {
				required: true,
				minlength: 5
			},
			confirm_pass: {
				required: true,
				minlength: 5,
				equalTo: "#pass"
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
			jours :{
				required: "Ce champ est obligatoire"
			},
			mois :{
				required: "Ce champ est obligatoire"
			},
			annee :{
				required: "Ce champ est obligatoire"
			},
			tel: {
				required: "Ce champ est obligatoire",
			},
			pseudo: {
				required: "Ce champ est obligatoire",
				minlength: "Your password must be at least 5 characters long"
			},

			pass: {
				required: "Veuillez entrer votre mot de passe",
				minlength: "Your password must be at least 5 characters long"
			},
			confirm_pass: {
				required: "Veuillez confirmer votre mot de passe ici",
				minlength: "Your password must be at least 5 characters long",
				equalTo: "Please enter the same password as above"
			},
			email: "Veuillez entrer une adresse email valide",
			cgv: "Please accept our policy"
		},
		groups: {
			username: "jours annee mois"
		},
		errorPlacement: function(error, element) {
			if (element.attr("name") == "jours" || element.attr("name") == "annee" || element.attr("name") == "mois"  ) {
			  error.insertAfter("#annee");
			} else {
			  error.insertAfter(element);
			}
		}
	});
	var options = { 
		//dataType:  'json', 
		beforeSubmit:  validate,     // pre-submit callback 
		beforeSend: function() {
			dataM = '<div><div class="preloader">&nbsp;</div><h3 class="beforeSend">En Cours ...</h3></div>';
			$('#msg').html(dataM);
			$.fancybox({
				'href': '#inline1'
			});
			//$('#msg').text('En cours');
		},
		resetForm : true,
		success:       processJson  // post-submit callback 
	};
	$('#inscriptionForm').ajaxForm(options); 
	
});
function validate(){
	return $('#inscriptionForm').valid();
}
function testMail(){
	
	var mail = $("#email").val();
	var zAction                = base_url + 'client/countMail/' ;
	var tformData = {mail:mail};
	$.ajax({
		url : zAction,
		type: "POST",
		data : tformData,
		beforeSend: function() {
			$('#preloadMail').show();
		},
		success: function(data, textStatus, jqXHR)
		{
			if(data>0){
				if($('body').find('#mailError').length>0){
					$('#mailError').remove() ;
				}
				$('#email').after('<label id="mailError" class="error">Cette mail existe déjà dans notre base de donnée</label>');
				setTimeout( function() {$('#mailError').fadeOut(); },1500);
				$("#email").val('');
			}else{
				if($('body').find('#mailError').length>0){
					$('#mailError').remove() ;
				}
			}
			$('#preloadMail').hide();
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
		
		}
	});
}
function testPseudo(){
	
	var pseudo = $("#pseudo").val();
	var zAction   = base_url + 'client/countPseudo/' ;
	var tformData = {pseudo:pseudo};
	$.ajax({
		url : zAction,
		type: "POST",
		data : tformData,
		beforeSend: function() {
			$('#preloadPseudo').show();
		},
		success: function(data, textStatus, jqXHR)
		{
			if(data>0){
				if($('body').find('#pseudoError').length>0){
					$('#pseudoError').remove() ;
				}
				$('#pseudo').after('<label id="pseudoError" class="error">Ce pseudo est déjà utilisé par quelqu\'un d\'autre</label>');
				setTimeout( function() {$('#pseudoError').fadeOut(); },1500);
				
				$("#pseudo").val('');
			}else{
				if($('body').find('#mailError').length>0){
					$('#pseudoError').remove() ;
				}
			}
			$('#preloadPseudo').hide();
		},
		error: function (jqXHR, textStatus, errorThrown)
		{
		
		}
	});
}
/* partie inscription fin */

/*************************************************************/
/********************partie connexion ************************/
/*************************************************************/
$(document).ready(function() {
	$("#connexionForm").validate({
		rules: {
			userpass: {
				required: true
			},
			useremail: {
				required: true,
				email: true
			}
		},
		messages: {
			useremail: {
				required: "Veuillez entrer votre adresse email",
				email  : "Veuillez entrer un email valide"
			},
			userpass: {
				required: "Veuillez entrer votre mots de passe"
			}
		}
	});
	var options = { 
		beforeSubmit: validateConnexion,
		beforeSend  : function() {
			dataM = '<div><div class="preloader">&nbsp;</div><h3 class="beforeSend">En Cours ...</h3></div>';
			$('#msg').html(dataM);
			$.fancybox({
				'href': '#inline1'
			});
		},
		resetForm : true,
		success   : processConnexion
	};
	$('#connexionForm').ajaxForm(options); 
});
function validateConnexion(){
	return $('#connexionForm').valid();
}
function processConnexion(data) {
	if(data == "1"){
		//$(document).ready(function() {
			//$.fancybox.close(); 
			//alert(data);
			document.location.href = base_url + "connecter";
			//$(location).attr('href',base_url + 'connecter');
		//});
	}
	if(data == "0"){
		$('#msg').html("<div class=\"alert-box errorMsg\">Ce compte n'existe pas ou n'est pas encore activé</div>");
		setTimeout( function() {$.fancybox.close(); },2000);
	}
}
/*************************************************************/
/********************partie connexion fin*********************/
/*************************************************************/