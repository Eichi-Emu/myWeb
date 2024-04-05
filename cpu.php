<?php
require_once("./idpw/Database.inc");
try {

  $pdo = new PDO(
    'mysql:dbname=kakaku;host=localhost;charset=utf8mb4',
    $db['user'],
    $db['pass'],
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
  $pp = file("p.txt");

  $pdo = new PDO(
    $pp[0],
    $pp[1],
    $pp[2],
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