<?php
require_once 'header.php';

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

session_start();
require_once "ascii.php";
?>
<div id="mainform">
<form action="inputnum.php" method="post" enctype="multipart/form-data">
    <h1>Введите данные</h1>
    <input type="text" name="surname" placeholder="Введите строку" value="<?php echo old('surname') ?>"></input><br>
    <input type="text" name="p" placeholder="Значение p" value="<?php echo old('p') ?>"></input><br>
    <input type="text" name="q" placeholder="Значение q" value="<?php echo old('q') ?>"></input><br>
    <input type="submit" value="Решить">
</form>
</div><br>

<?php
$surname = (string)$_SESSION['num']['surname'];
$p = (int)$_SESSION['num']['p'];
$q = (int)$_SESSION['num']['q'];
$n = $p * $q;

if($p == 0 || $q == 0 || $surname == ""){
    echo "<h3>Заполните все поля</h3>";
    exit(0);
}

if(primeCheck($p) == 0 || primeCheck($q) == 0){
    echo "<h3>Числа не являются простыми</h3>";
    exit(0);
}

$arrSurname = str_split($surname, 2);

$halfBinaryIndex = 1;
foreach($arrSurname as $val){
    $halfBinary[$halfBinaryIndex++] = str_split(decbin($ascii[$val]), 4);
}

$b = 1;
$countHalfBinary = count($halfBinary);
for($i = 1; $i <= $countHalfBinary; $i++)
{
    $halfSymbolBinary[$b++] = (string)1111 . $halfBinary[$i][0];
    $halfSymbolBinary[$b++] = (string)1111 . $halfBinary[$i][1];
}

$H = "00000000";
$countHalfSymbolBinary = count($halfSymbolBinary);

for($iterationIndex = 1; $iterationIndex <= $countHalfSymbolBinary; $iterationIndex++)
{
    echo "<div>";
    echo "<h1>Итерация $iterationIndex</h1>";
    $sTran = $iterationIndex - 1; 
    echo "M$iterationIndex = " . $halfSymbolBinary[$iterationIndex] . '<br>';
    echo "H$sTran = " . $H . '<br>';
    $sum = myXor($halfSymbolBinary[$iterationIndex], $H);
    echo "M+H = " . $sum . " = " . bindec($sum) . '<br>';
    $fullsum = pow(bindec($sum), 2) % $n;
    echo "(M+H)^2mod($n) = " . $fullsum . '<br>';
    $H = decbin($fullsum);
    echo "H$iterationIndex = " . $H . '<br>';
    echo "</div>";
}

echo "<div><h1>Результат: $H</h1></div>";
?>
</body>
</html>