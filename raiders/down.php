<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");

$downloadfile = time().".pdf";
$sourcefile = $GLOBALS['cfg_basehost'].$file;
header('Content-type: application/pdf');

// It will be called downloaded.pdf
header('Content-Disposition: attachment; filename="'.$downloadfile.'"');

// The PDF source is in original.pdf
readfile($sourcefile);
