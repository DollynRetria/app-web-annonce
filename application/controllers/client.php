<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Client extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->output->set_header("Cache-Control: no-cache, no-store, must-revalidate");
    	$this->output->set_header("Pragma: no-cache");
		$this->load->library('form_validation');
		
	}
	public function index()
	{
		$aData['title']      = "Espace client : Nouveau utilisateur";
		$zJs                 = array('jquery.form.js','jquery.validate.min.js','notConnected.js','client.js');
		$aData['zJsFoot']    = array('customupload.js');
		$aData['zJs']        = $zJs;
		$aData['zJsFoot']    = array('customupload.js');
		$aData['controller'] = $this; 
		$aData['type']       = $this->requetteStandard->getAll('type_user', 'type_user_id', 'DESC', $aWhere=array());
		
		$this->load->view('front/client', $aData);
	}
	/*
	 * Fonction qui enregistre une nouvelle utilisateur
	 */
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
				$iType            = $this->input->post('user_type');
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
	public function countMail(){
		$iCount = $this->requetteStandard->SelectCount('user', array('user_email' => $this->input->post('mail')));
		echo $iCount;
	}
	public function countPseudo(){
		$iCount = $this->requetteStandard->SelectCount('user', array('user_pseudo' => $this->input->post('pseudo')));
		echo $iCount;
	}
	public function connecter(){
		$aWhere = array("user_email"        => $this->input->post('useremail')
		               ,"user_mot_de_passe" => $this->input->post('userpass'));
		$iCount = $this->requetteStandard->SelectCount('user',$aWhere);
		if($iCount>0){
			$aUser  = $this->requetteStandard->getAll('user', 'user_id', 'ASC', $aWhere);
			$this->session->set_userdata('user_data', $aUser);
			echo 1;
		}else{
			echo 0;
		}
	}
	public function deconnexion(){
		$this->session->unset_userdata('user_data');
		redirect("client", "refresh");
	}
	public function deconnexionAdmin(){
		$this->session->unset_userdata('admin_data');
		$this->session->set_flashdata('success', '<div class="alert-box successMsg">Vous êtes deconnecter</div>');
		redirect(site_url("client/admin"), "refresh");
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
	public function admin(){
		$aData['title']    = 'Admin';
		$this->load->view("admin/login", $aData);
	}
	public function isAdmin(){
		$this->form_validation->set_rules('userpseudo', 'Pseudo', 'required');
		$this->form_validation->set_rules('userpass', 'Pass', 'required');
		if ($this->form_validation->run() == FALSE)
		{
			$aData['title']    = 'Admin';
			$this->load->view("admin/login", $aData);
		}else{
			//pseudo = sanator
			//pass   = nirvana
			$userPseudo = $this->input->post('userpseudo');
			$userPass   = $this->input->post('userpass');
			$zToken     = $userPseudo . $userPass;
			if($zToken == "sanatornirvana" ){
				$bAdmin = TRUE;
				$this->session->set_userdata('admin_data', $bAdmin);
				redirect(site_url("admin"), "refresh");
			}else{
				$this->session->set_flashdata('error', '<div class="alert-box errorMsg">Utilisateur inconnue</div>');
				redirect(site_url("client/admin"), "refresh");
			}
		}
	}
}