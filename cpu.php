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
  <?php
  include('parts_header.php');
  parts_header('cpu');
  ?>
  <!--
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>cpu</title>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.0/js/jquery.tablesorter.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.0/js/jquery.tablesorter.widgets.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.0/css/theme.default.min.css">

  <style>
    #main-table {
      font-size: 1.2em;
    }
  </style>
  <script>
    $(document).ready(function() {
      $('#main-table').tablesorter({
        headers: {
          0: {
            sorter: false,
            parser: false
          }
        },
        widthFixed: true,
        widgets: ["zebra", "filter"],
        widgetOptions: {
          filter_ignoreCase: true, //大文字小文字の区別
          filter_saveFilters: true, //フィルタ情報の保存
          filter_searchDelay: 300, //サーチかけるまでのディレイ

          filter_functions: {
            2: {
              "インテル": function(e, n, f, i, $r, c, data) {
                return /インテル/.test(e);
              },
              "AMD": function(e, n, f, i, $r, c, data) {
                return /AMD/.test(e);
              }
            },
            6: {
              "--intel--": function(e, n, f, i, $r, c, data) {
                return /LGA1700|LGA1200|LGA1151|LGA2066|LGA3647|LGA4189|LGA4677|LGA775|LGA1150|LGA1156|LGA2011/.test(e);
              },
              "LGA1700": function(e, n, f, i, $r, c, data) {
                return /LGA1700/.test(e);
              },
              "LGA1200": function(e, n, f, i, $r, c, data) {
                return /LGA1200/.test(e);
              },
              "LGA4677": function(e, n, f, i, $r, c, data) {
                return /LGA4677/.test(e);
              },
              "LGA4189": function(e, n, f, i, $r, c, data) {
                return /LGA4189/.test(e);
              },
              "LGA1151": function(e, n, f, i, $r, c, data) {
                return /LGA1151/.test(e);
              },
              "LGA1150": function(e, n, f, i, $r, c, data) {
                return /LGA1150/.test(e);
              },
              "LGA1156": function(e, n, f, i, $r, c, data) {
                return /LGA1156/.test(e);
              },
              "LGA775": function(e, n, f, i, $r, c, data) {
                return /LGA775/.test(e);
              },
              "LGA2066": function(e, n, f, i, $r, c, data) {
                return /LGA2066/.test(e);
              },
              "LGA2011": function(e, n, f, i, $r, c, data) {
                return /LGA2011/.test(e);
              },
              "--AMD--": function(e, n, f, i, $r, c, data) {
                return /Socket AM5|Socket AM4|Socket sTR5|Socket sWRX8|Socket sTRX4|Socket TR4/.test(e);
              },
              "Socket AM5": function(e, n, f, i, $r, c, data) {
                return /Socket AM5/.test(e);
              },
              "Socket AM4": function(e, n, f, i, $r, c, data) {
                return /Socket AM4/.test(e);
              },
              "Socket sTR5": function(e, n, f, i, $r, c, data) {
                return /Socket sTR5/.test(e);
              },
              "Socket sWRX8": function(e, n, f, i, $r, c, data) {
                return /Socket sWRX8/.test(e);
              },
              "Socket sTRX4": function(e, n, f, i, $r, c, data) {
                return /Socket sTRX4/.test(e);
              },
              "Socket TR4": function(e, n, f, i, $r, c, data) {
                return /Socket TR4/.test(e);
              },

            }
          }
        }
      });
    });
  </script>
-->
</head>

<body>
  <div align="center">
    <h1>CPUリスト</h1>
  </div>
  <br>
  <table align="center" border="1" cellpadding="5" id="main-table" class="order-table">
    <thead>
      <tr>
        <th></th>
        <th class="id">固有ID</th>
        <th class="maker">メーカー</th>
        <th class="name">製品名</th>
        <th class="price">値段</th>
        <th class="gen">世代</th>
        <th class="socket">ソケット</th>

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
        $do = url_param_change(array("cpu" => $id));
        $return = 'location.href=\'index.php' . $do . '\'';
        return $return;
      }
      $a = 0;
      $sql = "SELECT * FROM cpu WHERE name<>'Error'";
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
        echo ('<td class="socket">' . htmlspecialchars($row['socket'], ENT_QUOTES | ENT_HTML5, 'UTF-8') . '</td>');
      }
      ?>
    </tbody>
  </table>
</body>

</html>