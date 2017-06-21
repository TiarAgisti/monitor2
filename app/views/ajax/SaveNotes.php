<?php 
//create by tiar
require_once("phpmailer/PHPMailerAutoload.php"); // add by tiar 13 januari 2017

$mail = new PHPMailer;

$tbl_pr = $data['tbl_pr'];

$kpNo = htmlspecialchars_decode($data['post'][0]);
$matContents = htmlspecialchars_decode($data['post'][1]);
$kpNotes = htmlspecialchars_decode($data['post'][2]);
// $id = htmlspecialchars_decode($data['post'][3]);
$emailTo = htmlspecialchars_decode($data['post'][3]);


$json = array();

$res = ['kpno'=>$kpNo, 'matcontents'=>$matContents, 'notes'=>$kpNotes];
		
// var_dump($res);


if($kpNo != '' & $emailTo == ''){
	
	$check = $tbl_pr->checkNotesIsExist($kpNo,$matContents)['exist'];
	
	if($check){
		$cond = [$kpNo,$matContents,$id];
		$resUpdate = ['notes'=>$kpNotes];
		
		$insertnote = $tbl_pr->UpdateNotes($resUpdate,$cond);
	}else{
		$insertnote = $tbl_pr->insertNote($res);
	}

	$json['notif'] = ($insertnote)? 'success':'warning';
	$json['headMsg'] = ($insertnote)? 'Information':'Alert';
	$json['msg'] = ($insertnote)? 'Notes Saved':'Save is failed';	
}

//send email
if($emailTo != '')
{
	// $mail->isSMTP();		
	$mail->Protocol = 'smtp';
	$mail->Host = '192.168.40.220';
	$mail->Port = 25;
	$mail->SMTPDebug  = false;
	$mail->SMTPSecure = 'tls';

	$mail->SMTPAuth = true;
	$mail->Username = 'pbtsw@pbrx.co.id';
	$mail->Password = 'pbt123';

	$mail->From = 'noreply1@pbrx.co.id';
	$mail->FromName = 'Notes Email';

	// $mail->addReplyTo('noreply@pbrx.co.id', 'No Reply');
	$subjectTo = explode(';', $emailTo);
	
	array($subjectTo);
	// var_dump(array($subjectTo));
	foreach ($subjectTo as $key => $value) 
	{
		$mail->addAddress($value);

		$subject = "Notes for kpNo = ";
		$subject .= $kpNo;

		if($matContents != ''){
			$msg = 'Item Number : ';
			$msg .= $matContents;
			$msg .= "\n";
			$msg .= 'notes : ';
			$msg .= $kpNotes;
		}
		else
		{
			$msg = 'notes : ';
			$msg .= $kpNotes;
		}
		
		$mail->Subject = $subject;
		$mail->Body = $msg ;
	}

	if (!$mail->send()) {
		$error = "Error Information: " . $mail->ErrorInfo;
		$json['notif'] = 'warning';
		$json['headMsg'] = 'Alert';
		$json['msg'] = $error;
	} 
	else {
		$json['notif'] = 'success';
		$json['headMsg'] = 'Information';
		$json['msg'] = 'Send email success';
	}
}

echo json_encode($json);