<?php $this->load->view('front/includes/header');?>
        <div class="clear"></div>
        <?php if(!empty($aAnnonce)):?>
        	<div class="breadcrumbs"><?php echo $title?></div>
            <div class="imageDet">
            	<?php if($aImage):?>
                        <?php foreach($aImage as $zImage):?>
						   <?php 
							   $zImageItem  = base_url() . 'assets/media/annonces/' . $zImage['annonce_id'] .'/' . $zImage['image_nom'] ;
							   $_alt        = $title;
							   $zImageZoom  = '<img src="' . base_url() . 'timthumb.php?src='. $zImageItem .'&h=350&w=350" alt="'. $_alt .'" />';
                           ?>
                           <a href="<?php echo $zImageItem?>" id="various1" title="<?php echo $title?>"><?php echo $zImageZoom?></a>
                        <?php endforeach;?>
                <?php endif;?>
            </div>
            <div class="descDet">
            	<table class="listes" cellpadding="2">
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
                        <td style="background-color:#e3e3e3 !important"><?php echo /*strip_tags(*/$aAnnonce[0]['descripiton']/*)*/ ?></td>
                    </tr>
                </table>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
            <br />
        <?php endif;?>
    </div>
<?php $this->load->view('front/includes/footer');?>