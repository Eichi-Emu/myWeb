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
    <title>hdd</title>
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
      var filters = {};

      $('.form-control').change(function () {
        var filter_id = $(this).attr('id');
        var filter_val = $(this).val();

        if (filter_val == "") {
          delete filters[filter_id];
        } else {
          filters[filter_id] = new RegExp(filter_val, "i");
        }

        $("#main-table tbody tr").each(function (index, element) {
          var row_text = $(element).text();
          var visible = true;

          $.each(filters, function (key, regex) {
            if (!regex.test(row_text)) {
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
        <h1>HDDリスト</h1>
    </div>
    <form action="#">
      検索:<input type="text" name="search" value="" id="id_search" />
    </form>
    <form class="form-inline">
      <div class="form-group">
        <select id="select-1" class="form-control">
          <option value="">メーカー</option>
          <option value="HGST">HGST</option>
          <option value="SEAGATE">SeaGate</option>
          <option value="WESTERN DIGITAL">WESTERN DIGITAL</option>
          <option value="東芝">東芝</option>
        </select>
        <select id="select-2" class="form-control">
          <option value="">容量</option>
          <option value="500GB">500GB</option>
          <option value="1000GB">1TB</option>
          <option value="2000GB">2TB</option>
          <option value="4000GB">4TB</option>
          <option value="6000GB">6TB</option>
          <option value="8000GB">8TB</option>
          <option value="10000GB">10TB</option>
          <option value="12000GB">12TB</option>
          <option value="14000GB">14TB</option>
          <option value="16000GB">16TB</option>
          <option value="18000GB">18TB</option>
          <option value="2(?=0000)">20TB</option>
          <option value="2(?=2000)">22TB</option>
        </select>
      </div>
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
            <th class="hdd_value">容量</th>
            <th class="rpm">回転数</th>
            <th class="interface">インターフェース</th>
            
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
            $do = url_param_change(array("hdd"=>$id));
            $return = 'location.href=\'index.php'.$do.'\'';
            return $return;
        }
        $a = 0;
        $sql="SELECT * FROM hdd WHERE name<>'Error'";
        $array = array();
        $stt = $pdo->query($sql);
        
        while($row = $stt->fetch()) {
        echo '<tr>';
            echo ('<td><button onclick = '.urlCustom($row['id']).' class="btn btn-outline-primary">選択</button></td>');
            echo ('<td class="id">'.htmlspecialchars($row['id'],ENT_QUOTES | ENT_HTML5, 'UTF-8').'</td>');
            echo ('<td class="maker">'.htmlspecialchars($row['maker'],ENT_QUOTES | ENT_HTML5, 'UTF-8').'</td>');
            echo ('<td class="name"><a href ='.$row['url'].' target="_blank" rel="noopener noreferrer">'.htmlspecialchars($row['name'],ENT_QUOTES | ENT_HTML5, 'UTF-8').'</td>');
            echo ('<td class="price" style="text-align: right; font-weight: bold;">'.number_format(htmlspecialchars($row['price'],ENT_QUOTES | ENT_HTML5, 'UTF-8')).'</td>');
            echo ('<td class="hdd_value"> '.htmlspecialchars($row['hdd_value'],ENT_QUOTES | ENT_HTML5, 'UTF-8').'GB</td>');
            echo ('<td class="rpm">'.htmlspecialchars($row['rpm'],ENT_QUOTES | ENT_HTML5, 'UTF-8').'rpm</td>');
            echo ('<td class="interface">'.htmlspecialchars($row['interface'],ENT_QUOTES | ENT_HTML5, 'UTF-8').'</td>');
        }
      ?>
      </tbody>
    </table>
</body>
</html>