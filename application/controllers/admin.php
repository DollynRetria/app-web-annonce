<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * * * * Controller pour la gestion * * *
 * * * des annonces et des utilisateurs *
 * * * Auteur Retria Dollyn * * * * * * *
 * * * * * * * * *  * * * * * * * * * * * 
 */
class Admin extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->output->set_header("Cache-Control: no-cache, no-store, must-revalidate");
    	$this->output->set_header("Pragma: no-cache");
		$this->load->model('annonce');
		$this->load->library('form_validation');
		$bAdmin = '';
		if($this->session->userdata('admin_data')){
			$bAdmin = $this->session->userdata('admin_data');
		}
		if($bAdmin!=TRUE){
			$this->session->set_flashdata('error', '<div class="alert-box errorMsg">Vous n\'avez pas assez de droit pour voir cette page</div>');
			redirect(site_url("client/admin"), "refresh");
		}
		
	}
	public function index()
	{
		$this->listesAnnonces();
	}
	/*
	 * Function qui listes toutes les annonces
	 */
	public function listesAnnonces($_iPerpage = 0){
		$this->load->library('pagination');
		$aData['title']           = "Listes des annonces";
		//$aListes                  = $this->requetteStandard->getLimit('annonce', 'annonce_id', 'ASC' , 1, $_iPerpage) ;
		$aListes                  = $this->annonce->listesAnnonces($_iPerpage , PER_PAGE);
		$aConfig['uri_segment']   = 3;
		$aConfig['base_url']      = site_url('admin/listesAnnonces');
		//$aConfig['suffix']        = '.html';
		$aConfig['first_url']     = $aConfig['base_url'];
		$aConfig['total_rows']    = $this->requetteStandard->SelectCount('annonce') ;
		$aConfig['per_page']      = PER_PAGE;
		$aConfig['cur_tag_open']  = '<span class="page active">';
		$aConfig['cur_tag_close'] = '</span>';
		$this->pagination->initialize($aConfig);
		$aData['aListes']         = $aListes;
		$aData['pagination']      = $this->pagination->create_links() ;
		$this->load->view('admin/annonce/listes' , $aData);
	}
	public function annonceDetail($_iID = ""){
		$aAnnonce = $this->annonce->getAnnonce($_iID);
		$aWhere   = array('annonce_id' => $_iID);
		$aImage   = $this->requetteStandard->getAll('image', 'image_id', 'ASC', $aWhere);
		$aData['title']    = 'Annonce : ' . $aAnnonce[0]['titre'];
		$aData['aAnnonce'] = $aAnnonce;
		$aData['aImage'] = $aImage;
		$this->load->view('admin/annonce/detail' , $aData);
	}
	/*
	 * Function qui permet d'ajouter des annonces
	 */
	public function ajoutAnnonces(){
		$aData['title']     = "Ajout d'annonce";
		$aData['type']      =  $this->requetteStandard->getAll('type_annonce', 'type_annonce_id', 'ASC' ,  array());
		$aData['categorie'] =  $this->requetteStandard->getAll('categorie', 'categorie_id', 'ASC' ,  array());
		$zJs                = array('jquery.form.js','jquery.validate.min.js', 'tiny_mce.js', 'addAnnonce.js' );
		$aData['zJs']       = $zJs;
		$aData['zJsFoot']   = array('customupload.js');
		$this->load->view('admin/annonce/ajoutAnnonce' , $aData);
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
			$aData['title']     = "Ajout d'annonce";
			$aData['type']      =  $this->requetteStandard->getAll('type_annonce', 'type_annonce_id', 'ASC' ,  array());
			$aData['categorie'] =  $this->requetteStandard->getAll('categorie', 'categorie_id', 'ASC' ,  array());
			$zJs                = array('jquery.form.js','jquery.validate.min.js', 'tiny_mce.js', 'addAnnonce.js' );
			$aData['zJs']       = $zJs;
			$aData['zJsFoot']   = array('customupload.js');
			$this->load->view('admin/annonce/ajoutAnnonce' , $aData);
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
						$this->resizeImage($zImage['file_name'], 100,100, 'thumbs',$iLastInsertId);
						$this->resizeImage($zImage['file_name'], 500,500, 'medium',$iLastInsertId);
						$this->watermark('medium_' . $zImage['file_name'],$iLastInsertId);
					}
					/*
					 * Fin upload d'images et redimensionnement
					 * plus insertion dans la base
					 *
					 */
				}
				$this->session->set_flashdata('success', '<div class="alert-box successMsg">Bien enregistrer</div>');
				redirect('admin' , 'refresh');
			}
		}
	}
	/*
	 * Function de redimensionnement d'image
	 */
	public function resizeImage($_zimg = "", $iWidth = 50, $iHeight = 50, $_ztype = "thumbs", $iFolder){
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
		$aWhere             = array('annonce_id' => $_iIdAnnonce);
		$aData['title']     = "Modification d'annonce";
		$aData['type']      =  $this->requetteStandard->getAll('type_annonce', 'type_annonce_id', 'ASC' ,  array());
		$aData['categorie'] =  $this->requetteStandard->getAll('categorie', 'categorie_id', 'ASC' ,  array());
		$aData['zToModify'] =  $this->requetteStandard->getAll('annonce', 'annonce_id', 'ASC' , $aWhere);
		$zJs                = array('jquery.form.js','jquery.validate.min.js', 'tiny_mce.js', 'addAnnonce.js' );
		$aData['zJs']       = $zJs;
		$this->load->view('admin/annonce/modifierAnnonce' , $aData);
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
			$aData['title']     = "Ajout d'annonce";
			$aWhere             = array('annonce_id' => $iId);
			$aData['type']      =  $this->requetteStandard->getAll('type_annonce', 'type_annonce_id', 'ASC' ,  array());
			$aData['categorie'] =  $this->requetteStandard->getAll('categorie', 'categorie_id', 'ASC' ,  array());
			$aData['zToModify'] =  $this->requetteStandard->getAll('annonce', 'annonce_id', 'ASC' , $aWhere);
			$this->load->view('admin/annonce/modifierAnnonce' , $aData);
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
				//echo "Bien enregistrer";
				redirect('admin' , 'refresh');
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
		redirect('admin' , 'refresh');
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
	public function a_la_une(){
		$aData  = array('a_la_une' => $this->input->post('action'));
		$aWhere =  array('annonce_id' => $this->input->post('iId'));
		if($this->requetteStandard->updateData($aData, 'annonce', $aWhere) == TRUE){
			//echo "Bien enregistrer";
			redirect($this->input->post('redirect') , 'refresh');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */