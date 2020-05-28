<?php
require("./MysqlData.php");
/*检查cookie中的password变量是否不等于true，是的话表示尚未登录网站，就重定向到denglu.html页面*/
$id = $_COOKIE["id"];
$password = $_COOKIE["password"];
if ($password != "TRUE") {
    header("location:denglu.html");
    exit();
}
//创建对象
$data = new MysqlData;
$sql = "SELECT * FROM users WHERE id = ".$id.";";
$row = $data->getRow($sql);
// echo $sql;
$data->closeConn();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>登录成功页面</title>
</head>
<style type="text/css">
    .wrapper{

        text-align: center;
        width:1000px;
        margin:20px auto;
    }
    h2{
        background-color:#7CCD7C;
        margin:0px;
        text-align:center;
    }
    .my{
        margin:20px auto;
    }
    .my labal{
        text-align: center;
        background-color: 	#FFB6C1;
        color: #fff;
        margin:20px auto;
    }
</style>
<body>
<div class="wrapper">
    <h2>用户管理系统</h2>
    <div class="my">
        <labal>我的资料</labal>
    </div>
    <labal>用户名:</labal><input type="text" value="<?php echo $row['name'] ?>" readonly="readonly"><br><br>
    <labal>性别:</labal>
    <input type="radio"value="0" <?php if ($row['sex'] == "0") echo "checked"?>>男
    <input type="radio"value="1" <?php if ($row['sex'] == "1") echo "checked"?>>女

    <br><br>
    <labal>年龄:</labal><input type="text" value="<?php echo $row['age'] ?>" readonly="readonly"><br><br>
    <labal>邮箱:</labal><input type="text" value="<?php echo $row['email'] ?>" readonly="readonly"><br><br>
    <a href="modify.php">修改我的资料</a>
</div>

</body>
</html>
