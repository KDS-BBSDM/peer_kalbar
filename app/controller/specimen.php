<?php
// defined ('MICRODATA') or exit ( 'Forbidden Access' );

class specimen extends Controller {
	
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
		
		$this->mspecimen = $this->loadModel('mspecimen');
	}
    
    public function insert(){
        global $CONFIG;
        $post = $_POST;
        
        $message = '';
        
        $tbl_locn = 'locn';
        $tbl_indiv = 'indiv';
        $tbl_obs = 'obs';
        $tbl_img = 'img';
        
        $data[$tbl_locn] = array(
            'locality' => $post['locality']
        );
        $data[$tbl_indiv] = array(
            'personID' => $post['personID']
        );
        $data[$tbl_obs] = array(
            'personID' => $post['personID'],
            'localname' => $post['localname']
        );
        $data[$tbl_img] = array();
        
        $insertLocn = $this->mspecimen->insertTransaction($tbl_locn,$data[$tbl_locn]);
        $locn_id = $insertLocn['lastid'];
        
        $data[$tbl_indiv]['locnID'] = $locn_id;
        $insertIndiv = $this->mspecimen->insertTransaction('indiv',$data[$tbl_indiv]);
        $indiv_id = $insertIndiv['lastid'];
        
        $data[$tbl_obs]['indivID'] = $indiv_id;
        $data[$tbl_img]['indivID'] = $indiv_id;
        $data[$tbl_img]['personID'] = $post['personID'];
        
        $insertObs = $this->mspecimen->insertTransaction('obs',$data[$tbl_obs]);
        
        $name = 'image';
        $path = '';
        $uploaded_file = uploadFile($name, $path, 'image');
        
        //if uploaded
        if($uploaded_file['status'] != '0'){
            logFile('Upload Success');
            
            if (extension_loaded('gd') && function_exists('gd_info')) {
                logFile('GD2 is installed. Checking image data.');

                $tmp_name = $uploaded_file['full_name'];
                $entry = str_replace(array('\'', '"'), '', $uploaded_file['real_name']);

                $image_name_encrypt = md5(str_shuffle($CONFIG['default']['salt'].$entry));

                //check filename
                //$dataExist = $this->mspecimen->imageExist($personID, $entry);            

                $path_entry = $CONFIG['default']['upload_path'];
                $src_tmp = $path_entry."/".$tmp_name;
            
                
                logFile('Prepare to cropping image');
                
                $path_data = 'public_assets/';
                //$path_user = $path_data.$username;
                $path_img = $path_data.'/img';
                $path_img_1000px = $path_img.'/1000px';
                $path_img_500px = $path_img.'/500px';
                $path_img_100px = $path_img.'/100px';
                
                $fileinfo = getimagesize($path_entry.'/'.$tmp_name);
                
                $toCreate = array($path_img, $path_img_1000px, $path_img_500px, $path_img_100px);
                createFolder($toCreate, 0755);
                
                copy($path_entry."/".$tmp_name, $path_img_1000px.'/'.$image_name_encrypt.'.1000px.jpg');
                if(!@ copy($path_entry."/".$tmp_name, $path_img_1000px.'/'.$image_name_encrypt.'.1000px.jpg')){
                    logFile('Copy file failed');
                    $status = "error";
                    $msg= error_get_last();
                }
                else{
                    logFile('Copy file success');
                    $dest_1000px = $CONFIG['default']['root_path'].'/'.$path_img_1000px.'/'.$image_name_encrypt.'.1000px.jpg';
                    $dest_500px = $CONFIG['default']['root_path'].'/'.$path_img_500px.'/'.$image_name_encrypt.'.500px.jpg';
                    $dest_100px = $CONFIG['default']['root_path'].'/'.$path_img_100px.'/'.$image_name_encrypt.'.100px.jpg';
                    
                    if ($fileinfo[0] >= 1000 || $fileinfo[1] >= 1000 ) {
                        if ($fileinfo[0] > $fileinfo[1]) {
                            $percentage = (1000/$fileinfo[0]);
                            $config['width'] = $percentage*$fileinfo[0];
                            $config['height'] = $percentage*$fileinfo[1];
                        }else{
                            $percentage = (1000/$fileinfo[1]);
                            $config['width'] = $percentage*$fileinfo[0];
                            $config['height'] = $percentage*$fileinfo[1];
                        }
                        
                        $this->resize_pic($src_tmp, $dest_1000px, $config);
                        unset($config);
                    }
                    
                    logFile('Cropping to 1000px image');
                    //Set cropping for y or x axis, depending on image orientation
                    if ($fileinfo[0] > $fileinfo[1]) {
                        $config['width'] = $fileinfo[1];
                        $config['height'] = $fileinfo[1];
                        $config['x_axis'] = (($fileinfo[0] / 2) - ($config['width'] / 2));
                        $config['y_axis'] = 0;
                    }
                    else {
                        $config['width'] = $fileinfo[0];
                        $config['height'] = $fileinfo[0];
                        $config['x_axis'] = 0;
                        $config['y_axis'] = (($fileinfo[1] / 2) - ($config['height'] / 2));
                    }

                    $this->cropToSquare($src_tmp, $dest_500px, $config);
                    unset($config);
                    
                    logFile('Cropping to square image');
                    
                    //set new config
                    $config['width'] = 500;
                    $config['height'] = 500;
                    $this->resize_pic($dest_500px, $dest_500px, $config);
                    unset($config);
                    
                    logFile('Cropping to 500px image');
                    
                    $config['width'] = 100;
                    $config['height'] = 100;
                    $this->resize_pic($dest_500px, $dest_100px, $config);
                    unset($config);
                    
                    logFile('Cropping to 100px image');
                    
                    //add file information to array
                    /*$fileToInsert = array('filename' => $entry,'md5sum' => $image_name_encrypt, 'directory' => '', 'mimetype' => $fileinfo['mime']);
                    
                    $insertImage = $this->imagezip->updateImage($personID, $fileToInsert);*/
                    
                    $data[$tbl_img]['filename'] = $entry;
                    $data[$tbl_img]['md5sum'] = $image_name_encrypt;
                    $data[$tbl_img]['mimetype'] = $fileinfo['mime'];
                    
                    $insertImg = $this->mspecimen->insertTransaction('img',$data[$tbl_img]);
                    
                    if($insertImg){
                        logFile('Insert Image Success');
                    }else{
                        logFile('Insert Image Failed');
                    }
                    $return['status'] = TRUE;
                    $return['message'] = 'Data berhasil disimpan';
                } // end if copy
            
            unlink($src_tmp);
            }else{
                logFile('GD2 is not installed');
                $return['message'] = 'Error: Sistem Error. Harap menghubungi tim developer kami.';
            }
        }else{
            logFile('Upload Image Failed');
            $return['message'] = 'Error: '.$uploaded_file['message'];
        }
        
        echo json_encode($return);
        exit;
        
    }
    
    public function form(){
        return $this->loadView('form');
    }
    
    /**
     * @todo crop image to square from center
     * 
     * @param string $src = full image path with file name
     * @param string $dest = path destination for new image
     * @param array $config = array contain configuration to crop image
     * 
     * @param int $config['width']
     * @param int $config['height']
     * @param int $config['x_axis']
     * @param int $config['y_axis']
     * 
     * @return bool Returns TRUE on success, FALSE on failure
     * 
     * */
    function cropToSquare($src, $dest, $config){
        list($current_width, $current_height) = getimagesize($src);
        $canvas = imagecreatetruecolor($config['width'], $config['height']);
        $current_image = imagecreatefromjpeg($src);
        if (!@ imagecopy($canvas, $current_image, 0, 0, $config['x_axis'], $config['y_axis'], $current_width, $current_height)){
            return false;
        }else{
            if (!@ imagejpeg($canvas, $dest, 100)){
                return false;
            }else{
                return true;
            }
        }
    }
    
    /**
     * @todo resize image
     * 
     * @param string $src = full image path with file name
     * @param string $dest = path destination for new image
     * @param array $config = array contain configuration to crop image
     * 
     * @param int $config['width']
     * @param int $config['height']
     * 
     * @return bool Returns TRUE on success, FALSE on failure
     * 
     * */
    function resize_pic($src, $dest, $config){
        list($current_width, $current_height) = getimagesize($src);
        $canvas = imagecreatetruecolor($config['width'], $config['height']);
        $current_image = imagecreatefromjpeg($src);
        
        // Resize
        if (!@ imagecopyresized($canvas, $current_image, 0, 0, 0, 0, $config['width'], $config['height'], $current_width, $current_height)){
            return false;
        }else{
            // Output
            if (!@ imagejpeg($canvas, $dest, 100)){
                return false;
            }else{
                return true;
            }
        }
    }
}

?>
