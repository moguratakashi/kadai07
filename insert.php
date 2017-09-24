<?php
//1. POSTの受信
$name = $_POST["name"];
$comment = $_POST["comment"];

//2. DB接続のブロック
try {
  $pdo = new PDO('mysql:dbname=gs_db16;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}

//3．SQLを作成して実行
$stmt = $pdo->prepare("INSERT INTO gs_kadai07(id, name, comment, indate )
VALUES(NULL, :name, :comment, sysdate())");
$stmt->bindValue(':name', $name, PDO::PARAM_STR); 
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
$status = $stmt->execute();

//4．エラーの処理
if($status==false){
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
  
}else{
  header("Location: index.php");
  exit;

}
?>
