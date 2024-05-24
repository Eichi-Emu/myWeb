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
  <title>メモリ</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.0/js/jquery.tablesorter.min.js"></script>
  <script src="https://cdn.jsdelivr.net/gh/DeuxHuitHuit/quicksearch/dist/jquery.quicksearch.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.0/css/theme.default.min.css">
  <style>
    #main-table th {
      background-color: deepskyblue;
    }

    #main-table {
      font-size: 1.0em;
    }
  </style>
  <script>
    $(document).ready(function() {
      $('#main-table').tablesorter();
    });
    jQuery(function($) {
      $('input#id_search').quicksearch('table tbody tr');
      var filters = {};

      $('.form-control').change(function() {
        var filter_id = $(this).attr('id');
        var filter_val = $(this).val();

        if (filter_val == "") {
          delete filters[filter_id];
        } else {
          filters[filter_id] = new RegExp(filter_val, "i");
        }

        $("#main-table tbody tr").each(function(index, element) {
          var row_text = $(element).text();
          var visible = true;

          $.each(filters, function(key, regex) {
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
    <h1>メモリリスト</h1>
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
        <option value="アユート">Aiuto</option>
        <option value="Antec Memory">Antec Memory</option>
        <option value="Apacer">Apacer</option>
        <option value="ARCHISS">ARCHISS</option>
        <option value="バッファロー">BUFFALO</option>
        <option value="CENTURY MICRO">CENTURY MICRO</option>
        <option value="CFD">CFD</option>
        <option value="Corsair">Corsair</option>
        <option value="crucial">Crucial</option>
        <option value="エレコム">ELECOM</option>
        <option value="ESSENCORE">ESSENCORE</option>
        <option value="GALAXY">GALAX</option>
        <option value="GIGABYTE">GIGABYTE</option>
        <option value="グリーンハウス">Green House</option>
        <option value="G.Skill">G.Skill</option>
        <option value="IODATA">IODATA</option>
        <option value="キングストン">Kingston</option>
        <option value="Lexar">Lexar</option>
        <option value="Micron">Micron</option>
        <option value="OCMEMORY">OCMEMORY</option>
        <option value="Patriot Memory">Patriot Memory</option>
        <option value="PNY">PNY</option>
        <option value="プリンストン">Princeton</option>
        <option value="サムスン">Samsung</option>
        <option value="サンマックス">SANMAX</option>
        <option value="Silicon Power">Silicon Power</option>
        <option value="旭東エレクトロニクス">SUNEAST</option>
        <option value="Team">Team</option>
        <option value="トランセンド">Transcend</option>
        <option value="UMAX">UMAX</option>
        <option value="ノーブランド">No Brand</option>
      </select>
      <select id="select-4" class="form-control">
        <option value="">合計容量</option>
        <option value="8 GB">8GB</option>
        <option value="16 GB">16GB</option>
        <option value="32 GB">32GB</option>
        <option value="48 GB">48GB</option>
        <option value="64 GB">64GB</option>
        <option value="96 GB">96GB</option>
        <option value="128 GB">128GB</option>
      </select>
      <select id="select-6" class="form-control">
        <option value="">単体容量</option>
        <option value="8㌐">8GB</option>
        <option value="16㌐">16GB</option>
        <option value="24㌐">24GB</option>
        <option value="32㌐">32GB</option>
        <option value="48㌐">48GB</option>
        <option value="64㌐">64GB</option>
      </select>
      <select id="select-2" class="form-control">
        <option value="">規格</option>
        <option value="DDR SDRAM">DDR</option>
        <option value="DDR2 SDRAM">DDR2</option>
        <option value="DDR3 SDRAM">DDR3</option>
        <option value="DDR4 SDRAM">DDR4</option>
        <option value="DDR5 SDRAM">DDR5</option>
      </select>
      <select id="select-3" class="form-control">
        <option value="">インタフェース</option>
        <option value="DIMM">DIMM</option>
        <option value="S.O.DIMM">S.O.DIMM</option>
      </select>
      <select id="select-5" class="form-control">
        <option value="">周波数</option>
        <option value="">--DDR4--</option>
        <option value="DDR4-2133">DDR4-2133</option>
        <option value="DDR4-2400">DDR4-2400</option>
        <option value="DDR4-2666">DDR4-2666</option>
        <option value="DDR4-2800">DDR4-2800</option>
        <option value="DDR4-2933">DDR4-2933</option>
        <option value="DDR4-3000">DDR4-3000</option>
        <option value="DDR4-3200">DDR4-3200</option>
        <option value="DDR4-3333">DDR4-3333</option>
        <option value="DDR4-3466">DDR4-3466</option>
        <option value="DDR4-3600">DDR4-3600</option>
        <option value="DDR4-3733">DDR4-3733</option>
        <option value="DDR4-3800">DDR4-3800</option>
        <option value="DDR4-4000">DDR4-4000</option>
        <option value="DDR4-4133">DDR4-4133</option>
        <option value="DDR4-4266">DDR4-4266</option>
        <option value="DDR4-4400">DDR4-4400</option>
        <option value="DDR4-4600">DDR4-4600</option>
        <option value="DDR4-4800">DDR4-4800</option>
        <option value="DDR4-5000">DDR4-5000</option>
        <option value="DDR4-5333">DDR4-5333</option>
        <option value="">--DDR5--</option>
        <option value="DDR5-4000">DDR5-4000</option>
        <option value="DDR5-4800">DDR5-4800</option>
        <option value="DDR5-5200">DDR5-5200</option>
        <option value="DDR5-5600">DDR5-5600</option>
        <option value="DDR5-6000">DDR5-6000</option>
        <option value="DDR5-6200">DDR5-6200</option>
        <option value="DDR5-6400">DDR5-6400</option>
        <option value="DDR5-6800">DDR5-6800</option>
        <option value="DDR5-7000">DDR5-7000</option>
        <option value="DDR5-7200">DDR5-7200</option>
        <option value="DDR5-7400">DDR5-7400</option>
        <option value="DDR5-7600">DDR5-7600</option>
        <option value="DDR5-7800">DDR5-7800</option>
        <option value="DDR5-8000">DDR5-8000</option>
      </select>
      <select id="select-7" class="form-control">
        <option value="">ECC対応</option>
        <option value="eccNG">ECCなし</option>
        <option value="eccOK">ECCあり</option>
      </select>
      <select id="select-8" class="form-control">
        <option value="">reg対応</option>
        <option value="regNG">regなし</option>
        <option value="regOK">regあり</option>
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
        <th class="gen">規格</th>
        <th class="type">I/F</th>
        <th class="hz">周波数</th>
        <th class="ram_value">合計容量</th>
        <th class="pcs_value">一枚当たり容量</th>
        <th class="ecc">ecc対応</th>
        <th class="reg">Reg対応</th>

      </tr>
    </thead>
    <tbody>
      <h5>青い項目部分をタップorクリックで並べ替えができます。</h5>
      <?php
      function url_param_change($par = array(), $op = 0)
      {
        $url = parse_url($_SERVER["REQUEST_URI"]);
        if (isset($url["query"])) parse_str($url["query"], $query);
        else $query = array();
        foreach ($par as $key => $value) {
          if ($key && is_null($value)) unset($query[$key]);
          else $query[$key] = $value;
        }
        $query = str_replace("=&", "&", http_build_query($query));
        $query = preg_replace("/=$/", "", $query);
        return $query ? (!$op ? "?" : "") . htmlspecialchars($query, ENT_QUOTES) : "";
      }
      function urlCustom($id)
      {
        $return = NULL;
        $do = url_param_change(array("ram" => $id));
        $return = 'location.href=\'index.php' . $do . '\'';
        return $return;
      }
      $a = 0;
      $sql = "SELECT * FROM `ram` WHERE gen in ('DDR4 SDRAM','DDR5 SDRAM') and type = 'DIMM' and name<>'Error';";
      $array = array();
      $stt = $pdo->query($sql);

      while ($row = $stt->fetch()) {
        echo '<tr>';
        echo ('<td><button onclick = ' . urlCustom($row['id']) . ' class="btn btn-outline-primary">選択</button></td>');
        echo ('<td class="id">' . htmlspecialchars($row['id'], ENT_QUOTES | ENT_HTML5, 'UTF-8') . '</td>');
        echo ('<td class="maker">' . htmlspecialchars($row['maker'], ENT_QUOTES | ENT_HTML5, 'UTF-8') . '</td>');
        echo ('<td class="name"><a href =' . $row['url'] . ' target="_blank" rel="noopener noreferrer">' . htmlspecialchars($row['name'], ENT_QUOTES | ENT_HTML5, 'UTF-8') . '</td>');
        echo ('<td class="price" style="text-align: right; font-weight: bold;">' . number_format(htmlspecialchars($row['price'], ENT_QUOTES | ENT_HTML5, 'UTF-8')) . '</td>');
        echo ('<td class="gen">' . htmlspecialchars($row['gen'], ENT_QUOTES | ENT_HTML5, 'UTF-8') . '</td>');
        echo ('<td class="type">' . htmlspecialchars($row['type'], ENT_QUOTES | ENT_HTML5, 'UTF-8') . '</td>');
        echo ('<td class="hz">' . htmlspecialchars($row['hz'], ENT_QUOTES | ENT_HTML5, 'UTF-8') . '</td>');
        echo ('<td class="ram_value">' . htmlspecialchars($row['ram_value'], ENT_QUOTES | ENT_HTML5, 'UTF-8') . ' GB</td>');
        echo ('<td class="pcs_value">' . htmlspecialchars($row['pcs_value'], ENT_QUOTES | ENT_HTML5, 'UTF-8') . '㌐</td>');

        if ($row['ecc'] == 1) {
          echo ('<td class="ecc">eccOK</td>');
        } else {
          echo ('<td class="ecc">eccNG</td>');
        }
        if ($row['reg'] == 1) {
          echo ('<td class="ecc">regOK</td>');
        } else {
          echo ('<td class="ecc">regNG</td>');
        }
      }
      ?>
    </tbody>
  </table>
</body>

</html>