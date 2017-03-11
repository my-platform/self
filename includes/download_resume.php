<?php
$file_name ='resume.pdf';
header('Pragma: public');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Cache-control: private', false);
header('Content-type: application/pdf');
header('Content-Deposition: attachment; filename="'.basename($file_name). '";');
header('Content-Transfer-Encoded: binary');
header('Content-Length: ' . filesize($file_name));
readfile($file_name);
exit;

?>