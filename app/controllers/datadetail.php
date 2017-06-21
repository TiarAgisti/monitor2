<?php
	class Datadetail extends Controller {
		protected $userpassword;
		protected $kontrakkerja;
		
		public function __construct(){
			//var_dump("AAA");
			if (is_logged() == false) {
				to_page('login');
			} 
			$this->userpassword = $this->model('userpassword');
			$this->kontrakkerja = $this->model('tbl_kk');
		}
		
		public function index(){
			is_header(); 
			$this->view('home',[]);
			is_footer(); 
		}
		
		public function dthkksub(){
			$json = array();
			$code = $_GET['kode'];
			$hkksub = $this->kontrakkerja;
			$length = $_GET['length'];
			$offset = $_GET['start'];
			
			$json["draw"] = intval($_REQUEST['draw']);
			$json["recordsTotal"] = intval($hkksub->dtkk($code)['count']);
			$json["recordsFiltered"] = intval($hkksub->dtkk($code)['count']);
			
			$detailkk = $hkksub->dtkk($code,$offset, $length);
			if($json["recordsFiltered"]==0)
			{
				$json['data']=[];
			}
			else
			{
				while ( $v = $detailkk['items']->fetch_assoc()) {
					$json['data'][] = [$v['kk'],$v['kk_sub'],$v['kpno'],$v['nama_barang'],$v['qtykk']." ".$v['unitkk'],$v['Qtybpb']." ".$v['Unitbpb'],$v['balance']];
				}
			}
			
			echo json_encode($json);
		}
	}
?>