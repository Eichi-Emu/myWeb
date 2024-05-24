<?php
require("log.php");
$log = Logger::getInstance();
$log->error('error log.');
$log->warn('warn log.');
$log->info('info log.');
$log->debug('debug log.');
try {
    $db = new PDO('mysql:host=localhost;dbname=kakaku;charset=utf8', 'user', 'xX114514');
    //echo "接続OK！";
} catch (PDOException $e) {
    echo 'このメッセージが見えてしまったそこの貴方、こちらへ連絡を→twitter:@emu_eichi' . $e->getMessage();
}

?>
<?php
function url_param_change($par = array(), $op = 0)
{
    $url = parse_url($_SERVER["REQUEST_URI"]);
    if (isset($url["query"]))
        parse_str($url["query"], $query);
    else
        $query = array();
    foreach ($par as $key => $value) {
        if ($key && is_null($value))
            unset($query[$key]);
        else
            $query[$key] = $value;
    }
    $query = str_replace("=&", "&", http_build_query($query));
    $query = preg_replace("/=$/", "", $query);
    return $query ? (!$op ? "?" : "") . htmlspecialchars($query, ENT_QUOTES) : "";
}

function delete_query($genre)
{
    $do = url_param_change(array($genre => null));
    $return = 'location.href=\'index.php' . $do . '\'';
    return $return;
}

$genre_arr = array('cpu', 'cpuc', 'ram', 'mb', 'gpu', 'ssd', 'ssd2', 'hdd', 'psu', 'pccase', 'os');
$genre_name_arr = array('CPU', 'CPUクーラー', 'メモリ', 'マザー', 'GPU', 'メインSSD', 'サブSSD', 'HDD', '電源', 'ケース', 'OS');
$allUrl = $_SERVER['REQUEST_URI'];
$query = NULL;
$header_totalPrice = 0;
$header_flag = false;

if (strpos($allUrl, "?")) {
    $temp = explode("?", $allUrl);
    $query = $temp[1];
}
for ($i = 0; $i < count($genre_arr); $i++) {


    if (isset($_GET[$genre_arr[$i]])) {
        $header_flag = true;
        $name = NULL;
        $url = NULL;
        $price = NULL;
        $id = filter_input(INPUT_GET, $genre_arr[$i]);
        if ($genre_arr[$i] == "ssd2") //ssd2のDBエラー回避、URL生成はそのまま配列を使用(これまたサイト側のURLに支障をきたさないようにするため)
        {
            $genre_arr_i = "ssd";
        } else {
            $genre_arr_i = $genre_arr[$i];
        }
        $sql = "SELECT * FROM `" . $genre_arr_i . "` WHERE ID ='" . $id . "'LIMIT 1";
        $sqlQuery = $db->query($sql);
        $things = $sqlQuery->fetch(PDO::FETCH_ASSOC);

        //foreach($things as $test){echo($test);}
        switch ($genre_arr[$i]) {
            case "cpu":
                $header_parts_description .= "CPU:" . $things['name'] . " - ";
                $header_totalPrice += $things['price'];
                break;
            case "ram":
                $header_parts_description .= "RAM:" . $things['gen'] . " " . $things['ram_value'] . "GB - ";
                $header_totalPrice += $things['price'];
                break;
            case "gpu":
                $header_parts_description .= "GPU:" . $things['chip'];
                $header_totalPrice += $things['price'];
                break;
            default:
                $header_totalPrice += $things['price'];
        }
    }
}
if ($header_flag) {
    $header_description = $header_parts_description . "-----" . $header_totalPrice . "円";
} else {
    $header_description = "簡単に自作パソコン見積もれるやつ";
}

