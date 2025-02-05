<?php $this->load->view('admin/includes/header');?>
	<div class="formContent">
        <?php if(!empty($aAnnonce)):?>
        	<div class="breadcrumbs"><a href="admin-utilisateur.html">Gestion des utilisateurs</a> > <?php echo $title?></div>
            <div>
            	<table class="listes" style="margin:20px 0 0 0" cellpadding="2">
                	<tr class="head">
                    	<td colspan="2"><b><?php echo $title?></b></td>
                    </tr>
                    <tr class="gris">
                    	<td>Annonceur :</td>
                        <td><?php echo $aAnnonce[0]['pseudo'] ?></td>
                    </tr>
                	<tr>
                    	<td>Date de l'annonce :</td>
                        <td><?php echo time2DatetimeFR(dateTime($aAnnonce[0]['dateAnnonce']))?></td>
                    </tr>
                    <tr class="gris">
                    	<td>Type :</td>
                        <td><?php echo $aAnnonce[0]['TYPE'] ?></td>
                    </tr>
                    <tr>
                    	<td>Categorie :</td>
                        <td><?php echo $aAnnonce[0]['categorie'] ?></td>
                    </tr>
                    <tr valign="top" class="gris">
                    	<td>Description :</td>
                        <td style="background-color:#e3e3e3e !important"><?php echo $aAnnonce[0]['descripiton'] ?></td>
                    </tr>
                    <tr>
                    	<td colspan="2">
                        	<?php if($aImage):?>
                            	<ul>
									<?php foreach($aImage as $zImage):?>
                                        <li>
                                        	<img src="<?php echo base_url().'assets/media/annonces/'.$zImage['annonce_id'].'/thumbs_'. $zImage['image_nom'] ?>" alt=""/>
                                        </li>
                                    <?php endforeach;?>
                                </ul>
                            <?php endif;?>
                        </td>
                    </tr>
                </table>
                <hr class="line"/>
                <!--<a href="<?php //echo site_url('admin-modifier-utilisateur-'. $profil[0]['id_utilisateur'] .'.html')?>" class="btn">Modifier</a>-->
                <div class="clear"></div>
            </div>
        <?php endif;?>
    </div>
<?php $this->load->view('admin/includes/footer');?>