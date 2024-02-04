<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>ありがとうございました</title>
</head>
<body>

<?php
		session_start();
		if($_SESSION['tok'] != $_POST	['tok']){
			echo '<h1>ページ遷移が正しくありません</h1>';
		}else{
			echo '<h1>ありがとうございました</h1>';
			echo $_SESSION['tok'];
			echo "<br>";
			echo $_POST['tok'];
			// 最終的に、セッションを破壊する
			session_destroy();
		}

?>
</body>
</html>