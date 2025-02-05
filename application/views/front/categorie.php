<?php $this->load->view('front/includes/header');?>
	<div class="category" style="padding:20px 0 0 0">
        	<!--<div class="categoryDesc">
            	<div class="imgCateg"></div>
                <div class="textCateg">
                	<h3>Lorem ipsum dolor sit amet,</h3>
                    <p>
    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
    <p> Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. 
                    </p>
                </div>
                <div class="clear"></div>
                <div class="shadowCateg"></div>
            </div>-->
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
                    <div class="bloc <?php echo $zClass ?>">
                        <div class="label"><img src="<?php /*echo base_url()*/?>assets/images/label.png" alt=""/></div>
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
             <?php if(!empty($pagination)):?>
                <div class="pagination">
                    <?php echo $pagination?>
                </div>
            <?php endif;?>
            <div class="clear"></div>
        </div>
    </div>
<?php $this->load->view('front/includes/footer');?>