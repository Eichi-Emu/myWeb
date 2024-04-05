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
    <title>マザーボード</title>
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
        <h1>マザーボードリスト</h1>
    </div>
    <form action="#">
      検索:<input type="text" name="search" value="" id="id_search" />
    </form>

    <form class="form-inline">
      <div class="form-group">
        <select id="select-1" class="form-control">
          <option value="">メーカー</option>
          <option value="ASUS">ASUS</option>
          <option value="ASRock">ASRock</option>
          <option value="BIOSTAR">BIOSTAR</option>
          <option value="Colorful">Colorful</option>
          <option value="GIGABYTE">GIGABYTE</option>
          <option value="MSI">MSI</option>
          <option value="NZXT">NZXT</option>
        </select>
        <select id="select-2" class="form-control">
          <option value="">チップセット</option>
          <option value="">--Intel--</option>
          <option value="Z790">Z790</option>
          <option value="H770">H770</option>
          <option value="B760">B760</option>
          <option value="Z690">Z690</option>
          <option value="H670">H670</option>
          <option value="B660">B660</option>
          <option value="H610">H610</option>
          <option value="Z590">Z590</option>
          <option value="H570">H570</option>
          <option value="B560">B560</option>
          <option value="H510">H510</option>
          <option value="Z490">Z490</option>
          <option value="B460">B460</option>
          <option value="H310">H310</option>
          <option value="H110">H110</option>
          <option value="H81">H81</option>
          <option value="Q87">Q87</option>
          <option value="H61">H61</option>
          <option value="X299">X299</option>
          <option value="X79">X79</option>
          <option value="C236">C236</option>
          <option value="">--AMD--</option>
          <option value="WRX80">WRX80</option>
          <option value="X670E">X670E</option>
          <option value="X670(?!E)">X670</option>
          <option value="B650E">B650E</option>
          <option value="B650(?!E)">B650</option>
          <option value="X570">X570</option>
          <option value="B550">B550</option>
          <option value="A520">A520</option>
          <option value="X470">X470</option>
          <option value="B450">B450</option>
          <option value="A320">A320</option>
        </select>
        <select id="select-8" class="form-control">
          <option value="">フォームファクタ</option>
          <option value="(?<!Micro|Flex)ATX">ATX</option>
          <option value="Extended">E-ATX</option>
          <option value="MicroATX">MicroATX</option>
          <option value="Mini ITX">Mini ITX</option>
          <option value="SSI EEB">SSI EEB</option>
          <option value="CEB">CEB</option>
          <option value="FlexATX">FlexATX</option>
        </select>
        <select id="select-3" class="form-control">
          <option value="">ソケット</option>
          <option value="">-intel-</option>
          <option value="1700">LGA1700</option>
          <option value="1200(?!SPSR)">LGA1200</option>
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
          <option value="">--他--</option>
          <option value="Onboard">Onboard</option>
        </select>
        <select id="select-4" class="form-control">
          <option value="">規格</option>
          <option value="DDR">DDR</option>
          <option value="DDR2">DDR2</option>
          <option value="DDR3">DDR3</option>
          <option value="DDR4">DDR4</option>
          <option value="DDR5">DDR5</option>
        </select>
        <select id="select-5" class="form-control">
          <option value="">メモリスロット数</option>
          <option value="4slot">4スロ</option>
          <option value="2slot">2スロ</option>
        </select>
        <select id="select-6" class="form-control">
          <option value="">サンダーボルト対応</option>
          <option value="ON-TB">あり</option>
          <option value="NO-TB">なし</option>
        </select>
        <select id="select-7" class="form-control">
          <option value="">wi-fi対応</option>
          <option value="ON-wifi">あり</option>
          <option value="NO-wifi">なし</option>
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
            <th class="chipset">チップセット</th>
            <th class="socket">ソケット</th>
            <th class="formfactor">フォームファクタ</th>
            <th class="ram">メモリ種類</th>
            <th class="ramnum">メモリスロット数</th>
            <th class="Thunderbolt">TBの有無</th>
            <th class="wifi">Wi-Fiの有無</th>
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
            $do = url_param_change(array("mb"=>$id));
            $return = 'location.href=\'index.php'.$do.'\'';
            return $return;
        }
        $a = 0;
        $sql="SELECT * FROM mb WHERE name<>'Error'";
        $array = array();
        $stt = $pdo->query($sql);
        
        while($row = $stt->fetch()) {
        echo '<tr>';
            echo ('<td><button onclick = '.urlCustom($row['id']).' class="btn btn-outline-primary">選択</button></td>');
            echo ('<td class="id">'.htmlspecialchars($row['id'],ENT_QUOTES | ENT_HTML5, 'UTF-8').'</td>');
            echo ('<td class="maker">'.htmlspecialchars($row['maker'],ENT_QUOTES | ENT_HTML5, 'UTF-8').'</td>');
            echo ('<td class="name"><a href ='.$row['url'].' target="_blank" rel="noopener noreferrer">'.htmlspecialchars($row['name'],ENT_QUOTES | ENT_HTML5, 'UTF-8').'</td>');
            echo ('<td class="price" style="text-align: right; font-weight: bold;">'.number_format(htmlspecialchars($row['price'],ENT_QUOTES | ENT_HTML5, 'UTF-8')).'</td>');
            echo ('<td class="chipset">'.htmlspecialchars($row['chipset'],ENT_QUOTES | ENT_HTML5, 'UTF-8').'</td>');
            echo ('<td class="socket">'.htmlspecialchars($row['socket'],ENT_QUOTES | ENT_HTML5, 'UTF-8').'</td>');
            echo ('<td class="formfactor">'.htmlspecialchars($row['formfactor'],ENT_QUOTES | ENT_HTML5, 'UTF-8').'</td>');
            echo ('<td class="ram">'.htmlspecialchars($row['ram'],ENT_QUOTES | ENT_HTML5, 'UTF-8').'</td>');
            echo ('<td class="ramnum">'.htmlspecialchars($row['ramnum'],ENT_QUOTES | ENT_HTML5, 'UTF-8').'slot</td>');

            if($row['Thunderbolt']==1){
              echo ('<td class="Thunderbolt">ON-TB</td>');
            }else{
              echo ('<td class="Thunderbolt">NO-TB</td>');
            }

            if($row['wifi']==1){
              echo ('<td class="wifi">ON-wifi</td>');
            }else{
              echo ('<td class="wifi">NO-wifi</td>');
            }
        }
        ?>
      </tbody>          
    </table>
</body>
</html>