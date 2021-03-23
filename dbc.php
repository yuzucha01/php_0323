<?php

//DBから全データ取得
//PDO::query (エスケープされない)

function dbc()
{
    $host = "localhost";
    $dbname = "gs_db";
    $user = "root";
    $pass = "root";

    $dns = "mysql:host=$host;dbname=$dbname;charset=utf8";
    try{
    $pdo = new PDO($dns,$user, $pass,
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
    return $pdo;
    }catch(PDOException $e){
        exit($e->getMessage());
    }
}


// ファイルデータを保存
// @param string $filename ファイル名
// @param string $save_path 保存先のパス
// @param string $name 料理名
// @param string $zairyo 材料
// @param string $recipe レシピ
// @return bool $result


function fileSave($filename, $save_path, $name, $zairyo, $recipe){
    $result = False;
   //file_tableに保存
    $sql = "INSERT INTO file_table(file_name, file_path, name, zairyo, recipe)
    VALUE(?, ?, ?, ?, ?)";
try {
//prepareで準備
$stmt = dbc()->prepare($sql);
$stmt->bindValue(1, $filename);
$stmt->bindValue(2, $save_path);
$stmt->bindValue(3, $name);
$stmt->bindValue(4, $zairyo);
$stmt->bindValue(5, $recipe);
//実行
$result = $stmt->execute();
return $result;
}catch(Exception $e){
//エラーページに飛ばす
echo $e->getMessage();
return $result;
}
}

// ファイルデータを取得
// @return array $fileData

function getAllFile(){
    $sql = "SELECT * FROM file_table ORDER BY id DESC LIMIT 0,10";

    $fileData =  dbc()->query($sql);
    return $fileData;
}