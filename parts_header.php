<?php

function parts_header($genre)
{
  switch ($genre) {
    case "cpu":
      $str = <<<DOM
            <head>
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
                      1: {
                        "インテル": function(e, n, f, i, \$r, c, data) {
                          return /インテル/.test(e);
                        },
                        "AMD": function(e, n, f, i, \$r, c, data) {
                          return /AMD/.test(e);
                        }
                      },
                      5: {
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
            </head>
            <body>
              <div align="center">
                <h1>CPUリスト</h1>
              </div>
              <h5>青い項目部分をタップorクリックで並べ替えができます。</h5>
              <br>
              <table align="center" border="1" cellpadding="5" id="main-table" class="order-table">
                <thead>
                  <tr>
                    <th></th>
                    <th class="maker">メーカー</th>
                    <th class="name">製品名</th>
                    <th class="price">値段</th>
                    <th class="gen">世代</th>
                    <th class="socket">ソケット</th>
                  </tr>
                </thead>
                <tbody>
            DOM;
      echo $str;
      break;

    case "cpuc":
      $str = <<<DOM
            <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>CPUクーラー</title>
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
                      1: {
                        "ADATA":function(e, n, f, i, \$r, c, data) { return /ADATA/.test(e); },
                        "AINEX":function(e, n, f, i, \$r, c, data) { return /AINEX/.test(e); },
                        "ANTEC":function(e, n, f, i, \$r, c, data) { return /ANTEC/.test(e); },
                        "ARCTIC":function(e, n, f, i, \$r, c, data) { return /ARCTIC/.test(e); },
                        "ASUS":function(e, n, f, i, \$r, c, data) { return /ASUS/.test(e); },
                        "be quiet":function(e, n, f, i, \$r, c, data) { return /be quiet/.test(e); },
                        "COOLER MASTER":function(e, n, f, i, \$r, c, data) { return /COOLER MASTER/.test(e); },
                        "CRYORIG":function(e, n, f, i, \$r, c, data) { return /CRYORIG/.test(e); },
                        "Corsair":function(e, n, f, i, \$r, c, data) { return /Corsair/.test(e); },
                        "COUGAR":function(e, n, f, i, \$r, c, data) { return /COUGAR/.test(e); },
                        "darkFlash":function(e, n, f, i, \$r, c, data) { return /darkFlash/.test(e); },
                        "DEEPCOOL":function(e, n, f, i, \$r, c, data) { return /DEEPCOOL/.test(e); },
                        "Dynatron":function(e, n, f, i, \$r, c, data) { return /Dynatron/.test(e); },
                        "EK Water Blocks":function(e, n, f, i, \$r, c, data) { return /EK Water Blocks/.test(e); },
                        "ENERMAX":function(e, n, f, i, \$r, c, data) { return /ENERMAX/.test(e); },
                        "Fractal Design":function(e, n, f, i, \$r, c, data) { return /Fractal Design/.test(e); },
                        "GELID":function(e, n, f, i, \$r, c, data) { return /GELID/.test(e); },
                        "ID-COOLING":function(e, n, f, i, \$r, c, data) { return /ID-COOLING/.test(e); },
                        "インテル":function(e, n, f, i, \$r, c, data) { return /Intel/.test(e); },
                        "IN WIN":function(e, n, f, i, \$r, c, data) { return /IN WIN/.test(e); },
                        "JIUSHARK":function(e, n, f, i, \$r, c, data) { return /JIUSHARK/.test(e); },
                        "LEPA":function(e, n, f, i, \$r, c, data) { return /LEPA/.test(e); },
                        "LIAN LI":function(e, n, f, i, \$r, c, data) { return /LIAN LI/.test(e); },
                        "MSI":function(e, n, f, i, \$r, c, data) { return /MSI/.test(e); },
                        "noctua":function(e, n, f, i, \$r, c, data) { return /noctua/.test(e); },
                        "NZXT":function(e, n, f, i, \$r, c, data) { return /NZXT/.test(e); },
                        "PCCOOLER":function(e, n, f, i, \$r, c, data) { return /PCCOOLER/.test(e); },
                        "PROLIMA TECH":function(e, n, f, i, \$r, c, data) { return /PROLIMA TECH/.test(e); },
                        "ProArtist":function(e, n, f, i, \$r, c, data) { return /ProArtist/.test(e); },
                        "SAMA":function(e, n, f, i, \$r, c, data) { return /SAMA/.test(e); },
                        "Spire":function(e, n, f, i, \$r, c, data) { return /Spire/.test(e); },
                        "SUNTRUST":function(e, n, f, i, \$r, c, data) { return /SUNTRUST/.test(e); },
                        "SUPERMICRO":function(e, n, f, i, \$r, c, data) { return /SUPERMICRO/.test(e); },
                        "Razer":function(e, n, f, i, \$r, c, data) { return /Razer/.test(e); },
                        "REEVEN":function(e, n, f, i, \$r, c, data) { return /REEVEN/.test(e); },
                        "Thermalright":function(e, n, f, i, \$r, c, data) { return /Thermalright/.test(e); },
                        "Thermaltake":function(e, n, f, i, \$r, c, data) { return /Thermaltake/.test(e); },
                        "XIGMATEK":function(e, n, f, i, \$r, c, data) { return /XIGMATEK/.test(e); },
                        "ZALMAN":function(e, n, f, i, \$r, c, data) { return /ZALMAN/.test(e); },
                        "オウルテック":function(e, n, f, i, \$r, c, data) { return /オウルテック/.test(e); },
                        "サイズ":function(e, n, f, i, \$r, c, data) { return /サイズ/.test(e); },
                      },
                      4: {
                        "トップフロー": function(e, n, f, i, \$r, c, data) {
                          return /トップフロー/.test(e);
                        },
                        "サイドフロー": function(e, n, f, i, \$r, c, data) {
                          return /サイドフロー/.test(e);
                        },
                        "簡易水冷": function(e, n, f, i, \$r, c, data) {
                          return /水冷/.test(e);
                        },
                      },
                      5: {
                        "--intel--": function(e, n, f, i, \$r, c, data) {
                          return /1700|1200|1151|2066|3647|4189|4677|775|1150|1156|2011/.test(e);
                        },
                        "LGA1700": function(e, n, f, i, \$r, c, data) {
                          return /1700/.test(e);
                        },
                        "LGA1200": function(e, n, f, i, \$r, c, data) {
                          return /1200/.test(e);
                        },
                        "LGA4677": function(e, n, f, i, \$r, c, data) {
                          return /4677/.test(e);
                        },
                        "LGA4189": function(e, n, f, i, \$r, c, data) {
                          return /4189/.test(e);
                        },
                        "LGA1151": function(e, n, f, i, \$r, c, data) {
                          return /1151/.test(e);
                        },
                        "LGA1150": function(e, n, f, i, \$r, c, data) {
                          return /1150/.test(e);
                        },
                        "LGA1156": function(e, n, f, i, \$r, c, data) {
                          return /1156/.test(e);
                        },
                        "LGA775": function(e, n, f, i, \$r, c, data) {
                          return /775/.test(e);
                        },
                        "LGA2066": function(e, n, f, i, \$r, c, data) {
                          return /2066/.test(e);
                        },
                        "LGA2011": function(e, n, f, i, \$r, c, data) {
                          return /2011/.test(e);
                        },
                        "--AMD--": function(e, n, f, i, \$r, c, data) {
                          return /AM5|AM4|sTR5|sWRX8|sTRX4|TR4/.test(e);
                        },
                        "Socket AM5": function(e, n, f, i, \$r, c, data) {
                          return /AM5/.test(e);
                        },
                        "Socket AM4": function(e, n, f, i, \$r, c, data) {
                          return /AM4/.test(e);
                        },
                        "Socket sTR5": function(e, n, f, i, \$r, c, data) {
                          return /sTR5/.test(e);
                        },
                        "Socket sWRX8": function(e, n, f, i, \$r, c, data) {
                          return /sWRX8/.test(e);
                        },
                        "Socket sTRX4": function(e, n, f, i, \$r, c, data) {
                          return /sTRX4/.test(e);
                        },
                        "Socket TR4": function(e, n, f, i, \$r, c, data) {
                          return /TR4/.test(e);
                        },
                      },
                    }
                  }
                });
              });
            </script>
            </head>
            <body>
              <div align="center">
                      <h1>クーラーリスト</h1>
                  </div>
                  <br>
                  <h5>青い項目部分をタップorクリックで並べ替えができます。</h5>
                  <table align="center" border="1" cellpadding="5" class="order-table" id="main-table" >
                    <thead>
                      <tr>
                          <th style="width: 4%"></th>
                          <th class="maker" style="width: 8%">メーカー</th>
                          <th class="name" style="width: 30%">製品名</th>
                          <th class="price">値段</th>
                          <th class="gen">冷却方式</th>
                          <th class="socket">ソケット</th>
                          <th class="socket">ラジサイズ/本体サイズ</th>
                      </tr> 
                    </thead>
            DOM;
      echo $str;
      break;

    case "ram":
      $str = <<<DOM
            <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>メモリ</title>
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
                      1: {
                        "ADATA": function(e, n, f, i, \$r, c, data) {
                          return /ADATA/.test(e);
                        },
                        "ADTEC": function(e, n, f, i, \$r, c, data) {
                          return /ADTEC/.test(e);
                        },
                        "アユート": function(e, n, f, i, \$r, c, data) {
                          return /アユート/.test(e);
                        },
                        "Antec Memory": function(e, n, f, i, \$r, c, data) {
                          return /Antec Memory/.test(e);
                        },
                        "Apacer": function(e, n, f, i, \$r, c, data) {
                          return /Apacer/.test(e);
                        },
                        "ARCHISS": function(e, n, f, i, \$r, c, data) {
                          return /ARCHISS/.test(e);
                        },
                        "バッファロー": function(e, n, f, i, \$r, c, data) {
                          return /バッファロー/.test(e);
                        },
                        "CENTURY MICRO": function(e, n, f, i, \$r, c, data) {
                          return /CENTURY MICRO/.test(e);
                        },
                        "CFD": function(e, n, f, i, \$r, c, data) {
                          return /CFD/.test(e);
                        },
                        "Corsair": function(e, n, f, i, \$r, c, data) {
                          return /Corsair/.test(e);
                        },
                        "crucial": function(e, n, f, i, \$r, c, data) {
                          return /crucial/.test(e);
                        },
                        "エレコム": function(e, n, f, i, \$r, c, data) {
                          return /エレコム/.test(e);
                        },
                        "ESSENCORE": function(e, n, f, i, \$r, c, data) {
                          return /ESSENCORE/.test(e);
                        },
                        "GALAXY": function(e, n, f, i, \$r, c, data) {
                          return /GALAXY/.test(e);
                        },
                        "GIGABYTE": function(e, n, f, i, \$r, c, data) {
                          return /GIGABYTE/.test(e);
                        },
                        "グリーンハウス": function(e, n, f, i, \$r, c, data) {
                          return /グリーンハウス/.test(e);
                        },
                        "G.Skill": function(e, n, f, i, \$r, c, data) {
                          return /G.Skill/.test(e);
                        },
                        "IODATA": function(e, n, f, i, \$r, c, data) {
                          return /IODATA/.test(e);
                        },
                        "キングストン": function(e, n, f, i, \$r, c, data) {
                          return /キングストン/.test(e);
                        },
                        "Lexar": function(e, n, f, i, \$r, c, data) {
                          return /Lexar/.test(e);
                        },
                        "Micron": function(e, n, f, i, \$r, c, data) {
                          return /Micron/.test(e);
                        },
                        "OCMEMORY": function(e, n, f, i, \$r, c, data) {
                          return /OCMEMORY/.test(e);
                        },
                        "Patriot Memory": function(e, n, f, i, \$r, c, data) {
                          return /Patriot Memory/.test(e);
                        },
                        "PNY": function(e, n, f, i, \$r, c, data) {
                          return /PNY/.test(e);
                        },
                        "プリンストン": function(e, n, f, i, \$r, c, data) {
                          return /プリンストン/.test(e);
                        },
                        "Samsung": function(e, n, f, i, \$r, c, data) {
                          return /サムスン/.test(e);
                        },
                        "SanMax": function(e, n, f, i, \$r, c, data) {
                          return /サンマックス/.test(e);
                        },
                        "Silicon Power": function(e, n, f, i, \$r, c, data) {
                          return /Silicon Power/.test(e);
                        },
                        "SunEast": function(e, n, f, i, \$r, c, data) {
                          return /旭東エレクトロニクス/.test(e);
                        },
                        "Team": function(e, n, f, i, \$r, c, data) {
                          return /Team/.test(e);
                        },
                        "トランセンド": function(e, n, f, i, \$r, c, data) {
                          return /トランセンド/.test(e);
                        },
                        "ノーブランド": function(e, n, f, i, \$r, c, data) {
                          return /ノーブランド/.test(e);
                        }
                      },
                      4:{
                        "DDR4": function(e, n, f, i, \$r, c, data) {
                          return /DDR4 SDRAM/.test(e);
                        },
                        "DDR5": function(e, n, f, i, \$r, c, data) {
                          return /DDR5 SDRAM/.test(e);
                        }
                      },
                      5: {
                        "DIMM": function(e, n, f, i, \$r, c, data) {
                          return /DIMM/.test(e);
                        }
                      },
                      6:{
                        "--DDR5--": function(e, n, f, i, \$r, c, data) {
                          return /DDR5/.test(e);
                        },
                        "DDR5-4000": function(e, n, f, i, \$r, c, data) {
                          return /DDR5-4000/.test(e);
                        },
                        "DDR5-4800": function(e, n, f, i, \$r, c, data) {
                          return /DDR5-4800/.test(e);
                        },
                        "DDR5-5200": function(e, n, f, i, \$r, c, data) {
                          return /DDR5-5200/.test(e);
                        },
                        "DDR5-5600": function(e, n, f, i, \$r, c, data) {
                          return /DDR5-5600/.test(e);
                        },
                        "DDR5-6000": function(e, n, f, i, \$r, c, data) {
                          return /DDR5-6000/.test(e);
                        },
                        "DDR5-6200": function(e, n, f, i, \$r, c, data) {
                          return /DDR5-6200/.test(e);
                        },
                        "DDR5-6400": function(e, n, f, i, \$r, c, data) {
                          return /DDR5-6400/.test(e);
                        },
                        "DDR5-6800": function(e, n, f, i, \$r, c, data) {
                          return /DDR5-6800/.test(e);
                        },
                        "DDR5-7000": function(e, n, f, i, \$r, c, data) {
                          return /DDR5-7000/.test(e);
                        },
                        "DDR5-7200": function(e, n, f, i, \$r, c, data) {
                          return /DDR5-7200/.test(e);
                        },
                        "DDR5-7400": function(e, n, f, i, \$r, c, data) {
                          return /DDR5-7400/.test(e);
                        },
                        "DDR5-7600": function(e, n, f, i, \$r, c, data) {
                          return /DDR5-7600/.test(e);
                        },
                        "DDR5-7800": function(e, n, f, i, \$r, c, data) {
                          return /DDR5-7800/.test(e);
                        },
                        "DDR5-8000": function(e, n, f, i, \$r, c, data) {
                          return /DDR5-8000/.test(e);
                        },
                        "--DDR4--": function(e, n, f, i, \$r, c, data) {
                          return /DDR4/.test(e);
                        },
                        "DDR4-2133": function(e, n, f, i, \$r, c, data) {
                          return /DDR4-2133/.test(e);
                        },
                        "DDR4-2400": function(e, n, f, i, \$r, c, data) {
                          return /DDR4-2400/.test(e);
                        },
                        "DDR4-2666": function(e, n, f, i, \$r, c, data) {
                          return /DDR4-2666/.test(e);
                        },
                        "DDR4-2800": function(e, n, f, i, \$r, c, data) {
                          return /DDR4-2800/.test(e);
                        },
                        "DDR4-2933": function(e, n, f, i, \$r, c, data) {
                          return /DDR4-2933/.test(e);
                        },
                        "DDR4-3000": function(e, n, f, i, \$r, c, data) {
                          return /DDR4-3000/.test(e);
                        },
                        "DDR4-3200": function(e, n, f, i, \$r, c, data) {
                          return /DDR4-3200/.test(e);
                        },
                        "DDR4-3333": function(e, n, f, i, \$r, c, data) {
                          return /DDR4-3333/.test(e);
                        },
                        "DDR4-3466": function(e, n, f, i, \$r, c, data) {
                          return /DDR4-3466/.test(e);
                        },
                        "DDR4-3600": function(e, n, f, i, \$r, c, data) {
                          return /DDR4-3600/.test(e);
                        },
                        "DDR4-3733": function(e, n, f, i, \$r, c, data) {
                          return /DDR4-3733/.test(e);
                        },
                        "DDR4-3800": function(e, n, f, i, \$r, c, data) {
                          return /DDR4-3800/.test(e);
                        },
                        "DDR4-4000": function(e, n, f, i, \$r, c, data) {
                          return /DDR4-4000/.test(e);
                        },
                        "DDR4-4133": function(e, n, f, i, \$r, c, data) {
                          return /DDR4-4133/.test(e);
                        },
                        "DDR4-4266": function(e, n, f, i, \$r, c, data) {
                          return /DDR4-4266/.test(e);
                        },
                        "DDR4-4400": function(e, n, f, i, \$r, c, data) {
                          return /DDR4-4400/.test(e);
                        },
                        "DDR4-4600": function(e, n, f, i, \$r, c, data) {
                          return /DDR4-4600/.test(e);
                        },
                        "DDR4-4800": function(e, n, f, i, \$r, c, data) {
                          return /DDR4-4800/.test(e);
                        },
                        "DDR4-5000": function(e, n, f, i, \$r, c, data) {
                          return /DDR4-5000/.test(e);
                        },
                        "DDR4-5333": function(e, n, f, i, \$r, c, data) {
                          return /DDR4-5333/.test(e);
                        }
                      },
                      7:{
                        "8GB": function(e, n, f, i, \$r, c, data) {
                          return /^8/.test(e);
                        },
                        "16GB": function(e, n, f, i, \$r, c, data) {
                          return /16 GB/.test(e);
                        },
                        "24GB": function(e, n, f, i, \$r, c, data) {
                          return /24 GB/.test(e);
                        },
                        "32GB": function(e, n, f, i, \$r, c, data) {
                          return /32 GB/.test(e);
                        },
                        "48GB": function(e, n, f, i, \$r, c, data) {
                          return /48 GB/.test(e);
                        },
                        "64GB": function(e, n, f, i, \$r, c, data) {
                          return /64 GB/.test(e);
                        },
                        "96GB": function(e, n, f, i, \$r, c, data) {
                          return /96 GB/.test(e);
                        },
                        "128GB": function(e, n, f, i, \$r, c, data) {
                          return /128 GB/.test(e);
                        },
                        "192GB": function(e, n, f, i, \$r, c, data) {
                          return /192 GB/.test(e);
                        }
                      },
                      8:{
                        "8GB": function(e, n, f, i, \$r, c, data) {
                          return /^8/.test(e);
                        },
                        "16GB": function(e, n, f, i, \$r, c, data) {
                          return /16㌐/.test(e);
                        },
                        "24GB": function(e, n, f, i, \$r, c, data) {
                          return /24㌐/.test(e);
                        },
                        "32GB": function(e, n, f, i, \$r, c, data) {
                          return /32㌐/.test(e);
                        },
                        "48GB": function(e, n, f, i, \$r, c, data) {
                          return /48㌐/.test(e);
                        },
                        "64GB": function(e, n, f, i, \$r, c, data) {
                          return /64㌐/.test(e);
                        }
                      },
                      9:{
                        "ECC非対応": function(e, n, f, i, \$r, c, data) {
                          return /eccNG/.test(e);
                        },
                        "ECC対応": function(e, n, f, i, \$r, c, data) {
                          return /eccOK/.test(e);
                        }
                      },
                      10:{
                        "Reg非対応": function(e, n, f, i, \$r, c, data) {
                          return /regNG/.test(e);
                        },
                        "Reg対応": function(e, n, f, i, \$r, c, data) {
                          return /regOK/.test(e);
                        }
                      }
                    }
                  }
                });
              });
            </script>
            </head
            <body>
              <div align="center">
                <h1>メモリリスト</h1>
              </div>
              <br>
              <h5>青い項目部分をタップorクリックで並べ替えができます。</h5>
              <table align="center" border="1" cellpadding="5" class="order-table" id="main-table">
                <thead>
                  <tr>
                    <th></th>
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
            DOM;
      echo $str;
      break;

    case "mb":
      $str = <<<DOM
            <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>マザーボード</title>
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
                      1: {
                        "ASUS": function(e, n, f, i, \$r, c, data) {
                          return /ASUS/.test(e);
                        },
                        "ASRock": function(e, n, f, i, \$r, c, data) {
                          return /ASRock/.test(e);
                        },
                        "BIOSTAR": function(e, n, f, i, \$r, c, data) {
                          return /BIOSTAR/.test(e);
                        },
                        "Colorful": function(e, n, f, i, \$r, c, data) {
                          return /Colorful/.test(e);
                        },
                        "GIGABYTE": function(e, n, f, i, \$r, c, data) {
                          return /GIGABYTE/.test(e);
                        },
                        "MSI": function(e, n, f, i, \$r, c, data) {
                          return /MSI/.test(e);
                        },
                        "NZXT": function(e, n, f, i, \$r, c, data) {
                          return /NZXT/.test(e);
                        }
                      },
                      4: {
                        "--Intel--": function(e, n, f, i, \$r, c, data) {
                          return / /.test(e);
                        },
                        "Z790": function(e, n, f, i, \$r, c, data) {
                          return /Z790/.test(e);
                        },
                        "H770": function(e, n, f, i, \$r, c, data) {
                          return /H770/.test(e);
                        },
                        "B760": function(e, n, f, i, \$r, c, data) {
                          return /B760/.test(e);
                        },
                        "Z690": function(e, n, f, i, \$r, c, data) {
                          return /Z690/.test(e);
                        },
                        "H670": function(e, n, f, i, \$r, c, data) {
                          return /H670/.test(e);
                        },
                        "B660": function(e, n, f, i, \$r, c, data) {
                          return /B660/.test(e);
                        },
                        "H610": function(e, n, f, i, \$r, c, data) {
                          return /H610/.test(e);
                        },
                        "Z590": function(e, n, f, i, \$r, c, data) {
                          return /Z590/.test(e);
                        },
                        "H570": function(e, n, f, i, \$r, c, data) {
                          return /H570/.test(e);
                        },
                        "B560": function(e, n, f, i, \$r, c, data) {
                          return /B560/.test(e);
                        },
                        "H510": function(e, n, f, i, \$r, c, data) {
                          return /H510/.test(e);
                        },
                        "X299": function(e, n, f, i, \$r, c, data) {
                          return /X299/.test(e);
                        },
                        "C236": function(e, n, f, i, \$r, c, data) {
                          return /C236/.test(e);
                        },
                        "--AMD--": function(e, n, f, i, \$r, c, data) {
                          return / /.test(e);
                        },
                        "X670E": function(e, n, f, i, \$r, c, data) {
                          return /X670E/.test(e);
                        },
                        "X670": function(e, n, f, i, \$r, c, data) {
                          return /X670(?!E)/.test(e);
                        },
                        "B650E": function(e, n, f, i, \$r, c, data) {
                          return /B650E/.test(e);
                        },
                        "B650": function(e, n, f, i, \$r, c, data) {
                          return /B650(?!E)/.test(e);
                        },
                        "A620": function(e, n, f, i, \$r, c, data) {
                          return /A620/.test(e);
                        },
                        "X570": function(e, n, f, i, \$r, c, data) {
                          return /X570/.test(e);
                        },
                        "B550": function(e, n, f, i, \$r, c, data) {
                          return /B550/.test(e);
                        },
                        "A520": function(e, n, f, i, \$r, c, data) {
                          return /A520/.test(e);
                        },
                        "WRX90": function(e, n, f, i, \$r, c, data) {
                          return /WRX90/.test(e);
                        },
                        "WRX80": function(e, n, f, i, \$r, c, data) {
                          return /WRX80/.test(e);
                        }
                      },
                      5:{
                        "--intel--": function(e, n, f, i, \$r, c, data) {
                          return / /.test(e);
                        },
                        "LGA1700": function(e, n, f, i, \$r, c, data) {
                          return /1700/.test(e);
                        },
                        "LGA1200": function(e, n, f, i, \$r, c, data) {
                          return /1200(?!SPSR)/.test(e);
                        },
                        "LGA1151": function(e, n, f, i, \$r, c, data) {
                          return /1151/.test(e);
                        },
                        "LGA2066": function(e, n, f, i, \$r, c, data) {
                          return /2066/.test(e);
                        },
                        "LGA3647": function(e, n, f, i, \$r, c, data) {
                          return /3647/.test(e);
                        },
                        "LGA4189": function(e, n, f, i, \$r, c, data) {
                          return /4189/.test(e);
                        },
                        "--AMD--": function(e, n, f, i, \$r, c, data) {
                          return / /.test(e);
                        },
                        "Socket AM5": function(e, n, f, i, \$r, c, data) {
                          return /AM5/.test(e);
                        },
                        "Socket AM4": function(e, n, f, i, \$r, c, data) {
                          return /AM4/.test(e);
                        },
                        "Socket TR5": function(e, n, f, i, \$r, c, data) {
                          return /TR5/.test(e);
                        },
                        "Socket sWRX8": function(e, n, f, i, \$r, c, data) {
                          return /sWRX8/.test(e);
                        },
                        "--other--": function(e, n, f, i, \$r, c, data) {
                          return / /.test(e);
                        },
                        "Onboard": function(e, n, f, i, \$r, c, data) {
                          return /Onboard/.test(e);
                        }
                      },
                      6:{
                        "ATX": function(e, n, f, i, \$r, c, data) {
                          return /(?<!Micro|Flex)ATX/.test(e);
                        },
                        "E-ATX": function(e, n, f, i, \$r, c, data) {
                          return /Extended/.test(e);
                        },
                        "MicroATX": function(e, n, f, i, \$r, c, data) {
                          return /MicroATX/.test(e);
                        },
                        "Mini ITX": function(e, n, f, i, \$r, c, data) {
                          return /Mini ITX/.test(e);
                        },
                        "SSI EEB": function(e, n, f, i, \$r, c, data) {
                          return /EEB/.test(e);
                        },
                        "SSI CEB": function(e, n, f, i, \$r, c, data) {
                          return /CEB/.test(e);
                        },
                        "FlexATX": function(e, n, f, i, \$r, c, data) {
                          return /FlexATX/.test(e);
                        }
                      },
                      7:
                      {
                        "DDR4": function(e, n, f, i, \$r, c, data) {
                          return /DDR4/.test(e);
                        },
                        "DDR5": function(e, n, f, i, \$r, c, data) {
                          return /DDR5/.test(e);
                        }
                      },
                      8:
                      {
                        "2slot": function(e, n, f, i, \$r, c, data) {
                          return /2slot/.test(e);
                        },
                        "4slot": function(e, n, f, i, \$r, c, data) {
                          return /4slot/.test(e);
                        },
                        "6slot": function(e, n, f, i, \$r, c, data) {
                          return /6slot/.test(e);
                        },
                        "8slot": function(e, n, f, i, \$r, c, data) {
                          return /8slot/.test(e);
                        }
                      },
                      9:{
                        "なし": function(e, n, f, i, \$r, c, data) {
                          return /NO-TB/.test(e);
                        },
                        "あり": function(e, n, f, i, \$r, c, data) {
                          return /ON-TB/.test(e);
                        }
                      },
                      10:{
                        "あり": function(e, n, f, i, \$r, c, data) {
                          return /NO-wifi/.test(e);
                        },
                        "あり": function(e, n, f, i, \$r, c, data) {
                          return /ON-wifi/.test(e);
                        }
                      }
                    }
                  }
                });
              });
            </script>
            </head>
            <body>
            <div align="center">
                    <h1>マザーボードリスト</h1>
                </div>
                <h5>青い項目部分をタップorクリックで並べ替えができます。</h5>
                <br>
                <table align="center" border="1" cellpadding="5" class="order-table" id="main-table">
                  <thead>
                    <tr>
                        <th></th>
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
            DOM;
      echo $str;
      break;

    case "gpu":
      $str = <<<DOM
            <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>GPU</title>
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
                      1: {
                        "ASUS": function(e, n, f, i, \$r, c, data) {
                          return /ASUS/.test(e);
                        },
                        "ASRock": function(e, n, f, i, \$r, c, data) {
                          return /ASRock/.test(e);
                        },
                        "BIOSTAR": function(e, n, f, i, \$r, c, data) {
                          return /BIOSTAR/.test(e);
                        },
                        "Colorful": function(e, n, f, i, \$r, c, data) {
                          return /Colorful/.test(e);
                        },
                        "ELSA": function(e, n, f, i, \$r, c, data) {
                          return /ELSA/.test(e);
                        },
                        "GAINWARD": function(e, n, f, i, \$r, c, data) {
                          return /GAINWARD/.test(e);
                        },
                        "GIGABYTE": function(e, n, f, i, \$r, c, data) {
                          return /GIGABYTE/.test(e);
                        },
                        "Inno3D": function(e, n, f, i, \$r, c, data) {
                          return /Inno3D/.test(e);
                        },
                        "MSI": function(e, n, f, i, \$r, c, data) {
                          return /MSI/.test(e);
                        },
                        "Palit": function(e, n, f, i, \$r, c, data) {
                          return /Palit/.test(e);
                        },
                        "PowerColor": function(e, n, f, i, \$r, c, data) {
                          return /PowerColor/.test(e);
                        },
                        "PNY": function(e, n, f, i, \$r, c, data) {
                          return /PNY/.test(e);
                        },
                        "SAPPHIRE": function(e, n, f, i, \$r, c, data) {
                          return /SAPPHIRE/.test(e);
                        },
                        "ZOTAC": function(e, n, f, i, \$r, c, data) {
                          return /ZOTAC/.test(e);
                        },
                        "玄人志向": function(e, n, f, i, \$r, c, data) {
                          return /玄人志向/.test(e);
                        }
                      },
                      4: {
                        "NVIDIA": function(e, n, f, i, \$r, c, data) {
                          return /NVIDIA/.test(e);
                        },
                        "AMD": function(e, n, f, i, \$r, c, data) {
                          return /AMD/.test(e);
                        },
                        "Intel": function(e, n, f, i, \$r, c, data) {
                          return /Intel/.test(e);
                        }
                      },
                      5:{
                        "--NVIDIA--": function(e, n, f, i, \$r, c, data) {
                          return / /.test(e);
                        },
                        "RTX 4090": function(e, n, f, i, \$r, c, data) {
                          return /RTX 4090/.test(e);
                        },
                        "RTX 4080": function(e, n, f, i, \$r, c, data) {
                          return /RTX 4080/.test(e);
                        },
                        "RTX 4070 Ti": function(e, n, f, i, \$r, c, data) {
                          return /RTX 4070 Ti/.test(e);
                        },
                        "RTX 4070": function(e, n, f, i, \$r, c, data) {
                          return /RTX 4070(?! Ti)/.test(e);
                        },
                        "RTX 4060 Ti": function(e, n, f, i, \$r, c, data) {
                          return /RTX 4060 Ti/.test(e);
                        },
                        "RTX 4060": function(e, n, f, i, \$r, c, data) {
                          return /RTX 4060(?! Ti)/.test(e);
                        },
                        "RTX 3090 Ti": function(e, n, f, i, \$r, c, data) {
                          return /RTX 3090 Ti/.test(e);
                        },
                        "RTX 3090": function(e, n, f, i, \$r, c, data) {
                          return /RTX 3090(?! Ti)/.test(e);
                        },
                        "RTX 3080 Ti": function(e, n, f, i, \$r, c, data) {
                          return /RTX 3080 Ti/.test(e);
                        },
                        "RTX 3080": function(e, n, f, i, \$r, c, data) {
                          return /RTX 3080(?! Ti)/.test(e);
                        },
                        "RTX 3070 Ti": function(e, n, f, i, \$r, c, data) {
                          return /RTX 3070 Ti/.test(e);
                        },
                        "RTX 3070": function(e, n, f, i, \$r, c, data) {
                          return /RTX 3070(?! Ti)/.test(e);
                        },
                        "RTX 3060 Ti": function(e, n, f, i, \$r, c, data) {
                          return /RTX 3060 Ti/.test(e);
                        },
                        "RTX 3060": function(e, n, f, i, \$r, c, data) {
                          return /RTX 3060(?! Ti)/.test(e);
                        },
                        "RTX 3050": function(e, n, f, i, \$r, c, data) {
                          return /RTX 3050/.test(e);
                        },
                        "GTX 1660 Ti": function(e, n, f, i, \$r, c, data) {
                          return /GTX 1660 Ti/.test(e);
                        },
                        "GTX 1660 SUPER": function(e, n, f, i, \$r, c, data) {
                          return /GTX 1660 SUP/.test(e);
                        },
                        "GTX 1660": function(e, n, f, i, \$r, c, data) {
                          return /GTX 1660/.test(e);
                        },
                        "GTX 1650": function(e, n, f, i, \$r, c, data) {
                          return /GTX 1650/.test(e);
                        },
                        "GTX 1050 Ti": function(e, n, f, i, \$r, c, data) {
                          return /GTX 1050 Ti/.test(e);
                        },
                        "GT 1030": function(e, n, f, i, \$r, c, data) {
                          return /GT 1030/.test(e);
                        },
                        "GT 730": function(e, n, f, i, \$r, c, data) {
                          return /GT 730/.test(e);
                        },
                        "GT 1030": function(e, n, f, i, \$r, c, data) {
                          return /GT 1030/.test(e);
                        },
                        "GT 710": function(e, n, f, i, \$r, c, data) {
                          return /GT 710/.test(e);
                        },
                        "--AMD--": function(e, n, f, i, \$r, c, data) {
                          return / /.test(e);
                        },
                        "RX 7900 XTX": function(e, n, f, i, \$r, c, data) {
                          return /RX 7900 XTX/.test(e);
                        },
                        "RX 7900 XT": function(e, n, f, i, \$r, c, data) {
                          return /RX 7900 XT(?!X)/.test(e);
                        },
                        "RX 7900 GRE": function(e, n, f, i, \$r, c, data) {
                          return /RX 7900/.test(e);
                        },
                        "RX 7800 XT": function(e, n, f, i, \$r, c, data) {
                          return /RX 7800 XT/.test(e);
                        },
                        "RX 7700 XT": function(e, n, f, i, \$r, c, data) {
                          return /RX 7700 XT/.test(e);
                        },
                        "RX 7600 XT": function(e, n, f, i, \$r, c, data) {
                          return /RX 7600 XT/.test(e);
                        },
                        "RX 7600": function(e, n, f, i, \$r, c, data) {
                          return /RX 7600(?! XT)/.test(e);
                        },
                        "RX 6950 XT": function(e, n, f, i, \$r, c, data) {
                          return /RX 6950 XT/.test(e);
                        },
                        "RX 6900 XT": function(e, n, f, i, \$r, c, data) {
                          return /RX 6900 XT/.test(e);
                        },
                        "RX 6800 XT": function(e, n, f, i, \$r, c, data) {
                          return /RX 6800 XT/.test(e);
                        },
                        "RX 6800": function(e, n, f, i, \$r, c, data) {
                          return /RX 6800(?! XT)/.test(e);
                        },
                        "RX 6750 XT": function(e, n, f, i, \$r, c, data) {
                          return /RX 6750 XT/.test(e);
                        },
                        "RX 6700 XT": function(e, n, f, i, \$r, c, data) {
                          return /RX 6700 XT/.test(e);
                        },
                        "RX 6700": function(e, n, f, i, \$r, c, data) {
                          return /RX 6700(?! XT)/.test(e);
                        },
                        "RX 6650 XT": function(e, n, f, i, \$r, c, data) {
                          return /RX 6650 XT/.test(e);
                        },
                        "RX 6600 XT": function(e, n, f, i, \$r, c, data) {
                          return /RX 6600 XT/.test(e);
                        },
                        "RX 6600": function(e, n, f, i, \$r, c, data) {
                          return /RX 6600(?! XT)/.test(e);
                        },
                        "RX 6500 XT": function(e, n, f, i, \$r, c, data) {
                          return /RX 6500 XT/.test(e);
                        },
                        "RX 6400": function(e, n, f, i, \$r, c, data) {
                          return /RX 6400/.test(e);
                        },
                        "--Intel--": function(e, n, f, i, \$r, c, data) {
                          return / /.test(e);
                        },
                        "Arc A770": function(e, n, f, i, \$r, c, data) {
                          return /Arc A770/.test(e);
                        },
                        "Arc A750": function(e, n, f, i, \$r, c, data) {
                          return /Arc A750/.test(e);
                        },
                        "Arc A580": function(e, n, f, i, \$r, c, data) {
                          return /Arc A580/.test(e);
                        },
                        "Arc A380": function(e, n, f, i, \$r, c, data) {
                          return /Arc A380/.test(e);
                        },
                        "Arc A310": function(e, n, f, i, \$r, c, data) {
                          return /Arc A310/.test(e);
                        }
                      },
                      6:{
                        "GDDR6X": function(e, n, f, i, \$r, c, data) {
                          return /GDDR6X/.test(e);
                        },
                        "GDDR6": function(e, n, f, i, \$r, c, data) {
                          return /GDDR6/.test(e);
                        },
                        "GDDR5X": function(e, n, f, i, \$r, c, data) {
                          return /GDDR5X/.test(e);
                        },
                        "GDDR5": function(e, n, f, i, \$r, c, data) {
                          return /GDDR5/.test(e);
                        },
                        "DDR3": function(e, n, f, i, \$r, c, data) {
                          return /DDR3/.test(e);
                        },
                        "HBM 2e": function(e, n, f, i, \$r, c, data) {
                          return /HBM2e/.test(e);
                        },
                        "HBM 2": function(e, n, f, i, \$r, c, data) {
                          return /HBM2(!?e)/.test(e);
                        },
                        "HBM": function(e, n, f, i, \$r, c, data) {
                          return /HBM(!?2)/.test(e);
                        }
                      }
                    }
                  }
                });
              });
            </script>
            </head>
            <body>
              <div align="center">
                <h1>GPUリスト</h1>
              </div>
              <h5>青い項目部分をタップorクリックで並べ替えができます。</h5>
              <br>
              <table align="center" border="1" cellpadding="5" class="order-table" id="main-table">
                <thead>
                  <tr>
                    <th></th>
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
            DOM;
      echo $str;
      break;

    case "ssd":
      $str = <<<DOM
            <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>SSD</title>
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
                      1: {
                        "ADATA": function(e, n, f, i, \$r, c, data) {
                          return /ADATA/.test(e);
                        },
                        "ADTEC": function(e, n, f, i, \$r, c, data) {
                          return /ADTEC/.test(e);
                        },
                        "CFD": function(e, n, f, i, \$r, c, data) {
                          return /CFD/.test(e);
                        },
                        "Corsair": function(e, n, f, i, \$r, c, data) {
                          return /Corsair/.test(e);
                        },
                        "crucial": function(e, n, f, i, \$r, c, data) {
                          return /crucial/.test(e);
                        },
                        "GIGABYTE": function(e, n, f, i, \$r, c, data) {
                          return /GIGABYTE/.test(e);
                        },
                        "キングストン": function(e, n, f, i, \$r, c, data) {
                          return /キングストン/.test(e);
                        },
                        "キオクシア": function(e, n, f, i, \$r, c, data) {
                          return /キオクシア/.test(e);
                        },
                        "Lexar": function(e, n, f, i, \$r, c, data) {
                          return /Lexar/.test(e);
                        },
                        "MSI": function(e, n, f, i, \$r, c, data) {
                          return /MSI/.test(e);
                        },
                        "PLEXTOR": function(e, n, f, i, \$r, c, data) {
                          return /PLEXTOR/.test(e);
                        },
                        "PNY": function(e, n, f, i, \$r, c, data) {
                          return /PNY/.test(e);
                        },
                        "サムスン": function(e, n, f, i, \$r, c, data) {
                          return /サムスン/.test(e);
                        },
                        "SANDISK": function(e, n, f, i, \$r, c, data) {
                          return /SANDISK/.test(e);
                        },
                        "Silicon Power": function(e, n, f, i, \$r, c, data) {
                          return /Silicon Power/.test(e);
                        },
                        "Solidigm": function(e, n, f, i, \$r, c, data) {
                          return /Solidigm/.test(e);
                        },
                        "Team": function(e, n, f, i, \$r, c, data) {
                          return /Team/.test(e);
                        },
                        "トランセンド": function(e, n, f, i, \$r, c, data) {
                          return /トランセンド/.test(e);
                        },
                        "WESTERN DIGITAL": function(e, n, f, i, \$r, c, data) {
                          return /WESTERN DIGITAL/.test(e);
                        }
                      },
                      4:{
                        "128GB前後": function(e, n, f, i, \$r, c, data) {
                          return /120GB|128GB/.test(e);
                        },
                        "256GB前後": function(e, n, f, i, \$r, c, data) {
                          return /256GB|250GB|240GB/.test(e);
                        },
                        "512GB前後": function(e, n, f, i, \$r, c, data) {
                          return /500GB|512GB|480GB/.test(e);
                        },
                        "1TB前後": function(e, n, f, i, \$r, c, data) {
                          return /960GB|1000GB|1024GB/.test(e);
                        },
                        "2TB前後": function(e, n, f, i, \$r, c, data) {
                          return /2000GB|2048GB/.test(e);
                        },
                        "4TB前後": function(e, n, f, i, \$r, c, data) {
                          return /4096GB|4000GB/.test(e);
                        },
                        "8TB前後": function(e, n, f, i, \$r, c, data) {
                          return /8000GB|8196GB/.test(e);
                        }
                      },
                      5:{
                        "Serial ATA": function(e, n, f, i, \$r, c, data) {
                          return /Serial ATA/.test(e);
                        },
                        "PCI-Express Gen5": function(e, n, f, i, \$r, c, data) {
                          return /PCI-Express Gen5/.test(e);
                        },
                        "PCI-Express Gen4": function(e, n, f, i, \$r, c, data) {
                          return /PCI-Express Gen4/.test(e);
                        },
                        "PCIe Gen3": function(e, n, f, i, \$r, c, data) {
                          return /PCI-Express(?! Gen4)|PCI-Express Gen3/.test(e);
                        }
                      },
                      6:{
                        "2.5インチ": function(e, n, f, i, \$r, c, data) {
                          return /2.5インチ/.test(e);
                        },
                        "M.2(2280)": function(e, n, f, i, \$r, c, data) {
                          return /Type2280/.test(e);
                        },
                        "M.2(2242)": function(e, n, f, i, \$r, c, data) {
                          return /Type2242/.test(e);
                        },
                        "M.2(2260)": function(e, n, f, i, \$r, c, data) {
                          return /Type2260/.test(e);
                        },
                        "M.2(22110)": function(e, n, f, i, \$r, c, data) {
                          return /Type22110/.test(e);
                        },
                        "mSATA": function(e, n, f, i, \$r, c, data) {
                          return /mSATA/.test(e);
                        },
                        "外付け": function(e, n, f, i, \$r, c, data) {
                          return /外付け/.test(e);
                        }
                      }
                    }
                  }
                });
              });
            </script>
            </head>
            <body>
            <div align="center">
                    <h1>SSDリスト</h1>
            </div>
            <h5>青い項目部分をタップorクリックで並べ替えができます。</h5>
                <br>
                <table align="center" border="1" cellpadding="5" class="order-table" id="main-table">
                  <thead>
                    <tr>
                        <th></th>
                        <th class="maker">メーカー</th>
                        <th class="name">製品名</th>
                        <th class="price">値段</th>
                        <th class="ssd_value">容量</th>
                        <th class="interface">インターフェース</th>
                        <th class="type">形状</th>
                        <th class="readspeed">読込速度</th>
                        <th class="writespeed">書込速度</th>
                    </tr>
                  </thead>
            DOM;
      echo $str;
      break;

    case "ssd2":
      $str = <<<DOM
            <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>SSD2</title>
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
                      1: {
                        "ADATA": function(e, n, f, i, \$r, c, data) {
                          return /ADATA/.test(e);
                        },
                        "ADTEC": function(e, n, f, i, \$r, c, data) {
                          return /ADTEC/.test(e);
                        },
                        "CFD": function(e, n, f, i, \$r, c, data) {
                          return /CFD/.test(e);
                        },
                        "Corsair": function(e, n, f, i, \$r, c, data) {
                          return /Corsair/.test(e);
                        },
                        "crucial": function(e, n, f, i, \$r, c, data) {
                          return /crucial/.test(e);
                        },
                        "GIGABYTE": function(e, n, f, i, \$r, c, data) {
                          return /GIGABYTE/.test(e);
                        },
                        "キングストン": function(e, n, f, i, \$r, c, data) {
                          return /キングストン/.test(e);
                        },
                        "キオクシア": function(e, n, f, i, \$r, c, data) {
                          return /キオクシア/.test(e);
                        },
                        "Lexar": function(e, n, f, i, \$r, c, data) {
                          return /Lexar/.test(e);
                        },
                        "MSI": function(e, n, f, i, \$r, c, data) {
                          return /MSI/.test(e);
                        },
                        "PLEXTOR": function(e, n, f, i, \$r, c, data) {
                          return /PLEXTOR/.test(e);
                        },
                        "PNY": function(e, n, f, i, \$r, c, data) {
                          return /PNY/.test(e);
                        },
                        "サムスン": function(e, n, f, i, \$r, c, data) {
                          return /サムスン/.test(e);
                        },
                        "SANDISK": function(e, n, f, i, \$r, c, data) {
                          return /SANDISK/.test(e);
                        },
                        "Silicon Power": function(e, n, f, i, \$r, c, data) {
                          return /Silicon Power/.test(e);
                        },
                        "Solidigm": function(e, n, f, i, \$r, c, data) {
                          return /Solidigm/.test(e);
                        },
                        "Team": function(e, n, f, i, \$r, c, data) {
                          return /Team/.test(e);
                        },
                        "トランセンド": function(e, n, f, i, \$r, c, data) {
                          return /トランセンド/.test(e);
                        },
                        "WESTERN DIGITAL": function(e, n, f, i, \$r, c, data) {
                          return /WESTERN DIGITAL/.test(e);
                        }
                      },
                      4:{
                        "128GB前後": function(e, n, f, i, \$r, c, data) {
                          return /120GB|128GB/.test(e);
                        },
                        "256GB前後": function(e, n, f, i, \$r, c, data) {
                          return /256GB|250GB|240GB/.test(e);
                        },
                        "512GB前後": function(e, n, f, i, \$r, c, data) {
                          return /500GB|512GB|480GB/.test(e);
                        },
                        "1TB前後": function(e, n, f, i, \$r, c, data) {
                          return /960GB|1000GB|1024GB/.test(e);
                        },
                        "2TB前後": function(e, n, f, i, \$r, c, data) {
                          return /2000GB|2048GB/.test(e);
                        },
                        "4TB前後": function(e, n, f, i, \$r, c, data) {
                          return /4096GB|4000GB/.test(e);
                        },
                        "8TB前後": function(e, n, f, i, \$r, c, data) {
                          return /8000GB|8196GB/.test(e);
                        }
                      },
                    5:{
                        "Serial ATA": function(e, n, f, i, \$r, c, data) {
                          return /Serial ATA/.test(e);
                        },
                        "PCI-Express Gen5": function(e, n, f, i, \$r, c, data) {
                          return /PCI-Express Gen5/.test(e);
                        },
                        "PCI-Express Gen4": function(e, n, f, i, \$r, c, data) {
                          return /PCI-Express Gen4/.test(e);
                        },
                        "PCIe Gen3": function(e, n, f, i, \$r, c, data) {
                          return /PCI-Express(?! Gen4)|PCI-Express Gen3/.test(e);
                        }
                      },
                      6:{
                        "2.5インチ": function(e, n, f, i, \$r, c, data) {
                          return /2.5インチ/.test(e);
                        },
                        "M.2(2280)": function(e, n, f, i, \$r, c, data) {
                          return /Type2280/.test(e);
                        },
                        "M.2(2242)": function(e, n, f, i, \$r, c, data) {
                          return /Type2242/.test(e);
                        },
                        "M.2(2260)": function(e, n, f, i, \$r, c, data) {
                          return /Type2260/.test(e);
                        },
                        "M.2(22110)": function(e, n, f, i, \$r, c, data) {
                          return /Type22110/.test(e);
                        },
                        "mSATA": function(e, n, f, i, \$r, c, data) {
                          return /mSATA/.test(e);
                        },
                        "外付け": function(e, n, f, i, \$r, c, data) {
                          return /外付け/.test(e);
                        }
                      }
                    }
                  }
                });
              });
            </script>
            </head>
            <body>
            <div align="center">
                    <h1>SSDリスト</h1>
            </div>
                <br>
                <h5>青い項目部分をタップorクリックで並べ替えができます。</h5>
                <table align="center" border="1" cellpadding="5" class="order-table" id="main-table">
                  <thead>
                    <tr>
                        <th></th>
                        <th class="maker">メーカー</th>
                        <th class="name">製品名</th>
                        <th class="price">値段</th>
                        <th class="ssd_value">容量</th>
                        <th class="interface">インターフェース</th>
                        <th class="type">形状</th>
                        <th class="readspeed">読込速度</th>
                        <th class="writespeed">書込速度</th>
                    </tr>
                  </thead>
            DOM;
      echo $str;
      break;

    case "hdd":
      $str = <<<DOM
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>HDD</title>
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
                      1: {
                        "HGST": function(e, n, f, i, \$r, c, data) {
                          return /HGST/.test(e);
                        },
                        "SEAGATE": function(e, n, f, i, \$r, c, data) {
                          return /SEAGATE/.test(e);
                        },
                        "CFD": function(e, n, f, i, \$r, c, data) {
                          return /CFD/.test(e);
                        },
                        "WESTERN DIGITAL": function(e, n, f, i, \$r, c, data) {
                          return /WESTERN DIGITAL/.test(e);
                        },
                        "東芝": function(e, n, f, i, \$r, c, data) {
                          return /東芝/.test(e);
                        }
                      },
                      4:{
                        "500GB": function(e, n, f, i, \$r, c, data) {
                          return /500GB/.test(e);
                        },
                        "1TB": function(e, n, f, i, \$r, c, data) {
                          return /1000GB/.test(e);
                        },
                        "2TB": function(e, n, f, i, \$r, c, data) {
                          return /2000GB/.test(e);
                        },
                        "4TB": function(e, n, f, i, \$r, c, data) {
                          return /4000GB/.test(e);
                        },
                        "6TB": function(e, n, f, i, \$r, c, data) {
                          return /6000GB/.test(e);
                        },
                        "8TB": function(e, n, f, i, \$r, c, data) {
                          return /8000GB/.test(e);
                        },
                        "10TB": function(e, n, f, i, \$r, c, data) {
                          return /10000GB/.test(e);
                        },
                        "12TB": function(e, n, f, i, \$r, c, data) {
                          return /12000GB/.test(e);
                        },
                        "14TB": function(e, n, f, i, \$r, c, data) {
                          return /14000GB/.test(e);
                        },
                        "16TB": function(e, n, f, i, \$r, c, data) {
                          return /16000GB/.test(e);
                        },
                        "18TB": function(e, n, f, i, \$r, c, data) {
                          return /18000GB/.test(e);
                        },
                        "20TB": function(e, n, f, i, \$r, c, data) {
                          return /2(?=0000)/.test(e);
                        },
                        "22TB": function(e, n, f, i, \$r, c, data) {
                          return /2(?=2000)/.test(e);
                        }
                      }
                    }
                  }
                });
              });
            </script>
            </head>
            <body>
            <div align="center">
                    <h1>HDDリスト</h1>
                </div>
                <h5>青い項目部分をタップorクリックで並べ替えができます。</h5>
                <br>
                <table align="center" border="1" cellpadding="5" class="order-table" id="main-table">
                  <thead>
                    <tr>
                        <th></th>
                        <th class="maker">メーカー</th>
                        <th class="name">製品名</th>
                        <th class="price">値段</th>
                        <th class="hdd_value">容量</th>
                        <th class="rpm">回転数</th>
                        <th class="interface">インターフェース</th>
                    </tr> 
                  </thead> 
            DOM;
      echo $str;
      break;

    case "psu":
      $str = <<<DOM
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>電源</title>
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
                      1: {
                        "ADATA": function(e, n, f, i, \$r, c, data) {
                          return /ADATA/.test(e);
                        },
                        "ANTEC": function(e, n, f, i, \$r, c, data) {
                          return /ANTEC/.test(e);
                        },
                        "ASUS": function(e, n, f, i, \$r, c, data) {
                          return /ASUS/.test(e);
                        },
                        "COOLER MASTER": function(e, n, f, i, \$r, c, data) {
                          return /COOLER MASTER/.test(e);
                        },
                        "Corsair": function(e, n, f, i, \$r, c, data) {
                          return /Corsair/.test(e);
                        },
                        "DEEPCOOL": function(e, n, f, i, \$r, c, data) {
                          return /DEEPCOOL/.test(e);
                        },
                        "ENERMAX": function(e, n, f, i, \$r, c, data) {
                          return /ENERMAX/.test(e);
                        },
                        "Fractal Design": function(e, n, f, i, \$r, c, data) {
                          return /Fractal Design/.test(e);
                        },
                        "FSP": function(e, n, f, i, \$r, c, data) {
                          return /FSP/.test(e);
                        },
                        "IN WIN": function(e, n, f, i, \$r, c, data) {
                          return /IN WIN/.test(e);
                        },
                        "LIAN LI": function(e, n, f, i, \$r, c, data) {
                          return /LIAN LI/.test(e);
                        },
                        "MSI": function(e, n, f, i, \$r, c, data) {
                          return /MSI/.test(e);
                        },
                        "NZXT": function(e, n, f, i, \$r, c, data) {
                          return /NZXT/.test(e);
                        },
                        "Phanteks": function(e, n, f, i, \$r, c, data) {
                          return /Phanteks/.test(e);
                        },
                        "Seasonic": function(e, n, f, i, \$r, c, data) {
                          return /Seasonic/.test(e);
                        },
                        "SILVERSTONE": function(e, n, f, i, \$r, c, data) {
                          return /SILVERSTONE/.test(e);
                        },
                        "SUPER FLOWER": function(e, n, f, i, \$r, c, data) {
                          return /SUPER FLOWER/.test(e);
                        },
                        "Thermaltake": function(e, n, f, i, \$r, c, data) {
                          return /Thermaltake/.test(e);
                        },
                        "オウルテック": function(e, n, f, i, \$r, c, data) {
                          return /オウルテック/.test(e);
                        },
                        "ニプロン": function(e, n, f, i, \$r, c, data) {
                          return /ニプロン/.test(e);
                        },
                        "玄人志向": function(e, n, f, i, \$r, c, data) {
                          return /玄人志向/.test(e);
                        }
                      },
                      4:{
                        "500W台": function(e, n, f, i, \$r, c, data) {
                          return /(?<!1)5[0-9][0-9]W/.test(e);
                        },
                        "600W台": function(e, n, f, i, \$r, c, data) {
                          return /6[0-9][0-9]W/.test(e);
                        },
                        "700W台": function(e, n, f, i, \$r, c, data) {
                          return /7[0-9][0-9]W/.test(e);
                        },
                        "800W台": function(e, n, f, i, \$r, c, data) {
                          return /8[0-9][0-9]W/.test(e);
                        },
                        "900W台": function(e, n, f, i, \$r, c, data) {
                          return /9[0-9][0-9]W/.test(e);
                        },
                        "1000W台": function(e, n, f, i, \$r, c, data) {
                          return /10[0-9][0-9]W/.test(e);
                        },
                        "1200W台": function(e, n, f, i, \$r, c, data) {
                          return /12[0-9][0-9]W/.test(e);
                        },
                        "1300W台": function(e, n, f, i, \$r, c, data) {
                          return /13[0-9][0-9]W/.test(e);
                        },
                        "1600W台": function(e, n, f, i, \$r, c, data) {
                          return /16[0-9][0-9]W/.test(e);
                        },
                        "2000W台": function(e, n, f, i, \$r, c, data) {
                          return /20[0-9][0-9]W/.test(e);
                        }
                      },
                      5:{
                        "Standard": function(e, n, f, i, \$r, c, data) {
                          return /Standard/.test(e);
                        },
                        "Bronze": function(e, n, f, i, \$r, c, data) {
                          return /Bronze|BRONZE/.test(e);
                        },
                        "Silver": function(e, n, f, i, \$r, c, data) {
                          return /Silver/.test(e);
                        },
                        "Gold": function(e, n, f, i, \$r, c, data) {
                          return /Gold|GOLD/.test(e);
                        },
                        "Platinum": function(e, n, f, i, \$r, c, data) {
                          return /Platinum/.test(e);
                        },
                        "Titanium": function(e, n, f, i, \$r, c, data) {
                          return /Titanium/.test(e);
                        }
                      },
                      6:{
                        "ATX v3.0": function(e, n, f, i, \$r, c, data) {
                          return /ATX v3.0/.test(e);
                        },
                        "ATX": function(e, n, f, i, \$r, c, data) {
                          return /ATX/.test(e);
                        },
                        "SFX": function(e, n, f, i, \$r, c, data) {
                          return /SFX/.test(e);
                        },
                        "SFX-L": function(e, n, f, i, \$r, c, data) {
                          return /SFX-L/.test(e);
                        },
                        "FlexATX": function(e, n, f, i, \$r, c, data) {
                          return /FlexATX/.test(e);
                        },
                        "TFX": function(e, n, f, i, \$r, c, data) {
                          return /TFX/.test(e);
                        }
                      }
                    }
                  }
                });
              });
            </script>
            </head>
            <body>
            <div align="center">
              <h1>電源リスト</h1>
            </div>
            <h5>青い項目部分をタップorクリックで並べ替えができます。</h5>
                <br>
                <table align="center" border="1" cellpadding="5" class="order-table" id="main-table">
                  <thead>
                    <tr>
                        <th></th>
                        <th class="maker">メーカー</th>
                        <th class="name">製品名</th>
                        <th class="price">値段</th>
                        <th class="psu_value">容量</th>
                        <th class="efficiency">認証</th>
                        <th class="formfactor">フォームファクタ</th>
                        <th class="plug_in">プラグイン対応の有無</th>
                    </tr> 
                  </thead>
            DOM;
      echo $str;
      break;

    case "pccase":
      $str = <<<DOM
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>ケース</title>
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
                      1: {
                        "Abee": function(e, n, f, i, \$r, c, data) {
                          return /Abee/.test(e);
                        },
                        "ADATA": function(e, n, f, i, \$r, c, data) {
                          return /ADATA/.test(e);
                        },
                        "ANTEC": function(e, n, f, i, \$r, c, data) {
                          return /ANTEC/.test(e);
                        },
                        "ASUS": function(e, n, f, i, \$r, c, data) {
                          return /ASUS/.test(e);
                        },
                        "AZZA": function(e, n, f, i, \$r, c, data) {
                          return /AZZA/.test(e);
                        },
                        "be quiet": function(e, n, f, i, \$r, c, data) {
                          return /be quiet/.test(e);
                        },
                        "COOLER MASTER": function(e, n, f, i, \$r, c, data) {
                          return /COOLER MASTER/.test(e);
                        },
                        "Corsair": function(e, n, f, i, \$r, c, data) {
                          return /Corsair/.test(e);
                        },
                        "COUGAR": function(e, n, f, i, \$r, c, data) {
                          return /COUGAR/.test(e);
                        },
                        "darkFlash": function(e, n, f, i, \$r, c, data) {
                          return /darkFlash/.test(e);
                        },
                        "DEEPCOOL": function(e, n, f, i, \$r, c, data) {
                          return /DEEPCOOL/.test(e);
                        },
                        "ENERMAX": function(e, n, f, i, \$r, c, data) {
                          return /ENERMAX/.test(e);
                        },
                        "Fractal Design": function(e, n, f, i, \$r, c, data) {
                          return /Fractal Design/.test(e);
                        },
                        "HEC": function(e, n, f, i, \$r, c, data) {
                          return /HEC/.test(e);
                        },
                        "HYTE": function(e, n, f, i, \$r, c, data) {
                          return /HYTE/.test(e);
                        },
                        "IN WIN": function(e, n, f, i, \$r, c, data) {
                          return /IN WIN/.test(e);
                        },
                        "LIAN LI": function(e, n, f, i, \$r, c, data) {
                          return /LIAN LI/.test(e);
                        },
                        "MSI": function(e, n, f, i, \$r, c, data) {
                          return /MSI/.test(e);
                        },
                        "NZXT": function(e, n, f, i, \$r, c, data) {
                          return /NZXT/.test(e);
                        },
                        "Phanteks": function(e, n, f, i, \$r, c, data) {
                          return /Phanteks/.test(e);
                        },
                        "Sharkoon": function(e, n, f, i, \$r, c, data) {
                          return /Sharkoon/.test(e);
                        },
                        "SILVERSTONE": function(e, n, f, i, \$r, c, data) {
                          return /SILVERSTONE/.test(e);
                        },
                        "SSUPD": function(e, n, f, i, \$r, c, data) {
                          return /SSUPD/.test(e);
                        },
                        "SUPERMICRO": function(e, n, f, i, \$r, c, data) {
                          return /SUPERMICRO/.test(e);
                        },
                        "Thermaltake": function(e, n, f, i, \$r, c, data) {
                          return /Thermaltake/.test(e);
                        },
                        "Razer": function(e, n, f, i, \$r, c, data) {
                          return /Razer/.test(e);
                        },
                        "RAIJINTEK": function(e, n, f, i, \$r, c, data) {
                          return /RAIJINTEK/.test(e);
                        },
                        "ZALMAN": function(e, n, f, i, \$r, c, data) {
                          return /ZALMAN/.test(e);
                        },
                        "サイズ": function(e, n, f, i, \$r, c, data) {
                          return /サイズ/.test(e);
                        },
                        "長尾製作所": function(e, n, f, i, \$r, c, data) {
                          return /長尾製作所/.test(e);
                        }
                      },
                      4:{
                        "ATX": function(e, n, f, i, \$r, c, data) {
                          return /[0-9]\sATX\s/.test(e);
                        },
                        "E-ATX": function(e, n, f, i, \$r, c, data) {
                          return /E-ATX/.test(e);
                        },
                        "MicroATX": function(e, n, f, i, \$r, c, data) {
                          return /MicroATX/.test(e);
                        },
                        "MiniITX": function(e, n, f, i, \$r, c, data) {
                          return /MiniITX/.test(e);
                        }
                      }
                    }
                  }
                });
              });
            </script>
            </head>
            <body>
            <div align="center">
                    <h1>ケースリスト</h1>
                </div>
                <h5>青い項目部分をタップorクリックで並べ替えができます。</h5>
                <br>
                <table align="center" border="1" cellpadding="5" class="order-table" id="main-table">
                  <thead>
                    <tr>
                        <th></th>
                        <th class="maker">メーカー</th>
                        <th class="name">製品名</th>
                        <th class="price">値段</th>
                        <th class="formfactor">フォームファクタ</th>
                        <th class="cpu_height">CPU最大高</th>
                        <th class="gpu_length">GPU最大長</th>
                    </tr> 
                  </thead>
            DOM;
      echo $str;
      break;
    
    case "os":
      $str = <<<DOM
      <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>os</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
      <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.0/js/jquery.tablesorter.js"></script>
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.0/js/jquery.tablesorter.widgets.js"></script>
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
                }
              }
          });
        });
      </script>
        </head>
        <body>
        <div align="center">
                <h1>OSリスト</h1>
            </div>
            <h5>青い項目部分をタップorクリックで並べ替えができます。</h5>
            <br>
            <table align="center" border="1" cellpadding="5" class="order-table" id="main-table">
                <thead>
                <tr>
                    <th></th> 
                    <th class="maker">メーカー</th>
                    <th class="name">製品名</th>
                    <th class="price">値段</th>
                </tr> 
                </thead>
      DOM;
      echo $str;
      break;
  }
}
