<?php
session_start();

include("funcs.php");
loginCheck();

require_once "./dbc.php";
$files = getAllFile();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Recipe</title>
    <link rel="stylesheet" href="css/chat.css">
</head>
<body>
    <header class="leftNavigation">
       <h1>RECIPE CHAT</h1>
       <!-- 複数のものを送る -->
       <form enctype="multipart/form-data" action="chat_upload.php" method="POST">
        <div class="file-up">
            <!-- valueは1MBのサイズの数字 -->
            <input type="hidden" name="MAX_FILE_SIZE" value="1048576">
            <!-- 画像だけ選択するaccept -->
            <input type="file" name="img" accept="image/*">
        </div>
        <div>
            <textarea name="name" id="caption" placeholder="料理名" cols="30" rows="10"></textarea>
            <textarea name="zairyo" id="caption" placeholder="材料" cols="30" rows="10"></textarea>
            <textarea name="recipe" id="caption" placeholder="レシピ" cols="30" rows="10"></textarea>
        </div>
        <div class="submit">
            <input type="submit" value="送信" class="btn">
        </div>
        </form>
        <button type=“button” onclick="location.href='./top-page.php'">Homeに戻る</button>
    </header>
    <div class="content-main">
        <div class="content">
            <?php foreach($files as $file):?>
                <div class="chat-contents">
                    <img src="<?php echo "{$file['file_path']}"; ?>" alt="">
                    <p><?php echo "{$file['name']}"; ?></p>
                    <p><?php echo "{$file['zairyo']}"; ?></p>
                    <p><?php echo "{$file['recipe']}"; ?></p>
                    <p><?php echo "{$file['insert_time']}"; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>