
<?php

require_once 'validators/RequiredValidator.php';
require_once 'validators/DateValidator.php';

$data = $_POST;

$validators = [
    "title" => [new RequiredValidator()],
    "description" => [new RequiredValidator()],
    "category" => [new RequiredValidator()],
    "difficulty" => [new RequiredValidator()],
    "start_date" => [new RequiredValidator(), new DateValidator()],
    "author" => [new RequiredValidator()]
];

$errors = [];

foreach($validators as $field => $rules){
    foreach($rules as $validator){
        if(!$validator->validate($data[$field] ?? null)){
            $errors[$field] = $validator->getError();
        }
    }
}

if(!empty($errors)){
    echo "<h3>Ошибки валидации:</h3>";
    foreach($errors as $e){
        echo "<p>$e</p>";
    }
    echo "<a href='index.php'>Вернуться назад</a>";
    exit;
}

$file = "data.json";
$records = [];

if(file_exists($file)){
    $records = json_decode(file_get_contents($file), true) ?? [];
}

$data["created_at"] = date("Y-m-d H:i:s");

$records[] = $data;

file_put_contents($file, json_encode($records, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

echo "<h3>Привычка успешно сохранена</h3>";
echo "<a href='view.php'>Посмотреть список привычек</a>";
