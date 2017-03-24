<?php
$host     = 'localhost';
$username = 'root';   // MySQLのユーザ名
$password = 'root';   // MySQLのパスワード
$dbname   = 'Product_infomaion';   // MySQLのDB名
session_start();

// MySQL用のDNS文字列
$dns = 'mysql:dbname='.$dbname.';host='.$host;

$img_dir    = './img/';   // アップロードした画像ファイルの保存ディレクトリ
$data       = [];
$err_msg    = [];         // エラーメッセージ
$new_img_filename = '';   // アップロードした新しい画像ファイル名


// アップロードした新しい画像ファイル名の登録、既存の画像ファイル名の取得
try {
  // データベースに接続
  $dbh = new PDO($dns, $username, $password);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
  throw $e;
}

// アップロード画像ファイルの保存
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // HTTP POST でファイルがアップロードされたかどうかチェック
  if (is_uploaded_file($_FILES['img']['name']) === TRUE) {
    // 画像の拡張子を取得
    $extension = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
    // 指定の拡張子であるかどうかチェック
    if ($extension === 'jpg' || $extension === 'jpeg') {
      // 保存する新しいファイル名の生成（ユニークな値を設定する）
      $new_img_filename = sha1(uniqid(mt_rand(), true)). '.' . $extension;
      // 同名ファイルが存在するかどうかチェック
      if (is_file($img_dir . $new_img_filename) !== TRUE) {
        // アップロードされたファイルを指定ディレクトリに移動して保存
        if (move_uploaded_file($_FILES['new_img']['tmp_name'], $img_dir . $new_img_filename) !== TRUE) {
            $err_msg[] = 'ファイルアップロードに失敗しました';
        }
      } else {
        $err_msg[] = 'ファイルアップロードに失敗しました。再度お試しください。';
      }
    } else {
      $err_msg[] = 'ファイル形式が異なります。画像ファイルはJPEG又はPNGのみ利用可能です。';
    }
  } else {
    $err_msg[] = 'ファイルを選択してください';
  }
  $name =$_POST['name'];
  $price =$_POST['price'];
  $stock =$_POST['stock'];
  $category_id =$_POST['category_id'];

  // アップロードした新しい画像ファイル名の登録、既存の画像ファイル名の取得

  try {
    // SQL文を作成
    $sql = 'INSERT INTO product (name,price,category_id,stock,img) VALUES(?,?,?,?,?)';
    // SQL文を実行する準備
    $stmt = $dbh->prepare($sql);
    // SQL文のプレースホルダに値をバインド
    //(1, $new_img_filename,    PDO::PARAM_STR);
     // SQLを実行
    $stmt->execute(array($name,$price,$category_id,$stock,$new_img_filename));
  } catch (PDOException $e) {
    throw $e;
  }
}



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
  <title>画像アップロード</title>
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
<h1>商品管理画面</h1>
<div>

  <h2>新規商品の追加</h2>
  <form method="post" enctype="multipart/form-data">
    <div><label>名前: <input type="text" name="name" value=""></label></div>
    <div><label>値段: <input type="text" name="price" value=""></label></div>
    <div><label>個数: <input type="text" name="stock" value=""></label></div>
    <div><label><select name="category_id" id="category_id">
      <option value="1">フラワーギフト</option>
      <option value="2">お菓子ギフト</option>
      <option value="3">キッチン用品</option>
      <option value="4">ファッション</option>
      <option value="5">美容・コスメ</option>
      <option value="6">旅行</option>
      <option value="7">暮らしに役立つ</option>
    </lavel></div>
        <h3>画像アップロード</h3>
</lavel></div>
  <h3>画像アップロード</h3>
  <form method="post" enctype="multipart/form-data">
    <div><input type="file" name="new_img"></div>
    <div><input type="submit" value="アップロード"></div>
  </form>
  <table>
  <tr>

    <h2>商品情報変更</h2>
    <p>商品一覧</p>
    <table>
      <tr>
        <th>商品画像</th>
        <th>商品名</th>
        <th>価格</th>
        <th>在庫数</th>
      </tr>
    <?php foreach ($data as $values)  { ?>
      <tr>
        <td><img src="<?php print $img_dir . $values['img']; ?>"></td>
        <td><?php echo htmlspecialchars($values['name'], ENT_QUOTES, 'UTF-8');?></td>
        <td><?php echo htmlspecialchars($values['price'], ENT_QUOTES, 'UTF-8');?></td>
        <form method="post"><input type="hidden" name="id" value="<?php echo $values['id']; ?>">
        <td><input type="text" name="number" value="<?php echo $values['stock']; ?>">個 <input type="submit" name="change" value="変更"></td>
        </form>
      <tr>

<?php } ?>
  </table>
</body>
</html>
<?php
$process_kind = "";
$result_msg = "";

if ( isset($_POST['process_kind']) ) {
  $process_kind = $_POST['process_kind'];
}

// 送られてきた非表示データに応じて処理を振り分けます。
if ($process_kind === 'insert_item') {
  $result_msg = '商品を追加しました';
} else if ($process_kind === 'update_stock') {
  $result_msg = '在庫数を更新しました';
} else if ($process_kind === 'change_status') {
  $result_msg = 'ステータスを更新しました';
}

?>
