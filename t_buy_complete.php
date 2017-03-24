<?php
session_start();

$_SESSION['CART'] = null;

var_dump($_POST);
var_dump($_SESSION);

 ?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>購入完了 | 母の日特集</title>
<link rel="stylesheet" href="shop.css">
</head>
<body>
<div class="base">
  購入完了しました。
</div>
<div class="base">
  <a href="saisyuukadai.php">お買い物に戻る</a>　
</div>
</body>
</html>
