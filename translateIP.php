<?php
require_once "ascii.php";
session_start();
require_once 'header.php';
?>

<div id="mainform">
<form action="AdrMas.php" method="post" enctype="multipart/form-data">
    <h1>Введите данные</h1>
    <input type="text" name="adres" placeholder="Введите adres" value="<?php echo old('adres') ?>"></input><br>
    <input type="text" name="mask" placeholder="Mask" value="<?php echo old('mask') ?>"></input><br>
    <input type="submit" value="Решить">
</form>
</div><br>

<?php

//2
$binAdres = '10010001-01001000-00001011-01010010-10000000-10100101';
$normalBinAdres = str_replace('-', '', $binAdres);
$arrBinAdres = str_split($normalBinAdres, 4);

$arrCount = count($arrBinAdres);
for($i =0; $i < $arrCount; $i++){
    $arrBinAdres[$i] = dechex(bindec($arrBinAdres[$i]));
}
echo "<span>Из 2 в 16: " . implode($arrBinAdres) . "</span><br>";

//16
$map = array(
    "0" => "0000",
    "1" => "0001",
    "2" => "0010",
    "3" => "0011",
    "4" => "0100",
    "5" => "0101",
    "6" => "0110",
    "7" => "0111",
    "8" => "1000",
    "9" => "1001",
    "A" => "1010",
    "B" => "1011",
    "C" => "1100",
    "D" => "1101",
    "E" => "1110",
    "F" => "1111",
    "-" => "."
  );
$hex = 'B2-53-1C-DA-26-8A';
$bin ='';
for($j=0;$j<strlen($hex);$j++){
    $bin .= $map[$hex[$j]];
}
echo "<span>Из 16 в 2: " . $bin . "</span><br>";

//binary
$adres = (string)$_SESSION['num']['adres'];
$mask = (string)$_SESSION['num']['mask'];
$arrAdres = explode(".", $adres);
$arrMask = explode(".", $mask);
$binAdres = '';
$binMask = '';
for($i =0; $i < count($arrAdres); $i++){
    $binAdres .= sprintf("%08d", decbin($arrAdres[$i]));
    $binMask .= sprintf("%08d", decbin($arrMask[$i]));
}
echo "<span>Адрес: " . $binAdres . "</span><br>";
echo "<span>Маска: " . $binMask . "</span><br>";

//number host
$numberWier = $binAdres & $binMask;
echo "<span>" . $numberWier . "</span><br>";
$numberWierDec = '';
$numberWierDecNoDot = '';
$arrWier = str_split($numberWier, 8);
for($i =0; $i < count($arrWier); $i++){
    $numberWierDec .= bindec($arrWier[$i]) . ".";
    $numberWierDecNoDot .= bindec($arrWier[$i]);
}
echo "<span>" . $numberWierDec . "</span><br>";


?>
</body>
</html>