<?php
session_start();
include '../fuction.php';

$id = $_GET['id'];
$conn->query("DELETE FROM students WHERE id = $id");

header("Location: siswa.php");
?>