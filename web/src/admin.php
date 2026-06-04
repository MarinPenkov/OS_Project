<?php
include "db.php";

$enrollments = $conn->query("
    select
        enrollments.id,
        students.name,
        students.email,
        courses.title,
        enrollments.created_at
    from enrollments
    join students on enrollments.student_id = students.id
    join courses on enrollments.course_id = courses.id
    order by enrollments.created_at DESC
");
?>

<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Course Enrollment System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Админ панел</h1>
    <p>Преглед на всички записвания</p>
    <nav>
        <a href="index.php">Начало</a>
        <a href="admin.php">Админ панел</a>
    </nav>
</header>

<main class="container">
    <section class="card">
        <h2>Всички записвания</h2>

        <table>
            <thead>
                <tr>
                    <th>Студент</th>
                    <th>Имейл</th>
                    <th>Курс</th>
                    <th>Дата</th>
                    <th>Действие</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($enrollments->num_rows > 0): ?>
                    <?php while ($row = $enrollments->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row["name"]) ?></td>
                            <td><?= htmlspecialchars($row["email"]) ?></td>
                            <td><?= htmlspecialchars($row["title"]) ?></td>
                            <td><?= date("d.m.Y H:i:s", strtotime($row["created_at"] . " +3 hours")) ?></td>
                            <td>
                                <a 
                                    class="delete-btn" 
                                    href="delete_enrollment.php?id=<?= $row["id"] ?>"
                                    onclick="return confirmDelete();"
                                >
                                    Изтрий
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">Все още няма записвания.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </section>
</main>

<script src="script.js"></script>
</body>
</html>