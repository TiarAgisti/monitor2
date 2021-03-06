<?php
//create by tiar
$json = array();

$info = $data["info"]->fetch_assoc();
$infoNotes = $data["infoNotes"]->fetch_assoc();

$json['title'] = 'Notes';
				
$json['body'] = '<div class="row">
					<div class="col-sm-6">
						<div class="col-sm-4 text-right">KP No:</div>
						<div class="col-sm-6 detail-no-kp">'.$info['KPNo'].'</div>
					</div>
				</div>';
				
$json['body'] .= '<div class="row">
					<div class="col-sm-6">
						<div class="col-sm-4 text-right">Mat Contents :</div>
						<div class="col-sm-6 detail-matcontents">'.$info['matcontents'].'</div>
					</div>
				</div>';

$json['body'] .= '<div class="col-sm-15">
					<div class="panel panel-white">
						<div class="panel-body padding-top-5 padding-bottom-5">
							<div class="form-group">
								<div class="note-editor" width="500px">
									<textarea class="form-control">'.$infoNotes['notes'].'</textarea>
								</div>
							</div>
						</div>
					</div>
				</div>';			

$json['footer'] .= '<button type="button" class="btn btn-primary btn-o modal-confirm" data-dismiss="modal" data-status="1">
						Save
					</button>';
$json['footer'] .= '<button type="button" class="btn btn-primary modal-close" data-dismiss="modal">
						close
					</button>';


echo json_encode($json);