<?php $this->load->view('front/includes/header');?>
		<ul class="tabsAnnonce">
        	<li><a href="<?php echo site_url('connecter') ?>" class="active">Mon profil</a></li>
        	<li><a href="#">Mes annonces</a></li>
        </ul>
        <div class="clear"></div>
        <div class="formContent">
			<?php if(isset($aListes) && is_array($aListes)):?>
				<?php if($this->session->flashdata('success')):?>
                    <?php echo $this->session->flashdata('success');?>
                <?php endif;?>
                <?php if($this->session->flashdata('error')):?>
                    <?php echo $this->session->flashdata('error');?>
                <?php endif;?>
                <table border="1" class="listes">
                    <tr class="head">
                        <td>Titre</td>
                        <td>categorie</td>
                        <td>Type</td>
                        <td>Date d'ajout</td>
                        <td>Annonceur</td>
                        <td>Action</td>
                    </tr>
                    <?php foreach($aListes as $annonceItem):?>
                        <?php $iCount = 0 ; ?>
                        <?php if($iCount%2 == 1){ $gris ="class=\"gris\"";}else{$gris ="";}?>
                        <tr <?php echo $gris?>>
                            <td><?php echo $annonceItem['titre']?></td>
                            <td><?php echo $annonceItem['categorie']?></td>
                            <td><?php echo $annonceItem['type']?></td>
                            <td><?php echo time2DatetimeFR(dateTime($annonceItem['dateAnnonce']))?></td>
                            <td><?php echo $annonceItem['pseudo']?></td>
                            <td><a href="<?php echo site_url('connecter/modifAnnonces/' . $annonceItem['annonce_id'])?>">Modifier</a> | <a href="<?php echo site_url('connecter/deleteAnnonces/' . $annonceItem['annonce_id'])?>">Supprimer</a> | <a href="<?php echo site_url("connecter/annonceDetail/" . $annonceItem['annonce_id'])?>">Voir</a></td>
                        </tr>
                    <?php endforeach;?>
                </table>
            <?php endif;?>
            <hr class="line" />
            <?php if(!empty($pagination)):?>
                <div class="pagination">
                    <?php echo $pagination?>
                </div>
            <?php endif;?>
            <a href="<?php echo site_url('connecter/ajoutAnnonces')?>" class="btn" style="float:right; margin-bottom:15px">Ajout Nouvelle annonce</a>
            <div class="clear"></div>
        </div>
    </div>
<?php $this->load->view('front/includes/footer');?>