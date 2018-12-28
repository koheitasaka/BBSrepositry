<?php 
session_start();
try {
  $dbh = new PDO('mysql:host=localhost;dbname=test','bbsdbuser2','pwd');
} catch (PDOException $e) {
  var_dump($e->getMessage());
  echo "error！";
  exit;
}
$threadid = $_GET['thread'];
$stmt = $dbh->prepare("select * from threads where id=:id");
$stmt->bindParam(":id",$threadid);
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
<?php echo "スレッドを作成したユーザーのみがスレッドを削除できます";?>
<a href="thread.php?id=<?php echo $rec['id']; ?>&title=<?php echo $rec['title']; ?>">スレッドへ戻る</a> 
<?php else:?>
<?php
$stmt = $dbh->prepare("delete from comments where thread=:thread"); 	
$stmt->bindParam(":thread",$threadid);
$stmt->execute();
$stmt = $dbh->prepare("delete from threads where id=:id");
$stmt->bindParam(":id",$threadid);
$stmt->execute();
echo "完了！"; 
?>
<?php endif;?>
</body>
</html>
 