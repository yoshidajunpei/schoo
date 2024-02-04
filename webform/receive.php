<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>データ確認</title>
</head>
<body>

<h1>データ確認画面</h1>

<!-- 文字の入力チェック ①データ受け取り処理　②文字数チェック　③年齢正規表現チェック-->
<?php  
 //エラー変数初期化
 //エラーを格納する為の変数
 $err = '';


 //XSS対策・受信データをエスケープ
 if($_SERVER['REQUEST_METHOD']=='POST'){
 $myname = htmlspecialchars($_POST['myname'], ENT_QUOTES,'UTF-8');
 $age = (int)$_POST['age'];

  //mynameが入力されていたら
  if($myname){
		
		//文字数チェック
		if(strlen($myname) > 30){
			$err = 'ユーザー名が長いです';}
		}else{
			//mynameが空だったら
			$err = '名前の入力がありません';
		}
	 //正規表現チェック
	if(preg_match('/^[0-9]+$/', $age)){
		if($age >200){
			$err = '正しい年齢を入力してください';
	  }
	 }else{
		$err = '年齢は半角数字で入力して下さい';
	 }

	 //エラーがある場合にエラー画面を表示させる
	 if($err){ 
		//エラーがある場合のエラーフォームを出力
		
		echo '<form action="receive.php" method="post">';
		echo '名前：<input type="text" name="myname"  value="'.$myname.'" placeholder="名前を入力して下さい"><br>';
		echo '年齢：<input type="number" name="age" value="'.$age.'"><br>';
		echo '色：<input type="color" name="colar"><br>';
		echo '<input type="submit" value="データを送信">';
		echo '</form>';

    
	 }else{

			//SESSIONにデータを格納
			session_start();
			$_SESSION['myname'] = $myname;
			$_SESSION['age'] = $age;
	
			//Tokenでデータ生成
				//疑似乱数を生成
			$bytes = openssl_random_pseudo_bytes(16);
				//16進数に変換
			$token = bin2hex($bytes);
			echo $token;
				//セッションにセット
			$_SESSION['tok'] = $token;
			
		
		?>
		<!-- 確認画面へ -->
		<h1>確認画面</h1>
		名前：<?php echo $myname ?><br>
    <form action='tnk.php' method='post'>
		<input type='hidden' name='tok' value="<?php print $token; ?>">
		<input type ="submit" value="データ送信">
	  </form>

		<?php

	 }

	}else{
		$err = '正常にデータを受信できませんでした';
		$myname = '';
		$age = '';
	}

?>

名前:<? echo $myname; ?>
<br>
年齢:<? echo $age; ?> 
<br>
エラー:<? echo $err; ?>  

</body>
</html>