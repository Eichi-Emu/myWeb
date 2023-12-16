<?php

function parts_header($genre)
{
  switch ($genre) {
    case "cpu":
      $str = <<<DOM
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>cpu</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
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
                        "インテル": function(e, n, f, i, \$r, c, data) {
                          return /インテル/.test(e);
                        },
                        "AMD": function(e, n, f, i, \$r, c, data) {
                          return /AMD/.test(e);
                        }
                      },
                      6: {
                        "--intel--": function(e, n, f, i, \$r, c, data) {
                          return /LGA1700|LGA1200|LGA1151|LGA2066|LGA3647|LGA4189|LGA4677|LGA775|LGA1150|LGA1156|LGA2011/.test(e);
                        },
                        "LGA1700": function(e, n, f, i, \$r, c, data) {
                          return /LGA1700/.test(e);
                        },
                        "LGA1200": function(e, n, f, i, \$r, c, data) {
                          return /LGA1200/.test(e);
                        },
                        "LGA4677": function(e, n, f, i, \$r, c, data) {
                          return /LGA4677/.test(e);
                        },
                        "LGA4189": function(e, n, f, i, \$r, c, data) {
                          return /LGA4189/.test(e);
                        },
                        "LGA1151": function(e, n, f, i, \$r, c, data) {
                          return /LGA1151/.test(e);
                        },
                        "LGA1150": function(e, n, f, i, \$r, c, data) {
                          return /LGA1150/.test(e);
                        },
                        "LGA1156": function(e, n, f, i, \$r, c, data) {
                          return /LGA1156/.test(e);
                        },
                        "LGA775": function(e, n, f, i, \$r, c, data) {
                          return /LGA775/.test(e);
                        },
                        "LGA2066": function(e, n, f, i, \$r, c, data) {
                          return /LGA2066/.test(e);
                        },
                        "LGA2011": function(e, n, f, i, \$r, c, data) {
                          return /LGA2011/.test(e);
                        },
                        "--AMD--": function(e, n, f, i, \$r, c, data) {
                          return /Socket AM5|Socket AM4|Socket sTR5|Socket sWRX8|Socket sTRX4|Socket TR4/.test(e);
                        },
                        "Socket AM5": function(e, n, f, i, \$r, c, data) {
                          return /Socket AM5/.test(e);
                        },
                        "Socket AM4": function(e, n, f, i, \$r, c, data) {
                          return /Socket AM4/.test(e);
                        },
                        "Socket sTR5": function(e, n, f, i, \$r, c, data) {
                          return /Socket sTR5/.test(e);
                        },
                        "Socket sWRX8": function(e, n, f, i, \$r, c, data) {
                          return /Socket sWRX8/.test(e);
                        },
                        "Socket sTRX4": function(e, n, f, i, \$r, c, data) {
                          return /Socket sTRX4/.test(e);
                        },
                        "Socket TR4": function(e, n, f, i, \$r, c, data) {
                          return /Socket TR4/.test(e);
                        },
          
                      }
                    }
                  }
                });
              });
            </script>
            DOM;
      echo $str;
      break;

    case "cpuc":
      $str = <<<DOM
            <form class="form-inline">
            <div class="form-group">
              <select id="maker-select" class="form-control">
                <option value="">メーカー</option>
                <option value="ADATA">ADATA</option>
                <option value="AINEX">AINEX</option>
                <option value="ANTEC">ANTEC</option>
                <option value="ARCTIC">ARCTIC</option>
                <option value="ASUS">ASUS</option>
                <option value="be quiet">be quiet</option>
                <option value="COOLER MASTER">COOLER MASTER</option>
                <option value="CRYORIG">CRYORIG</option>
                <option value="Corsair">Corsair</option>
                <option value="COUGAR">COUGAR</option>
                <option value="darkFlash">darkFlash</option>
                <option value="DEEPCOOL">DEEPCOOL</option>
                <option value="Dynatron">Dynatron</option>
                <option value="EK Water Blocks">EK Water Blocks</option>
                <option value="ENERMAX">ENERMAX</option>
                <option value="Fractal Design">Fractal Design</option>
                <option value="GELID">GELID</option>
                <option value="ID-COOLING">ID-COOLING</option>
                <option value="インテル">Intel</option>
                <option value="IN WIN">IN WIN</option>
                <option value="JIUSHARK">JIUSHARK</option>
                <option value="LEPA">LEPA</option>
                <option value="LIAN LI">LIAN LI</option>
                <option value="MSI">MSI</option>
                <option value="noctua">noctua</option>
                <option value="NZXT">NZXT</option>
                <option value="PCCOOLER">PCCOOLER</option>
                <option value="PROLIMA TECH">PROLIMA TECH</option>
                <option value="ProArtist">ProArtist</option>
                <option value="SAMA">SAMA</option>
                <option value="Spire">Spire</option>
                <option value="SUNTRUST">SUNTRUST</option>
                <option value="SUPERMICRO">SUPERMICRO</option>
                <option value="Razer">Razer</option>
                <option value="REEVEN">REEVEN</option>
                <option value="Thermalright">Thermalright </option>
                <option value="Thermaltake">Thermaltake</option>
                <option value="XIGMATEK">XIGMATEK</option>
                <option value="ZALMAN">ZALMAN</option>
                <option value="オウルテック">オウルテック</option>
                <option value="サイズ">サイズ</option>
              </select>
              <select id="type-select" class="form-control">
                <option value="">冷却方式</option>
                <option value="トップフロー">トップフロー</option>
                <option value="サイドフロー">サイドフロー</option>
                <option value="水冷">簡易水冷</option>
              </select>
              <select id="socket-select" class="form-control">
                <option value="">ソケット</option>
                <option value="">-intel-</option>
                <option value="1700">LGA1700</option>
                <option value="1200">LGA1200</option>
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
              </select>
              </div></form>
            DOM;
      echo $str;
      break;

    case "ram":
      $str = <<<DOM
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
            </div></form>
            DOM;
      echo $str;
      break;

    case "mb":
      $str = <<<DOM
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
              </div></form>    
            DOM;
      echo $str;
      break;

    case "gpu":
      $str = <<<DOM
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
            </div></form>    
            DOM;
      echo $str;
      break;

    case "ssd":
      $str = <<<DOM
            <form class="form-inline">
            <div class="form-group">
              <select id="select-1" class="form-control">
              <option value="">メーカー</option>
                <option value="ADATA">ADATA</option>
                <option value="ADTEC">ADTEC</option>
                <option value="CFD">CFD</option>
                <option value="Corsair">Corsair</option>
                <option value="crucial">crucial</option>
                <option value="GIGABYTE">GIGABYTE</option>
                <option value="キングストン">Kingston</option>
                <option value="キオクシア">KIOXIA</option>
                <option value="Lexar">Lexar</option>
                <option value="MSI">MSI</option>
                <option value="PLEXTOR">PLEXTOR</option>
                <option value="PNY">PNY</option>
                <option value="サムスン">Samsung</option>
                <option value="SANDISK">SanDisk</option>
                <option value="Silicon Power">Silicon Power</option>
                <option value="Solidigm">Solidigm</option>
                <option value="Team">Team</option>
                <option value="トランセンド">Transcend</option>
                <option value="WESTERN DIGITAL">WESTERN DIGITAL</option>
              </select>
              <select id="select-2" class="form-control">
                <option value="">容量</option>
                <option value="120GB|128GB">128GB前後</option>
                <option value="256GB|250GB|240GB">256GB前後</option>
                <option value="500GB|512GB|480GB">512GB前後</option>
                <option value="960GB|1000GB|1024GB">1TB前後</option>
                <option value="2000GB|2048GB">2TB前後</option>
                <option value="4096GB|4000GB">4TB前後</option>
                <option value="8000GB|8196GB">8TB前後</option>
              </select>
              <select id="select-3" class="form-control">
                <option value="">形状</option>
                <option value="2.5インチ">2.5インチ</option>
                <option value="Type2280">M.2(2280)</option>
                <option value="">--------</option>
                <option value="Type2242">M.2(2242)</option>
                <option value="Type2260">M.2(2260)</option>
                <option value="Type22110">M.2(22110)</option>
                <option value="mSATA">mSATA</option>
                <option value="">--------</option>
                <option value="外付け">外付け</option>
              </select>
              <select id="select-4" class="form-control">
                <option value="">インターフェース</option>
                <option value="Serial ATA">Serial ATA</option>
                <option value="PCI-Express(?! Gen4)|PCI-Express Gen3">PCIe Gen3</option>
                <option value="PCI-Express Gen4">PCIe Gen4</option>
                <option value="PCI-Express Gen5">PCIe Gen5</option>
              </select>
              </div></form>
            DOM;
      echo $str;
      break;

    case "ssd2":
      $str = <<<DOM
            <form class="form-inline">
            <div class="form-group">
              <select id="select-1" class="form-control">
              <option value="">メーカー</option>
                <option value="ADATA">ADATA</option>
                <option value="ADTEC">ADTEC</option>
                <option value="CFD">CFD</option>
                <option value="Corsair">Corsair</option>
                <option value="crucial">crucial</option>
                <option value="GIGABYTE">GIGABYTE</option>
                <option value="キングストン">Kingston</option>
                <option value="キオクシア">KIOXIA</option>
                <option value="Lexar">Lexar</option>
                <option value="MSI">MSI</option>
                <option value="PLEXTOR">PLEXTOR</option>
                <option value="PNY">PNY</option>
                <option value="サムスン">Samsung</option>
                <option value="SANDISK">SanDisk</option>
                <option value="Silicon Power">Silicon Power</option>
                <option value="Solidigm">Solidigm</option>
                <option value="Team">Team</option>
                <option value="トランセンド">Transcend</option>
                <option value="WESTERN DIGITAL">WESTERN DIGITAL</option>
              </select>
              <select id="select-2" class="form-control">
                <option value="">容量</option>
                <option value="120GB|128GB">128GB前後</option>
                <option value="256GB|250GB|240GB">256GB前後</option>
                <option value="500GB|512GB|480GB">512GB前後</option>
                <option value="960GB|1000GB|1024GB">1TB前後</option>
                <option value="2000GB|2048GB">2TB前後</option>
                <option value="4096GB|4000GB">4TB前後</option>
                <option value="8000GB|8196GB">8TB前後</option>
              </select>
              <select id="select-3" class="form-control">
                <option value="">形状</option>
                <option value="2.5インチ">2.5インチ</option>
                <option value="Type2280">M.2(2280)</option>
                <option value="">--------</option>
                <option value="Type2242">M.2(2242)</option>
                <option value="Type2260">M.2(2260)</option>
                <option value="Type22110">M.2(22110)</option>
                <option value="mSATA">mSATA</option>
                <option value="">--------</option>
                <option value="外付け">外付け</option>
              </select>
              <select id="select-4" class="form-control">
                <option value="">インターフェース</option>
                <option value="Serial ATA">Serial ATA</option>
                <option value="PCI-Express(?! Gen4)|PCI-Express Gen3">PCIe Gen3</option>
                <option value="PCI-Express Gen4">PCIe Gen4</option>
                <option value="PCI-Express Gen5">PCIe Gen5</option>
              </select>
              </div></form>
            DOM;
      echo $str;
      break;

    case "hdd":
      $str = <<<DOM
            <form class="form-inline">
            <div class="form-group">
              <select id="select-1" class="form-control">
                <option value="">メーカー</option>
                <option value="HGST">HGST</option>
                <option value="SEAGATE">SeaGate</option>
                <option value="WESTERN DIGITAL">WESTERN DIGITAL</option>
                <option value="東芝">東芝</option>
              </select>
              <select id="select-2" class="form-control">
                <option value="">容量</option>
                <option value="500GB">500GB</option>
                <option value="1000GB">1TB</option>
                <option value="2000GB">2TB</option>
                <option value="4000GB">4TB</option>
                <option value="6000GB">6TB</option>
                <option value="8000GB">8TB</option>
                <option value="10000GB">10TB</option>
                <option value="12000GB">12TB</option>
                <option value="14000GB">14TB</option>
                <option value="16000GB">16TB</option>
                <option value="18000GB">18TB</option>
                <option value="2(?=0000)">20TB</option>
                <option value="2(?=2000)">22TB</option>
              </select>
            </div>
            </form>    
            DOM;
      echo $str;
      break;

    case "psu":
      $str = <<<DOM
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
            DOM;
      echo $str;
      break;

    case "pccase":
      $str = <<<DOM
            <form class="form-inline">
            <div class="form-group">
              <select id="select-1" class="form-control">
                <option value="">メーカー</option>
                <option value="Abee">Abee</option>
                <option value="ADATA">ADATA</option>
                <option value="ANTEC">ANTEC</option>
                <option value="ASUS">ASUS</option>
                <option value="AZZA">AZZA</option>
                <option value="be quiet">be quiet！</option>
                <option value="COOLER MASTER">COOLER MASTER</option>
                <option value="Corsair">Corsair</option>
                <option value="COUGAR">COUGAR</option>
                <option value="darkFlash">darkFlash</option>
                <option value="DEEPCOOL">DEEPCOOL</option>
                <option value="ENERMAX">ENERMAX</option>
                <option value="Fractal Design">Fractal Design</option>
                <option value="HEC">HEC</option>
                <option value="HYTE">HYTE</option>
                <option value="IN WIN">IN WIN</option>
                <option value="LIAN LI">LIAN LI</option>
                <option value="MSI">MSI</option>
                <option value="NZXT">NZXT</option>
                <option value="Phanteks">Phanteks</option>
                <option value="Sharkoon">Sharkoon</option>
                <option value="SILVERSTONE">SILVERSTONE</option>
                <option value="SSUPD">SSUPD</option>
                <option value="SUPERMICRO">SUPERMICRO</option>
                <option value="Thermaltake">Thermaltake</option>
                <option value="Razer">Razer</option>
                <option value="RAIJINTEK">RAIJINTEK</option>
                <option value="ZALMAN">ZALMAN</option>
                <option value="サイズ">サイズ</option>
                <option value="長尾製作所">長尾製作所</option>
              </select>
              <select id="select-2" class="form-control">
                <option value="">最大マザーサイズ</option>
                <option value="[0-9]\sATX\s">ATX</option>
                <option value="E-ATX">E-ATX</option>
                <option value="MicroATX">Micro ATX</option>
                <option value="MiniITX">Mini ITX</option>
              </select>
            </div></form>    
            DOM;
      echo $str;
      break;
  }
}
