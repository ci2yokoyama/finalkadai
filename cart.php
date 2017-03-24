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
  var_dump($_SESSION);
  foreach($_SESSION['CART'] as $id => $num) {
    $st = $pdo->prepare("SELECT * FROM product WHERE id=?");
    $st->execute(array($id));
    $row = $st->fetch();
    $st->closeCursor();
    $row['num'] = strip_tags($num);
    $sum += $num * $row['price'];
    $rows[] = $row;
  }
  require 't_cart.php';
?>
