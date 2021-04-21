<form action="/onboarding/sumGET/sumGET.php" method="get">
    <input type="text" placeholder="a" name="a">
    <input type="text" placeholder="b" name="b">
    <button type="submit">Sum</button>
</form>


<?php
$a = "";
$b = '';

$a = $_GET['a'];
$b = $_GET['b'];

$sum = $a + $b;

echo "Sum is : " . $sum;

?>