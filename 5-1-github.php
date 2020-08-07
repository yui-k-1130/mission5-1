<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission5-1</title>
    
    <h1>mission5-1</h1>
    
    ここでは<br>
    ・コメントの新規投稿<br>
    ・コメントの削除<br>
    ・コメントの編集<br>
    ができます。<br>
    名前とコメント、パスワードを入力して投稿してください。<br>
    何かあれば教えてくださいますようお願いします！<br>
    <br>
</head>
<body>
    〇投稿フォーム<br>
    <form action="" method="post">
        <input type="text" name="name" placeholder="名前" >
        <input type="text" name="comment" placeholder="コメント" >
        <input type="password" name="pass" placeholder="パスワード">
        <input type="submit" name="submit"><br>
    </form>
    〇削除フォーム<br>
    <form action="" method="post">
        <input type="num" name="delete_id" placeholder="削除番号" >
        <input type="password" name="delete_pass" placeholder="パスワード">
        <input type="submit" name="submit" value="削除"><br>
    </form>
    〇編集フォーム<br>
    <form action="" method="post">
        <input type="num" name="edit_id" placeholder="編集番号" >
        <input type="password" name="edit_pass" placeholder="パスワード">
        <input type="submit" name="submit" value="編集"><br>
    </form>
    
    
<?php
    //DB接続設定
    $dsn = 'データベース名';
    $user = 'ユーザー名';
    $password = 'パスワード';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    
    //テーブル作成
    $sql = "CREATE TABLE IF NOT EXISTS mission5_1_11"
	." ("
	. "id INT AUTO_INCREMENT PRIMARY KEY,"
	. "name char(32),"
	. "comment TEXT,"
	. "pass char(20)" 
	.");";
	$stmt = $pdo->query($sql);
	
	if(!empty($_POST["name"]) && ($_POST["comment"]) && ($_POST["pass"])){
	//データを入力
	    $sql = $pdo -> prepare("INSERT INTO mission5_1_11 (name, comment, pass) VALUES (:name, :comment, :pass)");
	    //投稿フォーム
	    $sql -> bindParam(':name', $name, PDO::PARAM_STR);
	    $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
	    $sql -> bindParam(':pass', $pass, PDO::PARAM_STR);
	
    	//POST送信されたデータをここで受け取る
	    $name = $_POST["name"];
	    $comment = $_POST["comment"];
	    $pass = $_POST["pass"];
	    $sql -> execute();
	}
	
	    
	   
	
	//削除機能
	if(!empty($_POST["delete_id"]) && ($_POST["delete_pass"])){
	    
    	//POST送信されたデータをここで受け取る
	    $delete_id = $_POST["delete_id"];
	    $delete_pass = $_POST["delete_pass"];
	  
	    $sql = 'delete from mission5_1_11 where id=:id AND pass=:delete_pass';
	    $stmt = $pdo->prepare($sql); 
	    $stmt->bindParam(':id', $delete_id, PDO::PARAM_INT);
        $stmt->bindParam(':delete_pass', $delete_pass, PDO::PARAM_STR);
	    $stmt->execute();
	    
	}
	
	//編集機能
	if(!empty($_POST["edit_id"]) &&($_POST["edit_pass"])){
	    
	    //POST送信されたデータをここで受け取る
	    $edit_id = $_POST["edit_id"];
	    $edit_pass = $_POST["edit_pass"];
	}
