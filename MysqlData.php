<?php
define('SQL_SERVERNAME','localhost');
define('SQL_USERNAME','root');
define('SQL_PASSWORD','1994526succeeD!');
define('SQL_DATABASE','wxQR');

$link=new mysqli(SQL_SERVERNAME, SQL_USERNAME, SQL_PASSWORD, SQL_DATABASE);
//常量的值只能是标量，所以不能将mysql的连接对象用常量来表示
//$sql_link=new mysqli('localhost','root','1994526succeeD!','wxQR');

class MysqlData{
//    $sql_link=new mysqli('localhost','root','1994526succeeD!','wxQR');
        //成员变量不能有抽象属性，所以不能将mysql的连接对象用类的成员变量来表示
//    var $sql_link=new mysqli('localhost','root','1994526succeeD!','wxQR');
    public function select_user($username,$password){
        $sql=sprintf( 'select * from login where username=%s and password=%s',$username,$password);
        return $sql;
    }
    public function sqlRun($sql){
        global $link;
        return $link->query($sql);
    }
}