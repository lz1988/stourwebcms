// JavaScript Document
function ShowKindSon(obj,id)
{
	
	var table=$("#kindtable")[0];
	var rowindex=obj.parentNode.parentNode.parentNode.rowIndex;//当前行row
    var imgobj=$("#img"+id)[0];
	

	var count=$("tr[name='tr"+id+"']").length;
 
	if(count>0)
	{
	   	
	   TrHandle(id); //删除相关tr
	   imgobj.src="img/explode.png";
	}
	else
	{

    
	 var cssname=new Array("order","name","url","color","order","manage");
	 $.ajax(
		    {
			  type: "post",
			  data: "dopost=GetKindSon&pid="+id,
			  url: "plugin_left_nav_ajax.php",
			  success: function(data,textStatus)
			  {
				
			   var para=eval('('+data+')');
				
				 var length=para[0].length;
				
				 
				 
				 for(var i=0;i<length;i++)
				 {
					 rowindex++;
					
					 var row=table.insertRow(rowindex);
					 row.className="tdbg";
					 row.onmouseout=out;
					 row.onmouseover=over;
					 row.name="tr"+id;
					 row.id=para[6][i];
					 for(var k=0;k<6;k++)
					 {
						 var cell = row.insertCell(k);
						 
						 cell.className=cssname[k];
               
	                     cell.innerHTML = para[k][i];
						  if(k==5) //最后一个加上td便于优化设置
						 {
							cell.id="td"+ para[6][i];
						 }
					 }
				
				 }
				 
				 imgobj.src="img/contract.png";

			   },
			  error: function()
			  {
				  
				  //alert("请求出错处理");
			  }
			  
		   }
		     );	
	}

}


//添加行
function addchild(obj,fid)
{

	var table=$("#kindtable")[0];
	var typeid=$("#typeid").val();
	var rowindex=obj.parentNode.parentNode.parentNode.parentNode.rowIndex;//当前行row
	var cssname=new Array("order","name","url","color","order","manage");
	 $.ajax(
		    {
			  type: "post",
			  data: "dopost=AddNavChild&pid="+fid,
			  url: "plugin_left_nav_ajax.php",
			  success: function(data,textStatus)
			  {
				     
			         var para=eval('('+data+')');
					 var row=table.insertRow(rowindex);
					 row.className="tdbg";
					 row.onmouseout=out;
					 row.onmouseover=over;
					 row.name="tr"+fid;
					 row.id=para[6];
					 for(var k=0;k<6;k++)
					 {
						 var cell = row.insertCell(k);
						 
						 cell.className=cssname[k];
               
	                     cell.innerHTML = para[k];
						
						 if(k==5) //最后一个加上td便于优化设置
						 {
							
							cell.id="td"+ para[5];
							
						 }
					 }

			   },
			  error: function()
			  {
				  
				  //alert("请求出错处理");
			  }
			  
		   }
		     );	
	
	
}
//收缩处理
function TrHandle(id)
{
	
	
	  $("tr[name='tr"+id+"']").each( 
								function()
								{
                                  var childid=this.id;
								  $(this).remove();
								
									
									TrHandle(childid);
                                });
	
	
}
//选择行时背景更改事件(onmouseover,onmouseout)
function over()
{
  this.className='tdbgs'
}  
function out()
{
  this.className='tdbg';
}



//占击保存事件

//td的点击事件
function kind_tdclick(id)
{
  
    //将td的文本内容保存
    var td = $(".name"+id);
    var tdText = td.text().Trim();   
	if(td.children("input").length > 0)
	{
		return false;
	}
    //将td的内容清空
    td.empty();
    //新建一个输入框
    var input = $("<input>");
    //将保存的文本内容赋值给输入框
    input.attr("value",tdText);
	input.css({"width":"60px"});
    //将输入框添加到td中
    td.append(input);
    //给输入框注册事件，当失去焦点时就可以将文本保存起来
    input.blur(function(){
        //将输入框的文本保存
        var input = $(this);
        var inputText = input.val();
		inputText=inputText.Trim();
		
		if(inputText=='')
		{
			
			//alert("排序不能为空");
			 //var td = input.parent("span");
             //td.html(tdText);
			//return;	
			inputText='9999';//如果为空则恢复默认排序
		}
		if(isNaN(inputText))
		{
			var td = input.parent("span");
            td.html(tdText);
			//alert("排序只能输入数字");
			
			return;
		}
  $.ajax(
		 {
		   type: "post",
		   data: "dopost=kind_saveorder&kindid="+id+"&displayorder="+inputText,
		   url:  "plugin_left_nav_ajax.php",
		   beforeSend: function(){
			
		   },
		   success: function(data)
		   {
				 if(data=='ok')
				 {
				   
				 }
				 else if(data=='no')
				 {
					// alert('错误');
				 }
			},
		   
			error: function()
			{  
			 // alert("请求出错，请重试");
			}
		  
		});
        //将td的内容，即输入框去掉,然后给td赋值
        var td = input.parent("span");
		if(inputText=='9999')
		inputText='';
        td.html(inputText);
        //让td重新拥有点击事件
        td.click(kind_tdclick);
    });
	input.keyup(function(event){
        //1.获取当前用户按下的键值
              //解决不同浏览器获得事件对象的差异,
             // IE用自动提供window.event，而其他浏览器必须显示的提供，即在方法参数中加上event
           var myEvent = event || window.event;
           var keyCode = myEvent.keyCode;
           //2.判断是否是ESC键按下
           if(keyCode == 27){
               //将input输入框的值还原成修改之前的值
               input.val(tdText);
           }
    });
    //将输入框中的文本高亮选中
    //将jquery对象转化为DOM对象
    var inputDom = input.get(0);
    inputDom.select();
    //将td的点击事件移除
    td.unbind("click");
	
};

