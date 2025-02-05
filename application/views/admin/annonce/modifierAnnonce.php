<?php $this->load->view('admin/includes/header');?>
	
    <div class="formContent">
    	<div class="breadcrumbs"><a href="admin-utilisateur.html">Gestion des annonces</a> > <?php if(isset($title)) {echo $title;}?></div>
    	<h3><?php if(isset($title)) {echo $title;}?></h3>
        <?php if(isset($zToModify)):?>
		<?php foreach($zToModify as $annonce):?>
			<form action="<?php echo site_url('admin/updateAnnonces') ?>" method="post">
            	<div class="formBox">
                    <input type="hidden" name="user_id" value="<?php echo $annonce['user_id']?>" />
                    <input type="hidden" name="id" value="<?php echo $annonce['annonce_id']?>" />
                    <label> Type :</label>
                    <?php if(validation_errors()): ?>
                        <?php echo form_error('type_annonce_type'); ?>
                    <?php endif; ?>
                    <?php if(is_array($type)):?>
                        <select name="type_annonce_type" class="select">
                            <?php foreach($type as $itemType):?>
                                <?php $selected = $itemType['type_annonce_id'] == $zToModify[0]['type_annonce_id'] ? "selected" : "";?>
                                <option value="<?php echo $itemType['type_annonce_id']?>" <?php echo $selected; ?>>
                                    <?php echo utf8_decode($itemType['type_annonce_type'])?>
                                </option>
                            <?php endforeach;?>
                        </select>
                    <?php endif;?>
                </div>
                <div class="clear"></div>
                <div class="formBox">
                    <label> Cat&eacute;gorie :</label>
                    <?php if(validation_errors()): ?>
                        <?php echo form_error('categorie'); ?>
                    <?php endif; ?>
                    <?php if(is_array($categorie)):?>
                        <select name="categorie" class="select">
                            <?php foreach($categorie as $itemCategorie):?>
                                <?php $selected = $itemCategorie['categorie_id'] == $zToModify[0]['categorie_id'] ? "selected" : "";?>
                                <option value="<?php echo $itemCategorie['categorie_id']?>" <?php echo $selected ?>>
                                    <?php echo utf8_decode($itemCategorie['categorie_type'])?>
                                </option>
                            <?php endforeach;?>
                        </select>
                    <?php endif;?>
				</div>
                <div class="clear"></div>
                <div class="formBox">
                    <label> Titre de l'annonce :</label>
                    <?php if(validation_errors()): ?>
                        <?php echo form_error('annonce_titre'); ?>
                    <?php endif; ?>
                    <input type="text" name="annonce_titre" class="inputText" value="<?php echo $annonce['annonce_titre']; ?>"/>
                </div>
                <div class="clear"></div>
                <div class="formBox">
                <label>Description de l'annonce :</label>
                </div>
                <div class="clear"></div>
                <?php if(validation_errors()): ?>
                    <?php echo form_error('description'); ?>
                <?php endif; ?>
                <textarea name="description"  style="width:100%; height:200px"><?php echo $annonce['annonce_description']; ?></textarea>
                <br />
                <div class="clear"></div>
				<input type="submit" name="btn" class="btn" value="Enregistrer l'annonce" />
			</form>
		<?php endforeach;?>			
	<?php endif;?>
	</div>
<?php $this->load->view('admin/includes/footer');?>
