<?php 
session_start();
try {
  $dbh = new PDO('mysql:host=localhost;dbname=test','bbsdbuser2','pwd');
} catch (PDOException $e) {
  var_dump($e->getMessage());
  echo "error！";
  exit;
}
$thread = $_GET['thread'];
// var_dump($thread);
$stmt = $dbh->prepare("select * from threads where id=:id");
$stmt->bindParam(":id",$thread);
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
	<?php if ($_SESSION['user_id'] != $rec['creater']):?>
 	<?php echo "スレッドを作成したユーザーのみがスレッドを編集できます"; ?>
 	<a href="thread.php?id=<?php echo $rec['id']; ?>&title=<?php echo $rec['title']; ?>">スレッドへ戻る
 	</a>
 	<?php else:?>
 	<?php 
 	$stmt = $dbh->prepare("select * from threads where id=:id");
 	$stmt->bindParam(":id",$thread);
 	$stmt->execute();
 	$threads = $stmt->fetch(PDO::FETCH_ASSOC);
 	$dbh = null; 
 	?>
	<form action="editdone.php" method="post">
		タイトル:<input type="textarea" name="title" value="<?php echo $threads['title']; ?>">
		<input type="hidden" name="threadid" value="<?php echo $thread; ?>">
		<input type="submit" value="完了">
	</form>
<?php endif; ?>
</body>
</html>


