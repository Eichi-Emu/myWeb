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
    <title>cpuクーラー</title>
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
        <h1>クーラーリスト</h1>
    </div>
    <form action="#">
      検索:<input type="text" name="search" value="" id="id_search" />
    </form>

    <form class="form-inline">
      <div class="form-group">
        <select id="maker-select" class="form-control">
          <option value="">メーカー</option>
          <option value="ADATA">ADATA</option>
          <option value="AINEX">AINEX</option>
          <option value="ANTEC">ANTEC</option>
          <option value="ARCTIC">ARCTIC</option>
          <option value="ASUS">ASUS</option>
          <option value="be quiet">be quiet</option>
          <option value="COOLER MASTER">COOLER MASTER</option>
          <option value="CRYORIG">CRYORIG</option>
          <option value="Corsair">Corsair</option>
          <option value="COUGAR">COUGAR</option>
          <option value="darkFlash">darkFlash</option>
          <option value="DEEPCOOL">DEEPCOOL</option>
          <option value="Dynatron">Dynatron</option>
          <option value="EK Water Blocks">EK Water Blocks</option>
          <option value="ENERMAX">ENERMAX</option>
          <option value="Fractal Design">Fractal Design</option>
          <option value="GELID">GELID</option>
          <option value="ID-COOLING">ID-COOLING</option>
          <option value="インテル">Intel</option>
          <option value="IN WIN">IN WIN</option>
          <option value="JIUSHARK">JIUSHARK</option>
          <option value="LEPA">LEPA</option>
          <option value="LIAN LI">LIAN LI</option>
          <option value="MSI">MSI</option>
          <option value="noctua">noctua</option>
          <option value="NZXT">NZXT</option>
          <option value="PCCOOLER">PCCOOLER</option>
          <option value="PROLIMA TECH">PROLIMA TECH</option>
          <option value="ProArtist">ProArtist</option>
          <option value="SAMA">SAMA</option>
          <option value="Spire">Spire</option>
          <option value="SUNTRUST">SUNTRUST</option>
          <option value="SUPERMICRO">SUPERMICRO</option>
          <option value="Razer">Razer</option>
          <option value="REEVEN">REEVEN</option>
          <option value="Thermalright">Thermalright </option>
          <option value="Thermaltake">Thermaltake</option>
          <option value="XIGMATEK">XIGMATEK</option>
          <option value="ZALMAN">ZALMAN</option>
          <option value="オウルテック">オウルテック</option>
          <option value="サイズ">サイズ</option>
        </select>
        <select id="type-select" class="form-control">
          <option value="">冷却方式</option>
          <option value="トップフロー">トップフロー</option>
          <option value="サイドフロー">サイドフロー</option>
          <option value="水冷">簡易水冷</option>
        </select>
        <select id="socket-select" class="form-control">
          <option value="">ソケット</option>
          <option value="">-intel-</option>
          <option value="1700">LGA1700</option>
          <option value="1200">LGA1200</option>
          <option value="1151">LGA1151</option>
          <option value="2066">LGA2066</option>
          <option value="3647">LGA3647</option>
          <option value="4189">LGA4189</option>
          <option value="">-AMD-</option>
          <option value="AM5">Socket AM5</option>
          <option value="AM4">Socket AM4</option>
          <option value="TR4">Socket TR4</option>
          <option value="sTRX4">Socket sTRX4</option>
          <option value="sWRX8">Socket sWRX8</option>
        </select>
      </div>
    </form>
    <br>
    <table align="center" border="1" cellpadding="5" class="order-table" id="main-table" >
      <thead>
        <tr>
            <th style="width: 4%"></th>
            <th class="id"style="width: 3.5%">固有ID</th> 
            <th class="maker" style="width: 8%">メーカー</th>
            <th class="name" style="width: 30%">製品名</th>
            <th class="price">値段</th>
            <th class="gen">冷却方式</th>
            <th class="socket">ソケット</th>
            <th class="socket">ラジサイズ/本体サイズ</th>
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
            $do = url_param_change(array("cpuc"=>$id));
            $return = 'location.href=\'index.php'.$do.'\'';
            return $return;
        }
        $a = 0;
        $sql="SELECT * FROM cpuc WHERE name<>'Error'";
        $array = array();
        $stt = $pdo->query($sql);
        
        while($row = $stt->fetch()) {
        echo '<tr>';
            echo ('<td><button onclick = '.urlCustom($row['id']).' class="btn btn-outline-primary">選択</button></td>');
            echo ('<td class="id">'.htmlspecialchars($row['id'],ENT_QUOTES | ENT_HTML5, 'UTF-8').'</td>');
            echo ('<td class="maker">'.htmlspecialchars($row['maker'],ENT_QUOTES | ENT_HTML5, 'UTF-8').'</td>');
            echo ('<td class="name"><a href ='.$row['url'].' target="_blank" rel="noopener noreferrer">'.htmlspecialchars($row['name'],ENT_QUOTES | ENT_HTML5, 'UTF-8').'</td>');
            echo ('<td class="price" style="text-align: right; font-weight: bold;">'.number_format(htmlspecialchars($row['price'],ENT_QUOTES | ENT_HTML5, 'UTF-8')).'</td>');
            echo ('<td class="type">'.htmlspecialchars($row['type'],ENT_QUOTES | ENT_HTML5, 'UTF-8').'</td>');
            echo ('<td class="socket">'.htmlspecialchars($row['socket'],ENT_QUOTES | ENT_HTML5, 'UTF-8').'</td>');
            echo ('<td class="size">'.htmlspecialchars($row['size'],ENT_QUOTES | ENT_HTML5, 'UTF-8').'</td>');
        }
        ?>
      </tbody>          
    </table>
</body>
</html>