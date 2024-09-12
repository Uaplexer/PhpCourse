// 1
<?php
echo 'Hello world!';?> // Shows output 'Hello world!' on console

<?php
echo '<br>';
$str = 'Row';
$int = 50;
$float = 3.14;
$bool = true;

echo $str;
echo '<br>';
echo $int;
echo '<br>';
echo $float;
echo '<br>';
echo $bool;
echo '<br>';

var_dump($str);
echo '<br>';
var_dump($int);
echo '<br>';
var_dump($float);
echo '<br>';
var_dump($bool);
echo '<br>';?>

<?php
$hello = 'hello';
$world = 'world';

$fullHelloWorld = $hello . ' ' . $world;

echo $fullHelloWorld . '<br>';
?>

<?php
$num = 5;

if ($num % 2 == 0) {
    echo '$num is even';
} else {
    echo '$num is odd';
}
echo '<br>';
?>

<?php
for ($i = 1; $i <= 10; $i++) {
    echo $i . ' ';
}
echo '<br>';

$i = 10;
while ($i >= 1) {
    echo $i . ' ';
    $i--;
}
echo '<br>';
?>

<?php
$student = [
    'first_name' => 'Christopher',
    'last_name' => 'Jason',
    'age' => 18,
    'major' => 'Computer Science'
];

echo 'First Name: ' . $student['first_name'] . '<br>';
echo 'Last Name: ' . $student['last_name'] . '<br>';
echo 'Age: ' . $student['age'] . '<br>';
echo 'Major: ' . $student['major'] . '<br>';

$student['avg_grade'] = 3.9;

echo '<br>Updated student information:<br>';
foreach ($student as $key => $value) {
    echo "{$key}: {$value} <br>";
}
?>


