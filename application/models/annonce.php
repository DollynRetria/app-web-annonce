<?php

/* * * * * * * * *  * * * * * * * * * * * 
 * * * * Requette Annonce * * * *  * * *
 * * * Auteur Retria Dollyn * * * * * * *
 * * * * * * * * *  * * * * * * * * * * * 
 */
class Annonce extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	/*
	 * Fonction qui retourne la listes des annonces 
	 */
	public function listesAnnonces($iLimit = '' , $iOffset = ''){
		$sSQL = "SELECT DISTINCT A.annonce_id, A.annonce_description AS description, A.a_la_une as featured, A.annonce_titre AS titre, A.annonce_date AS dateAnnonce, T.type_annonce_type AS type , C.categorie_type AS categorie, U.user_pseudo AS pseudo
		         FROM `annonce` A
		         INNER JOIN type_annonce T ON T.type_annonce_id = A.type_annonce_id
		         INNER JOIN categorie C ON C.categorie_id  = A.categorie_id
		         INNER JOIN user U ON U.user_id = A.user_id
				 ORDER BY `A`.`annonce_id` DESC 
		         LIMIT $iLimit , $iOffset";
		$query  = $this->db->query($sSQL);
		if ($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return FALSE;
		}
	}
	/*
	 * Fonction qui retourne la listes des annonces à la une
	 */
	public function listesFeatured(){
		$sSQL = "SELECT DISTINCT A.annonce_id, A.annonce_description AS description, A.a_la_une as featured, A.annonce_titre AS titre, A.annonce_date AS dateAnnonce, T.type_annonce_type AS type , C.categorie_type AS categorie, U.user_pseudo AS pseudo
		         FROM `annonce` A
		         INNER JOIN type_annonce T ON T.type_annonce_id = A.type_annonce_id
		         INNER JOIN categorie C ON C.categorie_id  = A.categorie_id
		         INNER JOIN user U ON U.user_id = A.user_id
				 WHERE A.a_la_une = 1
				 ORDER BY `A`.`annonce_id` DESC 
		         LIMIT 0 , 4";
		$query  = $this->db->query($sSQL);
		if ($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return FALSE;
		}
	}
	/*
	 * Fonction qui retourne la listes des annonces par categorie
	 */
	public function listesAnnoncesCateg($_type = 0 , $i_categ = 0 , $iLimit = '' , $iOffset = ''){
		$sSQL = "SELECT DISTINCT A.annonce_id, A.annonce_description AS description, A.annonce_titre AS titre, A.annonce_date AS dateAnnonce, T.type_annonce_type AS type , C.categorie_type AS categorie, U.user_pseudo AS pseudo
		         FROM `annonce` A
		         INNER JOIN type_annonce T ON T.type_annonce_id = A.type_annonce_id
		         INNER JOIN categorie C ON C.categorie_id  = A.categorie_id
		         INNER JOIN user U ON U.user_id = A.user_id
				 WHERE A.categorie_id =" . $i_categ . " AND A.type_annonce_id = " . $_type ."
				 ORDER BY `A`.`annonce_id` DESC 
		         LIMIT $iLimit , $iOffset";
		$query  = $this->db->query($sSQL);
		if ($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return FALSE;
		}
	}
	
	/*
	 * Fonction qui recupere une Annonce par ID
	 */
	public function getAnnonce($_iID = ""){
		$sSQL = "SELECT DISTINCT A.annonce_id, A.annonce_titre AS titre, A.annonce_description AS descripiton, A.annonce_date AS dateAnnonce, T.type_annonce_type AS TYPE , C.categorie_type AS categorie, U.user_pseudo AS pseudo
				FROM `annonce` A
				INNER JOIN type_annonce T ON T.type_annonce_id = A.type_annonce_id
				INNER JOIN categorie C ON C.categorie_id = A.categorie_id
				INNER JOIN user U ON U.user_id = A.user_id
				WHERE A.annonce_id =" . $_iID;
		$query  = $this->db->query($sSQL);
		if ($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return FALSE;
		}
	}
	/*
	 * Fonction qui retourne la listes des annonces d'un utilisateur
	 */
	public function listesAnnoncesUser($i_userid = 0 , $iLimit = '' , $iOffset = ''){
		$sSQL = "SELECT DISTINCT A.annonce_id, A.annonce_titre AS titre, A.annonce_date AS dateAnnonce, T.type_annonce_type AS type , C.categorie_type AS categorie, U.user_pseudo AS pseudo
		         FROM `annonce` A
		         INNER JOIN type_annonce T ON T.type_annonce_id = A.type_annonce_id
		         INNER JOIN categorie C ON C.categorie_id  = A.categorie_id
		         INNER JOIN user U ON U.user_id = A.user_id
				 WHERE A.user_id =" . $i_userid . "
				 ORDER BY `A`.`annonce_id` DESC 
		         LIMIT " . $iLimit . "," . $iOffset;
		$query  = $this->db->query($sSQL);
		if ($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return FALSE;
		}
	}
	public function SelectCountAnnonce($sTable = '', $aWhere = array())
    {
        $this->db->where($aWhere);
        $this->db->from($sTable);
        return $this->db->count_all_results();
    }
	/*
	 * Fonction qui retourne la listes des annonces 
	 */
	public function rechercher($iPost, $iLimit = '' , $iOffset = ''){
		$zCritere = "";
		if(!empty($iPost['critere'])){
			$zCritere = "`annonce_description` LIKE \"%" . $iPost['critere'] . "%\" OR `annonce_titre` LIKE \"%" . $iPost['critere'] . "%\" AND";
		}
		if(!empty($iPost['critere'])&&(!isset($iPost['categorie']) && !isset($iPost['type_annonce_type']))){
			$zCritere = "`annonce_description` LIKE \"%" . $iPost['critere'] . "%\" OR `annonce_titre` LIKE \"%" . $iPost['critere'] . "%\"";
		}
		$iCateg = "";
		if(!empty($iPost['categorie'])){
			$iCateg = "`categorie_id` = \"" . $iPost['categorie'] . "\" AND ";
		}
		if(!empty($iPost['categorie'])&&(!isset($iPost['critere']) && !isset($iPost['type_annonce_type']))){
			$iCateg = "`categorie_id` = \"" . $iPost['categorie'] . "\"";
		}
		$iType = "";
		if(!empty($iPost['type_annonce_type'])){
			$iType = "`type_annonce_id` = \"" . $iPost['type_annonce_type'] . "\"";
		}
		
		$sSQL = "SELECT *
				 FROM `annonce`
				 WHERE " . $zCritere . $iCateg . $iType . "
		         LIMIT $iLimit , $iOffset";
		$query  = $this->db->query($sSQL);
		if ($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return FALSE;
		}
	}
 
}

?>
