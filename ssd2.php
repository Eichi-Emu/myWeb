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
    <title>SSD</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.0/js/jquery.tablesorter.min.js"></script>
    <script src ="https://cdn.jsdelivr.net/gh/DeuxHuitHuit/quicksearch/dist/jquery.quicksearch.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.0/css/theme.default.min.css">
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/js/extras/jquery.tablesorter.pager.min.js"></script> -->
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
        <h1>SSDリスト</h1>
</div>
    <form action="#">
      検索:<input type="text" name="search" value="" id="id_search" />
    </form>
    <form class="form-inline">
      <div class="form-group">
        <select id="select-1" class="form-control">
          <option value="">メーカー</option>
          <option value="ADATA">ADATA</option>
          <option value="ADTEC">ADTEC</option>
          <option value="CFD">CFD</option>
          <option value="Corsair">Corsair</option>
          <option value="crucial">crucial</option>
          <option value="GIGABYTE">GIGABYTE</option>
          <option value="キングストン">Kingston</option>
          <option value="キオクシア">KIOXIA</option>
          <option value="Lexar">Lexar</option>
          <option value="MSI">MSI</option>
          <option value="PLEXTOR">PLEXTOR</option>
          <option value="PNY">PNY</option>
          <option value="サムスン">Samsung</option>
          <option value="SANDISK">SanDisk</option>
          <option value="Silicon Power">Silicon Power</option>
          <option value="Solidigm">Solidigm</option>
          <option value="Team">Team</option>
          <option value="トランセンド">Transcend</option>
          <option value="WESTERN DIGITAL">WESTERN DIGITAL</option>
        </select>
        <select id="select-2" class="form-control">
          <option value="">容量</option>
          <option value="120GB|128GB">128GB前後</option>
          <option value="256GB|250GB|240GB">256GB前後</option>
          <option value="500GB|512GB|480GB">512GB前後</option>
          <option value="960GB|1000GB|1024GB">1TB前後</option>
          <option value="2000GB|2048GB">2TB前後</option>
          <option value="4096GB|4000GB">4TB前後</option>
          <option value="8000GB|8196GB">8TB前後</option>
        </select>
        <select id="select-3" class="form-control">
          <option value="">形状</option>
          <option value="2.5インチ">2.5インチ</option>
          <option value="Type2280">M.2(2280)</option>
          <option value="">--------</option>
          <option value="Type2242">M.2(2242)</option>
          <option value="Type2260">M.2(2260)</option>
          <option value="Type22110">M.2(22110)</option>
          <option value="mSATA">mSATA</option>
          <option value="">--------</option>
          <option value="外付け">外付け</option>
        </select>
        <select id="select-4" class="form-control">
          <option value="">インターフェース</option>
          <option value="Serial ATA">Serial ATA</option>
          <option value="PCI-Express(?! Gen4)|PCI-Express Gen3">PCIe Gen3</option>
          <option value="PCI-Express Gen4">PCIe Gen4</option>
          <option value="PCI-Express Gen5">PCIe Gen5</option>
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
            <th class="ssd_value">容量</th>
            <th class="interface">インターフェース</th>
            <th class="type">形状</th>
            <th class="readspeed">読込速度</th>
            <th class="writespeed">書込速度</th>
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
            $do = url_param_change(array("ssd2"=>$id));
            $return = 'location.href=\'index.php'.$do.'\'';
            return $return;
        }
        $a = 0;
        $sql="SELECT * FROM ssd WHERE name<>'Error'";
        $array = array();
        $stt = $pdo->query($sql);
        
        while($row = $stt->fetch()) {
          echo '<tr>';
            echo ('<td><button onclick = '.urlCustom($row['id']).' class="btn btn-outline-primary">選択</button></td>');
            echo ('<td class="id">'.htmlspecialchars($row['id'],ENT_QUOTES | ENT_HTML5, 'UTF-8').'</td>');
            echo ('<td class="maker">'.htmlspecialchars($row['maker'],ENT_QUOTES | ENT_HTML5, 'UTF-8').'</td>');
            echo ('<td class="name"><a href ='.$row['url'].' target="_blank" rel="noopener noreferrer">'.htmlspecialchars($row['name'],ENT_QUOTES | ENT_HTML5, 'UTF-8').'</td>');
            echo ('<td class="price" style="text-align: right; font-weight: bold;">'.number_format(htmlspecialchars($row['price'],ENT_QUOTES | ENT_HTML5, 'UTF-8')).'</td>');
            echo ('<td class="ssd_value">'.htmlspecialchars($row['ssd_value'],ENT_QUOTES | ENT_HTML5, 'UTF-8').'GB</td>');
            echo ('<td class="interface">'.htmlspecialchars($row['interface'],ENT_QUOTES | ENT_HTML5, 'UTF-8').'</td>');
            echo ('<td class="type">'.htmlspecialchars($row['type'],ENT_QUOTES | ENT_HTML5, 'UTF-8').'</td>');
            if($row['readspeed']<=0){
              echo ('<td class="readspeed">-</td>');}
              else{echo ('<td class="readspeed">'.htmlspecialchars($row['readspeed'],ENT_QUOTES | ENT_HTML5, 'UTF-8').'MB/s</td>');}
            if($row['writespeed']<=0){
              echo ('<td class="writespeed">-</td>');}
              else{echo ('<td class="writespeed">'.htmlspecialchars($row['writespeed'],ENT_QUOTES | ENT_HTML5, 'UTF-8').'MB/s</td>');}
          }
        ?>
      </tbody>
    </table>
</body>
</html>