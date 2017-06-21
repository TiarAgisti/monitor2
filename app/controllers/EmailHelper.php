<?php
require_once("phpmailer/PHPMailerAutoload.php");

$mail = new PHPMailer;

public function SendEmail($subjectTo,$subject,$msg)
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

	$mail->From = 'noreply@pbrx.co.id';
	$mail->FromName = 'Notes Email';

	// $mail->addReplyTo('noreply@pbrx.co.id', 'No Reply');
	$subjectTo = explode(';', $subjectTo);
	
	array($subjectTo);

	foreach ($subjectTo as $key => $value) 
	{
		$mail->addAddress($value);

		$mail->Subject = $subject;
		$mail->Body = $msg ;
	}

	if (!$mail->send()) {
		return false;
	else {
		return true;
	}

}

?>