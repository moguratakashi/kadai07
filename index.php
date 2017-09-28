<?php
//2. DBに接続
try {
  $pdo = new PDO('mysql:dbname=gs_db16;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}

//3．SQLを作成して実行
$stmt = $pdo->prepare("SELECT * FROM gs_kadai07 ORDER BY id ASC");
$status = $stmt->execute();

//4．エラーの処理
$view = "";
if($status==false){
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);

}else{
  while($r = $stmt->fetch(PDO::FETCH_ASSOC)){
    if($r["name"] == null){
    $r["name"] = "名無しさん";
  }
    $view .= '<p class="toukou" style="background-color:#fff; padding:10px;">'. '<span style="color:#000080;">'.$r["name"]."</span>"."　".'<span style="color:#A9A9A9; font-size:14px;">'.$r["indate"]."</span>"."<br>".$r["comment"]."</p>";
  }
}
?>

    <!DOCTYPE html>
    <html lang="ja">

    <head>
        <meta charset="UTF-8">
        <title>掲示板</title>
        <link rel="stylesheet" href="css/style.css">
        <script src="js/jquery-2.1.3.min.js"></script>
    </head>

    <body>
        <div id="wrap">
            <h1>掲示板</h1>
            <div>
                <?=$view ?>
            </div>
            <form method="post" action="insert.php">
                <p id="fname"><input type="text" name="name" placeholder="名前（省略化）"></p>
                <p id="fcomment"><textarea name="comment" placeholder="コメント内容"></textarea></p>
                <p id="fsubmit"><input type="submit" name="send" id="send" value="投稿する"></p>
            </form>
        </div>

        <script>
            $(function() {
                $("#send").on("click", function() {
                    alert("投稿しました");
                });
            });

        </script>
    </body>

    </html>