echo <<<default_str
            <!DOCTYPE html>
            <html lang="ja">

            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="robots" content="index,follow">
                <meta name="googlebot" content="index,follow">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta name="description" content="自作パソコンの見積もりが簡単にできるサイトです。URLのコピーで簡単に共有ができ、使い勝手の良いサイトです。" />
                <meta name="keywords" content="自作PC,自作パソコン,パソコン,PC,自作パソコン見積もり,自作PC見積もり,見積もり" />
                <meta property="og:title" content="しんぷる見積もりくん" />
                <meta property="og:description" content=" $header_description " />
                <meta property="og:url" content="https://www.azarasi.net/" />
                <meta property="og:type" content="website">
                <meta property="og:image" content="https://www.azarasi.net/samune.png">
                <meta property="og:site_name" content="しんぷる見積もりくん" />
                <meta property="og:locale" content="ja_JP" />
                <meta name="twitter:card" content="summary_large_image">
                <meta name="viewport" content="width=device-width,initial-scale=1">
                <title>しんぷる見積もりくん</title>
                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4848435534974553"
                    crossorigin="anonymous"></script>
                <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
                    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

                <style>
                    #table th {
                        background-color: deepskyblue;
                    }

                    #genre {
                        text-align: center;
                    }

                    .price {
                        text-align: right;
                    }

                    .notification {
                        position: relative;
                        margin-left: auto;
                        margin-right: auto;
                        width: 70%;
                        padding-top: 56.25%;
                        overflow: auto;
                        -webkit-overflow-scrolling: touch;
                    }

                    .notification iframe {
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 50%;
                        display: block;
                    }

                    .about {
                        border: 2px solid #d0d0d0;
                        width: 70%;
                        margin-left: auto;
                        margin-right: auto;
                    }

                    .donate {
                        width: 200px;
                        height: 50px;
                        line-height: 50px;
                    }

                    .donate a {
                        display: block;
                        width: 100%;
                        height: 100%;
                        text-decoration: none;
                        background: #0099FF;
                        text-align: center;
                        color: #FFFFFF;
                        font-size: 20px;
                        font-weight: bold;
                        border-radius: 10px;
                        -webkit-border-radius: 10px;
                        -moz-border-radius: 10px;
                        box-shadow: 5px 5px 0px 0px #DEDEDE;
                    }

                    .donate a:hover {
                        background: #0099FF;
                        color: #FFFC00;
                        margin-left: 5px;
                        margin-top: 5px;
                        box-shadow: none;
                    }
                    .configCopy {
                        
                        width: 100px;
                        height: 50px;
                        line-height: 50px;
                        display: block;
                        margin: auto;
                        width: 50%;
                        height: 100%;
                        text-decoration: none;
                        background: #0099FF;
                        text-align: center;
                        color: #FFFFFF;
                        font-size: 20px;
                        font-weight: bold;
                        border-radius: 10px;
                        -webkit-border-radius: 10px;
                        -moz-border-radius: 10px;
                        box-shadow: 5px 5px 0px 0px #DEDEDE;
                    }
                    .configCopy:hover {
                        background: #0099FF;
                        color: #FFFC00;
                        box-shadow: none;
                    }
                    .loginbtn{
                        width:200px;
                        height:50px;
                        line-height:50px;
                    }
                    .loginbtn a{
                        display:block;
                        width:100%;
                        height:100%;
                        text-decoration: none;
                        background:#29CF1C;
                        text-align:center;
                        color:#FFFFFF;
                        font-size:20px;
                        font-weight:bold;
                        border-radius:10px;
                        -webkit-border-radius:10px;
                        -moz-border-radius:10px;
                        box-shadow:5px 5px 0px 0px #DEDEDE ;
                    }
                    .loginbtn a:hover{
                        background:#29CF1C;
                        color:#FFFC00;
                        margin-left:5px;
                        margin-top:5px;
                        box-shadow:none;
                    }
                </style>
            </head>

            <body>
                <div align="center">
                    <h1>しんぷるみつもりくん</h1>
                    <p>価格comの情報で見積もりをつくります。</p>
                </div>
                <table align="center" border="1" cellpadding="5" id="table">
                    <thead>
                        <tr>
                            <th id="button">ジャンル</th>
                            <th id="button">　　</th>
                            <th id="genre">　　</th>
                            <th id="name">商品名</th>
                            <th id="kakaku1">小計</th>
                            <th id="sum">個数</th>
                            <th id="kakaku2">合計</th>
                        </tr>
                    </thead>
                    <tbody>
            default_str;

