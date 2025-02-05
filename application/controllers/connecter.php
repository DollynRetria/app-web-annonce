<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Connecter extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->output->set_header("Cache-Control: no-cache, no-store, must-revalidate");
    	$this->output->set_header("Pragma: no-cache");
		$this->load->model('Users');
		$this->load->model('annonce');
		$this->load->library('form_validation');
		$this->testUserConnected();
	}
	public function index()
	{
		$userId              =  $this->session->userdata('user_data');
		$zUtilisateur        = $this->Users->detail($userId[0]['user_id']);
		$aData['title']      = 'Profil de : ' . $zUtilisateur[0]['user_genre'] . ' '. $zUtilisateur[0]['user_nom'] . ' ' . $zUtilisateur[0]['user_prenom'];
		$aData['profil']     = $zUtilisateur;
		$aData['controller'] = $this; 
		$this->load->view('front/connecter', $aData);
	}
	public function modifier($_iId = ""){
		$aData['title']       = "Modifier un utilisateur";
		$zJs                  = array('jquery.form.js','jquery.validate.min.js','modifUserFront.js');
		$aData['zJsFoot']     = array('customupload.js');
		$aData['zJs']         = $zJs;
		$aData['type']        = $this->requetteStandard->getAll('type_user', 'type_user_id', 'DESC', array());
		$aWhere               = array('user_id' => $_iId);
		$aData['utilisateur'] = $this->requetteStandard->getAll('user', 'user_id', 'DESC', $aWhere);
		$aData['iuserId']     = $_iId;
		$aData['controller']  = $this; 
		$this->load->view('front/modifierUtilisateur' , $aData);
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
								,'type_user_id'             		 => $iType
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
		redirect('connecter/modifier/' . $_iId . '.html' , 'refresh');
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
	public function annonces($_iPerpage = 0){
		$iUserId                  = $this->session->userdata('user_data');
		$iUserId                  = $iUserId[0]['user_id'];
		$this->load->library('pagination');
		$aData['title']           = "Listes des annonces";
		$aListes                  = $this->annonce->listesAnnoncesUser($iUserId , $_iPerpage , PER_PAGE);
		$aConfig['uri_segment']   = 3;
		$aConfig['base_url']      = site_url('connecter/annonces');
		$aConfig['first_url']     = $aConfig['base_url'];
		$aConfig['total_rows']    = $this->requetteStandard->SelectCount('annonce', array('user_id' => $iUserId)) ;
		$aConfig['per_page']      = PER_PAGE;
		$aConfig['cur_tag_open']  = '<span class="page active">';
		$aConfig['cur_tag_close'] = '</span>';
		$this->pagination->initialize($aConfig);
		$aData['aListes']         = $aListes;
		$aData['pagination']      = $this->pagination->create_links() ;
		$aData['controller']      = $this; 
		$this->load->view('front/annonce' , $aData);
	}
	
	public function annonceDetail($_iID = ""){
		$aAnnonce = $this->annonce->getAnnonce($_iID);
		$aWhere   = array('annonce_id' => $_iID);
		$aImage   = $this->requetteStandard->getAll('image', 'image_id', 'ASC', $aWhere);
		$aData['title']      = 'Annonce : ' . $aAnnonce[0]['titre'];
		$aData['aAnnonce']   = $aAnnonce;
		$aData['aImage']     = $aImage;
		$aData['controller'] = $this; 
		$this->load->view('front/detail' , $aData);
	}
	/*
	 * Function qui permet d'ajouter des annonces
	 */
	public function ajoutAnnonces(){
		$aData['title']      = "Ajout d'annonce";
		$aData['type']       =  $this->requetteStandard->getAll('type_annonce', 'type_annonce_id', 'ASC' ,  array());
		$aData['categorie']  =  $this->requetteStandard->getAll('categorie', 'categorie_id', 'ASC' ,  array());
		$zJs                 = array('jquery.form.js','jquery.validate.min.js', 'tiny_mce.js', 'addAnnonce.js' );
		$aData['zJs']        = $zJs;
		$aData['zJsFoot']    = array('customupload.js');
		$aData['controller'] = $this; 
		$this->load->view('front/ajoutAnnonce' , $aData);
	}
	/*
	 * Function qui permet de sauver une annonces
	 */
	public function sauvAnnonces(){
		$iUserId = $this->input->post('user_id');
		$iType   = $this->input->post('type_annonce_type');
		$iCateg  = $this->input->post('categorie');
		$sTitre  = $this->input->post('annonce_titre');
		$sDesc   = $this->input->post('description');
		$aConfig = array(
                       array( 'field'   => 'type_annonce_type' , 'label'   => 'Type', 'rules'   => 'required'  ),
					   array( 'field'   => 'categorie' , 'label'   => 'categorie', 'rules'   => 'required'  ),
					   array( 'field'   => 'annonce_titre' , 'label'   => 'Titre de l\'annonce', 'rules'   => 'required'  ),
					   array( 'field'   => 'description' , 'label'   => 'description', 'rules'   => 'required'  )
                   );
		$this->form_validation->set_rules($aConfig); 
		if ($this->form_validation->run() == FALSE)
		{
			$aData['title']      = "Ajout d'annonce";
			$aData['type']       =  $this->requetteStandard->getAll('type_annonce', 'type_annonce_id', 'ASC' ,  array());
			$aData['categorie']  =  $this->requetteStandard->getAll('categorie', 'categorie_id', 'ASC' ,  array());
			$zJs                 = array('jquery.form.js','jquery.validate.min.js', 'tiny_mce.js', 'addAnnonce.js' );
			$aData['zJs']        = $zJs;
			$aData['zJsFoot']    = array('customupload.js');
			$aData['controller'] = $this; 
			$this->load->view('front/ajoutAnnonce' , $aData);
		}else{
			$aData = array(
						 'annonce_titre'       => $sTitre
						,'annonce_date'        => date("Y-m-d")
						,'user_id'             => $iUserId
						,'type_annonce_id'     => $iType
						,'annonce_description' => $sDesc
						,'categorie_id'        => $iCateg
					);
			//upload
			$iLastInsertId = $this->requetteStandard->insertData($aData, 'annonce');
			if($iLastInsertId != FALSE){
				
				//creation d'un dossier pour l'annonce
				$zFolder = './assets/media/annonces/' . $iLastInsertId;
				mkdir($zFolder,0777); 
				$aConfig['upload_path']   = $zFolder .'/';
				$aConfig['allowed_types'] = 'gif|jpg|png';
				$aConfig['max_size']      = '2000';
				$aConfig['encrypt_name']  = TRUE;
				$this->load->library('upload', $aConfig);
				if ($_FILES['images']) {
					$aImages = $this->_upload_files('images');
					/*
					 * upload d'images et redimensionnement
					 * plus insertion dans la base
					 *
					 */
					foreach($aImages as $zImage){
						//create thumbs
						$aDataImage = array('image_nom' => $zImage['file_name'], 'annonce_id' => $iLastInsertId);
						$this->requetteStandard->insertData($aDataImage, 'image');
						$this->resizeImageAnnonce($zImage['file_name'], 100,100, 'thumbs',$iLastInsertId);
						$this->resizeImageAnnonce($zImage['file_name'], 500,500, 'medium',$iLastInsertId);
						$this->watermark('medium_' . $zImage['file_name'],$iLastInsertId);
					}
					/*
					 * Fin upload d'images et redimensionnement
					 * plus insertion dans la base
					 *
					 */
				}
				$this->session->set_flashdata('success', '<div class="alert-box successMsg">Bien enregistrer</div>');
				redirect('connecter/annonces' , 'refresh');
			}
		}
	}
	/*
	 * Function de redimensionnement d'image
	 */
	public function resizeImageAnnonce($_zimg = "", $iWidth = 50, $iHeight = 50, $_ztype = "thumbs", $iFolder){
		$config['image_library'] = 'gd2';
		$config['source_image']	= './assets/media/annonces/'. $iFolder . '/' .$_zimg;
		$config['new_image']	= './assets/media/annonces/'. $iFolder . '/' . $_ztype . '_'.$_zimg;
		$config['width']	 = $iWidth;
		$config['height']	= $iHeight;
		$this->load->library('image_lib');
		$this->image_lib->clear();
		$this->image_lib->initialize($config);
		if ( ! $this->image_lib->resize())
		{
			return false;
		}else{
			return true;
		}
	}
	/*
	 * Function pour le copyright
	 */
	public function watermark($_zimg = "",$iFolder){
		$config['source_image'] = './assets/media/annonces/' .$iFolder .'/' . $_zimg;
		$config['wm_font_path'] = './system/fonts/texb.ttf';
		$config['wm_text'] = 'Copyright 2014 - Dollyn';
		$config['wm_type'] = 'text';
		$config['wm_font_size'] = '16';
		$config['wm_font_color'] = 'ff0000';
		$config['wm_vrt_alignment'] = 'middle';
		$config['wm_hor_alignment'] = 'center';
		$config['wm_padding'] = '20';
		$this->load->library('image_lib');
		$this->image_lib->clear();
		$this->image_lib->initialize($config);
		$this->image_lib->watermark();
	}
	/**
	* @return array an array of your files uploaded.
	*/
	private function _upload_files($field='userfile'){
		$files = array();
		foreach( $_FILES[$field] as $key => $all ){
			foreach( $all as $i => $val ){
				$files[$i][$key] = $val;
			}
		}
		$files_uploaded = array();
		for ($i=0; $i < count($files); $i++) { 
			$_FILES[$field] = $files[$i];
			if ($this->upload->do_upload($field)){
				$files_uploaded[$i] = $this->upload->data($files);
			}else{
				$files_uploaded[$i] = null;
			}
		}
		return $files_uploaded;
	}
	/*
	 * Function qui permet de modifier une annonce
	 */
	public function modifAnnonces($_iIdAnnonce = 0){
		$aWhere              = array('annonce_id' => $_iIdAnnonce);
		$aData['title']      = "Modification d'annonce";
		$aData['type']       =  $this->requetteStandard->getAll('type_annonce', 'type_annonce_id', 'ASC' ,  array());
		$aData['categorie']  =  $this->requetteStandard->getAll('categorie', 'categorie_id', 'ASC' ,  array());
		$aData['zToModify']  =  $this->requetteStandard->getAll('annonce', 'annonce_id', 'ASC' , $aWhere);
		$zJs                 = array('jquery.form.js','jquery.validate.min.js', 'tiny_mce.js', 'addAnnonce.js' );
		$aData['zJs']        = $zJs;
		$aData['zJsFoot']    = array('customupload.js');
		$aData['controller'] = $this; 
		$this->load->view('front/modifierAnnonce' , $aData);
	}
	/*
	 * Function qui permet de sauver les modification d'une annonce
	 */
	public function updateAnnonces(){
		$iUserId = $this->input->post('user_id');
		$iType   = $this->input->post('type_annonce_type');
		$iCateg  = $this->input->post('categorie');
		$sTitre  = $this->input->post('annonce_titre');
		$sDesc   = $this->input->post('description');
		$iId     = $this->input->post('id');
		$aConfig = array(
                       array( 'field'   => 'type_annonce_type' , 'label'   => 'Type', 'rules'   => 'required'  ),
					   array( 'field'   => 'categorie' , 'label'   => 'categorie', 'rules'   => 'required'  ),
					   array( 'field'   => 'annonce_titre' , 'label'   => 'Titre de l\'annonce', 'rules'   => 'required'  ),
					   array( 'field'   => 'description' , 'label'   => 'description', 'rules'   => 'required'  )
                   );
		$this->form_validation->set_rules($aConfig); 
		if ($this->form_validation->run() == FALSE)
		{
			$aData['title']      = "Ajout d'annonce";
			$aWhere              = array('annonce_id' => $iId);
			$aData['type']       =  $this->requetteStandard->getAll('type_annonce', 'type_annonce_id', 'ASC' ,  array());
			$aData['categorie']  =  $this->requetteStandard->getAll('categorie', 'categorie_id', 'ASC' ,  array());
			$aData['zToModify']  =  $this->requetteStandard->getAll('annonce', 'annonce_id', 'ASC' , $aWhere);
			$aData['zToModify']  =  $this->requetteStandard->getAll('annonce', 'annonce_id', 'ASC' , $aWhere);
			$zJs                 = array('jquery.form.js','jquery.validate.min.js', 'tiny_mce.js', 'addAnnonce.js' );
			$aData['zJs']        = $zJs;
			$aData['zJsFoot']    = array('customupload.js');
			$aData['controller'] = $this; 
			$this->load->view('front/modifierAnnonce' , $aData);
		}else{
			$aData = array(
						 'annonce_titre'       => $sTitre
						,'annonce_date'        => date("Y-m-d")
						,'user_id'             => $iUserId
						,'type_annonce_id'     => $iType
						,'annonce_description' => $sDesc
						,'categorie_id'        => $iCateg
					);
			$aWhere  = array('annonce_id' => $iId);
			if($this->requetteStandard->updateData($aData, 'annonce', $aWhere) == TRUE){
				redirect('connecter/annonces' , 'refresh');
			}
		}
	}
	/*
	 * Function qui permet de supprimer une annonce
	 */
	public function deleteAnnonces($_iIdAnnonce = 0){
		$aWhere  = array('annonce_id' => $_iIdAnnonce);
		$zFolder = './assets/media/annonces/' .$_iIdAnnonce;
		echo is_dir($zFolder);
		if(is_dir($zFolder)){
			$this->deleteDirectory($zFolder);
		}
		$this->requetteStandard->deleteData('annonce', $aWhere);
		$this->requetteStandard->deleteData('image', $aWhere);
		redirect('connecter/annonces' , 'refresh');
	}
	/*
	 * Function qui permet de supprimer une repertoire
	 */
	private function deleteDirectory($dirPath) {
    	if (is_dir($dirPath)) {
			$objects = scandir($dirPath);
			foreach ($objects as $object) {
				if ($object != "." && $object !="..") {
					if (filetype($dirPath . DIRECTORY_SEPARATOR . $object) == "dir") {
						deleteDirectory($dirPath . DIRECTORY_SEPARATOR . $object);
					} else {
						unlink($dirPath . DIRECTORY_SEPARATOR . $object);
					}
				}
			}
		reset($objects);
		rmdir($dirPath);
		}
	}
	public function testUserConnected(){
		$aUser = $this->session->userdata('user_data');
		if(!empty($aUser)){
			foreach($aUser as $aItem){
				$iUserId = $aItem['user_id'];
			}
		}else{
			$iUserId = 0 ;
		}
		if($iUserId < 1){
			$this->session->set_flashdata('error', '<div class="alert-box errorMsg">Vous n\'êtes pas autorisée à visualisé cette page</div>');
			redirect('client' , 'refresh');
		}
	}
	//retourne le menu
	public function menu(){
		$aMenu    = $this->requetteStandard->getAll('type_annonce', 'type_annonce_id', 'ASC', $aWhere=array());
		$aSubMenu = $this->requetteStandard->getAll('categorie', 'categorie_id', 'ASC', $aWhere=array());
		$zMenu    = "";
		foreach($aMenu as $zMenuItem){
			$zMenu    .= '<li><a href="#">' . $zMenuItem['type_annonce_type'] . '</a>';
			if(!empty($aSubMenu)){
				$zSubMenu  = "<ul>";
				foreach($aSubMenu as $zSubMenuItem){
					$zSubMenu    .= '<li><a href="' . site_url('page/categ/'. $zMenuItem['type_annonce_id'] . '/'. $zSubMenuItem['categorie_id']) . '">' . $zSubMenuItem['categorie_type'] . '</a></li>';
				}
				$zSubMenu .= "</ul>";
			}
			$zSubMenu .= "</li>";
			$zMenu    .= $zSubMenu;
		}
		echo $zMenu;
	}
}