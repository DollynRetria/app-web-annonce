<?php $this->load->view('front/includes/header');?>
		<ul class="tabsAnnonce">
        	<li><a href="<?php echo site_url('connecter') ?>">Mon profil</a></li>
        	<li><a href="#" class="active">Mes annonces</a></li>
        </ul>
        <div class="clear"></div>
        <div class="formContent">
        	<div class="annonceform" style="margin-top:0">
                <div id="annonceur">
                	
                    <h3>Deposer vos annonces</h3>
                    <form action="<?php echo site_url('connecter/sauvAnnonces') ?>" method="post" enctype="multipart/form-data">
                        <div class="annonceLeft">
                            <?php 
                                $iUserId = $this->session->userdata('user_data');
                                $iUserId = $iUserId[0]['user_id'];
                            ?>
                            <input type="hidden" name="user_id" value="<?php echo $iUserId?>" />
                            <label> Type :</label>
                            <?php if(validation_errors()): ?>
                                <label class="error"><?php echo form_error('type_annonce_type'); ?></label>
                            <?php endif; ?>
                            <?php if(is_array($type)):?>
                                <select name="type_annonce_type" class="select">
                                    <?php foreach($type as $itemType):?>
                                        <option value="<?php echo $itemType['type_annonce_id']?>" <?php echo set_select('type_annonce_type', $itemType['type_annonce_id'] , TRUE); ?>>
                                            <?php echo $itemType['type_annonce_type']?>
                                        </option>
                                    <?php endforeach;?>
                                </select>
                            <?php endif;?>
                            <div class="clear"></div>
                            <label> Cat&eacute;gorie :</label>
                            <?php if(validation_errors()): ?>
                                <label class="error"><?php echo form_error('categorie'); ?></label>
                            <?php endif; ?>
                            <?php if(is_array($categorie)):?>
                                <select name="categorie" class="select">
                                    <option value="">--</option>
                                    <?php foreach($categorie as $itemCategorie):?>
                                        <option value="<?php echo $itemCategorie['categorie_id']?>" <?php echo set_select('categorie', $itemCategorie['categorie_id'] , TRUE); ?>>
                                            <?php echo $itemCategorie['categorie_type']?>
                                        </option>
                                    <?php endforeach;?>
                                </select>
                            <?php endif;?>
                            <div class="clear"></div>
                            <label> Titre de l'annonce :</label>
                            <?php if(validation_errors()): ?>
                                <label class="error"><?php echo form_error('annonce_titre'); ?></label>
                            <?php endif; ?>
                            <input type="text" name="annonce_titre"  class="inputTxt" value="<?php echo set_value('annonce_titre'); ?>"/>
                            <div class="clear"></div>
                            <label>Photos :</label>
                            <input type="file" name="images[]" id="file" multiple="multiple"/>
                            <div class="clear"></div>
                        </div>
                        <div class="annonceRight">
                            <label>Description de l'annonce :</label>
                            <?php if(validation_errors()): ?>
                                <label class="error"><?php echo form_error('description'); ?></label>
                            <?php endif; ?>
                            <textarea name="description" class="textarea" style="height:211px"><?php echo set_value('description'); ?></textarea>
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                        <div style="padding:10px 0 0 0">
                        <input type="submit" name="btn" class="btn"value="Déposer l'annonce" style="float:right" />
                        <div class="clear"></div>
                        </div>
                    </form>
                    <div class="clear"></div>
                </div>
        	</div>
        </div>
    </div>
<?php $this->load->view('front/includes/footer');?>