<?php
//create by tiar
$json = array();

$kpno = $data["kpno"];
$matContents = $data["matcontents"];

$notes = $data["notes"];

// $kpnos = explode(",", $kpno);
			
// foreach($listNotes as $data) {
// 	$notes[] = $data;
// }
$json['title'] = 'Notes';
				
$json['body'] = '<div class="row">
					<div class="col-sm-6">
						<div class="col-sm-4 text-right">KP No:</div>
						<div class="col-sm-6 detail-no-kp">'.$kpno.'</div>
					</div>
					<div class="col-sm-6">
						<div class="col-sm-4 text-right">MatContents:</div>
						<div class="col-sm-6 detail-matcontents">'.$matContents.'</div>
					</div>
				</div>';

$json['body'] .= '<div class="col-sm-15">
					<div class="panel panel-white">
						<div class="panel-body padding-top-5 padding-bottom-5">
							<div class="form-group">
								<div class="note-editor" width="500px">
									<textarea class="form-control" readonly>'.$notes.'</textarea>
								</div>
							</div>
						</div>
					</div>
				</div>';

$json['body'] .= '<div class="col-sm-15">
					<div class="form-group">
						<label for="email">Email to :</label>
						<input type="email" class="form-control" id="txtEmail" placeholder="Enter email">
						<label class=""><strong>USE SEPARATOR ";" FOR MORE EMAIL TO</strong></label>
					</div>
				</div>';			

$json['footer'] .= '<button type="button" class="btn btn-primary btn-o modal-confirm" data-dismiss="modal" data-status="1" id="btnSave">
						Save
					</button>';
$json['footer'] .= '<button type="button" class="btn btn-primary modal-close" data-dismiss="modal">
						close
					</button>';


echo json_encode($json);