<?php $this->load->view('admin/includes/header');?>
	<div class="formContent">
    	<div class="breadcrumbs"><a href="admin-utilisateur.html">Gestion des utilisateurs</a> > <?php echo $title?></div>
    	<h3><?php echo $title?></h3>
        <div id="msg"></div>
        <form id="inscription" method="post" action="<?php echo site_url('utilisateur/saveDataUser')?>">
            <?php if(!empty($type)):?>
                <div class="formBox">
                    <label>Type</label>
                    <select name="type" class="select">
                        <?php foreach($type as $zItem):?>
                        <option value="<?php echo $zItem['type_user_id']?>"><?php echo $zItem['type_user_libelle']?></option>
                        <?php endforeach;?>
                    </select>
                    <div class="clear"></div>
                </div>
            <?php endif;?>
            <div class="formBox">
                <label>Civilité</label>
                <select name="civilite" class="select">
                    <option value="mr">MR</option>
                    <option value="mlle">Mlle</option>
                    <option value="mme">Mme</option>
                </select>
                 <div class="clear"></div>
            </div>
            <div class="clear"></div>
            <div class="formBox">
                <label>Nom *</label>
                <input type="text" class="inputText" name="nom"/>
                 <div class="clear"></div>
            </div>
            <div class="formBox">
                <label>Prenom *</label>
                <input type="text" class="inputText" name="prenom"/>
                 <div class="clear"></div>
            </div>
            <div class="clear"></div>
            <div class="formBox">
                <label>Email *</label>
                <input type="text" class="inputText" name="email" id="email"/><label id="mailError"></label>
            </div>
            <div class="formBox">
                <label>Date de naissance *</label>
                <select name="jours" id="jours" class="select validdate">
                    <option value="">JJ</option>
                    <?php for($i = 1; $i<=31; $i++):?>
                        <option value="<?php echo $i?>"><?php echo $i?></option>
                    <?php endfor;?>
                </select>
                <select name="mois" id="mois" class="select validdate" style="margin:0 5px">
                    <option value="">MM</option>
                    <?php for($i = 1; $i<=12; $i++):?>
                        <option value="<?php echo $i?>"><?php echo $i?></option>
                    <?php endfor;?>
                </select>
                <input type="text" class="inputText" name="annee" id="annee" style="width:100px"/>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
            <div class="formBox">
                <label>Téléphone *</label>
                <input type="text" class="inputText" name="tel"/>
            </div>
            <div class="formBox">
                <label>Mot de passe *</label>
                <input type="text" class="inputText" name="pass" id="password"/>
            </div>
            <div class="formBox">
                <label>Pseudo *</label>
                <input type="text" class="inputText" name="pseudo" id="pseudo"/>
            </div>
            <div class="formBox">
                <label>Confirmer votre mot de passe *</label>
                <input type="text" class="inputText" name="confirm_pass"/>
            </div>

            <div class="clear"></div>
            <div class="formBox">
                <label>Photos de profil</label>
                <input type="file" name="photo"  id="file"/>
            </div>
            <div class="clear"></div>
            <hr class="line"/>
            <input type="submit" value="Ajouter" id="send" class="btn" />
        </form>
    </div>
<?php $this->load->view('admin/includes/footer');?>