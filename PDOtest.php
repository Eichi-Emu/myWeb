<?php
function db_connection(){
        //db接続
        try{
            $dbh = new PDO(
            'mysql:dbname=kakaku;host=localhost;charset=utf8mb4',
            'user',
            'xX114514');
            return $dbh;
        } catch(PDOException $e){
            echo '接続失敗'. $e->getMessage();
            exit();
        };
    }
        ?>