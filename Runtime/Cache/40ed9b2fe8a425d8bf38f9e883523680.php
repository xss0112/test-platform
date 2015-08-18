<?php if (!defined('THINK_PATH')) exit();?>
<html>
 <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
   <title>Select Data</title>
   <script language="JavaScript">  
window.history.forward(1);  
window.focus();
</script>
 
</head>
 <body>
 	<?php  $pagenumber = $this->get('page_number'); $processed=$this->get('processed'); $total = $this->get('end')-$this->get('start')+1; ?>
 	<script language="javascript">
		function a() {
	        form1.action='<?php echo U('Index/check',array('page'=>1,'processed'=>$processed));?>';
	        form1.submit();
		}

		function b() {
	  	  	form1.action='<?php echo U('Index/check',array('page'=>$pagenumber-1,'processed'=>$processed));?>';
	   	 	form1.submit();
		}

		function c() {
	  	  	form1.action='<?php echo U('Index/check',array('page'=>$pagenumber+1,'processed'=>$processed));?>';
	   	 	form1.submit();
		}
		function d() {
	  	  	form1.action='<?php echo U('Index/check',array('processed'=>$processed+1));?>';
	   	 	form1.submit();
	   	 }
	   	 function e() {
	   	 	if (<?php echo ($processed); ?>>0) 
	   	 		{
	   	 			form1.action='<?php echo U('Index/check',array('processed'=>$processed-1));?>';
	   	 	        form1.submit();
	   	 		};
	   	 }
	</script>
    <?php $tt=1; $t=1; ?>
    <div style="background-color:#66CCFF;">
    	<p align="left"><font size="8" color="FFFFFF">美团数据关联平台</font></p>
    </div>
    <a href='<?php echo U('Index/index');?>' align="right"><font size="4" color="blue">重新选择范围</font></a>
    <div> 处理<?php echo ($start); ?>至<?php echo ($end); ?>范围内共<?php echo ($total); ?>条竞对POI，已处理<?php echo ($processed); ?>条</div>
    <br><br>
    <div style="width=1080px;margin-left:auto;margin-right:auto;">
		<center>
			<form   method="post" id="form1" >
			<input type='hidden' value=<?php echo ($start); ?>  name="start_id"></input>
			<input type='hidden' value=<?php echo ($end); ?>  name="end_id"></input>
			<table border="1" style="border:1px solid #fff;width:1200px;word-break:break-all; word-wrap:break-word;"  >
				<tr>
					
						<td><font size="4"><b>序号</b></font></td>
						<td><font size="4"><b>城市编号</b></font></td>
						<td><font size="4"><b>POI编号</b></font></td>
						<td><font size="4"><b>POI名称</b></font></td>
						<td><font size="4"><b>地址</b></font></td>
						<td><font size="4"><b>电话</b></font></td>
						<td><font size="4"><b>纬度</b></font></td>
						<td><font size="4"><b>经度</b></font></td>
				</tr>
				<?php if(is_array($list_site)): foreach($list_site as $key=>$vo): ?><input type='hidden' value=<?php echo ($vo["cluster_id"]); ?>  name="cluster_id"></input>
					<tr>

						    <?php if($vo["site_id"] == 1): ?><td><font size="3">携程</font>&nbsp;</td><?php endif; ?>
							<?php if($vo["site_id"] == 2): ?><td><font size="3">同程</font>&nbsp;</td><?php endif; ?>
					    	<?php if($vo["site_id"] == 3): ?><td><font size="3">去哪儿</font>&nbsp;</td><?php endif; ?>
							<?php if($vo["site_id"] == 4): ?><td><font size="3">去啊</font>&nbsp;</td><?php endif; ?>
							<!-- <td><font size="3"></font>&nbsp;</td> -->
							<!-- <td><font size="3"><?php echo ($vo["site_id"]); ?></font>&nbsp;</td> -->
							<td><font size="3"><?php echo ($vo["city_id"]); ?></font>&nbsp;</td>
							<td><font size="3"><?php echo ($vo["poi_id"]); ?></font>&nbsp;</td>
							<td><font size="3"><?php echo ($vo["poi_name"]); ?></font>&nbsp;</td>
							<td><font size="3"><?php echo ($vo["address"]); ?></font>&nbsp;</td>
							<td><font size="3"><?php echo ($vo["phone"]); ?></font>&nbsp;</td>
							<td><font size="3"><?php echo ($vo["latitude"]); ?></font>&nbsp;</td>
							<td><font size="3"><?php echo ($vo["longitude"]); ?></font>&nbsp;</td>
					</tr><?php endforeach; endif; ?>
				<tr>
					<!-- <td><font size="3"></font>&nbsp;</td> -->
				    <td colspan=9 bgcolor="#ACD6FF"><font size="3"></font>&nbsp;</td>
				</tr>
				<?php if(is_array($list_mt)): foreach($list_mt as $key=>$vo): ?><tr>
						<?php $t = $pagenumber*10+$tt-10; $tt++;?>
					<input type='hidden' value=<?php echo ($vo["poi_id"]); ?>  name="items[]"></input>
							<td><font size="3">
								<?php if($vo["mark"] != 0): ?><input name="status[]"  type="checkbox" value=<?php echo ($vo["poi_id"]); ?> checked="checked"> <?php echo ($t); ?>
									<?php else: ?> <input name="status[]" type="checkbox" value=<?php echo ($vo["poi_id"]); ?>> <?php echo ($t); endif; ?>
								</input></font>&nbsp;
							</td>
							<td><font size="3"><?php echo ($vo["city_id"]); ?></font>&nbsp;</td>
							<td><font size="3"><?php echo ($vo["poi_id"]); ?></font>&nbsp;</td>
							<td><font size="3"><?php echo ($vo["poi_name"]); ?></font>&nbsp;</td> 
							<td><font size="3"><?php echo ($vo["address"]); ?></font>&nbsp;</td>
							<td><font size="3"><?php echo ($vo["phone"]); ?></font>&nbsp;</td>
							<td><font size="3"><?php echo ($vo["latitude"]); ?></font>&nbsp;</td>
							<td><font size="3"><?php echo ($vo["longitude"]); ?></font>&nbsp;</td>
					</tr><?php endforeach; endif; ?>

			</table>
			<font size="2">
				
				<div align='center'>搜索结果共有<?php echo ($total_page); ?>页,当前第<?php echo ($pagenumber); ?>页<br>
					<input type="submit" value=" 首页 " onclick="a();"  style="HEIGHT: 20px"/>
					<input type="submit" value=" 上一页 " onclick="b();"  style="HEIGHT: 20px"/>
					<input type="submit" value=" 下一页 " onclick="c();"  style="HEIGHT: 20px"/>
					<!-- <input type="button" value=" test_next " onclick="test();"  style="HEIGHT: 20px"/> -->
					 <?php ?>
					 <br><br><br><br><br><br>
				</div>
				<div>
					<input type="submit" value=" 返回上一条 " onclick="e();" style="background-color:#66CCFF;left:500px"/>
					 <input type="submit" value=" 处理下一条 " onclick="d();" style="background-color:#66CCFF;left:500px"/>
					 
					<!--<a href='<?php echo U('Index/index',array('page'=>1,'list'=>$list));?>' onclick='a()' >首页</a>&nbsp;
					<a href='<?php echo U('Index/index',array('page'=>$pagenumber-1,'list'=>$list));?>' onclick='b()'>上一页</a>
					&nbsp;第<?php echo ($pagenumber); ?>页&nbsp;
					<a href='<?php echo U('Index/index',array('page'=>$pagenumber+1,'list'=>$list) );?>' onclick='c()'>下一页</a>-->
				</div>
			</font>
		</form>
		<?php ?>
		</center>
	</div>
 </body>
</html>