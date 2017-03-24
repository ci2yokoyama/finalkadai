<?php
  require_once 'common.php';
  $pdo = connect();



  $st = $pdo->query("SELECT * FROM goods");
  $goods = $st->fetchAll();
  print_r($goods);
