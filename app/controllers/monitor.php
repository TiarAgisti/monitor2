<?php
	class Monitor extends Controller {
		protected $userpassword;
		protected $mastercompany;
		protected $monitoring;
		
		public function __construct(){
			if (is_logged() == false) {
				to_page('login');
			} 
			$this->userpassword = $this->model('userpassword');
			$this->mastercompany = $this->model('mastercompany');
			$this->monitoring = $this->model('tbl_line');
		}
		
		public function index(){

			is_header(); 
			$this->view('home',[]);
			is_footer(); 
		}
		
		public function line(){	
			$mastercompany = $this->mastercompany;
			is_header(); 
			$this->view('monitoring/line',['mastercompany'=>$mastercompany]);
			is_footer(); 
		}
		
		public function table($a){	
			$json = array();
			$monitor = $this->monitoring;
			//$length = $_GET['length'];
			//$offset = $_GET['start'];
			$ftycode = $_GET['ftycode'];
			$awal = $_GET['dari'];
			$akhir = $_GET['sampai'];
			
			//var_dump($length);
			
			$json["draw"] = intval($_REQUEST['draw']);
			
			$json["recordsTotal"] = intval($monitor->kpno($ftycode,$awal,$akhir)['count']);
			$json["recordsFiltered"] = intval($monitor->kpno($ftycode,$awal,$akhir)['count']);
			
			$x= $monitor->kpno($ftycode,$awal,$akhir)['items'];		
			while ($val = $x->fetch_assoc()) {
				$tanggal = $val['ddate'];
				$kpno = $val['kpno'];
				
				$sqlorder = $monitor->qtyorder($val['kpno']);
				$roworder = intval($sqlorder['count']);
				if($roworder==0)
				{
					$qtyorder = 0;
				}
				else
				{
					while ( $arrorder = $sqlorder['items']->fetch_assoc()) 
					{
						$qtyorder = $arrorder['qqty'];
					}
				}
				
				$sqlline = $monitor->line($ftycode,$val['kpno']);
				while ( $arrrline = $sqlline['items']->fetch_assoc()) 
				{
					$line = $arrrline['line'];
					
					//QTY CUTTING
					$sqlcut = $monitor->qtycut($kpno);
					$rowcut = intval($sqlcut['count']);
					if($rowcut==0)
					{
						$qtycut = 0;
					}
					else
					{
						while ( $arrcut = $sqlcut['items']->fetch_assoc()) 
						{
							$qtycut = $arrcut['qtycut'];
						}
					}
					
					//QTY QC Output today
					$sqlqctod = $monitor->qtyqctod($val['kpno'],$line);
					$rowqctod = intval($sqlqctod['count']);
					if($rowcut==0)
					{
						$qtyqctod = 0;
					}
					else
					{
						while ( $arrqctod = $sqlqctod['items']->fetch_assoc()) 
						{
							$qtyqctod = $arrqctod['qtyqc'];
						}
					}
					
					//QTY SEW Output
					$sqlqsew = $monitor->qtysew($val['kpno'],$line);
					$rowsew = intval($sqlqsew['count']);
					if($rowsew==0)
					{
						$qtysew = 0;
					}
					else
					{
						while ( $arrsew = $sqlqsew['items']->fetch_assoc()) 
						{
							$qtysew = $arrsew['qtysew'];
						}
					}
					
					//QTY QC Output
					$sqlqcout = $monitor->qtyqc($kpno,$line);
					$rowqcout = intval($sqlqcout['count']);
					if($rowqcout==0)
					{
						$qtyqcout = 0;
					}
					else
					{
						while ( $arrqcout = $sqlqcout['items']->fetch_assoc()) 
						{
							$qtyqcout = $arrqcout['qtyqc'];
						}
					}
					
					//QTY Pack Output
					$sqlpack = $monitor->qtypack($val['kpno']);
					$rowpack = intval($sqlpack['count']);
					if($rowpack==0)
					{
						$qtypack = 0;
					}
					else
					{
						while ( $arrpack = $sqlpack['items']->fetch_assoc()) 
						{
							$qtypack = $arrpack['qtypack'];
						}
					}
					
					//QTY Ship
					$sqlship = $monitor->qtyship($val['kpno']);
					//var_dump($val['kpno']);
					$rowship = intval($sqlship['count']);
					if($rowship==0)
					{
						$qtyship = 0;
					}
					else
					{
						while ( $arrship = $sqlship['items']->fetch_assoc()) 
						{
							$qtyship = $arrship['qtyship'];
						}
					}
					//var_dump($qtyorder>$qtyship);
					if($qtyorder>$qtyship)
					{
						//var_dump($arrrline['line']);
						$json['data'][] = [$arrrline['line'], $val['kpno'], $val['ddate'],number_format($qtyorder),number_format($qtycut),number_format($qtyqctod),number_format($qtysew),number_format($qtyqcout),number_format($qtypack),number_format($qtyship)];
						
					}
					else
					{
						$json['data']=[];
					}
				}
				
			}
			echo json_encode($json);
		}
	}
?>