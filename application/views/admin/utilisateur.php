<?php $this->load->view('admin/includes/header');?>
	<?php if($this->session->flashdata('success')):?>
    	<?php echo $this->session->flashdata('success');?>
    <?php endif;?>
    <?php if($this->session->flashdata('error')):?>
    	<?php echo $this->session->flashdata('error');?>
    <?php endif;?>
    <?php if(isset($nbr_client)):?>
    	<div class="alert-box noticeMsg"><span><?php echo $nbr_client?></span> client(s) inscrits</div>
    <?php endif;?>
    <?php 
		$uri = $this->uri->segment(2);
		$uri = explode(".html",$uri);
		$uri = $uri[0];
		if(!empty($uri)){
			$uri = '-' . $uri .'.html';
		}else{
			$uri = '.html';
		}
	?>
    <?php if(is_array($listes)):?>
   
    	<table border="1" class="listes">
			<?php $iCount = 0 ; ?>
            <tr class="head">
            	<td>Civilité</td>
                <td>Nom</td>
                <td>Prenom</td>
                <td>Pseudo</td>
                <td>Email</td>
                <td>Téléphone</td>
                <td>Date d'inscription</td>
                <td align="center">Photos</td>
                <td colspan="4" align="center">Action</td>
            </tr>
    	<?php foreach ($listes as $zItem):?>
            <?php if($iCount%2 == 1){ $gris ="class=\"gris\"";}else{$gris ="";}?>
            <?php 
				$linkActivate    = '<a href="'.site_url('admin-utilisateur-activer-'.$zItem['user_id'].'.html').'" class="activer">Activer</a>'; 
				$linkDesactivate = '<a href="'.site_url('admin-utilisateur-desactiver-'.$zItem['user_id'].'.html').'"  class="desactiver">Désactiver</a>'; 
			?>
            
        	<tr <?php echo $gris?>>
            	<td><?php echo $zItem['user_genre']?></td>
                <td><?php echo $zItem['user_nom']?></td>
                <td><?php echo $zItem['user_prenom']?></td>
                <td><?php echo $zItem['user_pseudo']?></td>
                <td><?php echo $zItem['user_email']?></td>
                <td><?php echo $zItem['user_telephone']?></td>
                <td><?php echo utf8_encode(time2DatetimeFR($zItem['user_date_inscription']));?></td>
                <td align="center">
                	<?php if(!empty($zItem['user_photo'])):?>
                    	<img src="<?php echo base_url().'assets/media/utilisateur/mini_'. $zItem['user_photo'] ?>" alt="" width="50"/>
                    <?php endif;?>
                </td>
                <td>
                	<a href="<?php echo site_url('admin-detail-utilisateur-' . $zItem['user_id'] .'.html')?>">Voir</a> 
                </td>
                <td>
                	<a href="<?php echo site_url('admin-suppr-utilisateur-' . $zItem['user_id'] . $uri)?>">Supprimer</a> 
                </td>
                <td>
                <span id="user_<?php echo $zItem['user_id']?>"><?php echo $zItem['user_active'] == 'non' ? $linkActivate : $linkDesactivate ;?></span>
                </td>
                <td>
                	<a href="<?php echo site_url('admin-modifier-utilisateur-' . $zItem['user_id'] .'.html')?>">Modifier</a> 
                </td>
            </tr>
            <?php $iCount++ ; ?>
        <?php endforeach;?>
        </table>
    <?php endif;?>
    <hr class="line" />
	<?php if(!empty($pagination)):?>
        <div class="pagination">
            <?php echo $pagination ?>
        </div>
    <?php endif ;?>
    <a href="<?php echo site_url("admin-nouveau-utilisateur.html")?>" class="btn" style="float:right">Nouveau</a>
    <div class="clear"></div>
<?php $this->load->view('admin/includes/footer');?>