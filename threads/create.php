<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>掲示板</title>
<meta name="description">
</head>
</body>
<?php
date_default_timezone_set('Asia/Tokyo');
$date = date("Y/m/d H:i:s");
$title = htmlspecialchars($_POST['title']);
$user = $_POST['user'];
try {
  $dbh = new PDO('mysql:host=localhost;dbname=test','bbsdbuser2','pwd');
} catch (PDOException $e) {
  var_dump($e->getMessage());
  echo "error！";
  exit;
}
$stmt = $dbh->prepare("insert into threads (day,title,creater) values (:day,:title,:creater)");
$stmt->bindParam(":day",$date);
$stmt->bindParam(":title",$title);
$stmt->bindParam(":creater",$user);
$stmt->execute();

$dbh = null;

echo "完了";
print '<a href="list.php">スレッド一覧へ</a>';
?>
</body>
</html>