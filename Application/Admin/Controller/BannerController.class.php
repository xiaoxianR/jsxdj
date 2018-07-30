<?php
namespace Admin\Controller;
use Think\Controller;

/**
* banner切换控制器
*/
class BannerController extends Controller
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
    $infoSql="SELECT * FROM basic WHERE type=4 AND state=1";
    $infoList=$model->query($infoSql);

    $this->assign("infoList",$infoList);

    $editInfoId=$_GET['infoid'];//获取要修改的信息id



    if (isset($editInfoId)) {   //传入id
      $editInfoSql="SELECT * FROM basic WHERE id=".$editInfoId." and state=1";
      $editInfoList=$model->query($editInfoSql);
      $this->assign("editInfo",$editInfoList[0]);

    }



    $this->display();
  }


  public function update(){

    $model=M();

    $updateId=$_GET['updateid'];
    $title=$_POST['title'];
    $introduction=$_POST['introduction'];  //获取修改的信息

    $updateSql="UPDATE basic SET title='".$title."', introduction='".$introduction."' WHERE id=".$updateId;
    //echo $updateSql;

    $model->execute($updateSql);

    $this->redirect('index');

  }

  public function add(){

    $model=M();


    $title=$_POST['title'];
    $introduction=$_POST['introduction'];

    $addSql="INSERT INTO basic(title,introduction,type) values ('".$title."','".$introduction."',4)";
    //echo $updateSql;

    $model->execute($addSql);

    $this->redirect('index');

  }

  public function delete(){
    $model=M();

    $deleteId=$_GET['deleteid'];

    //删除：将state设为0
    $deleteSql="UPDATE basic SET state=0 where id=".$deleteId;
    $model->execute($deleteSql);

    $this->redirect('index');

  }





}

?>