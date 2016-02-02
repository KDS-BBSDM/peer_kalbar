<?php
// defined ('TATARUANG') or exit ( 'Forbidden Access' );

define ('APP_CONTROLLER', APPPATH.'controller/');
define ('APP_VIEW', APPPATH.'view/');
define ('APP_MODELS', 'model/');

/* Konfigurasi APP */

$CONFIG['services']['app_server'] = TRUE;
$CONFIG['services']['smarty_enabled'] = false;
$CONFIG['services']['app_status'] = 'Development';
$CONFIG['services']['app_debug'] = TRUE;
$CONFIG['services']['app_underdevelopment'] = FAlSE;
$CONFIG['services']['smarty_enabled'] = true;
$CONFIG['services']['php_ext'] = '.php';
$CONFIG['services']['html_ext'] = '.html';
$CONFIG['services']['default_view'] = 'home';
$CONFIG['services']['login'] = 'login';


$CONFIG['services']['base_url'] = 'http://localhost/florakb/flora-kalbar.info/services/';
$CONFIG['services']['root_path'] = $_SERVER['DOCUMENT_ROOT'].'/florakb/flora-kalbar.info/services';
$CONFIG['services']['app_url'] = 'http://localhost/florakb/floraINA-peerkalbar/';
$CONFIG['services']['portal_url'] = 'http://localhost/florakb/floraINA-portal/';
$CONFIG['services']['upload_path'] = $_SERVER['DOCUMENT_ROOT'].'/florakb/flora-kalbar.info/public_assets/';

$CONFIG['services']['max_filesize'] = 2097152;

$CONFIG['services']['css'] = APPPATH.'css/';
$CONFIG['services']['images'] = APPPATH.'images/';
$CONFIG['services']['js'] = APPPATH.'js/';

$basedomain = $CONFIG['services']['base_url'];
$app_domain = $CONFIG['services']['app_url'];
$portaldomain = $CONFIG['services']['portal_url'];

/* Konfigurasi DB */

$dbConfig[0]['host'] = 'localhost';
$dbConfig[0]['user'] = 'root';
$dbConfig[0]['pass'] = 'root123root';
$dbConfig[0]['name'] = 'floraina_peerkalbar_main';
$dbConfig[0]['server'] = 'mysql';

$dbConfig[1]['host'] = 'localhost';
$dbConfig[1]['user'] = 'root';
$dbConfig[1]['pass'] = 'root123root';
$dbConfig[1]['name'] = 'floraina_peerkalbar_extra';
$dbConfig[1]['server'] = 'mysql';


?>
