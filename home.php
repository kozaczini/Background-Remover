<!DOCTYPE html>
<?php
require 'conn.php';
session_start();
if(!ISSET($_SESSION['user'])){
    header('location:index.php');
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Background Remover</title>
    <style>
    @import URL("styl.css");    
    </style>
</head>
<body>
<div class="col-md-3"></div>
<div class="col-md-6 well"></div>
<h3 class="text-primary">Background Remover
</h3>

    <hr style="border-top:1px dotted #ccc;"/>
    <div class="col-md-2"></div>
    <div class="col-md-7">
        <h3>Remove your background,
        
        <?php
        $id = $_SESSION['user'];
        $sql = $conn->prepare("SELECT * FROM `data` WHERE `id` = '$id'");


        $sql->execute();
        $fetch = $sql->fetch();
        ?>
        <?php
            echo $fetch['username']." "?>
        </h3>
        <a href="logout.php">Logout</a>
    </div>
    <div class="remover_scripts">
    <form action="home.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="image" accept="image/*" required>
        <button type="submit">Upload</button>
    </form>
    <?php
// Sprawdzenie, czy formularz został wysłany metodą POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sprawdzenie, czy plik został poprawnie przesłany
    if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        die('Błąd podczas przesyłania pliku!'); // Zatrzymanie programu w przypadku błędu
    }

    // Pobranie tymczasowej ścieżki do przesłanego pliku
    $file = $_FILES['image']['tmp_name'];

    // Konfiguracja klucza API i URL do Remove.bg
    $apiKey = 'b1v95reFWrLJPmNMj6R96XNd'; // Wprowadź swój klucz API
    $url = 'https://api.remove.bg/v1.0/removebg';

    // Przygotowanie pliku do wysłania w żądaniu POST
    $cFile = curl_file_create($file); // Tworzy obiekt pliku do przesyłania przez cURL
    $ch = curl_init(); // Inicjalizacja sesji cURL

    // Ustawienie URL do API
    curl_setopt($ch, CURLOPT_URL, $url);

    // Oczekiwanie na odpowiedź jako string (nie wyświetlanie jej od razu)
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Ustawienie metody POST
    curl_setopt($ch, CURLOPT_POST, true);

    // Dodanie nagłówka autoryzacyjnego z kluczem API
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'X-Api-Key: ' . $apiKey
    ]);

    // Przekazanie pliku i ustawień do API
    curl_setopt($ch, CURLOPT_POSTFIELDS, [
        'image_file' => $cFile, // Plik obrazu
        'size' => 'auto', // Automatyczny rozmiar wynikowego obrazu
    ]);

    // Wysłanie żądania do API
    $response = curl_exec($ch);

    // Sprawdzenie, czy wystąpił błąd połączenia z API
    if (curl_errno($ch)) {
        die('Błąd API: ' . curl_error($ch)); // Wyświetlenie błędu i zakończenie programu
    }

    // Pobranie kodu odpowiedzi HTTP
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // Sprawdzenie, czy API zwróciło sukces
    if ($http_code !== 200) {
        die('API zwróciło błąd: ' . $response); // Wyświetlenie odpowiedzi w przypadku błędu
    }

    // Zamknięcie sesji cURL
    curl_close($ch);

    // Zapisanie wynikowego obrazu na serwerze jako output.png
    $outputFile = 'output.png';
    file_put_contents($outputFile, $response);

    // Wyświetlenie obrazu bez tła użytkownikowi
    echo '<br><h1>Background is removed now!</h1><br>';
    echo '<img src="' . $outputFile . '" height="200" width="200" alt="Image without background"> <div id="download_nobg"><a href="' . $outputFile . '" download="image_no_bg.png">Pobierz obraz</a></div>'; // Podgląd obrazu
}
?>
</div>
</div>
</body>
</html>