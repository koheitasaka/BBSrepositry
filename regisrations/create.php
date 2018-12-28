<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>掲示板</title>
<meta name="description">
</head>
</body>
<?php if(session_id() != $_POST['token']): ?>
	<a href="new.php">アカウント登録へ戻る</a>	
	<?php exit("正規の画面からご利用ください"); ?>
<?php endif; ?>
<?php
$name = $_POST['name'];
$password = $_POST['password'];
try {
  $dbh = new PDO('mysql:host=localhost;dbname=test','bbsdbuser2','pwd');
} catch (PDOException $e) {
  var_dump($e->getMessage());
  echo "error！";
  exit;
}
$stmt = $dbh->prepare("insert into users (name,password) values (:name,:password)");
$stmt->bindParam(":name",$name);
$stmt->bindParam(":password",$password);
$stmt->execute();
//データベース接続を切断
$dbh = null;

// 登録完了
echo "登録完了！";

print '<a href="../sessions/new.php">ログイン画面へ</a>';

?>
</body>
</html>
