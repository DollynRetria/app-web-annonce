<?php $this->load->view('admin/includes/header');?>
    <?php if(isset($title)):?>
    	<div class="alert-box noticeMsg"><span><?php echo $title?></span></div>
    <?php endif;?>
	<?php if(isset($aListes) && is_array($aListes)):?>
        <?php if($this->session->flashdata('success')):?>
			<?php echo $this->session->flashdata('success');?>
        <?php endif;?>
        <?php if($this->session->flashdata('error')):?>
            <?php echo $this->session->flashdata('error');?>
        <?php endif;?>
		<table border="1" class="listes">
			<tr class="head">
				<td width="250">Titre</td>
				<td>categorie</td>
				<td>Type</td>
				<td>Date d'ajout</td>
				<td>Annonceur</td>
				<td>Action</td>
                <td width="60">A la une</td>
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
					<td><a href="<?php echo site_url('admin/modifAnnonces/' . $annonceItem['annonce_id'])?>">Modifier</a> | <a href="<?php echo site_url('admin/deleteAnnonces/' . $annonceItem['annonce_id'])?>">Supprimer</a> | <a href="<?php echo site_url("admin-annonce-" . $annonceItem['annonce_id'] . ".html")?>">Voir</a></td>
                    <?php 
						$zLink1 = '<input type="hidden" value="1" name="action"> <input type="submit" value="Activer"  class="link">';
						
						$zLink2 = '<input type="hidden" value="0" name="action"> <input type="submit" value="Désactiver" class="link">';
					?>
                    <td>
                    	<form method="post" action="<?php echo site_url('admin/a_la_une')?>">
                            <input type="hidden" value="<?php echo $this->uri->uri_string()?>" name="redirect" />
                            <input type="hidden" value="<?php echo $annonceItem['annonce_id']?>" name="iId" />
							<?php echo $annonceItem['featured'] == 0 ? $zLink1 : $zLink2;?>
                        </form>
                    </td>
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
	<a href="<?php echo site_url('admin/ajoutAnnonces')?>" class="btn" style="float:right">Ajout Nouvelle annonce</a>
    <div class="clear"></div>
<?php $this->load->view('admin/includes/footer');?>