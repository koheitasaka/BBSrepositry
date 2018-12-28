<?php 
session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
	<title>掲示板</title>
	<meta charset="utf-8">
</head>
<body>
	<form action="create.php" method="post">
		<p>タイトル：<input type="textarea" name="title"></p>
		<p><input type="hidden" name="user" value="<?php echo $_SESSION['user_id']; ?>"></p>
		<p><input type="submit" value="作成"></p>
	</form>
</body>
</html>