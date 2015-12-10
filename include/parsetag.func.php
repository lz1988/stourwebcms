<?php 

function MakeOneTag(&$dtp, &$refObj, $parfield='Y',$templetTagDir='')
{
    global $sys_child_webid;
    $dtp->setRefObj($refObj);
    //读取自由调用tag列表
    $usertags = array(); //用户模板标签
	$templettags = array(); //当前使用模板tag
	$standardtags = array(); //标准模板tag
    if(!$sys_child_webid)
	 $usetemppath = SLINEINC.'/taglib/'.$GLOBALS['cfg_df_style'];

    //用户模板标签
    if(is_dir($templetTagDir))
    {
        $utag= dir($templetTagDir);
        while($filename = $utag->read())
        {
            if(preg_match("/\.lib\./", $filename))
            {
                $usertags[] = str_replace('.lib.php','',$filename);
            }
        }
        $utag->Close();
    }

	if(file_exists($usetemppath))
	{
		$tetag = dir($usetemppath);
		while($filename = $tetag->read())
		{
			if(preg_match("/\.lib\./", $filename))
			{
				$templettags[] = str_replace('.lib.php','',$filename);
			}
		}
		$tetag->Close();
	}
	
    $stag = dir(SLINEINC.'/taglib/smore');
	while($filename = $stag->read())
    {
        if(preg_match("/\.lib\./", $filename))
        {
            $standardtags[] = str_replace('.lib.php','',$filename);
        }
    }
    $stag->Close();

    //遍历tag元素
    if(!is_array($dtp->CTags))
    {
        return '';
    }
    foreach($dtp->CTags as $tagid=>$ctag)
    {
        $tagname = $ctag->GetName();
        if($tagname=='field' && $parfield=='Y')
        {
            $vname = $ctag->GetAtt('name');
            if( $vname=='array' && isset($refObj->Fields) )
            {
                $dtp->Assign($tagid,$refObj->Fields);
            }
            else if(isset($refObj->Fields[$vname]))
            {
                $dtp->Assign($tagid,$refObj->Fields[$vname]);
            }
            else if($ctag->GetAtt('noteid') != '')
            {
                if( isset($refObj->Fields[$vname.'_'.$ctag->GetAtt('noteid')]) )
                {
                    $dtp->Assign($tagid, $refObj->Fields[$vname.'_'.$ctag->GetAtt('noteid')]);
                }
            }
            continue;
        }


		//先判断是否在使用模板的模板标签里面,如果存在则直接调用,如果不存在则判断是否在标准模板里,
        if(in_array($tagname,$usertags))
        {
            $filename = $templetTagDir.'/'.$tagname.'.lib.php';
            include_once($filename);
            $funcname = 'lib_'.$tagname;
            $dtp->Assign($tagid,$funcname($ctag,$refObj));
        }
        else if(in_array($tagname,$templettags))
        {
            $filename = SLINEINC.'/taglib/'.$GLOBALS['cfg_df_style'].'/'.$tagname.'.lib.php';
            include_once($filename);
            $funcname = 'lib_'.$tagname;
            $dtp->Assign($tagid,$funcname($ctag,$refObj));
        }
		else if(in_array($tagname,$standardtags))
		{
			$filename = SLINEINC.'/taglib/smore/'.$tagname.'.lib.php';
            include_once($filename);
            $funcname = 'lib_'.$tagname;
            $dtp->Assign($tagid,$funcname($ctag,$refObj));
			
		}
    }
  }


?>