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
        $sql= "SELECT * FROM {$this->prefix}_taxon WHERE id in (SELECT det.taxonID FROM det INNER JOIN indiv on indiv.id = det.indivID WHERE indiv.n_status = 0)";
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
        $sql= "SELECT * FROM `{$this->prefix}_locn` WHERE id in (SELECT indiv.locnID FROM indiv inner join det on indiv.id = det.indivID WHERE indiv.n_status = 0)";
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
        $sql = "SELECT indiv.id as indivID, indiv.locnID, indiv.plot, indiv.tag, indiv.personID, locn.*, person.*
                    FROM `{$this->prefix}_indiv` INNER JOIN `{$this->prefix}_locn` ON 
                        $value=indiv.locnID AND indiv.n_status='0'
                    INNER JOIN `{$this->prefix}_person` ON
                        indiv.personID=person.id
                    GROUP BY indiv.id";
        
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
        $sql = "SELECT indiv.id as indivID, indiv.locnID, indiv.plot, indiv.tag, indiv.personID, locn.*, person.*
                    FROM `{$this->prefix}_indiv` INNER JOIN `{$this->prefix}_locn` ON 
                        $value=indiv.personID AND indiv.n_status='0'
                    INNER JOIN `{$this->prefix}_person` ON
                        $value=person.id
                    INNER JOIN `{$this->prefix}_det` ON
                        indiv.id=det.indivID
                    GROUP BY indiv.id";
        
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
                    indiv.id='$data' AND locn.id=indiv.locnID AND indiv.n_status='0'
                INNER JOIN `{$this->prefix}_person` ON
                    person.id=indiv.personID";
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
        $sql = "SELECT det.id as detID, det.*, taxon.*,person.* 
                FROM `{$this->prefix}_det` INNER JOIN `{$this->prefix}_taxon` ON 
                    indivID='$data' AND taxon.id=det.taxonID AND det.n_status='0'
                INNER JOIN `{$this->prefix}_person` ON
                    person.id=det.personID";
        $res = $this->fetch($sql,1);
        return $res;
    }
    
    /**
     * @todo retrieve all obs from indiv selected
     * @param $data = id indiv
     */
    function dataObsIndiv($data){
        $sql = "SELECT obs.id as obsID, obs.*, person.* 
                FROM `{$this->prefix}_obs` INNER JOIN `{$this->prefix}_person` ON 
                    indivID='$data' AND person.id=obs.personID AND obs.n_status='0'";
        $res = $this->fetch($sql,1);
        return $res;
    }
}
?>