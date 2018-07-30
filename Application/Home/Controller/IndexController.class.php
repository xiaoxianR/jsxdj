<?php
namespace Home\Controller;
use Think\Controller;
/**
 * 首页控制器
 */
class IndexController extends Controller {
    public function index(){

      $model=M();

      /****************一级类目查询*************************/
      $category1Sql="SELECT js_category1.*,picture.path FROM js_category1 
                      JOIN picture ON js_category1.picture_id=picture.id   
                      WHERE  state=1 ORDER BY pub_time ASC,id ASC";
      $category1List=$model->query($category1Sql);
      $this->assign("category1List",$category1List);
      
      /****************二级类目查询*************************/
      $category2Sql="SELECT js_category2.*,picture.path FROM js_category2 
                      JOIN picture ON js_category2.picture_id=picture.id   
                      WHERE  state=1 AND is_hot=1 ORDER BY pub_time ASC,id ASC";
      $category2List=$model->query($category2Sql);
      $this->assign("category2List",$category2List);

      /****************四个推荐服务*************************/
      $hotServSql="SELECT js_hot_serv.*,picture.path FROM js_hot_serv JOIN picture ON js_hot_serv.picture_id=picture.id   WHERE  state=1 ORDER BY pub_time ASC,id ASC";
      $hotServList=$model->query($hotServSql);
      $this->assign("hotServList",$hotServList);

      /****************首页广告*************************/
      $adSql="SELECT js_ad.*,picture.path FROM js_ad JOIN picture ON js_ad.picture_id=picture.id   WHERE  state=1 AND type=1 ORDER BY pub_time ASC,id ASC limit 0,1";
      $ad=$model->query($adSql);
      $this->assign("ad",$ad[0]);

      /**************新闻列表*************************/
      $newsSql="SELECT js_news.* FROM js_news  WHERE type=2 AND state=1 ORDER BY update_time DESC,id DESC LIMIT 0,3";
      $newsList=$model->query($newsSql);
      $this->assign("newsList",$newsList);

      /****************精选服务*************************/
      $pickServSql="SELECT js_service.*,picture.path FROM js_service 
                      JOIN picture ON js_service.picture_id=picture.id   
                      WHERE  state=1 AND is_pick=1 ORDER BY pub_time DESC,id DESC";
      $pickServList=$model->query($pickServSql);
      $this->assign("pickServList",$pickServList);

      /****************服务列表*************************/
      $pageSize = 2;
      $serviceSql="SELECT js_service.*,picture.path FROM js_service 
                      JOIN picture ON js_service.picture_id=picture.id   
                      WHERE  state=1  ORDER BY pub_time DESC,id DESC LIMIT ".$pageSize;
      $serviceList=$model->query($serviceSql);
      $this->assign("serviceList",$serviceList);

      // 查询服务个数
      $totalSql = "SELECT count(id) AS total FROM js_service WHERE state=1";
      $totalList = $model->query($totalSql);
      $total = $totalList[0]['total'];

      $totalPage = ceil($total / $pageSize);
      $this->assign("pageSize",$pageSize);
      $this->assign("totalPage",$totalPage);

      

      $this->display();
      //$this->show("前台");
    }

    public function getService(){
      $model=M();

      $pageSize = $_GET['pageSize'];
      $pageNum = $_GET['pageNum'];

      $start = ($pageNum - 1) * $pageSize;
      $end = $pageNum * $pageSize -1;

      $serviceSql="SELECT js_service.*,picture.path FROM js_service 
                      JOIN picture ON js_service.picture_id=picture.id   
                      WHERE  state=1  ORDER BY pub_time DESC,id DESC LIMIT ".$start.",".$end;
      $serviceList=$model->query($serviceSql);
      $this->ajaxReturn (json_encode($serviceList),'JSON');
    }
}