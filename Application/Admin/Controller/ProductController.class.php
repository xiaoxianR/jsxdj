<?php
namespace Admin\Controller;
use Think\Controller;

/**
* 产品控制器
*/
class ProductController extends Controller
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
    $infoSql="SELECT product.*,product_type.name AS typename,product_type.id AS typeid FROM product JOIN product_type ON product.type_id=product_type.id   WHERE  product.state=1 ORDER BY product.pub_time DESC,product.id DESC ";
    $infoList=$model->query($infoSql);

    $this->assign("infoList",$infoList);



    /***************查询产品类型********************/
    $typeSql="SELECT * FROM product_type where state=1";
    $typeList=$model->query($typeSql);

    $this->assign("typeList",$typeList);





    $editInfoId=$_GET['infoid'];//获取要修改的信息id

    if (isset($editInfoId)) {   //传入id
      $editInfoSql="SELECT product.*,product_type.name AS typename,product_type.id AS typeid FROM product JOIN product_type ON product.type_id=product_type.id WHERE product.id=".$editInfoId." AND product.state=1";
      $editInfoList=$model->query($editInfoSql);
      $this->assign("editInfo",$editInfoList[0]);

    }



    $this->display();
  }


  public function update(){

    $model=M();

    $updateId=$_GET['updateid'];

    $title=$_POST['title'];  //获取修改的信息
    $key_words=$_POST['key_words'];
    $introduction=$_POST['introduction'];
    $type=$_POST['type']; //1/2
    $time=date('Y-m-d');

   $updateSql="UPDATE product SET title='".$title."', introduction='".$introduction."',type_id=".$type.",pub_time='".$time."',key_words='".$key_words."' WHERE id=".$updateId;

    //echo $updateSql;

    $model->execute($updateSql);

    $this->redirect('index');

  }

  public function add(){

    $model=M();


    $title=$_POST['title'];  //获取修改的信息
    $key_words=$_POST['key_words'];
    $introduction=$_POST['introduction'];
    $type=$_POST['type']; //1/2
    $time=date('Y-m-d');



    $addSql="INSERT INTO product(title,introduction,type_id,pub_time,key_words) values ('".$title."','".$introduction."',".$type.",'".$time."','".$key_words."')";
    //echo $updateSql;

    $model->execute($addSql);

    $this->redirect('index');

  }

  public function delete(){
    $model=M();

    $deleteId=$_GET['deleteid'];

    //删除：将state设为0
    $deleteSql="UPDATE product SET state=0 where id=".$deleteId;
    $model->execute($deleteSql);

    $this->redirect('index');

  }





}

?>