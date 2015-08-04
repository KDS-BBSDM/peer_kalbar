<?php
// defined ('MICRODATA') or exit ( 'Forbidden Access' );

class taxon extends Controller {
	
	var $models = FALSE;
	
	public function __construct()
	{
		parent::__construct();
		$this->loadmodule();
		
		global $basedomain;	
		$validate = $this->validateToken();
		if (!$validate){
			redirect($basedomain);
			exit;
		} 
		// $this->validatePage();

		$this->prefix = "peerkalbar";
	}
	public function loadmodule()
	{
		
		$this->browseHelper = $this->loadModel('browseHelper');
	}
	
	public function index(){
       	
       	pr($_GET);

       	exit;
		// $data = $this->models->get_profile();
		// pr($data);
		return $this->loadView('viewprofile',$data);

	}
    
    function handleRequest()
    {

    	$this->serverSide = $this->loadModel('serverSide');
		$serverside = new serverSide;

		$loadFunction = $_GET['function'];

		$SSConfig = $this->$loadFunction();

		$output = $this->serverSide->dTableData($SSConfig);
		header('Access-Control-Allow-Origin: *');
		// header("Access-Control-Allow-Headers: *");
		// $this->cors();exit;
		echo json_encode($output);

		exit;
    }

    function taxonConfig()
    {
    	global $portaldomain;

    	$decodeData = array("{$this->prefix}_indiv.n_status"=>0);

    	$SSConfig['APIHelper']    = 'browseHelper';
		$SSConfig['APIFunction']  = 'dataTaxon';
		$SSConfig['filter']       = $decodeData;

    	$SSConfig['primaryTable'] = "{$this->prefix}_taxon";
		$SSConfig['primaryField'] = "id";
		$SSConfig['searchField'] = array('morphotype', 'fam', 'gen', 'sp');

		$SSConfig['view'][1] = "morphotype";
		$SSConfig['view'][2] = "fam"; 
		$SSConfig['view'][3] = "gen";
		$SSConfig['view'][4] = "sp";
		$SSConfig['view'][5] = "image|img|sp|id";
		$SSConfig['view'][6] = "detail|{$portaldomain}browse/indiv/|id=id&action=indivTaxon";
		
		return $SSConfig;
    }

    function locationConfig()
    {
    	global $portaldomain;

    	$decodeData = array("{$this->prefix}_indiv.n_status"=>0);

    	$SSConfig['APIHelper']    = 'browseHelper';
		$SSConfig['APIFunction']  = 'dataLocation';
		$SSConfig['filter']       = $decodeData;

    	$SSConfig['primaryTable'] = "{$this->prefix}_locn";
		$SSConfig['primaryField'] = "id";
		$SSConfig['searchField'] = array('province', 'island', 'country', 'elev','locality','county');

		$SSConfig['view'][1] = "province";
		$SSConfig['view'][2] = "island"; 
		$SSConfig['view'][3] = "country";
		$SSConfig['view'][4] = "elev";
		$SSConfig['view'][5] = "locality";
		$SSConfig['view'][6] = "county";
		$SSConfig['view'][7] = "detail|{$portaldomain}browse/indiv/|id=id&action=indivLocn";
		
		return $SSConfig;
    }

    function personConfig()
    {
    	global $portaldomain;

    	$decodeData = array("{$this->prefix}_indiv.n_status"=>0);

    	$SSConfig['APIHelper']    = 'browseHelper';
		$SSConfig['APIFunction']  = 'dataPerson';
		$SSConfig['filter']       = $decodeData;

    	$SSConfig['primaryTable'] = "{$this->prefix}_person";
		$SSConfig['primaryField'] = "id";
		$SSConfig['searchField'] = array('name', 'twitter', 'website', 'institutions','project');

		// $SSConfig['view'][1] = "id";
		$SSConfig['view'][1] = "name";
		$SSConfig['view'][2] = "twitter"; 
		$SSConfig['view'][3] = "website";
		$SSConfig['view'][4] = "institutions";
		$SSConfig['view'][5] = "project";
		$SSConfig['view'][6] = "detail|{$portaldomain}browse/indiv/|id=id&action=indivPerson";
		
		return $SSConfig;
    }

