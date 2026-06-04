<?php
include "db.php";

$courses = $conn->query("SELECT * FROM courses");
?>

<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <title>Course Enrollment System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Course Enrollment System</h1>
    <p>Система за записване на студенти в курсове</p>
    <nav>
        <a href="index.php">Начало</a>
        <a href="admin.php">Админ панел</a>
    </nav>
</header>

<main class="container">
    <section class="card">
        <h2>Налични курсове</h2>

        <div class="courses">
            <?php while ($course = $courses->fetch_assoc()): ?>
                <div class="course-card">
                    <h3><?= htmlspecialchars($course["title"]) ?></h3>
                    <p><?= htmlspecialchars($course["description"]) ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    </section>

    <section class="card">
        <h2>Записване в курс</h2>

        <form action="enroll.php" method="POST" onsubmit="return confirmEnrollment();">
            <label for="name">Име:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Имейл:</label>
            <input type="email" id="email" name="email" required>

            <label for="course_id">Избери курс:</label>
            <select id="course_id" name="course_id" required>
                <option value="">-- Избери курс --</option>

                <?php
                $coursesSelect = $conn->query("SELECT * FROM courses");
                while ($course = $coursesSelect->fetch_assoc()):
                ?>
                    <option value="<?= $course["id"] ?>">
                        <?= htmlspecialchars($course["title"]) ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <button type="submit">Запиши се</button>
        </form>
    </section>
</main>

<?php if (isset($_GET['status']) && $_GET['status'] === 'success'): ?>
    <div class="message success">
        Успешно записване в курса!
    </div>
<?php endif; ?>

<?php if (isset($_GET['status']) && $_GET['status'] === 'exists'): ?>
    <div class="message error">
        Вече сте записани в този курс.
    </div>
<?php endif; ?>

<div id="confirmModal" class="modal">
    <div class="modal-box">
        <h3>Потвърждение</h3>
        <p>Сигурни ли сте, че искате да се запишете?</p>

        <div class="modal-actions">
            <button type="button" class="cancel-btn" onclick="closeModal()">Отказ</button>
            <button type="button" class="confirm-btn" onclick="submitEnrollment()">Запиши се</button>
        </div>
    </div>
</div>

<script src="script.js"></script>
</body>
</html>