<?php
include "header.php";
include "db.php";

if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $course = trim($_POST['course']);


    // Check if email is valid BEFORE executing SQL
    if (!$email) {
        echo "<p class='message error'>Invalid email address.</p>";
    } else {
        $sql = "INSERT INTO students (name, email, course) 
                VALUES (:name, :email, :course)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':course' => $course
        ]);

        header("Location: index.php");
        exit;
    }
}
?>


<form method="POST" class="student-form">
    <h2>New Student Form</h2>

    <label for="name">Name: </label>
    <input type="text" name="name" id="name" placeholder="Name" required>

    <label for="email">Email: </label>
    <input type="email" name="email" id="email" placeholder="Email" required>

    <label for="course">Course: </label>
    <input type="text" name="course" id="course" placeholder="Course" required>

    <button type="submit" name="submit">Add Student</button>
</form>

<?php include "footer.php"; ?>