    function indivConfig()
    {
    	global $portaldomain;

    	$decodeData = array("{$this->prefix}_indiv.n_status"=>0);

    	$SSConfig['APIHelper']    = 'browseHelper';
		$SSConfig['APIFunction']  = 'dataIndiv';
		$SSConfig['filter']       = $decodeData;

    	$SSConfig['primaryTable'] = "{$this->prefix}_indiv";
		$SSConfig['primaryField'] = "id";
		$SSConfig['searchField'] = array("{$this->prefix}_indiv.id", "{$this->prefix}_locn.locality", "{$this->prefix}_person.name");

		// $SSConfig['view'][1] = "id";
		$SSConfig['view'][1] = "indivCode";
		$SSConfig['view'][2] = "locality"; 
		$SSConfig['view'][3] = "pendata";
		$SSConfig['view'][4] = "image|img|sp|id";
		$SSConfig['view'][5] = "detail|{$portaldomain}browse/indivDetail/|id=indivCode";
		
		return $SSConfig;
    }

    function cors() {

	    // Allow from any origin
	    if (isset($_SERVER['HTTP_ORIGIN'])) {
	        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
	        header('Access-Control-Allow-Credentials: true');
	        header('Access-Control-Max-Age: 86400');    // cache for 1 day
	    }

	    // Access-Control headers are received during OPTIONS requests
	    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

	        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
	            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

	        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
	            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

	        exit(0);
	    }

	    echo "You have CORS!";
	}

	function getDataTaxon()
	{

		// pr($_GET);
		// exit;
		$taxon =  $this->browseHelper->dataTaxon();
		if ($taxon){
			print json_encode($taxon);
		}
		exit;
		/*
			1. jika tidak ada parameter kedua maka get data 
		*/
	}

	function getImgTaxon()
	{
		$id = $_GET['id'];
		$img =  $this->browseHelper->getImgTaxon($id);
		if ($img){
			print json_encode($img);
		}
		exit;
	}

	function getTitle()
	{
		$id = $_GET['id'];
		$title =  $this->browseHelper->getTitle($id);
		if ($title){
			print json_encode($title);
		}
		exit;
	}

	function getDataLocation()
	{
		$location =  $this->browseHelper->dataLocation();
		if ($location){
			print json_encode($location);
		}
		exit;
		/*
			1. jika tidak ada parameter kedua maka get data 
		*/
	}

	function getDataPerson()
	{
		$person =  $this->browseHelper->dataPerson();
		if ($person){
			print json_encode($person);
		}
		exit;
		/*
			1. jika tidak ada parameter kedua maka get data 
		*/
	}

	function getDataIndiv()
	{
		$indiv =  $this->browseHelper->dataIndiv();
		if ($indiv){
			print json_encode($indiv);
		}
		exit;
		/*
			1. jika tidak ada parameter kedua maka get data 
		*/
	}

	function getIndivTaxon()
	{
		$id = $_GET['id'];
		$indiv =  $this->browseHelper->dataIndivTaxon($id);
		if ($indiv){
			print json_encode($indiv);
		}
		exit;
	}

	function getImgIndiv()
	{
		$id = $_GET['id'];
		$img =  $this->browseHelper->showImgIndiv($id);
		if ($img){
			print json_encode($img);
		}
		exit;
	}

	function getIndivLocation()
	{
		$id = $_GET['id'];
		$indiv =  $this->browseHelper->dataIndivLocation($id);
		if ($indiv){
			print json_encode($indiv);
		}
		exit;
	}

	function getIndivPerson()
	{
		$id = $_GET['id'];
		$indiv =  $this->browseHelper->dataIndivPerson($id);
		if ($indiv){
			print json_encode($indiv);
		}
		exit;
	}

	function detailIndiv()
	{
		$id = $_GET['id'];
		$detailIndiv =  $this->browseHelper->detailIndiv($id);
		if ($detailIndiv){
			print json_encode($detailIndiv);
		}
		exit;
	}

	function dataDetIndiv()
	{
		$id = $_GET['id'];
		$dataDetIndiv =  $this->browseHelper->dataDetIndiv($id);
		if ($dataDetIndiv){
			print json_encode($dataDetIndiv);
		}
		exit;
	}

	function dataObsIndiv()
	{
		$id = $_GET['id'];
		$dataObsIndiv =  $this->browseHelper->dataObsIndiv($id);
		if ($dataObsIndiv){
			print json_encode($dataObsIndiv);
		}
		exit;
	}

	function getAllImgIndiv()
	{
		$id = $_GET['id'];
		$img =  $this->browseHelper->showAllImgIndiv($id);
		if ($img){
			print json_encode($img);
		}
		exit;
	}

	function dataIndivLimit()
	{
		$taxon =  $this->browseHelper->dataIndivLimit();
		if ($taxon){
			print json_encode($taxon);
		}
		exit;
		/*
			1. jika tidak ada parameter kedua maka get data 
		*/
	}

	function validateToken()
	{

		$_SESSION['services']['token'] = '123';
		$token = $_SESSION['services'];
		if ($token['token']) return true;
		return false;
	}
}

?>
