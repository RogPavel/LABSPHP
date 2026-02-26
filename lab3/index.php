<?php
$day = date("N");


$days = [
    1 => "Понедельник",
    2 => "Вторник",
    3 => "Среда",
    4 => "Четверг",
    5 => "Пятница",
    6 => "Суббота",
    7 => "Воскресенье"
];

echo "<h2>Сегодня: " . $days[$day] . "</h2>";

// Определяем график John Styles
if ($day == 1 || $day == 3 || $day == 5) {
    $johnSchedule = "8:00-12:00";
} else {
    $johnSchedule = "Нерабочий день";
}

// Определяем график Jane Doe
if ($day == 2 || $day == 4 || $day == 6) {
    $janeSchedule = "12:00-16:00";
} else {
    $janeSchedule = "Нерабочий день";
}

// Вывод таблицы
echo "
<table border='1' cellpadding='10'>
    <tr>
        <th>№</th>
        <th>Фамилия Имя</th>
        <th>График работы</th>
    </tr>
    <tr>
        <td>1</td>
        <td>John Styles</td>
        <td>$johnSchedule</td>
    </tr>
    <tr>
        <td>2</td>
        <td>Jane Doe</td>
        <td>$janeSchedule</td>
    </tr>
</table>
";



$a = 0;
$b = 0;

for ($i = 0; $i <= 5; $i++) {
   $a += 10;
   $b += 5;
}

echo "End of the loop: a = $a, b = $b";

$a = 0;
$b = 0;

for ($i = 0; $i <= 5; $i++) {
    $a += 10;
    $b += 5;

    echo "Шаг $i: a = $a, b = $b <br>";
}

echo "<br>End of the loop: a = $a, b = $b";

$a = 0;
$b = 0;
$i = 0;

while ($i <= 5) {
    $a += 10;
    $b += 5;

    echo "Шаг $i: a = $a, b = $b <br>";

    $i++;
}

echo "<br>End of the loop: a = $a, b = $b";

$a = 0;
$b = 0;
$i = 0;

do {
    $a += 10;
    $b += 5;

    echo "Шаг $i: a = $a, b = $b <br>";

    $i++;
} while ($i <= 5);

echo "<br>End of the loop: a = $a, b = $b";
?>