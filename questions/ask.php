<?php 
require_once(dirname(__FILE__)."/../include/common.inc.php");
function GetChannel()
{
	global $dsql;
	$str = "分类：<select name=\"typeid\"><option value=''>--请选择--</option>";
	$sql = "select * from #@__nav where pid='0' and isopen='1' and webid='0' and typeid != '10'";
	$row = $dsql->getAll($sql);
	foreach($row AS $res)
	{
		$str .= "<option value='" . $res['typeid'] . "'>" . $res['shortname'] . "</option>";
	}
	$str .= "</select>";
	return $str;
}

$select=GetChannel();

 ?>

<div id="QS">
<form action="<?php echo $GLOBALS['cfg_cmsurl']; ?>/public/question.php" method="post" onSubmit="return SubmitQ();">
  <div id="Submit">
    <p><span>温馨提示：</span>请把你要问的问题按以下信息进行描述，我们将以最快的速度回复您</p>
    <ul class="Submit_bt">
        <li style=" height:30px; line-height:30px">
          <b class="fl">问题标题：</b>
          <input class="text fl" type="text" name="title" id="qtitle" />
          <span class="color_f60 hf fl"><?php echo $select; ?></span>
          <span class="color_f60 hf fl">*需要及时回复<input name="musttime" type="checkbox"  value="1" /></span>
        </li>
        <li><textarea name="content" cols="" rows="" id="qcontent"></textarea></li>
        <li style=" height:30px; line-height:30px" class="fl">
          <span class="fl">联系人：</span>
          <input class="text1 fl" type="text" name="leavename" id="qusername" />
          <span class="fl">匿名：<input class="nimi" name="noname" type="checkbox" id="noname" value="0" /></span>
          <span class="yzm fl">验证码：<img src= "<?php echo $GLOBALS['cfg_cmsurl']; ?>/include/vdimgck.php"  style="cursor:pointer" onclick="this.src=this.src+'?'" title="点击我更换图片" alt="点击我更换图片" /></span>
          <input class="text2 fl" type="text" name="validate" id="validate" /><span class="color_46 fl">请输入图片上的预算结果</span>
        </li>
    </ul>
    <ul class="contact">
        <li class="lx"><b>您的联系方式：</b>（方便客服人员及时联系为您解答疑问）</li>
        <li class="fl fs"><span>电话：</span><input class="text" type="text" name="telephone" id="telephone" /></li>
        <li class="fl fs"><span>邮箱：</span><input class="text" type="text" name="email" id="email" /></li>
        <li class="fl fs"><span>Q Q：</span><input class="text" type="text" name="qq" id="qq" /></li>
        <li class="fl fs"><span>MSN：</span><input class="text" type="text" name="msn" id="msn" /></li>
        <li class="fl fs"><input class="button_2" type="submit" name="anniu" value="提交问题" /></li>
    </ul>
  </div>
</form>

</div>