try {
    for ($i = 0; $i < count($genre_arr); $i++) {
        if (isset($_GET[$genre_arr[$i]])) {
            $name = NULL;
            $url = NULL;
            $price = NULL;
            $id = filter_input(INPUT_GET, $genre_arr[$i]);
            if ($genre_arr[$i] == "ssd2") //ssd2のDBエラー回避、URL生成はそのまま配列を使用(これまたサイト側のURLに支障をきたさないようにするため)
            {
                $genre_arr_i = "ssd";
            } else {
                $genre_arr_i = $genre_arr[$i];
            }

            $sql = "SELECT id,url,name,price FROM `" . $genre_arr_i . "` WHERE ID ='" . $id . "'LIMIT 1";
            $sqlQuery = $db->query($sql);
            $things = $sqlQuery->fetch(PDO::FETCH_ASSOC);
            $changeUrlTemp = 'parts.php?genre='.$genre_arr[$i]."&";
            $changeUrlTemp = str_replace("'", "", $changeUrlTemp);
            $changeUrlTemp = "'" . $changeUrlTemp;
            $urlQueryTemp = $query . "'";

            if ($things) {
                $name = $things['name'];
                $url = $things['url'];
                $price = $things['price'];
            }

            echo ('<tr class = "' . $genre_arr[$i] . '">');
            echo ('<td id=genre>' . $genre_name_arr[$i] . '</td>');

            if (isset($query)) {
                echo ('<td><button onclick = "location.href=' . $changeUrlTemp . $urlQueryTemp . '" class="btn btn-outline-primary">変更</button></td>');
            } else {
                echo ('<td><button onclick = "location.href=\'parts.php?genre=' . $genre_arr[$i] ."&". '" class="btn btn-outline-primary">変更</button></td>');
            }
            echo ('<td><button onclick = ' . delete_query($genre_arr[$i]) . ' class="btn btn-outline-primary">削除</button></td>');
            echo ('<td id="' . $genre_arr[$i] . 'name"><a href =' . $url . ' target="_blank" rel="noopener noreferrer">' . $name . '</td>');
            echo ('<td id="' . $genre_arr[$i] . 'price1" class="price">' . $price . '</td>');
            echo ('<td id="' . $genre_arr[$i] . 'value" class="value"><select id="select-' . $i . '" class="form-control"><option value=1>1</option><option value=2>2</option></select></td>');
            echo ('<td id="' . $genre_arr[$i] . 'price2" class="price"></td>');
        } else {
            echo ('<tr class = "' . $genre_arr[$i] . '">');
            echo ('<td id=genre>' . $genre_name_arr[$i] . '</td>');
            if (isset($query)) {
                echo ('<td><button onclick = "location.href=\'parts.php?genre=' . $genre_arr[$i] ."&". $query . '\'" class="btn btn-outline-primary">変更</button></td>');
            } else {
                echo ('<td><button onclick = "location.href=\'parts.php?genre=' . $genre_arr[$i] . '\'" class="btn btn-outline-primary">変更</button></td>');
            }
            echo ('<td><button onclick = ' . delete_query($genre_arr[$i]) . ' class="btn btn-outline-primary">削除</button></td>');
            echo ('<td id="' . $genre_arr[$i] . 'name"><a href = ></td>');
            echo ('<td id="' . $genre_arr[$i] . 'price1" class="price">0</td>');
            echo ('<td id="' . $genre_arr[$i] . 'value" class="value"><select id="select-' . $i . '" class="form-control"><option value=1>1</option><option value=2>2</option></select></td>');
            echo ('<td id="' . $genre_arr[$i] . 'price2" class="price"></td>');
        }
    }
} catch (Exception $e) {
    echo ($e);
}
?>
<script>
    jQuery(function($) {

        var genre = ["cpu", "cpuc", "ram", "mb", "gpu", "ssd", "ssd2", "hdd", "psu", "pccase", "os"];
        var genre_name = ["CPU", "CPUクーラー", "メモリ", "マザー", "GPU", "メインSSD", "サブSSD", "HDD", "電源", "ケース", "OS"]
        total();
        copyBoard();
        $('#noti_frame')[0].contentDocument.location.reload(true);
        $('.form-control').change(function() {
            total();
            copyBoard();
        });

        function copyBoard() {
            var configuration_content = "";
            var singlePartPrice;
            var totalPartPrice = 0;
            var partValue = "";
            var partsValue = "";

            for (let i = 0; i < 11; i++) {
                //console.log($('#'+genre[i]+'name').text());
                configuration_content += genre_name[i] + ":" + $('#' + genre[i] + 'name').text();
                singlePartPrice = $('#' + genre[i] + 'price1').text();
                singlePartPrice = singlePartPrice.replace("¥", "");
                singlePartPrice = singlePartPrice.replace(",", "");
                singlePartPrice = singlePartPrice.replace(" ", "");
                singlePartPrice = Number(singlePartPrice);
                partValue = Number($('#select-' + i).val());
                //console.log("partvalue-" + partValue);
                totalPartPrice = singlePartPrice * partValue;

                //console.log(totalPartPrice);
                partsValue = " x" + partValue + "  ¥" + totalPartPrice.toLocaleString() + "\n";
                configuration_content += partsValue;
            }
            configuration_content += "\n合計金額:" + $("#totalMoney").text() + "\n \npowered by https://azarasi.net";
            //console.log("textarea_test:",configuration_content);
            $("#configurationForm").val(configuration_content);
        }


        $('#configCopy').click(function() {
            configuration_inbox_content = $('#configurationForm').val();
            navigator.clipboard.writeText(configuration_inbox_content);
        })

        function total() {
            console.log("kugiri");
            var content, content_out, selector, Fprice, sum, Ptotal;
            var temp, temp2, total;
            for (let i = 0; i < 11; i++) {


                temp = $("#" + genre[i] + "price1").text();
                //console.log(temp);
                if (!isNaN(temp)) {
                    temp = "¥" + Number(temp).toLocaleString();
                    //console.log(temp);
                    $("#" + genre[i] + "price1").text(temp);
                }


                if (i === 0) {
                    total = 0;
                    //console.log("initialization");
                };

                //各種値取得(上が小計、下個数)
                content = $("#" + genre[i] + "price1").text();
                sum = $("#select-" + [i]).val();
                console.log(genre[i]);
                //selector="#"+genre[i]+"price1";
                //temp=$("#select-"+[i+1]);
                console.log("content:" + content);
                //console.log(temp);
                console.log("sel:" + sum);



                //値変換(価格の値に含まれた不要なものを排除してint化)→後計算
                Fprice = content.replace("¥", "");
                Fprice = Fprice.replace(",", "");
                Fprice = Fprice.replace(" ", "");
                Fprice = Number(Fprice);
                Ptotal = Fprice * Number(sum);
                //console.log(content + " selector:" + selector);
                //console.log("Fprice:" + typeof Fprice);
                //console.log(genre[i], Fprice, Ptotal, Number(sum)); //デバッグ

                total += Ptotal; //合計計算用　あとでつかう
                temp2 = "¥" + Ptotal.toLocaleString(); //書式直し
                temp2 = String(temp2);
                $("#" + genre[i] + "price2").html(temp2); //代入
                //console.log("temp type:"+typeof temp2+"temp val:"+temp2);
                //console.log($("#"+genre[i]+"price2"));

            }
            total = "<b>¥" + total.toLocaleString() + "</b>";
            $("#totalMoney").html(total);
            return 0;
        };
    });
