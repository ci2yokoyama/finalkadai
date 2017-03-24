<?php
session_start();

function connect() {
  global $username,$password;
  $dbh = new PDO('mysql:host=localhost;port=8889;dbname=Product_information','root','root');
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  return $dbh;
}

function img_tag($code){
  if (file_exists("images/$code.jpg")) $name = $code;
  else $name = 'noimage';
  return '<img src="images/' . $name . '.jpg" alt="">';
}
