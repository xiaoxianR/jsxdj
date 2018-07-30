<?php
namespace Home\Controller;
use Think\Controller;
/**
 * 搜索控制器
 */
class SearchController extends Controller {
    public function index(){

      $model=M();


      $this->display();
    }
}