<?php

require_once 'common.php';
$dbh = connect();

var_dump($_POST);
var_dump($_SESSION);



$img_dir    = './img/';   // アップロードした画像ファイルの保存ディレクトリ
$data       = [];
$err_msg    = [];         // エラーメッセージ

// 既存のアップロードされた画像ファイル名の取得
try {
  // SQL文を作成
  $sql = 'SELECT * FROM product';
  // SQL文を実行する準備
  $stmt = $dbh->prepare($sql);
  // SQLを実行
  $stmt->execute();
  // レコードの取得
  $rows = $stmt->fetchAll();
  // 1行ずつ結果を配列で取得
  foreach ($rows as $row) {
    $data[] = $row;
  }
} catch (PDOException $e) {
  throw $e;
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>商品一覧</title>
  <link rel="stylesheet" type="text/css" href="saisyuukadai.css">
  <style>
    table {
      width: 660px;
      border-collapse: collapse;
    }
    table, tr, th, td {
      border: solid 1px;
      padding: 10px;
      text-align: center;
    }
  </style>
</head>
  <body background="nomal_pink.png">
<?php foreach ($err_msg as $value) { ?>
  <p><?php print $value; ?></p>
<?php } ?>

<div align="right"><a href="saisyuukadai.php">
  <h5>TOPへ戻る</h5></a></div>
    <div align="right"><a href="cart.php">
      <h5>カートをみる</h5></a></div>
    <h2>母の日キッチンギフト</h2>
    <table>
      <div class="sample_iblock">
          <ul>
                <li><a href="#1">フラワーギフト</a></li>
                <li><a href="#2">キッチン用品</a></li>
                <li><a href="#3">ファッション・美容</a></li>
                <li><a href="#4">お菓子ギフト</a></li>
                <li><a href="#5">旅行</a></li>
                <li><a href="#6">暮らしに役立つ</a></li>
                <li><a href="#7">手作りレシピ</a></li>
                <li><a href="#8">パーティグッズ</a></li>
                <li><a href="#9">おすすめ</a></li>
          </ul>
      </div>

    <?php foreach ($data as $values)

     {
       ?>

      <tr>
	<div class="blocka">
    <span><?php echo htmlspecialchars($values['name'], ENT_QUOTES, 'UTF-8');?></span>
    <span><img class="top-img" src="<?php print $img_dir . $values['img']; ?>"></span>
    <span><?php echo htmlspecialchars($values['price'], ENT_QUOTES, 'UTF-8');?>円</span>

    <span>数量　<input id="cart-num-3" type="text" value="1" class="text" size="2"></span>
    <span><form method="post" action="cart.php"></span>
    <span><input type="hidden" name="id" value="<?php echo $values['id']; ?>"></span>
    <span><button type="submit"><img src= 'kago.jpg' alt="button"></button></span>
  </form>
  </div>

<?php } ?>
</body>
</html>
