<?php
namespace Admin\Controller;
use Think\Controller;

/**
* 留言板控制器
*/
class MessageController extends Controller
{

  public function index()
  {

    //查询登录管理员，未登录进入登录页面
      $admin=session("admin");
      if (!isset($admin)) {
        $this->redirect('index/index');
      }

    $model=M();

    /**************查询信息*************************/
    $infoSql="SELECT * FROM message WHERE  state=1 ORDER BY pub_time DESC,id DESC";
    $infoList=$model->query($infoSql);

    $this->assign("infoList",$infoList);

    $editInfoId=$_GET['infoid'];//获取要修改的信息id



    if (isset($editInfoId)) {   //传入id
      $editInfoSql="SELECT * FROM message WHERE id=".$editInfoId." AND state=1";
      $editInfoList=$model->query($editInfoSql);
      $this->assign("editInfo",$editInfoList[0]);

    }



    $this->display();
  }






  public function delete(){
    $model=M();

    $deleteId=$_GET['deleteid'];

    //删除：将state设为0
    $deleteSql="UPDATE message SET state=0 where id=".$deleteId;
    $model->execute($deleteSql);

    $this->redirect('index');

  }





}

?>