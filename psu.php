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
    <title>電源</title>
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
  <h1>電源リスト</h1>
</div>
<form action="#">
  検索:<input type="text" name="search" value="" id="id_search" />
</form>
    <form class="form-inline">
      <div class="form-group">
        <select id="select-1" class="form-control">
          <option value="">メーカー</option>
          <option value="ADATA">ADATA</option>
          <option value="ANTEC">ANTEC</option>
          <option value="ASUS">ASUS</option>
          <option value="COOLER MASTER">COOLER MASTER</option>
          <option value="Corsair">Corsair</option>
          <option value="DEEPCOOL">DEEPCOOL</option>
          <option value="ENERMAX">ENERMAX</option>
          <option value="Fractal Design">Fractal Design</option>
          <option value="FSP">FSP</option>
          <option value="IN WIN">IN WIN</option>
          <option value="LIAN LI">LIAN LI</option>
          <option value="MSI">MSI</option>
          <option value="NZXT">NZXT</option>
          <option value="Phanteks">Phanteks</option>
          <option value="Seasonic">Seasonic</option>
          <option value="SILVERSTONE">SILVERSTONE</option>
          <option value="SUPER FLOWER">SUPER FLOWER</option>
          <option value="Thermaltake">Thermaltake</option>
          <option value="オウルテック">オウルテック</option>
          <option value="ニプロン">ニプロン</option>
          <option value="玄人志向">玄人志向</option>
        </select>
        <select id="select-2" class="form-control">
          <option value="">容量</option>
          <option value="(?<!1)5[0-9][0-9]W">500W台</option>
          <option value="6[0-9][0-9]W">600W台</option>
          <option value="7[0-9][0-9]W">700W台</option>
          <option value="8[0-9][0-9]W">800W台</option>
          <option value="9[0-9][0-9]W">900W台</option>
          <option value="10[0-9][0-9]W">1000W台</option>
          <option value="12[0-9][0-9]W">1200W台</option>
          <option value="13[0-9][0-9]W">1300W台</option>
          <option value="16[0-9][0-9]W">1600W台</option>
          <option value="20[0-9][0-9]W">2000W台</option>
        </select>
        <select id="select-3" class="form-control">
          <option value="">認証</option>
          <option value="Standard">Standard</option>
          <option value="Bronze|BRONZE">Bronze</option>
          <option value="Silver">Silver</option>
          <option value="Gold|GOLD">Gold</option>
          <option value="Platinum">Platinum</option>
          <option value="Titanium">Titanium</option>
        </select>
        <select id="select-4" class="form-control">
          <option value="">フォームファクタ</option>
          <option value="ATX v3.0">ATX 3.0</option>
          <option value="ATX">ATX</option>
          <option value="SFX">SFX</option>
          <option value="SFX-L">SFX-L</option>
          <option value="FlexATX">FlexATX</option>
          <option value="TFX">TFX</option>
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
            <th class="psu_value">容量</th>
            <th class="efficiency">認証</th>
            <th class="formfactor">フォームファクタ</th>
            <th class="plug_in">プラグイン対応の有無</th>
            
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
              $do = url_param_change(array("psu"=>$id));
              $return = 'location.href=\'index.php'.$do.'\'';
              return $return;
          }
          $a = 0;
          $sql="SELECT * FROM psu WHERE name<>'Error'";
          $array = array();
          $stt = $pdo->query($sql);
          
          while($row = $stt->fetch()) {
              echo '<tr>';
              echo ('<td><button onclick = '.urlCustom($row['id']).' class="btn btn-outline-primary">選択</button></td>');
              echo ('<td class="id">'.htmlspecialchars($row['id'],ENT_QUOTES | ENT_HTML5, 'UTF-8').'</td>');
              echo ('<td class="maker">'.htmlspecialchars($row['maker'],ENT_QUOTES | ENT_HTML5, 'UTF-8').'</td>');
              echo ('<td class="name"><a href ='.$row['url'].' target="_blank" rel="noopener noreferrer">'.htmlspecialchars($row['name'],ENT_QUOTES | ENT_HTML5, 'UTF-8').'</td>');
              echo ('<td class="price" style="text-align: right; font-weight: bold;"> '.number_format(htmlspecialchars($row['price'],ENT_QUOTES | ENT_HTML5, 'UTF-8')).'</td>');
              echo ('<td class="psu_value" style="text-align: right;">'.htmlspecialchars($row['psu_value'],ENT_QUOTES | ENT_HTML5, 'UTF-8').'W</td>');
              echo ('<td class="efficiency">'.htmlspecialchars($row['efficiency'],ENT_QUOTES | ENT_HTML5, 'UTF-8').'</td>');
              echo ('<td class="formfactor">'.htmlspecialchars($row['formfactor'],ENT_QUOTES | ENT_HTML5, 'UTF-8').'</td>');
              if($row['plug_in']==1){
                echo ('<td class="plug_in">○</td>');}
                else{echo ('<td class="plug_in">×</td>');}
          }
        ?>
      </tbody>          
    </table>
</body>
</html>