<?php
include "header.php";
include "db.php";

$id = $_GET['id'];

$sql = "SELECT * FROM students WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->execute([':id' => $id]);
$student = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];

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
?>

<h2>Edit Student</h2>

<form method="POST">
    Name: <input type="text" name="name" value="<?= $student['name']; ?>" required><br><br>
    Email: <input type="email" name="email" value="<?= $student['email']; ?>" required><br><br>
    Course: <input type="text" name="course" value="<?= $student['course']; ?>" required><br><br>
    <button type="submit" name="update">Update Student</button>
</form>

<?php include "footer.php"; ?>
