<header>

</header>
<body>
<?
include_once "Query_Encoder.php";
echo"よめとるぞ";
$test_str = "cpu=3&cpuc=1&ram=1&mb=1&gpu=1&ssd2=1&hdd=9&psu=5&pccase=12&os=10";
$test_pcs_array = [1,1,1,1,1,1,1,1,1,1,1];

parse_str($test_str,$test_array);

$encoder = new Query_Encoder;

//var_dump($test_array);

$encode_result = $encoder ->encode($test_array,$test_pcs_array);

echo($encode_result."<br><br><br>");

$decode_result = $encoder -> decode("query=".$encode_result);

var_dump($decode_result);
?>
</body>