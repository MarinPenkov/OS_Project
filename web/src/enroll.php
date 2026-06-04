<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$name = trim($_POST["name"]);
$email = trim($_POST["email"]);
$course_id = intval($_POST["course_id"]);

if ($name === "" || $email === "" || $course_id === 0) {
    die("Моля, попълнете всички полета.");
}

$stmt = $conn->prepare("SELECT id FROM students WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$studentResult = $stmt->get_result();

if ($studentResult->num_rows > 0) {
    $student = $studentResult->fetch_assoc();
    $student_id = $student["id"];
} else {
    $stmt = $conn->prepare("INSERT INTO students (name, email) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $email);
    $stmt->execute();
    $student_id = $stmt->insert_id;
}

$stmt = $conn->prepare("
    select id from enrollments 
    where student_id = ? and course_id = ?
");
$stmt->bind_param("ii", $student_id, $course_id);
$stmt->execute();
$enrollmentResult = $stmt->get_result();

if ($enrollmentResult->num_rows > 0) {
    header("Location: index.php?status=exists");
    exit;
}

$stmt = $conn->prepare("
    insert into enrollments (student_id, course_id) 
    VALUES (?, ?)
");
$stmt->bind_param("ii", $student_id, $course_id);
$stmt->execute();

header("Location: index.php?status=success");
exit;