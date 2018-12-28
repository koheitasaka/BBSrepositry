<!DOCTYPE html>
<html>
<head>
	<title>掲示板</title>
	<meta charset="utf-8">
</head>
<body>
	<?php  
	date_default_timezone_set('Asia/Tokyo');
	$day = date("Y/m/d H:i:s");
	$contents = htmlspecialchars($_POST['comments']);
	$user = $_POST['user'];
	$thread = $_POST['thread'];
	$title = $_POST['title'];
	try{
  	$dbh = new PDO('mysql:host=localhost;dbname=test','bbsdbuser2','pwd');
	} catch (PDOException $e) {
  	var_dump($e->getMessage());
  	echo "error！";
  	exit;
	}
	$stmt = $dbh->prepare("insert into comments (day,contents,user,thread) values (:day,:contents,:user,:thread)");
	$stmt->bindParam(":day",$day);
	$stmt->bindParam(":contents",$contents);
	$stmt->bindParam(":user",$user);
	$stmt->bindParam(":thread",$thread);
	$stmt->execute();

	$dbh = null;

	echo "完了";
	?>
	<a href="../threads/thread.php?id=<?php echo $thread; ?>&title=<?php echo $threads['title']; ?>">スレッドへ戻る</a>
</body>
</html>