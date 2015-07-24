<?php
// 本类由系统自动生成，仅供测试用途
class IndexAction extends Action {
    public function index(){
        $table=C('DB_TABLE');
        $db = M($table);
        $site_num = $db->where("site_id!=9999")->count();
        $this->assign('site_num',$site_num);
        $this->display('index');
    }


    public function check(){
    	//show_mt_list();
        //$current_id=$_POST('start_num');
        if(!empty($_POST['start_num'])&&!empty($_POST['end_num']))
        {
            $start_num=$_POST['start_num'];
            $end_num=$_POST['end_num'];
            $processed=0;
        }
        else{
            $start_num=$_POST['start_id'];
            $end_num=$_POST['end_id'];
            $processed=$_GET['processed'];
        }
        $query_start_site=$start_num+$processed;
    	$table=C('DB_TABLE');
        $db = M($table);
        //$listxx = $_GET['list_mt'];
        $page = (int)$_GET['page'];

        //var_dump($page);
        $buf = array();
        //$buf = $_POST['mt_list'];
        //$buf = $_GET['list'];
        //var_dump($_POST);
        if(isset($_POST['items'])&&!empty($_POST['items']))
        {
            $array_items = $_POST['items'];
            $array_status=$_POST['status'];
            $pre_cluster_id = $_POST['cluster_id']; 
        //    var_dump($array_status);
        //    var_dump($array_items);
            foreach ($array_items as $item)
            {
                $mark=0;
                if(in_array($item, $array_status)&&$array_status)
                {
                     $mark=1;

                }
                $condition='site_id=9999 and poi_id='.$item.' and cluster_id= '.$pre_cluster_id;

             //   var_dump($mark);
                $db->where($condition)->setField('mark',$mark); // 根据条件保存修改的数据
            }
        }
        //若page已经是首页，置1
        $page = $page>0?$page:1;
        //若page已经是尾页
        //$site_count = $db->where("site_id=!9999 and cluster_id=8")->count();
    
		$sql_site = "select cluster_id,site_id, city_id, poi_id, poi_name, address, phone, latitude, longitude,mark
                 from ".$table." where site_id!=9999 order by cluster_id asc limit ".$query_start_site.",1;";
        $res_site=$db->query($sql_site); 
        //var_dump($res_site);  
        if(!$res_site) 
        {
            echo '<script>alert("empty result")</script>';
            return;
        }

        $cluster_id=$res_site[0]['cluster_id'];
        $sql_count="site_id=9999 and cluster_id= ".$cluster_id;
        $max = $db->where($sql_count)->count();
        //$max = $db->count();
       //echo $max;
        //$ss = I('checkbox','','htmlspecialchars');
        //$status= array();
        //var_dump($_GET['status']);
        if($max % 10 == 0)
            $n = $max / 10;
        else
            $n = (int)($max / 10) + 1;
        $page = $page>$n?$n:$page;
        $begin = ($page-1)*10;

        $sql_mt = "select site_id, city_id, poi_id, poi_name, address, phone, latitude, longitude, mark
                from ".$table." where site_id=9999 and cluster_id= ".$cluster_id." limit $begin,10;";
        //var_dump($sql_mt);
        $res_mt = $db->query($sql_mt); 
        
       //  dump($page);  
        $this->assign('list_mt',$res_mt);   
        $this->assign('list_site',$res_site);
        $this->assign('page_number',$page);
        $this->assign('total_page',$n);
        $this->assign('start',$start_num);
        $this->assign('end',$end_num);
        $this->assign('processed',$processed);
        if($processed<$end_num-$start_num+1) 
            {
                $this->display('check');
            }
                
        else 
            {
               $handle_total=$end_num-$start_num+1;
                //var_dump($handle_total);
                $sql_statistic_site="select cluster_id from ".$table." where site_id!=9999 
                      order by cluster_id  asc limit ".$start_num.",".$handle_total.";";
                $res_statistic_site = $db->query($sql_statistic_site); 
                //var_dump($sql_statistic_site);
                $count_match=0;
                foreach( $res_statistic_site as $row1)
                {
                   $tmp_cluster_id=$row1['cluster_id'];
                   $sql_statistic_mt="select mark from ".$table." where site_id=9999 and cluster_id=".$tmp_cluster_id.";";
                   $res_statistic_mt = $db->query($sql_statistic_mt);
                   $count_choosed=0;
                   foreach( $res_statistic_mt as $row2)
                   {
                //      var_dump($row2);
                      if($row2['mark']==1) $count_choosed=$count_choosed+1;
                   } 
                   if($count_choosed>0) $count_match=$count_match+1;
                }
                $this->assign('match_count',$count_match);
                $this->display('done');
            }

    }

}
?>
