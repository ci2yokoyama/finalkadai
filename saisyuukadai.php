<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>最終課題</title>
    <link rel="stylesheet" type="text/css" href="./saisyuukadai.css">
    <style>
    </style>
</head>
<body background="nomal_pink.png">



  <div align="right"><a href="Login.php">
    <p>ようこそ<u><?php echo htmlspecialchars($_SESSION["NAME"], ENT_QUOTES); ?></u>さん</p>  <!-- ユーザー名をechoで表示 -->
<h5>ログイン</h5>  <li><a href="Logout.php">ログアウト</a></li></a></div>
  <img   = "box_flower.jpg">
  <img = "raburi-usagi.jpg">
  <center><h1>Mather's Day</h1></center>


    <div class="gazo-box" style="float:left; margin: 20px;">
    <h3>フラワーギフト</h3>
    <a href="saisyu_1.php">
    <img class="top-img" src="flower_gift.jpg"></a>
    <figcaption>日頃の感謝の気持ちを。。</figcaption>
    </div>

    <div class="gazo-box" style="float:left; margin: 20px;">
    <h3>キッチン用品</h3>
    <a href="saisyu_2.php">
    <img class="top-img" src="kittin.jpg"></a>
    <figcaption>毎日が楽しくなるおしゃれ商品も。</figcaption>
    </div>

    <div class="gazo-box" style="float:left; margin: 20px;">
    <h3>ファッション</h3>
    <a href="saisyu_3.php">
    <img class="top-img" src="fasshon.jpg"></a>
    <figcaption>ファッション多数揃えました</figcaption>
  </div>

    <div class="gazo-box"  style="float:left; margin: 20px;">
    <h3>美容・コスメ</h3>
    <a href="saisyu_4.php">
    <img class="top-img" src="beauty.jpg"></a>
    <figcaption>ブランド取り揃えました</figcaption>
  </div>

    <div class="gazo-box" style="float:left; margin: 20px;">
    <h3>お菓子ギフト</h3>
    <a href="saisyu_5.php">
    <img class="top-img" src="お菓子１.jpg"></a>
    <figcaption>感謝の気持ちを。。</figcaption>
  </div>

    <div class="gazo-box" style="float:left; margin: 20px;">
    <h3>暮らしに役立つ</h3>
    <a href="saisyu_6.php">
    <img class="top-img" src="kajidaikou.jpg"></a>
    <figcaption>家事代行サービスなど</figcaption>
  </div>

    <div class="gazo-box" style="float:left; margin: 20px;">
    <h3>手作りレシピ・パーティ準備</h3>
    <a href="saisyu_7.php">
    <img class="top-img" src="mama.jpg"></a>
    <figcaption>今年はホームパーティしよう！</figcaption>
  </div>





  </table>
</body>
</html>
