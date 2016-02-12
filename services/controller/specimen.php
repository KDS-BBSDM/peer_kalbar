<?php
// defined ('MICRODATA') or exit ( 'Forbidden Access' );

class specimen extends Controller {
	
	var $models = FALSE;
	
	public function __construct()
	{
		parent::__construct();
		$this->loadmodule();
		
		global $basedomain;	
		// $validate = $this->validateToken();
		// if (!$validate){
		// 	redirect($basedomain);
		// 	exit;
		// } 
		$this->prefix = "peerkalbar";
	}
	public function loadmodule()
	{
		
		$this->browseHelper = $this->loadModel('browseHelper');
	}
	
	public function index(){
       	pr($_GET);
       	exit;
		return $this->loadView('viewprofile',$data);

	}

	function getAllLocation()
	{
		$path = ltrim($_SERVER['REQUEST_URI'], '/');
		$temp_path = explode("/", $path);
		// print_r($temp_path);die;
		$limit = $temp_path[5];
		$location =  $this->browseHelper->dataLocationAll($limit);
		if ($location){
			print json_encode($location);
		}
		exit;
	}

	function getLocation()
	{
		$path = ltrim($_SERVER['REQUEST_URI'], '/');
		$temp_path = explode("/", $path);
		// print_r($temp_path);die;
		$id = $temp_path[5];
		$location =  $this->browseHelper->dataLocationId($id);
		if ($location){
			print json_encode($location);
		}
		exit;
	}

	function getAllPerson()
	{
		$path = ltrim($_SERVER['REQUEST_URI'], '/');
		$temp_path = explode("/", $path);
		$limit = $temp_path[5];
		// pr($temp_path);exit;
		$person =  $this->browseHelper->dataPersonAll($limit);
		if ($person){
			print json_encode($person);
		}
		exit;
		/*
			1. jika tidak ada parameter kedua maka get data 
		*/
	}

	function getPerson()
	{
		$path = ltrim($_SERVER['REQUEST_URI'], '/');
		$temp_path = explode("/", $path);
		$id = $temp_path[5];
		$person =  $this->browseHelper->dataPersonId($id);
		if ($person){
			print json_encode($person);
		}
		exit;
		/*
			1. jika tidak ada parameter kedua maka get data 
		*/
	}

	function getIndiv()
	{
		$path = ltrim($_SERVER['REQUEST_URI'], '/');
		$temp_path = explode("/", $path);
		$id = $temp_path[5];
		$indiv =  $this->browseHelper->dataIndivId($id);
		if ($indiv){
			print json_encode($indiv);
		}
		exit;
	}

	function getAllIndiv()
	{
		$path = ltrim($_SERVER['REQUEST_URI'], '/');
		$temp_path = explode("/", $path);
		$limit = $temp_path[5];
		$indiv =  $this->browseHelper->dataIndivAll($limit);
		if ($indiv){
			print json_encode($indiv);
		}
		exit;
	}

	function getIndivTaxon()
	{
		$path = ltrim($_SERVER['REQUEST_URI'], '/');
		$temp_path = explode("/", $path);
		$id = $temp_path[5];
		$indiv =  $this->browseHelper->dataIndivTaxonId($id);
		if ($indiv){
			print json_encode($indiv);
		}
		exit;
	}

	function getAllIndivTaxon()
	{
		$path = ltrim($_SERVER['REQUEST_URI'], '/');
		$temp_path = explode("/", $path);
		$limit = $temp_path[5];
		$indiv =  $this->browseHelper->dataIndivTaxonAll($limit);
		if ($indiv){
			print json_encode($indiv);
		}
		exit;
	}

}

?>
