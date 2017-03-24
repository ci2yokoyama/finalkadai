<?php
  require 'common.php';
  $rows = array();
  $sum = 0;
  $pdo = connect();

  var_dump($_POST);
  var_dump($_SESSION);
  

    // POST処理
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // カート追加
  if(isset($_POST['change'])) {
      // カート追加処理
      $item_id = $_POST['id'];
       if(isset($_SESSION['CART'][$item_id])) {
         $_SESSION['CART'][$item_id]++;
       } else {
         $_SESSION['CART'][$item_id] = 1;
       }
   }
}

  foreach($_SESSION['CART'] as $id => $num) {
    $st = $pdo->prepare("SELECT * FROM product WHERE id=?");
    $st->execute(array($id));
    $row = $st->fetch();
    $st->closeCursor();
    $row['num'] = strip_tags($num);
    $sum += $num * $row['price'];
    $rows[] = $row;
  }
  require 't_buy.php';
?>

<html lang="ja">
<head>
<meta charset="UTF-8">
<title>購入確認</title>
<link rel="stylesheet" href="saisyuukadai.css">
</head>
<body>
<div><h1>母の日特集</h1></div>
<div>
    <form action="t_buy_complete.php" method="post">
            <input type="hidden" name="furigana" value="<?php echo $name; ?>">
            <input type="hidden" name="email" value="<?php echo $price; ?>">
            <input type="hidden" name="tel" value="<?php echo $num; ?>">
            <input type="hidden" name="sex" value="<?php echo $sbtotal; ?>">

            <h1 class="contact-title">購入内容確認</h1>
            <p>購入内容はこちらで宜しいでしょうか？<br>よろしければ「購入」ボタンを押して下さい。</p>






<?php
  require 'common.php';

  var_dump($_POST);
  var_dump($_SESSION);

  $name = '';
  $price = '';
  $num = '';
  $sbtotal = '';
  $total = '';

      // フォームのボタンが押されたら
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          // フォームから送信されたデータを各変数に格納
          $name = $_POST["name"];
          $price = $_POST["price"];
          $num = $_POST["num"];
          $sbtotal = $_POST["subtotal"];
          $total = $_POST["total"];
}

  ?>
