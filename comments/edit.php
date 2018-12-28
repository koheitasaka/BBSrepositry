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
	<?php if ($_SESSION['user_id'] != $rec['user']) :?>
 	<?php echo "コメントを作成したユーザーのみがコメントを編集できます";?>
 	<a href="../threads/thread.php?id=<?php echo $_SESSION['thread_id']; ?>&title=<?php echo $_SESSION['thread_title']; ?>">スレッドへ戻る</a>
 	<?php else:?>
 	<form action="editdone.php" method="post">
		コメント:<input type="textarea" name="contents" value="<?php echo $rec['contents']; ?>">
		<input type="hidden" name="commentid" value="<?php echo $contents; ?>">
		<input type="submit" value="完了">
	</form>
<?php endif; ?>
</body>
</html>