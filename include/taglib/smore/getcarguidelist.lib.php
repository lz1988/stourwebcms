<?php
if(!defined('SLINEINC'))
{
   exit("Request Error!");
}

function lib_getcarguidelist(&$ctag,&$refObj)
{
	
    global $dsql;	
	include(SLINEDATA."/webinfo.php");
	$attlist="row|8";
	FillAttsDefault($ctag->CAttribute->Items,$attlist);
    extract($ctag->CAttribute->Items, EXTR_SKIP);
    $innertext = $ctag->GetInnerText();
	$dtp2 = new STTagParse();
    $dtp2->SetNameSpace('field','[',']');
    $dtp2->LoadSource($innertext);
	
	//echo $idselected; 
	switch($flag)
	{
		
		case 'stylelist':
			$sqlstr="select * from #@__car_kind  order by displayorder asc";

		break;
		case 'brandlist':
			$sqlstr="select * from #@__car_brand where webid=0";
		break;
		
		case "pricerange":
			$sqlstr="select * from #@__car_pricelist where webid=0";
	    
		break;		
	}
   
	if(empty($sqlstr)) return '';
    $dsql->SetQuery($sqlstr);
    $dsql->Execute();
    
    $totalRow = $dsql->GetTotalRow();
  //echo $totalRow;
	$likeType='';
    $GLOBALS['autoindex'] = 0;//??
	for($i=0;$i < $totalRow;$i++)
    {
        $GLOBALS['autoindex']++;
         if($row=$dsql->GetArray())
		 {
         	$likeType.=GetDataHandle($flag,$row,$dtp2);   
            
         }
       
            //$GLOBALS['autoindex']++;
        
     
    }
	
    //Loop for $i
    $dsql->FreeResult();
	//print_r($likeType);
	return $likeType;
	

}
