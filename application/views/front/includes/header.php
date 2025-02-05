<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php echo css('styles.css')?>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>assets/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
    <script type="text/javascript">
		$(document).ready(function() {
			$("#various1").fancybox({
				'transitionIn'		: 'none',
				'transitionOut'		: 'none'
			});
		});
	</script>
<script type="text/javascript">
	var base_url = '<?php echo base_url()?>';
</script>
<?php if(isset($zJs)):?>
	<?php foreach($zJs as $zItem):?>
    	<?php echo js($zItem)?>
    <?php endforeach;?>
<?php endif;?>
<title><?php if(isset($title)) {echo $title;}?></title>
</head>

<body>
	
	<div id="container">
    	<div id="header">
        	<a href="<?php echo base_url()?>" class="logo"><img src="<?php echo base_url().'assets/images/logo.png'?>" width="437" height="72" alt="*"/></a>
            <div class="userLink">
            	<ul>
                	<?php if($this->session->userdata('user_data')):?>
                		<li><a href="<?php echo site_url('client/deconnexion')?>">Déconnexion</a></li>
                    <?php else:?>
                		<li><a href="<?php echo site_url('client')?>" class="login">Identification</a></li>
                    <?php endif;?>
                    <li><a href="<?php echo site_url('client')?>" class="register">Inscription</a></li>
                </ul>
                <!--<fieldset id="signin_menu">
                    <form method="post" id="signin" action="#">
                        <p>
                            <label for="username">Adresse E-mail </label>
                            <input id="username" name="username" value="" title="username"tabindex="4"type="text">
                        </p>
                        <p>
                            <label for="password">Mots de passe </label>
                            <input id="password"name="password"value=""title="password" tabindex="5"type="password">
                        </p>
                        <p class="remember">
                            <input id="signin_submit"value="Entrer" tabindex="6" type="submit">
                        </p>
                        <p class="forgot"> 
                            <a href="#"id="resend_password_link" style="height:auto; line-height:18px!important">Mots de passe oublié ?</a>
                        </p>
                        <span id="close" style="cursor:pointer">&nbsp;</span>
                    </form>
                </fieldset>-->
            </div>
        </div>
        <div id="nav">
        	<div class="home">
            	<div class="rightT"></div>
            	<a href="<?php echo base_url()?>" class="homeIco">&nbsp;</a>
            </div>
            <ul class="menu">
            	<?php  $controller->menu()?>
                <li><a href="#">SERVICES PRATIQUE</a></li>
                <li><a href="#">CONTACT</a></li>
            </ul>
            <div class="clear"></div>
        </div>