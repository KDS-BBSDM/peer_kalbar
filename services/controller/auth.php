<?php
// defined ('MICRODATA') or exit ( 'Forbidden Access' );

class auth extends Controller {
	
	var $models = FALSE;
	
	public function __construct()
	{
		parent::__construct();
		$this->loadmodule();
		
		global $basedomain;	
		
		$this->prefix = "peerkalbar";
	}
	public function loadmodule()
	{
		
		$this->browseHelper = $this->loadModel('browseHelper');
		$this->loginHelper = $this->loadModel('loginHelper');
	}
	
	public function index(){
       	
       	echo "authentication";
       	exit;
	}
    
    function validateAccount()
    {
    	// http://basedomain/services/auth/validateAccount/?email=o.pulu@yahoo.com&password=ovan&repo=1&token=1a282b6d2083b16b976c0b585f87b2b86e960049

    	$data['email'] = _g('email');
    	$data['password'] = _g('password');
    	$data['repo'] = _g('repo');
    	$data['token'] = _g('token');

    	$validateToken = sha1($data['email']. $data['repo']);
    	if ($validateToken == $data['token']){

    		$validate = $this->loginHelper->goLogin($data);
    		if ($validate) print json_encode(array('status'=>true));
    		else print json_encode(array('status'=>false));
    	}else{

    		print json_encode(array('status'=>false));
    		
    	}

    	exit;
    }
    
}

?>
