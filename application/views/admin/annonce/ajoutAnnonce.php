<?php $this->load->view('admin/includes/header');?>
	
    <div class="formContent">
    	<div class="breadcrumbs"><a href="admin-utilisateur.html">Gestion des annonces</a> > <?php echo $title?></div>
    	<h3><?php if(isset($title)) {echo $title;}?></h3>
        <form action="<?php echo site_url('admin/sauvAnnonces') ?>" method="post" enctype="multipart/form-data">
            <div class="formBox">
                <input type="hidden" name="user_id" value="5" />
                <label> Type :</label>
                <?php if(validation_errors()): ?>
                    <?php echo form_error('type_annonce_type'); ?>
                <?php endif; ?>
                <?php if(is_array($type)):?>
                    <select name="type_annonce_type" class="select">
                        <option value="">--</option>
                        <?php foreach($type as $itemType):?>
                            <option value="<?php echo $itemType['type_annonce_id']?>" <?php echo set_select('type_annonce_type', $itemType['type_annonce_id'] , TRUE); ?>>
                                <?php echo $itemType['type_annonce_type']?>
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
                        <option value="">--</option>
                        <?php foreach($categorie as $itemCategorie):?>
                            <option value="<?php echo $itemCategorie['categorie_id']?>" <?php echo set_select('categorie', $itemCategorie['categorie_id'] , TRUE); ?>>
                                <?php echo $itemCategorie['categorie_type']?>
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
                <input type="text" name="annonce_titre"  class="inputText" value="<?php echo set_value('annonce_titre'); ?>"/>
            </div>
            <div class="clear"></div>
            <label>Description de l'annonce :</label>
            <?php if(validation_errors()): ?>
                <?php echo form_error('description'); ?>
            <?php endif; ?>
            <textarea name="description" style="width:100%; height:200px"><?php echo set_value('description'); ?></textarea>
            <br />
            <div class="formBox">
            	<label>Images 1</label>
                <input type="file" name="images[]" multiple="multiple"/>
            </div>
            <div class="clear"></div>
            <input type="submit" name="btn" value="D&eacute;poser l'annonce"   class="btn"/>
        </form>
	</div>
<?php $this->load->view('admin/includes/footer');?>
