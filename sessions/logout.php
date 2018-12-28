<?php 
session_start();

unset($_SESSION['login']);
unset($_SESSION['user_id']);
echo "ログアウトしました";

 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>掲示板</title>
 </head>
 <body>
 	<a href="new.php">ログイン画面へ</a>
 </body>
 </html>