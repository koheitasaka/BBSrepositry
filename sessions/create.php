<?php
// sessions/new.phpから受け取る
$name = $_POST['name'];
$password = $_POST['password'];
var_dump($name);
var_dump($password);

// データベースに接続
try {
  $dbh = new PDO('mysql:host=localhost;dbname=test','bbsdbuser2','pwd');
} catch (PDOException $e) {
  var_dump($e->getMessage());
  exit;
}
$stmt = $dbh->prepare("select * from users where name = :name and password = :password");
$stmt->bindParam(":name",$name);
$stmt->bindParam(":password",$password);
$stmt->execute();
$rec = $stmt->fetch(PDO::FETCH_ASSOC);
var_dump($rec);
// データベースから切断
$dbh = null;

// $recが存在する場合、session開始し、index.phpにロケート
if($rec == false) {
  echo "メールアドレスまたはパスワードが間違っています。";
} else {
	session_start();
	$_SESSION['login'] = 1;
	$_SESSION['user_id'] = $rec['id'];
	header('Location: ../threads/list.php');
}
