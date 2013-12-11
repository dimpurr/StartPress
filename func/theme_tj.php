<?php

// 请填写以下设置，首次访问即安装·
// 访问地址为 .../theme_tj.php?[验证名]=[密码] ，例如 theme_tj.php?pass=1

$sql_host = ""; // 数据库地址
$sql_name = ""; // 数据库表名
$sql_user = ""; // 数据库用户
$sql_pass = ""; // 数据库密码
$ttj_name = ""; // 验证名
$ttj_pass = ""; // 密码

// 链接数据库
$con = mysql_connect($sql_host,$sql_user,$sql_pass);

if ( !mysql_select_db($sql_name, $con) ) {

// 创建表
$sql = "CREATE TABLE" . $sql_name . "(
	blog_id int(11) AUTO_INCREMENT,
	blog_url text,
	theme_name text,
	set_date timestamp CURRENT_TIMESTAMP
)";
mysql_query($sql,$con);

} else if (!empty($_GET[blog_url])) {

// 插入值

$sql = "INSERT INTO theme_tj (blog_url, theme_name)
VALUES
('$_GET[blog_url]','$_GET[theme_name]')";
mysql_query($sql,$con);

} else {

// 列出值
$result = mysql_query("SELECT * FROM theme_tj");
if ( $_GET[$ttj_name]) == $ttj_pass ) { 
	while($row = mysql_fetch_array($result)) {
  		echo $row['theme_name'] . ' <a href="' . $row['blog_url'] . '">' . $row['blog_url'] . '</a> ' . $row['set_date'];
  		echo "<br />";
	};
};

mysql_close($con);

?>