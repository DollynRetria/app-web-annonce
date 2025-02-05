<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utilisateur extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->output->set_header("Cache-Control: no-cache, no-store, must-revalidate");
    	$this->output->set_header("Pragma: no-cache");
		$this->load->model('Users');
		$bAdmin = '';
		if($this->session->userdata('admin_data')){
			$bAdmin = $this->session->userdata('admin_data');
		}
		if($bAdmin!=TRUE){
			$this->session->set_flashdata('error', '<div class="alert-box errorMsg">Vous n\'avez pas assez de droit pour voir cette page</div>');
			redirect(site_url("client/admin"), "refresh");
		}
		
		//$this->testAdmin();
	}
	public function index()
	{
		$this->listes();
	}
	public function listes($_iPerpage = ''){
		$perPage = PER_PAGE;
		$aData['title']  = "Listes des utilisateurs";
		$zJs             = array('jquery.form.js','jquery.validate.min.js','addUser.js');
		$aData['zJs']    = $zJs;
		
		$aListes         = $this->requetteStandard->getLimit('user', 'user_id', 'DESC' , $perPage, $_iPerpage) ;
		if($_iPerpage != 0 && empty($aListes)){
			$page = $_iPerpage - $perPage;
			redirect("admin-utilisateur/". $page .".html");
		}
		$aData['listes'] = $aListes ;
		$this->load->library('pagination');
		$config['uri_segment']   = 2;
		$config['base_url']      = site_url('admin-utilisateur');
		$config['suffix']        = '.html';
		$config['first_url']     = $config['base_url'].$config['suffix'];
		$config['total_rows']    = $this->requetteStandard->SelectCount('user') ;
		$config['per_page']      = $perPage ;
		$config['cur_tag_open']  = '<span class="page active">';
		$config['cur_tag_close'] = '</span>';
		$this->pagination->initialize($config);
		$aData['pagination']     = $this->pagination->create_links() ;
		$aData['nbr_client']     = $this->requetteStandard->SelectCount('user') ;
		$this->load->view('admin/utilisateur' , $aData);
		
	}
	public function activer(){
		$bAction = $this->input->post('action');
		$iId     = $this->input->post('iId');
		$linkActivate    = '<a href="'.site_url('admin-utilisateur-activer-'.$iId.'.html').'" class="activer">Activer</a>'; 
		$linkDesactivate = '<a href="'.site_url('admin-utilisateur-desactiver-'.$iId.'.html').'"  class="desactiver">Désactiver</a>'; 
		if($bAction == 'activer'){
			$aData = array('user_active' => 'oui');
		}else{
			$aData = array('user_active' => 'non');
		}
		$aWhere = array('user_id' => $iId);
		if($this->requetteStandard->updateData($aData, 'user', $aWhere) == TRUE){
			if($bAction == 'activer'){
				echo $linkDesactivate;
				$this->session->set_flashdata('success', '<div class="alert-box successMsg">Bien activer</div>');
			}else{
				echo $linkActivate;
				$this->session->set_flashdata('success', '<div class="alert-box successMsg">Bien désactiver</div>');
			}
			
		}
	}
	public function detail($_iID = ""){
		
		$zUtilisateur    = $this->Users->detail($_iID);
		$aData['title']  = 'Profil de : ' . $zUtilisateur[0]['user_genre'] . ' '. $zUtilisateur[0]['user_prenom'] . ' ' . $zUtilisateur[0]['user_nom'];
		$aData['profil'] = $zUtilisateur;
		$this->load->view('admin/detailUtilisateur' , $aData);
	}
	public function nouveauUtilisateur(){
		$aData['title']   = "Nouveau utilisateur";
		$zJs              = array('jquery.form.js','jquery.validate.min.js','addUser.js');
		$aData['zJsFoot'] = array('customupload.js');
		$aData['zJs']     = $zJs;
		$aData['type']    = $this->requetteStandard->getAll('type_user', 'type_user_id', 'DESC', $aWhere=array());
		$this->load->view('admin/nouveauUtilisateur' , $aData);
	}
	public function saveDataUser(){
		if(isset($_FILES['photo'])){//avec images
			$zImage    = $this->do_upload();
			if(array_key_exists('error' , $zImage)){
				echo "<div class=\"error\">Veuillez verifier le type de fichier à uploader</div>";
			}else{
				$zFileName = $zImage['upload_data']['file_name'];
				$this->resizeImage($zFileName);
				$sNom             = $this->input->post('nom');
				$sPrenom          = $this->input->post('prenom');
				$sPseudo          = $this->input->post('pseudo');
				$sCivilite        = $this->input->post('civilite');
				$sEmail           = $this->input->post('email');
				$sJours           = $this->input->post('jours');
				$sMois            = $this->input->post('mois');
				$sAnnee           = $this->input->post('annee');
				$sTel             = $this->input->post('tel');
				$dDateDeNaissance = dateFR2Time($sJours.'/'.$sMois.'/'.$sAnnee);
				$sPass            = $this->input->post('pass');
				$iType            = $this->input->post('type');
				$aData            = array(
									 'type_user_id'             		 => $iType
									,'user_genre'                         => $sCivilite
									,'user_nom'                          => $sNom
									,'user_prenom'                       => $sPrenom
									,'user_date_de_naissance'            => $dDateDeNaissance
									,'user_telephone'                    => $sTel
									,'user_pseudo'                    	 => $sPseudo
									,'user_email'                        => $sEmail
									,'user_mot_de_passe'                 => $sPass
									,'user_photo'                        => $zFileName
									,'user_date_inscription'             => dateFR2Time(date("d/m/Y"))
									,'user_active'                       => 'non'
									);
			}
		}else{//sans images
			$sNom             = $this->input->post('nom');
			$sPrenom          = $this->input->post('prenom');
			$sPseudo          = $this->input->post('pseudo');
			$sCivilite        = $this->input->post('civilite');
			$sEmail           = $this->input->post('email');
			$sJours           = $this->input->post('jours');
			$sMois            = $this->input->post('mois');
			$sAnnee           = $this->input->post('annee');
			$sTel             = $this->input->post('tel');
			$dDateDeNaissance = dateFR2Time($sJours.'/'.$sMois.'/'.$sAnnee);
			$sPass            = $this->input->post('pass');
			$iType            = $this->input->post('type');
			$aData            = array(
								 'type_user_id'               		 => $iType
								,'user_genre'                         => $sCivilite
								,'user_nom'                          => $sNom
								,'user_prenom'                       => $sPrenom
								,'user_date_de_naissance'            => $dDateDeNaissance
								,'user_telephone'                    => $sTel
								,'user_pseudo'                    	 => $sPseudo
								,'user_email'                        => $sEmail
								,'user_mot_de_passe'                 => $sPass
								,'user_date_inscription'             => dateFR2Time(date("d/m/Y"))
								,'user_active'                       => 'non'
								);
		}
		$bInsert = $this->requetteStandard->insertData($aData, 'user');
		//print_r($aData);
		//exit();
		if($bInsert != FALSE){
			echo "<div class=\"alert-box successMsg\">Utilisateur bien inserer</div>";
		}else{
			echo "<div class=\"alert-box errorMsg\">Une erreur s'est survenue pendant l'enregistrement à la base de donné</div>";
		}
	}
	public function do_upload()
	{
		$config['upload_path']   = './assets/media/utilisateur/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
		$config['max_size']      = '2000';
		$config['encrypt_name']  = TRUE;
		$this->load->library('upload', $config);
		if(!$this->upload->do_upload('photo'))
		{
			$error = array('error' => $this->upload->display_errors());
			return $error;
		}else{
			$data = array('upload_data' => $this->upload->data());
			$zFileName = $data['upload_data']['file_name'];
			return $data;
		}
	}
	public function resizeImage($_zimg = ""){
		$config['image_library'] = 'gd2';
		$config['source_image']	= './assets/media/utilisateur/'.$_zimg;
		$config['new_image']	= './assets/media/utilisateur/mini_'.$_zimg;
		$config['width']	 = 100;
		$config['height']	= 100;
		$this->load->library('image_lib', $config); 
		if ( ! $this->image_lib->resize())
		{
			return false;
		}else{
			return true;
		}
	}
	public function modifier($_iId = ""){
		$aData['title']       = "Modifier un utilisateur";
		$zJs                  = array('jquery.form.js','jquery.validate.min.js','modifUser.js');
		$aData['zJsFoot']     = array('customupload.js');
		$aData['zJs']         = $zJs;
		$aData['type']        = $this->requetteStandard->getAll('type_user', 'type_user_id', 'DESC', array());
		$aWhere               = array('user_id' => $_iId);
		$aData['utilisateur'] = $this->requetteStandard->getAll('user', 'user_id', 'DESC', $aWhere);
		$this->load->view('admin/modifierUtilisateur' , $aData);
	}
	public function updateDataUser(){
		$iId              = $this->input->post('id');
		$sNom             = $this->input->post('nom');
		$sPrenom          = $this->input->post('prenom');
		$sCivilite        = $this->input->post('civilite');
		$sEmail           = $this->input->post('email');
		$sJours           = $this->input->post('jours');
		$sMois            = $this->input->post('mois');
		$sAnnee           = $this->input->post('annee');
		$sTel             = $this->input->post('tel');
		$dDateDeNaissance = dateFR2Time($sJours.'/'.$sMois.'/'.$sAnnee);
		$sPass            = $this->input->post('pass');
		$iType            = $this->input->post('type');
		$aData            = array(
								'user_genre'                         => $sCivilite
								,'user_nom'                          => $sNom
								,'user_prenom'                       => $sPrenom
								,'user_email'                        => $sEmail
								,'user_mot_de_passe'                 => $sPass
								,'user_telephone'                    => $sTel
								,'user_date_de_naissance'            => $dDateDeNaissance
								,'user_active'                       => 'non'
								,'type_user_id'             		 => $iType
								,'user_date_inscription'             => dateFR2Time(date("d/m/Y"))
								);
		
		if($_FILES['photo']){
			$zImage    = $this->do_upload();
			if(array_key_exists('error' , $zImage)){
				echo "<div class=\"error\">Veuillez verifier le type de fichier à uploader</div>";
			}else{
				$aWhereUser = array('user_id' => $iId);
				$isUser     = $this->requetteStandard->getAll('user', 'user_id', 'asc', $aWhereUser);
				$zfile      = "./assets/media/utilisateur/" . $isUser[0]['user_photo'];
				$zthumbs    = "./assets/media/utilisateur/mini_" . $isUser[0]['user_photo'];
				if(is_file($zfile)) {
					unlink($zfile);
					unlink($zthumbs);
				}
				
				$zFileName = $zImage['upload_data']['file_name'];
				$this->resizeImage($zFileName);
				$aData            = array(
								'user_genre'                         => $sCivilite
								,'user_nom'                          => $sNom
								,'user_prenom'                       => $sPrenom
								,'user_email'                        => $sEmail
								,'user_mot_de_passe'                 => $sPass
								,'user_telephone'                    => $sTel
								,'user_date_de_naissance'            => $dDateDeNaissance
								,'user_active'                       => 'non'
								,'id_user_type'             		 => $iType
								,'user_date_inscription'             => dateFR2Time(date("d/m/Y"))
								,'user_photo'                        => $zFileName
								);
			}
		}
		//
		$aWhere  = array('user_id' => $iId);
		$bInsert = $this->requetteStandard->updateData($aData, 'user', $aWhere);
		if($bInsert != FALSE){
			//echo "<div class=\"alert-box successMsg\">Bien enregistrer</div>";
			$this->session->set_flashdata('success', '<div class="alert-box successMsg">Bien enregistrer</div>');
		}else{
			echo "<div class=\"alert-box errorMsg\">Une erreur s'est survenue pendant l'enregistrement à la base de donné</div>";
		}
		//}
	}
	private function testAdmin(){
		$aUserdata      = $this->session->userdata('user_data') ;
		if((isset($aUserdata['user_id']) > 0) && (isset($aUserdata['type_user_id']) == 1)){
		}else{
			$this->session->set_flashdata('error' , 'Vous n\'avez pas le droit d\'acceder à cette page');
			redirect('client.html' ,'refresh');
		}
	}
	public function deleteUtilisateur($_iId = "" , $_iRedirect = ""){
		$aWhere   = array('user_id' => $_iId , 'user_active' => 'non');
		//test si active
		$isActive = $this->requetteStandard->getAll('user', 'user_id', 'asc', $aWhere);
		if(is_array($isActive)){
			if($this->requetteStandard->deleteData('user' , $aWhere)){
				$zfile   = "./assets/media/utilisateur/" . $isActive[0]['user_photo'];
				$zthumbs = "./assets/media/utilisateur/mini_" . $isActive[0]['user_photo'];
				if(is_file($zfile)) {
					unlink($zfile);
					unlink($zthumbs);
				}
				$this->session->set_flashdata('success', '<div class="alert-box successMsg">Bien supprimer</div>');
			}
			if($_iRedirect != ""){
				redirect("admin-utilisateur/" . $_iRedirect . ".html", "refresh");
			}else{
				redirect("admin-utilisateur.html", "refresh");
			}
		}else{
			$this->session->set_flashdata('error', '<div class="alert-box errorMsg">Vous ne pouvez pas supprimer un utilisateur avec un statut active</div>');
			if($_iRedirect != ""){
				redirect("admin-utilisateur/" . $_iRedirect . ".html", "refresh");
			}else{
				redirect("admin-utilisateur.html", "refresh");
			}
		}
	}
	public function deleteTof($_iId = ""){
		$aWhere   = array('user_id' => $_iId);
		$toDelete = $this->requetteStandard->getAll('user', 'user_id', 'asc', $aWhere);
		$zfile    = "./assets/media/utilisateur/" . $toDelete[0]['user_photo'];
		$zthumbs  = "./assets/media/utilisateur/mini_" . $toDelete[0]['user_photo'];
		if(is_file($zfile)) {
			unlink($zfile);
			unlink($zthumbs);
		}
		$aData    = array('user_photo' => '');
		$this->requetteStandard->updateData($aData, 'user', $aWhere);
		redirect('admin-modifier-utilisateur-' . $_iId . '.html' , 'refresh');
	}
}