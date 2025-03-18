<?php
    require 'db.php';
    $file = fopen("animal_registry.csv", "r");
    while (($data = fgetcsv($file, 1000, ",")) !=false) {
        $stmt = $pdo->prepare("INSERT INTO Animal_info (animal_name,animal_cage,animal_instruction) VALUE (?,?,?)");
        $stmt -> execute([$data[0],$data[1], $data[2]]);
    }
    fclose($file);
    echo "Загружены данные";
?>