<?php
class Ajax extends Controller {
	
	protected $userpassword;
	protected $masterbuyer;
	protected $tbl_pr;
	protected $tblOrderStatus;

	public function __construct(){
		//var_dump("Ajax");
		$this->userpassword = $this->model('userpassword');
		$this->masterbuyer = $this->model('masterbuyer');
		$this->tbl_pr = $this->model('tbl_pr');
		$this->tblOrderStatus = $this->model('tbl_orderstatus');
	}
	
	public function index(){
		is_header(); 
		$this->view('home',[]);
		is_footer(); 
	}
	
	public function login(){
		//var_dump($_POST);
		
		$nik = $_POST['data'][0];
		$pass = md5($_POST['data'][1]);
		
		$usercek = $this->userpassword->login($nik,$pass);
		//var_dump($usercek);
		
		if ($usercek['exist']) 
		{
			$user_session = $usercek['items']->fetch_assoc();

			$_SESSION['user'] = $user_session['UserName'];
			$_SESSION['fullName'] = $user_session['FullName'];
			$_SESSION['nik'] = $user_session['nik'];
			$_SESSION['level'] = $user_session['level_id'];
			$_SESSION['perm'] = $user_session['permission'];
			$_SESSION['sbu'] = $user_session['sbu'];
			$_SESSION['fty'] = $user_session['ftycode'];
			$_SESSION['dept'] = $user_session['deptcode'];
			$_SESSION['DeptName'] = $user_session['DeptName'];
			$_SESSION['Groupp'] = $user_session['Groupp'];
			
			//create_log('LOGIN',$nik);
			
			$json['reload'] = "true";
		}
		else
		{
			$json['notif'] = "error";
			$json['headMsg'] = "Failed!";
			$json['msg'] = "Your account and password not valid.";
		}
		
		echo json_encode($json);
	}
	
	public function logout(){
		if (isset($_SESSION['nik'])) {
			session_destroy();
			create_log('LOGOUT',$_SESSION['nik']);
			$json['reload'] = "true";
		}
		
		echo json_encode($json);
	}
	
	public function listbuyer(){
		$listbuyer = $this->masterbuyer->listbuyer()['items'];
		$option .= '<option value=""></option>';
		while ($val = $listbuyer->fetch_assoc()) {
			$option .= '<option value="'.$val['BuyerCode'].'">'.$val['Buyer'].'</option>';
		}		
		echo $option;
	}
	
	public function liststyle(){
		$buyer = $_POST["buyer"];
		// var_dump($buyer);
		$liststyle = $this->tbl_pr->liststyle($buyer)['items'];
		$option .= '<option value=""></option>';
		while ($val = $liststyle->fetch_assoc()) {
			$option .= '<option value="'.$val['styleNo'].'">'.$val['styleNo'].'</option>';
		}		
		echo $option;
	}
	
	public function listkp(){
		$style = $_POST["style"];

		$buyerCode = $_POST["BuyerCode"];
		$listkp = $this->tbl_pr->listkp($style,$buyerCode)['items'];
		
		$option .= '<option value=""></option>';
		while ($val = $listkp->fetch_assoc()) {
			$option .= '<option value="'.$val['KPNo'].'">'.$val['KPNo'].'</option>';
		}		
		echo $option;
	}
	
	public function noteskp($kpno){
		//var_dump($_GET);
		/*$kpno = $_GET['kpno'];
		$item = $_GET['item'];
		$garment = $_GET['garment'];
		$color = $_GET['color'];
		$pono = $_GET['pono'];*/
		
	}
	
	// add by tiar
	public function detailsNotes($kpNo,$matContents){
		$id = $_POST['data'];

		$kpNo = $_GET['kpNo'];
		$matContents = $_GET['matContents'];

		// var_dump($kpNo,$matContents);
		$info = $this->tbl_pr->detailsPR($kpNo,$matContents)['items'];
		
		$infoNotes = $this->tbl_pr->detailsNotes($kpNo,$matContents)['items'];
		
		$this->view('ajax/NotesPR',['info' => $info,'infoNotes' => $infoNotes]);
	}
	// end
	
	
	//add by tiar
	public function detailsNotesGlobal(){
		$kpno = $_POST['data'];
		// $info = $this->tbl_pr->detailsGlobalPR($kpno)['items'];

		$infoNotes = $this->tbl_pr->detailsNotesGlobal($kpno)['items'];
		
		$this->view('ajax/NotesPRGlobal',['kpno'=>$kpno,'infoNotes' => $infoNotes]);
	}
	//end add


	//add by tiar 26 januari 2017
	public function PopulateNotes($matContents,$notes)
	{
		$kpno = $_POST['data'];
		$matContents = $_GET['matContents'];
		$notes = $_GET['notes'];

		$this->view('ajax/PopulateNotes',['kpno'=>$kpno,'matcontents'=>$matContents,'notes'=>$notes]);
	}
	//end add
	
	//add by tiar
	public function saveNotes(){
		$tbl_pr = $this->tbl_pr;
		$post = $_POST['data'];
		
		// var_dump($post);
		
		$this->view('ajax/SaveNotes',['post'=>$post,'tbl_pr' => $tbl_pr]);
	}
	// end

	//add by tiar
	public function BuyerNoDetail($buyerNo,$kpno,$style,$destination,$deliverydate){
		$buyerNo = htmlspecialchars_decode($_POST['data']);

		$kpno = htmlspecialchars_decode($_GET['kpno']);

		$style = htmlspecialchars_decode($_GET['style']);

		$destination = $_GET['destination'];

		$deliverydate = $_GET['deliverydate'];

		$qty = $_GET['qty'];
		
		$detailBuyer = $this->tblOrderStatus->retrieveBuyerNoDetail($buyerNo,$kpno)['items'];

		$headerColor = $this->tblOrderStatus->retrieveSize($buyerNo,$kpno)['items'];

		$this->view('ajax/BuyerNoDetail',['buyerno'=>$buyerNo,'headercolor'=>$headerColor,'detailbuyer'=>$detailBuyer,'kpno'=>$kpno,'style'=>$style,'destination'=>$destination,'deliverydate'=>$deliverydate,'qty'=>$qty]);
	}
	//end add
}
?>