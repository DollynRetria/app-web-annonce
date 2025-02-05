<?php

/* * * * * * * * *  * * * * * * * * * * * 
 * * * * Requette Standard * * * *  * * *
 * * * Auteur Retria Dollyn * * * * * * *
 * * * * * * * * *  * * * * * * * * * * * 
 */
class RequetteStandard extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    /**
     * liste de liste complete dans une table
     * @return boolean|array
     */
    public function getAll($sTable, $sBy, $sOrder, $aWhere = array())
    {
        $aData = $this
            ->db
            ->from($sTable)
            ->where($aWhere)
            ->order_by($sBy, $sOrder)
            ->get()
            ->result_array();
        if ($aData) {
            return $aData;
        } else {
            return false;
        }
    }
    /**
     * liste de liste de données
     * avec limit de résultat
     * @param string $sTable
     * @param string $sBy
     * @param string $sOrder
     * @param integer $nLimit
     * @param integer $nOffset
     * @param array $aWhere
     * @return boolean|array
     */
    public function getLimit($sTable, $sBy, $sOrder, $nLimit, $nOffset, $aWhere = array())
    {
        $aData = $this
            ->db
            ->from($sTable)
            ->where($aWhere)
            ->order_by($sBy, $sOrder)
            ->limit($nLimit, $nOffset)
            ->get()
            ->result_array();
        if ($aData) {
            return $aData;
        } else {
            return false;
        }
    }
    /**
     * Insertion de données
     * @param type $aData
     * @param type $sTable
     * @return boolean|integer
     */
    public function insertData($aData, $sTable)
    {
        try {
            $this->db->insert($sTable, $aData);
            return $this->db->insert_id();
        } catch (Exception $e) {
            return FALSE;
        }
    }
	
    /**
     * Modification de données
     * @param array $aData
     * @param string $aTable
     * @param array $aWhere
     */
    public function updateData($aData, $sTable, $aWhere)
    {
        try {
            $this->db->where($aWhere);
            $this->db->update($sTable, $aData);
			return TRUE;
        } catch (Exception $e) {
            return FALSE;
        }
    }
    /**
     * Suppression d'enregistrement
     * @param string $sTable
     * @param array $aWhere
     * @return boolean
     */
    public function deleteData($sTable, $aWhere)
    {
        try {
            $this->db->delete($sTable, $aWhere);
			return TRUE;
        } catch (Exception $e) {
            return FALSE;
        }
    }
	/**
     * Compter les valeurs dans une table
     * @param string $sTable
     * @param array $aWhere
     * @return boolean
     */
	public function SelectCount($sTable = '', $aWhere = array())
    {
        $this->db->where($aWhere);
        $this->db->from($sTable);
        return $this->db->count_all_results();
    }
}

?>
