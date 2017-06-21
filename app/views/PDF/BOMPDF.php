<?php
require_once("app/controllers/BomPdfController.php");
$styleno = $data['styleno'];
$kpno = $data['kpno'];

$tabel = new BOMPDF();
$tabel->PrintPDF($styleno,$kpno);

?>