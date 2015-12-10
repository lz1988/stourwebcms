<?php
include "phpqrcode/phpqrcode.php";  
error_reporting(E_ERROR);
$value=$_GET['data'];  
if(empty($value))
   exit('wrong params!');
$errorCorrectionLevel = "L";  
$matrixPointSize = $_GET['size'];  
$matrixPointSize=empty($matrixPointSize)?8:$matrixPointSize;
QRcode::png($value, false, $errorCorrectionLevel, $matrixPointSize);  