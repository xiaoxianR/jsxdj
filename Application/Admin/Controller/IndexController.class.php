<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        //$this->show("后台管理");
        //$this->display('index1/index');
/*
        $validator=$_GET['validator'];
        $this->assign("validator",$validator);
*/
        $this->display();
    }

    /**
     * 登录验证
     * @return
     */
    public function login(){

      $model=M();

      //获取输入的用户名、密码
      $name=$_POST['name'];
      $pwd=$_POST['pwd'];

      //echo $name;

      //验证信息
      $validatorSql="SELECT COUNT(*) AS count,id FROM manager where name='".$name."' AND pwd='".$pwd."'";
      $recordList=$model->query($validatorSql);
      $record=$recordList[0]['count'];
      //dump($recordList);

      if ($record > 0) {  //该用户存在
        session("admin",$name);
        session("adminid",$recordList[0]['id']);
        //查询管理员权限
        $purviewSql="SELECT * FROM purview WHERE purview.manager_id=".$recordList[0]['id'];
        $purviewList=$model->query($purviewSql);
        $purview=$purviewList[0];

        session("purview",$purview);




        //$this->display('index/show');
        $this->redirect('show');
      }
      else{
        //$this->assign("validator","error");
        //$this->display('index/index');

        $this->redirect('index');
      }

      //$this->show("ddjkh");

    }

    /**
     * 进入后台首页
     * @return
     */
    public function show(){
      //$this->show("登录成功！");
      //

      //查询登录管理员，未登录进入登录页面
      $admin=session("admin");
      if (!isset($admin)) {
        $this->redirect('index');
      }



      $model=M();

      /********查询最新留言信息**********************/
      $messageSql="SELECT * FROM message WHERE state=1 ORDER BY pub_time DESC,id DESC LIMIT 7";
      $messageList=$model->query($messageSql);

      $this->assign("messageList",$messageList);


      /********查询最新公告********************************/
      $noticeSql="SELECT * FROM notice WHERE state=1 ORDER BY pub_time,id DESC";
      $noticeList=$model->query($noticeSql);

      $this->assign("noticeList",$noticeList);






      $this->display();

    }


    /**
     * 退出登录
     * @return
     */
    public function loginout(){
      session("admin",null);


      $this->redirect('index');

    }


}