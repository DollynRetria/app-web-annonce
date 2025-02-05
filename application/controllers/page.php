<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('annonce');
	}
	public function index()
	{
		$aData['title']      = "Bienvenue | ";
		$zJs                 = array('jquery.cycle.all.js', 'notConnected.js', 'home.js');
		$aData['zJs']        = $zJs;
		$aData['controller'] = $this;
		$aData['type']       =  $this->requetteStandard->getAll('type_annonce', 'type_annonce_id', 'ASC' ,  array());
		$aData['categorie']  =  $this->requetteStandard->getAll('categorie', 'categorie_id', 'ASC' ,  array());
		$aData['aListes']    = $this->annonce->listesFeatured();
		$this->load->view('front/home', $aData);
	}
	/*
	 * Function qui listes toutes les annonces
	 */
	public function categ($_type = 0, $_categorie = 0 , $_iPerpage = 0){
		$this->load->library('pagination');
		$aData['title']           = "Listes des annonces";
		$aListes                  = $this->annonce->listesAnnoncesCateg($_type, $_categorie, $_iPerpage , PER_PAGE_CATEG);
		$aConfig['uri_segment']   = 5;
		$aConfig['base_url']      = site_url('page/categ/' . $_type . '/'. $_categorie);
		//$aConfig['suffix']        = '.html';
		$aConfig['first_url']     = $aConfig['base_url'];
		$aConfig['total_rows']    = $this->requetteStandard->SelectCount('annonce', $aWhere=array('categorie_id'=>$_categorie)) ;
		$aConfig['per_page']      = PER_PAGE_CATEG;
		$aConfig['cur_tag_open']  = '<span class="page active">';
		$aConfig['cur_tag_close'] = '</span>';
		$this->pagination->initialize($aConfig);
		$aData['aListes']         = $aListes;
		$aData['controller']      = $this; 
		$aData['pagination']      = $this->pagination->create_links() ;
		$this->load->view('front/categorie' , $aData);
	}
	public function image($_iIdAnnonce = 0, $_alt = ""){
		$aWhere  = array('annonce_id' => $_iIdAnnonce);
		$zImage  = $this->requetteStandard->getLimit('image', 'image_id', 'ASC', 1, 0, $aWhere);
		$zImage  = base_url() . 'assets/media/annonces/' .$_iIdAnnonce .'/' . $zImage[0]['image_nom'];
		return '<img src="' . base_url() . 'timthumb.php?src='. $zImage .'&h=152&w=202" alt="'. $_alt .'" />';
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
	public function rechercher(){
		if(isset($_POST)){
			$iPost   = array_filter($_POST);
			$aResult = $this->annonce->rechercher($iPost , 0 , PER_PAGE_CATEG);
			$this->load->library('pagination');
			$aData['title']           = "Listes des annonces";
			$aConfig['uri_segment']   = 5;
			$aConfig['base_url']      = site_url('page/rechercher/');
			//$aConfig['suffix']        = '.html';
			$aConfig['first_url']     = $aConfig['base_url'];
			//$aConfig['total_rows']    = $this->requetteStandard->SelectCount('annonce', $aWhere=array('categorie_id'=>$_categorie)) ;
			$aConfig['per_page']      = PER_PAGE_CATEG;
			$aConfig['cur_tag_open']  = '<span class="page active">';
			$aConfig['cur_tag_close'] = '</span>';
			$this->pagination->initialize($aConfig);
			$aData['aListes']         = $aResult;
			$aData['controller']      = $this; 
			$aData['critere']         = $_POST['critere'];
			$aData['pagination']      = $this->pagination->create_links() ;
			$this->load->view('front/search' , $aData);
		}
	}
	public function detail($_iID = ""){
		$aAnnonce = $this->annonce->getAnnonce($_iID);
		$aWhere   = array('annonce_id' => $_iID);
		$aData['controller']      = $this; 
		$aImage   = $this->requetteStandard->getAll('image', 'image_id', 'ASC', $aWhere);
		$aData['title']    = 'Annonce : ' . $aAnnonce[0]['titre'];
		$aData['aAnnonce'] = $aAnnonce;
		$aData['aImage'] = $aImage;
		$this->load->view('front/detail' , $aData);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */