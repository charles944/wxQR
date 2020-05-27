<?php

    //连接数据库
    $db_servername="localhost";
    $db_username="root";
    $db_passwrod="1994526succeeD!";
    $db_database="wx_QR";
    $db_link=new mysqli($db_servername,$db_username,$db_passwrod,$db_database);

    if ($db_link->connect_error) {
        die("连接失败: " . $db_link->connect_error);
    }

    //开始查询账号和密码是否相符
    $db_sql_checkLogin=sprintf("select * from account where 'username'=%s and 'password'=%s",$_POST['username'],$_POST['password']);
    if($db_link->query($db_sql_checkLogin))
    {
        echo "登陆成功";
    }
    else{
        echo "账号或密码错误";
    }