//分类名修改保存
function kind_savekind(id,kindname,typeid)
{
	$.ajax(
		 {
		   type: "post",
		   data: "dopost=kind_savekind&kindid="+id+"&kindname="+kindname,
		   url:  "plugin_left_nav_ajax.php",
		   beforeSend: function(){
			
		   },
		   success: function(data)
		   {
			},
		   
			error: function()
			{  
			  alert("请求出错，请重试");
			}
		  
		});
	
}

//url链接地址保存
function kind_saveurl(id,url)
{
	
	$.ajax(
		 {
		   type: "post",
		   data: "dopost=kind_saveurl&kindid="+id+"&linkurl="+url,
		   url:  "plugin_left_nav_ajax.php",
		   beforeSend: function(){
			
		   },
		   success: function(data)
		   {

			},
		   
			error: function()
			{  
			  //alert("请求出错，请重试");
			}
		  
		});
}

//链接颜色保存
function kind_savecolor(id,value)
{

	$.ajax(
		 {
		   type: "post",
		   data: "dopost=kind_savecolor&kindid="+id+"&color="+value,
		   url:  "plugin_left_nav_ajax.php",
		   beforeSend: function(){
			
		   },
		   success: function(data)
		   {
             
			},
		   
			error: function()
			{  
			 // alert("请求出错，请重试");
			}
		  
		});
	
	
}

//删除分类
function DeleteKind(obj,id)
{
	if(!confirm('确认删除此分类吗?'))
	{
		return false;
	} 

	var formdata="dopost=DeleteKind&id="+id;
	
	$.ajax(
		    {
			  type: "post",
			  data: formdata,
			  url: "plugin_left_nav_ajax.php",
			  success: function(data,textStatus)
			  {
				
				
				 if(data=='ok')
				 {
			       $(obj).parent().parent().parent().remove();
				   ZENG.msgbox.show('分类删除成功',4,2000);
				 }
				 else if(data=='child')
				 {
				   	 ZENG.msgbox.show('当前分类存在子分类,请先删除子分类',5,2000);
				 }

			   },
			  error: function()
			  {
				  
				  //alert("请求出错处理");
			  }
			  
		   }
		     );	
	
}

String.prototype.Trim = function()
{
	return this.replace(/(^\s*)|(\s*$)/g, "");
}

function list_kind_toggle(contain,kindid,type,status,typeid,kindname)
{
	
	var kindstatus=(status==1) ? 0 : 1;
	$.ajax(
	{
	   type: "post",
	   data: "dopost=tog_kind_open"+"&kindid="+kindid+"&status="+kindstatus,
	   url: "plugin_left_nav_ajax.php",
	   success: function(data)
	   {
			
			if(data=='ok')
			 {
			     if(status == 1)
				 {
					var html="<span onclick=\"list_kind_toggle('"+contain+"','"+kindid+"','"+type+"','0')\" style='color:gray;'>&times</span>";
					
					 $("#"+contain).html(html);
				 }
				 else
				 { 
				    var html="<span onclick=\"list_kind_toggle('"+contain+"','"+kindid+"','"+type+"','1')\" style='color:#f60;'>&radic;</span>";
					 $("#"+contain).html(html);
				 }
			 }
			 else if(data=='no')
			 {
				 alert('错误');
			 }
			
		},
	   
		error: function()
		{
		  
		  alert("请求出错，请重试");
		}
	  
	});
}