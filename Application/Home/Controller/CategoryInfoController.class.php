<?php
namespace Home\Controller;
use Think\Controller;

/**
* 二级分类页面控制器
*/
class CategoryInfoController extends Controller
{

	public function index()
	{

		$model=M();

		/****************广告图片*************************/
		$adSql="SELECT js_ad.*,picture.path FROM js_ad JOIN picture ON js_ad.picture_id=picture.id   WHERE  state=1 AND type=2 ORDER BY pub_time ASC,id ASC limit 0,1";
		$ad=$model->query($adSql);
		$this->assign("ad",$ad[0]);
		/**************家政妙招*************************/
		$housekeepTipSql="SELECT js_news.*,picture.path FROM js_news  JOIN picture ON js_news.picture_id=picture.id  WHERE type=1 AND state=1 ORDER BY update_time DESC,id DESC";
		$housekeepTipList=$model->query($housekeepTipSql);
		$this->assign("housekeepTipList",$housekeepTipList);
		/**************新闻列表*************************/
		$newsSql="SELECT js_news.*,picture.path FROM js_news  JOIN picture ON js_news.picture_id=picture.id  WHERE type=2 AND state=1 ORDER BY update_time DESC,id DESC";
		$newsList=$model->query($newsSql);
		$this->assign("newsList",$newsList);




		$this->display();
	}
}

?>