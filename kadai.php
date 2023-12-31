<?php
    session_start();
    $mode = 'input';
    if( isset($_POST['back']) && $_POST['back'] ){
        // 何もしない
    } else if( isset($_POST['confirm']) && $_POST['confirm']){
        $_SESSION['name']    = $_POST['name'];
        $_SESSION['email']   = $_POST['email'];
        $_SESSION['message'] = $_POST['message'];
        $mode = 'confirm';
    } else if( isset($_POST['send']) && $_POST['send'] ){
        // 送信ボタンを押したとき
        $message  = "お問い合わせを受け付けました \r\n"
                  . "名前: " . $_SESSION['name'] . "\r\n"
                  . "email: " . $_SESSION['email'] . "\r\n"
                  . "お問い合わせ内容:\r\n"
                  . preg_replace("/\r\n|\r|\n/", "\r\n", $_SESSION['message']);
          mail($_SESSION['email'],'お問い合わせありがとうございます',$message);
        mail('dlfhfl63@gmail.com','お問い合わせありがとうございます',$message);
        $_SESSION = array();
        $mode = 'send';
      } else {
        $_SESSION['name'] = "";
        $_SESSION['email']    = "";
        $_SESSION['message']  = "";
      }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>お問い合わせフォーム</title>
</head>
<body>
<?php if( $mode == 'input' ){ ?> 
    <!--入力画面-->
    <form action="./kadai.php" method="post">
            お名前: <input type="text" name="name" value="<?php echo $_SESSION['name'] ?> ">
            E-mail: <input type="email" name="email" value="<?php echo $_SESSION['email'] ?> "> <br>
            お問い合わせ内容 <br>
            <textarea cols="40" rows="8" name="message"><?php echo $_SESSION['message'] ?></textarea> <br>
            <input type="submit" name="confirm" value="確認">
    </form>
    <?php } else if( $mode == 'confirm' ) { ?>
        <!-- 確認画面 -->
    <form action="./kadai.php" method="post">
        名前:    <?php echo $_SESSION['name'] ?> <br>
        E-mail: <?php echo $_SESSION['email'] ?> <br>
        お問い合わせ内容 <br>
        <?php echo nl2br($_SESSION['message']) ?> <br>
        <input type="submit" name="back" value="戻る" />
        <input type="submit" name="send" value="送信" />
    </form>
    <?php } else { ?>
        <!-- 完了画面 -->
        送信しました。お問い合わせありがとうございました。<br>
    <?php } ?>
</body>
</html> 