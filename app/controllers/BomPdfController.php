<?php
require_once("fpdf17/FPDF_AutoWrapTable.php");
class BOMPDF extends FPDF_AutoWrapTable {
	public $option = array();
	public $data = array();
	
	public function ReportData ($styleno,$kpno) {
		$query = "Select matcontents,itemdesc,vendorcode,colorgarment,colorcode,size
					,GarmentQty,consumption,allowance,qty,unit,PONo From pr Where styleno='".$styleno."' AND kpno='".$kpno."'";
		$result = conn($query);
		
		$data = array();
		while ($row = $result->fetch_assoc()) {
			array_push($this->data, $row);
		}
	
	
		$border = 0;
		$this->AddPage();
		
		$this->SetAutoPageBreak(true,20);
		$this->AliasNbPages();
		
		// $left = 25;

		//header
		$this->SetFont("", "B", 15);
		$this->MultiCell(0, 12, 'PT.Pan Brothers Tbk.');
		$this->Cell(0, 1, " ", "B");
		$this->Ln(10);
		$this->SetFont("", "B", 12);
		$this->SetX($left); $this->Cell(0, 10, 'BILL OF MATERIAL', 0, 1,'C');
		
		$this->SetFont("", "", 10);
		$this->Cell(0, 10, 'Kp NO : '.$kpno.'', 0, 1,'L');
		$this->Ln(10);

		$h = 13;
		$left = 20;
		$top = 80;	
		#tableheader
		$this->SetFillColor(200,200,200);	
		$left = $this->GetX();
		$this->Cell(90,$h,'RMS / Item #',1,0,'C',true);
		$this->SetX($left += 90); $this->Cell(120, $h, 'Description', 1, 0, 'C',true);
		$this->SetX($left += 120); $this->Cell(70, $h, 'Supplier', 1, 0, 'C',true);
		$this->SetX($left += 70); $this->Cell(70, $h, 'Gmt Color', 1, 0, 'C',true);
		$this->SetX($left += 70); $this->Cell(70, $h, 'Item Color', 1, 0, 'C',true);
		$this->SetX($left += 70); $this->Cell(50, $h, 'Size', 1, 0, 'C',true);
		$this->SetX($left += 50); $this->Cell(50, $h, 'Gmt Qty', 1, 0, 'C',true);
		$this->SetX($left += 50); $this->Cell(60, $h, 'Cons', 1, 0, 'C',true);
		$this->SetX($left += 60); $this->Cell(40, $h, 'Allw', 1, 0, 'C',true);
		$this->SetX($left += 40); $this->Cell(60, $h, 'PR Qty', 1, 0, 'C',true);
		$this->SetX($left += 60); $this->Cell(30, $h, 'UOM', 1, 0, 'C',true);
		$this->SetX($left += 30); $this->Cell(80, $h, 'PO No', 1, 1, 'C',true);
		// //$this->Ln(20);
		
		// isi data report
		$this->SetFont('Arial','',9);
		$this->SetWidths(array(90,120,70,70,70,50,50,60,40,60,30,80));
		$this->SetAligns(array('L','L','L','L','L','L','L','L','L','L','L','L'));
		$this->SetFillColor(255);
		foreach ($this->data as $baris) {
			$this->Row(
				array($baris['matcontents'], 
				$baris['itemdesc'], 
				$baris['vendorcode'],
				$baris['colorgarment'],
				$baris['colorcode'],
				$baris['size'],
				$baris['GarmentQty'],
				$baris['consumption'],
				$baris['allowance'],
				$baris['qty'],
				$baris['unit'],
				$baris['PONo']
			));
		}
	}
	
	//sett view report
	public function PrintPDF($styleno,$kpno){
		$options = array(
			'filename' => '', //nama file penyimpanan, kosongkan jika output ke browser
			'destinationfile' => '', //I=inline browser (default), F=local file, D=download
			'paper_size'=>'A4',	//paper size: F4, A3, A4, A5, Letter, Legal
			'orientation'=>'L' //orientation: P=portrait, L=landscape
		);
	
		if($options['paper_size'] == "F4") {
			$a = 8.3 * 72; //1 inch = 72 pt
			$b = 13.0 * 72;
			$this->FPDF($options['orientation'], "pt", array($a,$b));
		}else{
			$this->FPDF($options['orientation'], "pt", $options['paper_size']);
		}

		$this->SetAutoPageBreak(false);
		$this->AliasNbPages();
		$this->SetFont("helvetica", "B", 10);
		
		$this->ReportData($styleno,$kpno);
		
		$this->Output($options['filename'],$options['destinationfile']);
	}

}

?>