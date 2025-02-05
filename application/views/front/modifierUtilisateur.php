<?php $this->load->view('front/includes/header');?>
		<ul class="tabsAnnonce">
        	<li><a href="#" class="active">Mon profil</a></li>
        	<li><a href="#">Mes annonces</a></li>
        </ul>
        <div class="clear"></div>
        <div class="formContent">
			<?php if(is_array($utilisateur)):?>
            <form id="inscription" method="post" action="<?php echo site_url('connecter/updateDataUser')?>" style="width:920px" enctype="multipart/form-data">
            	<a href="<?php echo site_url('connecter')?>" class="btn">Retour</a>
                <div class="clear"></div>
                <hr class="line"/>
            	<input type="hidden" value="<?php echo $utilisateur[0]['user_id']?>" name="id" />
                <?php if(!empty($type)):?>
                    <div class="formBox">
                        <label>Type</label>
                        <select name="type" class="select">
                            <?php foreach($type as $zItem):?>
                            <option value="<?php echo $zItem['type_user_id']?>" <?php echo $utilisateur[0]['type_user_id'] == $zItem['type_user_id'] ? "selected" : ""?>>
								<?php echo $zItem['type_user_libelle']?>
                            </option>
                            <?php endforeach;?>
                        </select>
                        <div class="clear"></div>
                    </div>
                <?php endif;?>
                <div class="formBox">
                    <label>Civilité</label>
                    <select name="civilite" class="select">
                        <option value="mr" <?php echo $utilisateur[0]['user_genre'] == 'Mr' ? "selected" : ""?>>MR</option>
                        <option value="mlle" <?php echo $utilisateur[0]['user_genre'] == 'Mlle' ? "selected" : ""?>>Mlle</option>
                        <option value="mme" <?php echo $utilisateur[0]['user_genre'] == 'Mme' ? "selected" : ""?>>Mme</option>
                    </select>
                     <div class="clear"></div>
                </div>
                <div class="clear"></div>
                <div class="formBox">
                    <label>Nom *</label>
                    <input type="text" class="inputText" name="nom" value="<?php echo $utilisateur[0]['user_nom']?>"/>
                     <div class="clear"></div>
                </div>
                <div class="formBox">
                    <label>Prenom *</label>
                    <input type="text" class="inputText" name="prenom" value="<?php echo $utilisateur[0]['user_prenom']?>"/>
                     <div class="clear"></div>
                </div>
                <div class="clear"></div>
                <div class="formBox">
                    <label>Email *</label>
                    <input type="text" class="inputText" name="email" readonly="readonly" id="email" value="<?php echo $utilisateur[0]['user_email']?>"/><label id="mailError"></label>
                </div>
                <div class="formBox">
                	<?php 
						$zDate  = explode('/' ,date('m/d/Y', $utilisateur[0]['user_date_de_naissance']));
						$zJours = intval($zDate[0]);
						$zMois = intval($zDate[1]);
						$zAnnee = intval($zDate[2]);
					?>
                    <label>Date de naissance *</label>
                    <select name="jours" id="jours" class="select validdate">
                        <option value="">JJ</option>
                        <?php for($i = 1; $i<=31; $i++):?>
                            <option value="<?php echo $i?>" <?php echo $i == $zDate[0] ? "selected" : ""?>><?php echo $i?></option>
                        <?php endfor;?>
                    </select>
                    <select name="mois" id="mois" class="select validdate" style="margin:0 5px">
                        <option value="">MM</option>
                        <?php for($i = 1; $i<=12; $i++):?>
                            <option value="<?php echo $i?>" <?php echo $i == $zDate[1] ? "selected" : ""?>><?php echo $i?></option>
                        <?php endfor;?>
                    </select>
                    <input type="text" class="inputText" value="<?php echo $zAnnee?>" name="annee" id="annee" style="width:84px"/>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
                <div class="formBox">
                    <label>Téléphone *</label>
                    <input type="text" class="inputText" name="tel" value="<?php echo $utilisateur[0]['user_telephone']?>"/>
                </div>
                <div class="formBox">
                    <label>Mot de passe *</label>
                    <input type="text" class="inputText" name="pass" id="pass" value="<?php echo $utilisateur[0]['user_mot_de_passe']?>"/>
                </div>

                <div class="clear"></div>
                <div class="formBox">
                    <label>Pseudo *</label>
                    <input type="text" class="inputText" name="pseudo" id="pseudo" value="<?php echo $utilisateur[0]['user_pseudo']?>"/>
           		 </div>

                <div class="formBox">
                    <label>Confirmer votre mot de passe *</label>
                    <input type="text" class="inputText" name="confirm_pass" value="<?php echo $utilisateur[0]['user_mot_de_passe']?>"/>
                </div>
                <div class="clear"></div>
                <div class="formBox">
                	<?php if(!empty($utilisateur[0]['user_photo'])):?>
                    	<label>&nbsp;</label>
                        <div class="inputText" style="height:auto; background:#fff; border:none; padding:0">
                    		<img src="<?php echo base_url().'assets/media/utilisateur/mini_'. $utilisateur[0]['user_photo'] ?>" alt="" width="50" style="float:left"/>
                            <a href="<?php echo site_url('connecter/deleteTof/' . $utilisateur[0]['user_id'])?>" style="float:left; margin:0 5px"><img src="<?php echo base_url().'assets/images/' . 'error.png' ?>" alt="" title="supprimer"/></a>
                            <div class="clear"></div>
                        </div>
                    <?php else:?>
                        <label>Photos de profil</label>
                        <input type="file" name="photo"  id="file"/>
                    <?php endif;?>
                </div>
                <div class="clear"></div>
                <hr class="line"/>
                <input type="submit" value="Enregistrer" id="send" class="btn" />
            </form>
		<?php endif;?>
        <div class="clear"></div>
        </div>
    </div>
<?php $this->load->view('front/includes/footer');?>