<?php
/*检查cookie中的password变量是否不等于true，是的话表示尚未登录网站，就重定向到denglu.html页面*/
$id = $_COOKIE["id"];
$password = $_COOKIE["password"];
if ($password != "TRUE") {
    header("location:denglu.html");
    exit();
}
else{
    require("./MysqlData.php");
    $id = $_COOKIE["id"];
    //连接数据库
    $data = new MysqlData;

    //执行sql查询我的资料
    $sql = "SELECT *  FROM users WHERE id = ".$id.";";
    $row = $data->getRow($sql);
    //关闭数据库
    $data->closeConn();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <script type="text/javascript">
        //检查姓名
        function checkName(){
            var inputNode = document.getElementById("edit_name");
            var spanNode = document.getElementById("user_name");
            var nameLength = document.getElementById("edit_name").value.length;
            //获取输入框的内容
            var content = inputNode.value;
            // 检测名字是否只包含字母跟空格
            var reg = /^[a-zA-Z ]*$/;
            if(content==""){
                spanNode.innerHTML = "不能为空".fontcolor("red");
                return false;
            }
            if (nameLength > 15) {
                spanNode.innerHTML = "姓名长度过长".fontcolor("red");
                return false;
            }
            if (reg.test(content)){
                spanNode.innerHTML = "正确".fontcolor("green");
                return true;
            }else{
                spanNode.innerHTML = "只允许字母跟空格".fontcolor("red");
                return false;
            }
        }
        //检查密码
        function checkPassword(){
            var password = document.getElementById("edit_password");
            var passwordLength = document.getElementById("edit_password").value.length;
            var content = password.value;
            var spanNode = document.getElementById("user_password");
            if (passwordLength > 30) {
                spanNode.innerHTML = "密码过长".fontcolor("red");
                return false;
            }
            if (content != "") {
                spanNode.innerHTML = "已填".fontcolor("green");
                return true;
            }else{
                spanNode.innerHTML = "密码不能为空".fontcolor("red");
                return false;
            }
        }
        //检查再次输入的密码
        function checkUpassword(){
            var password = document.getElementById("edit_password").value;
            var upassword = document.getElementById("upassword").value;
            var spanNode = document.getElementById("uupassword");
            if (upassword != password) {
                spanNode.innerHTML = "密码不一致".fontcolor("red");
                return false;
            }
            if (upassword != "") {
                spanNode.innerHTML = "已填".fontcolor("green");
                return true;
            }else{
                spanNode.innerHTML = "请再次输入密码".fontcolor("red");
                return false;
            }

        }
        //检查性别
        function checkSex(){
            // var inputNode = document.getElementById("add_sex");
            var spanNode = document.getElementById("user_sex");
            // var content = inputNode.value;
            //检查不能为空
            if (!document.getElementById("man").checked && !document.getElementById("women").checked) {
                spanNode.innerHTML = "必填".fontcolor("red");
                return false;
            }else{
                spanNode.innerHTML = "已填".fontcolor("green");
                return true;
            }
        }
        //检查年龄
        function checkAge(){
            var age = document.getElementById("edit_age").value;
            var spanNode = document.getElementById("user_age");
            //检查年龄是否在1-120内
            var reg = /^(?:[1-9][0-9]?|1[01][0-9]|120)$/;
            if (reg.test(age)) {
                spanNode.innerHTML = "已填".fontcolor("green");
                return true;
            }else{
                spanNode.innerHTML = "年龄不合法".fontcolor("red");
                return false;
            }
        }
        //检查邮箱
        function checkEmail(){
            var email = document.getElementById("edit_email").value;
            var spanNode = document.getElementById("user_email");
            //验证邮箱的正则
            var reg = /^[a-z0-9]\w+@[a-z0-9]+(\.[a-z]{2,3}){1,2}$/i;
            if(email==""){
                spanNode.innerHTML = "不能为空".fontcolor("red");
                return false;
            }
            if (reg.test(email)){
                spanNode.innerHTML = "正确".fontcolor("green");
                return true;
            }else{
                spanNode.innerHTML = "邮箱格式不正确".fontcolor("red");
                return false;
            }
        }
        //提交form表单时进行检查
        function checkForm(){
            var add_name = checkName();
            var add_sex = checkSex();
            var add_age = checkAge();
            var add_email = checkEmail();
            var add_password = checkPassword();
            var upassword = checkUpassword();
            if (add_name && add_sex && add_age && add_email && add_password && upassword) {
                return true;
            }else{
                return false;
            }
        }
    </script>
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
    .update{
        margin:20px auto;
    }
    .update labal{
        text-align: center;
        background-color: 	#FFB6C1;
        color: #fff;
        margin:20px auto;
    }

    .btn {
        background-color: #008CBA;;
        border-radius:8px;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
    }
    .error {
        color: #FF0000;
    }
</style>
<body>
<div class="wrapper">
    <h2>用户管理系统</h2>
    <div class="update">
        <labal>修改我的资料</labal>
    </div>
    <div>
        <form method="post" action="update.php" align="center" onsubmit="return checkForm()">
            ID:&nbsp&nbsp&nbsp<input type="text" name="id" value="<?php echo $row['id'] ?>" readonly="readonly"><br><br>

            <labal>用户名:</labal><input type="text" id="edit_name" name="edit_name" value="<?php echo $row['name'] ?>"><span id="user_name" class="error">*</span><br><br>

            <labal>密码:</labal>&nbsp&nbsp&nbsp&nbsp<input type="password" name="edit_password" id="edit_password" placeholder="请设置密码">
            <span id="user_password" class="error">*</span><br><br>

            <labal>确认密码:</labal><input type="password" name="upassword" id="upassword" placeholder="请再次输入密码">
            <span id="uupassword" class="error">*</span><br><br>

            <labal>性别:</labal><input type="radio" id="man" name="sex" value="0"
                <?php if(isset($row['sex']) && $row['sex']=="0") echo "checked";?>>男
            <input type="radio" id="women" name="sex" value="1"
                <?php if(isset($row['sex']) && $row['sex']=="1") echo "checked";?>>女<span id="user_sex" class="error">*</span><br><br>

            <labal>年龄:</labal><input type="text" id="edit_age" name="edit_age" value="<?php echo $row['age'] ?>"><span id="user_age"></span><br><br>

            <labal>邮箱:</labal><input type="text" id="edit_email" name="edit_email" value="<?php echo $row['email'] ?>"><span id="user_email" class="error">*</span><br><br>

            <input class="btn" type="submit" name="submit" value="确认修改">
        </form>
</body>
</html>
