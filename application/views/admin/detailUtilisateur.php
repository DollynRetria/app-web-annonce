<?php $this->load->view('admin/includes/header');?>
	<div class="formContent">
        <?php if(!empty($profil)):?>
        	<div class="breadcrumbs"><a href="admin-utilisateur.html">Gestion des utilisateurs</a> > <?php echo $title?></div>
            <div>
            	<table class="listes" style="margin:20px 0 0 0">
                	<tr class="head">
                    	<td colspan="3"><b><?php echo $title?></b></td>
                    </tr>
                	<tr>
                    	<td rowspan="8" style="width:100px;" align="center">
                        <img src="<?php echo base_url().'assets/media/utilisateur/mini_'. $profil[0]['user_photo'] ?>" alt=""/>
                        </td>
                    </tr>
                    <tr class="gris">
                    	<td>Pseudo</td>
                    	<td><?php echo $profil[0]['user_pseudo']?></td>
                    </tr>

                	<tr>
                    	<td>E-mail</td>
                    	<td><?php echo $profil[0]['user_email']?></td>
                    </tr>
                    <tr class="gris">
                    	<td>Téléphone</td>
                    	<td><?php echo $profil[0]['user_telephone']?></td>
                    </tr>
                    <tr>
                    	<td>Date de naissance</td>
                    	<td><?php echo utf8_encode(time2DatetimeFR($profil[0]['user_date_de_naissance']))?></td>
                    </tr>
                    <tr class="gris">
                    	<td>Statut</td>
                    	<td><?php echo $profil[0]['user_active'] == "oui" ? "active" : "inactive"?></td>
                    </tr>
                    
                    <tr>
                    	<td>Date d'inscription</td>
                    	<td><?php echo utf8_encode(time2DatetimeFR($profil[0]['user_date_inscription']))?></td>
                    </tr>
                    <tr class="gris">
                    	<td>Type</td>
                    	<td><?php echo $profil[0]['type_user_libelle']?></td>
                    </tr>
                </table>
                <hr class="line"/>
                <a href="<?php echo site_url('admin-modifier-utilisateur-'. $profil[0]['user_id'] .'.html')?>" class="btn">Modifier</a>
                <div class="clear"></div>
            </div>
        <?php endif;?>
    </div>
<?php $this->load->view('admin/includes/footer');?>