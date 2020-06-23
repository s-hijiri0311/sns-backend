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
$sql = "SELECT id,user_id,user_name,user_image_url,time,X(location),Y(location) FROM location";
 
// SQLステートメントを実行し、結果を変数に格納
$stmt = $dbh->query($sql);

//talkテーブルのデータ数
$sql2 = 'select count(*) from location';
$stmt2 = $dbh->query($sql2);
$result = $stmt2->fetch(PDO::FETCH_ASSOC);


$match = "SELECT pass FROM user WHERE name =".'"'.$_GET['name'].'"';
$stmt_3 = $dbh->query($match);
$result_3 = $stmt_3->fetch(PDO::FETCH_ASSOC);

if($result_3['pass'] == $_GET['pass']){

// foreach文で配列の中身を一行ずつ出力


echo '[';

foreach ($stmt as $row){

echo '{';
echo '"id":'.'"'.$row['id'].'",';
echo '"user_id":"'.$row['user_id'].'",';
echo '"user_name":"'.$row['user_name'].'",';
echo '"user_image_url":"'.$row['user_image_url'].'",';
echo '"time":"'.$row['time'].'",';
echo '"x_coordinate":"'.$row['X(location)'].'",';
echo '"y_coordinate":"'.$row['Y(location)'].'"';

if($row['id']==$result["count(*)"]){
echo '}';
}
else{
echo '},';
}
}


echo ']';

}




// エラー（例外）が発生した時の処理を記述
} catch (PDOException $e) {
 
  // エラーメッセージを表示させる
  echo 'データベースにアクセスできません！' . $e->getMessage();
 
  // 強制終了
  exit;
 
}
