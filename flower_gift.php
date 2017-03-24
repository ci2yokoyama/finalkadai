<?php
$host     = 'localhost';
$username = 'root';   // MySQLのユーザ名
$password = 'root';   // MySQLのパスワード
$dbname   = 'camp';   // MySQLのDB名
// MySQL用のDNS文字列
$dns = 'mysql:dbname='.$dbname.';host='.$host;

$img_dir    = './img/';   // アップロードした画像ファイルの保存ディレクトリ
$data       = [];
$buyData    = [];
$err_msg    = [];         // エラーメッセージ
$new_img_filename = '';   // アップロードした新しい画像ファイル名

// データベース読み込み
// データベースの二つのテーブルの情報を結合して読み込み
try {
  // データベースに接続
  $dbh = new PDO($dns, $username, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  // SQL文を作成
  //内部結合
  $sql = 'SELECT *  FROM drink_master
          INNER JOIN drink_stock
          ON drink_master.drink_id = drink_stock.drink_id
          WHERE status=1';
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
  $err_msg['db_connect'] = 'DBエラー：'.$e->getMessage();
}
//購入ボタンが押されたら

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>購入ページ</title>
</head>
<body>
<h1>自動販売機</h1>
<form method="post" action="result.php">
金額<input type="text" name="money"><br>
<input type="submit" name="buy" value="購入"><br>
<table>
<tr>
<?php foreach ($data as $values)  { ?>
<td>
<img src="<?php print $img_dir . $values['img']; ?>"><br>
<?php echo $values['drink_name']; ?><br>
<?php echo $values['price']; ?><br>
<?php if ($values['stock'] == '0') {
        echo '売り切れです';
      } else {
?>
<input type="radio" name="drink_id" value="<?php echo $values['drink_id']; ?>">
<?php }?>
<?php }?>
</td>
</tr>
</table>
</form>
</body>
</html>
