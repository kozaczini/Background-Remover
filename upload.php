<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sprawdzenie, czy plik został przesłany
    if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        die('Błąd podczas przesyłania pliku!');
    }

    // Pobranie ścieżki do przesłanego pliku
    $file = $_FILES['image']['tmp_name'];

    // Konfiguracja API Remove.bg
    $apiKey = 'b1v95reFWrLJPmNMj6R96XNd'; // Wprowadź swój klucz API
    $url = 'https://api.remove.bg/v1.0/removebg';

    // Wysłanie pliku do Remove.bg API
    $cFile = curl_file_create($file);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'X-Api-Key: ' . $apiKey
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, [
        'image_file' => $cFile,
        'size' => 'auto',
    ]);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        die('Błąd API: ' . curl_error($ch));
    }

    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($http_code !== 200) {
        die('API zwróciło błąd: ' . $response);
    }

    curl_close($ch);

    // Zapisanie obrazu bez tła na serwerze
    $outputFile = 'output.png';
    file_put_contents($outputFile, $response);

    // Wyświetlenie obrazu do pobrania
    echo '<h1>Obraz bez tła</h1>';
    echo '<img src="' . $outputFile . '" alt="Image without background">';
    echo '<a href="' . $outputFile . '" download="image_no_bg.png">Pobierz obraz</a>';
}
?>