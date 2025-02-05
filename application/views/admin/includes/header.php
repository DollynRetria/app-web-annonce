<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if(isset($title)) {echo $title;}?></title>
<script type="text/javascript">
	var base_url = '<?php echo base_url()?>';
</script>
<?php echo css('admin.css')?>
<?php echo js('jquery.js')?>
<?php if(isset($zJs)):?>
	<?php foreach($zJs as $zItem):?>
    	<?php echo js($zItem)?>
    <?php endforeach;?>
<?php endif;?>

</head>
<div id="container">
	<div id="nav">
    <a href="<?php echo site_url("admin-utilisateur.html")?>">[Gestion des utilisateurs]</a><a href="<?php echo site_url("admin/listesAnnonces");?>">[Gestion des annonces]</a><a href="<?php echo site_url("client/deconnexionAdmin")?>">[Deconnexion]</a><!--<a href="#">[Gestion des categories d'annonce]</a><a href="#">[Gestion de type d'annonce]</a>-->
    	<div class="clear"></div>
    </div>
