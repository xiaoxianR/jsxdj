<?php
return array(
	//'配置项'=>'配置值'


        //数据库配置信息
        'DB_TYPE'   => 'mysql', // 数据库类型
        'DB_HOST'   => 'localhost', // 服务器地址
        'DB_NAME'   => 'sl', // 数据库名
        'DB_USER'   => 'root', // 用户名
        'DB_PWD'    => '123456', // 密码
        'DB_PORT'   => 3306, // 端口
        'DB_PREFIX' => '', // 数据库表前缀

        //'TMPL_FILE_DEPR' =>'_',//设置模板位置
        'URL_CASE_INSENSITIVE' =>true ,//URL不区分大小写，两个单词的加下划线

        //上传图片路径
        'PICTURE_PATH'=>'/Public/upload/',
        'TAG_NESTED_LEVEL' =>5,

);