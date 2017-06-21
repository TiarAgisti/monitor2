<?php
	class Purchase extends Controller {
		protected $userpassword;
		protected $tbl_pr;
		protected $tbl_orderstatus;
		
		public function __construct(){
			if (is_logged() == false) {
				to_page('login');
			} 
			//var_dump("Ajax");
			$this->userpassword = $this->model('userpassword');
			$this->tbl_pr = $this->model('tbl_pr');
			$this->tbl_orderstatus = $this->model('tbl_orderstatus');
		}
		
		public function index(){

			is_header(); 
			$this->view('PR/prkp',[]);
			is_footer(); 
		}
		
		public function tblprkp(){
			$json = array();
			$tbl_prkp = $this->tbl_pr;
			$style = $_GET['style'];
			$listkpno = $_GET['kpno'];
			$length = $_GET['length'];
			$offset = $_GET['start'];
			$Groupp = strtolower($_SESSION['Groupp']);
			
			$kpnos = explode(",", $listkpno);
			
			foreach($kpnos as $kpno) {
				$arrkpno[] = $kpno;
			}
			
			//var_dump(($Groupp));
			$kpno = implode('","',$arrkpno);
			$json["draw"] = intval($_REQUEST['draw']);
			$json["recordsTotal"] = intval($tbl_prkp->masterprkp($style,$kpno)['count']);
			//var_dump($tbl_prkp->masterprkp($style,$kpno));
			$json["recordsFiltered"] = intval($tbl_prkp->masterprkp($style,$kpno)['count']);
			if($json["recordsTotal"]<>0)
			{
				$x = $tbl_prkp->masterprkp($style,$kpno,$length,$offset)['items'];

				while ($val = $x->fetch_assoc()) {
					$kpNO = '<a href="javascript:;">'.$val['KPNo'].'</a>'; // add by tiar
					$notes = '<a href="javascript:;">'.'<i class="fa fa-file-text"></i>'.'</a>'; // add by tiar
					$isSend = '<a href="javascript:;">'.'<input type="checkbox" value=true id="ck" class="call-checkbox">'.'</a>';// add by tiar 23 januari 2017
					// $grandTotal = 0; //add by tiar
					//var_dump($val);
					if($Groupp=="planning")
					{
						$json['data'][] = [$val['KPNo'],$val['PosNo'],$val['position'],$val['matcontents'],
										   '<a tabindex="0" role="button" data-toggle="popover" data-placement="bottom" data-trigger="focus" title="" data-content="'.substr($val['itemdesc'],0,133).'" data-original-title="Detail Chronology">'.substr($val['itemdesc'],0,10).' ... </a>',$val['vendorcode'],
										   $val['colorgarment'],$val['colorcode'],$val['sizegarment'],$val['size'],$val['GarmentQty'],$val['consumption'],
										   $val['allowance'],$val['qty'],$val['unit'],$val['PONo'],'<a href="javascript:;" data-kpno="'.$val['KPNo'].'" data-item="'.$val['itemdesc'].'" data-garment="'. $val['colorgarment'].'" data-color="'.$val['colorcode'].'" data-pono="'.$val['PONo'].'"><i class="fa fa-file-text"></i></a>'];
					}
					else
					{
						//var_dump();
						$json['data'][] = [$isSend,$notes,$kpNO,$val['PosNo'],$val['position'],$val['matcontents'],
										   '<a tabindex="0" role="button" data-toggle="popover" data-placement="bottom" data-trigger="focus" title="" data-content="'.utf8_encode($val['itemdesc']).'" data-original-title="Detail Description">'.substr($val['itemdesc'],0,10).' ... </a>',$val['vendorcode'],
										   $val['colorgarment'],$val['colorcode'],$val['sizegarment'],$val['size'],number_format($val['GarmentQty']),number_format($val['consumption'],4),  //edit by tiar
										   number_format($val['allowance'],4),number_format($val['qty']),$val['unit'],$val['PONo']]; //edit by tiar 23 januari 2017

						
						// $json['data'][$grandTotal] = $grandTotal + $val['qty'];
					}
				}					
			}
			else
			{
				$json['data'] = [];
			}
			
			echo json_encode($json);
		}
		

		//add by tiar 10 februari 2017
		public function RetrievePrkpByMatContents(){
			$json = array();
			$tbl_prkp = $this->tbl_pr;
			$style = $_GET['style'];
			$listkpno = $_GET['kpno'];
			$matContents = $_GET['matContents'];
			$length = $_GET['length'];
			$offset = $_GET['start'];
			$Groupp = strtolower($_SESSION['Groupp']);
			
			$kpnos = explode(",", $listkpno);
			
			foreach($kpnos as $kpno) {
				$arrkpno[] = $kpno;
			}
			
			$kpno = implode('","',$arrkpno);
			$json["draw"] = intval($_REQUEST['draw']);
			$json["recordsTotal"] = intval($tbl_prkp->MasterprkpByMatContents($style,$kpno,$matContents)['count']);
			$json["recordsFiltered"] = intval($tbl_prkp->MasterprkpByMatContents($style,$kpno,$matContents)['count']);
			if($json["recordsTotal"]<>0)
			{
				$x = $tbl_prkp->MasterprkpByMatContents($style,$kpno,$matContents,$length,$offset)['items'];

				while ($val = $x->fetch_assoc()) {
					$kpNO = '<a href="javascript:;">'.$val['KPNo'].'</a>';
					$notes = '<a href="javascript:;">'.'<i class="fa fa-file-text"></i>'.'</a>';
					$isSend = '<a href="javascript:;">'.'<input type="checkbox" value=true id="ck" class="call-checkbox">'.'</a>';
					
					if($Groupp=="planning")
					{
						$json['data'][] = [$val['KPNo'],$val['PosNo'],$val['position'],$val['matcontents'],
										   '<a tabindex="0" role="button" data-toggle="popover" data-placement="bottom" data-trigger="focus" title="" data-content="'.substr($val['itemdesc'],0,133).'" data-original-title="Detail Chronology">'.substr($val['itemdesc'],0,10).' ... </a>',$val['vendorcode'],
										   $val['colorgarment'],$val['colorcode'],$val['sizegarment'],$val['size'],$val['GarmentQty'],$val['consumption'],
										   $val['allowance'],$val['qty'],$val['unit'],$val['PONo'],'<a href="javascript:;" data-kpno="'.$val['KPNo'].'" data-item="'.$val['itemdesc'].'" data-garment="'. $val['colorgarment'].'" data-color="'.$val['colorcode'].'" data-pono="'.$val['PONo'].'"><i class="fa fa-file-text"></i></a>'];
					}
					else
					{
						$json['data'][] = [$isSend,$notes,$kpNO,$val['PosNo'],$val['position'],$val['matcontents'],
										   '<a tabindex="0" role="button" data-toggle="popover" data-placement="bottom" data-trigger="focus" title="" data-content="'.utf8_encode($val['itemdesc']).'" data-original-title="Detail Description">'.substr($val['itemdesc'],0,10).' ... </a>',$val['vendorcode'],
										   $val['colorgarment'],$val['colorcode'],$val['sizegarment'],$val['size'],number_format($val['GarmentQty']),number_format($val['consumption'],4),  //edit by tiar
										   number_format($val['allowance'],4),number_format($val['qty']),$val['unit'],$val['PONo']];

						
					}
				}					
			}
			else
			{
				$json['data'] = [];
			}
			
			echo json_encode($json);	
		}
		//end add
		public function rptorder(){

			is_header(); 
			$this->view('orderstatus/orderstatus',[]);
			is_footer(); 
		}
		
		public function tblorderstatus(){
			$json = array();
			$tbl_orderstatus = $this->tbl_orderstatus;
			$style = $_GET['style'];
			$listkpno = $_GET['kpno'];
			$length = $_GET['length'];
			$offset = $_GET['start'];
			$Groupp = strtolower($_SESSION['Groupp']);
			
			$kpnos = explode(",", $listkpno);
			foreach($kpnos as $kpno) {
				$arrkpno[] = $kpno;
			}
			//var_dump(($Groupp));
			$json["draw"] = intval($_REQUEST['draw']);
			$json["recordsTotal"] = intval($tbl_orderstatus->listorder($style,$kpno)['count']);
			//var_dump($tbl_orderstatus->listorder($style,$kpno));
			$json["recordsFiltered"] = intval($tbl_orderstatus->listorder($style,$kpno)['count']);
			if($json["recordsTotal"]<>0)
			{
				$x = $tbl_orderstatus->listorder($style,$kpno)['items'];
				while ($val = $x->fetch_assoc()) {
					$buyerNO = '<a href="javascript:;">'.$val['BuyerNo'].'</a>'; // add by tiar
					$qty = number_format($val['Qty']); // add by tiar
					$json['data'][] = [$val['Season'],$val['ItemName'],
									   $buyerNO,$qty,$val['Unit'],$val['Material'],$val['Dest'],$val['DelDate']];  //edit by tiar
				}					
			}
			else
			{
				$json['data'] = [];
			}
			
			echo json_encode($json);
		}
		
		//add by tiar
		public function BomPDF($styleno,$kpno){
			$styleno = $_GET['styleno'];
			$kpno = $_GET['kpno'];
			// $pr = $this->tbl_pr->ListBOMPDF($styleno,$kpno);
			$this->view('PDF/BOMPDF',['kpno'=>$kpno,'styleno'=>$styleno]);
		}
		// end add

		//add by tiar
		public function dtBuyerNoDetail(){
			$json = array();
			$buyerNo = $_GET['buyerno'];
			$tblOrderStatus = $this->tbl_orderstatus;
			
			$json["draw"] = intval($_REQUEST['draw']);
			$json["recordsTotal"] = intval($tblOrderStatus->retrieveBuyerNoDetail($buyerNo)['count']);
			$json["recordsFiltered"] = intval($tblOrderStatus->retrieveBuyerNoDetail($buyerNo)['count']);
			
			$detailBuyerNo = $tblOrderStatus->retrieveBuyerNoDetail($buyerNo);
			if($json["recordsFiltered"]==0)
			{
				$json['data']=[];
			}
			else
			{
				while ( $val = $detailBuyerNo['items']->fetch_assoc()) {
					$json['data'][] = [$val['BuyerNo'],$val['KPNo'],$val['ArticleNo'],$val['Dest'],$val['DelDate'],$val['Qty']];
				}
			}
			
			echo json_encode($json);
		}
		//end add

		//add by tiar 26 januari 2017 for populate notes to send email
		public function RetrieveNotes($kpNo,$matContents){
			$json = [];
			$kpNo = $_GET['kpNo'];
			$matContents = $_GET['matContents'];
			$tbl_pr = $this->tbl_pr;

			// $json["draw"] = intval($_REQUEST['draw']);
			$count = intval($tbl_pr->detailsNotes($kpNo,$matContents)['count']);
			$val = $tbl_pr->detailsNotes($kpNo,$matContents)['items']->fetch_assoc();

			if($count==0)
			{
				$json['data']=[];
			}
			else
			{
				
				$json[] = $val['notes'];
			}

			echo json_encode($json);
		}
		//end add
		
	}
?>