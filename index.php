<?php
require_once 'header.php';

// ini_set('display_errors', 0);
// ini_set('display_startup_errors', 0);
// error_reporting(E_ALL);

session_start();
require_once "ascii.php";
?>
<div id="mainform">
<form action="inputnum.php" method="post" enctype="multipart/form-data">
    <h1>Введите данные</h1>
    <input type="text" name="surname" placeholder="Введите фамилию" value="<?php echo old('surname') ?>"></input><br>
    <input type="text" name="p" placeholder="Значение p" value="<?php echo old('p') ?>"></input><br>
    <input type="text" name="q" placeholder="Значение q" value="<?php echo old('q') ?>"></input><br>
    <input type="submit" value="Решить">
</form>
</div><br>

<?php
$arrSurname = str_split((string)$_SESSION['num']['surname'], 2);
$p = (int)$_SESSION['num']['p'];
$q = (int)$_SESSION['num']['q'];
$n = $p * $q;

$j = 1;
foreach($arrSurname as $val){
    $polBinary[$j++] = str_split(decbin($ascii[$val]), 4);
}

$b = 1;
$countPolBinary = count($polBinary);
for($i = 1; $i <= $countPolBinary; $i++)
{
    $newBinary[$b++] = (string)1111 . $polBinary[$i][0];
    $newBinary[$b++] = (string)1111 . $polBinary[$i][1];
}

$H = "00000000";
$countNewBinary = count($newBinary);
if($_SESSION['num'] !== NULL){
for($s = 1; $s <= $countNewBinary; $s++)
{
    echo "<div>";
    echo "<h1>Итерация $s</h1>";
    $sTran = $s - 1; 
    echo "M$s = " . $newBinary[$s] . '<br>';
    echo "H$sTran = " . $H . '<br>';
    $sum = myXor($newBinary[$s], $H);
    echo "M+H = " . $sum . " = " . bindec($sum) . '<br>';
    $fullsum = pow(bindec($sum), 2) % $n;
    echo "(M+H)^2mod($n) = " . $fullsum . '<br>';
    $H = decbin($fullsum);
    echo "H$s = " . $H . '<br>';
    echo "</div>";
}}
?>
</body>
</html>