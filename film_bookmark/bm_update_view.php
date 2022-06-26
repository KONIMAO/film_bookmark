<?php

$id = $_GET["id"];

include("funcs.php");
$pdo = db_conn();

$stmt   = $pdo->prepare("SELECT * FROM gs_bm_table where id=:id"); //SQLをセット
$stmt->bindValue(':id',   $id,    PDO::PARAM_INT);
$status = $stmt->execute(); //SQLを実行→エラーの場合falseを$statusに代入

// データ表示
$view=""; //HTML文字列作り、入れる変数
if($status==false) {
  //SQLエラーの場合
  sql_error($stmt);
}else{
  //SQL成功の場合
  $row = $stmt->fetch(); // 指定した１つのデータを取り出して $row に格納
}


?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ更新</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/sample.css">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php">データ一覧</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="bm_update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>好きな映画の備忘録</legend>
     <label>映画のタイトル：<input type="text" name="title" value="<?=$row["title"]?>"></label><br>
     <label>URL(IMDb)：<input type="text" name="url" value="<?=$row["url"]?>"></label><br>
     <label>コメント：<textArea name="comment" rows="4" cols="40"><?=$row["comment"]?></textArea></label><br>
     <label>評価：
     <div class="evaluation">
          <input id="star1" type="radio" name="rate" value="⭐️⭐️⭐️⭐️⭐️" />
          <label for="star1"><span class="text">最高</span>★</label>
          <input id="star2" type="radio" name="rate" value="⭐️⭐️⭐️⭐️" />
          <label for="star2"><span class="text">良い</span>★</label>
          <input id="star3" type="radio" name="rate" value="⭐️⭐️⭐️" />
          <label for="star3"><span class="text">普通</span>★</label>
          <input id="star4" type="radio" name="rate" value="⭐️⭐️" />
          <label for="star4"><span class="text">悪い</span>★</label>
          <input id="star5" type="radio" name="rate" value="⭐️" />
          <label for="star5"><span class="text">最悪</span>★</label>
        </div>
      </lable>
     <!-- idを隠して送信 -->
     <input type="hidden" name="id" value="<?=$row["id"]?>">
     <!-- idを隠して送信 -->
     <input type="submit" value="更新">    </fieldset>
  </div>
</form>

<a href="select.php"><button>保存しないで戻る</button></a>

<!-- Main[End] -->


</body>
</html>