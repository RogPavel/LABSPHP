
<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<title>Трекер привычек - Добавить привычку</title>
<style>
body{font-family:Arial;margin:40px;background:#f5f5f5}
form{background:white;padding:20px;border-radius:8px;max-width:600px}
input,textarea,select{width:100%;padding:8px;margin:8px 0}
button{padding:10px 15px}
</style>
</head>
<body>

<h2>Добавить новую привычку</h2>

<form action="process.php" method="POST">

<label>Название привычки</label>
<input type="text" name="title" required minlength="3" maxlength="50">

<label>Описание</label>
<textarea name="description" required minlength="5"></textarea>

<label>Категория</label>
<select name="category" required>
<option value="здоровье">Здоровье</option>
<option value="учёба">Учёба</option>
<option value="спорт">Спорт</option>
<option value="продуктивность">Продуктивность</option>
</select>

<label>Сложность</label>
<select name="difficulty" required>
<option value="легко">Легко</option>
<option value="средне">Средне</option>
<option value="сложно">Сложно</option>
</select>

<label>Дата начала</label>
<input type="date" name="start_date" required>

<label>Автор</label>
<input type="text" name="author" required minlength="2">

<button type="submit">Сохранить привычку</button>

</form>

<p><a href="view.php">Посмотреть сохранённые привычки</a></p>

</body>
</html>
