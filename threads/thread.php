<?php 
session_start();
try {
  $dbh = new PDO('mysql:host=localhost;dbname=test','bbsdbuser2','pwd');
} catch (PDOException $e) {
  var_dump($e->getMessage());
  echo "error！";
  exit;
}
$id = $_GET['id'];
$stmt = $dbh->prepare("select * from threads where id = :id");
$stmt->bindParam(":id",$id);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$_SESSION['thread_id'] = $result['id'];
$_SESSION['thread_title'] = $result['title'];

$stmt = $dbh->prepare("select * from comments where thread = :thread");
$stmt->bindParam(":thread",$id);
$stmt->execute();
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?> 
<!DOCTYPE html>
<html>
<head>
	<title>掲示板</title>
	<meta charset="utf-8">
</head>
<body>
	<h1><?php echo $result['title'];?></h1>
	<?php foreach ($comments as $comment): ?>
	<p>
		<?php echo $comment['contents']; ?>
		<form action="../comments/edit.php" method="get">
			<input type="submit" value="[編集]">
			<input type="hidden" name="contents" value="<?php echo $comment['id']; ?>">
		</form>
		<form action="../comments/delete.php" method="get">
			<input type="submit" value="[削除]">
			<input type="hidden" name="contents" value="<?php echo $comment['id']; ?>">
		</form>
	</p>
	<?php endforeach; ?>
	<form action="../comments/create.php" method="post">　
		<p>コメント：<input type="textarea" name="comments"></p>
		<input type="hidden" name="user" value="<?php echo $_SESSION['user_id']; ?>">
		<input type="hidden" name="title" value="<?php echo $_SESSION['thread_title']; ?>">
		<input type="hidden" name="thread" value="<?php echo $_SESSION['thread_id']; ?>">
		<input type="submit" value="送信">
	</form>
	<form action="edit.php" method="get">
		<input type="submit" value="スレッドを編集">
		<input type="hidden" name="thread" value="<?php echo $_SESSION['thread_id']; ?>">	
	</form>
	<form action="delete.php" method="get">
		<input type="submit" value="スレッドを削除">
		<input type="hidden" name="thread" value="<?php echo $_SESSION['thread_id']; ?>">	
	</form>
	<p><a href="list.php">スレッド一覧へ</a></p>
</body>
</html>