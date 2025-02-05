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
	<body>
        <div>
            <form class="formLogin" method="post" action="<?php echo site_url("client/isAdmin")?>">
            	<?php if($this->session->flashdata('success')):?>
					<?php echo $this->session->flashdata('success');?>
                <?php endif;?>
                <?php if($this->session->flashdata('error')):?>
                    <?php echo $this->session->flashdata('error');?>
                <?php endif;?>
            	<h3>Formulaire de connexion</h3>
                <?php if(form_error('userpseudo')):?>
                	<div class="alert-box errorMsg"><?php echo form_error('userpseudo') ?></div>
                <?php endif;?>
                <?php if(form_error('userpass')):?>
                	<div class="alert-box errorMsg"><?php echo form_error('userpass') ?></div>
                <?php endif;?>
                <table>
                    <tr>
                        <td><label>Pseudo</label></td>
                        <td><input type="text" class="inputText" name="userpseudo" value="<?php echo set_value('userpseudo'); ?>"  /></td>
                    </tr>
                    <tr>
                        <td><label>Pass</label></td>
                        <td><input type="password" class="inputText" name="userpass" value="<?php echo set_value('userpass'); ?>" /></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" value="Entrer" class="btn" /></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
	<?php if(isset($zJsFoot)):?>
        <?php foreach($zJsFoot as $zItem):?>
            <?php echo js($zItem)?>
        <?php endforeach;?>
    <?php endif;?>

</body>
</html>
