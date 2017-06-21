<?php
	class tbl_line{
		protected $table = 'qcout';
		protected $field = '*';
		
		public function sql(){
			$table = $this->table;
			$field = $this->field;

			$sql = selectSql($field,$table);

			return $sql;
		}
		
		public function kpno($f,$d,$t){
			$table = "orderstatus a 
					  INNER JOIN orderstatusdetail b ON a.kpno=b.kpno
					  INNER JOIN masterbuyer c ON c.buyercode=a.buyercode
					  INNER JOIN (SELECT DISTINCT a.line AS line,a.Kpno,b.ftycode AS ftycode FROM qcout a 
					  INNER JOIN master_line b ON a.line=b.line ) d ON d.Kpno=a.Kpno";
					  
			$field = " a.buyercode AS buyercode,a.kpno AS kpno,a.styleno AS styleno,min(b.deldate) AS ddate";
			
			$where =  "deldate BETWEEN DATE_FORMAT('".$d."','%Y-%m-%d') AND DATE_FORMAT('".$t."','%Y-%m-%d') 
					   AND cancelpo<>1 AND right(a.kpno,2)<>'FC' AND c.status='B' 
					   AND left(a.kpno,3)<>'CR1' AND left(a.kpno,3)<>'CR2' AND d.ftycode='".$f."'
					   GROUP BY a.kpno ORDER BY d.line,a.KpNo ASC";

			$sql = selectSql($field,$table,$where);	
			//$sql = "SELECT ".$field." FROM ".$table." WHERE ".$where;

			return $sql;
		}
		
		public function line($f,$kpno){
			$table = "qcout a 
					  INNER JOIN master_line b ON a.line=b.line";
					  
			$field = "a.line AS line";
			
			$where =  "a.kpno='".$kpno."' AND b.ftycode='".$f."'
					   GROUP BY a.line
					   ORDER BY a.line ASC";

			$sql = selectSql($field,$table,$where);	
			//$sql = "SELECT ".$field." FROM ".$table." WHERE ".$where;

			return $sql;
		}
		
		public function qtyorder($kp){
			$table = "orderstatusdetail";
			$field = "sum(qty) AS qqty ";
			$where = "kpno='".$kp."' and deldate<>'0000-00-00'
			          GROUP BY kpno";

			$sql = selectSql($field,$table,$where);	
			//$sql = "SELECT ".$field." FROM ".$table." WHERE ".$where;

			return $sql;
		}
		
		public function qtycut($kp){
			$table = "tblcut_output";
			$field = "SUM(qty) AS qtycut";
			$where = "kpno='".$kp."'
			          GROUP BY kpno";

			$sql = selectSql($field,$table,$where);	
			//$sql = "SELECT ".$field." FROM ".$table." WHERE ".$where;

			return $sql;
		}
		
		
		
		public function qtyqctod($kp,$l){
			
			$table = "qcout";
			$field = "SUM(h1+h2+h3+h4+h5+h6+h7+h8+h9+h10+h11+h12+h13+
					  h14+h15+h16+h17+h18+h19+h20+h21+h22+h23+h24+h25+h26+h27+h28+h29+
					  h30+h31+h32+h33+h34+h35+h36+h37+h38+h39+h40+h41+h42+h43+h44+h45+
					  h46+h47+h48) AS qtyqc ";
			$where = "kpno ='".$kp."'
					  AND line='".$l."'
					  AND datecreate=DATE_FORMAT(NOW(),'%Y-%m-%d') 
					  GROUP BY kpno,line";

			$sql = selectSql($field,$table,$where);	
			//$sql = "SELECT ".$field." FROM ".$table." WHERE ".$where;

			return $sql;
		}
		
		
		public function qtysew($kp,$l){
			
			$table = "sew_out";
			$field = "SUM(h1+h2+h3+h4+h5+h6+h7+h8+h9+h10+h11+h12+h13+
					  h14+h15+h16+h17+h18+h19+h20+h21+h22+h23+h24+h25+h26+h27+h28+h29+
					  h30+h31+h32+h33+h34+h35+h36+h37+h38+h39+h40+h41+h42+h43+h44+h45+
					  h46+h47+h48) AS qtysew";
			$where = "kpno ='".$kp."'
					  AND line='".$l."'
					  GROUP BY kpno,line";

			$sql = selectSql($field,$table,$where);	
			//$sql = "SELECT ".$field." FROM ".$table." WHERE ".$where;

			return $sql;
		}
		
		public function qtyqc($kp,$l){
			
			$table = "qcout";
			$field = "SUM(h1+h2+h3+h4+h5+h6+h7+h8+h9+h10+h11+h12+h13+
					  h14+h15+h16+h17+h18+h19+h20+h21+h22+h23+h24+h25+h26+h27+h28+h29+
					  h30+h31+h32+h33+h34+h35+h36+h37+h38+h39+h40+h41+h42+h43+h44+h45+
					  h46+h47+h48) AS qtyqc ";
			$where = "kpno ='".$kp."'
					  AND line='".$l."'
					  GROUP BY kpno,line";

			$sql = selectSql($field,$table,$where);	
			//$sql = "SELECT ".$field." FROM ".$table." WHERE ".$where;

			return $sql;
		}
		
		public function qtypack($kpno){			
			$table = "packout";
			$field = "SUM(qty) AS qtypack";
			$where = "kpno='".$kpno."'
					  GROUP BY kpno,line";

			$sql = selectSql($field,$table,$where);	
			//$sql = "SELECT ".$field." FROM ".$table." WHERE ".$where;

			return $sql;
		}
		
		public function qtyship($kpno){
			
			$table = "hsj_export_act";
			$field = "SUM(qtypcs) AS qtyship ";
			$where = "kpno='".$kpno."'
					  GROUP BY kpno";

			$sql = selectSql($field,$table,$where);	
			//$sql = "SELECT ".$field." FROM ".$table." WHERE ".$where;

			return $sql;
		}
	}
?>