<?php
	class tbl_pr {
		// protected $tableNotes = 'pr_check';
		// protected $field = '*';
		
		public function sql(){
			$table = $this->table;
			$field = $this->field;

			$sql = selectSql($field,$table);

			return $sql;
		}
		
		//add by tiar
		public function insertNote($data){
			$table = 'pr_check';
			$sql = insertSql($table,$data);

			return $sql;
		}
		// end add
		
		//add by tiar
		public function checkNotesIsExist($kpNO,$matContents,$id){
			$table = 'pr_check';
			$field = 'kpno,matcontents';
			$where = "kpno = '".$kpNO."' AND matcontents='".$matContents."'";
			
			$query = selectSql($field,$table,$where);
			
			return $query;
		}
		//and
		
		
		//add by tiar
		public function UpdateNotes($data,$cond){
			$table = 'pr_check';
			$where = 'kpno = "'.$cond[0].'" AND matcontents = "'.$cond[1].'"';
			$query = updateSql($table,$data,$where);
			
			return $query;
		}
		// end
		
		public function liststyle($buyer){
			$table = "orderstatus";
			$field = "styleNo";
			$where = "BuyerCode='".$buyer."' GROUP BY styleNo";
			
			$sql = selectSql($field,$table,$where);
			return $sql;

			/*$sql = "SELECT ".$field." FROM ".$table." WHERE ".$where;
			var_dump($buyer);*/
			
		}
		
		public function listkp($style,$buyerCode){
			$table = "orderstatus";
			$field = "KPNo";
			$where = "styleNo='".$style."' AND BuyerCode='".$buyerCode."'";
			
			$sql = selectSql($field,$table,$where);
			return $sql;	
			// $sql = "SELECT ".$field." FROM ".$table." WHERE ".$where;
			// var_dump($sql);
		}
		
		public function masterprkp($style,$kpno,$o,$l){
			$table = 'pr';
			$field = 'PosNo,position,matcontents,REPLACE(REPLACE(REPLACE(itemdesc, "\n", ""),"\r",""),"²","&sup2;") AS itemdesc,vendorcode,colorgarment,colorcode,sizegarment,size,GarmentQty,consumption,allowance,qty,unit,CASE WHEN PONo<>"" THEN PONo ELSE "-" END AS PONo,KPNo';
			$where = ($o == null AND $l == null)? 'styleNo="'.$style.'" AND kpno IN ("'.$kpno.'")
					  ORDER BY itemdesc ASC' : 'styleNo="'.$style.'" AND kpno IN ("'.$kpno.'")
					  ORDER BY itemdesc ASC LIMIT '.$o.','.$l;
			
			$sql = selectSql($field,$table,$where);		
			//$sql = "SELECT ".$field." FROM ".$table." WHERE ".$where;
			
			return $sql;
		}
		
		//add by tiar 10 februari 2017
		public function MasterprkpByMatContents($style,$kpno,$matContents,$o,$l){
			$table = 'pr';
			$field = 'PosNo,position,matcontents,REPLACE(REPLACE(REPLACE(itemdesc, "\n", ""),"\r",""),"²","&sup2;") AS itemdesc,vendorcode,colorgarment,colorcode,sizegarment,size,GarmentQty,consumption,allowance,qty,unit,CASE WHEN PONo<>"" THEN PONo ELSE "-" END AS PONo,KPNo';
			$where = ($o == null AND $l == null)? 'styleNo="'.$style.'" AND matcontents="'.$matContents.'" AND kpno IN ("'.$kpno.'")
					  ORDER BY itemdesc ASC' : 'styleNo="'.$style.'" AND matcontents="'.$matContents.'" AND kpno IN ("'.$kpno.'")
					  ORDER BY itemdesc ASC LIMIT '.$o.','.$l;

			$sql = selectSql($field,$table,$where);

			return $sql;
		}
		//end add
		
		//add by tiar
		public function detailsPR($kpNo,$matContents){
			$table = 'pr';
			$field = 'KPNo,matcontents,id,CASE WHEN PONo<>"" THEN PONo ELSE "-" END AS PONo,KPNo';
			$where = 'KPNo="'.$kpNo.'" And matcontents="'.$matContents.'"';

			$sql = selectSql($field,$table,$where);

			return $sql;
		}
		//end add
		
		//add by tiar
		public function detailsGlobalPR($kpNO){
			$table = 'pr';
			$matContents = '';
			$field = 'KPNo,matcontents,CASE WHEN PONo<>"" THEN PONo ELSE "-" END AS PONo,KPNo';
			$where = 'KPNo="'.$kpNO.'"';

			$sql = selectSql($field,$table,$where);

			return $sql;
		}
		//end add
		
		//add by tiar
		public function detailsNotes($kpNo,$matContents){
			$table = 'pr_check';
			$field = 'notes';
			$where = 'kpno="'.$kpNo.'" AND matcontents="'.$matContents.'"';

			$sql = selectSql($field,$table,$where);

			return $sql;
		}
		//end add

		//add by tiar 17 januari 2017
		public function detailsNotesGlobal($kpNO){
			$table = 'pr_check';
			$matContents = '';
			$field = 'notes';
			$where = 'KPNo="'.$kpNO.'" AND matcontents ="'.$matContents.'"';

			$sql = selectSql($field,$table,$where);

			return $sql;
		}
		//end add
		
		//add by tiar
		public function ListBOMPDF($styleno,$kpno){
			$table = 'pr';
			$field = 'matcontents,itemdesc,vendorcode,colorgarment,colorcode,size,GarmentQty,consumption,allowance,qty,unit,PONo';
			$where = 'styleno="'.$styleno.'" AND kpno="'.$kpno.'"';

			$sql = selectSql($field,$table,$where);

			return $sql;
		}
		//end add

	}
?>