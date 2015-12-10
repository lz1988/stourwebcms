<?php
if (!defined('SLINEINC'))exit('Request Error!');
    
/**
 * 
 *
 * @version        $Id: php.lib.php1 9:29 2011.05.11 netman $
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2010 - 2014, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */
 

 
function lib_php(&$ctag, &$refObj)
{
    global $dsql;
    global $db;
    $phpcode = trim($ctag->GetInnerText());
    if ($phpcode == '')
        return '';
    ob_start();
    extract($GLOBALS, EXTR_SKIP);
    @eval($phpcode);
    $revalue = ob_get_contents();
    ob_clean();
    return $revalue;
}