<?php $this->load->view('front/includes/header');?>
    <div class="slider_container">
        <div id="slider">
            <div id="carroussel">
                <?php for($iCount = 0; $iCount <1; $iCount++):?>
                <div class="slide">
                    <img src="<?php echo base_url().'assets/images/banner.jpg'?>" alt="*" height="356" />
                    <div class="caption">
                        <p>Annonce.mg vous aide à trouver facilement et plus rapidement les petites annonces à Madagascar. Avec annonce.mg, déposez ou consultez gratuitement des petites annonces immobilier à Madagascar !  </p>
                    </div>
                </div>
                <?php endfor;?>
            </div>
            <div class="shadow"></div>
        </div>
        <div class="sliderSide">
            <a href="<?php echo site_url('connecter/ajoutAnnonces')?>" class="deposerAnnonce">deposer une annonce</a>
            <div class="recherche">
            	<h3>Recherche rapide</h3>
            	<form method="post" action="<?php echo site_url('page/rechercher')?>">
                	<label>Type</label>
                	<?php if(is_array($type)):?>
                        <select name="type_annonce_type" class="select">
                            <?php foreach($type as $itemType):?>
                                <option value="<?php echo $itemType['type_annonce_id']?>">
                                    <?php echo $itemType['type_annonce_type']?>
                                </option>
                            <?php endforeach;?>
                        </select>
                    <?php endif;?>
                    <div class="clear"></div>
                    <label>Catégorie</label>
                	<?php if(is_array($categorie)):?>
                        <select name="categorie" class="select">
                            <?php foreach($categorie as $itemCategorie):?>
                                <option value="<?php echo $itemCategorie['categorie_id']?>">
                                    <?php echo $itemCategorie['categorie_type']?>
                                </option>
                            <?php endforeach;?>
                        </select>
                    <?php endif;?>
                    <div class="clear"></div>
                    <label>Critères</label>
                	<input type="text" class="inputTxt" name="critere"/>
                    <div class="clear"></div>
                    <input type="submit" value="Rechercher" class="btn" />
                    <div class="clear"></div>
                </form>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <h3 class="featuredTitle">Nos Annonces à la une...</h3>
    <div class="featured">
        <?php if(isset($aListes) && is_array($aListes)):?>
			<?php 
                $iCount      = 1;
            ?>
            <?php foreach($aListes as $annonceItem):?>
                <?php 
                    //reinitialise le compteur
                    if($iCount == 5){
                        $iCount = 1;
                    }
                    if ($iCount == 1) {
                        $zClass = "first";
                    }elseif($iCount == 2){
                        $zClass = "";
                    }elseif($iCount == 3){
                        $zClass = "";
                    }elseif($iCount == 4){
                        $zClass = "last";
                    }
                    
                ?>
                <div class="bloc <?php echo $zClass ?>"><!--
                    <div class="label"><img src="<?php /*echo base_url()*/?>assets/images/label.png" alt=""/></div>-->
                    <a href="<?php echo site_url('page/detail/' . $annonceItem['annonce_id'] )?>" class="img">
                        <?php echo $controller->image($annonceItem['annonce_id'], $annonceItem['titre']);?>
                    </a>
                    <h3>
                        <?php
                            
                            $zTitre = wordwrap($annonceItem['titre'], 90, "<br />\n");
                            echo ucfirst(strtolower(htmlentities($zTitre)));
                        ?>
                    </h3>
                    <p>
                        <?php echo truncate(strip_tags($annonceItem['description']), 90);?> 
                    </p>
                    <a href="<?php echo site_url('page/detail/' . $annonceItem['annonce_id'] )?>" class="link"></a>
                    <span class="date" style="text-align:right">Publier le<br /><em><b><?php echo time2DatetimeFR(time($annonceItem['dateAnnonce']))?></b></em></span>
                    <div class="shadow"></div>
                </div>
                <?php
                    $iCount++;
                ?>
            <?php endforeach;?>
        <?php endif;?>
        <div class="clear"></div>
    </div>
</div>
<?php $this->load->view('front/includes/footer');?>