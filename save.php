<?php
$data = json_decode(file_get_contents("php://input"), true);

$lat = $data['latitude'];
$lon = $data['longitude'];
$time = $data['time'];
$ip = $_SERVER['REMOTE_ADDR'];

// Reverse geocoding (OpenStreetMap – free)
$url = "https://nominatim.openstreetmap.org/reverse?format=json&lat=$lat&lon=$lon";
$geo = json_decode(file_get_contents($url), true);

$address = $geo['display_name'] ?? "Unknown";

$log = [
  "latitude" => $lat,
  "longitude" => $lon,
  "address" => $address,
  "time" => $time,
  "ip" => $ip
];

file_put_contents("logs.txt", json_encode($log) . PHP_EOL, FILE_APPEND);
