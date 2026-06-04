<?php
include "db.php";

if (!isset($_GET["id"])) {
    header("Location: admin.php");
    exit;
}

$id = intval($_GET["id"]);

$stmt = $conn->prepare("DELETE FROM enrollments WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: admin.php");
exit;
?>