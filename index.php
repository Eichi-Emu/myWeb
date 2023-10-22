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
                //$genreUrl ='location.href='+$genre_arr[$i]+'.php';
                $price = NULL;
                $id = filter_input(INPUT_GET, $genre_arr[$i]);
                if($genre_arr[$i]=="ssd2")//ssd2のDBエラー回避、URL生成はそのまま配列を使用(これまたサイト側のURLに支障をきたさないようにするため)
                        {$genre_arr_i = "ssd";} else {$genre_arr_i=$genre_arr[$i];}
                $sql = "SELECT * FROM `" . $genre_arr_i . "` WHERE ID ='" . $id . "'LIMIT 1";
                $sqlQuery = $db->query($sql);
                $things = $sqlQuery->fetch(PDO::FETCH_ASSOC);
                $changeUrlTemp = $genre_arr[$i] . '.php?';
                $changeUrlTemp = str_replace("'", "", $changeUrlTemp);
                $changeUrlTemp = "'" . $changeUrlTemp;
                $urlQueryTemp = $query . "'";

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
                        $header_parts_description .= "GPU:". $things['chip'];
                        $header_totalPrice += $things['price'];
                        break;
                    default:
                        $header_totalPrice += $things['price'];
                    }

                }
                
            }
            if($header_flag){
            $header_description = $header_parts_description . "-----" . $header_totalPrice ."円";
            }else{$header_description = "簡単に自作パソコン見積もれるやつ";}

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
                    //echo(isset($_GET[$genre_arr[$i]]));
                    if (isset($_GET[$genre_arr[$i]])) {
                        $name = NULL;
                        $url = NULL;
                        //$genreUrl ='location.href='+$genre_arr[$i]+'.php';
                        $price = NULL;
                        $id = filter_input(INPUT_GET, $genre_arr[$i]);
                        if($genre_arr[$i]=="ssd2")//ssd2のDBエラー回避、URL生成はそのまま配列を使用(これまたサイト側のURLに支障をきたさないようにするため)
                        {
                            $genre_arr_i = "ssd";
                        }else{$genre_arr_i=$genre_arr[$i];}

                        $sql = "SELECT id,url,name,price FROM `" . $genre_arr_i . "` WHERE ID ='" . $id . "'LIMIT 1";
                        $sqlQuery = $db->query($sql);
                        $things = $sqlQuery->fetch(PDO::FETCH_ASSOC);
                        $changeUrlTemp = $genre_arr[$i] . '.php?';
                        $changeUrlTemp = str_replace("'", "", $changeUrlTemp);
                        $changeUrlTemp = "'" . $changeUrlTemp;
                        $urlQueryTemp = $query . "'";

                        //foreach($things as $test){echo($test);}
                        if ($things) {
                            //echo("cpu true");
                            $name = $things['name'];
                            $url = $things['url'];
                            $price = $things['price'];
                        }

                        echo ('<tr class = "' . $genre_arr[$i] . '">');
                        echo ('<td id=genre>' . $genre_name_arr[$i] . '</td>');

                        if (isset($query)) {
                            echo ('<td><button onclick = "location.href=' . $changeUrlTemp . $urlQueryTemp . '" class="btn btn-outline-primary">変更</button></td>');
                        } else {
                            echo ('<td><button onclick = "location.href=\'' . $genre_arr[$i] . '.php" class="btn btn-outline-primary">変更</button></td>');
                        }
                        echo ('<td><button onclick = ' . delete_query($genre_arr[$i]) . ' class="btn btn-outline-primary">削除</button></td>');


                        echo ('<td id="name"><a href =' . $url . ' target="_blank" rel="noopener noreferrer">' . $name . '</td>');
                        echo ('<td id="' . $genre_arr[$i] . 'price1" class="price">' . $price . '</td>');
                        echo ('<td id="' . $genre_arr[$i] . 'value" class="value"><select id="select-'. $i .'" class="form-control"><option value=1>1</option><option value=2>2</option></select></td>');
                        echo ('<td id="' . $genre_arr[$i] . 'price2" class="price"></td>');

                    } else {
                        echo ('<tr class = "' . $genre_arr[$i] . '">');
                        echo ('<td id=genre>' . $genre_arr[$i] . '</td>');
                        if (isset($query)) {
                            echo ('<td><button onclick = "location.href=\'' . $genre_arr[$i] . '.php?' . $query . '\'" class="btn btn-outline-primary">変更</button></td>');
                        } else {
                            echo ('<td><button onclick = "location.href=\'' . $genre_arr[$i] . '.php\'" class="btn btn-outline-primary">変更</button></td>');
                        }
                        echo ('<td><button onclick = ' . delete_query($genre_arr[$i]) . ' class="btn btn-outline-primary">削除</button></td>');
                        echo ('<td id="name"><a href = ></td>');
                        echo ('<td id="' . $genre_arr[$i] . 'price1" class="price">0</td>');
                        echo ('<td id="' . $genre_arr[$i] . 'value" class="value"><select id="select-'. $i .'" class="form-control"><option value=1>1</option><option value=2>2</option></select></td>');
                        echo ('<td id="' . $genre_arr[$i] . 'price2" class="price"></td>');
                    }
                }
            } catch (Exception $e) {
                echo ($e);
            }
            /*
            if(isset($_GET['cpuc']))
                {
                    $cpuc_name=NULL;
                    $cpuc_url=NULL;
                    $cpuc_price=NULL;

                    $cpucid = filter_input(INPUT_GET,'cpuc');
                    $cpucsql = "SELECT id,url,name,price FROM `cpuc` WHERE ID ='".$cpucid. "'LIMIT 1";

                    $cpucq = $db->query($cpucsql);
                    $cpuc = $cpucq ->fetch(PDO::FETCH_ASSOC);

                    if($cpuc)
                    {
                        //echo("cpu true");
                        $cpuc_name = $cpuc['name'];
                        $cpuc_url = $cpuc['url'];
                        $cpuc_price = $cpuc['price'];
                    }

                    echo('<tr class = "cpuc">');
                    echo('<td id=genre>クーラー</td>');
                    if(isset($query))
                    {
                        echo('<td><button onclick = "location.href=\'cpuc.php?'.$query.'\'" class="btn btn-outline-primary">変更</button></td>');
                    }else
                    {
                        echo('<td><button onclick = "location.href=\'cpuc.php\'" class="btn btn-outline-primary">変更</button></td>');
                    }
                    echo('<td><button onclick = '.delete_query("cpuc").' class="btn btn-outline-primary">削除</button></td>');
                    echo('<td id="name"><a href ='.$cpuc_url.' target="_blank" rel="noopener noreferrer">'.$cpuc_name.'</td>'); 
                    echo('<td id= "cpucprice1" class="price">'.$cpuc_price.'</td>');
                    echo('<td id="cpucvalue" class="value"><select id="select-2" class="form-control"><option value=1>1</option><option value=2>2</option></select></td>');
                    echo('<td id="cpucprice2" class="price"></td>');
                }else
                {
                    echo('<tr class = "cpuc">');
                    echo('<td id=genre>クーラー</td>'); 
                    if(isset($query))
                    {
                        echo('<td><button onclick = "location.href=\'cpuc.php?'.$query.'\'" class="btn btn-outline-primary">変更</button></td>');
                    }else
                    {
                        echo('<td><button onclick = "location.href=\'cpuc.php\'" class="btn btn-outline-primary">変更</button></td>');
                    }
                    echo('<td><button onclick = '.delete_query("cpuc").' class="btn btn-outline-primary">削除</button></td>');
                    echo ('<td id="name"><a href = ></td>');
                    echo ('<td id="cpucprice1" class="price"></td>');
                    echo('<td id="cpucvalue" class="value"><select id="select-2" class="form-control"><option value=1>1</option><option value=2>2</option></select></td>');
                    echo('<td id="cpucprice2" class="price"></td>'); 
                }
            if(isset($_GET['ram']))
                {
                    $ram_name=NULL;
                    $ram_url=NULL;
                    $ram_price=NULL;
                    $ramid = filter_input(INPUT_GET,'ram');
                    $ramsql = "SELECT id,url,name,price FROM `ram` WHERE ID ='".$ramid. "'LIMIT 1";
                    $ramq = $db->query($ramsql);
                    $ram = $ramq ->fetch(PDO::FETCH_ASSOC);

                    if($ram)
                    {
                        //echo("ram true");
                        $ram_name = $ram['name'];
                        $ram_url = $ram['url'];
                        $ram_price = $ram['price'];
                    }

                    echo('<tr class = "ram">');
                    echo('<td id=genre>メモリ</td>');
                    if(isset($query))
                    {
                        echo('<td><button onclick = "location.href=\'ram.php?'.$query.'\'" class="btn btn-outline-primary">変更</button></td>');
                    }else
                    {
                        echo('<td><button onclick = "location.href=\'ram.php\'" class="btn btn-outline-primary">変更</button></td>');
                    }
                    echo('<td><button onclick = '.delete_query("ram").' class="btn btn-outline-primary">削除</button></td>');
                    echo('<td id="name"><a href ='.$ram_url.' target="_blank" rel="noopener noreferrer">'.$ram_name.'</td>'); 
                    echo('<td id="ramprice1" class="price">'.$ram_price.'</td>');
                    echo('<td id="ramvalue" class="value"><select id="select-3" class="form-control"><option value=1>1</option><option value=2>2</option></select></td>');
                    echo('<td id="ramprice2" class="price"></td>');
                }else
                {
                    echo('<tr class = "ram">');
                    echo('<td id=genre>メモリ</td>');
                    if(isset($query))
                    {
                        echo('<td><button onclick = "location.href=\'ram.php?'.$query.'\'" class="btn btn-outline-primary">変更</button></td>');
                    }else
                    {
                        echo('<td><button onclick = "location.href=\'ram.php\'" class="btn btn-outline-primary">変更</button></td>');
                    }
                    echo('<td><button onclick = '.delete_query("ram").' class="btn btn-outline-primary">削除</button></td>'); 
                    echo ('<td id="name"><a href = ></td>');
                    echo ('<td id="ramprice1" class="price"></td>');
                    echo('<td id="ramvalue" class="value"><select id="select-3" class="form-control"><option value=1>1</option><option value=2>2</option></select></td>');
                    echo('<td id="ramprice2" class="price"></td>'); 
                }
            if(isset($_GET['mb']))
                {
                    $mb_name=NULL;
                    $mb_url=NULL;
                    $mb_price=NULL;
                    $mbid = filter_input(INPUT_GET,'mb');
                    $mbsql = "SELECT id,url,name,price FROM `mb` WHERE ID ='".$mbid. "'LIMIT 1";
                    $mbq = $db->query($mbsql);
                    $mb = $mbq ->fetch(PDO::FETCH_ASSOC);

                    if($mb)
                    {
                        //echo("mb true");
                        $mb_name = $mb['name'];
                        $mb_url = $mb['url'];
                        $mb_price = $mb['price'];
                    }

                    echo('<tr class = "mb">');
                    echo('<td id=genre>マザー</td>');
                    if(isset($query))
                    {
                        echo('<td><button onclick = "location.href=\'mb.php?'.$query.'\'" class="btn btn-outline-primary">変更</button></td>');
                    }else
                    {
                        echo('<td><button onclick = "location.href=\'mb.php\'" class="btn btn-outline-primary">変更</button></td>');
                    }
                    echo('<td><button onclick = '.delete_query("mb").' class="btn btn-outline-primary">削除</button></td>');
                    echo('<td id="name"><a href ='.$mb_url.' target="_blank" rel="noopener noreferrer">'.$mb_name.'</td>'); 
                    echo('<td id= "mbprice1" class="price">'.$mb_price.'</td>');
                    echo('<td id="mbvalue" class="value"><select id="select-4" class="form-control"><option value=1>1</option><option value=2>2</option></select></td>');
                    echo('<td id="mbprice2" class="price"></td>');
                }else
                {
                    echo('<tr class = "mb">');
                    echo('<td id=genre>マザボ</td>');
                    if(isset($query))
                    {
                        echo('<td><button onclick = "location.href=\'mb.php?'.$query.'\'" class="btn btn-outline-primary">変更</button></td>');
                    }else
                    {
                        echo('<td><button onclick = "location.href=\'mb.php\'" class="btn btn-outline-primary">変更</button></td>');
                    }
                    echo('<td><button onclick = '.delete_query("mb").' class="btn btn-outline-primary">削除</button></td>'); 
                    echo ('<td id="name"><a href = ></td>');
                    echo ('<td id="mbprice1" class="price"></td>');
                    echo('<td id="mbvalue" class="value"><select id="select-4" class="form-control"><option value=1>1</option><option value=2>2</option></select></td>');
                    echo('<td id="mbprice2" class="price"></td>'); 
                }
            if(isset($_GET['gpu']))
                {
                    $gpu_name=NULL;
                    $gpu_url=NULL;
                    $gpu_price=NULL;
                    $gpuid = filter_input(INPUT_GET,'gpu');
                    $gpusql = "SELECT id,url,name,price FROM `gpu` WHERE ID ='".$gpuid. "'LIMIT 1";
                    $gpuq = $db->query($gpusql);
                    $gpu = $gpuq ->fetch(PDO::FETCH_ASSOC);

                    if($gpu)
                    {
                        //echo("gpu true");
                        $gpu_name = $gpu['name'];
                        $gpu_url = $gpu['url'];
                        $gpu_price = $gpu['price'];
                    }

                    echo('<tr class = "gpu">');
                    echo('<td id=genre>グラボ</td>'); 
                    if(isset($query))
                    {
                        echo('<td><button onclick = "location.href=\'gpu.php?'.$query.'\'" class="btn btn-outline-primary">変更</button></td>');
                    }else
                    {
                        echo('<td><button onclick = "location.href=\'gpu.php\'" class="btn btn-outline-primary">変更</button></td>');
                    }
                    echo('<td><button onclick = '.delete_query("gpu").' class="btn btn-outline-primary">削除</button></td>');
                    echo('<td id="name"><a href ='.$gpu_url.' target="_blank" rel="noopener noreferrer">'.$gpu_name.'</td>'); 
                    echo('<td id= "gpuprice1" class="price">'.$gpu_price.'</td>');
                    echo('<td id="gpuvalue" class="value"><select id="select-5" class="form-control"><option value=1>1</option><option value=2>2</option></select></td>');
                    echo('<td id="gpuprice2" class="price"></td>'); 
                }else
                {
                    echo('<tr class = "gpu">');
                    echo('<td id=genre>グラボ</td>'); 
                    if(isset($query)){
                        echo('<td><button onclick = "location.href=\'gpu.php?'.$query.'\'" class="btn btn-outline-primary">変更</button></td>');
                    }else
                    {
                        echo('<td><button onclick = "location.href=\'gpu.php\'" class="btn btn-outline-primary">変更</button></td>');
                    }
                    echo('<td><button onclick = '.delete_query("gpu").' class="btn btn-outline-primary">削除</button></td>');
                    echo ('<td id="name"><a href = ></td>');
                    echo ('<td id="gpuprice1" class="price"></td>');
                    echo('<td id="gpuvalue" class="value"><select id="select-5" class="form-control"><option value=1>1</option><option value=2>2</option></select></td>');
                    echo('<td id="gpuprice2" class="price"></td>');  
                }
            if(isset($_GET['ssd']))
                {
                    $ssd_name=NULL;
                    $ssd_url=NULL;
                    $ssd_price=NULL;
                    $ssdid = filter_input(INPUT_GET,'ssd');
                    $ssdsql = "SELECT id,url,name,price FROM `ssd` WHERE ID ='".$ssdid. "'LIMIT 1";
                    $ssdq = $db->query($ssdsql);
                    $ssd = $ssdq ->fetch(PDO::FETCH_ASSOC);

                    if($ssd)
                    {
                        //echo("ssd true");
                        $ssd_name = $ssd['name'];
                        $ssd_url = $ssd['url'];
                        $ssd_price = $ssd['price'];
                    }

                    echo('<tr class = "ssd">');
                    echo('<td id=genre>SSD</td>'); 
                    if(isset($query))
                    {
                        echo('<td><button onclick = "location.href=\'ssd.php?'.$query.'\'" class="btn btn-outline-primary">変更</button></td>');
                    }else
                    {
                        echo('<td><button onclick = "location.href=\'ssd.php\'" class="btn btn-outline-primary">変更</button></td>');
                    }
                    echo('<td><button onclick = '.delete_query("ssd").' class="btn btn-outline-primary">削除</button></td>');
                    echo('<td id="name"><a href ='.$ssd_url.' target="_blank" rel="noopener noreferrer">'.$ssd_name.'</td>'); 
                    echo('<td id= "ssdprice1" class="price">'.$ssd_price.'</td>');
                    echo('<td id="ssdvalue" class="value"><select id="select-6" class="form-control"><option value=1>1</option><option value=2>2</option></select></td>');
                    echo('<td id="ssdprice2" class="price"></td>'); 
                }else
                {
                    echo('<tr class = "ssd">');
                    echo('<td id=genre>SSD</td>'); 
                    if(isset($query))
                    {
                        echo('<td><button onclick = "location.href=\'ssd.php?'.$query.'\'" class="btn btn-outline-primary">変更</button></td>');
                    }else
                    {
                        echo('<td><button onclick = "location.href=\'ssd.php\'" class="btn btn-outline-primary">変更</button></td>');
                    }
                    echo('<td><button onclick = '.delete_query("ssd").' class="btn btn-outline-primary">削除</button></td>');
                    echo ('<td id="name"><a href = ></td>');
                    echo ('<td id="ssdprice1" class="price"></td>');
                    echo('<td id="ssdvalue" class="value"><select id="select-6" class="form-control"><option value=1>1</option><option value=2>2</option></select></td>');
                    echo('<td id="ssdprice2" class="price"></td>'); 
                }
            if(isset($_GET['ssd2']))
                {
                    $ssd2_name=NULL;
                    $ssd2_url=NULL;
                    $ssd2_price=NULL;
                    $ssd2id = filter_input(INPUT_GET,'ssd2');
                    $ssd2sql = "SELECT id,url,name,price FROM `ssd` WHERE ID ='".$ssd2id. "'LIMIT 1";
                    $ssd2q = $db->query($ssd2sql);
                    $ssd2 = $ssd2q ->fetch(PDO::FETCH_ASSOC);

                    if($ssd2)
                    {
                        //echo("ssd true");
                        $ssd2_name = $ssd2['name'];
                        $ssd2_url = $ssd2['url'];
                        $ssd2_price = $ssd2['price'];
                    }

                    echo('<tr class = "ssd2">');
                    echo('<td id=genre>SSD-2</td>'); 
                    if(isset($query))
                    {
                        echo('<td><button onclick = "location.href=\'ssd2.php?'.$query.'\'" class="btn btn-outline-primary">変更</button></td>');
                    }else
                    {
                        echo('<td><button onclick = "location.href=\'ssd2.php\'" class="btn btn-outline-primary">変更</button></td>');
                    }
                    echo('<td><button onclick = '.delete_query("ssd2").' class="btn btn-outline-primary">削除</button></td>');
                    echo('<td id="name"><a href ='.$ssd2_url.' target="_blank" rel="noopener noreferrer">'.$ssd2_name.'</td>'); 
                    echo('<td id= "ssd2price1" class="price">'.$ssd2_price.'</td>');
                    echo('<td id="ssd2value" class="value"><select id="select-7" class="form-control"><option value=1>1</option><option value=2>2</option></select></td>');
                    echo('<td id="ssd2price2" class="price"></td>'); 
                }else
                {
                    echo('<tr class = "ssd2">');
                    echo('<td id=genre>SSD-2</td>'); 
                    if(isset($query))
                    {
                        echo('<td><button onclick = "location.href=\'ssd2.php?'.$query.'\'" class="btn btn-outline-primary">変更</button></td>');
                    }else
                    {
                        echo('<td><button onclick = "location.href=\'ssd2.php\'" class="btn btn-outline-primary">変更</button></td>');
                    }
                    echo('<td><button onclick = '.delete_query("ssd2").' class="btn btn-outline-primary">削除</button></td>');
                    echo ('<td id="name"><a href = ></td>');
                    echo ('<td id="ssd2price1" class="price"></td>');
                    echo('<td id="ssd2value" class="value"><select id="select-7" class="form-control"><option value=1>1</option><option value=2>2</option></select></td>');
                    echo('<td id="ssd2price2" class="price"></td>'); 
                }
            if(isset($_GET['hdd']))
                {
                    $hdd_name=NULL;
                    $hdd_url=NULL;
                    $hdd_price=NULL;
                    $hddid = filter_input(INPUT_GET,'hdd');
                    $hddsql = "SELECT id,url,name,price FROM `hdd` WHERE ID ='".$hddid. "'LIMIT 1";
                    $hddq = $db->query($hddsql);
                    $hdd = $hddq ->fetch(PDO::FETCH_ASSOC);

                    if($hdd)
                    {
                        //echo("hdd true");
                        $hdd_name = $hdd['name'];
                        $hdd_url = $hdd['url'];
                        $hdd_price = $hdd['price'];
                    }

                    echo('<tr class = "hdd">');
                    echo('<td id=genre>HDD</td>'); 
                    if(isset($query))
                    {
                        echo('<td><button onclick = "location.href=\'hdd.php?'.$query.'\'" class="btn btn-outline-primary">変更</button></td>');
                    }else
                    {
                        echo('<td><button onclick = "location.href=\'hdd.php\'" class="btn btn-outline-primary">変更</button></td>');
                    }
                    echo('<td><button onclick = '.delete_query("hdd").' class="btn btn-outline-primary">削除</button></td>');
                    echo('<td id="name"><a href ='.$hdd_url.' target="_blank" rel="noopener noreferrer">'.$hdd_name.'</td>'); 
                    echo('<td id= "hddprice1" class="price">'.$hdd_price.'</td>');
                    echo('<td id="hddvalue" class="value"><select id="select-8" class="form-control"><option value=1>1</option><option value=2>2</option></select></td>');
                    echo('<td id="hddprice2" class="price"></td>'); 
                }else
                {
                    echo('<tr class = "hdd">');
                    echo('<td id=genre>HDD</td>'); 
                    if(isset($query))
                    {
                        echo('<td><button onclick = "location.href=\'hdd.php?'.$query.'\'" class="btn btn-outline-primary">変更</button></td>');
                    }else
                    {
                        echo('<td><button onclick = "location.href=\'hdd.php\'" class="btn btn-outline-primary">変更</button></td>');
                    }
                    echo('<td><button onclick = '.delete_query("hdd").' class="btn btn-outline-primary">削除</button></td>');
                    echo ('<td id="name"><a href = ></td>');
                    echo ('<td id="hddprice1" class="price"></td>');
                    echo('<td id="hddvalue" class="value"><select id="select-8" class="form-control"><option value=1>1</option><option value=2>2</option></select></td>');
                    echo('<td id="hddprice2" class="price"></td>');  
                }
            if(isset($_GET['psu']))
                {
                    $psu_name=NULL;
                    $psu_url=NULL;
                    $psu_price=NULL;
                    $psuid = filter_input(INPUT_GET,'psu');
                    $psusql = "SELECT id,url,name,price FROM `psu` WHERE ID ='".$psuid. "'LIMIT 1";
                    $psuq = $db->query($psusql);
                    $psu = $psuq ->fetch(PDO::FETCH_ASSOC);

                    if($psu)
                    {
                        //echo("psu true");
                        $psu_name = $psu['name'];
                        $psu_url = $psu['url'];
                        $psu_price = $psu['price'];
                    }

                    echo('<tr class = "psu">');
                    echo('<td id=genre>電源</td>'); 
                    if(isset($query))
                    {
                        echo('<td><button onclick = "location.href=\'psu.php?'.$query.'\'" class="btn btn-outline-primary">変更</button></td>');
                    }else
                    {
                        echo('<td><button onclick = "location.href=\'psu.php\'" class="btn btn-outline-primary">変更</button></td>');
                    }
                    echo('<td><button onclick = '.delete_query("psu").' class="btn btn-outline-primary">削除</button></td>');
                    echo('<td id="name"><a href ='.$psu_url.' target="_blank" rel="noopener noreferrer">'.$psu_name.'</td>'); 
                    echo('<td id= "psuprice1" class="price">'.$psu_price.'</td>');
                    echo('<td id="psuvalue" class="value"><select id="select-9" class="form-control"><option value=1>1</option><option value=2>2</option></select></td>');
                    echo('<td id="psuprice2" class="price"></td>'); 
                }else
                {
                    echo('<tr class = "psu">');
                    echo('<td id=genre>電源</td>'); 
                    if(isset($query))
                    {
                        echo('<td><button onclick = "location.href=\'psu.php?'.$query.'\'" class="btn btn-outline-primary">変更</button></td>');
                    }else
                    {
                        echo('<td><button onclick = "location.href=\'psu.php\'" class="btn btn-outline-primary">変更</button></td>');
                    }
                    echo('<td><button onclick = '.delete_query("psu").' class="btn btn-outline-primary">削除</button></td>');
                    echo ('<td id="name"><a href = ></td>');
                    echo ('<td id="psuprice1" class="price"></td>');
                    echo('<td id="psuvalue" class="value"><select id="select-9" class="form-control"><option value=1>1</option><option value=2>2</option></select></td>');
                    echo('<td id="psuprice2" class="price"></td>');  
                }
            if(isset($_GET['pccase']))
                {
                    $pccase_name=NULL;
                    $pccase_url=NULL;
                    $pccase_price=NULL;
                    $pccaseid = filter_input(INPUT_GET,'pccase');
                    $pccasesql = "SELECT id,url,name,price FROM `pccase` WHERE ID ='".$pccaseid. "'LIMIT 1";
                    $pccaseq = $db->query($pccasesql);
                    $pccase = $pccaseq ->fetch(PDO::FETCH_ASSOC);

                    if($pccase)
                    {
                        //echo("pccase true");
                        $pccase_name = $pccase['name'];
                        $pccase_url = $pccase['url'];
                        $pccase_price = $pccase['price'];
                    }

                    echo('<tr class = "pccase">');
                    echo('<td id=genre>ケース</td>'); 
                    if(isset($query))
                    {
                        echo('<td><button onclick = "location.href=\'pccase.php?'.$query.'\'" class="btn btn-outline-primary">変更</button></td>');
                    }else
                    {
                        echo('<td><button onclick = "location.href=\'pccase.php\'" class="btn btn-outline-primary">変更</button></td>');
                    }
                    echo('<td><button onclick = '.delete_query("pccase").' class="btn btn-outline-primary">削除</button></td>');
                    echo('<td id="name"><a href ='.$pccase_url.' target="_blank" rel="noopener noreferrer">'.$pccase_name.'</td>'); 
                    echo('<td id= "pccaseprice1" class="price">'.$pccase_price.'</td>');
                    echo('<td id="pccasevalue" class="value"><select id="select-10" class="form-control"><option value=1>1</option><option value=2>2</option></select></td>');
                    echo('<td id="pccaseprice2" class="price"></td>'); 
                }else
                {
                    echo('<tr class = "pccase">');
                    echo('<td id=genre>ケース</td>'); 
                    if(isset($query))
                    {
                        echo('<td><button onclick = "location.href=\'pccase.php?'.$query.'\'" class="btn btn-outline-primary">変更</button></td>');
                    }else
                    {
                        echo('<td><button onclick = "location.href=\'pccase.php\'" class="btn btn-outline-primary">変更</button></td>');
                    }
                    echo('<td><button onclick = '.delete_query("pccase").' class="btn btn-outline-primary">削除</button></td>');
                    echo ('<td id="name"><a href = ></td>');
                    echo ('<td id="pccaseprice1" class="price"></td>');
                    echo('<td id="pccasevalue" class="value"><select id="select-10" class="form-control"><option value=1>1</option><option value=2>2</option></select></td>');
                    echo('<td id="pccaseprice2" class="price"></td>');  
                }
            if(isset($_GET['os']))
                {
                    $os_name=NULL;
                    $os_url=NULL;
                    $os_price=NULL;
                    $osid = filter_input(INPUT_GET,'os');
                    $ossql = "SELECT id,url,name,price FROM `os` WHERE ID ='".$osid. "'LIMIT 1";
                    $osq = $db->query($ossql);
                    $os = $osq ->fetch(PDO::FETCH_ASSOC);

                    if($os)
                    {
                        //echo("pccase true");
                        $os_name = $os['name'];
                        $os_url = $os['url'];
                        $os_price = $os['price'];
                    }

                    echo('<tr class = "os">');
                    echo('<td id=genre>OS</td>'); 
                    if(isset($query))
                    {
                        echo('<td><button onclick = "location.href=\'os.php?'.$query.'\'" class="btn btn-outline-primary">変更</button></td>');
                    }else
                    {
                        echo('<td><button onclick = "location.href=\'os.php\'" class="btn btn-outline-primary">変更</button></td>');
                    }
                    echo('<td><button onclick = '.delete_query("os").' class="btn btn-outline-primary">削除</button></td>');
                    echo('<td id="name"><a href ='.$os_url.' target="_blank" rel="noopener noreferrer">'.$os_name.'</td>'); 
                    echo('<td id= "osprice1" class="price">'.$os_price.'</td>');
                    echo('<td id="osvalue" class="value"><select id="select-11" class="form-control"><option value=1>1</option><option value=2>2</option></select></td>');
                    echo('<td id="osprice2" class="price"></td>'); 
                }else
                {
                    echo('<tr class = "os">');
                    echo('<td id=genre>OS</td>'); 
                    if(isset($query))
                    {
                        echo('<td><button onclick = "location.href=\'os.php?'.$query.'\'" class="btn btn-outline-primary">変更</button></td>');
                    }else
                    {
                        echo('<td><button onclick = "location.href=\'os.php\'" class="btn btn-outline-primary">変更</button></td>');
                    }
                    echo('<td><button onclick = '.delete_query("os").' class="btn btn-outline-primary">削除</button></td>');
                    echo ('<td id="name"><a href = ></td>');
                    echo ('<td id="osprice1" class="price"></td>'); 
                    echo('<td id="osvalue" class="value"><select id="select-11" class="form-control"><option value=1>1</option><option value=2>2</option></select></td>');
                    echo('<td id="osprice2" class="price"></td>'); 
                }
            */
            ?>
            <script>
                jQuery(function ($) {
                    total();
                    $('#noti_frame')[0].contentDocument.location.reload(true);
                    $('.form-control').change(function () {
                        total();
                    });

                    function total() {
                        console.log("kugiri");
                        var content, content_out, selector, Fprice, sum, Ptotal;
                        var temp, temp2, total;
                        var genre = ["cpu", "cpuc", "ram", "mb", "gpu", "ssd", "ssd2", "hdd", "psu", "pccase", "os"];
                        for (let i = 0; i < 11; i++) {


                            temp = $("#" + genre[i] + "price1").text();
                            //console.log(temp);
                            if (!isNaN(temp)) {
                                temp = "¥" + Number(temp).toLocaleString();
                                //console.log(temp);
                                $("#" + genre[i] + "price1").text(temp);
                            }


                            if (i === 0) { total = 0; console.log("initialization"); };

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
                            console.log(content+" selector:"+selector);
                            console.log("Fprice:" + typeof Fprice);
                            console.log(genre[i], Fprice, Ptotal, Number(sum));//デバッグ

                            total += Ptotal;//合計計算用　あとでつかう
                            temp2 = "¥" + Ptotal.toLocaleString();//書式直し
                            temp2 = String(temp2);
                            $("#" + genre[i] + "price2").html(temp2);//代入
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

        寄付用のPaypalリンクおいておきます<div class='donate'><a href='https://paypal.me/eichiemu' target="_blank"
                rel="noopener noreferrer">おふせ(Paypal)</a></div><br>
        匿名がいい人はこちらから。金額は適当にどうぞ。メアドは連絡先のを入れてください。<div class='donate'><a
                href='https://www.amazon.co.jp/dp/B004N3APGO/ref=s9_acsd_al_bw_c2_x_0_t?pf_rd_m=A3P5ROKL5A1OLE&pf_rd_s=merchandised-search-18&pf_rd_r=HTTTRCNAHN61DYE139T4&pf_rd_t=101&pf_rd_p=37ab5c0c-3d6f-4466-847b-03b0286ca49e&pf_rd_i=3131877051'
                target="_blank" rel="noopener noreferrer">おふせ(amazon)</a></div><br>

        google ADの認可おりね～～～～～(ADつけるかもしれんし付けんかもしれん(めんどいし))<br><br><br>
    </div>

    <div class="notification">
        <iframe src="note.html" frameboader="0" id="noti_frame"></iframe>
    </div>
</body>

</html>