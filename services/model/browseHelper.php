<?php

class browseHelper extends Database {
	
    var $prefix;
    function __construct()
    {

        $this->prefix = "peerkalbar";
    }

    /**
     * @todo retrieve all data from table Taxon
     * @return id, rank, morphotype, fam, gen, sp, subtype, ssp, auth, notes
     */
    function dataTaxon(){
        $sql= "SELECT * FROM {$this->prefix}_taxon WHERE id in (SELECT det.taxonID FROM {$this->prefix}_det INNER JOIN {$this->prefix}_indiv on indiv.id = det.indivID WHERE indiv.n_status = 0)";
        $res = $this->fetch($sql,1);
        $return['result'] = $res;
        return $return;
    }

    /**
     * @todo retrieve all data from table Taxon
     * @return id, rank, morphotype, fam, gen, sp, subtype, ssp, auth, notes
     */
    function dataIndivLimit(){
        $sql= "SELECT * FROM {$this->prefix}_img WHERE md5sum <> '' GROUP BY indivID ORDER BY id DESC LIMIT 10";
        $res = $this->fetch($sql,1);
        $return['result'] = $res;
        return $return;
    }

    /**
     * @todo retrieve all images from taxon data
     * @param $data = id taxon
     */
    function getImgTaxon($data){
        $sql = "SELECT * 
                FROM `{$this->prefix}_det` INNER JOIN `{$this->prefix}_img` ON 
                    det.taxonID='$data' AND det.indivID=img.indivID GROUP BY img.md5sum LIMIT 0,5";
        $res = $this->fetch($sql,1);
        return $res;
    }

    /**
     * @todo retrieve title from selected species
     * @param $data = id title
     */
    function getTitle($data){
        $sql = "SELECT sp FROM {$this->prefix}_taxon WHERE id = $data";
        $res = $this->fetch($sql,1);
        return $res;
    }

    /**
     * @todo retrieve all data from table location
     * @return 
     */
    function dataLocation(){
        $sql= "SELECT * FROM `{$this->prefix}_locn` WHERE id in (SELECT indiv.locnID FROM {$this->prefix}_indiv inner join {$this->prefix}_det on indiv.id = det.indivID WHERE indiv.n_status = 0)";
        $res = $this->fetch($sql,1);
        $return['result'] = $res;
        return $return;
    }

    /**
     * @todo retrieve all data from table person
     * @return 
     */
    function dataPerson(){
        $sql= "SELECT * FROM `{$this->prefix}_person`";
        $res = $this->fetch($sql,1);
        $return['result'] = $res;
        return $return;
    }
	
    /**
     * @todo retrieve all data from table indiv from selected taxon
     * 
     * @param $value=id taxon
     * @return 
     */
    function dataIndivTaxon($value){
        $sql = "SELECT * 
                FROM `{$this->prefix}_det` INNER JOIN `{$this->prefix}_indiv` ON 
                    det.taxonID='$value' AND det.indivID=indiv.id AND indiv.n_status='0'
                INNER JOIN `{$this->prefix}_person` ON
                    indiv.personID=person.id
                INNER JOIN `{$this->prefix}_locn` ON
                    locn.id=indiv.locnID
                GROUP BY det.indivID";
        
        $res = $this->fetch($sql,1);
        $return['result'] = $res;
        return $return;
    }

    /**
     * @todo retrieve images from indiv data
     * @param $data = id indiv
     */
    function showImgIndiv($data){
        $sql = "SELECT * FROM `{$this->prefix}_img` WHERE indivID='$data' AND md5sum IS NOT NULL LIMIT 0,5";
        $res = $this->fetch($sql,1);
        return $res;
    }

