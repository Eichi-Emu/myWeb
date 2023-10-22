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
  <title>GPU</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.0/js/jquery.tablesorter.min.js"></script>
  <script src="https://cdn.jsdelivr.net/gh/DeuxHuitHuit/quicksearch/dist/jquery.quicksearch.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.0/css/theme.default.min.css">
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/js/extras/jquery.tablesorter.pager.min.js"></script> -->
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
    <h1>GPUリスト</h1>
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
        <option value="Colorful">Colorful</option>
        <option value="ELSA">ELSA</option>
        <option value="GAINWARD">GAINWARD</option>
        <option value="GIGABYTE">GIGABYTE</option>
        <option value="Inno3D">Inno3D</option>
        <option value="MSI">MSI</option>
        <option value="Palit">Palit</option>
        <option value="PowerColor">PowerColor</option>
        <option value="PNY">PNY</option>
        <option value="SAPPHIRE">SAPPHIRE</option>
        <option value="ZOTAC">ZOTAC</option>
        <option value="玄人志向">玄人志向</option>
      </select>
      <select id="select-2" class="form-control">
        <option value="">チップメーカー</option>
        <option value="NVIDIA">NVIDIA</option>
        <option value="AMD">AMD</option>
        <option value="Intel">Intel</option>
      </select>
      <select id="select-3" class="form-control">
        <option value="">チップ種類</option>
        <option value="">--NVIDIA--</option>
        <option value="RTX 4090">RTX 4090</option>
        <option value="RTX 4080">RTX 4080</option>
        <option value="RTX 4070 Ti">RTX 4070Ti</option>
        <option value="RTX 4070(?! Ti)">RTX 4070</option>
        <option value="RTX 4060 Ti">RTX 4060Ti</option>
        <option value="RTX 4060(?! Ti)">RTX 4060</option>
        <option value="RTX 3090 Ti">RTX 3090Ti</option>
        <option value="RTX 3090(?! Ti)">RTX 3090</option>
        <option value="RTX 3080 Ti">RTX 3080Ti</option>
        <option value="RTX 3080(?! Ti)">RTX 3080</option>
        <option value="RTX 3070 Ti">RTX 3070Ti</option>
        <option value="RTX 3070(?! Ti)">RTX 3070</option>
        <option value="RTX 3060 Ti">RTX 3060Ti</option>
        <option value="RTX 3060(?! Ti)">RTX 3060</option>
        <option value="RTX 3050">RTX 3050</option>
        <option value="RTX 2060">RTX 2060</option>
        <option value="GTX 1660 Ti">GTX 1660Ti</option>
        <option value="GTX 1660 SUP">GTX 1660 Super</option>
        <option value="GTX 1660">GTX 1660</option>
        <option value="GTX 1650">GTX 1650</option>
        <option value="GTX 1630">GTX 1630</option>
        <option value="GTX 1050 Ti">GTX 1050Ti</option>
        <option value="GT 1030">GT 1030</option>
        <option value="GT 730">GT 730</option>
        <option value="GT 710">GT 710</option>
        <option value="">--AMD--</option>
        <option value="RX 7900 XTX">RX 7900XTX</option>
        <option value="RX 7900 XT(?!X)">RX 7900XT</option>
        <option value="RX 6950 XT">RX 6950XT</option>
        <option value="RX 6900 XT">RX 6900XT</option>
        <option value="RX 6800 XT">RX 6800XT</option>
        <option value="RX 6800">RX 6800</option>
        <option value="RX 6750 XT">RX 6750XT</option>
        <option value="RX 6700 XT">RX 6700XT</option>
        <option value="RX 6700">RX 6700</option>
        <option value="RX 6650 XT">RX 6650XT</option>
        <option value="RX 6600 XT">RX 6600XT</option>
        <option value="RX 6600">RX 6600</option>
        <option value="RX 6500 XT">RX 6500XT</option>
        <option value="RX 6400">RX 6400</option>
        <option value="">--Intel--</option>
        <option value="Arc A770">Arc A770</option>
        <option value="Arc A750">Arc A750</option>
        <option value="Arc A380">Arc A380</option>
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
        <th class="chipmaker">チップメーカー</th>
        <th class="chip">チップ</th>
        <th class="vramtype">VRAMタイプ</th>
        <th class="vramsize">VRAMサイズ</th>
        <th class="cooling">冷却方式</th>
        <th class="size">大きさ</th>
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
        $do = url_param_change(array("gpu" => $id));
        $return = 'location.href=\'index.php' . $do . '\'';
        return $return;
      }
      $a = 0;
      $sql = "SELECT * FROM gpu WHERE name<>'Error'";
      $array = array();
      $stt = $pdo->query($sql);

      while ($row = $stt->fetch()) {
        echo '<tr>';
        echo ('<td><button onclick = ' . urlCustom($row['id']) . ' class="btn btn-outline-primary">選択</button></td>');
        echo ('<td class="id">' . htmlspecialchars($row['id'], ENT_QUOTES | ENT_HTML5, 'UTF-8') . '</td>');
        echo ('<td class="maker">' . htmlspecialchars($row['maker'], ENT_QUOTES | ENT_HTML5, 'UTF-8') . '</td>');
        echo ('<td class="name"><a href =' . $row['url'] . ' target="_blank" rel="noopener noreferrer">' . htmlspecialchars($row['name'], ENT_QUOTES | ENT_HTML5, 'UTF-8') . '</td>');
        //echo ('<td class="price">'.htmlspecialchars($row['price'],ENT_QUOTES | ENT_HTML5, 'UTF-8').'</td>');
        echo ('<td class="price" style="text-align: right; font-weight: bold;">' . number_format(htmlspecialchars($row['price'], ENT_QUOTES | ENT_HTML5, 'UTF-8')) . '</td>');
        echo ('<td class="chipmaker">' . htmlspecialchars($row['chipmaker'], ENT_QUOTES | ENT_HTML5, 'UTF-8') . '</td>');
        echo ('<td class="chip">' . htmlspecialchars($row['chip'], ENT_QUOTES | ENT_HTML5, 'UTF-8') . '</td>');
        echo ('<td class="vramtype">' . htmlspecialchars($row['vramtype'], ENT_QUOTES | ENT_HTML5, 'UTF-8') . '</td>');
        echo ('<td class="vramsize">' . htmlspecialchars($row['vramsize'], ENT_QUOTES | ENT_HTML5, 'UTF-8') . '</td>');
        echo ('<td class="cooling">' . htmlspecialchars($row['cooling'], ENT_QUOTES | ENT_HTML5, 'UTF-8') . '</td>');
        echo ('<td class="size">' . htmlspecialchars($row['size'], ENT_QUOTES | ENT_HTML5, 'UTF-8') . '</td>');
      }
      ?>
    </tbody>
  </table>
</body>

</html>