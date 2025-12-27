<?php
include "db.php";

$id = $_GET['id'];

$sql = "DELETE FROM students WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->execute([':id' => $id]);

header("Location: index.php");
exit;
