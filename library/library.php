<?php
$path = '/';

define('SERVER_NAME', 'http://'.$_SERVER['SERVER_NAME'].$path);
define( 'SERVER_PUBLIC', SERVER_NAME.'public/');

define( 'SERVER_UPLOAD', SERVER_PUBLIC.'uploads/' );

define('SERVER_ASSETS',SERVER_PUBLIC.'assets/');
define('SERVER_VENDOR',SERVER_PUBLIC.'vendor/');


define('SERVER_ROOT', $_SERVER['DOCUMENT_ROOT'] );
define('SERVER_REQUIRED', SERVER_ROOT.'/app/views/' );
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

require_once 'lib_mysql.php';
require_once 'web_mysql.php';
require_once 'lib_sidebar.php';
require_once 'fpdf17/fpdf.php'; //add by tiar
require_once 'phpmailer/PHPMailerAutoload.php'; //add by tiar
// require_once 'fpdf/MC_Table.php'; //add by tiar


//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

session_start();

/********************* FUNCTION REQUIRED *****************************/
function is_header(){
	return require_once SERVER_REQUIRED.'header.php';
}

function is_navbar(){
	return require_once SERVER_REQUIRED.'navbar.php';
}

function is_sidebar(){
	return require_once SERVER_REQUIRED.'sidebar.php';
}

function is_offsidebar(){
	return require_once SERVER_REQUIRED.'offsidebar.php';
}

function is_footer(){
	return require_once SERVER_REQUIRED.'footer.php';
}

/****************************************/


function is_logged(){
	// username, company, sbu, department, level, permission
	if (isset($_SESSION['nik']) AND isset($_SESSION['fty']) AND isset($_SESSION['sbu']) AND isset($_SESSION['dept']) AND isset($_SESSION['level']) AND isset($_SESSION['perm']))
		return true;
	
	return false;
}

function is_logged2(){
	// username, company, sbu, department, level, permission
		//var_dump($_SESSION['nik']);
	if (isset($_SESSION['nik']) AND isset($_SESSION['name']))
		return true;
	
	return false;
}

function is_user($user){

	return ($user == $_SESSION['nik'])? true : false;
}

function is_company($company){
	return ($company == $_SESSION['fty'])? true : false;
}

function is_sbu($sbu){
	return ($sbu == $_SESSION['sbu'])? true : false;
}

function is_department($department){
	return ($department == $_SESSION['dept'])? true : false;
}

function is_level($level){

	return ($level == $_SESSION['level'])? true : false;
}

function is_permission($permission){
	return ($permission == $_SESSION['perm'])? true : false;
}

function is_group($group){

	return ($group == $_SESSION['group'])? true : false;
}

function is_admin(){
	if (isset($_SESSION['user']) === false OR isset($_SESSION['perm']) === false) {
		return false;
	}
	if($_SESSION['perm'] == 0){
		return true;
	} else {
		return false;
	}
}

// /********************* FUNCTION *****************************/

function info_page (){
	$data = [];
	$url = explode('/', $_GET['url']);
	$data['title'] = $url[0];
	// $data['page'] = $url[1];
	return $data;
}
function to_page($data){
	$page = '';
	if ($data != '') {
		$page = $data;
	}
	//var_dump(SERVER_NAME.$page);
	header('Location: '.SERVER_NAME.$page);
}

function logo(){
	echo '<img src="'.SERVER_ASSETS.'images/logo.png" alt="ERP PBT"/>';
}

function copyright(){
	echo'<div class="copyright">
		&copy; <span class="current-year"></span><span class="text-bold text-uppercase"> IT PBT</span>. <span>All rights reserved</span>
	</div>';
}

function is_title($main,$sub){
	echo '<section id="page-title" class="padding-top-15 padding-bottom-15">
				<div class="row">
					<div class="col-sm-8">
						<h1 class="mainTitle">'.$main.'</h1>
						<span class="mainDescription">'.$sub.'</span>
					</div>
				</div>
			</section>';
}

function create_log($logAction,$logId){
	$path = SERVER_ROOT.'/public/log/';
	$file_log = $path.'log_activity_'.date('Y_m_d').'.txt';

	$logTime = date('h:i:s_A');
	$logIP = $_SERVER["REMOTE_ADDR"];

	$logData = strtoupper($logTime.' '.$logIP.' '.$logAction.' '.$logId."\n");

	if (!file_exists($file_log)) {
		$my_file = $file_log;
		$handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
		$data = $logData;
		fwrite($handle, $data);
	} else {
		$my_file = $file_log;
		$handle = fopen($my_file, 'a') or die('Cannot open file:  '.$my_file);
		$data = $logData;
		fwrite($handle, $data);
	}
}

?>