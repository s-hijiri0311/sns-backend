<?php
// データベースに接続するために必要なデータソースを変数に格納
  // mysql:host=ホスト名;dbname=データベース名;charset=文字エンコード
$dsn = 'mysql:host=localhost;dbname=test;charset=utf8';

  // データベースのユーザー名
$user = 'localhost';

  // データベースのパスワード
$password = '';

// tryにPDOの処理を記述
try {

  // PDOインスタンスを生成
  $dbh = new PDO($dsn, $user, $password);


// SELECT文を変数に格納
$sql = 'SELECT name FROM user WHERE id='.'"'.$_GET['user_id'].'"';

// SQLステートメントを実行し、結果を変数に格納
$stmt = $dbh->query($sql);
$result = $stmt->fetch(PDO::FETCH_ASSOC);


// Databaseから参照に変更
$match = "SELECT pass FROM user WHERE name =".'"'.$result['name'].'"';
$stmt_3 = $dbh->query($match);
$result_3 = $stmt_3->fetch(PDO::FETCH_ASSOC);



if($result_3['pass'] == $_GET['pass']){
//ユーザid検索結果格納

$sql2 = 'update location set time=cast(now() as datetime),location=GeomFromText("POINT('.$_GET['x_coordinate'].' '.$_GET['y_coordinate'].')",4326) where id='.$_GET['user_id'];
$stmt2 = $dbh->query($sql2);

echo 'success';
}




// エラー（例外）が発生した時の処理を記述
} catch (PDOException $e) {

  // エラーメッセージを表示させる
  echo 'データベースにアクセスできません！' . $e->getMessage();

  // 強制終了
  exit;

}
