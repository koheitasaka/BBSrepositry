<!DOCTYPE html>
<html>
<head>
	<title>掲示板</title>
	<meta charset="utf-8">
</head>
<body>
	<?php 
	try {
  	$dbh = new PDO('mysql:host=localhost;dbname=test','bbsdbuser2','pwd');
	} catch (PDOException $e) {
  	var_dump($e->getMessage());
  	echo "Error！";
  	exit;
	}
	$stmt = $dbh->prepare("select * from threads");
	$stmt->execute();
	$threads=$stmt->fetchAll(PDO::FETCH_ASSOC);
 	?>
	<h1>スレッド一覧</h1>
	<?php foreach ($threads as $thread):?> 
      <form method="get" action="thread.php">
    		<?php
          $title = $thread['title'];
          $id = $thread['id'];?>
    		<input type="hidden" name="id" value="<?php echo $id; ?>">
    		<input type="submit" name="title" value="<?php echo $title; ?>">
  			<?php echo "<br>"; ?>
      </form>
  <?php endforeach; ?>
	<p><a href="new.php">スレッドを作成する</a></p>
  <a href="../sessions/logout.php">ログアウト</a>
  </form>
</body>
</html>
    
  