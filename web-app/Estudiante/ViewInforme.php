<?php

	//$mi_pdf = '../../public/file/evidencias/'.$_GET['id'];
	$mi_pdf = '/var/www/uploads/'.$_GET['id'];
	header('Content-type: application/pdf');
	header('Content-Disposition: inline; filename="'.$mi_pdf.'"');
	readfile($mi_pdf);

?>
