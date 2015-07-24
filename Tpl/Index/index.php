
<html>
 <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
   <title>Select Data</title>

 
</head>
 <body>
 	<script type="text/javascript">
    function test()
    {
    	//alert("xxxx");
        var start_num = document.getElementById("start_num").value;
        var end_num = document.getElementById("end_num").value;
        if(start_num==""||end_num=="")
        {
          alert("请输入内容");
          return false;
        }
        if (!(/(^[1-9]\d*$)/.test(start_num))||!(/(^[1-9]\d*$)/.test(end_num)))
        {
          alert("输入的不是正整数");
          return false;
        }
        if (end_num-start_num<0||end_num>{$site_num}||start_num>{$site_num}) 
        {
          alert("输入不再范围内");
          return false;
        }
        else
        	{
        		page_range.action='{:U('Index/check')}';
	            page_range.submit();
	        }
    }
   </script>
 	<h1 align="center">美团数据关联测评系统</h1>
 	 竞对共有{$site_num}个POI
 	<form   method="post" id="page_range" >
 		    <p> 请选择测试范围</p>
			<input onkeyup="value=value.replace(/[/W]/g,'') "
			onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^/d]/g,''))" 
			onkeydown="if(event.keyCode==13)event.keyCode=9" id="start_num" name="start_num">－
		    </input>
		    <input onkeyup="value=value.replace(/[/W]/g,'') "
			onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^/d]/g,''))" 
			onkeydown="if(event.keyCode==13)event.keyCode=9" id="end_num" name="end_num">
		    </input>
		    <!-- <input onkeyup="if(/\D/.test(this.value)){alert('只能输入数字');this.value='';}">测试<br/>  -->
		    <input type="button" value="开始" onclick='test();'></input>
		    <!-- <input type="button" value='abc' onclick="test()"></input> -->
            <!-- <input type="submit" value="开始"></input>  -->
		</form>  
 </body>
</html>
