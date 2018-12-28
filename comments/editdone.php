<?php  
session_start();
try {
  $dbh = new PDO('mysql:host=localhost;dbname=test','bbsdbuser2','pwd');
} catch (PDOException $e) {
  var_dump($e->getMessage());
  echo "error！";
  exit;
}
$commentid = $_POST['commentid'];
$contents = htmlspecialchars($_POST['contents']);
$stmt = $dbh->prepare("update comments set contents=:contents where id=:id");
$stmt->bindParam(":id",$commentid);
$stmt->bindParam(":contents",$contents);
$stmt->execute();
echo "完了！";


?>
<!DOCTYPE html>
<html>
<head>
	<title>掲示板</title>
	<meta charset="utf-8">
</head>
<body>
	<a href="../threads/thread.php?id=<?php echo $_SESSION['thread_id']; ?>&title=<?php echo $_SESSION['thread_title']; ?>">スレッドへ戻る</a>
</body>
</html>