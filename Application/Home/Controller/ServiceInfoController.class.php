<?php
namespace Home\Controller;
use Think\Controller;

/**
*服务详情页控制器
*/
class ServiceInfoController extends Controller
{

  public function index()
  {

    $model=M();

    /****************广告图片*************************/
		$adSql="SELECT js_ad.*,picture.path FROM js_ad JOIN picture ON js_ad.picture_id=picture.id   WHERE  state=1 AND type=3 ORDER BY pub_time ASC,id ASC limit 0,1";
		$ad=$model->query($adSql);
		$this->assign("ad",$ad[0]);

    $this->display();
  }
}





?>