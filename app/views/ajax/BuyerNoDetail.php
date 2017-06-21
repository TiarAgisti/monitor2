<?php
//create by tiar 11 januari 2017
$json = array();
$buyerNo = $data['buyerno'];
$kpNo = $data['kpno'];
$style = $data['style'];
$destination = $data['destination'];
$deliverydate = $data['deliverydate'];

$headerColor = $data['headercolor'];
$detailBuyer = $data['detailbuyer'];
$totalQty = $data['qty'];

$json['title'] = 'Details Buyer No. '.$buyerNo;

$json['body'] = '<div class="row">
					<div class="col-sm-4">
						<div class="col-sm-4 text-right">KP No :</div>
						<div class="col-sm-6 detail-no-kp">'.$kpNo.'</div>
					</div>
					<div class="col-sm-6">
						<div class="col-sm-6 text-right">Destination :</div>
						<div class="col-sm-6 detail-no-kp">'.$destination.'</div>
					</div>
				</div>';
				
$json['body'] .= '<div class="row">
					<div class="col-sm-4">
						<div class="col-sm-4 text-right">Style :</div>
						<div class="col-sm-6 detail-style">'.$style.'</div>
					</div>
					<div class="col-sm-6">
						<div class="col-sm-6 text-right">Delivery Date :</div>
						<div class="col-sm-6 detail-style">'.$deliverydate.'</div>
					</div>
				</div>';

$json['body'] .= '<div class="row">
					<div class="col-sm-4">
						<div class="col-sm-4 text-right">Total Qty :</div>
						<div class="col-sm-6 detail-style">'.$totalQty.'</div>
					</div>
				</div>';

$json['body'] .= '<div class="row">
					<div class="col-sm-12" style="margin-top: 10px;margin-bottom: 10px;">
					<table class="table table-bordered table-responsive" id="tbBuyerNoDetail" data-table="dtBuyerNoDetail" data-buyerno="'.$buyerNo.'">';
// for dynamic header add by tiar 11 januari 2017
while ($row = $headerColor->fetch_row()) {
    $size[] = $row[0];
}

// table heading
$emptyRow = array_fill_keys($size,0);

$json['body'] .= '<thead><tr><th>Color</th><th>'.join('</th><th>', $size) . '</th></tr></thead>';
$json['body'] .= '<tbody>';
$curname='';
$total;
while (list($size, $color,$qty) = $detailBuyer->fetch_row()) {
	// $total = 0;
    if ($curname != $color) {
        if ($curname) {
            $json['body'] .= '<tr><td>'.$curname.'</td><td align="right">'.join('</td><td align="right">', $rowdata). '</td></tr>';
        }
        $rowdata = $emptyRow;
        $curname = $color;
		// $rowtotal = $emptyRow;
    }
	$rowdata[$size] = number_format($qty);
	
	$rowtotal[$size] += $qty;
}
// $rowtotal[$size] += $qty;
$json['body'] .= '<tr><td>'.$curname.'</td><td align="right">' .join('</td><td align="right">', $rowdata). '</td></tr>';
$json['body'] .= '</tbody>';
$json['body'] .= '<tfoot>';

$json['body'] .= '<tr><td align="center">TOTAL QTY / SIZE</td><td align="right">'.join('</td><td align="right">', $rowtotal). '</td></tr>';
$json['body'] .= '</tfoot>';
$json['body'] .= '</table></div></div>';
$json['footer'] .= '<button type="button" class="btn btn-primary btn-o modal-close pull-left" data-dismiss="modal">
                    close
                </button>';
				
echo json_encode($json);

?>