<?php
session_start();
//if(!session_is_registered(myusername)){    //checks if user is logged in
//header("location:index.php");         //location of login
//header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
//header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
//}
$pdf = $_GET['file'];                //'file' sent from Login.php
// if(preg_match('/^[a-zA-Z0-9_\-]+.pdf$/', $pdf) == 0) {
// 	print "Illegal name: $pdf";
// 	return;  //looks to match the pdf name given by ['file']
// }
header('Content-type: application/pdf');  //header info for pdf formats
header('Content-disposition: Attachment; filename=' . $pdf); //marks file as an attachment
readfile($pdf); //then outputs the file



 ?>
