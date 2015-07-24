<?php if (!defined('THINK_PATH')) exit();?>
<html>
 <head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
   <title>Select Data</title>

 
</head>
 <body>
 	<div>测试完毕，处理从
        <?php  echo $this->get('start'); echo "至"; echo $this->get('end'); echo "共"; echo $this->get('end') -$this->get('start')+1; ?>
         条数据, 匹配<?php echo ($match_count); ?>条</div>
        </div>
    <div>
    <a href='<?php echo U('Index/index');?>'><font size="4" color="blue">重新选择范围</font></a> 
    </div> 
 </body>
</html>