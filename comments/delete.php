<?php 
session_start();
try {
  $dbh = new PDO('mysql:host=localhost;dbname=test','bbsdbuser2','pwd');
} catch (PDOException $e) {
  var_dump($e->getMessage());
  echo "error！";
  exit;
}
$commentid = $_GET['contents'];
$stmt = $dbh->prepare("select * from comments where id=:id");
$stmt->bindParam(":id",$commentid);
$stmt->execute();
$rec = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
	<title>掲示板</title>
	<meta charset="utf-8">
</head>
<body>
	<?php if ($_SESSION['user_id'] != $rec['user']):?>
 	<?php echo "コメントを作成したユーザーのみがコメントを削除できます";?>
 	<a href="../threads/thread.php?id=<?php echo $_SESSION['thread_id']; ?>&title=<?php echo $_SESSION['thread_title']; ?>">スレッドへ戻る</a>
 <?php else:?>
 <?php
	$stmt = $dbh->prepare("delete from comments where id=:id");
	$stmt->bindParam(":id",$commentid);
	$stmt->execute();
	echo "完了！";
 ?>
<?php endif;?>
</body>
</html>
 