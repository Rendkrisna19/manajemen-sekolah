<?php
include '../fuction.php'; 

// Simulasi data perkembangan siswa selama 1 tahun (12 bulan)
$data = [
    "January" => rand(50, 100),
    "February" => rand(60, 110),
    "March" => rand(70, 120),
    "April" => rand(80, 130),
    "May" => rand(90, 140),
    "June" => rand(100, 150),
    "July" => rand(110, 160),
    "August" => rand(120, 170),
    "September" => rand(130, 180),
    "October" => rand(140, 190),
    "November" => rand(150, 200),
    "December" => rand(160, 210),
];

echo json_encode([
    "labels" => array_keys($data),
    "data" => array_values($data)
]);
?>