</script>
<tr>
    <td colspan=6>合計金額</td>
    <td id="totalMoney" class="price"></td>
    </tbody>
    </table>
    <br>
    <div style="text-align: center;">
        <textarea readonly rows="15" cols="100" id="configurationForm" style=""></textarea>
        <button id="configCopy" class="configCopy">構成内容コピー</button>
    </div>
    <div class="about">
        <h2>About</h2>
        シンプルな自作パソコン用見積もりサイトです。URLをコピーすれば共有できます。(長いのは追々どうにかします)<br>
        価格comの最安値を出します。商品名から該当商品の価格comページに飛べます。<br><br>

        初心者が作ったサイトなので粗が多いです。温かい目で見守ってください。<br><br>

        何かありましたら管理人までご連絡ください。<br><br>
        ・ mail: eichi.emu2002@gmail.com<br>
        ・ Twitter: @emu_eichi<br>
        ・ discord: eichiemu<br>
        ・ Twitterが一番レスポンス早いです。<br><br>

        寄付用のPaypalリンクおいておきます<div class='donate'><a href='https://paypal.me/eichiemu' target="_blank" rel="noopener noreferrer">おふせ(Paypal)</a></div><br>
        匿名がいい人はこちらから。金額は適当にどうぞ。メアドは連絡先のを入れてください。<div class='donate'><a href='https://www.amazon.co.jp/dp/B004N3APGO/ref=s9_acsd_al_bw_c2_x_0_t?pf_rd_m=A3P5ROKL5A1OLE&pf_rd_s=merchandised-search-18&pf_rd_r=HTTTRCNAHN61DYE139T4&pf_rd_t=101&pf_rd_p=37ab5c0c-3d6f-4466-847b-03b0286ca49e&pf_rd_i=3131877051' target="_blank" rel="noopener noreferrer">おふせ(amazon)</a></div><br>

        google ADの認可がおりぬ。(ADは多分つけるけどGoogleは除外かなぁ)<br><br><br>
        特定の方向け↓<div class='loginbtn'><a href='profile/profile_login.php'target="_blank" rel="noopener noreferrer">ログイン</a></div>
    </div>

    <div class="notification">
        <iframe src="note.html" frameboader="0" id="noti_frame"></iframe>
    </div>
    </body>

    </html>