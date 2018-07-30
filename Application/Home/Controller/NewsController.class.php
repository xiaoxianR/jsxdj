<?php
namespace Home\Controller;
use Think\Controller;
/**
 * 新闻控制器
 */
class NewsController extends Controller {
    public function index(){

      $model=M();
      $newsId=$_GET['newsid'];
      /**************新闻信息*************************/
      $newsSql="SELECT js_news.* FROM js_news  WHERE id=".$newsId." AND state=1 LIMIT 1";
      $newsList=$model->query($newsSql);
      $this->assign("news",$newsList[0]);

      $this->display();
    }
}