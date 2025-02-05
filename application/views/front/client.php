<?php $this->load->view('front/includes/header');?>
        <div class="form">
        	<h3 class="title"><span>&bull;</span> Espace utilisateur</h3>
			<?php if($this->session->flashdata('success')):?>
				<?php echo $this->session->flashdata('success');?>
            <?php endif;?>
            <?php if($this->session->flashdata('error')):?>
                <?php echo $this->session->flashdata('error');?>
            <?php endif;?>
            <div id="connexion">
            	<h3>Connexion</h3>
                <form action="<?php echo site_url('client/connecter')?>" method="post" id="connexionForm">
                    <label>Email :</label>
                    <input type="text" name="useremail" value="" class="inputTxt"/>
                    <div class="clear"></div>
                    <label>Mot de passe :</label>
                    <input type="password" name="userpass" value="" class="inputTxt"/>
                    <div class="clear"></div>
                    <label>&nbsp;</label>
                    <input type="submit" value="Connexion" class="btn" />
                    <div class="clear"></div>
                    <div class="shadowForm"></div>
                </form>
            </div>
            <div style="display: none;">
                <div id="inline1" style="width:400px;overflow:auto;">
                    <div id="msg">&nbsp;</div>
                </div>
            </div>
            <div id="inscription">
            	<h3>Inscription</h3>
                <form action="<?php echo site_url('client/saveDataUser')?>" method="post" id="inscriptionForm">
                	<?php if(!empty($type)):?>
                    	<label> Vous êtes :</label>
                        <select name="user_type" size="1" class="select">
                            <?php foreach($type as $zItem):?>
                            <option value="<?php echo $zItem['type_user_id']?>"><?php echo $zItem['type_user_libelle']?></option>
                            <?php endforeach;?>
                        </select>
                        <div class="clear"></div>
                    <?php endif;?>
                    <label> Civilité :</label>
                    <select name="civilite" size="1" class="select">
                        <option value="MR"  selected="selected">MR</option>
                        <option value="Mlle" >Mlle</option>
                        <option value="Mme" >Mme</option>
                    </select>
                    <div class="clear"></div>
                    <label>Nom :</label>
                    <input type="text" name="nom" value="" class="inputTxt"/>
                    <div class="clear"></div>
                    <label>Prenom :</label>
                    <input type="text" name="prenom" value="" class="inputTxt"/>
                    <div class="clear"></div>
                    
                    <label>Date de naissance :</label>
                    <select name="jours" id="jours" class="select validdate"> 
                        <option value="">JJ</option>
                        <?php for($i=1; $i<=31; $i++): ?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                        <?php endfor; ?>
                    </select>
                    <select name="mois" id="mois" class="select validdate" style="margin:0 5px" >
                        <option value="">MM</option>
                        <?php for($i=1; $i<=12; $i++): ?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                        <?php endfor; ?>
                    </select>
                	<input type="text" class="annee" name="annee" id="annee"/>
                    
					<div class="clear"></div>
                    <label>Téléphone :</label>
                    <input type="text" name="tel" value="" class="inputTxt"/>
                    <div class="clear"></div>
                    <label>Pseudo :</label>
                    <input type="text" name="pseudo" id="pseudo" value="" class="inputTxt"/>
                    <div class="clear"></div>
                    <div id="preloadPseudo"></div>
                    <div class="clear"></div>
                    <label>Email :</label>
                    <input type="text" name="email" id="email" value="" class="inputTxt"/>
                    <div class="clear"></div>
                    <div id="preloadMail"></div>
                    <div class="clear"></div>
                    <label>Mot de passe :</label>
                   
                    <input type="password" name="pass" id="pass" class="inputTxt"/>
                    <div class="clear"></div>
                    <label>Confirmation :</label>
                    <input type="password" name="confirm_pass" class="inputTxt"/>
                    <div class="clear"></div>
                    
                    <!-- à verifier, impossible de parcourir (class inexiste: customfile-wrap, customfile (juste pour checked)-->
                    <label>Photos de profil</label>
                    <div class="customfile-wrap">
                        <input id="file" class="customfile" type="file" name="photo" style="position: absolute; left: -9999px;">
                    </div>
     				<div class="clear"></div>
                    <label>&nbsp;</label>
                    <input type="submit" name="btn" value="S'inscrire" class="btn" />
                    <div class="clear"></div>
                </form>
                <div class="shadowForm2"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
<?php $this->load->view('front/includes/footer');?>