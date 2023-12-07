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
  <title>cpu</title>
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
            }
          }
        }

      });
    });
    /*jQuery(function ($) {
      $('input#id_search').quicksearch('table tbody tr');
     // セレクトボックスが変更されたら処理をする
      $('#maker-select').change(function () {
    
          // 選択した値を取得
          var select_val = $('#maker-select option:selected').val();
        
          // tbodyのtr数回 処理をする
          $.each($("#main-table tbody tr"), function (index, element) {
        
             // 選択した値が空欄だったら、全ての行を表示する為の処理
             if (select_val == "") {
                $(element).css("display", "table-row");
                return true; // 次のtrへ
              }
            
            // 1行をテキストとして取り出し、セレクトボックスで選択した値があるかをチェック
              var row_text = $(element).text();
            
              if (row_text.indexOf(select_val) != -1) {
                // 見つかった場合は表示する
                  $(element).css("display", "table-row");
                } else {
                // 見つからなかった場合は非表示に
                  $(element).css("display", "none");
                }

        });
      });
      $('#socket-select').change(function () {
    
        var select_val = $('#socket-select option:selected').val();
    
        $.each($("#main-table tbody tr"), function (index, element) {

        if (select_val == "") {
            $(element).css("display", "table-row");
            return true;
        }
        
        var row_text = $(element).text();
        
        if (row_text.indexOf(select_val) != -1) {
            $(element).css("display", "table-row");
        } else {
            $(element).css("display", "none");
        }

        });
      });
    
      });
      jQuery(function($) {
        $('input#id_search').quicksearch('table tbody tr');
        var filters = {}; // 空のフィルターのオブジェクトを初期化

        // 各メニューの変更イベントを処理する
        $('.form-control').change(function() {
          var filter_id = $(this).attr('id'); // メニューのIDを取得
          var filter_val = $(this).val(); // 選択された値を取得

          // フィルターのオブジェクトに新しいフィルターを追加または更新する
          if (filter_val == "") {
            delete filters[filter_id];
          } else {
            filters[filter_id] = filter_val;
          }

          // 各行をチェックして、表示または非表示を設定する
          $("#main-table tbody tr").each(function(index, element) {
            var row_text = $(element).text();
            var visible = true;

            $.each(filters, function(key, val) {
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
      });*/
  </script>
</head>

<body>
  <div align="center">
    <h1>CPUリスト</h1>
  </div>
  <form action="#">
    検索:<input type="text" name="search" value="" id="id_search" />
  </form>

  <form class="form-inline">
    <div class="form-group">
      <select id="select-1" class="form-control">
        <option value="">メーカー</option>
        <option value="インテル">Intel</option>
        <option value="AMD">AMD</option>
      </select>
      <select id="select-2" class="form-control">
        <option value="">ソケット</option>
        <option value="">-intel-</option>
        <option value="LGA1700">LGA1700</option>
        <option value="LGA1200">LGA1200</option>
        <option value="LGA1151">LGA1151</option>
        <option value="LGA2066">LGA2066</option>
        <option value="LGA3647">LGA3647</option>
        <option value="LGA4189">LGA4189</option>
        <option value="">-AMD-</option>
        <option value="Socket AM5">Socket AM5</option>
        <option value="Socket AM4">Socket AM4</option>
        <option value="Socket TR4">Socket TR4</option>
        <option value="Socket sTRX4">Socket sTRX4</option>
        <option value="Socket sWRX8">Socket sWRX8</option>
        <option value="Socket sTR5">Socket sTR5</option>
      </select>
      <select id="select-3" class="form-control">
        <option value="">グレード</option>
        <option value="">--Intel--</option>
        <option value="Core i9">Core i9</option>
        <option value="Core i7">Core i7</option>
        <option value="Core i5">Core i5</option>
        <option value="Core i3">Core i3</option>
        <option value="Pentium">Pentium</option>
        <option value="Celeron">Celeron</option>
        <option value="">--AMD--</option>
        <option value="Ryzen 9">Ryzen 9</option>
        <option value="Ryzen 7">Ryzen 7</option>
        <option value="Ryzen 5">Ryzen 5</option>
        <option value="Ryzen 3">Ryzen 3</option>
      </select>
    </div>
  </form>

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