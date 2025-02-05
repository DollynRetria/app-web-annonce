    <div id="footer">
        <div class="content">
        	<div class="line">
                <div class="footerLink">
                    <a href="#">Accueil</a>
                    <span>|</span>
                    <a href="#">Ajouter une annonce</a>
                    <span>|</span>
                    <a href="#">Nos partenaires</a>
                    <span>|</span>
                    <a href="#">Aide</a>
                    <span>|</span>
                    <a href="#">Informations personnelles</a>
                    <span>|</span>
                    <a href="#">Contact</a>
                    <div class="clear"></div>
                </div>
                <div class="copyright">
                    (c) Dollyn Famantanantsoa 2014
                </div>
                <div class="clear"></div>
            </div>
            <div class="infos">
            	<p>Annonce.mg vous aide à trouver facilement et plus rapidement les petites annonces à Madagascar. Avec annonce.mg, déposez ou consultez gratuitement des petites annonces à Madagascar !</p>
                <p>
Retrouvez dans la liste suivantes, les dernières petites annonces de vente, de location et de recherche concernant l'immobilières à Madagascar, déposées par la communauté d'annonceurs de annonce.mg. Dernière mise à jour il y a 2 heures</p>
            </div>
        </div>
    </div>
    <?php if(isset($zJsFoot)):?>
		<?php foreach($zJsFoot as $zItem):?>
            <?php echo js($zItem)?>
        <?php endforeach;?>
    <?php endif;?>
</body>
</html>
