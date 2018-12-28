<?php  
session_start();
try {
  $dbh = new PDO('mysql:host=localhost;dbname=test','bbsdbuser2','pwd');
} catch (PDOException $e) {
  var_dump($e->getMessage());
  echo "error！";
  exit;
}
$thread = $_POST['threadid'];
$title = htmlspecialchars($_POST['title']);
if($title == false){
	echo "error!";
}
$stmt = $dbh->prepare("update threads set title=:title where id=:id");
$stmt->bindParam(":id",$thread);
$stmt->bindParam(":title",$title);
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
	<?php 
	$stmt = $dbh->prepare("select * from threads where id=:id");
	$stmt->bindParam(":id",$thread);
	$stmt->execute();
	$threads = $stmt->fetch(PDO::FETCH_ASSOC);s
	 ?>
	<a href="thread.php?id=<?php echo $threads['id']; ?>&title=<?php echo$threads['title']; ?>">スレッドへ戻る</a>
</body>
</html>