    /**
     * @todo retrieve all data from table indiv from selected location
     * 
     * @param $value=id location
     * @return 
     */
    function dataIndivLocation($value){
        $sql = "SELECT {$this->prefix}_indiv.id as indivID, {$this->prefix}_indiv.locnID, {$this->prefix}_indiv.plot, {$this->prefix}_indiv.tag, {$this->prefix}_indiv.personID, {$this->prefix}_locn.*, {$this->prefix}_person.*
                    FROM `{$this->prefix}_indiv` INNER JOIN `{$this->prefix}_locn` ON 
                        $value={$this->prefix}_indiv.locnID AND {$this->prefix}_indiv.n_status='0'
                    INNER JOIN `{$this->prefix}_person` ON
                        {$this->prefix}_indiv.personID={$this->prefix}_person.id
                    GROUP BY {$this->prefix}_indiv.id";
        
        $res = $this->fetch($sql,1);
        $return['result'] = $res;
        return $return;
    }

    /**
     * @todo retrieve all data from table indiv from selected person
     * 
     * @param $value=id person
     * @return 
     */
    function dataIndivPerson($value){
        $sql = "SELECT {$this->prefix}_indiv.id as indivID, {$this->prefix}_indiv.locnID, {$this->prefix}_indiv.plot, {$this->prefix}_indiv.tag, {$this->prefix}_indiv.personID, {$this->prefix}_locn.*, {$this->prefix}_person.*
                    FROM `{$this->prefix}_indiv` INNER JOIN `{$this->prefix}_locn` ON 
                        $value={$this->prefix}_indiv.personID AND {$this->prefix}_indiv.n_status='0'
                    INNER JOIN `{$this->prefix}_person` ON
                        $value={$this->prefix}_person.id
                    INNER JOIN `{$this->prefix}_det` ON
                        {$this->prefix}_indiv.id={$this->prefix}_det.indivID
                    GROUP BY {$this->prefix}_indiv.id";
        
        $res = $this->fetch($sql,1);
        $return['result'] = $res;
        return $return;
    }

    /**
     * @todo retrieve all indiv detail
     * @param $data = id indiv
     */
    function detailIndiv($data){
        $sql = "SELECT * 
                FROM `{$this->prefix}_indiv` INNER JOIN `{$this->prefix}_locn` ON 
                    {$this->prefix}_indiv.id='$data' AND {$this->prefix}_locn.id={$this->prefix}_indiv.locnID AND {$this->prefix}_indiv.n_status='0'
                INNER JOIN `{$this->prefix}_person` ON
                    {$this->prefix}_person.id={$this->prefix}_indiv.personID";
        $res = $this->fetch($sql,1);
        return $res;
    }

    /**
     * @todo retrieve all images from indiv data
     * @param $data = id indiv
     */
    function showAllImgIndiv($data){
        $sql = "SELECT * FROM `{$this->prefix}_img` WHERE indivID='$data' AND md5sum IS NOT NULL";
        $res = $this->fetch($sql,1);
        return $res;
    }
    
    /**
     * @todo retrieve all det from indiv selected
     * @param $data = id indiv
     */
    function dataDetIndiv($data){
        $sql = "SELECT {$this->prefix}_det.id as detID, det.*, taxon.*,person.* 
                FROM `{$this->prefix}_det` INNER JOIN `{$this->prefix}_taxon` ON 
                    indivID='$data' AND {$this->prefix}_taxon.id={$this->prefix}_det.taxonID AND {$this->prefix}_det.n_status='0'
                INNER JOIN `{$this->prefix}_person` ON
                    {$this->prefix}_person.id={$this->prefix}_det.personID";
        $res = $this->fetch($sql,1);
        return $res;
    }
    
    /**
     * @todo retrieve all obs from indiv selected
     * @param $data = id indiv
     */
    function dataObsIndiv($data){
        $sql = "SELECT {$this->prefix}_obs.id as obsID, {$this->prefix}_obs.*, {$this->prefix}_person.* 
                FROM `{$this->prefix}_obs` INNER JOIN `{$this->prefix}_person` ON 
                    indivID='$data' AND {$this->prefix}_person.id={$this->prefix}_obs.personID AND {$this->prefix}_obs.n_status='0'";
        $res = $this->fetch($sql,1);
        return $res;
    }
}
?>