<?php
// api.php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// Matikan display error agar tidak merusak format JSON
ini_set('display_errors', 0);
error_reporting(E_ALL);

// Cek tipe request: 'search' (cari kota) atau 'weather' (data cuaca)
$type = isset($_GET['type']) ? $_GET['type'] : 'weather';

if ($type === 'search') {
    // --- LOGIKA PENCARIAN KOTA (NOMINATIM) ---
    $query = isset($_GET['q']) ? urlencode($_GET['q']) : '';
    
    if (empty($query)) {
        echo json_encode([]);
        exit;
    }

    // URL Nominatim OpenStreetMap
    $url = "https://nominatim.openstreetmap.org/search?format=json&q=" . $query . "&limit=1";

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        // PENTING: OpenStreetMap WAJIB ada User-Agent
        CURLOPT_USERAGENT => "WeatherDashboardLocal/1.0", 
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
    ]);

    $response = curl_exec($curl);
    curl_close($curl);
    echo $response;

} else {
    // --- LOGIKA DATA CUACA (RAPIDAPI) ---
    $lat = isset($_GET['lat']) ? $_GET['lat'] : '';
    $lon = isset($_GET['lon']) ? $_GET['lon'] : '';

    // Default Jakarta jika kosong
    if (empty($lat) || empty($lon)) {
        $lat = "-6.2088";
        $lon = "106.8456";
    }

    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://open-weather13.p.rapidapi.com/fivedaysforcast?latitude=" . $lat . "&longitude=" . $lon . "&lang=EN",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_SSL_VERIFYHOST => 0, // Bypass SSL XAMPP
        CURLOPT_SSL_VERIFYPEER => 0, // Bypass SSL XAMPP
        CURLOPT_HTTPHEADER => [
            "x-rapidapi-host: open-weather13.p.rapidapi.com",
            "x-rapidapi-key: 88f8e098cdmsh42fbcfd125ac874p177717jsn36d399d908a7"
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        echo json_encode(["cod" => 500, "message" => "cURL Error: " . $err]);
    } else {
        echo $response ? $response : json_encode(["cod" => 500, "message" => "Empty response"]);
    }
}
?>