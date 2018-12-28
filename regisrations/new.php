<?php 
session_start();
 ?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>Security</title>
<meta name="description">
</head>
</body>

<p>アカウント作成</p>

<form action="create.php" method="post">
	<input type="hidden" name="token" value="<?php session_id(); ?>">
	<p>名前：<input type="text" name="name"></p>
	<p>パスワード：<input type="password" name="password"></p>
	<p><input type="submit" value="登録"></p>
</form>

</body>
</html>
