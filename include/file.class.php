<?php
class STFile {
    /*------
     *使用方法:
     *$file=new STFile("$file,$mode");$file为文件的地址  $mode为
     ------*/
    private $open;
    private $Data;
    private $File;
    private $openmodel; //(r,r+,w,w+,a,a+,b)

    function __construct($file,$mode = 'r'){
        $this->File=$file;
        $this->openmodel=$mode;
        $this->OpenFile();


    }

    function OpenFile()
    { //打开文件
        if($this->openmodel=="r")
        {
            if(!$this->open=fopen($this->File,$this->openmodel))
            {
                return $this->open=fopen($this->File,"w");

            }
            else
            {
                return $this->open;
            }
        }else{

            return $this->open=fopen($this->File,$this->openmodel);

        }
    }


    function closefile()
    {//关闭文件

        return  fclose($this->open);

    }

    function readcontent()
    {  //获取文件内容
        //@flock($this->open, 1);

        $Content = fread($this->open, filesize($this->File));
        return $this->Data = $Content;
    }


    function checkfile()
    {//判断文件是否存在，存在为真，不存在为假
        if (file_exists($this -> File)) { return true; } else { return false; }
    }

    function writefile($Datawrite,$Mode = 3)
    {
        @flock($this->open,3);
        $result=fwrite($this->open,$Datawrite);
        $this->closefile();
        return $result;
    }
}
?>