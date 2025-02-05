<?php

/* * * * * * * * *  * * * * * * * * * * * 
 * * * * Requette Utilisateur * * * *  * * *
 * * * Auteur Retria Dollyn * * * * * * *
 * * * * * * * * *  * * * * * * * * * * * 
 */
class Users extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
	public function detail($_iID = ""){
		$sSQL = "SELECT *
				 FROM `user` U
				 INNER JOIN type_user T ON T.type_user_id = U.type_user_id
				 WHERE user_id = $_iID";
		$query  = $this->db->query($sSQL);
		if ($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return FALSE;
		}
	} 
}

?>
