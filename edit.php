<?php
include "header.php";
include "db.php";

$id = $_GET['id'];

// Fetch student
$sql = "SELECT * FROM students WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->execute([':id' => $id]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);


// Handle update
if (isset($_POST['update'])) {
    $name = trim($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $course = trim($_POST['course']);

    if (!$email) {
        echo "<p class='message error'>Invalid email address.</p>";
    } else {
        $sql = "UPDATE students
                SET name = :name, email = :email, course = :course
                WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':course' => $course,
            ':id' => $id
        ]);

        header("Location: index.php");
        exit;
    }
}
?>

<form method="POST" class="student-form">
    <h2>Edit Student</h2>

    <label for="name">Name: </label>
    <input type="text" name="name" id="name" value="<?= htmlspecialchars($student['name']); ?>" required>

    <label for="email">Email: </label>
    <input type="email" name="email" id="email" value="<?= htmlspecialchars($student['email']); ?>" required>

    <label for="course">Course: </label>
    <input type="text" name="course" id="course" value="<?= htmlspecialchars($student['course']); ?>" required>

    <button type="submit" name="update">Update Student</button>
</form>

<?php include "footer.php"; ?>