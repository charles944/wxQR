<?php
/*检查cookie中的password变量是否不等于true，是的话表示尚未登录网站，就重定向到denglu.html页面*/
$id = $_COOKIE["id"];
$password = $_COOKIE["password"];
if ($password != "TRUE") {
    header("location:denglu.html");
    exit();
}else{
    require("./MysqlData.php");
    $u_id = $_POST['id'];
    $name = $_POST['edit_name'];
    $u_password = $_POST['edit_password'];
    $sex = $_POST['sex'];
    $age = $_POST['edit_age'];
    $email = $_POST['edit_email'];
    //创建对象，连接数据库
    $data = new MysqlData;

    //执行更新sql语句
    $sql = "UPDATE users SET name = '".$name."',password = '".$u_password."',sex = ".$sex.",age = ".$age.",email = '".$email."' WHERE id = ".$u_id.";";
    $res = $data->sqlRun($sql);
    $data->closeConn();
    header("Location:main.php");
}

