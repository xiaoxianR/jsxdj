<?php
namespace Admin\Controller;
use Think\Controller;
class Index1Controller extends Controller {
    public function index(){
        //$this->show("后台管理");
        $this->display();
    }

    public function add(){

       $htmlData = '';
      if (!empty($_POST['content1'])) {
        if (get_magic_quotes_gpc()) {
           $htmlData = stripslashes($_POST['content1']);
           //dump($htmlData);
        }
        else {
          $htmlData = $_POST['content1'];
          //dump($htmlData);
         }
        }
        dump($htmlData);
        $this->assign("htmlData",$htmlData);
        $this->display();

    }
}