<?php
require("PDOtest.php");
$pdo=db_connection();
//$pp = file("p.txt");//DBログイン情報ファイル
//$db_string=sprintf($pp);//DB名等指定
//$user=$pp[1];//ユーザー名
//$pass=$pp[2];//パス
$genre = $_GET['genre'];//ジャンル

//echo($db_string."U=".$user."P=".$pass);
/*"$db_string",
    "$user",
    "$pass",
    
    'mysql:dbname=kakaku;host=localhost;charset=utf8mb4',
    'user',
    'xX114514',
    */

try {
  //echo $pp[0];
  $pdo = db_connection();
} catch (PDOException $e) {
  header('Content-Type: text/plain; charset=UTF-8', true, 500);
  exit($e->getMessage());
}

header('Content-Type: text/html; charset=utf-8');
?>

<!DOCTYPE html>
<html lang="jp">
  <?php
  include('parts_header.php');
  parts_header($_GET['genre']);
  //echo $_GET['genre'];
  ?>


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
        unset($query["genre"]);
        $query = str_replace("=&", "&", http_build_query($query));
        $query = preg_replace("/=$/", "", $query);
        return $query ? (!$op ? "?" : "") . htmlspecialchars($query, ENT_QUOTES) : "";
      }
      function urlCustom($id)
      {
        $return = NULL;
        $do = url_param_change(array($_GET['genre'] => $id));
        $return = 'location.href=\'index.php' . $do . '\'';
        return $return;
      }

      $now_locate = $_SERVER['REQUEST_URI'];
      //echo($now_locate);
      if(strpos($now_locate,'?') !== false){
        $all_query = $_GET;
        unset($all_query['genre']);
        $encoded_query = http_build_query($all_query);
        if($encoded_query){
        $dom = <<< DOM
        <button onclick = "location.href='index.php?{$encoded_query}'" class="btn btn-outline-primary">戻る</button>
        DOM;}
        else{
          $dom = <<< DOM
        <button onclick = "location.href='index.php'" class="btn btn-outline-primary">戻る</button>
        DOM;
        }
        echo($dom);
      }else{
        $dom = <<< DOM
        <button onclick = "location.href='index.php'" class="btn btn-outline-primary">戻る</button>
        DOM;
        echo($dom);
      }

      $a = 0;
      if($genre==="ssd2"){$genre_encoded="ssd";}else{$genre_encoded=$genre;}
      
      $sql = "SELECT * FROM {$genre_encoded} WHERE name <>'Error' and price <>'99999999' ";
      //echo($sql);
      $array = array();
      $stt = $pdo->query($sql);
      //if($stt){echo"true";}else{echo "false";}
      while ($row = $stt->fetch()) {
        
        $encode_URL = urlCustom($row['id']);
        //echo($encode_URL);
        $encode_id = htmlspecialchars($row['id'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $encode_maker=htmlspecialchars($row['maker'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $encode_name=htmlspecialchars($row['name'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $encode_price=number_format(htmlspecialchars($row['price'], ENT_QUOTES | ENT_HTML5, 'UTF-8'));
        
        $echo = <<< EOS
        <tr>
        <td><button onclick ="{$encode_URL}" class="btn btn-outline-primary">選択</button></td>
        <td class="maker">{$encode_maker}</td>
        <td class="name">{$encode_name}</td>
        <td class="price">{$encode_price}</td>
        EOS;
        echo $echo;
        
        switch($_GET['genre']){
          case 'cpu':
            $encode_Gen=htmlspecialchars($row['gen'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $encode_socket=htmlspecialchars($row['socket'], ENT_QUOTES | ENT_HTML5, 'UTF-8');

            $switch_echo = <<< ECO
            <td class="gen">{$encode_Gen}</td>
            <td class="socket">{$encode_socket}</td>
            ECO;

            echo $switch_echo;
            break;
          case 'cpuc':
            $encode_type=htmlspecialchars($row['type'],ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $encode_socket=htmlspecialchars($row['socket'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $encode_size=htmlspecialchars($row['size'],ENT_QUOTES | ENT_HTML5, 'UTF-8');

            $switch_echo = <<< ECO
            <td class="type">{$encode_type}</td>
            <td class="socket">{$encode_socket}</td>
            <td class="size">{$encode_size}</td>
            ECO;

            echo $switch_echo;
            break;

          case 'ram':
            $encode_Gen=htmlspecialchars($row['gen'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $encode_type=htmlspecialchars($row['type'],ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $encode_hz=htmlspecialchars($row['hz'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $encode_ram_value=htmlspecialchars($row['ram_value'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $encode_pcs_value=htmlspecialchars($row['pcs_value'], ENT_QUOTES | ENT_HTML5, 'UTF-8');

            if ($row['ecc'] == 1) {
              $encode_ecc = htmlspecialchars("eccOK");
            } else {
              $encode_ecc = htmlspecialchars("eccNG");
            }
            if ($row['reg'] == 1) {
              $encode_reg = htmlspecialchars("regOK");
            } else {
              $encode_reg = htmlspecialchars("regNG");
            }

            $switch_echo = <<< ECO
            <td class="gen">{$encode_Gen}</td>
            <td class="type">{$encode_type}</td>
            <td class="hz">{$encode_hz}</td>
            <td class="ram_value">{$encode_ram_value}GB</td>
            <td class="pcs_value">{$encode_pcs_value}GB</td>
            <td class='ecc'>{$encode_ecc}</td>
            <td class='reg'>{$encode_reg}</td>

            ECO;

            echo $switch_echo;
            break;

          case 'mb':
            $encode_Chipset=htmlspecialchars($row['chipset'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $encode_socket=htmlspecialchars($row['socket'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $encode_formfactor=htmlspecialchars($row['formfactor'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $encode_ram=htmlspecialchars($row['ram'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $encode_ramnum=htmlspecialchars($row['ramnum'], ENT_QUOTES | ENT_HTML5, 'UTF-8');

            if ($row['Thunderbolt'] == 1) {
              $encode_Thunderbolt = htmlspecialchars('あり');
            } else {
              $encode_Thunderbolt = htmlspecialchars('なし');
            }
            if ($row['wifi'] == 1) {
              $encode_wifi = htmlspecialchars('あり');
            } else {
              $encode_wifi = htmlspecialchars('なし');
            }

            $switch_echo = <<< ECO
            <td class="Chipset">{$encode_Chipset}</td>
            <td class="socket">{$encode_socket}</td>
            <td class="formfactor">{$encode_formfactor}</td>
            <td class="ram">{$encode_ram}</td>
            <td class="ramnum">{$encode_ramnum}</td>
            <td class="Thunderbolt">{$encode_Thunderbolt}</td>
            <td class="wifi">{$encode_wifi}</td>
            ECO;
            echo $switch_echo;
            break;
            
          case 'gpu':
            $encode_ChipMaker=htmlspecialchars($row['chipmaker'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $encode_chip=htmlspecialchars($row['chip'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $encode_vramtype=htmlspecialchars($row['vramtype'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $encode_vramsize=htmlspecialchars($row['vramsize'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $encode_cooling=htmlspecialchars($row['cooling'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $encode_size=htmlspecialchars($row['size'], ENT_QUOTES | ENT_HTML5, 'UTF-8');

            $switch_echo = <<< ECO
            <td class="ChipMaker">{$encode_ChipMaker}</td>
            <td class="chip">{$encode_chip}</td>
            <td class="vramtype">{$encode_vramtype}</td>
            <td class="vramsize">{$encode_vramsize}</td>
            <td class="cooling">{$encode_cooling}</td>
            <td class="size">{$encode_size}</td>
            ECO;

            echo $switch_echo;

            break;

          case 'ssd':
            $encode_ssd_value=htmlspecialchars($row['ssd_value'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $encode_interface=htmlspecialchars($row['interface'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $encode_type=htmlspecialchars($row['type'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $encode_readspeed=htmlspecialchars($row['readspeed'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $encode_writespeed=htmlspecialchars($row['writespeed'], ENT_QUOTES | ENT_HTML5, 'UTF-8');

            $switch_echo = <<< ECO
            <td class="ssd_value">{$encode_ssd_value}</td>
            <td class="interface">{$encode_interface}</td>
            <td class="type">{$encode_type}</td>
            <td class="readspeed">{$encode_readspeed}</td>
            <td class="writespeed">{$encode_writespeed}</td>
            ECO;

            echo $switch_echo;
            break;

          case 'ssd2':
            $encode_ssd_value=htmlspecialchars($row['ssd_value'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $encode_interface=htmlspecialchars($row['interface'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $encode_type=htmlspecialchars($row['type'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $encode_readspeed=htmlspecialchars($row['readspeed'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $encode_writespeed=htmlspecialchars($row['writespeed'], ENT_QUOTES | ENT_HTML5, 'UTF-8');

            $switch_echo = <<< ECO
            <td class="ssd_value">{$encode_ssd_value}</td>
            <td class="interface">{$encode_interface}</td>
            <td class="type">{$encode_type}</td>
            <td class="readspeed">{$encode_readspeed}</td>
            <td class="writespeed">{$encode_writespeed}</td>
            ECO;

            echo $switch_echo;
            break;

          case 'hdd':
            $encode_hdd_value=htmlspecialchars($row['hdd_value'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $encode_rpm=htmlspecialchars($row['rpm'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $encode_interface=htmlspecialchars($row['interface'], ENT_QUOTES | ENT_HTML5, 'UTF-8');

            $switch_echo = <<< ECO
            <td class="hdd_value">{$encode_hdd_value}</td>
            <td class="rpm">{$encode_rpm}</td>
            <td class="interface">{$encode_interface}</td>
            ECO;

            echo $switch_echo;
            break;

          case 'psu':
            $encode_psu_value=htmlspecialchars($row['psu_value'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $encode_efficiency=htmlspecialchars($row['efficiency'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $encode_formfactor=htmlspecialchars($row['formfactor'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
            if ($row['plug_in'] == 1) {
              $encode_plug_in = htmlspecialchars('あり');
            } else {
              $encode_plug_in = htmlspecialchars('なし');
            }

            $switch_echo = <<< ECO
            <td class="psu_value">{$encode_psu_value}</td>
            <td class="efficiency">{$encode_efficiency}</td>
            <td class="formfactor">{$encode_formfactor}</td>
            <td class="plug_in">{$encode_plug_in}</td>
            ECO;

            echo $switch_echo;
            break;

          case 'pccase':
            $encode_formfactor=htmlspecialchars($row['formfactor'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $encode_cpu_height=htmlspecialchars($row['cpu_height'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
            $encode_gpu_length=htmlspecialchars($row['gpu_length'], ENT_QUOTES | ENT_HTML5, 'UTF-8');

            $switch_echo = <<< ECO
            <td class="formfactor">{$encode_formfactor}</td>
            <td class="cpu_height">{$encode_cpu_height}</td>
            <td class="gpu_length">{$encode_gpu_length}</td>
            ECO;

            echo $switch_echo;
            break;

          case 'os':
            break;
        }

      }
      ?>
    </tbody>
  </table>
</body>

</html>