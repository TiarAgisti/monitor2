<?php
	class tbl_orderstatus {
		public function sql(){
			$table = $this->table;
			$field = $this->field;

			$sql = selectSql($field,$table);

			return $sql;
		}
		
		public function listorder($StyleNo,$KPNo){
			$table = 'orderstatus
					  INNER JOIN masterbuyer ON masterbuyer.BuyerCode=orderstatus.BuyerCode
					  INNER JOIN orderstatusdetail ON orderstatusdetail.KPNo = orderstatus.KPNo AND orderstatusdetail.StyleNo=orderstatus.StyleNo';
			$field = 'Buyer,orderstatus.Season AS Season, orderstatus.StyleNo AS StyleNo,orderstatus.KPNo AS KPNo,orderstatus.ItemName AS ItemName,
					  orderstatusdetail.BuyerNo  AS BuyerNo, orderstatusdetail.Unit AS Unit, orderstatusdetail.Qty AS Qty,orderstatus.Material,
					  orderstatusdetail.Dest,DATE_FORMAT(orderstatusdetail.DelDate,"%d %b %Y") AS DelDate';
			$where = 'orderstatus.KPNo="'.$KPNo.'" AND orderstatus.StyleNo="'.$StyleNo.'" AND orderstatusdetail.Qty > 0'; //edit by tiar
			
			$sql = selectSql($field,$table,$where);		
			//$sql = "SELECT ".$field." FROM ".$table." WHERE ".$where;
			
			return $sql;
		}

		//add tiar
		public function retrieveBuyerNoDetail($buyerNo,$kpno){
			$table = 'buyernodetail';
			// $field = 'color,size,Qty';
			$field = 'size,color,qty'; //edit by tiar 11 januari 2017
			$where = 'BuyerNo="'.$buyerNo.'" AND KPNo="'.$kpno.'"';

			$sql = selectSql($field,$table,$where);

			return $sql;
		}
		//end add


		// add by tiar 11 januari 2017
		public function retrieveSize($buyerNo,$kpNo){
			$table = 'buyernodetail';
			$field = 'DISTINCT size';
			$where = 'BuyerNo="'.$buyerNo.'" AND KPNo="'.$kpNo.'"';

			$sql = selectSql($field,$table,$where);
			return $sql;
		}
		// end add
	}
?>