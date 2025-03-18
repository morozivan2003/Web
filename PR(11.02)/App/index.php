<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация животного</title>
</head>

<?php
    $csvFile = 'animal_registry.csv';
    $message = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $animalType = trim($_POST['animal_type'] ?? '');
        $cageNumber = intval($_POST['cage_number'] ?? 0);
        $careInstructions = trim($_POST['care_instructions'] ?? '');

        // Валидация данных (пример)
        $errors = [];
        if (empty($animalType)) {
            $errors[] = 'Пожалуйста, выберите тип животного.';
        }
        if ($cageNumber <= 0) {
            $errors[] = 'Пожалуйста, введите корректный номер клетки.';
        }

        if (empty($errors)) {
            $dataRow = [$animalType, $cageNumber, $careInstructions];

            if (($file = fopen($csvFile, 'a')) !== false) {
                fputcsv($file, $dataRow);
                fclose($file);
                $message = '<div class="message success">Данные о животном успешно зарегистрированы!</div>';
            } else {
                $message = '<div class="message error">Ошибка при сохранении данных. Пожалуйста, попробуйте позже.</div>';
            }
        } else {
            // Формируем сообщение об ошибках
            $message = '<div class="message error"><ul>';
            foreach ($errors as $error) {
                $message .= '<li>' . htmlspecialchars($error) . '</li>';
            }
            $message .= '</ul></div>';
        }
    }
?>
<body>

    <h1>Регистрация животного</h1>

    <?php if (!empty($message)): ?>
        <?= $message ?>
    <?php endif; ?>

    <form action="" method="POST">
        <label for="animal_type">Тип животного:</label>
        <select name="animal_type" id="animal_type" required>
            <option value="">Выберите тип...</option>
            <option value="слон">Слон</option>
            <option value="лев">Лев</option>
            <option value="тигр">Тигр</option>
            <option value="пингвин">Пингвин</option>
            <option value="обезьяна">Обезьяна</option>
        </select>

        <label for="cage_number">Номер клетки:</label>
        <input type="number" name="cage_number" id="cage_number" min="1" required>

        <label for="care_instructions">Инструкции по уходу:</label>
        <textarea name="care_instructions" id="care_instructions" rows="4"></textarea>

        <input type="submit" value="Зарегистрировать животное">
    </form>

</body>
</html>