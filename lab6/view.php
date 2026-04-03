
<?php

$file = "data.json";

$records = [];

if(file_exists($file)){
    $records = json_decode(file_get_contents($file), true) ?? [];
}

$sort = $_GET["sort"] ?? null;

if($sort){
    usort($records, function($a,$b) use ($sort){
        return $a[$sort] <=> $b[$sort];
    });
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<title>Список привычек</title>
<style>
table{border-collapse:collapse;width:100%}
td,th{border:1px solid #ccc;padding:8px}
th{background:#eee}
</style>
</head>
<body>

<h2>Сохранённые привычки</h2>

<p>Сортировать по:
<a href="?sort=title">Название</a> |
<a href="?sort=start_date">Дата начала</a> |
<a href="?sort=category">Категория</a>
</p>

<table>
<tr>
<th>Название</th>
<th>Описание</th>
<th>Категория</th>
<th>Сложность</th>
<th>Дата начала</th>
<th>Автор</th>
<th>Дата создания</th>
</tr>

<?php foreach($records as $r): ?>
<tr>
<td><?= htmlspecialchars($r["title"]) ?></td>
<td><?= htmlspecialchars($r["description"]) ?></td>
<td><?= htmlspecialchars($r["category"]) ?></td>
<td><?= htmlspecialchars($r["difficulty"]) ?></td>
<td><?= htmlspecialchars($r["start_date"]) ?></td>
<td><?= htmlspecialchars($r["author"]) ?></td>
<td><?= htmlspecialchars($r["created_at"]) ?></td>
</tr>
<?php endforeach; ?>

</table>

<p><a href="index.php">Добавить новую привычку</a></p>

</body>
</html>
