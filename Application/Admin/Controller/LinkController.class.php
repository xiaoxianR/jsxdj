<?php
namespace Admin\Controller;
use Think\Controller;

/**
* 友情链接控制器
*/
class LinkController extends Controller
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
    $infoSql="SELECT * FROM link WHERE  state=1";
    $infoList=$model->query($infoSql);

    $this->assign("infoList",$infoList);

    $editInfoId=$_GET['infoid'];//获取要修改的信息id



    if (isset($editInfoId)) {   //传入id
      $editInfoSql="SELECT * FROM link WHERE id=".$editInfoId." AND state=1";
      $editInfoList=$model->query($editInfoSql);
      $this->assign("editInfo",$editInfoList[0]);

    }



    $this->display();
  }


  public function update(){

    $model=M();

    $updateId=$_GET['updateid'];

    $web_name=$_POST['web_name'];
    $web_url=$_POST['web_url'];  //获取修改的信息
    $introduction=$_POST['introduction'];

    $updateSql="UPDATE link SET web_name='".$web_name."', web_url='".$web_url."',introduction='".$introduction."' WHERE id=".$updateId;
    //echo $updateSql;

    $model->execute($updateSql);

    $this->redirect('index');

  }

  public function add(){

    $model=M();

   $web_name=$_POST['web_name'];
    $web_url=$_POST['web_url'];  //获取修改的信息
    $introduction=$_POST['introduction'];




    $addSql="INSERT INTO link(web_name,web_url,introduction) values ('".$web_name."','".$web_url."','".$introduction."')";
    //echo $updateSql;

    $model->execute($addSql);

    $this->redirect('index');

  }

  public function delete(){
    $model=M();

    $deleteId=$_GET['deleteid'];

    //删除：将state设为0
    $deleteSql="UPDATE link SET state=0 where id=".$deleteId;
    $model->execute($deleteSql);

    $this->redirect('index');

  }





}

?>