<?php
$url = "http://lab.vntu.org/api-server/lab8.php?user=student&pass=p@ssw0rd";
$json_data = file_get_contents($url);

if ($json_data === false) {
    die("Помилка отримання даних");
}

$data = json_decode($json_data, true);
if ($data === null) {
    die("Помилка JSON");
}

$all_people = [];
foreach ($data as $group) {
    if (is_array($group)) {
        $all_people = array_merge($all_people, $group);
    }
}

/* 🔹 Словник імен (англ → укр) */
$name_map = [
    "Murai" => "Мурай",
    "Yang Wen-li" => "Ян Вен-лі",
    "Julian Mintz" => "Юліан Мінц",
    "Willibald Joachim von Merkatz" => "Віллібальд Йоахім фон Меркац",
    "Wolfgang Mittermeyer" => "Вольфганг Міттермаєр",
    "Oskar von Reuenthal" => "Оскар фон Ройєнталь",
    "Reinhard von Lohengramm" => "Райнхард фон Лоенграмм",
    "Siegfried Kircheis" => "Зігфрід Кірхайс"
];

$ukr_cities = ["Київ", "Львів", "Одеса", "Харків", "Вінниця"];

foreach ($all_people as &$person) {
    $person['name'] = $name_map[$person['name']] ?? $person['name'];
    $person['age'] = rand(20, 55);
    $person['city'] = $ukr_cities[array_rand($ukr_cities)];
}
unset($person);
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Список людей</title>
    <style>
        table { border-collapse: collapse; width: 70%; margin: 20px auto; }
        th, td { border: 1px solid #000; padding: 8px; text-align: center; }
        th { background: #eee; }
    </style>
</head>
<body>

<h2 style="text-align:center;">Список людей</h2>

<table>
    <tr>
        <th>Ім’я</th>
        <th>Вік</th>
        <th>Місто</th>
    </tr>

    <?php foreach ($all_people as $p): ?>
    <tr>
        <td><?= htmlspecialchars($p['name']) ?></td>
        <td><?= $p['age'] ?></td>
        <td><?= $p['city'] ?></td>
    </tr>
    <?php endforeach; ?>

</table>

</body>
</html>