?>
    <form action="" method="post">
        <input type="hidden" name="edit2_id" 
        value="<?php if(!empty($edit_id)){
        //DB接続設定
            $dsn = 'データベース名';
            $user = 'ユーザー名';
            $password = 'パスワード';
            $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            
            $id = $edit_id;
            $pass = $edit_pass;
            $sql = 'SELECT * FROM mission5_1_11 WHERE id=:id AND pass=:pass';
            $stmt = $pdo->prepare($sql);                  // ←差し替えるパラメータを含めて記述したSQLを準備し、
            $stmt->bindParam(':id', $id, PDO::PARAM_INT); // ←その差し替えるパラメータの値を指定してから、
            $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
            $stmt->execute();                             // ←SQLを実行する。
            $results = $stmt->fetchAll(); 
            foreach ($results as $row){
		        echo $row['id'];
        	}
        }?>">
        <input type="text" name="edit_name" placeholder="名前"
        value="<?php if(!empty($edit_id)){
            //DB接続設定
            $dsn = 'データベース名';
            $user = 'ユーザー名';
            $password = 'パスワード';
            $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            
            $id = $edit_id;
            $pass = $edit_pass;
            $sql = 'SELECT * FROM mission5_1_11 WHERE id=:id AND pass=:pass';
            $stmt = $pdo->prepare($sql);                  // ←差し替えるパラメータを含めて記述したSQLを準備し、
            $stmt->bindParam(':id', $id, PDO::PARAM_INT); // ←その差し替えるパラメータの値を指定してから、
            $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
            $stmt->execute();                             // ←SQLを実行する。
            $results = $stmt->fetchAll(); 
            foreach ($results as $row){
		        echo $row['name'];
        	}
        }?>">
        <input type="text" name="edit_comment" placeholder="コメント"
         value="<?php if(!empty($edit_id)){
            //DB接続設定
            $dsn = 'データベース名';
            $user = 'ユーザー名';
            $password = 'パスワード';
            $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            
            $id = $edit_id;
            $pass = $edit_pass;
            $sql = 'SELECT * FROM mission5_1_11 WHERE id=:id AND pass=:pass';
            $stmt = $pdo->prepare($sql);                  // ←差し替えるパラメータを含めて記述したSQLを準備し、
            $stmt->bindParam(':id', $id, PDO::PARAM_INT); // ←その差し替えるパラメータの値を指定してから、
            $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
            $stmt->execute();                             // ←SQLを実行する。
            $results = $stmt->fetchAll(); 
            foreach ($results as $row){
                echo $row['comment'];
	        }
	    }?>">
	    <input type="hidden" name="edit2_pass"
         value="<?php if(!empty($edit_id)){
            //DB接続設定
            $dsn = 'データベース名';
            $user = 'ユーザー名';
            $password = 'パスワード';
            $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            
            $id = $edit_id;
            $pass = $edit_pass;
            $sql = 'SELECT * FROM mission5_1_11 WHERE id=:id AND pass=:pass';
            $stmt = $pdo->prepare($sql);                  // ←差し替えるパラメータを含めて記述したSQLを準備し、
            $stmt->bindParam(':id', $id, PDO::PARAM_INT); // ←その差し替えるパラメータの値を指定してから、
            $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
            $stmt->execute();                             // ←SQLを実行する。
            $results = $stmt->fetchAll(); 
            foreach ($results as $row){
                echo $row['pass'];
	        }
	    }?>">
        <input type="submit" name="submit" value="編集実行"><br>
    </form>
    

<?php
    //DB接続設定
    $dsn = 'データベース名';
    $user = 'ユーザー名';
    $password = 'パスワード';
    $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    
    
	    if(!empty($_POST["edit2_id"]) && ($_POST["edit_name"]) && ($_POST["edit_comment"])){
	        
	        //POST送信されたデータを受け取る
	        $edit2_id = $_POST["edit2_id"];
	        $edit_name = $_POST["edit_name"];
	        $edit_comment = $_POST["edit_comment"];
	        $edit2_pass = $_POST["edit2_pass"];
	        
	        
	        $id = $edit2_id; //変更する投稿番号
    	    $name = $edit_name;
    	    $comment = $edit_comment; 
            $sql = 'UPDATE mission5_1_11 SET name=:name,comment=:comment WHERE id=:id AND pass=:edit2_pass';
            $stmt = $pdo->prepare($sql);
	        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
	        $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
	        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
	        $stmt->bindParam(':edit2_pass', $edit2_pass, PDO::PARAM_STR);
	        $stmt->execute();
	        
	    }
	    
	
	    
	    //データを抽出し、表示する
    	$sql = 'SELECT * FROM mission5_1_11';
	    $stmt = $pdo->query($sql);
	    $results = $stmt->fetchAll();
	    foreach ($results as $row){
	    	//$rowの中にはテーブルのカラム名が入る
	    	echo $row['id'].',';
	    	echo $row['name'].',';
	    	echo $row['comment'].'<br>';
        	echo "<hr>";
	    }

	 
?>
 

 
</body>
</html>