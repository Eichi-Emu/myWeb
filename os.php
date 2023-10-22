<?php

try {
    $pdo = new PDO(
        'mysql:dbname=kakaku;host=localhost;charset=utf8mb4',
        'user',
        'xX114514',
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );

} catch (PDOException $e) {
    header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e->getMessage()); 
}

try {
    $pdo = new PDO(
        'mysql:dbname=kakaku;host=localhost;charset=utf8mb4',
        'user',
        'xX114514',
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );

} catch (PDOException $e) {

    header('Content-Type: text/plain; charset=UTF-8', true, 500);
    exit($e->getMessage()); 

}

header('Content-Type: text/html; charset=utf-8');

?>
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OS</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.0/js/jquery.tablesorter.min.js"></script>
    <script src ="https://cdn.jsdelivr.net/gh/DeuxHuitHuit/quicksearch/dist/jquery.quicksearch.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.0/css/theme.default.min.css">
    <style>
    #main-table th {
    background-color:deepskyblue;
    }
    #main-table{
      font-size: 1.0em;
    }
  </style>
  <script>  
    $(document).ready(function() {
      $('#main-table').tablesorter();
      });
    jQuery(function ($) {
      $('input#id_search').quicksearch('table tbody tr');
      var filters = {}; // 空のフィルターのオブジェクトを初期化

      // 各メニューの変更イベントを処理する
      $('.form-control').change(function () {
      var filter_id = $(this).attr('id'); // メニューのIDを取得
      var filter_val = $(this).val(); // 選択された値を取得

      // フィルターのオブジェクトに新しいフィルターを追加または更新する
      if (filter_val == "") {
        delete filters[filter_id];
      } else {
        filters[filter_id] = filter_val;
      }

      // 各行をチェックして、表示または非表示を設定する
      $("#main-table tbody tr").each(function (index, element) {
        var row_text = $(element).text();
        var visible = true;

        $.each(filters, function (key, val) {
          if (row_text.indexOf(val) == -1) {
            visible = false;
          }
        });

        if (visible) {
          $(element).css("display", "table-row");
        } else {
          $(element).css("display", "none");
        }
      });
      });
    });
  </script>
</head>
<body>
<div align="center">
        <h1>OSリスト</h1>
    </div>
    <form action="#">
      検索:<input type="text" name="search" value="" id="id_search" />
    </form>
    <br>
    <table align="center" border="1" cellpadding="5" class="order-table" id="main-table">
        <thead>
        <tr>
            <th></th>
            <th class="id">固有ID</th> 
            <th class="maker">メーカー</th>
            <th class="name">製品名</th>
            <th class="price">値段</th>
            
        </tr> 
        </thead> 
        <tbody>
        <h5>青い項目部分をタップorクリックで並べ替えができます。</h5>
        <?php
        function url_param_change($par=Array(),$op=0)
        {
            $url = parse_url($_SERVER["REQUEST_URI"]);
            if(isset($url["query"])) parse_str($url["query"],$query);
            else $query = Array();
            foreach($par as $key => $value){
                if($key && is_null($value)) unset($query[$key]);
                else $query[$key] = $value;
            }
            $query = str_replace("=&", "&", http_build_query($query));
            $query = preg_replace("/=$/", "", $query);
            return $query ? (!$op ? "?" : "").htmlspecialchars($query, ENT_QUOTES) : "";
        }
        function urlCustom($id)
        {
            $return = NULL;
            $do = url_param_change(array("os"=>$id));
            $return = 'location.href=\'index.php'.$do.'\'';
            return $return;
        }
        $a = 0;
        $sql="SELECT * FROM os WHERE name<>'Error'";
        $array = array();
        $stt = $pdo->query($sql);
        
        while($row = $stt->fetch()) {
        echo '<tr>';
            echo ('<td><button onclick = '.urlCustom($row['id']).' class="btn btn-outline-primary">選択</button></td>');
            echo ('<td class="id">'.htmlspecialchars($row['id'],ENT_QUOTES | ENT_HTML5, 'UTF-8').'</td>');
            echo ('<td class="maker">'.htmlspecialchars($row['maker'],ENT_QUOTES | ENT_HTML5, 'UTF-8').'</td>');
            echo ('<td class="name"><a href ='.$row['url'].' target="_blank" rel="noopener noreferrer">'.htmlspecialchars($row['name'],ENT_QUOTES | ENT_HTML5, 'UTF-8').'</td>');
            echo ('<td class="price" style="text-align: right; font-weight: bold;">'.number_format(htmlspecialchars($row['price'],ENT_QUOTES | ENT_HTML5, 'UTF-8')).'</td>');
        }
        ?>        
      </tbody>          
    </table>
</body>
</html>